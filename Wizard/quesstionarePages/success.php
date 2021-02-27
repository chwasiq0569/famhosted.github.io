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
    <link href="../css/loader.css" rel="stylesheet" type="text/css"> 
      <link href="footer.css" rel="stylesheet" type="text/css">
	  
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Form</title>
    <style>
        @font-face {
            font-family: ThicBold;
            src: url("../assets/fonts/THICCCBOI-Bold.ttf");
        }
        @font-face {
            font-family: ThicRegular;
            src: url("../assets/fonts/THICCCBOI-Regular.ttf");
        }
        .logo{
         
        }
        #stepOne{
            padding-top: 4rem;
            width: 100%;
            
            height: 100%;
            color: #2ECC71;
        }
        /*
        .messageContainer .leftSide{
            width: 20%;
            height: 5rem;
            display: flex;
            justify-content: center; 
            flex-direction: column;
            align-items: flex-start;
           
        }
        .messageContainer .leftSide .iconContainer{
            width: 45%;
            height: 45%;
            border-radius: 47%;
            padding: 9px;
            background-color: rgba(127, 88, 226, 0.2);
        }
        .messageContainer .rightSide{
            flex: 1;
            height: 100% !important;
            min-height: 100%;
          
            padding-top: 0.25rem;
            width: 80%;
            line-height: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-left: -1rem;
        }
        .messageContainer .rightSide .upperSection{
            font-size: 15px;    
            color: black;    
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }
        .messageContainer .rightSide{
            height: auto  !important;
            
        }
        .messageContainer .rightSide .lowerSection{
            margin-top: 0.25rem;
            margin-left: 0.1rem;
            line-height: 1.5;
            font-size: 13px;
          
            font-family: ThicRegular;
            font-weight: 500;
            color: #949494;
           
            min-height: auto !important;
            overflow: hidden;
        }
        .first{
            height: 15rem !important;
            max-height: 15rem ;
            transform: max-height 2s ease;
        }
        .second,
        .fourth{
           
            height: 8rem !important;

            transform: all 0.5s ease;
        }
        .second{
            margin-top: -1rem;

            transform: all 0.5s ease;
        }
        .third{
            height: 9rem !important;
          

            transform: all 0.5s ease;
        }
        .greenbg{
         background-color:rgba(128, 128, 128, 0.25) !important;
        }
        .accordion {
            cursor: pointer;
            transition: 0.4s;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .panel {
        max-height: auto;
        background-color: white;
        transition: all 0.2s ease-in;
        overflow: hidden;
        }
        .panel p{
            margin-top: 7px !important;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            text-align: justify;
        }
        .verticalLine{
          height: 65%;
          width: 100%;
          display: flex;
          justify-content: center;
          align-items: flex-start;
        }
        .verticalLine .verticalLineInner{
          position: relative;
          top: 2.5%;
          
          height: 60%;
          width: 1px;
          border-left: 2px dashed #d9dadf !important;
          align-self: flex-start;
        }
        
        .first .verticalLine .verticalLineInner{
            top: 30% !important;
            left: -25% !important;
            height: 9.75rem !important;
        }
        .second .verticalLine .verticalLineInner{
            top: 30% !important;
            left: -25% !important;
            height: 4rem !important;
        }
        .third .verticalLine .verticalLineInner{
            top: 30% !important;
            left: -25% !important;
            height: 5rem !important;
        }
        .moveUp{
            margin-top: 0rem !important;
            margin-bottom: 2rem !important;
        } */
.hideLine{
    display: none;
}
.showLine{
    display: block;
}
button.accordion {
    /* background-color: #eee; */
    color: #444;
    cursor: pointer;
    /* padding-left: 18px;
    padding-right: 18px; */
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    	
    background-color: white;
    /* border: 2px solid red; */

    padding-top: 0.5rem;
    padding-bottom: 0.5rem;

}

button.accordion.active, button.accordion:hover {
    /* background-color: #ddd; */
}

div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
    line-height: 1;
}

div.panel.show {
    opacity: 1;
    max-height: 500px;  
}

.btnContent{
    padding: 0;
    margin: 0;
    display: flex;
    height: 100%;
    align-items: center;
}

.iconContainer,
.accordianhead{
    height: 100%;
}
.accordianhead{
   margin-left: 1rem;
   font-weight: bold;
}

