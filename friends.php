<?php
require_once 'header.php';

if(!$loggedin) die('you are not logged in.');
if(isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else $view= $user;

if($view == $user)
{
    $name1 = $name2 = "your";
    $name3 = " you are";

}
else
    {
        $name1 ="<a href='members.php?view=$view'>$view</a> 's";
        $name2="$view 's";
        $name3="$view is";

    }
echo "<div class='main'>";
//uncoment this line if you wish to view the users profile
//showProfile($view);
$followers = array();
$following= array();
$result = queryMysql("SELECT * FROM friends WHERE user= '$view' ");
$num = $result->num_rows;
for($j=0; $j<$num;++$j)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $followers[$j] = $row['friend'];
}
$result = queryMysql("SELECT * FROM friends WHERE user= '$view'");
$num = $result->num_rows;
for($j = 0; $j<$num; ++$j)
{
    $row = $result->num_rows;
    $following[$j] = $row['user'];
}
$mutual = array_intersect($followers , $following);
$followers = array_diff($followers,$mutual);
$following = array_diff($following, $mutual);
$friends= FALSE;
if(sizeof($mutual))
{
    echo "<span class='subhead'> $name2 mutual friends</span><ul></ul>";
    foreach($mutual as $friend)
    {
        echo "<li><a href='members.php?view=$friend'>$friend</a>";

    }echo"</ul>";

}
if (sizeof($followers))
{
    echo "<span class='subhead'> $name2 followers </span><ul>";
    foreach($followers as $friend)
    {
        echo "<li><a href='members.php?view=$friend'>$friend</a>";

    }echo "</ul>";
    $friends = TRUE;
}
if(sizeof($following))
{
    echo"<span class='subhead'> $name3 following</span><ul></ul>";
    foreach($following as $friend)
    {
        echo"<li><a href='members.php?view=$friend'>$friend</a>";

    }echo "</ul>";
    $friends = TRUE;

}
if(!$friends)
{
    echo "<br>You dont have any friends<br><br>";

}echo "<a class='button' href='messages.php?view=$view'>view $name2 messages</a>";

?>
</div><br>
</body>
</html>
