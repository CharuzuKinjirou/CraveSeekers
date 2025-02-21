<?php include('partials/menu.php'); ?>

    <div class="main-content"> 
            <div class="wrapper">
                <h1>Add Food</h1>

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
                
                
                <!-- Add Food Form Starts --> 
<form action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-30">

                        <tr>
                            <td>Title: </td> 
                            <td>
                                <input type="text" name="title" placeholder="Title of the Food"> 
                            </td> 
                        </tr>

                        <tr>
                            <td>Description: </td> 
                            <td>
                                <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>Price</td>
                            <td>
                                <input type="number" name="price">
                            </td>
                        </tr>

                        <tr>
                            <td>Select Image</td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>

                    <tr>
                        <td>Category</td>
                            
                        <td>

                            <select name="category">

                                <?php
                                //Create PHP code to display categories from Database 
                                //1. Create SQL to get all active categories from database 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Executing query 
                                $res = mysqli_query($conn, $sql);

                                //count Rows to check whether we have categories or not 
                                $count = mysqli_num_rows($res);
                                
                                //IF count is greater than zero, we have categories else we donot have categories 
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories 
                                        $id = $row['id']; 
                                        $title = $row['title'];
                                        
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }

                                    //2.Display on dropdonw
                                ?>


                             
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="Yes">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="Yes">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr> 


    </table>

</form>

                <!-- Add food Form Ends -->

                <?php

                            if(isset($_POST['submit']))
                            {
                            
                             //1. Get the data from Form 
                                $title = $_POST['title']; 
                                $description = $_POST['description']; 
                                $price = $_POST['price']; 
                                $category = $_POST['category'];
                            
                                    //check whether buttons are active or not
                                    if(isset($_POST['featured']))
                                    {
                                        $featured = $_POST['featured'];
                                    }
                                    else{
                                        $featured = "No";
                                    }

                                    if(isset($_POST['active']))
                                    {
                                        $active = $_POST['active'];
                                    }
                                    else{
                                        $active = "No";
                                    }

                              //2.uploading image
                                    
                                    if(isset($_FILES['image']['name']))
                                    {
                                        //echo $_SESSION['add'];
                                        //unset ($_SESSION['add']);
                                     $image_name = $_FILES['image']['name']; 

                                        if($image_name !="")
                                        {
                                             //auto rename image
                                            //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg" 
                                            $image_info = explode (".", $image_name);
                                            $ext = end ($image_info);

                                            //Rename the Image 
                                            $image_name = "Food_Name".rand (000, 999).'.'.$ext; // e.g. Food_name_834.jpg,

                                            $source_path = $_FILES['image']['tmp_name'];
                                            $destination_path ="../images/food/".$image_name;
                                        

                                            $upload = move_uploaded_file($source_path, $destination_path);

                                            if($upload==FALSE)
                                            {
                                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";

                                                header('location:'.SITEURL.'admin/add-food.php');
                                                die();
                                            }
                                        }
                                    }

                                    else
                                    {
                                        $image_name = "";
                                    }

                                //3.inserting to db
                                $sql2 = "INSERT INTO tbl_food SET
                                    title = '$title',
                                    description = '$description',
                                    price = $price, 
                                    image_name = '$image_name',
                                    category_id = $category, 
                                    featured = '$featured',
                                    active = '$active'
                                ";

                                //execute query
                                $res2 = mysqli_query($conn, $sql2);

                                //4. Check whether the query executed or not and data added or not 
                                if($res2 == true)
                                {
                                    //Query Executed and Category Added 
                                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>"; 
                                    //Redirect to Manage Category Page 
                                    header('location:'.SITEURL.'admin/manage-food.php');

                                }
                                else
                                {
                                    //Failed to Add Category 
                                    $_SESSION['add'] = "<div class='error>Failed to Add food.</div>"; 
                                    //Redirect to Manage Category Page 
                                    header('location:'.SITEURL.'admin/add-food.php');
                                }
                  }
                ?>
        </div> 
    </div>

<?php include('partials/footer.php'); ?>