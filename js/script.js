
// Favorite(heart icon) in navbar
var heart = document.querySelector(".icons #heart");
var show = document.getElementById("fav");

heart.onclick=function(){
    show.style.display = "block";
}

function cancel(){
    show.style.display = "none";
}

/* Cart in navbar */
var cart = document.querySelector(".icons #addcart");
var showcarts = document.getElementById("cart");

cart.onclick = function(){
    showcarts.classList.toggle("showcart");
}

/* Sign in and User account */
var userIcon = document.getElementById("user");
var showAcc = document.getElementById("showUser");
var exitUser = document.querySelector("#showUser i");

userIcon.onclick = function(){
    showAcc.style.display = "block";
}

exitUser.onclick = function(){
    showAcc.style.display = "none";
}

/* Search in navbar */
let searchIcon = document.getElementById("search");
var showSearch = document.getElementById("searching");

searchIcon.onfocus = function(){
    window.location.replace("http://localhost:8080/Nira/Projects/Zara/search.php");
}

// New arrivals and more in home page
function pageNum(num){
    var number = num;
    var pageOne = document.getElementById("row1");
    var pageTwo = document.getElementById("row2");
    console.log(number);
    var pageThree = document.getElementById("row3");
    var page = document.getElementById("currentPage").innerText;
    var newcurrentPage;
    // page numbers 
    if(page == ''){
        oldcurrentPage = 1;
    }else if(page == 2 || page == 3){
        oldcurrentPage = parseInt(page);
    }else{
        oldcurrentPage = 1;
    }

    // new current page numbers
    if (number == 1 || number == 2 || number == 3){
        newcurrentPage = number;
    }else if (number == 'prev'){
        newcurrentPage = oldcurrentPage - 1;
    }else {
        newcurrentPage = oldcurrentPage + 1;
    }

    // Display page
    if(newcurrentPage == 1){
        pageOne.style.display = "flex";
        pageTwo.style.display = "none";
        pageThree.style.display = "none";
    }else if(newcurrentPage == 2){
        pageOne.style.display = "none";
        pageThree.style.display = "none";
        pageTwo.style.display = "flex";
    }else if(newcurrentPage == 3){
        pageOne.style.display = "none";
        pageTwo.style.display = "none";
        pageThree.style.display = "flex";
    }else {
        pageOne.style.display = "flex";
        pageTwo.style.display = "none";
        pageThree.style.display = "none";
    }
    console.log(newcurrentPage);
    document.getElementById("currentPage").innerHTML = newcurrentPage;
}

/* Product detail */
var mainImg = document.getElementById("mainImg");
var smallImg = document.getElementsByClassName("smallImg");

smallImg[0].onclick= function(){
    mainImg.src = smallImg[0].src;
    smallImg[0].style.setProperty('border-left', '2.3px solid rgb(50, 49, 49)');
    smallImg[0].style.setProperty('padding-left', '5px');
    smallImg[1].style.cssText = `border:none; padding:0px;`;
    smallImg[2].style.cssText = `border:none; padding:0px;`;
    smallImg[3].style.cssText = `border:none; padding:0px;`;
}

smallImg[1].onclick= function(){
    mainImg.src = smallImg[1].src;
    smallImg[1].style.setProperty('border-left', '2.3px solid rgb(50, 49, 49)');
    smallImg[1].style.setProperty('padding-left', '5px');
    smallImg[0].style.cssText = `border:none; padding:0px;`;
    smallImg[2].style.cssText = `border:none; padding:0px;`;
    smallImg[3].style.cssText = `border:none; padding:0px;`;
}

smallImg[2].onclick= function(){
    mainImg.src = smallImg[2].src;
    smallImg[2].style.setProperty('border-left', '2.3px solid rgb(50, 49, 49)');
    smallImg[2].style.setProperty('padding-left', '5px');
    smallImg[0].style.cssText = `border:none; padding:0px;`;
    smallImg[1].style.cssText = `border:none; padding:0px;`;
    smallImg[3].style.cssText = `border:none; padding:0px;`;
}

smallImg[3].onclick= function(){
    mainImg.src = smallImg[3].src;
    smallImg[3].style.setProperty('border-left', '2.3px solid rgb(50, 49, 49)');
    smallImg[3].style.setProperty('padding-left', '5px');
    smallImg[0].style.cssText = `border:none; padding:0px;`;
    smallImg[1].style.cssText = `border:none; padding:0px;`;
    smallImg[2].style.cssText = `border:none; padding:0px;`
}

/* View more and view less button in shop.php and more */
function viewBtn(value){
    var actions = value;
    var viewMore_btn = document.getElementById("viewMore_btn");
    var viewLess_btn = document.getElementById("viewLess_btn");
    var paragraph = document.getElementById("paragraph");
    if(actions == 'viewmore'){
        paragraph.style.display = "flex";
        viewMore_btn.style.display = "none";
        viewLess_btn.style.display = "block";
    }else {
        paragraph.style.display = 'none';
        viewLess_btn.style.display = 'none';
        viewMore_btn.style.display = 'block';
    }
}

// Faqs Page Search 
function searchfaq(){
    var oldsearch = document.getElementsByClassName("searchOne");
    var inputs = document.getElementsByClassName("searchTwo");
    inputs.style.display = "block";
    oldsearch.style.display = "none";

}
