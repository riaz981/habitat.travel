<html>
    <head>
        <title>Sending email using PHP</title>
        <link rel="stylesheet" type="text/css" href="css/mail.css">
    </head>
    <body>
        <?php
            require 'PHPMailer-master/PHPMailerAutoload.php';
            $mail = new PHPMailer;

            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $telephone = $_REQUEST['tel'];
            $enquiry = $_REQUEST['enquiry'];

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'in-v3.mailjet.com';                    // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'c04d1dc899f8ac04ddebc3e478dfd234'; // SMTP username
            $mail->Password = 'f64db9bc6b415190ae9528ae7048f87d'; // SMTP password
            //$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 25;                                     // TCP port to connect to

            $mail->From = 'info@alpinehabitat.com';                           // This is the webhosting sites email
            $mail->FromName = 'Alpine Habitat';                               // Name of the webshosting site or company's site
            $mail->addAddress('stefan@alpinehabitat.com','Stefan');
            //$mail->addAddress('matt@alpinehabitat.com', 'Matthew Reede');     // Add a recipient
            //$mail->addAddress('ellen@example.com');                         // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            $mail->addReplyTo($email, $name);
            //$mail->addCC('stefan@alpinehabitat.com');
            $mail->addBCC('riaz.hasan@yahoo.com.au');

            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                    // Set email format to HTML

            $mail->Subject = 'Test Email. Enquiry from Habitat Travel Group Page';

            $message = "There has been an enquiry sent through Habitat Travel Group"."<br>";
            $message .= "From: ".$name."<br>";
            $message .= "On: ".date("Y-m-d H:i:s")."<br>";
            $message .= "Email: ".$email."<br>";
            $message .= "Enquiry: ".$enquiry."<br>";
            $message .= "IP Address: ".$_SERVER["REMOTE_ADDR"]."<br>";

            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            ?>
            <div id="headline">
                <div class="container">
                    <h2 id="thankyou">Thank You</h2>
                    <div id="thanks">

                        <?php
                            //checking if name or email is empty. if not empty send email.

                            if(!empty($name) || !empty($email))
                            {
                                if(!$mail->send())
                                {
                                    echo 'Your message could not be sent.';
                                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                                }

                                else
                                {
                                    echo "<br>".'Thank you for emailing us'."<br>";
                                    echo 'Your message has been sent'."<br>";
                                    echo 'Someone will get in touch with your shortly';
                                }
                            }

                            //if empty redirect to main page and dont send email.

                            else
                            {
                                header("Location: http://stuff.localhost");
                            }
                        ?>
                    <h5><a href="http://stuff.localhost">Back</a></h5>
                </div>
            </div>
        </div>
    </body>
</html>
