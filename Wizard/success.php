<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- font-family: 'Mulish', sans-serif; -->
    <link rel="stylesheet" href="../css/style.css" />

    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/webflow.css" rel="stylesheet" type="text/css">
    <link href="css/dob-9d4755.webflow.css" rel="stylesheet" type="text/css"> 
    <link href="css/loader.css" rel="stylesheet" type="text/css"> 
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Fam</title>
    <style>
        @font-face {
            font-family: ThicBold;
            src: url("assets/fonts/THICCCBOI-Bold.ttf");
        }
        @font-face {
            font-family: ThicRegular;
            src: url("assets/fonts/THICCCBOI-Regular.ttf");
        }
        .logo{
          /* margin-left: 1.2rem; */
        }
        #stepOne{
            padding-top: 4rem;
            width: 100%;
            
            height: 100%;
            color: #2ECC71;
        }
        .messageContainer{
            width: 100%;
            max-height: auto !important;
            display: flex;
            align-items: flex-start;
            height: 15rem !important;
            /* border: 2px solid red; */
        }
        .messageContainer .leftSide{
            width: 20%;
            height: 5rem;
            display: flex;
            justify-content: center; 
            flex-direction: column;
            align-items: flex-start;
            /* border: 2px solid red; */
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
            /* border: 2px solid yellow; */
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
            /* border: 2px solid red; */
        }
        .messageContainer .rightSide .lowerSection{
            margin-top: 0.25rem;
            margin-left: 0.1rem;
            line-height: 1.5;
            font-size: 13px;
            /* font-family: 'Roboto', sans-serif; */
            font-family: ThicRegular;
            font-weight: 500;
            color: #949494;
            /* border-bottom: 2px solid #d9dadf; */
            /* padding-bottom: 0.7rem; */
            min-height: auto !important;
            overflow: hidden;
        }
        .second,
        .fourth{
            /* margin-top: -2rem; */
            height: 8rem !important;
        }
        .second{
            margin-top: -1rem;
        }
        .third{
            height: 9rem !important;
            /* margin-top: -2.5rem; */
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
        /* display: none; */
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
          /* align-self: flex-start; */
          /* display: none; */
        }
        
        .first .verticalLine .verticalLineInner{
            top: 30% !important;
            left: -25% !important;
            height: 9.75rem !important;
            /* border: 2px solid red !important; */
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
        }
       a{
           text-decoration: none;
       }
    
</style>
</head>
<body>
  <div class="wrapper">
        <div class="content">
            <div class="logo">
                <a href="platform.html"><span>fam.</span></a>
            </div>
            <div id="stepOne" class="mainStepOne" style="margin-top: -2.5rem !important;">

                <!-- <div class="headline">
                    <span>Sorry we've hit capacity.
                    </span>
                </div>
                <div class="headlineTwo">
                    <span>
                    </span>
                </div>  
                <div class="privacyPolicy">
                    <span>By continuing, you agree to be evaluated for multiple Petal credit products and acknowledge and agree to Petal's Auto-dialer Authorization, Privacy Policy, and Site Terms and to be contacted at the number you enter below. Message and data rates may apply.</span>
                </div>   
                <div class="headlineTwo moveUp">
                    <span>
                        What's next
                    </span>
                </div>  
                <div class="messageContainer">
                    <div class="leftSide ">
                        <div class="iconContainer">
                            <img src="./assets/icons/birthday-card.svg" alt="invitation" />
                        </div>
                        <div class="verticalLine">
                            <div class="verticalLineInner">

                            </div>
                        </div>
                    </div>
                    <div class="rightSide">
                        <div id="acc1" class="upperSection accordion">
                                Text Invite
                        </div>
                        <div id="panel1" class="lowerSection panel">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                      </div>
                  </div>  
               
                <div class="messageContainer" >
                    <div class="leftSide">
                        <div class="iconContainer">
                            <img src="./assets/icons/icons8-user-secured-96.png" alt="invitation" />
                        </div>
                        <div class="verticalLine">
                            <div class="verticalLineInner">

                            </div>
                        </div>
                    </div>
                    <div class="rightSide">
                        <div id="acc2" class="upperSection accordion">
                          Open your account
                        </div>
                        <div id="panel2" class="lowerSection panel">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                  </div>  
                
                <div class="messageContainer" >
                    <div class="leftSide">
                        <div class="iconContainer greenbg">
                            <img src="./assets/icons/phone-call.svg" alt="invitation" />
                        </div>
                        <div class="verticalLine">
                            <div class="verticalLineInner">

                            </div>
                        </div>
                    </div>
                    <div class="rightSide">
                        <div id="acc3" class="upperSection accordion">
                            Welcome Call
                        </div>
                        <div id="panel3" class="lowerSection panel">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                  </div>  
                  
                <div class="messageContainer" >
                    <div class="leftSide">
                      <div class="iconContainer greenbg">
                            <img src="./assets/icons/money.svg" alt="invitation" />
                        </div>
                        <div class="verticalLine">
                            
                        </div>
                    </div>
                    <div class="rightSide">
                        <div id="acc4" class="upperSection accordion">
                            Fund and Invest
                        </div>
                        <div id="panel4" class="lowerSection panel">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                  </div>   -->
                  <!-- <div class="horizontalLine"></div>  -->
            </div>
        </div> 
        <!-- Quiz Ends -->
    
</div> 


<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<Script src="js/successPage.js"></Script>

<script>

// document.getElementById("acc1").addEventListener("click", function(){
//     document.getElementById("panel1").style.maxHeight = document.getElementById("panel1").scrollHeight + "px";
//     document.getElementById("panel2").style.maxHeight = null;
//     document.getElementById("panel3").style.maxHeight = null;
//     document.getElementById("panel4").style.maxHeight = null;
// })
// document.getElementById("acc2").addEventListener("click", function(){
//     document.getElementById("panel1").style.maxHeight = null;
//     document.getElementById("panel2").style.maxHeight = document.getElementById("panel1").scrollHeight + "px";
//     document.getElementById("panel3").style.maxHeight = null;
//     document.getElementById("panel4").style.maxHeight = null;
// })
// document.getElementById("acc3").addEventListener("click", function(){
//     document.getElementById("panel1").style.maxHeight = null;
//     document.getElementById("panel3").style.maxHeight = document.getElementById("panel1").scrollHeight + "px";
//     document.getElementById("panel2").style.maxHeight = null;
//     document.getElementById("panel4").style.maxHeight = null;
// })
// document.getElementById("acc4").addEventListener("click", function(){
//     document.getElementById("panel1").style.maxHeight = null;
//     document.getElementById("panel4").style.maxHeight = document.getElementById("panel1").scrollHeight + "px";
//     document.getElementById("panel3").style.maxHeight = null;
//     document.getElementById("panel2").style.maxHeight = null;
// })

</script>


</body>
</html>