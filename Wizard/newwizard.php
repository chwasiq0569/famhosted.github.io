<?php



// Definitions

define('PATH', '../');

define('ROOT_PATH', '../');

define('FRONTEND', 'false');

$page = 'Home';







require_once '../core/init.php';





//Twilio setup



require '../core/twilio-php-main/src/Twilio/autoload.php';

use Twilio\Rest\Client;



// Your Account SID and Auth Token from twilio.com/console

$sid = 'AC042924150427fee3b1b327ea196122d0';

$token = '0eec83f632143143e2033ad57aed3952';



$twilio_number = "+16156516568"; // our twilio number





$user = new User();

$queries = new Queries();



       

 if(!isset($_GET['step'])) { 

	Redirect::to('wizard.php?step=1');

	die();

 }





if($_GET['step'] == 1) { 

	$_SESSION['questionnum'] = 1;

	$_SESSION["progress"] = 0;

} elseif($_GET['step'] == -1) {

	session_destroy();

	Redirect::to('quesstionarePages/success.php');

}

							

							

							

							

function GenerateBackButton($step) {

	if($step == 3.1) {

		return "wizard.php?step=3";

	} elseif($step == 3.2) {

		return "wizard.php?step=3";

	} else {

		return false;

	}



}



function GetTopStage($stage) {

	if($stage > 0 && $stage < 4) {

		return 1;

	} elseif($stage > 5 && $stage < 4.8) { 

		return 2;

	} else {

		return 3;

	}

}



if($_GET['step'] == 1) { 

					

if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



        $validate = new Validate();

        $validation = $validate->check($_POST, array(

            'fname' => array(

					'required' => true,

					'min' => 3,

					'max' => 64

				),

			  'lname' => array(

					'required' => true,

					'min' => 3,

					'max' => 64

				),

			 'day' => array(

					'required' => true

				),

			'month' => array(

					'required' => true

				),

			'year' => array(

					'required' => true

				),

				'email' => array(

					'required' => true,

					'min' => 4,

					'max' => 102,

					'unique' => 'userdata'

				)

        ));

			

			if($validate->passed()) {

				

				$dob = $_POST['month'] . '/' . $_POST['day'] . '/' . $_POST['year'];

				

						$queries->create('userdata', array(

								'fname' => $_POST['fname'],

								'lname' => $_POST['lname'],

								'email' => $_POST['email'],

								'dob' => $dob,

								'active' => 0,

								'stage' => 2

							));

						

			$GetUserID = $queries->getWhere('userdata', array('email', '=', $_POST['email']));

			

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["userid"] = $GetUserID[0]->id;					

			$_SESSION["useremail"] = $_POST['email']; // Reference to database.

			$_SESSION["stage"] = 2; // Reference to database.

			unset($_SESSION["smscode"]);

			$_SESSION["topstage"] = 1;

			Redirect::to('wizard.php?step=2');

			die();	

   



									

        } else {

            foreach($validate->errors() as $error) {

				if($error == "The username/email email already exists!") {

					$getstage = $queries->getWhere('userdata', array('email', '=', $_POST['email']));

					$_SESSION["userid"] = $getstage[0]->id;

					$_SESSION["stage"] = $getstage[0]->stage;

					$_SESSION["topstage"] = GetTopStage($getstage[0]->stage);

					Redirect::to('wizard.php?step=' . $getstage[0]->stage);

					die();	

				} else {

	

				}

					

            }

        

    }

}

}



}elseif($_GET['step'] == 2) { //2FA authentication



// Check to see if step 2 is valid? this is important so someone can't brute force url to bypass steps.



if(!isset($_SESSION["userid"])) { // Not valid! redirect to step 1

		Redirect::to('wizard.php?step=1');

		die();

} else { // Valid - proceed with validation.



if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



    







			if(!isset($_POST['code'])) {

					

			$SMSCODE = mt_rand(100000, 999999);

			

			$client = new Client($sid, $token);

			
			try {
				
				
			$client->messages->create(

				'+1' . $_POST['number'],

				[



					'from' => $twilio_number,

			   

					'body' => "Welcome to milk, here is your verification code:" . $SMSCODE

				]

			);



} catch (Exception $e) {
    Redirect::to('wizard.php?step=2&action=error');
	die();
}

	
			

				$queries->update('userdata', $_SESSION["userid"], array(

									'SMSCODE' => $SMSCODE,

									'mobile' => '+44' . $_POST['number'],

									'stage' => 2

								));

				

				$_SESSION["progress"] = $_SESSION["progress"] + 10;

				$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

				$_SESSION["smscode"] = $SMSCODE;

				$_SESSION["stage"] = 2; // Reference to database.

				$_SESSION["number"] = $_POST['number'];

				Redirect::to('wizard.php?step=2');

				die();	

			} else {

				if(isset($_POST['code'])) {

				$getcode = $queries->getWhere('userdata', array('id', '=', $_SESSION["userid"]));

			if($_POST['code'] === $getcode[0]->SMSCODE) {

					$_SESSION["stage"] = 3;

					Redirect::to('wizard.php?step=3');

				} else {

					Redirect::to('wizard.php?step=2.1'); // code input was wrong

				}

			} else {

				Redirect::to('wizard.php?step=2.1'); // nothing was entered into the box.

				die();	

			}

			}

									



    }

}



}

} elseif($_GET['step'] == 3) { //2FA enter code

$input = false;

if(Input::exists()) {

		if(Token::check(Input::get('token'))) {

			$input = true;

		}

}

	if(isset($_GET['whattype'])) {

		if($_GET['whattype'] == "glti") {

			$input = true;

		}

	}



		if($input == true) {

			if($_GET['whattype'] == "glti") {

				$acctype = "General long-term investing";

				if($_GET['oques1'] == "on") {

					$subacc = "Individual";

				} elseif($_GET['oques2'] == "on") {

					$subacc = "Joint";

				} else {

					$subacc = "Trust";

				}

				





			} else {

				$acctype = "Retirement investing";

				if($_POST['ques1'] == "on") {

					$subacc = "Traditional IRA";

				} elseif($_POST['ques2'] == "on") {

					$subacc = "Roth IRA";

				} else {

					$subacc = "SEP IRA";

				}

				

			}

		

			

				$queries->update('userdata', $_SESSION["userid"], array( // main account-type

								'acctype' => $acctype,

								'subacctype' => $subacc,

								'stage' => 4

							));

			



				$_SESSION["stage"] = 4; // Reference to database.

				

				Redirect::to('wizard.php?step=4'); // GLTI selected - account type

				die();	

			

	}

	

	



} elseif($_GET['step'] == 4) {

	$_SESSION["topstage"] = 2;

	if(Input::exists()) {

		    if(Token::check(Input::get('token'))) { // hit next

				$_SESSION["stage"] = 4.1;

				Redirect::to('wizard.php?step=4.1');

		}

	}



} elseif($_GET['step'] == 4.1) {

	

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



        if(isset($_POST['amount1'])) {

			

			$queries->update('userdata', $_SESSION["userid"], array(

								'income' => $_POST['amount1'],

								'stage' => 4.2

							));

			

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["stage"] = 4.2; // Reference to database.

			

			Redirect::to('wizard.php?step=4.2');

			die();	

									

        } else {

			echo "not set";

			die();

		}

    }

}



} elseif($_GET['step'] == 4.2) {

	

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



          if(isset($_POST['amount1'])) {



			

			$queries->update('userdata', $_SESSION["userid"], array(

								'savings' => $_POST['amount1'],

								'stage' => 4.3

							));

							

							

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["stage"] = 4.3; // Reference to database.

			

			Redirect::to('wizard.php?step=4.21');

			die();	

									

        } else {

			echo "not set";

            die();

            }

        }

    }

	

} elseif($_GET['step'] == 4.21) {

	

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



          if(isset($_POST['amount1'])) {



			

			$queries->update('userdata', $_SESSION["userid"], array(

								'debt' => $_POST['amount1'],

								'stage' => 4.3

							));

							

							

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["stage"] = 4.3; // Reference to database.

			

			Redirect::to('wizard.php?step=4.3');

			die();	

									

        } else {

			echo "not set";

            die();

            }

        }

    }



} elseif($_GET['step'] == 4.3) { // Experience level with investing



	

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {

			if(!isset($_COOKIE['GetVar'])) {

				Redirect::to('wizard.php?step=4.3');

			} else {

				$exp = $_COOKIE['GetVar'];

			}

		

			$queries->update('userdata', $_SESSION["userid"], array(

								'experience' => $exp,

								'stage' => 4.4

							));

			

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["stage"] = 4.4; // Reference to database.

			

			Redirect::to('wizard.php?step=4.4');

			die();	

									

      

    }

}



} elseif($_GET['step'] == 4.4) { // what is keeping you from your financial best.

	

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



	$string  = "";

for ($i = 1; $i < 8; $i++){

	if(isset($_COOKIE['Ques' . $i])) {

		if($i == 7) {

			$string = $string . $_COOKIE['Ques' . $i];

		} else {

			$string = $string . '[+] - ' . $_COOKIE['Ques' . $i] . "\n";

		}

	}

}





			

			$queries->update('userdata', $_SESSION["userid"], array(

								'potential' => $string,

								'stage' => 4.5

							));

			

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["stage"] = 4.5; // Reference to database.

			

			Redirect::to('wizard.php?step=4.5');

			die();	

									

        

        }

    }





} elseif($_GET['step'] == 4.5) { // Whats the risk of investing

	

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



			

			$queries->update('userdata', $_SESSION["userid"], array(

								'risk' => $_COOKIE['Ques'],

								'stage' => 4.6

							));

			

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["stage"] = 4.6; // Reference to database.

			

			Redirect::to('wizard.php?step=4.6');

			die();	

									

       

    }

}



} elseif($_GET['step'] == 4.6) { // Whats the risk of investing

	

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



      

			$queries->update('userdata', $_SESSION["userid"], array(

								'care' => $_COOKIE['Ques'],

								'stage' => 4.7

							));

			

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["stage"] = 4.7; // Reference to database.

			

			Redirect::to('wizard.php?step=4.7');

			die();	

									

       

    }

}

} elseif($_GET['step'] == 4.7) { // stock crash

	

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {





			

			$queries->update('userdata', $_SESSION["userid"], array(

								'stockcrash' => $_COOKIE['Ques'],

								'stage' => 4.8

							));

			

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["stage"] = 4.8; // Reference to database.

			

			Redirect::to('wizard.php?step=4.8');

			die();	

									

      

    }

}

} elseif($_GET['step'] == 4.8) { // confirm details

	$_SESSION["topstage"] = 3;

	if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



					// User has completed entire survey, now add to queue.

					

			$queueindex = $queries->getWhere('globalvars', array('name', '=', 'lastqueueindex'));

			

			$queueindex = $queueindex[0]->value + 1;

			

			$now = new DateTime();

			$queries->update('userdata', $_SESSION["userid"], array(

								'queuepos' => $queueindex,

								'stage'=> -1,

								'lastupdated' => $now->getTimestamp()

							));

			$queries->update('globalvars', 2, array(

								'value' => $queueindex

							));

							

			$_SESSION["progress"] = $_SESSION["progress"] + 10;

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;			

			$_SESSION["queuepos"] = $queueindex;

			$_SESSION["stage"] = 4.8; // Reference to database.

			

			Redirect::to('quesstionarePages/success.php');

			die();	

									

      

        }

    }

} elseif($_GET['step'] == 4.9) {

	$_SESSION["stage"] = 4.9;

if(Input::exists()) {

    if(Token::check(Input::get('token'))) {



        $validate = new Validate();

        $validation = $validate->check($_POST, array(

            'fname' => array(

					'required' => true,

					'min' => 3,

					'max' => 64

				),

			 'lname' => array(

					'required' => true,

					'min' => 3,

					'max' => 64

				),

			 'month' => array(

					'required' => true

				),

			 'year' => array(

					'required' => true

				),

			 'day' => array(

					'required' => true

				),

				'email' => array(

					'required' => true,

					'min' => 4,

					'max' => 102

				)

        ));



			if($validate->passed()) {

						

						$dob = $_POST['month'] . '/' . $_POST['day'] . '/' . $_POST['year'];



						if($_COOKIE['Acctype'] == "Traditional IRA" || $_COOKIE['Acctype'] == "Roth IRA" || $_COOKIE['Acctype'] == "SEP IRA") {

							$acctype = "Retirement Investing";

						} else {

							$acctype = "General long-term investing";

						}

						if(strlen($_COOKIE['Acctype']) > 1) {

					

								$queries->update('userdata', $_SESSION["userid"], array(

								'fname' => $_POST['fname'],

								'lname' => $_POST['lname'],

								'email' => $_POST['email'],

								'dob' => $dob,
								'acctype' => $acctype,

								'subacctype' => $_COOKIE['Acctype'],

								'active' => 0

							));

							

						} else {

				

						$queries->update('userdata', $_SESSION["userid"], array(

								'fname' => $_POST['fname'],

								'lname' => $_POST['lname'],

								'email' => $_POST['email'],

								'dob' => $dob,

								'active' => 0

							));

							

							

						}

						



						

			$_SESSION["progress"] = $_SESSION["progress"] + 10;			

			$_SESSION['questionnum'] = $_SESSION['questionnum'] + 1;

			$_SESSION["useremail"] = $_POST['email']; // Reference to database.

			$_SESSION["stage"] = 4.8;



			Redirect::to('wizard.php?step=4.8');

			die();	

									

        } else {

            foreach($validate->errors() as $error) {

                

            }

        }

    }

}





}



