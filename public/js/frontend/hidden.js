var count1 = 1;

function set_hidden1() {
    if (count1 == 0) {
        document.getElementById("menu_hidden1").style.display = 'none';
        document.getElementById("icon1").style.stroke = "currentColor";
        document.getElementById("group1").style.marginBottom = "0px";
        count1 = 1;
    } else {
        document.getElementById("menu_hidden1").style.display = 'block';
        document.getElementById("icon1").style.stroke = "orange";
        document.getElementById("group1").style.marginBottom = "120px";
        count1 = 0;
    }
}

var count2 = 1;

function set_hidden2() {
    if (count2 == 0) {
        document.getElementById("menu_hidden2").style.display = 'none';
        document.getElementById("icon2").style.stroke = "currentColor";
        document.getElementById("group2").style.marginBottom = "0px";
        count2 = 1;
    } else {
        document.getElementById("menu_hidden2").style.display = 'block';
        document.getElementById("icon2").style.stroke = "orange";
        document.getElementById("group2").style.marginBottom = "170px";
        count2 = 0;
    }
}

var count3 = 1;

function set_hidden3() {
    if (count2 == 0) {
        document.getElementById("menu_hidden3").style.display = 'none';
        document.getElementById("icon3").style.stroke = "currentColor";
        document.getElementById("group3").style.marginBottom = "0px";
        count2 = 1;
    } else {
        document.getElementById("menu_hidden3").style.display = 'block';
        document.getElementById("icon3").style.stroke = "orange";
        document.getElementById("group3").style.marginBottom = "165px";
        count2 = 0;
    }
}