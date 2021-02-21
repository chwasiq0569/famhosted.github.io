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

let contentArr = [
    {
        tagline: "US Large Cap Growth",
        info: "Stocks of large companies with strong earnings growth. These big companies are typically more stable than smaller companies.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>PXWIX : Pax Ellevate Global Women’s Leadership Fund
        </p>
        <p>VTI : Vanguard Total Stock Market ETF
        </p>
        <p>SUSA : iShares MSCI USA ESG Select ETF</p>`
    },
    {
        tagline: "US Mid Cap Value",
        info: "Stocks of mid-size companies with low valuations, typically worth between $2 billion and $10 billion.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>VO : Vanguard Mid Cap ETF
        </p>
        <p>VOE : Vanguard Mid Cap Value ETF
        </p>`
    },
    {
        tagline: "US Mid Cap Growth",
        info: "Stocks of mid-sized companies, typically worth between $2 billion and $10 billion with strong earnings growth.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>VO : Vanguard Mid Cap ETF
        </p>`
    },
    {
        tagline: "US Small Cap Value",
        info: "Stocks of smaller companies with lower valuations. While smaller companies can have a greater risk than larger, more established ones, they can also have greater long-term growth potential.",
        secHead: "WHAT WE BUY",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>VB : Vanguard Small Cap ETF
        </p><p>VBR : Vanguard Small Cap Value ETF
        </p>`
    },
    {
        tagline: "US Large Cap Value",
        info: "Stocks of large companies that trade at low prices relative to their peers. These big companies are typically more stable than smaller companies and generally deliver dividends.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>PXWIX : Pax Ellevate Global Women’s Leadership Fund</p>
        <p>VTV : Vanguard Value ETF</p>
        <p>VTI : Vanguard Total Stock Market ETF</p>
        <p>SUSA : iShares MSCI USA ESG Select ETF</p>`
    },
    {
        tagline: "US Small Cap Growth",
        info: "Stocks of smaller companies, typically worth less than $2 billion. These smaller companies can have greater long-term growth potential than larger companies, which can also mean greater risk.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>VB : Vanguard Small Cap ETF</p>`
    },
    {
        tagline: "Intl. Developed Markets Equity",
        info: "Stocks of companies headquartered in developed economies like Europe, Australia and Japan, representing a large part of the world economy. They have a risk and rate of return similar to that of US Total Stock Market but can provide diversification of investment risk.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>PXWIX : Pax Ellevate Global Women’s Leadership Fund</p>
        <p>ESGD : iShares MSCI EAFE</p>
        <p>VEA : Vanguard FTSE Developed Markets ETF</p>`
    },
    {
        tagline: "Emerging Markets Equity",
        info: "Stocks of companies in developing economies, such as Brazil, India, China, and South Africa. Because the economies of these countries are in a growth phase, these stocks generally have both higher risk and return, as compared to more developed markets.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>ESGE : iShares MSCI EM</p>
        <p>VWO : Vanguard FTSE Emerging Markets ETF</p>`
    },
    {
        tagline: "US Real Estate",
        info: "Investments in commercial properties, apartment complexes, and retail space, in the form of real estate investment trusts (“REITs”). Rents are paid out as dividends; REITs provide income, inflation protection, and diversification benefits.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>VNQ : Vanguard REIT ETF</p>`
    },
    {
        tagline: "Intl. Real Estate",
        info: "Investments in commercial properties, apartment complexes, and retail space outside of the US, in the form of real estate investment trust (“REITs”). Rents are paid out as dividends; REITs provide income, inflation protection, and diversification benefits.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>VNQI : Vanguard Global ex-US Real Estate ETF</p>`
    },
    {
        tagline: "US Short Term Bonds",
        info: "US government bonds, high-quality corporate bonds, and high-quality international US dollar-denominated bonds with maturities of 1-5 years.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>BSV : Vanguard Short Term Bond ETF</p>`
    },
    {
        tagline: "US Short Term Muni Bonds",
        info: "Bonds issued by US state and local governments with remaining maturities of between 1 and 5 years. Their interest is not subject to federal taxes, and their shorter maturities reduce risk.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>SHM : SPDR Nuveen Barclays Short Term Municipal Bond ETF</p>
        <p>SUB : iShares Short-Term National Muni Bond ETF</p>`
    },
    {
        tagline: "Intl. Developed Bonds",
        info: "Investment-grade bonds issued by non-US governments such as those in Western Europe, Australia, and Japan. Their credit quality is high, and they provide diversification of risk.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>BNDX : Vanguard Total International Bond ETF</p>`
    },
    {
        tagline: "US TIPS Bonds",
        info: "(Treasury Inflation-Protected) Bonds issued by the US government. Their principal value is indexed to inflation, which provides protection in an inflationary environment.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>SCHP : Schwab U.S. TIPS ETF™</p>`
    },
    {
        tagline: "US Dollar Emerging Market Bonds",
        info: "Bonds issued by governments in emerging market countries such as China, India and Russia. They offer higher yields than developed market bonds given their greater risk.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>EMB : iShares JPMorgan Emerging Markets Bond ETF</p>`
    },
    {
        tagline: "US Intermed. Term Bonds",
        info: "A broad index of US investment-grade taxable fixed income securities with maturities of at least one year.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>ACCSX : Access Community Capital Fund</p>
        <p>BND : Vanguard Total Bond Market ETF</p>`
    },
    {
        tagline: "US High Yield Muni Bonds",
        info: "Bonds issued by US state and local governments with lower credit ratings. Because of these lower ratings, these bonds pay higher interest. The interest they pay is exempt from federal taxes.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>HYD : VanEck Vectors High-Yield Municipal Bond ETF</p>`
    },
    {
        tagline: "Local Currency Emerging Market Bonds",
        info: "Bonds issued in the local currency of emerging market countries such as China, India and Russia. They offer higher yields than developed market bonds given their greater risk.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>EMLC : VanEck Vectors Local Currency Emerging Markets Bond ETF</p>`
    },
    {
        tagline: "US Intermed. Term Muni Bonds",
        info: "Bonds issued by US state and local governments. While not quite as safe as US Treasuries, the credit risk is quite low, and municipal bonds’ interest is exempt from federal taxes.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>VTEB : Vanguard Tax-Exempt Bond ETF</p>
        <p>MUB : iShares National Muni Bond ETF</p>`
    },
    {
        tagline: "FDIC Cash",
        info: "Cash held in banks insured by the Federal Deposit Insurance Corporation. It earns a very low-interest rate because it is considered very low risk.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>FDIC Cash</p>`
    },
    {
        tagline: "US High Yield Bonds",
        info: "Bonds of firms with lower credit ratings than investment-grade corporate, Treasury, and municipal bonds. Because of their lower credit ratings, these bonds pay higher interest.",
        lowerContent: ` <h3>WHAT WE BUY</h3>
        <p>SPDR Barclays Capital High Yield Bond ETF</p>`
    },
]