if(isset($_SESSION["stage"])) {

	

	if($_GET['step'] > $_SESSION["stage"]) {
		Redirect::to('wizard.php?step=' . $_SESSION["stage"]);

		die();	

			

	}





} else {

	$_SESSION["stage"] = 1;

}

?>





<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=0.8">

  <link rel="preconnect" href="https://fonts.gstatic.com">

  <link

    href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"

    rel="stylesheet">

	<!--This Loads the Light Theme Style--> 

<link rel="stylesheet" href="https://unpkg.com/tippy.js@4/themes/light.css"/>

  <!-- font-family: 'Mulish', sans-serif; -->

  <link rel="stylesheet" href="css/style.css" />

  <link href="css/normalize.css" rel="stylesheet" type="text/css">

  <link href="css/webflow.css" rel="stylesheet" type="text/css">

  <link href="css/dob-9d4755.webflow.css" rel="stylesheet" type="text/css">

  <title>Fam</title>

  

   <style>

        .form-button {

            outline: none;

        }

        .text-field, .text-area {

            z-index: 2;

        }

        .text-field:focus + .field-label,

        .field-label.active {

            font-size: 12px;

          top: -26px;

          z-index: 3;

          background-color: white;

        }

        .text-area:focus + .area-label,

        .area-label.active {

          font-size: 12px;

          top: -10px;

          z-index: 3;

          background-color: white;

        }

        .text-field-done.active{

            width: 24px;

          height: 24px;

          opacity: 1;

        }

        .text-field.done,

        .text-area.done {

          border-color: rgba(127, 88, 226, 0.5);

        }

        </style>

		

  <style>

    .optionsData {

      display: flex;

      flex-direction: column;

    }



    .form-button {

      outline: none;

    }



    .text-field,

    .text-area {

      z-index: 2;

    }



    .text-field:focus+.field-label,

    .field-label.active {

      font-size: 12px;

      top: -26px;

      z-index: 3;

      background-color: white;

    }



    .text-area:focus+.area-label,

    .area-label.active {

      font-size: 12px;

      top: -10px;

      z-index: 3;

      background-color: white;

    }



    .text-field-done.active {

      width: 24px;

      height: 24px;

      opacity: 1;

    }



    .text-field.done,

    .text-area.done {

      border-color: rgba(5, 136, 102, 0.5);

    }



    @media screen and (max-width: 480px) {

      body {

        overflow-x: hidden;

        /* padding-left: 1.5rem !important; */

        /* padding: 0 !important; */

        /* padding-right: 1.5rem !important;  */

      }



      .wrapper {

        /* padding-left: 1.5rem;  */

        padding-top: 1rem;

      }

    }

	

	.preloader

{

position: fixed;

top: 0;

left: 0;

width: 100%;

height: 100vh;

background: #fff;

z-index: 9999;

text-align: center;

}	.preloader-icon

{

position: relative;

top: 45%;

width: 100px;

border-radius: 50%;

animation: shake 1.5s infinite;

}	@keyframes shake

{

0% { transform: translate(1px, -1px) rotate(0deg);}

10% { transform: translate(1px, -3px) rotate(-1deg);}

20% { transform: translate(1px, -5px) rotate(-3deg);}

30% { transform: translate(1px, -7px) rotate(0deg);}

40% { transform: translate(1px, -9px) rotate(1deg);}

50% { transform: translate(1px, -11px) rotate(3deg);}

60% { transform: translate(1px, -9px) rotate(0deg);}

70% { transform: translate(1px, -7px) rotate(-1deg);}

80% { transform: translate(1px, -5px) rotate(-3deg);}

90% { transform: translate(1px, -3px) rotate(0deg);}

100% { transform: translate(1px, -1px) rotate(-1deg);}

}



.lds-ripple {

  display: inline-block;

  position: relative;

  width: 80px;

  height: 80px;

  top: 40%;

}

.lds-ripple div {

  position: absolute;

  border: 4px solid black;

  opacity: 1;

  border-radius: 50%;

  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;

}

.lds-ripple div:nth-child(2) {

  animation-delay: -0.5s;

}

@keyframes lds-ripple {

  0% {

    top: 36px;

    left: 36px;

    width: 0;

    height: 0;

    opacity: 1;

  }

  100% {

    top: 0px;

    left: 0px;

    width: 72px;

    height: 72px;

    opacity: 0;

  }

}

.footer {
  text-align: center;
  width: 100%;
  position: fixed;
  bottom: 2%;
  left: 0%;
      font-size: 16px;
    line-height: 24px;
    letter-spacing: 0.03ex;
    color: #949494;
    font-family: ThicRegular;
}

  </style>

</head>



<body onLoad="InitVar()">



