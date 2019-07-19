<?php
  // echo "In the password reset controller.";
  /*
  *     PSEUDO - LOGIC.
  *    ===================================
  *  - CREATE AN EIGHT DIGIT RANDOM NUMBER.
  *  - Pass the given number to page where the user will type the given number.
  *  - Compare entered random number and the generated number passed from this controller.
  *  - If the entered string is valid give user access to the system
  */

  $caller_type = $_GET['callertype'];
  $min = 1000;
  $max = 9999;

  /* TODO: determine between which of the two statements will be most efficient.
  *1. exec('wget http://<url to the php script>')
  *2. include 'b.php';
  */
  $randomly_generated_number = random_int($min, $max);

  if($caller_type == "sms"){

    // Getting phone number for SMS.
    $phone_number = $_POST['phone_number'];

    $_SESSION['secret_random_pin'] = $randomly_generated_number;
    echo $randomly_generated_number;
    // include statement.
    if(include __DIR__.'\send_sms.php'){
      // redirect to page reset page using header.
      $final_pwsd_page = '../../html/final_pwsd_reset.php';
      header('Location: ' . $final_pwsd_page);
    } else {
      // return error message.
    }

  }elseif ($caller_type == "email") {
    // Getting email addresses for email.
    $to = $_POST['email'];
    $msg = "Generated random number is: " . $randomly_generated_number;
    // include statement.

    if(include __DIR__.'\send_email.php'){
      // redirect to page reset page using header.
      $final_pwsd_page = '../../html/final_pwsd_reset.php';
      header('Location: ' . $final_pwsd_page);
    }else {
      // return error message.
      echo "Couldn't Run Email Script. Try Again In a Few Minutes";
    }

  }else{
    // TODO: Think of this usecase and how to account for this.
  }

?>
