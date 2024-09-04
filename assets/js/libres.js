function huecosLibres(str) {
    var xmlhttp;
    if (str == "") {
        document.getElementById("hueco").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("hueco").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "AjaxHuecosLibres.php?pasillos=" + str, true);
    xmlhttp.send();
}
function lejasLibres(str) {
    var xmlhttp;
    if (str == "") {
        document.getElementById("lejas").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("lejas").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "AjaxLejasLibres.php?estanterias=" + str, true);
    xmlhttp.send();
}