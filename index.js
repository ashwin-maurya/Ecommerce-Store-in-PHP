console.log('Code');

function search() {
    var search = document.getElementById("msearch");
    var user = document.getElementById("user");
    search.style.display = "flex";
    user.style.display = "none";

};

function cut() {
    var search = document.getElementById("msearch");
    var user = document.getElementById("user");
    search.style.display = "none";
    user.style.display = "block";
};

$(document).ready(function() {
    $("#mainbody").load("home.html");
});

$("#home").click(function() {
    $("#mainbody").load("home.html");
});

$("#about").click(function() {
    $("#mainbody").load("about.html");
});

$("#contact").click(function() {
    $("#mainbody").load("contact.html");
});


window.onscroll = function() {

    var mybutton = document.getElementById("myBtn");


    if (document.documentElement.scrollTop > 200) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}


function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}