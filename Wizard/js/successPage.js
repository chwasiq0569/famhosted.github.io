

// console.log(document.getElementById("stepOne"));



var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
        this.lastChild.classList.add("hide");
        
  }
}

$("document").ready(function() {
   document.querySelector('.btn1').click();
});

setTimeout(function(){
  document.getElementById("stepOne").innerHTML = content;
  var acc = document.getElementsByClassName("accordion");
var i;
let click1 = false;
let click2 = false;
let click3 = false;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
        // this.nextElementSibling.nextElementSibling.classList.toggle("hideLine");
    }
}
document.querySelector('.btn1').addEventListener('click', function(){
    console.log("CLCIKED")
    if(click1 == false){
        document.querySelector('.line1').style.display = "none";
        click1 = true;
    }
    else if(click1 == true){
        setTimeout(function(){
            document.querySelector('.line1').style.display = "block";
            click1 = false;
        }, 500);
    }
})
document.querySelector('.btn2').addEventListener('click', function(){
    console.log("CLCIKED")
    if(click2 == false){
        document.querySelector('.line2').style.display = "none";
        click2 = true;
    }
    else if(click2 == true){
        setTimeout(function(){
            document.querySelector('.line2').style.display = "block";
            click2 = false;
        }, 500)
    }
})
document.querySelector('.btn3').addEventListener('click', function(){
    console.log("CLCIKED")
    if(click3 == false){
        document.querySelector('.line3').style.display = "none";
        click3 = true;
    }
    else if(click3 == true){
        setTimeout(function(){
            document.querySelector('.line3').style.display = "block";
            click3 = false;
        }, 500)
    }
})
}, 2000);




// document.getElementById("acc1").addEventListener("click", function(){
//     console.log("accc")
//     console.log(document.querySelector(".first").style.maxHeight);

//     document.querySelector(".first").style.maxHeight = '6rem';
//     document.querySelector(".first").style.transition = "all 2s";
//   document.getElementById("panel1").style.maxHeight = document.getElementById("panel1").scrollHeight + "px";
//   document.getElementById("panel2").style.maxHeight = null;
//   document.getElementById("panel3").style.maxHeight = null;
//   document.getElementById("panel4").style.maxHeight = null;
// })
// document.getElementById("acc2").addEventListener("click", function(){
//   document.getElementById("panel1").style.maxHeight = null;
//   document.getElementById("panel2").style.maxHeight = document.getElementById("panel1").scrollHeight + "px";
//   document.getElementById("panel3").style.maxHeight = null;
//   document.getElementById("panel4").style.maxHeight = null;
// })
// document.getElementById("acc3").addEventListener("click", function(){
//   document.getElementById("panel1").style.maxHeight = null;
//   document.getElementById("panel3").style.maxHeight = document.getElementById("panel1").scrollHeight + "px";
//   document.getElementById("panel2").style.maxHeight = null;
//   document.getElementById("panel4").style.maxHeight = null;
// })
// document.getElementById("acc4").addEventListener("click", function(){
//   document.getElementById("panel1").style.maxHeight = null;
//   document.getElementById("panel4").style.maxHeight = document.getElementById("panel1").scrollHeight + "px";
//   document.getElementById("panel3").style.maxHeight = null;
//   document.getElementById("panel2").style.maxHeight = null;
// })
// }, 000);