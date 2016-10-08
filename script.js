function validate_form() {
    var x = document.forms["analyzer-from"]["search"].value;
    if (x == null || x == "") {
        alert("Search Keywords for Tweets must be filled out");
        return false;
    }
    var x = document.forms["analyzer-from"]["dinas1"].value;
    if (x == null || x == "") {
        alert("Keywords for Dinas1 must be filled out");
        return false;
    }
    var x = document.forms["analyzer-from"]["dinas2"].value;
    if (x == null || x == "") {
        alert("Keywords for Dinas1 must be filled out");
        return false;
    }
    var x = document.forms["analyzer-from"]["dinas3"].value;
    if (x == null || x == "") {
        alert("Keywords for Dinas1 must be filled out");
        return false;
    }
    var x = document.forms["analyzer-from"]["dinas4"].value;
    if (x == null || x == "") {
        alert("Keywords for Dinas1 must be filled out");
        return false;
    }
    var x = document.forms["analyzer-from"]["dinas5"].value;
    if (x == null || x == "") {
        alert("Keywords for Dinas1 must be filled out");
        return false;
    }
}