.lowerSection{
            margin-top: 0.25rem;
            margin-left: 0.1rem;
            line-height: 1.5 !important;
            font-size: 13px;
          
            font-family: ThicRegular;
            font-weight: 500;
            color: #949494;
           
            min-height: auto !important;
            overflow: hidden;
            width: 97%;
            border-left: 2px dashed #d9dadf;
            margin-left: 0.99rem;
            padding-left: 1.9rem !important;
            text-align: justify;
}

.iconContainer{
            width: 2rem;
            height: 2rem;
            border-radius: 47%;
            padding: 9px;
            background-color: rgba(127, 88, 226, 0.2);
              }
.greenbg{
         background-color:rgba(128, 128, 128, 0.25) !important;
        }

       a{
           text-decoration: none;
       }

       .verticalLine{
           /* padding-top: 2rem; */
           position: relative;
           left: 3.75%;
           /* top: -25%; */
           height: 2.5rem;
           width: 2px;
           /* background-color: red; */
           border-left: 2px dashed #d9dadf;
       }
	   
	 

</style>
</head>
<body>
  <div class="wrapper">
        <div class="content">
            <div class="logo">
                <a href="../../platform.html"><span>fam.</span></a><a style="float: right; font-family: ThicRegular; color: black; margin-right: 15px; font-size: 12px; color: #88C4B4;" href="../../index.html">Back Home</a>
            </div>
            <div id="stepOne" class="mainStepOne" style="margin-top: -2.5rem !important;">
                <div class="headline">
<span>Congratulations! You’ve been added to our waitlist. 
</span>
</div>
<div class="headlineTwo">
<span>
</span>
</div>  
<div class="privacyPolicy">
<span> But hang tight, we’ve developed your investment portfolio and we'll onboard you as soon as we can. In the meantime, make sure you take a look at how the process going forward looks. If you have any questions, feel free to reach out to our team at support@investwithfam.com</span>
</div>   
<div class="headlineTwo moveUp">
<span>
    What's next
</span>
</div>  
<button class="accordion btn1">
    <div class="btnContent ">
        <div class="iconContainer bluebg">
            <img src="../assets/icons/birthday-card.svg" alt="invitation" />
        </div>
        <div class="accordianhead">
          Look Out for Your Invite
        </div>
    </div>
</button>
<!-- id="panel4"  -->
<div class="lowerSection panel">
    <p>The team here at Fam will be sending you a text invite informing you to keep an eye on your inbox for your instructions to open your account with Altruist, our technology partner.

    </p>
</div>
    <div class="verticalLine line1">

    </div>
<button class="accordion btn2">
    <div class="btnContent">
        <div class="iconContainer greenbg">
            <img src="../assets/icons/user.svg" alt="invitation" />
        </div>
        <div class="accordianhead">
         Open Your Account
        </div>
    </div>
</button>

<div class="lowerSection panel">
    <p>Once you receive your unique email invite, you will be prompted to provide additional information to successfully open your account. This process should take no longer than five minutes. Our team will be notified once the account is successfully opened.
    </p>
</div>
<div class="verticalLine line2">

</div>
<button class="accordion btn3">
    <div class="btnContent">
        <div class="iconContainer greenbg">
            <img src="../assets/icons/phone-call.svg" alt="invitation" />
        </div>
        <div class="accordianhead">
         Welcome to The Fam.
        </div>
    </div>
</button>
<div class="lowerSection panel">
    <p>We want to speak with you! Once you’ve successfully joined Fam, we schedule our official “Welcome to the Fam” call. We go over all the details regarding your investment strategy, goals, and any additional questions you may have.
    </p>
</div>
<div class="verticalLine line3">

</div>
<button class="accordion btn4">
    <div class="btnContent">
        <div class="iconContainer greenbg">
            <img src="../assets/icons/money.svg" alt="invitation" />
        </div>
        <div class="accordianhead">
            Fund Your New Account
        </div>
    </div>
</button>

<div class="lowerSection panel">
    <p> Altruist, our custodian and technology partner, provides our clients with many ways to fund their new account. Our concierge team will guide you along every step to ensure a smooth transition. Once your account is funded, your account will be sent in queue to be invested. 

    </p>
</div>  
            </div>
        </div> 
        <!-- Quiz Ends -->
    	<p class="footerBottom" style="margin-left: -5rem;!important;">© Copyright 2021 Form Advisory Group, LLC.</p>
	

</div> 


<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="../js/successPage.js"></script>

<!-- <script>
var acc = document.getElementsByClassName("accordion");
var i;
let clicked = false;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
        this.nextElementSibling.nextElementSibling.classList.toggle("hideLine");
  }
}
</script> -->

</body>
</html>