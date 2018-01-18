<?php
// Note: filter_var() requires PHP >= 5.2.0
if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['subject']) && isset($_POST['comments']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {

    // detect & prevent header injections
    $mailTest = "/(content-type|bcc:|cc:|to:)/i";
    foreach ( $_POST as $key => $val ) {
        if ( preg_match( $mailTest, $val ) ) {
            exit;
        }
    }

    $headers = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    'Reply-To: ' . $_POST["email"] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $message = sprintf( "Name: %s\nPhone: %s\n\n Message: %s", $_POST['name'], $_POST['phone'], $_POST['comments'] );
    $success = mail( "themebucket@gmail.com", $_POST['subject'], $message, $headers );
    //  Replace with your email 

    if ($success) {
        ?>
        <div style="color:#3c763d;padding:30px;text-align:center">
            <strong>Success!</strong> Message has been sent successfully.
        </div>
        <?php
    }

}
