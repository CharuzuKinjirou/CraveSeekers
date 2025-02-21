<?php include('partials/menu.php'); ?>

    <div class="main-content"> 
            <div class="wrapper">
                <h1>Add Category</h1>

                <br><br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset ($_SESSION['add']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset ($_SESSION['upload']);
                    }
                 ?>
                 <br><br>
                
                
                <!-- Add Category Form Starts --> 
                <form action="" method="POST" enctype="multipart/form-data">

                    <table class="tbl-30"> 
                            <tr>
                               <td>Title: </td>
                                <td>
                                    <input type="text" name="title" placeholder="category Title">
                                </td> 
                           </tr>

                           <tr>
                               <td>Select Image: </td>
                                <td>
                                    <input type="file" name="image">
                                </td> 
                           </tr>

                                    
                           <tr>
                               <td>Featured:</td>
                                <td>
                                    <input type="radio" name="featured" value="Yes">Yes
                                    <input type="radio" name="featured" value="no">No
                                </td>
                            </tr>

                            <tr>
                               <td>Active:</td>
                                <td>
                                    <input type="radio" name="active" value="Yes">Yes
                                    <input type="radio" name="active" value="no">No
                                </td>
                             </tr>

                            <tr>
                                    <td colspan="2">
                                        <input type="submit" name="submit" value="Add Category " class="btn-secondary">
                                    </td>
                            </tr>

                     </table>

                </form>
                
                <!-- Add Category Form Ends -->

                <?php

                     if(isset($_POST['submit']))
                    {
                        //echo "chicked";
                        //echo $_SESSION['submit'];
                        //unset ($_SESSION['submit']);
                        $title = $_POST['title'];

                        if(isset($_POST['featured']))
                        {
                            $featured=$_POST['featured'];
                        }
                        else{
                            $featured="No";
                        }

                        if(isset($_POST['active']))
                        {
                            $active=$_POST['active'];
                        }
                        else{
                            $active="No";
                        }

                        //print_r($_FILES['image']);
                        
                        if(isset($_FILES['image']['name']))
                        {
                            //echo $_SESSION['add'];
                            //unset ($_SESSION['add']);
                            $image_name = $_FILES['image']['name']; 

                            if($image_name !="")
                            {
                                //auto raname image
                            //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg" 
                            $ext = end(explode('.', $image_name));

                            //Rename the Image 
                            $image_name = "Food_category_".rand (800, 999).'.'.$ext; // e.g. Food_Category_834.jpg,

                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path ="../images/category/".$image_name;
                        

                            $upload = move_uploaded_file($source_path, $destination_path);

                            if($upload==FALSE)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";

                                header('location:'.SITEURL.'admin/add-category.php');
                                die();
                            }
                            }

                            
                        }
                        else
                        {
                            $image_name="";
                        }

                        
                        //die();

                        $sql = "INSERT INTO tbl_category SET
                            title='$title',
                            image_name='$image_name',
                            featured='$featured',
                            active='$active'
                        ";


                        $res = mysqli_query($conn,$sql);

                        //4. Check whether the query executed or not and data added or not 
                        if($res==true)
                        {
                            //Query Executed and Category Added 
                            $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>"; 
                            //Redirect to Manage Category Page 
                            header('Location:'.SITEURL.'admin/manage-category.php');

                        }
                        else
                        {
                            //Failed to Add Category 
                            $_SESSION['add'] = "<div class='error>Failed to Add Category.</div>"; 
                            //Redirect to Manage Category Page 
                            header('Location:'.SITEURL.'admin/add-category.php');
                        }
                  }
                ?>
        </div> 
    </div>

<?php include('partials/footer.php'); ?>