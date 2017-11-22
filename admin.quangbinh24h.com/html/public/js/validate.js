<script language="JavaScript" type="text/javascript">


// Javascript validation functions
// http://www.designplace.org/


//function to check empty fields

function isEmpty(strfield1, strfield2, strfield3) {


//change "field1, field2 and field3" to your field names
strfield1 = document.forms[0].field1.value 
strfield2 = document.forms[0].field2.value
strfield3 = document.forms[0].field3.value

  //name field
    if (strfield1 == "" || strfield1 == null || !isNaN(strfield1) || strfield1.charAt(0) == ' ')
    {
    alert("\"Name\" is a mandatory field.\nPlease amend and retry.")
    return false;
    }

  //url field 
    if (strfield2 == "" || strfield2 == null || strfield2.charAt(0) == ' ')
    {
    alert("\"URL\" is a mandatory field.\nPlease amend and retry.")
    return false;
    }

  //title field 
    if (strfield3 == "" || strfield3 == null || strfield3.charAt(0) == ' ')
    {
    alert("\"Link title\" is a mandatory field.\nPlease amend and retry.")
    return false;
    }
    return true;
}


//function to check valid email address
function isValidEmail(strEmail){
  validRegExp = /^[^@]+@[^@]+.[a-z]{2,}$/i;
  strEmail = document.forms[0].email.value;

   // search email text for regular exp matches
    if (strEmail.search(validRegExp) == -1) 
   {
      alert('A valid e-mail address is required.\nPlease amend and retry');
      return false;
    } 
    return true; 
}


//function that performs all functions, defined in the onsubmit event handler

function check(form){
if (isEmpty(form.field1){
  if (isEmpty(form.field2){
    if (isEmpty(form.field3){
		if (isValidEmail(form.email){
		  return true;
		}
	  }
  }
}
return false;
}

</script>