<?php if($_GET['step'] == 1) {?>



<div class="preloader"> <div class="lds-ripple"><div></div><div></div></div> </div>



  <div class="wrapper" style="padding-top: 75px;">

    <div class="progressBar">

      <div class="progressbarContainer">

        <progress value="20" max="100"></progress>

      </div>

      <div class="mark_icon">

        <div class="markIcon_Container">

          <img src="assets/icons/success.svg" alt="check_mark" />

        </div>

      </div>

    </div>

    <div class="content">

      <div class="logo">

        <span>fam.</span>

      </div>

      <div id="stepOne" class="mainStepOne">

        <div class="headline">

          <span>Welcome to the fam.

          </span>

        </div>

        <div class="headlineTwo">

          <span>

            Let's start by gathering some information

          </span>

        </div>

        <div class="privacyPolicy">

          <span>Investment management and advisory services are provided by Form Advisory

Group, LLC. Doing business as Fam, a registered investment adviser. By using this

website, you understand the information being presented is provided for

informational purposes only and agree to our Terms of Use and Privacy Policy</span>

        </div>

        <form role="form" action="" method="post" autocomplete="off" id="email-form" name="email-form" data-name="Email Form"

          class="form">

          <div data-animation="outin" data-hide-arrows="1" data-duration="500" data-infinite="1"

            class="form-slider w-slider">

            <div class="form-mask w-slider-mask">

              <div data-w-id="26fa41f8-9061-99a3-9a35-1773136ae599" class="form-slide w-slide">

                <div class="form-step">

                  <div class="fields-group">

                    <div class="text-field-wrapper half">



                      <input type="text" class="text-field w-input" maxlength="256" name="fname"

                        data-name="First mane" placeholder="" id="fname" required>



                      <label for="name" class="field-label">First name</label>

                      <!-- <div class="text-field-done"></div> -->

                    </div>

                    <div class="text-field-wrapper half">

                      <input required type="text" class="text-field w-input" maxlength="256" name="lname"

                        data-name="Last name" placeholder="" id="lname"><label for="name-2" class="field-label">Last

                        name</label>

                      <!-- <div class="text-field-done"></div> -->

                    </div>

                  </div>

                  <div class="form-label" style="margin-bottom: 20px; margin-left: 7px;">Date of birth</div>

                  <div class="fields-group">

                    <div class="text-field-wrapper third">

                      <!-- <input required type="text" class="text-field w-input" maxlength="256" name="Month" data-name="Month" placeholder="" id="Month"><label for="name" class="field-label">Month</label> -->

                      <input class="text-field w-input" type="number" required data-name="Month" min="1"

                        id="month" name="month" oninput="max2(this)" placeholder="" max="12" /><label for="name" class="field-label">Month</label>

                      <!-- <div class="text-field-done"></div> -->

                    </div>

                    <div class="text-field-wrapper third">



                      <input class="text-field w-input" type="number" required name="day" data-name="day" min="1"

                        id="day"  oninput="max2(this)" placeholder="" max="31" /><label for="name" class="field-label">Day</label>



                      <!-- <input required type="text" class="text-field w-input" maxlength="256" name="day" data-name="day" placeholder="" id="day" ><label for="name" class="field-label">Day</label> -->

                      <!-- <div class="text-field-done"></div> -->



                    </div>

                    <div class="text-field-wrapper third">



                      <input class="text-field w-input" type="number" required name="year" data-name="year" min="1"

                        id="year" oninput="max4(this)"  placeholder="" max="9999" /><label for="name" class="field-label">Year</label>



                      <!-- <input required type="text" class="text-field w-input" maxlength="256" name="year" data-name="Year" placeholder="" id="year"><label for="name" class="field-label">Year</label> -->

                      <!-- <div class="text-field-done"></div> -->



                    </div>

                    <div class="text-field-wrapper">

                      <input required type="email" class="text-field w-input" maxlength="256" name="email"

                        data-name="Email" oninput="ValidateEmailInput(this)" placeholder="" id="email"><label for="email" class="field-label">Email

                        Address</label>

                      <div class="text-field-done"></div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

            <button type="submit" id="getStartedBtnEnabled" class="form-next w-slider-arrow-right">Get Started</button>

            <div class="slide-nav w-slider-nav w-round"></div>

          </div>
		  
		  

        </form>

      </div>

  <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>
    </div>

    <!-- Quiz Ends -->



  </div>

  

    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f"

    type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">

  </script>

  

    <script>

    // 

    // 



$(document).ready(function() {

 

    setTimeout(function(){

       document.querySelector(".preloader").style.display = "none"

    }, 3000);

 

});







    // validations starts

    function dateChecker() {

      var dayValidate = "([1-9]|[12]\d|3[01])";

      var monthValidate = "^(0?[1-9]|1[012])$";

      var yearValidate = "/^(19[5-9]d|20[0-4]d|2050)$/";

      var days = document.getElementById('day').value;

      var months = document.getElementById('month').value;

      var years = document.getElementById('year').value;

      if (!days.match(dayValidate)) {

        // alert("Please, Enter Days  between 1 to 31 ");

        document.form1.dayId.focus();

        return false;

      }

      if (!months.match(monthValidate)) {

        // alert("Please, Enter Months in between 1 to 12 ");

        document.form1.monthId.focus();

        return false;

      }

      if (!(+years >= 1900 && +years <= 2016)) {

        // alert("Please, Enter Years in between 1900 to 2016 ");

        document.form1.yearID.focus();

        return false;

      }

    }

    // validation ends









    $(document).ready(function () {

      document.getElementById("getStartedBtnEnabled").setAttribute('disabled', true);



      let dayStatus = true;

      let monthStatus = true;

      let yearStatus = true;

      let firstNameStatus = true;

      let lastNameStatus = true;

      let emailStatus = true;



      $('.form-next').prop('disabled', true);

      $('#day').keyup(function () {

        console.log(this.value)

        if (this.value == "") {

          dayStatus = true;

        } else {

          dayStatus = false;

        }

        if (dayStatus == false && monthStatus == false && yearStatus == false && firstNameStatus == false &&

          lastNameStatus == false && emailStatus == false) {

          console.log("FALSE DAY")

          $('.form-next').prop('disabled', false);

        } else {

          $('.form-next').prop('disabled', true);

        }

      })

      //  
	  

      $('#month').keyup(function () {

        console.log(this.value)

        if (this.value == "") {

          monthStatus = true;

        } else {

          monthStatus = false;

        }

        if (dayStatus == false && monthStatus == false && yearStatus == false && firstNameStatus == false &&

          lastNameStatus == false && emailStatus == false) {

          console.log("FALSE MONTH")

          // $('.form-next').prop('disabled', false);

          $('.form-next').prop('disabled', false);

        } else {

          $('.form-next').prop('disabled', true);

        }

      })

      //  

      $('#year').keyup(function () {

        console.log(this.value)

        if (this.value == "") {

          yearStatus = true;

        } else {

          yearStatus = false;

        }

        if (dayStatus == false && monthStatus == false && yearStatus == false && firstNameStatus == false &&

          lastNameStatus == false && emailStatus == false) {

          console.log("FALSE YEAR")

          // $('.form-next').prop('disabled', false);

          $('.form-next').prop('disabled', false);

        } else {

          $('.form-next').prop('disabled', true);

        }

      })

      // First-mane 

      $('#fname').keyup(function () {

        console.log(this.value)

        if (this.value == "") {

          firstNameStatus = true;

        } else {

          firstNameStatus = false;

        }

        if (dayStatus == false && monthStatus == false && yearStatus == false && firstNameStatus == false &&

          lastNameStatus == false && emailStatus == false) {

          console.log("FALSE YEAR")

          $('.form-next').prop('disabled', false);

        } else {

          $('.form-next').prop('disabled', true);

        }

      })

      $('#lname').keyup(function () {

        console.log(this.value)

        if (this.value == "") {

          lastNameStatus = true;

        } else {

          lastNameStatus = false;

        }

        if (dayStatus == false && monthStatus == false && yearStatus == false && firstNameStatus == false &&

          lastNameStatus == false && emailStatus == false) {

          console.log("FALSE lastNameStatus")

          $('.form-next').prop('disabled', false);

        } else {

          $('.form-next').prop('disabled', true);

        }

      })

      $('#email').keyup(function () {

        console.log(this.value)

        if (this.value == "") {

          emailStatus = true;

        } else {

          emailStatus = false;

        }

        if (dayStatus == false && monthStatus == false && yearStatus == false && firstNameStatus == false &&

          lastNameStatus == false && emailStatus == false) {

          console.log("FALSE lastNameStatus")

          $('.form-next').prop('disabled', false);

        } else {

          $('.form-next').prop('disabled', true);

        }

      })

    });

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


function ValidateEmailInput(e) {
	var email = e.value;
	console.log('Checking email is value:' + email)
	if (validateEmail(email)) {
	
		$(e).siblings('.field-label').addClass('active')

        $(e).siblings('.area-label').addClass('active')

        $(e).siblings('.text-field-done').addClass('active')
		
		$(e).addClass('done')
		} else {
	  $(e).siblings('.field-label').removeClass('active')

        $(e).siblings('.area-label').removeClass('active')

        $(e).siblings('.text-field-done').removeClass('active')

        $(e).removeClass('done')

		}

}

$('.text-field, .text-area').change(function(e) {

console.log('Testing: ' + e.target.id);
	if ($(this).val().length > 0) {

	  $(this).siblings('.field-label').addClass('active')

	  $(this).siblings('.area-label').addClass('active')
	if(e.target.id !== "email") {
	  $(this).siblings('.text-field-done').addClass('active')
	  $(this).addClass('done')
	}

	} else {

	  $(this).siblings('.field-label').removeClass('active')

	  $(this).siblings('.area-label').removeClass('active')

	  $(this).siblings('.text-field-done').removeClass('active')

	  $(this).removeClass('done')

	}



})
	
function max2(input){
    if(input.value < 0) input.value=Math.abs(input.value);
    if(input.value.length > 2) input.value = input.value.slice(0, 2);
    $(input).blur(function() {
        if(input.value.length == 1) input.value=0+input.value;
        if(input.value.length == 0) input.value='01';
    });
}

function max4(input){
    if(input.value < 0) input.value=Math.abs(input.value);
    if(input.value.length > 4) input.value = input.value.slice(0, 4);
    $(input).blur(function() {
        if(input.value.length == 1) input.value=0+input.value;
        if(input.value.length == 0) input.value='01';
    });
}


  </script>

  

<?php } elseif($_GET['step'] == 2) { ?>

	

	

	 <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="30" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div  class="content">

        <div class="logo">

          <span>fam.</span>

        </div>

<!-- stepTwoStarts -->

<div id="stepTwo" class="mainStepOne">

  <div class="headline">

      <span></span>

  </div>

  <div class="headlineTwo">

      <span>

          For Additional Security Please Enable two-factor-authentication

      </span>

  </div>

  <div class="privacyPolicy">

      <span class="tippy" data-tippy-content="Your phone number is used to verify your identity and protect your info. It can also be

used to take you to where you left off.">What is two-factor-authentication?</span>

  </div>  

<?php if(isset($_GET['action'])) { 
	if($_GET['action'] == "error") {
?>
  <div class="privacyPolicy" style="color: red;">

      <span class="tippy" data-tippy-content="We only accept valid numbers with a area code of +1">Oops! Your number seems to be invalid.</span>

  </div> 
<?php } } ?> 
   <form role="form" action="" method="post" id="phoneNumberForm">

   

   <?php if(!isset($_SESSION["smscode"])) { ?>

      <label for="number" class="number-label">Mobile Number</label>

    <input id="number" type="text" name="number" oninput="checklength(this)" placeholder="(123) 456-7890" maxlength="14" >

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

    <button class="form-next w-slider-arrow-right" type="submit" id="getCodeBtn"> Get Code </button>

				<?php } ?>

									

		<?php if(isset($_SESSION["smscode"])) { ?>

   <label for="number" class="number-label">Mobile Number</label>

    <input id="number" type="text" name="number" placeholder="(123) 456-7890" maxlength="14" value="<?php echo $_SESSION["number"]; ?>" >

	

	

    <label for="code" class="number-label">Enter Code</label>

    <input id="code" type="text" name="code" placeholder="Enter Code"  >

	

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">			

	   <button class="form-next w-slider-arrow-right" type="submit" id="verifyCodeBtn"> Verify Code </button>

	   

		<?php } ?>

  </form>

  <div class="privacyPolicy" style="margin-top: 2rem;">

    <span>Investment management and advisory services are provided by Form Advisory

Group, LLC. Doing business as Fam, a registered investment adviser. By using this

website, you understand the information being presented is provided for

informational purposes only and agree to our Terms of Use and Privacy Policy.

</span>

</div>   

</div>    

</div> 

 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

</div> 



  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f"

    type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">

  </script>

  

  <!--These Loads Scripts--> 

<script src="https://unpkg.com/popper.js@1"></script>

<script src="https://unpkg.com/tippy.js@4"></script>





<!--Tippy JS Settings--> 

<script>

tippy('.tippy', {             // Use class or id

  animation: 'scale',         // See docs for more options (there are a few nice ones ðŸ˜‰)

  duration: 200,              // Duration for ToolTip Animation

  arrow: true,                // Add ToolTip Arrow

  delay: [0, 50],             // First # = delay in, second # = delay out

  arrowType: 'sharp',         // Sharp or 'round' or remove for none

  theme: 'light',             // Dark is the default

  maxWidth: 220,              // Max width in pixels for the tooltip

})

</script>



<script>



window.onload = function(){

  document.getElementById("verifyCodeBtn").setAttribute("disabled", true)

}





$("#code").change(function () {

      $("#verifyCodeBtn").attr("disabled", false);

                               });





window.onload = function(){

  document.getElementById("getCodeBtn").setAttribute("disabled", true)

}





$("#number").change(function () {

      $("#getCodeBtn").attr("disabled", false);

                                });



function checklength(input){
	console.log('length = ' + input.value.length)
    if(input.value.length > 13) {
		console.log('Over 13 :)')
		 $("#getCodeBtn").attr("disabled", false);
	} else {
			console.log('not over 13 :)')
	}

}



$("input[name='number']").keyup(function() {

  var val_old = $(this).val();

  var val = val_old.replace(/\D/g, '');

  var len = val.length;

  if (len >= 1)

    val = '(' + val.substring(0);

  if (len >= 3)

    val = val.substring(0, 4) + ') ' + val.substring(4);

  if (len >= 6)

    val = val.substring(0, 9) + '-' + val.substring(9);

  if (val != val_old)

    $(this).focus().val('').val(val);

});




</script>



<?php } elseif($_GET['step'] == 3) { ?>

	

    <style>

        .form-button {

            outline: none;

        }

        .text-field, .text-area {

            z-index: 2;

        }

        .text-field:focus + .field-label,

        .field-label.active {

            font-size: 12px;

          top: -26px;

          z-index: 3;

          background-color: white;

        }

        .text-area:focus + .area-label,

        .area-label.active {

          font-size: 12px;

          top: -10px;

          z-index: 3;

          background-color: white;

        }

        .text-field-done.active{

            width: 24px;

          height: 24px;

          opacity: 1;

        }

        .text-field.done,

        .text-area.done {

          border-color: rgba(127, 88, 226, 0.5);

        }

        .details{

          line-height: 1.5 !important;

          padding-bottom: 0.5rem;

          font-family: 'Courier New', Courier, monospace;

        }

        </style>



  <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="50" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div  class="content">

        <div class="logo">

          <span>fam.</span>

        </div>



<div id="stepThree" class="mainStepOne">

  <div class="headlineTwo">

      <span class="questionStatement">First things first, what type of account are you looking for?</span>

  </div> 

     <div class="privacyPolicy" style="margin-top: 0rem;">

       <span></span>

     </div>   

    <div id="options" class="options">

      <label id="initialRadioOneContainer" class="optionContainer">

          <!-- <input  id="initialRadioOne" type="radio" name="ques" > -->

          <div class="iconContainer" data-trippy-content="test">

            <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

              <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

              </svg>

          </div>

          <div class="title">

            General long-term investing

          </div>

          </label>

          <label id="initialRadioTwoContainer" class="optionContainer">

            <!-- <input id="initialRadioOne" type="radio" name="ques" > -->

            <div class="iconContainer">

              <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                </svg>

            </div>

            <div class="title">

              Retirement investing

            </div>

            </label>

    </div>

    <!-- stepThreeOne satarts -->

    <div id="innerStepsContainer" class="innerStepsContainer">

      

      <!-- stepThreeOne ends -->

      <!-- stepThreeTwo starts -->

       

    </div>

   

<!-- Quiz Ends -->

</div> 

</div> 

 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

</div> 



<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<!-- <script src="./initialCheckbox.js"></script> -->



  <!--These Loads Scripts--> 

<script src="https://unpkg.com/popper.js@1"></script>

<script src="https://unpkg.com/tippy.js@4"></script>





<!--Tippy JS Settings--> 

<script>

tippy('.tippy', {             // Use class or id

  animation: 'scale',         // See docs for more options (there are a few nice ones ðŸ˜‰)

  duration: 200,              // Duration for ToolTip Animation

  arrow: true,                // Add ToolTip Arrow

  delay: [0, 50],             // First # = delay in, second # = delay out

  arrowType: 'sharp',         // Sharp or 'round' or remove for none

  theme: 'light',             // Dark is the default

  maxWidth: 220,              // Max width in pixels for the tooltip

})

</script>



<script>





function checks(elem){

  console.log("CHECKS")

Array.from(elem.querySelectorAll(".optionContainer")).forEach(function(label){

  console.log(label)

      if(label.querySelector("input").checked){

          label.style.backgroundColor = "rgba(5,136,102, 0.8)";

          label.style.color = "white";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "white";

      }

      else{

          label.style.backgroundColor = "#F6F7FA";

          label.style.color = "#949494";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "#949494";

        }

    })

}



document.getElementById("initialRadioOneContainer").addEventListener("click", function(){

// styling outerBoxes

const step = `<form action = "wizard.php" id="stepThreeInnerOne" class="mainStepOne">

        <div class='headlineTwo'>

            <span class='questionStatement'>General Long Term Investement?

            </span>

           </div> 

           <div class="privacyPolicy" style="margin-top: 0rem;">

             <span>A long-term investment is an account a company plans to keep for at least a year such as stocks, bonds, real estate, and cash.

            </span>

        </div>   

		  <input type="hidden" id="step" name="step" value="3">		

           <div id="options" class="options">

            <label class="optionContainer">

                <input type="radio" name="oques1" >

                <div class="iconContainer">

                  <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                    <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                    </svg>

                </div>

                <div class="optionsData" style="margin-left:1.1rem;"> 

                        <div class="opt">

                          Individual

                        </div>

                        <div class="info">

                        An individual account helps you build long-term wealth alongside your 401(k)s and

IRAs. These accounts are taxable but you can withdraw money any time without a

penalty. It also represents single ownership.

                        </div>

                        <div class="details">

                    

                        </div>

                </div>

                </label>

            <label class="optionContainer">

                <input type="radio" name="oques2" >

                <div class="iconContainer">

                  <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                    <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                    </svg>

                </div>

                <div class="optionsData">

                  <div class="opt">

                    Joint

                  </div>

                  <div class="info">

                 An account that shares the functionality of an individual account but can be opened

with more than one owner. We typically see these types of accounts with couples,

business partners, or aging parents who need their adult children to handle their

investments.

                  </div>

                  <div class="details">

                    Joint accounts can only be managed by the primary account holder. Shared account access is coming in the future.

                  </div>

                </div>

                </label>



           </div> 

		   <input type="hidden" id="whattype" name="whattype" value="glti">		

		   <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">			

           <button type="submit" class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

        </form>`;



        document.getElementById("innerStepsContainer").innerHTML = step;



  // disabling button

  document.getElementById("stepThreeInnerOne").querySelector("button").setAttribute("disabled", true);



    document.getElementById("initialRadioOneContainer").style.backgroundColor = "rgba(5,136,102, 0.8)";

    document.getElementById("initialRadioOneContainer").style.color = "#FCFCFC";

    document.getElementById("initialRadioOneContainer").querySelector(".iconSimple").style.fill = "#F6F7FA";

// 2nd

    document.getElementById("initialRadioTwoContainer").style.backgroundColor = "#F6F7FA";

    document.getElementById("initialRadioTwoContainer").style.color = "#949494";

    document.getElementById("initialRadioTwoContainer").querySelector(".iconSimple").style.fill = "#949494";

// handling inner

    

    $("input:radio").change(function () {

    console.log("CHANGED");

    console.log($("#nextBtn"));

      $("#nextBtn").attr("disabled", false);

      checks(document.getElementById("stepThreeInnerOne"));

                                       });

})



document.getElementById("initialRadioTwoContainer").addEventListener("click", function(){



  const step = `<form role="form" action="" method="post" id="stepThreeInnerTwo" class="mainStepOne">

        <div class="headlineTwo">

            <span class="questionStatement">Retirement investing

            </span>

           </div> 

           <div class="privacyPolicy" style="margin-top: 0rem;">

             <span>Tax-advantaged accounts for money you won't need before your 60th birthday.

            </span>

        </div>   

           <div id="options" class="options">

            <label class="optionContainer">

                <input type="radio" name="ques1" >

                <div class="iconContainer">

                  <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                    <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                    </svg>

                </div>

                <div class="optionsData">

                        <div class="opt">

                          Traditional IRA

                        </div>

                        <div class="info">

                        A retirement account that helps you save for retirement while lowering your tax bill.

You won't pay taxes on earnings until you make withdrawals, and some contributions

may be tax-deductible.



                        </div>

                        <div class="details">

                          Tax deductions depend on your income and whether you have an employer-sponsored retirement plan.

                        </div>

                </div>

                </label>

            <label class="optionContainer">

                <input type="radio" name="ques2" >

                <div class="iconContainer">

                  <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                    <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                    </svg>

                </div>

                <div class="optionsData">

                  <div class="opt">

                    Roth IRA

                  </div>

                  <div class="info">

                  A retirement account that also helps you save for retirement, but is simply taxed

differently. When you open a Roth IRA, contributions and any earnings grow tax-free

and qualified withdrawals can be taken tax-free

                  </div>

                  <div class="details">

                  </div>

                </div>

                </label>

            <label class="optionContainer">

                <input type="radio" name="ques3" >

                <div class="iconContainer">

                  <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                    <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                    </svg>

                </div>

                <div class="optionsData">

                  <div class="opt">

                     SEP IRA

                  </div>

                  <div class="info">

                  This is the perfect retirement account for those who are self-employed. The simplest

of all plans to administer, a SEP IRA lets you make sizable contributions for yourself

and eligible employees. You can vary contributions from year to year, and even skip a

year.



                  </div>

                  <div class="details">

                  </div>

                </div>

                </label>

           </div> 

		

		    <input type="hidden" name="token" id="whattype" name="whattype" value="ri">	

		   <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">			

           <button type="submit"  class="form-next w-slider-arrow-right clickableBtn"> Next </button>

        </form> 
		
		 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

  `;



  document.getElementById("innerStepsContainer").innerHTML = step;



  // disabling button

  document.getElementById("stepThreeInnerTwo").querySelector(".clickableBtn").setAttribute("disabled", true);



// styling outerBoxes

  document.getElementById("initialRadioTwoContainer").style.backgroundColor = "rgba(5,136,102, 0.8)";

  document.getElementById("initialRadioTwoContainer").style.color = "#FCFCFC";

  document.getElementById("initialRadioTwoContainer").querySelector(".iconSimple").style.fill = "#F6F7FA";

// 2nd

  document.getElementById("initialRadioOneContainer").style.backgroundColor = "#F6F7FA";

  document.getElementById("initialRadioOneContainer").style.color = "#949494";

  document.getElementById("initialRadioOneContainer").querySelector(".iconSimple").style.fill = "#949494";

  //handling inner



  // Array.from(document.getElementById("stepThreeInnerOne").querySelector("#options").querySelectorAll("label")).forEach(function(label){

  //    label.querySelector("input").checked = false;

  //    console.log( label.querySelector("input").checked);

  // })



  $("input:radio").change(function () {

    console.log("CHANGEd");

    console.log($("#nextBtn"));

      $(".clickableBtn").attr("disabled", false);

      checks(document.getElementById("stepThreeInnerTwo"));

                                      });



})



</script>



<?php } elseif($_GET['step'] == 4) { ?>



<style>

        .form-button {

            outline: none;

        }

        .text-field, .text-area {

            z-index: 2;

        }

        .text-field:focus + .field-label,

        .field-label.active {

            font-size: 12px;

          top: -26px;

          z-index: 3;

          background-color: white;

        }

        .text-area:focus + .area-label,

        .area-label.active {

          font-size: 12px;

          top: -10px;

          z-index: 3;

          background-color: white;

        }

        .text-field-done.active{

            width: 24px;

          height: 24px;

          opacity: 1;

        }

        .text-field.done,

        .text-area.done {

          border-color: rgba(127, 88, 226, 0.5);

        }

        </style>

		

		

 <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="50" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div  class="content">

        <div class="logo">

          <span>fam.</span>

        </div>



<div id="stepThree" class="mainStepOne">

    <form role="form" action="" method="post"  id="ques1" class="questionWrapper">

      <div class="qhead">

	  <?php $getus = $queries->getWhere('userdata', array('id', '=', $_SESSION["userid"])); ?>

        <span>Thanks <?php echo ucfirst($getus[0]->fname); ?>, next we need to get to you as an investor.</span>

      </div>

        <p class="qinfo">You'll answer 9 straightforward questions about your goals' time horizon and risk

profile. We'll recommend a portfolio based on your responses. From there it's easy to

sign up and fund your account.

        </p>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <button type="submit"  class="form-next w-slider-arrow-right" id="nextSec1"> Next </button>

      </form>

</div> 

</div> 

 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

</div> 



<?php } elseif($_GET['step'] == 4.1) { ?>



 <style>

        .form-button {

            outline: none;

        }

        .text-field, .text-area {

            z-index: 2;

        }

        .text-field:focus + .field-label,

        .field-label.active {

            font-size: 12px;

          top: -26px;

          z-index: 3;

          background-color: white;

        }

        .text-area:focus + .area-label,

        .area-label.active {

          font-size: 12px;

          top: -10px;

          z-index: 3;

          background-color: white;

        }

        .text-field-done.active{

            width: 24px;

          height: 24px;

          opacity: 1;

        }

        .text-field.done,

        .text-area.done {

          border-color: rgba(127, 88, 226, 0.5);

        }

        </style>

		

		  <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="60" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div  class="content">

        <div class="logo">

          <span>fam.</span>

        </div>



<div id="stepThree" class="mainStepOne">

     <form role="form" action="" method="post" id="ques2" class="questionWrapper" >

        <div class="qhead" >

              <span>What will your household income be this year?</span>

        </div>      

              <p class="qinfo">This helps us recommend how much should save monthly to reach your goal. An

estimate is fine.

              </p>

              <label for="amount1" class="number-label">Household income (before taxes)</label>

			   <input type="text" id="amount1" name="amount1" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$25,000">

			   

      

			  	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

              <button type="submit" class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

            </form>

</div> 

</div> 

 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

</div> 





 <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>







<script>

window.onload = function(){

  document.getElementById("nextBtn").disabled = true;

}

      document.querySelector("input").addEventListener("input", function(e){

          if(e.target.value){

              document.getElementById("nextBtn").disabled = false;

          }

          else{

            document.getElementById("nextBtn").disabled = true;

          }

      });



</script>

		

		<script>

// Jquery Dependency



$("input[data-type='currency']").on({

    keyup: function() {

      formatCurrency($(this));

    },

    blur: function() { 

      formatCurrency($(this), "blur");

    }

});





function formatNumber(n) {

  // format number 1000000 to 1,234,567

  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")

}





function formatCurrency(input, blur) {

  // appends $ to value, validates decimal side

  // and puts cursor back in right position.

  

  // get input value

  var input_val = input.val();

  

  // don't validate empty input

  if (input_val === "") { return; }

  

  // original length

  var original_len = input_val.length;



  // initial caret position 

  var caret_pos = input.prop("selectionStart");

    

  // check for decimal

  if (input_val.indexOf(".") >= 0) {



    // get position of first decimal

    // this prevents multiple decimals from

    // being entered

    var decimal_pos = input_val.indexOf(".");



    // split number by decimal point

    var left_side = input_val.substring(0, decimal_pos);

    var right_side = input_val.substring(decimal_pos);



    // add commas to left side of number

    left_side = formatNumber(left_side);



    // validate right side

    right_side = formatNumber(right_side);

    

    // On blur make sure 2 numbers after decimal

    if (blur === "blur") {

      right_side += "00";

    }

    

    // Limit decimal to only 2 digits

    right_side = right_side.substring(0, 2);



    // join number by .

    input_val = "$" + left_side + "." + right_side;



  } else {

    // no decimal entered

    // add commas to number

    // remove all non-digits

    input_val = formatNumber(input_val);

    input_val = "$" + input_val;

    

    // final formatting

    if (blur === "blur") {

      input_val += ".00";

    }

  }

  

  // send updated string to input

  input.val(input_val);



  // put caret back in the right position

  var updated_len = input_val.length;

  caret_pos = updated_len - original_len + caret_pos;

  input[0].setSelectionRange(caret_pos, caret_pos);

}



	

	</script>

	

	

<?php } elseif($_GET['step'] == 4.2) { ?>





  <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="65" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div  class="content">

        <div class="logo">

          <span>fam.</span>

        </div>



<div id="stepThree" class="mainStepOne">

     <form role="form" action="" method="post" id="ques3" class="questionWrapper">

        <div class="qhead">

              <span>How much money do you have saved this year?</span>

        </div>          

              <p class="qinfo">Add up your checking and savings accounts and investment portfolios you have out

there. An estimate is fine</p>

              <label for="amount1" class="number-label">Total savings and investments</label>

               <input type="text" id="amount1" name="amount1" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$25,000">

			   	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

              <button type="submit" class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

            </form>

</div> 

</div> 

 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

</div> 





 <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>







<script>

  window.onload = function(){

    document.getElementById("nextBtn").disabled = true;

  }

        document.querySelector("input").addEventListener("input", function(e){

            if(e.target.value){

                document.getElementById("nextBtn").disabled = false;

            }

            else{

              document.getElementById("nextBtn").disabled = true;

            }

        });

  

  </script>

  

  		<script>

// Jquery Dependency



$("input[data-type='currency']").on({

    keyup: function() {

      formatCurrency($(this));

    },

    blur: function() { 

      formatCurrency($(this), "blur");

    }

});





function formatNumber(n) {

  // format number 1000000 to 1,234,567

  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")

}





function formatCurrency(input, blur) {

  // appends $ to value, validates decimal side

  // and puts cursor back in right position.

  

  // get input value

  var input_val = input.val();

  

  // don't validate empty input

  if (input_val === "") { return; }

  

  // original length

  var original_len = input_val.length;



  // initial caret position 

  var caret_pos = input.prop("selectionStart");

    

  // check for decimal

  if (input_val.indexOf(".") >= 0) {



    // get position of first decimal

    // this prevents multiple decimals from

    // being entered

    var decimal_pos = input_val.indexOf(".");



    // split number by decimal point

    var left_side = input_val.substring(0, decimal_pos);

    var right_side = input_val.substring(decimal_pos);



    // add commas to left side of number

    left_side = formatNumber(left_side);



    // validate right side

    right_side = formatNumber(right_side);

    

    // On blur make sure 2 numbers after decimal

    if (blur === "blur") {

      right_side += "00";

    }

    

    // Limit decimal to only 2 digits

    right_side = right_side.substring(0, 2);



    // join number by .

    input_val = "$" + left_side + "." + right_side;



  } else {

    // no decimal entered

    // add commas to number

    // remove all non-digits

    input_val = formatNumber(input_val);

    input_val = "$" + input_val;

    

    // final formatting

    if (blur === "blur") {

      input_val += ".00";

    }

  }

  

  // send updated string to input

  input.val(input_val);



  // put caret back in the right position

  var updated_len = input_val.length;

  caret_pos = updated_len - original_len + caret_pos;

  input[0].setSelectionRange(caret_pos, caret_pos);

}



	

	</script>

  <?php } elseif($_GET['step'] == 4.21) { ?>

  

  

  <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="65" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div  class="content">

        <div class="logo">

          <span>fam.</span>

        </div>



<div id="stepThree" class="mainStepOne">

     <form role="form" action="" method="post" id="ques3" class="questionWrapper">

        <div class="qhead">

              <span>What's the value of your debts?</span>

        </div>          

              <p class="qinfo">This is what you owe. Add up the value of your loans and mortgages, and what you

owe on your credit cards. An estimate will work.

</p>

              <label for="amount1" class="number-label">Total savings and investments</label>

               <input type="text" id="amount1" name="amount1" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$25,000">

			   	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

              <button type="submit" class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

            </form>

</div> 

</div> 

 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

</div> 





 <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>







<script>

  window.onload = function(){

    document.getElementById("nextBtn").disabled = true;

  }

        document.querySelector("input").addEventListener("input", function(e){

            if(e.target.value){

                document.getElementById("nextBtn").disabled = false;

            }

            else{

              document.getElementById("nextBtn").disabled = true;

            }

        });

  

  </script>

  

  		<script>

// Jquery Dependency



$("input[data-type='currency']").on({

    keyup: function() {

      formatCurrency($(this));

    },

    blur: function() { 

      formatCurrency($(this), "blur");

    }

});





function formatNumber(n) {

  // format number 1000000 to 1,234,567

  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")

}





function formatCurrency(input, blur) {

  // appends $ to value, validates decimal side

  // and puts cursor back in right position.

  

  // get input value

  var input_val = input.val();

  

  // don't validate empty input

  if (input_val === "") { return; }

  

  // original length

  var original_len = input_val.length;



  // initial caret position 

  var caret_pos = input.prop("selectionStart");

    

  // check for decimal

  if (input_val.indexOf(".") >= 0) {



    // get position of first decimal

    // this prevents multiple decimals from

    // being entered

    var decimal_pos = input_val.indexOf(".");



    // split number by decimal point

    var left_side = input_val.substring(0, decimal_pos);

    var right_side = input_val.substring(decimal_pos);



    // add commas to left side of number

    left_side = formatNumber(left_side);



    // validate right side

    right_side = formatNumber(right_side);

    

    // On blur make sure 2 numbers after decimal

    if (blur === "blur") {

      right_side += "00";

    }

    

    // Limit decimal to only 2 digits

    right_side = right_side.substring(0, 2);



    // join number by .

    input_val = "$" + left_side + "." + right_side;



  } else {

    // no decimal entered

    // add commas to number

    // remove all non-digits

    input_val = formatNumber(input_val);

    input_val = "$" + input_val;

    

    // final formatting

    if (blur === "blur") {

      input_val += ".00";

    }

  }

  

  // send updated string to input

  input.val(input_val);



  // put caret back in the right position

  var updated_len = input_val.length;

  caret_pos = updated_len - original_len + caret_pos;

  input[0].setSelectionRange(caret_pos, caret_pos);

}



	

	</script>

  

 <?php } elseif($_GET['step'] == 4.3) { ?>

 
   <style>

      .optionsData{

        display: flex;

        flex-direction: column;

      }

        .form-button {

            outline: none;

        }

        .text-field, .text-area {

            z-index: 2;

        }

        .text-field:focus + .field-label,

        .field-label.active {

            font-size: 12px;

          top: -26px;

          z-index: 3;

          background-color: white;

        }

        .text-area:focus + .area-label,

        .area-label.active {

          font-size: 12px;

          top: -10px;

          z-index: 3;

          background-color: white;

        }

        .text-field-done.active{

            width: 24px;

          height: 24px;

          opacity: 1;

        }

        .text-field.done,

        .text-area.done {

          border-color: rgba(127, 88, 226, 0.5);

        }

        </style>

 <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="70" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div class="content">

        <div class="logo">

          <span>fam.</span>

        </div>

        <form role="form" action="" method="post" id="stepThree" class="mainStepOne">

            <div class="headlineTwo">

                <span class="questionStatement">How much do you know about investing?

                </span>

               </div> 

              

               <div id="options" class="options">

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('I am new to investing')"  >

                    <div class="iconContainer">

                      <svg class="iconSimple"  id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>I'm new to investing

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('I understand the basics')">

                    <div class="iconContainer">

                      <svg class="iconSimple"  id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>I understand the basics

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques"   onclick="GetVar('I hve got a good understanding')">

                    <div class="iconContainer">

                      <svg class="iconSimple"  id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>I have got a good understanding

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques"  onclick="GetVar('I am an investment expert')">

                    <div class="iconContainer">

                      <svg class="iconSimple"  id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>I am an investment expert

                    </label>

               </div> 

			   	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

               <button type="submit" disabled class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

            </form> 

        </div> 

        <!-- Quiz Ends -->

    <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div> 

</div> 



<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>



<script src="js/quizs.js"></script>









<script>



function GetVar(e) {

	

	document.cookie="GetVar=" + e;

	

}





$("input:radio").change(function () {

      $("#nextBtn").attr("disabled", false);

      checks();



                                          });

function checks(){

Array.from(document.querySelectorAll(".optionContainer")).forEach(function(label){

      if(label.querySelector("input").checked){

          label.style.backgroundColor = "rgba(5,136,102, 0.8)";

          label.style.color = "white";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "white";

      }

      else{

          label.style.backgroundColor = "#F6F7FA";

          label.style.color = "#949494";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "#949494";

        }

    })

}

</script>



 <?php } elseif($_GET['step'] == 4.4) { ?>



 <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="75" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div class="content">

        <div class="logo">

          <span>fam.</span>

        </div>

        <div id="stepThree" class="mainStepOne questionStep5">

             <form role="form" action="" method="post">

            <div class="headlineTwo">

                <span class="questionStatement">Next, lets look at what might be keeping you from your best financial self?

                </span>

               </div> 

               <div class="privacyPolicy" style="margin-top: 0rem;">

                 <span>You might relate to more than one answer. Select the one hat best fits you.

                </span>

               </div>   

               <div id="options" class="options">

                <label class="optionContainer">

                    <input id="checkbox" type="checkbox" name="ques"  onclick="GetVar(1, 'I dont have time to research all the financial products available to me and manage my investment portfolio.')">

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>I don't have time to research all the financial products available to me and manage my investment portfolio.

                    </label>

                    <label class="optionContainer">

                        <input id="checkbox" type="checkbox" name="ques" onclick="GetVar(2, 'I dont understand what products are right for my goals or how to make a comprehensive investment strategy.')">

                        <div class="iconContainer">

                          <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                            <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                            </svg>

                        </div>I don't understand what products are right for my goals or how to make a comprehensive investment strategy.

                        </label>

                        <label class="optionContainer">

                            <input id="checkbox" type="checkbox" name="ques" onclick="GetVar(3, 'There are other things in my life Id rather obsess over other than the daily maintenance of my finances.')" >

                            <div class="iconContainer">

                              <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                                <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                                </svg>

                            </div>There are other things in my life I'd rather obsess over other than the daily maintenance of my finances.

                            </label>

                            <label class="optionContainer">

                                <input id="checkbox" type="checkbox" name="ques"  onclick="GetVar(4, 'I dont feel confident making financial and investment decisions on my own and taking responsibility for them.')">

                                <div class="iconContainer">

                                  <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                                    <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                                    </svg>

                                </div>I don't feel confident making financial and investment decisions on my own and taking responsibility for them.

                                </label>

                                <label class="optionContainer">

                                    <input id="checkbox" type="checkbox" name="ques" onclick="GetVar(5, 'Ive recently experienced a major life event like: buying a home, getting married or divorced, the birth of a child, or a death in the family.')">

                                    <div class="iconContainer">

                                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                                        </svg>

                                    </div>I've recently experienced a major life event like: buying a home, getting married or divorced, the birth of a child, or a death in the family.

                                    </label>

                                <label class="optionContainer">

                                    <input id="checkbox" type="checkbox" name="ques" onclick="GetVar(6, 'Id like to have greater peace of mind that my finances are in order for the sake of my family.')">

                                    <div class="iconContainer">

                                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                                        </svg>

                                    </div>I'd like to have greater peace of mind that my finances are in order for the sake of my family.

                                    </label>

									

									    <label class="optionContainer">

                                    <input id="checkbox" type="checkbox" name="ques" onclick="GetVar(7, 'I have a lot of assets to keep track of and/or my financial goals are getting a bitmore complicated.')">

                                    <div class="iconContainer">

                                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                                        </svg>

                                    </div>I have a lot of assets to keep track of and/or my financial goals are getting a bit

more complicated.

                                    </label>

									

               </div> 

			   	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

               <button type="submit" disabled class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

            </form> 

        </div>

        </div> 

        <!-- Quiz Ends -->

    <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div> 

</div> 





<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>





 <script>





	var Ques1 = "notset";

	var Ques2 = "notset";

	var Ques3 = "notset";

	var Ques4 = "notset";

	var Ques5 = "notset";

	var Ques6 = "notset";

	var Ques7 = "notset";

	

	console.log('set vars :)');





function GetVar(i, e) {

	

	if(i == 1) {

		if( Ques1 == "set") {

			console.log('Unsetting because already set');

			Ques1 = "notset";

		} else {

			document.cookie="Ques1=" + e;

			Ques1 = "set";

			console.log('setting object cause not set');

		}

	} else if(i == 2) {

			console.log('NUmber 2 clicked');

		if( Ques2 == "set") {

			console.log('Unsetting because already set');

			Ques2 = "notset";

		} else {

			document.cookie="Ques2=" + e;

			Ques2 = "set";

			console.log('setting object cause not set');

		}

	} else if(i == 3) {

			console.log('NUmber 3 clicked');

		if( Ques3 == "set") {

			console.log('Unsetting because already set');

			Ques3 = "notset";

		} else {

			document.cookie="Ques3=" + e;

			Ques3 = "set";

			console.log('setting object cause not set');

		}

	} else if(i == 4) {

			console.log('NUmber 4 clicked');

		if( Ques4 == "set") {

			console.log('Unsetting because already set');

			Ques4 = "notset";

		} else {

			document.cookie="Ques4=" + e;

			Ques4 = "set";

			console.log('setting object cause not set');

		}

	} else if(i == 5) {

			console.log('NUmber 5 clicked');

		if( Ques5 == "set") {

			console.log('Unsetting because already set');

			Ques5 = "notset";

		} else {

			document.cookie="Ques5=" + e;

			Ques5 = "set";

			console.log('setting object cause not set');

		}

	} else if(i == 6) {

			console.log('NUmber 6 clicked');

		if( Ques6 == "set") {

			console.log('Unsetting because already set');

			Ques6 = "notset";

		} else {

			document.cookie="Ques6=" + e;

			Ques6 = "set";

			console.log('setting object cause not set');

		}

	} else if(i == 7) {

			console.log('NUmber 7 clicked');

		if( Ques7 == "set") {

			console.log('Unsetting because already set');

			Ques7 = "notset";

		} else {

			document.cookie="Ques7=" + e;

			Ques7 = "set";

			console.log('setting object cause not set');

		}

	}

	

}







$("input:checkbox").change(function () {

      $("#nextBtn").attr("disabled", false);

      checks();

                                          });

function checks(){

Array.from(document.querySelectorAll(".optionContainer")).forEach(function(label){

      if(label.querySelector("input").checked){

          label.style.backgroundColor = "rgba(5,136,102, 0.8)";

          label.style.color = "white";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "white";

      }

      else{

          label.style.backgroundColor = "#F6F7FA";

          label.style.color = "#949494";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "#949494";

        }

    })

}



</script>





 <?php } elseif($_GET['step'] == 4.5) { ?>





  <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="80" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div class="content">

        <div class="logo">

          <span>fam.</span>

        </div>

        <div id="stepThree" class="mainStepOne questionStep5">

                     <form role="form" action="" method="post">

            <div class="headlineTwo">

                <span class="questionStatement">What is your biggest concern when you think about investing?

                </span>

               </div> 

              

               <div id="options" class="options">

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('I need help prioritizing and balancing financial goals.')">

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>I need help prioritizing and balancing financial goals

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('I need to start saving and learn how to make my money work for me.')">

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>I need to start saving and learn how to make my money work for me.

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques"  onclick="GetVar('I want to start investing for retirement and need to make sure I'm setting myself

up right.')">

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>I want to start investing for retirement and need to make sure I'm setting myself

up right.



                    </label>

               

               </div> 

			      	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

               <button type="submit" disabled class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

            </form> 

        </div>

        </div> 

        <!-- Quiz Ends -->

     <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

</div> 





<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>





<script>



function GetVar(e) {

	

	document.cookie="Ques=" + e;

	

}





$("input:radio").change(function () {

      $("#nextBtn").attr("disabled", false);

      checks();

                                          });

function checks(){

Array.from(document.querySelectorAll(".optionContainer")).forEach(function(label){

      if(label.querySelector("input").checked){

          label.style.backgroundColor = "rgba(5,136,102, 0.8)";

          label.style.color = "white";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "white";

      }

      else{

          label.style.backgroundColor = "#F6F7FA";

          label.style.color = "#949494";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "#949494";

        }

    })

}





</script>



 <?php } elseif($_GET['step'] == 4.6) { ?>

 

 <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="90" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div class="content">

        <div class="logo">

          <span>fam.</span>

        </div>

        <div id="stepThree" class="mainStepOne questionStep5">

          <form role="form" action="" method="post">

            <div class="headlineTwo">

                <span class="questionStatement">When deciding how to invest your money, which do you care about more?

                </span>

               </div> 

             

               <div id="options" class="options">

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('Maximizing gains.')">

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>Maximizing gains.

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques"onclick="GetVar('Minimizing losses.')" >

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>Minimizing losses.

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('Both equally.')" >

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>Both equally.

                    </label>

               </div> 

			   <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

               <button type="submit" disabled class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

            </form> 

        </div>

        </div> 

        <!-- Quiz Ends -->

     <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>

</div> 



<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>





<script>





function GetVar(e) {

	

	document.cookie="Ques=" + e;

	

}









$("input:radio").change(function () {

      $("#nextBtn").attr("disabled", false);

      checks();

                                          });

function checks(){

Array.from(document.querySelectorAll(".optionContainer")).forEach(function(label){

      if(label.querySelector("input").checked){

          label.style.backgroundColor = "rgba(5,136,102, 0.8)";

          label.style.color = "white";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "white";

      }

      else{

          label.style.backgroundColor = "#F6F7FA";

          label.style.color = "#949494";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "#949494";

        }

    })

}



</script>



 <?php } elseif($_GET['step'] == 4.7) { ?>

 

  <div class="wrapper" style="padding-top: 75px;">

        <div class="progressBar">

            <div class="progressbarContainer">

              <progress value="100" max="100"></progress>

            </div>

            <div class="mark_icon">

              <div class="markIcon_Container">

                <img src="assets/icons/success.svg" alt="check_mark" />

              </div>

            </div>

        </div>

        <div class="content">

        <div class="logo">

          <span>fam.</span>

        </div>

        <div id="stepThree" class="mainStepOne questionStep5">

               <form role="form" action="" method="post">

            <div class="headlineTwo">

                <span class="questionStatement">If the stock market were to crash tomorrow, how would you respond?

                </span>

               </div> 

              

               <div id="options" class="options">

                <label class="optionContainer">

                    <input type="radio" name="ques"  onclick="GetVar('Sell everything.')">

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>Sell everything.

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('Sell some of my investment.')">

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>Sell some of my investment.

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('Buy more.')">

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>Buy more.

                    </label>

                <label class="optionContainer">

                    <input type="radio" name="ques" onclick="GetVar('Sit tight and ride it out.')" >

                    <div class="iconContainer">

                      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">

                        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>

                        </svg>

                    </div>Sit tight and ride it out.

                    </label>

               </div> 

			   	   <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

               <button type="submit" disabled class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>

            </form> 

        </div>

        </div> 

        <!-- Quiz Ends -->
 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>
    

</div> 





<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>



<script>



function GetVar(e) {

	

	document.cookie="Ques=" + e;

	

}





$("input:radio").change(function () {

      $("#nextBtn").attr("disabled", false);

      checks();

                                          });

function checks(){

Array.from(document.querySelectorAll(".optionContainer")).forEach(function(label){

      if(label.querySelector("input").checked){

          label.style.backgroundColor = "rgba(5,136,102, 0.8)";

          label.style.color = "white";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "white";

      }

      else{

          label.style.backgroundColor = "#F6F7FA";

          label.style.color = "#949494";

          label.querySelector(".iconContainer").getElementsByTagName("svg")[0].style.fill = "#949494";

        }

    })

}

</script>





 <?php } elseif($_GET['step'] == 4.8) {



 $GetDetails = $queries->getWhere('userdata', array('id', '=', $_SESSION["userid"]));// get user details from database - use database instead of session vars here for accurancy incase user is returning from leaving browser.

				 $dob = explode("/", $GetDetails[0]->dob);

												  

	 ?>

 

     <style>

      .optionsData{

        display: flex;

        flex-direction: column;

      }

        .form-button {

            outline: none;

        }

        .text-field, .text-area {

            z-index: 2;

        }

        .text-field:focus + .field-label,

        .field-label.active {

            font-size: 12px;

          top: -26px;

          z-index: 3;

          background-color: white;

        }

        .text-area:focus + .area-label,

        .area-label.active {

          font-size: 12px;

          top: -10px;

          z-index: 3;

          background-color: white;

        }

        .text-field-done.active{

          width: 24px;

          height: 24px;

          opacity: 1;

        }

        .text-field.done,

        .text-area.done {

          border-color: rgba(127, 88, 226, 0.5);

        }

        .formBtnContainer{

            width: 100%;

            display: flex;

            flex-direction: column;

            margin: 0;

        }

        #confirmDetails{

            width: 100%;

            margin: 0;

            margin-bottom: 1rem;

        }

       #makeChanges{

        width: 100%;

        margin: 0;

        margin-bottom: 1rem;

       }

       @media screen and (max-width: 480px) {

        body{

          overflow-x: hidden;

          /* padding-left: 1.5rem !important; */

          /* padding: 0 !important; */

          /* padding-right: 1.5rem !important;  */

        } 

        .wrapper{

           /* padding-left: 1.5rem;  */

           padding-top: 1rem; 

        }

        .content{

          margin-top: 1rem !important;

        }

      }

        

        </style>

		

  <div class="wrapper" style="padding-top: 75px;">

      

        <div class="content">

        <div class="logo">

            <span>fam.</span>

        </div>

        <div id="stepOne" class="mainStepOne">

            <div class="headline">

                <span>All done! You're one step closer to join the Fam

                </span>

            </div>

            <div class="headlineTwo">

                <span>

                    Confirm your details

                </span>

            </div>

            <div class="privacyPolicy">

                <span>Please take a moment to make sure all of your information is correct.</span>

            </div>     

             <form role="form" action="" method="post" autocomplete="off" id="email-form" name="email-form" data-name="Email Form" class="form">

              <div data-animation="outin" data-hide-arrows="1" data-duration="500" data-infinite="1" class="form-slider w-slider">

                <div class="form-mask w-slider-mask">

                  <div data-w-id="26fa41f8-9061-99a3-9a35-1773136ae599" class="form-slide w-slide">

                    <div class="form-step">

                      <div class="fields-group">

                        <div class="text-field-wrapper half">

                          <input type="text" class="text-field w-input" maxlength="256" name="fname"   id="First-mane" required value="<?php echo $GetDetails[0]->fname; ?>" disabled >

                          <label for="name" class="field-label">&nbsp;</label>

                          <div class="text-field-done"></div>

                        </div>

                        <div class="text-field-wrapper half">

                          <input required type="text" class="text-field w-input" maxlength="256" name="lname"  id="Last-name" value="<?php echo $GetDetails[0]->lname; ?>" disabled><label for="name-2" class="field-label">&nbsp;</label>

                          <div class="text-field-done"></div>

                        </div>

                      </div>

                      <div class="form-label" style="margin-bottom: 20px; margin-left: 7px;">Date of birth</div>

                      <div class="fields-group">

                        <div class="text-field-wrapper third">

                          <input required type="text" class="text-field w-input" maxlength="256" name="month"  id="month" value="<?php echo $dob[0]; ?>" disabled><label for="name" class="field-label">&nbsp;</label>

                          <div class="text-field-done"></div>

                        </div>

                        <div class="text-field-wrapper third">

                          <input required type="text" class="text-field w-input" maxlength="256" name="day"  id="day" value="<?php echo $dob[1]; ?>" disabled ><label for="name" class="field-label">&nbsp;</label>

                          <div class="text-field-done"></div>

                        </div>

                        <div class="text-field-wrapper third">

                          <input required type="text" class="text-field w-input" maxlength="256" name="year"   id="year" value="<?php echo $dob[2]; ?>" disabled><label for="name" class="field-label" >&nbsp;</label>

                          <div class="text-field-done"></div>

                        </div>

                        <div class="text-field-wrapper">

                          <input required type="email" class="text-field w-input" maxlength="256" name="email"  id="email" value="<?php echo $GetDetails[0]->email; ?>" disabled><label for="email" class="field-label" >&nbsp;</label>

                          <div class="text-field-done"></div>

                        </div>
						
							  <div class="form-label" style="margin-bottom: 20px; margin-left: 7px;">Account type</div>
							  

                        <div class="text-field-wrapper">

                          <input required type="text" class="text-field w-input" maxlength="256" name="account-type"  id="account-type" value="<?php echo $GetDetails[0]->acctype; ?>" disabled><label for="email" class="field-label" >&nbsp;</label>

                          <div class="text-field-done"></div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

             <div class="formBtnContainer">

			    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                <button id="confirmDetails" type="submit" class="form-next w-slider-arrow-right">Confirm Details</button>

                <a id="makeChanges" href="wizard.php?step=4.9" >I'd like to make changes</a>

                <div class="slide-nav w-slider-nav w-round"></div> 

             </div>

            </div>

            </form>

        </div>

        </div> 

        <!-- Quiz Ends -->
 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>
