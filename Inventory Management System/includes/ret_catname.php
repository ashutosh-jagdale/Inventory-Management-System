<?php
include_once("../database/constants.php");
include_once("user.php");
$user = new User();
echo $user->return_cat($_POST["val"]);

?>