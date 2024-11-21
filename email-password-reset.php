<?php
require("db_conn.php"); 

    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = $_POST["email"];

        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        $sql = "
        SELECT 'users' AS user_type, id, email, user_name AS username 
        FROM users 
        WHERE email = ?
        UNION
        SELECT 'clients' AS user_type, id, email, client_name AS username 
        FROM clients 
        WHERE email = ?
        UNION
        SELECT 'admins' AS user_type, id, email, admin_name AS username 
        FROM admins 
        WHERE email = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_type = $row['user_type'];

        $update_sql = "";
        if ($user_type === 'users') {
            $update_sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
        } elseif ($user_type === 'clients') {
            $update_sql = "UPDATE clients SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
        } elseif ($user_type === 'admins') {
            $update_sql = "UPDATE admins SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
        }

        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sss", $token_hash, $expiry, $email);
        $update_stmt->execute();

        if ($conn->affected_rows ) {
            $mail = require __DIR__ .  "/mailer.php";

            $mail->setfrom("mgeek573@gmail.com");
            $mail-> addAddress($email);
            $mail->Subject = "Password Reset";
            $mail->Body= <<<END
                    Click <a href="localhost/fyp/reset-password.php?token=$token"> here </a> to reset your password
            END;

            try{
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent Mailer error: {$mail->ErrorInfo} ";
            }
        }
        header("Location: forgot-password.php?error=Message sent, Pxlease check your inbox. ");
        exit();
    }
}

?>
