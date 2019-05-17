<?php
require_once 'header.php';
echo"<div class='main'><h3>Please enter your details to log in</h3>";
$error = $user = $pass ="";
if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    if ($user == ""|| $pass == "")
        $error = "not all fields were entered.";
    else
        { $result = queryMysql("SELECT user,pass FROM members WHERE user='$user' AND pass='$pass'");
        if ($result->num_rows == 0)
        {
            $error = "<span class='error'> username/password invalid</span><br><br>";
        }else
            {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            die("you are now logged in. Please <a href = 'members.php'>click here</a> to continue.<br><br>");
        }

    }
}
echo <<<_END
<form method="post" action="login.php">$error
<span class="fieldname">username</span><input type="text" maxlength="16" name="user" ><br>
<span class="fieldname">password</span><input type="password" maxlength="16" name="pass" ><br>
_END;

?>
<br>
<span class="fieldname">&nbsp;</span>
<input type="submit" value="Login">
</form><br>
</body>
</html>
