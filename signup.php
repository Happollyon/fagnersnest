<?php

require_once 'header.php';

echo <<<_END
<script>
    function checkuUser(user)
     {
      if (user.value=='')
          {
             document.getElementById('info').innerHTML = ''
             return
          }
      params = "user=" + user.value;
      request = new ajaxRequest();
      request.open("POST", "checkuser.php", true);
      request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
      request.setRequestHeader("Content-length",params.length)
      request.setRequestHeader("Connection","close");
      request.onreadystatechange=function() 
      {
       if(this.readyState == 4)
           if(this.status==200)
               if(this.responseText != null)
                   document.getElementById('info').innerHTML= this.responseText
                   
      }
      request.send(params)
    }
    function ajaxRequest()
    {
        try {let request = new XMLHttpRequest()}
        catch (e1) 
        { try {request = new ActiveXObject("Msxml2.XMLHTTP")}
          catch (e2) { try{ request= new ActiveXObject("Microsoft.XMLHTTP")}
            catch (e3) { request = false
              
            }
            
          }
        }
    return request
    }
    
</script>
<div calss ="main"><h3>please enter your details to singup</h3>
_END;
$error = $user = $pass ="";
if(isset($_SESSION['user']))
{
    destroySession();
}
if(isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    if ($user == "" || $pass == "")
    {
        $error="not all fields were entered<br><br>";
    }else
    {
        $result = queryMysql("SELECT * FROM members WHERE user='$user'");
        if($result->num_rows)
            $error="that username already exists";
        else
            {
                queryMysql("INSERT INTO members(user,pass) VALUES('$user', '$pass')");
                die("<h4>Account created</h4>please log in.<br><br>");
            }
    }
}
echo<<<_END
<form method='post' action="signup.php"> $error
<span class='fieldname'>username<span>
<input type='text' maxlength='16' name='user' value='$user' onBlur='checkUser(this)><span id='info'></span><br>
<span class='fieldname'>password</span>
<input type='password' maxlength='16' name='pass' value='$pass'><br>

_END;
?>
<span class='fieldname'>&nbsp;</span>
<input type="submit" value="sign up">
</form> </div><br>
</body>
</html>