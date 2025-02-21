<?php
    //Include Constants File 
    include('../config/constants.php');
    
    //echo "Delete Page"; 
    //Check whether the id and image_name value is set or not 
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the value and Delete 
        //echo "Get Value and Delete"; 
        $id = $_GET['id']; 
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available 
        if($image_name != "")
        {
            //Image is Available. So remove it 
            $path = "../images/food/".$image_name; 
            //REmove the Image 
            $remove = unlink($path);

            //IF failed to remove image then add an error message and stop the process 
            if($remove==false)
            {
                // Set the Session Message 
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image file.</div>"; 
                //Redirect to Manage Category page 
                header('Location:'.SITEURL.'admin/manage-food.php'); 
                //Stop the Process 
                die();
            }
        }

            //Delete Data from Database
            //SQL Query to Delete Data from Database 
            $sql = "DELETE FROM tbl_food WHERE id=$id";
            
            //Execute the Query 
            $res = mysqli_query($conn, $sql);
            
            //Check whether the data is delete from database or not 
            if($res==true)
            {
                //Set Success Message and Redirect 
                $_SESSION['delete'] = "<div class='success'>Food Deleted successfully.</div>"; 
                //Redirect to Manage Category 
                header('location:'.SITEURL.'admin/manage-food.php');

            }
            else
            {
                //SEt Fail Message and Redirecs 
                $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>"; 
                //Redirect to Manage Category 
                header('Location:'.SITEURL.'admin/manage-food.php');

            }
            //Redirect to Manage Category Page with Message
    }

    else
    {
        //redirect to Manage Category Page 
        header('location:'.SITEURL. 'admin/manage-food.php');
    }
