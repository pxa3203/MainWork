//external JS for WP A1

window.onscroll = function () { stickyHeader() };
function stickyHeader() {
    var navbar = document.getElementById("navbar");
    var stick = header.offsetTop;

    if (window.pageYOffset > stick) {
        navbar.classList.add("stick");
    } else {
        navbar.classList.remove("stick");
    }
}
var age = 1;
function validateReg() {

    fName = document.getElementById("fName").value;
    surname = document.getElementById("surname").value;
    email = document.getElementById("email").value;
    emailCheck = checkEmail(email);
    age = this.age;
    choice1 = document.getElementById("checkYes").checked;
    choice2 = document.getElementById("checkNo").checked;
    membership1 = document.getElementById("calc").value;
    membership2 = document.getElementById("duration").value;

    if (fName == "") {
        hideErrors();
        document.getElementById("fNameMsg").style.display = "inline";
        document.getElementById("fName").select();
        document.getElementById("fName").focus();
        return false;
    }
    else if (surname == "") {
        hideErrors();
        document.getElementById("surnameMsg").style.display = "inline";
        document.getElementById("surname").select();
        document.getElementById("surname").focus();
        return false;
    }
    else if (emailCheck == false) {
        hideErrors();
        document.getElementById("emailMsg").style.display = "inline";
        document.getElementById("email").select();
        document.getElementById("email").focus();
        return false;
    }
    else if ((choice1 == "") && (choice2 == "")) {
        hideErrors();
        document.getElementById("checkMsg").style.display = "inline";
        return false;
    }
    else if (age < 16) {
        hideErrors();
        document.getElementById("ageMsg").style.display = "inline";
        document.getElementById("ageSlider").select();
        document.getElementById("ageSlider").focus();
        return false;
    }
    else if (membership1 == "select") {
        hideErrors();
        document.getElementById("membershipMsg").style.display = "inline";
        return false;
    }

    else if (membership2 == "select") {
        hideErrors();
        document.getElementById("durationMsg").style.display = "inline";
        return false;
    }

}

function ageUpdate(age) {
    document.querySelector("#ageOutput").value = age;
    this.age = age;
}

//Shekhar's function from Week 3 Lecture Example on how to use Reg Ex and validate Email
function checkEmail(inputvalue) {
    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    if (pattern.test(inputvalue)) {
        return true;
    } else {
        return false;
    }

}
//clears errors to run complete re-scan on re-submit
function hideErrors() {
    document.getElementById("fNameMsg").style.display = "none";
    document.getElementById("surnameMsg").style.display = "none";
    document.getElementById("emailMsg").style.display = "none";
    document.getElementById("ageMsg").style.display = "none";
    document.getElementById("checkMsg").style.display = "none";
    document.getElementById("membershipMsg").style.display = "none";
    document.getElementById("durationMsg").style.display = "none";
}
var refferedDiscount = 0;
//reports if the client is refered
function individualReferred() {
    refferedYes = document.getElementById("checkYes").checked;
    if (refferedYes != "") {
        this.refferedDiscount = 5;
        return true;
    }
    else {
        this.refferedDiscount = 0;
        return false;
    }
}

function youthCheck() {
    members = document.getElementById("members").value;
    youths = document.getElementById("youth").value;
    if (youths > members) {
        return true;
    }
    else {
        return false;
    }
}
//This function decides whether to show the calculator based on what type of membership is selected.
function showCalculator() {
    membership = document.getElementById("calc").value;
    if (membership == "individual") {
        if (individualReferred() == true) {
            document.getElementById("memCalc").style.display = "none";
            document.getElementById("singleMember").style.display = "none";
            document.getElementById("singleMemberDiscount").style.display = "inline";
        }
        else {
            document.getElementById("memCalc").style.display = "none";
            document.getElementById("singleMemberDiscount").style.display = "none";
            document.getElementById("singleMember").style.display = "inline";
        }
    }
    if (membership == "family") {
        document.getElementById("singleMember").style.display = "none"
        document.getElementById("singleMemberDiscount").style.display = "none";
        document.getElementById("memCalc").style.display = "inline";
        return false;
    }
    if (membership == "select") {
        document.getElementById("memCalc").style.display = "none";
        document.getElementById("singleMemberDiscount").style.display = "none";
        document.getElementById("singleMember").style.display = "none";
    }
}

