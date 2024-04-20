
function validateForm() {
    // Get form input elements.
    let fname = document.forms["myForm"]["fname"];
    let lname = document.forms["myForm"]["lname"];
    let email = document.forms["myForm"]["email"];
    let select = document.forms["myForm"]["select_age"];

    // Get radio buttons for gender.
    let radios = document.getElementsByName("gender");
    // Variable to track if a gender option is selected.
    let radioSelected = false; 

    // Validation for first name.
    if (fname.value == ""){
        alert("Please Enter Your First Name.");
        fname.focus();
        return false;
    }
    else if (!/^[a-zA-Z\s]*$/.test(fname.value)){
        alert("Please Enter a valid First Name containing only letters and white spaces.");
        fname.focus();
        return false;
    }

    // Validation for last name.
    if (lname.value == ""){
        alert("Please Enter Your Last Name.");
        lname.focus();
        return false;
    }
    else if (!/^[a-zA-Z\s]*$/.test(lname.value)){
        alert("Please Enter a valid Last Name containing only letters and white spaces.");
        lname.focus();
        return false;
    }

    // Validation for email.
    if (email.value.trim() === ""){
        alert("Please Enter Your Email.");
        email.focus();
        return false;
    }
    if (email.value.indexOf("@", 0) < 0 || email.value.indexOf(".") < 0){
        alert("Please Enter a Valid Email Address.");
        email.focus();
        return false;
    }

    // Validation for gender.
    // Loop through radio buttons to check if any is selected.
    for (let i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            radioSelected = true;
            break;
        }
    }
    // If no gender option is selected, alert and return false.
    if (!radioSelected) {
        alert("Please Select a Gender.");
        return false;
    }

    // Validation for age selection.
    if (select.value === "Select your age group") {
        alert("Please Select Your Age.");
        select.focus();
        return false;
    }   
   
}
