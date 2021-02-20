//Click item and disappear hamburger

$('.navbar-nav>li>a').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});

$('.navbar-nav>li>button').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});

//Click outside of hamburger background 

$(document).ready(function(){
    $('body').click(function(){
        $('.navbar-collapse').collapse('hide');
    });
});


let leftSideContent = `
<div class="row">
<p>ETF and mutual fund strategies
</p>
</div>
<div class="row">
    <p>Professionally managed portfoliosFootnote 1</p>
</div>
<div class="row">
    <p>Online dashboard</p>
</div>
<div class="row">
<p>Bank of America banking and Merrill investing connected</p>
</div>
<div class="row">
<p>Establish goals online
</p>
</div>
<div class="row">
<p>Advisor helps you establish goals</p>
</div>
<div class="row">
<p>One-on-one advice</p>
</div>
<div class="row">
<p>Periodic reviews with an advisor</p>
</div>
`;

let middleContent = `
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
`;

let rightSideContent = `
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">
<div class="imgContainer">
    <img src="./images/checkmark.png" alt="checkmark" />
</div>
</div>
<div class="row">

</div>
<div class="row">

</div>
<div class="row">

</div>
`;

let mobileViewGridData = `
<div class="section">
<div class="upper">
    <p>ETF and mutual fund strategies</p>
</div>
<div class="lower">
    <div class="lower_leftSide">
            <div class="imgContainer">
                <img src="./images/checkmark.png" alt="checkmark" />
            </div>
    </div>
    <div class="lower_rightSide">
        <div class="imgContainer">
            <img src="./images/checkmark.png" alt="checkmark" />
        </div>
    </div>
</div>
</div> 
<div class="section">
<div class="upper">
    <p>Professionally managed portfolios 1</p>
</div>
<div class="lower">
    <div class="lower_leftSide">
            <div class="imgContainer">
                <img src="./images/checkmark.png" alt="checkmark" />
            </div>
    </div>
    <div class="lower_rightSide">
        <div class="imgContainer">
            <img src="./images/checkmark.png" alt="checkmark" />
        </div>
    </div>
</div>
</div> 
<div class="section">
<div class="upper">
    <p>Online dashboard</p>
</div>
<div class="lower">
    <div class="lower_leftSide">
            <div class="imgContainer">
                <img src="./images/checkmark.png" alt="checkmark" />
            </div>
    </div>
    <div class="lower_rightSide">
        <div class="imgContainer">
            <img src="./images/checkmark.png" alt="checkmark" />
        </div>
    </div>
</div>
</div> 
<div class="section">
<div class="upper">
    <p>Bank of America banking and Merrill investing connected</p>
</div>
<div class="lower">
    <div class="lower_leftSide">
            <div class="imgContainer">
                <img src="./images/checkmark.png" alt="checkmark" />
            </div>
    </div>
    <div class="lower_rightSide">
        <div class="imgContainer">
            <img src="./images/checkmark.png" alt="checkmark" />
        </div>
    </div>
</div>
</div> 
<div class="section">
<div class="upper">
    <p>Establish goals online</p>
</div>
<div class="lower">
    <div class="lower_leftSide">
            <div class="imgContainer">
                <img src="./images/checkmark.png" alt="checkmark" />
            </div>
    </div>
    <div class="lower_rightSide">
        <div class="imgContainer">
            <img src="./images/checkmark.png" alt="checkmark" />
        </div>
    </div>
</div>
</div> 
<div class="section">
<div class="upper">
    <p>Advisor helps you establish goals</p>
</div>
<div class="lower">
    <div class="lower_leftSide">
            <div class="imgContainer">
                <img src="./images/checkmark.png" alt="checkmark" />
            </div>
    </div>
    <div class="lower_rightSide">
        <div class="imgContainer">
            <img src="./images/checkmark.png" alt="checkmark" />
        </div>
    </div>
</div>
</div> 
<div class="section">
<div class="upper">
    <p>One-on-one advice</p>
</div>
<div class="lower">
    <div class="lower_leftSide">
            <div class="imgContainer">
                <img src="./images/checkmark.png" alt="checkmark" />
            </div>
    </div>
    <div class="lower_rightSide">
        <div class="imgContainer">
            <img src="./images/checkmark.png" alt="checkmark" />
        </div>
    </div>
</div>
</div> 
<div class="section">
<div class="upper">
    <p>Periodic reviews with an advisor</p>
</div>
<div class="lower">
    <div class="lower_leftSide">
            <div class="imgContainer">
                <img src="./images/checkmark.png" alt="checkmark" />
            </div>
    </div>
    <div class="lower_rightSide">
        <div class="imgContainer">
            <img src="./images/checkmark.png" alt="checkmark" />
        </div>
    </div>
</div>
</div> 
`;

let collapseItems = document.getElementById("collapseItems");
let lastItem = document.getElementById("lastItem");

let investingGuide_leftSide = document.getElementById("investingGuide_leftSide");
let investingGuide_middle = document.getElementById('investingGuide_middle');
let investingGuide_rightSide = document.getElementById('investingGuide_rightSide');

collapseItems.addEventListener("click", function(){
    investingGuide_leftSide.style.height = 135 + 'rem';
    $(leftSideContent).insertAfter("#insertAfter");
    investingGuide_middle.style.height = 135 + 'rem';
    $(middleContent).insertAfter("#insertAfter2");
    investingGuide_rightSide.style.height = 135 + 'rem';
    $(rightSideContent).insertAfter("#insertAfter3");
    document.getElementById('compareProgramsContianer').innerHTML = `<span>Get <a href="#">more information</a> on how Merrill Guided Investing combines the power of technology and human insight and investment expertise.</span>`
})

const collapseItemsMobile = document.getElementById("collapseItemsMobile");

collapseItemsMobile.addEventListener("click", function(){
    console.log("CLICKED")
    document.getElementById("compareProgramsContianerMobile").style.display = "none";
    document.getElementById("mainGrid").style.minHeight = 200 + 'rem';
    $(mobileViewGridData).insertAfter("#insertAfterMobile");
})

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function(e) {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
      e.currentTarget.querySelector(".iconContainer").querySelector(".iconImg").style.transform = "rotate(0deg)";
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
      e.currentTarget.querySelector(".iconContainer").querySelector(".iconImg").style.transform = "rotate(180deg)";
    }
  });
}