<?php
require_once 'header.php';
if(!$loggedin) die('you need to connect');
if(isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else $view = $user;
if(isset($_POST['text']))
{
    $text = sanitizeString($_POST['text']);
    if ($text!= "")
    {
        $pm = substr(sanitizeString($_POST['pm']),0,1);
        $time = time();
         queryMysql(" INSERT INTO messages VALUES(NULL, '$user','$view','$pm','$time','$text')");

    }
}
if($view !="")
{
    if ($view == $user) $name1 = $name2 ="your";
    else
        {
            $name1= "<a href='members.php?view'>$view<a/>'s";
            $name2="$view's'";


    }
    echo "<div class='main'><h3>$name1 messages</h3>";
    showProfile($view);
    echo <<<_END
<form method="post" action="messages.php?view=$view">
type here to leave a msg: <br>
<textarea name="text" cols="40" rows="3"></textarea><br>
Public<input type="radio" name="pm" value="0" checked="checked">
Private<input type="radio" name="pm" value="1" >
<input type="submit" value="post message">
_END;
 if (isset($_GET['erase']))
 {
     $erase=sanitizeString($_GET['erase']);
     queryMysql("DELETE FROM messages WHERE id='$erase' AND  recip='$user'");

 }
 $query ="SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
 $result = queryMysql($query);
 $num= $result->num_rows;
for($j=0; $j<$num; ++$j)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if($row['pm'] == 0 || $row['auth']==$user || $row['recip']==$user)
    {
        echo date('M jS \'Y g:ia:', $row['time']);
        echo "<a href='messages.php?view=". $row['auth'].  "'>".
            $row['auth']."</a>";
         if($row['pm'] == 0)
         {
             echo "wrote: &quot;" . $row['message'] . "&quot; ";
         } else echo  "whispered: <span class='whisper'> &quot;" .
             $row['message'] . "&quot;</span>";
         if ($row['recip']) {
             echo "[<a href='messages.php?view=$view" .
                 "&erase=" . $row['id'] . "'>erase</a>'";
         }    echo "<br>";

    }
}
}

?>