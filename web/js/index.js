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

function buy() {
    var c1 = document.getElementById("c1");
    var c2 = document.getElementById("c2");
    var c3 = document.getElementById("c3");
    var c4 = document.getElementById("c4");
    c1.style.display = "none";
    c2.style.display = "block";
    c3.style.display = "none";
    c4.style.height = "150px";
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
};

function back() {
    var c1 = document.getElementById("c1");
    var c2 = document.getElementById("c2");
    var c3 = document.getElementById("c3");
    var c4 = document.getElementById("c4");
    c1.style.display = "block";
    c2.style.display = "none";
    c3.style.display = "block";
    c4.style.height = "230px";
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
};