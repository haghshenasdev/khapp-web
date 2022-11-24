window.onload = removeloding();

function removeloding() {
    document.getElementById("loaderbg").style.display = "none";
}
function showloding() {
    document.getElementById("loaderbg").style.display = "inherit";
}

//show loding from click all links
const links = Array.from(document.getElementsByTagName('a'));
links.forEach(element => {
    element.addEventListener('click', event => {
        if (!element.classList.contains("ari-fancybox")) {
            ChangeOutTitle("<div id='loader' class='d-flex justify-content-end' style='width: 20px; height: 20px;margin: 5px;position: static;float: right;'></div><div class='mt-2 ml-2 w-100'> درحال باز کردن صفحه...</div>");
        }
    });
});

window.onpagehide = (event) => {
    if (event.persisted) {
        ResetTitle();
    }
}

var curentTitle = "";

function ChangeTitle(title) {
    document.getElementById('application_title').innerHTML = title;
}

function ChangeOutTitle(title) {
    curentTitle = document.getElementById('application_title').innerHTML;
    document.getElementById('application_title').outerHTML = title;
}

function ResetTitle() {
    document.getElementById('application_title_div').innerHTML = "<p id='application_title'>"+curentTitle+"</p>";
}