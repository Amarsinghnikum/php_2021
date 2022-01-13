<?php

session_start();
include_once "management/includes/pro_api_db.php";
session_destroy();
 header("location:".$wwwroot);




?>