</div> 



<?php } elseif($_GET['step'] == 4.9) { 



 $GetDetails = $queries->getWhere('userdata', array('id', '=', $_SESSION["userid"]));// get user details from database - use database instead of session vars here for accurancy incase user is returning from leaving browser.

				 $dob = explode("/", $GetDetails[0]->dob);



?>



    <style>

      .optionsData{

        display: flex;

        flex-direction: column;

      }

        .form-button {

            outline: none;

        }

        .text-field, .text-area {

            z-index: 2;

        }

        .field-label{

            /* display:none ; */

            opacity: 0;

        }

       

        .text-field-done.active{

            width: 24px;

          height: 24px;

          opacity: 1;

        }

        .text-field.done,

        .text-area.done {

          border-color: rgba(127, 88, 226, 0.5);

        }

        @media screen and (max-width: 480px) {

        body{

          overflow-x: hidden;

          /* padding-left: 1.5rem !important; */

          /* padding: 0 !important; */

          /* padding-right: 1.5rem !important;  */

        } 

        .wrapper{

           /* padding-left: 1.5rem;  */

           padding-top: 1rem; 

        }

        .content{

          margin-top: 1rem !important;

        }

      }

      /* accordian */

      .accordion {

         line-height: 1;

         /* background-color: #eee; */

         background-color: white;

         color: #444;

         cursor: pointer;

         padding: 18px;

         width: 100%;

         border: none;

         text-align: left;

         outline: none;

         font-size: 15px;

         transition: 0.4s;

         border-radius: 5px;

      }

      .active, .accordion:hover {

        background-color: #e5e6eb;

      }

.accordion:after {

        content: '\002B';

        color: #444;

        font-weight: bold;

        float: right;

        margin-left: 5px;

}

.active:after {

        content: "\2212";

}

.panel {

        width: 100% !important;

        background-color: white;

        max-height: 0;

        overflow: hidden;

        transition: max-height 0.2s ease-out;

        line-height: 1;

        transition: all 0.2s ease-out;

}

.dropdownContainer{

  width: 100%;

  height: 100%;

  padding: 0;

}

.panel1{

  /* height: 20rem !important; */

  overflow: auto;

}

.form-step{

  height: auto !important;

}

.fields-group{

  height: auto !important;

}

li{

  list-style-type: none;

  height: 3rem;

  padding: 15px 0 0px 18px;

  font-size: 15px;

  /* line-height: 2; */

  transition: all 0.2s ease-out;

  border-radius: 0;

  cursor: pointer;

  /* panel.scrollHeight + "px" */



}

li:hover{

  border-radius: 0;

  background-color:#e5e6eb;

}

#getStartedBtnEnabled{

  margin-top: 0rem;

}

        </style>

		

 <div class="wrapper" style="padding-top: 75px;">

        <div class="content">

        <div class="logo">

          <span>fam.</span>

        </div>

        <div id="stepOne" class="mainStepOne">

            <div class="headline">

                <span>The choice of a new generation.

                </span>

            </div>

            <div class="headlineTwo">

                <span>

                    Enter your Details to get started

                </span>

            </div>

            <div class="privacyPolicy">

                <span>By continuing, you agree to be evaluated for multiple Petal credit products and acknowledge and agree to Petal's Auto-dialer Authorization, Privacy Policy, and Site Terms and to be contacted at the number you enter below. Message and data rates may apply.</span>

            </div>     

             <form role="form" action="" method="post">

              <div data-animation="outin" data-hide-arrows="1" data-duration="500" data-infinite="1" class="form-slider w-slider">

                <div class="form-mask w-slider-mask">

                  <div data-w-id="26fa41f8-9061-99a3-9a35-1773136ae599" class="form-slide w-slide">

				  

				  

				  

				  

				    <div class="form-step">

                      <div class="fields-group">

                        <div class="text-field-wrapper half">

                          <input type="text" class="text-field w-input" maxlength="256" name="fname" data-name="fname" placeholder="" id="First-mane" required value="<?php echo $GetDetails[0]->fname; ?>" >

                          <label for="name" class="field-label">First name</label>

                          <div class="text-field-done"></div>

                        </div>

                        <div class="text-field-wrapper half">

                          <input required type="text" class="text-field w-input" maxlength="256" name="lname" data-name="lname" placeholder="" id="Last-name" value="<?php echo $GetDetails[0]->lname; ?>" ><label for="name-2" class="field-label">Last name</label>

                          <div class="text-field-done"></div>

                        </div>

                      </div>

                      <div class="form-label" style="margin-bottom: 20px; margin-left: 7px;">Date of birth</div>

                      <div class="fields-group">

                        <div class="text-field-wrapper third">

                          <input required type="text" class="text-field w-input" maxlength="256" name="month" data-name="Month" placeholder="" id="month" value="<?php echo $dob[0]; ?>" ><label for="name" class="field-label">Month</label>

                          <div class="text-field-done"></div>

                        </div>

                        <div class="text-field-wrapper third">

                          <input required type="text" class="text-field w-input" maxlength="256" name="day" data-name="Day" placeholder="" id="day" value="<?php echo $dob[1]; ?>"  ><label for="name" class="field-label">Day</label>

                          <div class="text-field-done"></div>

                        </div>

                        <div class="text-field-wrapper third">

                          <input required type="text" class="text-field w-input" maxlength="256" name="year" data-name="Year" placeholder="" id="year" value="<?php echo $dob[2]; ?>" ><label for="name" class="field-label" >Year</label>

                          <div class="text-field-done"></div>

                        </div>

                        <div class="text-field-wrapper">

                          <input required type="email" class="text-field w-input" maxlength="256" name="email" data-name="Email" placeholder="" id="email" value="<?php echo $GetDetails[0]->email; ?>" ><label for="email" class="field-label" >Email Address</label>

                          <div class="text-field-done"></div>

                        </div>

                               <div class="dropdownContainer" style="border: 2px solid rgba(5,136,102, 0.5);border-radius: 8px;">

                          <button class="accordion accordion1">Joint</button>

                          <div class="panel panel1">

                              <button class="accordion">General long-term  Investing</button>

                              <div div class="panel">

                               <li>Individual</li>

                               <li>Joint</li>

                               <li>Trust</li>

                              </div>

                              <button class="accordion">Retirement Investing</button>

                              <div class="panel">

                                <li>Traditional IRA</li>

                                <li>Roth IRA</li>

                                <li>SEP IRA</li>

                              </div>

                          </div>

                        </div>

                      </div>

                    </div>

				  

				  

				  

				  



                  </div>

                </div>

				  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                <button id="getStartedBtnEnabled" type="submit" class="form-next w-slider-arrow-right">Update Details</button>

                <div class="slide-nav w-slider-nav w-round"></div> 

               </div>

            </form>

        </div>

        </div> 

        <!-- Quiz Ends -->

 <div class="footer">

          <span>© Copyright 2021 Form Advisory Group, LLC.</span>

        </div>
		
