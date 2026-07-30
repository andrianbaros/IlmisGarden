<?php
namespace PHPMailer\PHPMailer;

class SMTP
{
    const VERSION = '6.8.0';
    const LE = "\r\n";
    const DEFAULT_PORT = 25;

    protected $smtp_conn;
    protected $error = [];
    protected $helo_rply = null;

    public function connect($host, $port = null, $timeout = 30, $options = [])
    {
        $this->error = [];
        if (empty($port)) {
            $port = self::DEFAULT_PORT;
        }

        $errno = 0;
        $errstr = '';
        
        $socket_context = stream_context_create($options);
        $this->smtp_conn = @stream_socket_client(
            $host . ':' . $port,
            $errno,
            $errstr,
            $timeout,
            STREAM_CLIENT_CONNECT,
            $socket_context
        );

        if (!is_resource($this->smtp_conn)) {
            $this->error = [
                'error' => 'Failed to connect to server',
                'detail' => $errstr,
                'errno' => $errno,
            ];
            return false;
        }

        stream_set_timeout($this->smtp_conn, $timeout, 0);

        $announce = $this->get_lines();
        if ($this->get_code($announce) !== 220) {
            $this->error = [
                'error' => 'Server did not return 220 greeting',
                'detail' => $announce,
            ];
            return false;
        }

        return true;
    }

    public function startTLS()
    {
        if (!$this->sendCommand('STARTTLS', 'STARTTLS', 220)) {
            return false;
        }

        $crypto_method = STREAM_CRYPTO_METHOD_TLS_CLIENT | STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT | STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
        if (!@stream_socket_enable_crypto($this->smtp_conn, true, $crypto_method)) {
            $this->error = ['error' => 'Failed to enable TLS encryption'];
            return false;
        }

        return true;
    }

    public function authenticate($username, $password, $authtype = 'LOGIN')
    {
        if (!$this->sendCommand('AUTH LOGIN', 'AUTH LOGIN', 334)) {
            return false;
        }

        if (!$this->sendCommand(base64_encode($username), 'Username', 334)) {
            return false;
        }

        if (!$this->sendCommand(base64_encode($password), 'Password', 235)) {
            return false;
        }

        return true;
    }

    public function sendCommand($commandStr, $commandName, $expecting)
    {
        if (!$this->smtp_conn) {
            return false;
        }

        fputs($this->smtp_conn, $commandStr . self::LE);
        $reply = $this->get_lines();
        $code = $this->get_code($reply);

        if ($code !== $expecting) {
            $this->error = [
                'error' => $commandName . ' command failed',
                'smtp_code' => $code,
                'detail' => $reply,
            ];
            return false;
        }

        return true;
    }

    public function hello($host = 'localhost')
    {
        return $this->sendCommand('EHLO ' . $host, 'EHLO', 250) || $this->sendCommand('HELO ' . $host, 'HELO', 250);
    }

    public function mail($from)
    {
        return $this->sendCommand('MAIL FROM:<' . $from . '>', 'MAIL FROM', 250);
    }

    public function recipient($to)
    {
        return $this->sendCommand('RCPT TO:<' . $to . '>', 'RCPT TO', 250);
    }

    public function data($msg_data)
    {
        if (!$this->sendCommand('DATA', 'DATA', 354)) {
            return false;
        }

        $msg_data = str_replace("\r\n.", "\r\n..", $msg_data);
        $msg_data = preg_replace('/^\./m', '..', $msg_data);

        fputs($this->smtp_conn, $msg_data . self::LE . '.' . self::LE);
        $reply = $this->get_lines();
        $code = $this->get_code($reply);

        if ($code !== 250) {
            $this->error = ['error' => 'DATA command failed', 'smtp_code' => $code, 'detail' => $reply];
            return false;
        }

        return true;
    }

    public function quit()
    {
        if ($this->smtp_conn) {
            $this->sendCommand('QUIT', 'QUIT', 221);
            fclose($this->smtp_conn);
            $this->smtp_conn = null;
        }
    }

    protected function get_lines()
    {
        $data = '';
        if (is_resource($this->smtp_conn)) {
            while ($str = fgets($this->smtp_conn, 515)) {
                $data .= $str;
                if (isset($str[3]) && $str[3] === ' ') {
                    break;
                }
            }
        }
        return $data;
    }

    protected function get_code($line)
    {
        return (int)substr($line, 0, 3);
    }

    public function getError()
    {
        return $this->error;
    }
}
