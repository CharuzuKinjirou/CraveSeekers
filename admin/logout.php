<?php
    //Include constants.php for SITEURL 
    include('../config/constants.php');
    //1. Destory the Session 
    session_destroy();
    
    //2. Redirect to Login Page 
    header('Location:'.SITEURL.'admin/login.php');

?>