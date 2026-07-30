<?php
namespace PHPMailer\PHPMailer;

require_once __DIR__ . '/Exception.php';
require_once __DIR__ . '/SMTP.php';

class PHPMailer
{
    public $Host = 'smtp.gmail.com';
    public $Port = 587;
    public $SMTPAuth = true;
    public $Username = '';
    public $Password = '';
    public $SMTPSecure = 'tls'; // 'tls' or 'ssl'
    public $From = '';
    public $FromName = 'Ilmis Garden';
    public $Timeout = 10;

    protected $to = [];
    protected $Subject = '';
    protected $Body = '';
    protected $isHTML = true;
    public $ErrorInfo = '';

    public function isSMTP()
    {
        // Set mode to SMTP
    }

    public function isHTML($isHtml = true)
    {
        $this->isHTML = (bool)$isHtml;
    }

    public function setFrom($address, $name = '')
    {
        $this->From = $address;
        if (!empty($name)) {
            $this->FromName = $name;
        }
    }

    public function addAddress($address, $name = '')
    {
        $this->to[] = ['address' => $address, 'name' => $name];
    }

    public function clearAddresses()
    {
        $this->to = [];
    }

    public function setSubject($subject)
    {
        $this->Subject = $subject;
    }

    public function setBody($body)
    {
        $this->Body = $body;
    }

    public function testConnection()
    {
        $smtp = new SMTP();
        $host = $this->Host;
        if ($this->SMTPSecure === 'ssl') {
            $host = 'ssl://' . $host;
        }

        $opts = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        if (!$smtp->connect($host, $this->Port, $this->Timeout, $opts)) {
            $err = $smtp->getError();
            $this->ErrorInfo = "Koneksi ke Host (" . $this->Host . ":" . $this->Port . ") gagal: " . ($err['detail'] ?? $err['error'] ?? 'Unknown error');
            return false;
        }

        if (!$smtp->hello($_SERVER['HTTP_HOST'] ?? 'localhost')) {
            $err = $smtp->getError();
            $this->ErrorInfo = "Handshake EHLO gagal: " . ($err['detail'] ?? 'Response error');
            $smtp->quit();
            return false;
        }

        if ($this->SMTPSecure === 'tls') {
            if (!$smtp->startTLS()) {
                $err = $smtp->getError();
                $this->ErrorInfo = "Enkripsi STARTTLS gagal. Pastikan port " . $this->Port . " mendukung TLS: " . ($err['error'] ?? '');
                $smtp->quit();
                return false;
            }
            // Re-hello after TLS
            $smtp->hello($_SERVER['HTTP_HOST'] ?? 'localhost');
        }

        if ($this->SMTPAuth) {
            if (!$smtp->authenticate($this->Username, $this->Password)) {
                $err = $smtp->getError();
                $this->ErrorInfo = "Autentikasi SMTP Gagal (Username / Password salah): " . ($err['detail'] ?? 'Cek password / App Password Gmail Anda');
                $smtp->quit();
                return false;
            }
        }

        $smtp->quit();
        return true;
    }

    public function send()
    {
        if (empty($this->to)) {
            $this->ErrorInfo = "Alamat email penerima kosong.";
            return false;
        }

        $smtp = new SMTP();
        $host = $this->Host;
        if ($this->SMTPSecure === 'ssl') {
            $host = 'ssl://' . $host;
        }

        $opts = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        if (!$smtp->connect($host, $this->Port, $this->Timeout, $opts)) {
            $err = $smtp->getError();
            $this->ErrorInfo = "Koneksi ke SMTP Host (" . $this->Host . ":" . $this->Port . ") gagal. " . ($err['detail'] ?? '');
            return false;
        }

        if (!$smtp->hello($_SERVER['HTTP_HOST'] ?? 'localhost')) {
            $err = $smtp->getError();
            $this->ErrorInfo = "Handshake EHLO gagal: " . ($err['detail'] ?? '');
            $smtp->quit();
            return false;
        }

        if ($this->SMTPSecure === 'tls') {
            if (!$smtp->startTLS()) {
                $err = $smtp->getError();
                $this->ErrorInfo = "Enkripsi STARTTLS gagal: " . ($err['error'] ?? '');
                $smtp->quit();
                return false;
            }
            $smtp->hello($_SERVER['HTTP_HOST'] ?? 'localhost');
        }

        if ($this->SMTPAuth) {
            if (!$smtp->authenticate($this->Username, $this->Password)) {
                $err = $smtp->getError();
                $this->ErrorInfo = "Autentikasi SMTP Gagal. Periksa Username & App Password Gmail Anda. Detail: " . ($err['detail'] ?? '');
                $smtp->quit();
                return false;
            }
        }

        if (!$smtp->mail($this->From)) {
            $err = $smtp->getError();
            $this->ErrorInfo = "MAIL FROM ditolak: " . ($err['detail'] ?? '');
            $smtp->quit();
            return false;
        }

        foreach ($this->to as $recipient) {
            if (!$smtp->recipient($recipient['address'])) {
                $err = $smtp->getError();
                $this->ErrorInfo = "RCPT TO ditolak untuk (" . $recipient['address'] . "): " . ($err['detail'] ?? '');
                $smtp->quit();
                return false;
            }
        }

        // Build Email Message Raw Headers & Body
        $mime_boundary = "==Multipart_Boundary_x" . md5(time()) . "x";
        $headers  = "From: " . "=?UTF-8?B?" . base64_encode($this->FromName) . "?=" . " <" . $this->From . ">\r\n";
        $headers .= "Reply-To: <" . $this->From . ">\r\n";
        $headers .= "To: <" . $this->to[0]['address'] . ">\r\n";
        $headers .= "Subject: " . "=?UTF-8?B?" . base64_encode($this->Subject) . "?=" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        
        if ($this->isHTML) {
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        } else {
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        }

        $raw_message = $headers . "\r\n" . $this->Body;

        if (!$smtp->data($raw_message)) {
            $err = $smtp->getError();
            $this->ErrorInfo = "Gagal mengirim DATA isi email: " . ($err['detail'] ?? '');
            $smtp->quit();
            return false;
        }

        $smtp->quit();
        return true;
    }
}
