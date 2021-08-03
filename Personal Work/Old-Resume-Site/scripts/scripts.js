function showContact() {
    var selection = document.getElementById("contactInfo").value;

    if (selection == "United States") {
        hideContact();
        document.getElementById("USContact").style.display = "inline";
    } else if (selection == "Australia") {
        hideContact();
        document.getElementById("AUContact").style.display = "inline";
    } else if (selection == "select") {
        hideContact();
    }

}

function hideContact() {
    document.getElementById("USContact").style.display = "none";
    document.getElementById("AUContact").style.display = "none";
}

function showNavbar() {
    var x = document.getElementById("navbar");
    if (x.className === "navbar") {
        x.className += " responsive";
    } else {
        x.className = "navbar";
    }
}