</div> 



<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>





<script>

window.onload = function(){

  console.log("LOADED")

  Array.from(document.querySelectorAll("li")).forEach(function(item){

    item.addEventListener("click", function(e){

      Array.from(document.querySelectorAll('.panel')).forEach(function(panel){

 panel.style.maxHeight = null;

      })

     document.querySelector(".accordion1").innerHTML = this.innerText

	 console.log("acc type: " + document.querySelector(".accordion1").innerHTML)

	 document.cookie="Acctype=" + document.querySelector(".accordion1").innerHTML;

    })

})

}





Array.from(document.querySelectorAll(".accordion")).forEach(function(acc){

    acc.addEventListener("click", function(e){

        e.preventDefault();

    })

  })

var acc = document.getElementsByClassName("accordion");

var i;



for (i = 0; i < acc.length; i++) {

  acc[i].addEventListener("click", function() {

    this.classList.toggle("active");

    var panel = this.nextElementSibling;

    if (panel.style.maxHeight) {

      panel.style.maxHeight = null;

    } else {

      panel.style.maxHeight = panel.scrollHeight*2 + "px";

    } 

  });

}



 



$('.text-field, .text-area').change(function() {

if ($(this).val().length > 0) {

  $(this).siblings('.field-label').addClass('active')

  $(this).siblings('.area-label').addClass('active')

  $(this).siblings('.text-field-done').addClass('active')

  $(this).addClass('done')

} else {

  $(this).siblings('.field-label').removeClass('active')

  $(this).siblings('.area-label').removeClass('active')

  $(this).siblings('.text-field-done').removeClass('active')

  $(this).removeClass('done')

}

})



</script>







<?php } ?>



  </div>









</body>



</html>