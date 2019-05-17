<?php
require_once 'header.php';
if(isset($_SESSION['user'])) {
    destroySession();
    echo "<div class='main'> you have been nlogged out. please" .
        "<a href='index.php'> click here <a>to refresh the screen";
}else
    echo"you can not logout because you are not logged in";
?>
<br>
<br>


</div>
</body>
</hml>