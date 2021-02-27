function nextSec(){
    Array.from(document.getElementsByTagName("progress"))[0].value = 60;
    document.querySelector("#stepThree").innerHTML = `
    <div id="ques1" class="questionWrapper">
    <div class="qhead">
      <span>Next, let's get to know you as an investor.</span>
    </div>
          <p class="qinfo">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
          </p>
          <button onclick = "nextSec1()" class="newBtn" id="nextSec1"> 
          <div class="container"> 
          <div class="text">
              Next
            </div>
            <div class="imageContainer">
            <svg width="47" height="28" viewBox="0 0 47 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0)">
            <path d="M29.577 1.296C29.063 1.945 29.172 2.889 29.823 3.403L34.421 7.036L40.461 12.424L2.743 12.424C1.914 12.424 1.243 13.096 1.243 13.924C1.243 14.752 1.914 15.424 2.743 15.424L40.084 15.424L29.605 24.477C28.979 25.017 28.908 25.965 29.45 26.592C29.992 27.219 30.939 27.288 31.566 26.746L45.237 14.935C45.564 14.653 45.753 14.244 45.757 13.812C45.757 13.808 45.757 13.804 45.757 13.8C45.757 13.372 45.575 12.965 45.256 12.681L36.35 4.74L31.684 1.05C31.034 0.536 30.091 0.646002 29.577 1.296Z" fill="#1D1D1D"/>
            </g>
            <defs>
            <clipPath id="clip0">
            <rect width="27" height="46" fill="white" transform="translate(0.5 27.5) rotate(-90)"/>
            </clipPath>
            </defs>
            </svg>
            </div>
          </div> 
          </button>
        </div>`;
  }
  function nextSec1(){
    Array.from(document.getElementsByTagName("progress"))[0].value = 70;
  
  
    document.querySelector("#stepThree").innerHTML = `<div id="ques2" class="questionWrapper" >
    <div class="qhead" >
          <span>What will your household income be this year?</span>
    </div>      
          <p class="qinfo">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
          </p>
          <label for="amount1" class="number-label">Household income (before taxes)</label>
          <input id="amount1" type="text" name="amount1" placeholder="$25000"  >
          <button onclick = "nextSec2()" class="newBtn" id="nextSec2"> 
          <div class="container"> 
          <div class="text">
              Next
            </div>
            <div class="imageContainer">
            <svg width="47" height="28" viewBox="0 0 47 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0)">
            <path d="M29.577 1.296C29.063 1.945 29.172 2.889 29.823 3.403L34.421 7.036L40.461 12.424L2.743 12.424C1.914 12.424 1.243 13.096 1.243 13.924C1.243 14.752 1.914 15.424 2.743 15.424L40.084 15.424L29.605 24.477C28.979 25.017 28.908 25.965 29.45 26.592C29.992 27.219 30.939 27.288 31.566 26.746L45.237 14.935C45.564 14.653 45.753 14.244 45.757 13.812C45.757 13.808 45.757 13.804 45.757 13.8C45.757 13.372 45.575 12.965 45.256 12.681L36.35 4.74L31.684 1.05C31.034 0.536 30.091 0.646002 29.577 1.296Z" fill="#1D1D1D"/>
            </g>
            <defs>
            <clipPath id="clip0">
            <rect width="27" height="46" fill="white" transform="translate(0.5 27.5) rotate(-90)"/>
            </clipPath>
            </defs>
            </svg>
            </div>
          </div> 
          </button>
        </div>`;
  }
  
  function nextSec2(){
    
    Array.from(document.getElementsByTagName("progress"))[0].value = 75;
  
    console.log("nextSec");
    document.querySelector("#stepThree").innerHTML = `
    <div id="ques3" class="questionWrapper">
    <div class="qhead">
          <span>How much money do you have saved this year?</span>
    </div>          
          <p class="qinfo">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
          <label for="amount2" class="number-label">Total savings and investments</label>
          <input id="amount2" type="text" name="amount2" placeholder="$10000"  >
          <button onclick = "nextSec3()" class="newBtn" id="nextSec3"> 
          <div class="container"> 
          <div class="text">
              Next
            </div>
            <div class="imageContainer">
            <svg width="47" height="28" viewBox="0 0 47 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0)">
            <path d="M29.577 1.296C29.063 1.945 29.172 2.889 29.823 3.403L34.421 7.036L40.461 12.424L2.743 12.424C1.914 12.424 1.243 13.096 1.243 13.924C1.243 14.752 1.914 15.424 2.743 15.424L40.084 15.424L29.605 24.477C28.979 25.017 28.908 25.965 29.45 26.592C29.992 27.219 30.939 27.288 31.566 26.746L45.237 14.935C45.564 14.653 45.753 14.244 45.757 13.812C45.757 13.808 45.757 13.804 45.757 13.8C45.757 13.372 45.575 12.965 45.256 12.681L36.35 4.74L31.684 1.05C31.034 0.536 30.091 0.646002 29.577 1.296Z" fill="#1D1D1D"/>
            </g>
            <defs>
            <clipPath id="clip0">
            <rect width="27" height="46" fill="white" transform="translate(0.5 27.5) rotate(-90)"/>
            </clipPath>
            </defs>
            </svg>
            </div>
          </div> 
          </button>

    </div>
    `;
  }
  
  var question_count = 0;
  var data = [];
  var content;
  
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
  const questions = [
      {
          question: "How much do you know about investing?",
          info: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
          answers: [
              "I'm new to investing",
              "I understand the basics",
              "I have got a good Understanding",
              "I am an investment expert"
          ]
      },
      {
          question: "Next, lets look at what might be keeping you from your best financial self?",
          info: "You might relate to more than one answer. Select the one hat best fits you.",
          answers: [
              "I don't have time to research all the financial products available to me and manage my investment portfolio.",
              "I don't understand what products are right for my goals or how to make a comprehensive investment strategy.",
              "There are other things in my life I'd rather obsess over other than the daily maintenance of my finances.",
              "I have a lot of assets to keep track of and/or my financial goals are getting a bit more complicated.",
              "I don't feel confident making financial and investment decisions on my own and taking responsibility for them.",
              "I've recently experienced a major life event like: buying a home, getting married or divorced, the birth of a child, or a death in the family.",
              "I'd like to have greater peace of mind that my finances are in order for the sake of my family.",
          ]
      },
      {
          question: "What is your biggest concern when you think about investing?",
          info: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
          answers: [
              "I'm new to investing.",
              "I understand the basics.",
              "I have got a good understanding.",
             
              "I'm an investment expert."
          ]
      },
      {
          question: "When deciding how to invest your money, which do you care about more?",
          info: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
          answers: [
              "Maximizing gains.",
              "Minimizing losses.",
              "Both equally."
          ]
      },
      {
          question: "If the stock market were to crash tomorrow, how would you respond?",
          info: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
          answers: [
              "Sell everything.",
              "Sell some of my investment.",
              "But more.",
              "Sit tight and ride it out."
          ]
      },
  ];
  
  const stepThree = document.getElementById("stepThree");
  const nextBtn = document.getElementById("nextBtn");
  
  function next(){
      if(question_count < questions.length - 1){
        question_count++;
        show(question_count);
        data.push(content.trim());
      } 
      else {
        Array.from(document.getElementsByTagName("progress"))[0].value=100;
  
        document.getElementById("nextBtn").textContent = "SUBMIT";
        document.getElementById("nextBtn").addEventListener("click", function(){
          console.log("SUBMITTED")
          window.location.href = "./confirm.html";
          console.log("data: ", data)
  
        })
           }
      console.log(document.getElementById("stepThree"));
  }
  
  function show(count){
  
    Array.from(document.getElementsByTagName("progress"))[0].value+=5;
      console.log("show Called")
      let options = `<div class="headlineTwo">
      <span class="questionStatement">${questions[count].question}</span>
     </div> 
     <div class="privacyPolicy" style="margin-top: 0rem;">
       <span>${questions[count].info}</span>
     </div>   
     <div id="options" class="options">
          
     </div> 
     <button disabled class="form-next w-slider-arrow-right" id="nextBtn"> Next </button>
  `;
  
  stepThree.innerHTML = options;
  
  questions[question_count].answers.forEach(function(q){
    let option = `<label class="optionContainer">
    <input type="radio" name="ques" >
    <div class="iconContainer">
      <svg class="iconSimple" id="check_mark" height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
        <path id="check_mark"  d="m369.164062 174.769531c7.8125 7.8125 7.8125 20.476563 0 28.285157l-134.171874 134.175781c-7.8125 7.808593-20.472657 7.808593-28.285157 0l-63.871093-63.875c-7.8125-7.808594-7.8125-20.472657 0-28.28125 7.808593-7.8125 20.472656-7.8125 28.28125 0l49.730468 49.730469 120.03125-120.035157c7.8125-7.808593 20.476563-7.808593 28.285156 0zm142.835938 81.230469c0 141.503906-114.515625 256-256 256-141.503906 0-256-114.515625-256-256 0-141.503906 114.515625-256 256-256 141.503906 0 256 114.515625 256 256zm-40 0c0-119.394531-96.621094-216-216-216-119.394531 0-216 96.621094-216 216 0 119.394531 96.621094 216 216 216 119.394531 0 216-96.621094 216-216zm0 0"/>
        </svg>
    </div>${q}
    </label>`;
    document.getElementById("options").innerHTML += option;
  })
  
  $("input:radio").change(function () {
      $("#nextBtn").attr("disabled", false);
                                          });
      var radios = document.getElementsByName('ques');
          Array.from(radios).forEach(function(radio){
          radio.addEventListener("change", function(){
              if(radio.checked){
                  content = radio.parentElement.textContent; 
              }
          console.log("CHANGED");
          checks();
                                                     })
      })
  document.getElementById("nextBtn").addEventListener("click", function(){  
      console.log("CLICKED");
          next();
          console.log(data)
  })
  }
  
  function nextSec3(){
    show(0)
  }