let box = document.querySelectorAll(".box");
   Array.from(box).forEach(function(b, i){
   console.log(b, i);
   b.addEventListener("click", function(e){

    


   console.log(e.currentTarget, i);
   if(i >= 8 && i < 10){
    document.querySelector(".contentContainer").style.backgroundColor = "#d29f13";
   } 
   else if( i >= 11 && i < 21){
    document.querySelector(".contentContainer").style.backgroundColor = "#5f8fb4";
   }
   else{
    document.querySelector(".contentContainer").style.backgroundColor = "#259591";  
   }

   document.querySelector(".popUpCover").style.display = "flex";
   
   document.getElementById("popUp_Upper").querySelector(".headContent").innerText = contentArr[i].tagline;

   document.getElementById("popUp_Upper").querySelector(".infoContent").innerText = contentArr[i].info;

   document.getElementById("popUp_Lower").innerHTML = contentArr[i].lowerContent;

   
   setTimeout(function(){
    document.querySelector(".contentContainer").style.position = "relative";
    document.querySelector(".contentContainer").style.top = "0%";
   }, 500)
   

//    document.querySelector(".contentContainer").style.transform = "translate3d(0px, 0px, 0px)";
//     document.querySelector(".contentContainer").style.transform = "scale3d(1, 1, 1)";
    // document.querySelector(".contentContainer").style.transform = "rotateX(0deg)";
    // document.querySelector(".contentContainer").style.transform = "rotateY(0deg)";
    // document.querySelector(".contentContainer").style.transform = "rotateZ(0deg)";  
    // document.querySelector(".contentContainer").style.transform = "skew( 0deg, 0deg)";  
    // document.querySelector(".contentContainer").style.transformStyle = "preserve-3d";  


   document.getElementById("closePopUp").addEventListener("click", function(){
   document.querySelector(".popUpCover").style.display = "none";
   document.querySelector(".contentContainer").style.top = "5%";
     })
                                          })
})
console.log(contentArr);


document.getElementById("openDisclosures").addEventListener("click", function(){
    document.getElementById("whiteModal").style.display = "flex";
    setTimeout(function(){
        document.getElementById("whiteModal").style.opacity = "1";
        document.getElementById("whiteModal").style.transition = "all 0.5s ease";
    }, 200)
    
})

document.getElementById("closeWhiteModal").addEventListener("click", function(){
    document.getElementById("whiteModal").style.opacity = "0";
    document.getElementById("whiteModal").style.transition = "all 0.5s ease";
    setTimeout(function(){
        document.getElementById("whiteModal").style.display = "none";
    }, 200)
})
