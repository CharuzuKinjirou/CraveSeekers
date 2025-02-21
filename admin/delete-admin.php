<?php 
    //include constants.php file here
    include('../config/constants.php');


    //1. get the ID of Admin to be deleted
     echo $id = $_GET['id'];

    //2.Create SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Exectue the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==true)
    {
        //Query executed successfully and Admin deleted
        //echo "Admin Deleted"
        //Create session variable to display message
        $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //failed to Delete Admin
        //echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin, Try Again Later.</div>";
        header('localation:'.SITEURL.'admin/manage-admin.php');
    }


    //3.Redirect to Manage Admin page with message (success/error)
?>