//the primary sorting of my function is how many members are entered into the input box. Then it checks if the member is referred. Lastly it checks on the numbers of youths (aged 16 - 19) entered in the input
//box. The bulk of the work is done in printCost(). Please read above printCost() function to understand that code. 
function calculator() {
    members = document.getElementById("members").value;
    youths = document.getElementById("youth").value;
    totalCost = 0;
    if (members == "") {
        document.getElementById("minFamily").style.display = "none";
        printCost();
    }
    else if (members < 2) {
        document.getElementById("minFamily").style.display = "inline";
        if (individualReferred() == true) {
            if (youths == 1) {
                totalCost = "$43.48/month"
                document.querySelector("#costOutput").value = totalCost;
            }
            else {
                totalCost = "$47.50/month";
                document.querySelector("#costOutput").value = totalCost;
            }
        }
        else {
            if (youths == 1) {
                totalCost = "$45/month"
                document.querySelector("#costOutput").value = totalCost;
            }
            else {
                totalCost = "$50/month";
                document.querySelector("#costOutput").value = totalCost;
            }
        }
    }
    else if (members == 2) {
        if (youths != "" && youths >= 0) {
            if (individualReferred() == true) {
                if (youthCheck() == true) {
                    document.getElementById("tooManyYouths").style.display = "inline";
                }
                else {
                    printCost();
                }
            }
            else {
                if (youthCheck() == true) {
                    document.getElementById("tooManyYouths").style.display = "inline";
                }
                else {
                    printCost();
                }
            }
        }
        else {
            if (individualReferred() == true) {
                printCost();
            }
            else {
                printCost();
            }
        }
    }
    else if (members > 2 && members < 6) {
        if (youths != "" && youths >= 0) {
            if (individualReferred() == true) {
                if (youthCheck() == true) {
                    document.getElementById("tooManyYouths").style.display = "inline";
                }
                else {
                    printCost();
                }
            }
            else {
                if (youthCheck() == true) {
                    document.getElementById("tooManyYouths").style.display = "inline";
                }
                else {
                    printCost();
                }
            }
        }
        else {
            if (individualReferred() == true) {
                printCost();
            }
            else {
                printCost();
            }
        }
    }
    else if (members > 5) {
        if (youths != "" && youths >= 0) {
            if (individualReferred() == true) {
                if (youthCheck() == true) {
                    document.getElementById("tooManyYouths").style.display = "inline";
                }
                else {
                    printCost();
                }
            }
            else {
                if (youthCheck() == true) {
                    document.getElementById("tooManyYouths").style.display = "inline";
                }
                else {
                    printCost();
                }
            }
        }
        else {
            if (individualReferred() == true) {
                printCost();
            }
            else {
                printCost();
            }
        }
    }
}


//the printCost() function is the main calculations for the membership calculator. It sets all the entered details to variables, and then sets the discount based on how many members there are. It checks to make
//sure the discount doesnt become too large based on the number of members. Then the function does simple math to calculate the total with the discounts. Then outputs the total and updates the client-side.
function printCost() {
    members = document.getElementById("members").value;
    youths = document.getElementById("youth").value;
    memberDiscount = 0;
    document.getElementById("tooManyYouths").style.display = "none";
    document.getElementById("minFamily").style.display = "none";

    if (members == 2) {
        totalDiscount = ((((youths * 10) + memberDiscount + this.refferedDiscount) / 100) + 1);
        totalBeforeDiscount = 70;
        totalWithDiscount = (totalBeforeDiscount / totalDiscount);
        totalCost = "$" + totalWithDiscount.toFixed(2) + "/month";
        document.querySelector("#costOutput").value = totalCost;
    }
    else {
        if ((members * 2.5) > 12.5) {
            memberDiscount = 12.5;
        }
        else {
            memberDiscount = (members * 2.5);
        }
        totalDiscount = ((((youths * 10) + memberDiscount + this.refferedDiscount) / 100) + 1);
        totalBeforeDiscount = (members * 40);
        totalWithDiscount = (totalBeforeDiscount / totalDiscount);
        totalCost = "$" + totalWithDiscount.toFixed(2) + "/month";
        document.querySelector("#costOutput").value = totalCost;
    }
}

//opens member name box when yes box is checked under the reffered question on the Registration page.
function refferedByWho() {
    checkBox = document.getElementById("checkYes").checked;

    if (checkBox != ""){
        document.getElementById("byWho").style.display = "inline";
    }
    else if (checkBox == ""){
        document.getElementById("byWho").style.display = "none";
    }
}
