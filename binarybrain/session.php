<?php
if(!session_id())
{
	session_start();
}

if(isset($_SESSION['id']) != session_id())
{
    header ('location: login.php');
}

?>