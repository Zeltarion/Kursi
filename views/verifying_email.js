$(document).ready(function()
{ 
 $("#auth-login").keyup(function()
 { 
    var email = $("#auth-login").val();
  
    if(email != 0)
    {
     if(isValidEmailAddress(email))
     {
      $("#validEmail").css(
      {
       "background-image": "url('images/validyes.png')"
      });
     } 
     else 
     {
      $("#validEmail").css(
      {
       "background-image": "url('images/validno.png')"
      });
     }
    } 
    else 
    {
     $("#validEmail").css(
     {
      "background-image": "none"
     }); 
    }
  
 });
  
});
  
 function isValidEmailAddress(emailAddress)
 {
  var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  return pattern.test(emailAddress);
 }
