function validateButton(f) {
    var k = document.forms["form1"].getElementsByTagName("input");
    for (var i = 0; i < k.length - 1; i++) {
        validate(k[i]);
    }
}

function validate(f) {
    //form validation
    if (f.value == null || f.value == "") {
        f.style.backgroundColor = "#EFDBB1";

    } else if (f.className != 'submit') {
        f.style.backgroundColor = "white";
    }
    if (f.id == "email")
        if (!validateEmail(f.value)) f.style.backgroundColor = "#EFDBB1";
        else f.style.backgroundColor = "white";

    if (f.id == "tel")
        if (!validateTelephone(f.value)) {
            f.style.backgroundColor = "#EFDBB1";
            f.addEventListener("blur", verifyTelephone(f));
        }
        else {f.style.backgroundColor = "white";
              f.setCustomValidity('');}

    if (f.id == "comment") {
        var y = document.forms["form1"]["name"].value;
        if (y == null || y == "")
            f.style.backgroundColor = "#EFDBB1";
        else f.style.backgroundColor = "white";
    }




}

function verifyTelephone(input) {

    // the provided value doesn’t match the primary email address
    // the provided value doesn’t match the primary email address
   if (!validateTelephone(input))
        input.setCustomValidity('Telephone must be in correct format');
    else {
        // input is valid -- reset the error message
        console.log("tu");
        input.setCustomValidity('');
    }

}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validateTelephone(tel) {
    var re = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.\/]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{3}$/;
    console.log(re.test(tel));
    return re.test(tel);
}