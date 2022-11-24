vmsDef = 0;
let h = window.innerHeight + "px";

function resH(ElmId) {
    const elm = document.getElementById(ElmId);
    if (elm != null) {
        elm.style.height = h;
    }
}
function AddedClass(ElmId, AddClass) {
    document.getElementById(ElmId).className += " " + AddClass;
}
if (window.innerWidth <= 992) {
    resH("header-image");
    resH("donite");
    AddedClass("header-image", "header-image-res");
    resH("download-app");

} else {
    AddedClass("header-image", "header-image");
}

function vmsNumber(vmsInt, vmsId) {
    document.getElementById(vmsId).innerHTML = vmsDef++;
    vmsSetTimeout = setTimeout(function () {
        vmsNumber(vmsInt, vmsId)
    }, 1);
    if (vmsDef > vmsInt) {
        clearTimeout(vmsSetTimeout);
    }
}
function LiveTime() {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        document.getElementById("date-time").innerHTML = this.responseText;
    }
    xmlhttp.open("GET", "index.php/Time_C/get_now");
    xmlhttp.send();
    setTimeout(() => {
        LiveTime();
    }, 10000);
}


const txt = document.getElementById("numcardkesavarzi");
const elm = document.getElementById("numcardkesavarzi-card");
        elm.addEventListener("click", function () {
            navigator.clipboard.writeText(txt.innerText).then(function () {
                alert("شماره کارت کپی شد");
            });
        });



window.onload = LiveTime();