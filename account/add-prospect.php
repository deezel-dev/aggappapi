<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/_init.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/lib/swiftmailer/swift_required.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/database.php";
header("Content-Type: text/json");

$user = json_decode(file_get_contents("php://input"));

$addMessage = addMessage($user->{"email"}, $user->{"user_name"}, $user->{"subject"}, $user->{"message"});

if($addMessage){
    echo(json_encode($addUser));
    //sendVerificationEmail($user->{"email"});
}

function addMessage($email, $user_name, $subject, $message) {
    
    $response = false;

    if (!isset($_SERVER['REMOTE_ADDR']))
            $qipAddress = "NULL";
    else {
        $qipAddress = $_SERVER['REMOTE_ADDR'];
            
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $qipAddress .= "," . $_SERVER['HTTP_X_FORWARDED_FOR'];
            
    }
    
    $sql = "INSERT INTO profile_prospects(email, ip_address, date_added, user_name, subject, message)
            VALUES (
                '" . padSql($email) ."',
                '" .$qipAddress . "', 
                NOW(),
                '" . padSql($user_name) ."',
                '" . padSql($subject) ."',
                '" . padSql($message) ."')";    
      
    $data = getDatabase();
    
    if ($data->open()) {
        if($data->insertData($sql)){
            $response = true;
        }
    } 

    return $response;
    
}



function padSql($subject){
    return str_replace ("'","''",$subject);
  }

  function sendVerificationEmail($emailAddress) {
   
    $transport = Swift_SmtpTransport::newInstance('gator4083.hostgator.com', 465, "ssl")
      ->setUsername('staff@flixacademy.com')
      ->setPassword('FlixMailP@ssw0rd');

    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance('Thank you for supporting FlixAcademy')
      ->setFrom(array('staff@flixacademy.com' => 'FlixAcademy Team'))
      ->setTo(array($emailAddress))
      ->setBody(
        
        "Thank you for showing interest in FlixAcademy and bringing movies to the classroom." .
        "\n" . 
        "We want to engage students with multimedia lesson plans using the latest Hollywood movies and would like for you to get involved.  Here's how:" .
        "\n" . 
        "\n" . 
        "Cheers,\n" .
        "The FlixAcademy Team");

    $result = $mailer->send($message);
    
    return $result > 0;
}
?>