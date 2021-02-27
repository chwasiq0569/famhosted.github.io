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

</head>

<style>

        @font-face {
            font-family: ThicBold;
            src: url("../assets/fonts/THICCCBOI-Bold.ttf");
        }
        @font-face {
            font-family: ThicRegular;
            src: url("../assets/fonts/THICCCBOI-Regular.ttf");
        }
		

body{
    padding:0;
    margin:0;
    width:100%;
    height:100vh;
    background:radial-gradient(#88C4B4, #72ad9e);
}
.wrapper{
    width:720px;
    height:60px;
    position: absolute;
    left:50%;
    top:50%;
    transform: translate(-50%, -50%);
}
.circle{
    width:20px;
    height:20px;
    position: absolute;
    border-radius: 50%;
    background-color: #fff;
    left:15%;
    transform-origin: 50%;
    animation: circle .5s alternate infinite ease;
}

@keyframes circle{
    0%{
        top:60px;
        height:5px;
        border-radius: 50px 50px 25px 25px;
        transform: scaleX(1.7);
    }
    40%{
        height:20px;
        border-radius: 50%;
        transform: scaleX(1);
    }
    100%{
        top:0%;
    }
}
.circle:nth-child(2){
    left:45%;
    animation-delay: .2s;
}
.circle:nth-child(3){
    left:auto;
    right:15%;
    animation-delay: .3s;
}
.shadow{
    width:20px;
    height:4px;
    border-radius: 50%;
    background-color: rgba(0,0,0,.5);
    position: absolute;
    top:62px;
    transform-origin: 50%;
    z-index: -1;
    left:15%;
    filter: blur(1px);
    animation: shadow .5s alternate infinite ease;
}

@keyframes shadow{
    0%{
        transform: scaleX(1.5);
    }
    40%{
        transform: scaleX(1);
        opacity: .7;
    }
    100%{
        transform: scaleX(.2);
        opacity: .4;
    }
}
.shadow:nth-child(4){
    left: 45%;
    animation-delay: .2s
}
.shadow:nth-child(5){
    left:auto;
    right:15%;
    animation-delay: .3s;
}
.wrapper span{
    position: absolute;
    top:75px;
    font-family: 'Lato';
    font-size: 20px;
    letter-spacing: 12px;
    color: #fff;
    left:15%;
}







/*  footer   */
footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida  Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
footer .fa-heart{
    color: red;
}
footer .fa-dev{
    color: #fff;
}
footer .fa-twitter-square{
  color:#1da0f1;
}
footer .fa-instagram{
  color: #f0007c;
}
fotter .fa-linkedin{
  color:#0073b1;
}
footer .fa-codepen{
  color:#fff
}
footer a {
    color: #3c97bf;
    text-decoration: none;
  margin-right:5px;
}
.youtubeBtn{
    position: fixed;
    left: 50%;
  transform:translatex(-50%);
    bottom: 45px;
    cursor: pointer;
    transition: all .3s;
    vertical-align: middle;
    text-align: center;
    display: inline-block;
}
.youtubeBtn i{
   font-size:20px;
  float:left;
}
.youtubeBtn a{
    color:#ff0000;
    animation: youtubeAnim 1000ms linear infinite;
  float:right;
}
.youtubeBtn a:hover{
  color:#c9110f;
  transition:all .3s ease-in-out;
  text-shadow: none;
}
.youtubeBtn i:active{
  transform:scale(.9);
  transition:all .3s ease-in-out;
}
.youtubeBtn span{
    font-family: 'Lato';
    font-weight: bold;
    color: #fff;
    display: block;
    font-size: 12px;
    float: right;
    line-height: 20px;
    padding-left: 5px;
  
}

@keyframes youtubeAnim{
  0%,100%{
    color:#c9110f;
  }
  50%{
    color:#ff0000;
  }
}

/* footer  */

.wrapper p {
	

    top:90px;
    font-size: 21px;
    color: #fff;
	 line-height: 36px;
	 font-family: ThicRegular;
	margin-top: 80px;
}
</style>
<body>

<div class="wrapper" >
<center>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
  
     <div id="anim"> <p style="display: none;"></p> </div>
</center>
    </div>



</body>



<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=600369c9da7fb7d64df10a9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<script>

var texts = [
	'Reviewing your responses',
    'Analyzing your appetite for risk',
    'Identifying an investment strategy',
    'Designing your personlized investment portfolio',
];

(function displayClass(i) {
    $('#anim p').text(texts[i]).fadeIn(1000, function() {
        $(this).delay(600).fadeOut(1000, function() {
			console.log(i);
			if(i > 2) {
				 $('#anim p').text(texts[i]).fadeIn(1000);
				 window.location.href = "success.php";
			} else {
				  displayClass((i + 1) % texts.length);
			}
        });
    });
})(0);


</script>
</html>