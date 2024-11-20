<?php
require("db_conn.php"); 

    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = $_POST["email"];

        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $token_hash, $expiry, $email);
        $stmt->execute();

        if ($conn -> affected_rows){
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
        echo "Message sent, please check your inbox. ";
    }

?>
