function showContact() {
    var selection = document.getElementById("contactInfo").value;

    if (selection == "United States") {
        hideContact();
        document.getElementById("USContactAddr").style.display = "inline";
        document.getElementById("USContactNo").style.display = "inline";
    } else if (selection == "Australia") {
        hideContact();
        document.getElementById("AUContactAddr").style.display = "inline";
        document.getElementById("AUContactNo").style.display = "inline";
    } else if (selection == "select") {
        hideContact();
    }

}

function hideContact() {
    document.getElementById("USContactAddr").style.display = "none";
    document.getElementById("USContactNo").style.display = "none";
    document.getElementById("AUContactAddr").style.display = "none";
    document.getElementById("AUContactNo").style.display = "none"
}