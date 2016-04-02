function validateButton(f) {
    var k = document.forms["form1"].getElementsByTagName("input");
    for (var i = 0; i < k.length-1; i++) {
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
    
    if (f.id=="dob"){
         if (!validateTelephone(f.value)) {
            f.style.backgroundColor = "#EFDBB1";
              console.log(f.value);
            f.addEventListener("blur", verifyDate(f));
        }
        else {f.style.backgroundColor = "white";
              f.setCustomValidity('');}
    }




}
function validateDate(input){ 
      var today =new Date();
    var inputDate=new Date(input);
      if (inputDate == ""){
          return false;
      } else if (inputDate > today) {
          return false;
      }
    else {
       
          return true;
      }
  }

function verifyTelephone(input) {
   if (!validateTelephone(input.value))
        input.setCustomValidity('Telephone must be in correct format');
    else {
        // input is valid -- reset the error message
        console.log("Dobar format");
        input.setCustomValidity('');
    }

}

function verifyDate(input) {
   if (!validateDate(input.value))
        input.setCustomValidity('Date must be valid');
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