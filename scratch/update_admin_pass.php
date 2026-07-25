<?php
require 'conn/db.php';

try {
    $username = 'admin';
    $password = '2026admin';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update all admin records or ensure at least one admin account has username 'admin' and the new password
    $stmt = $pdo->prepare("UPDATE admin SET username = ?, password = ? WHERE id_admin = 3 OR username = 'admin'");
    $stmt->execute([$username, $hashedPassword]);

    if ($stmt->rowCount() == 0) {
        // If no rows updated, insert new admin record
        $stmtIns = $pdo->prepare("INSERT INTO admin (username, email, password) VALUES (?, ?, ?)");
        $stmtIns->execute(['admin', 'admin@ilmis.com', $hashedPassword]);
        echo "Created new admin user 'admin'.\n";
    } else {
        echo "Updated admin user 'admin' password successfully.\n";
    }

    // Verify password match
    $checkStmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $checkStmt->execute(['admin']);
    $user = $checkStmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        echo "Verification SUCCESS: Password '2026admin' verified with hash!\n";
    } else {
        echo "Verification FAILED!\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
