<?php include('partials/menu.php'); ?>

<div class="main-content"> 
    <div class="wrapper">
      <h1>Add Admin</h1>

      <br><br>

      <?php
         if(isset($_SESSION['add']))
         {
             echo $_SESSION['add'];
             unset ($_SESSION['add']);
         }
      ?>

      <form action="" method="POST">

          <table class="tbl-30"> 
              <tr>
                  <td>Full Name: </td>
                  <td><input type="text" name="full_name" placeholder="Enter Your Name"></td> 
              </tr>
              
              <tr>
                  <td>Username: </td>
                  <td><input type="text" name="Username" placeholder="Your Username">
                </td> 
        </tr>
              

              <tr>
                  <td>Password: </td>
                  <td><input type="password" name="password" placeholder="Your Password">
                </td> 
              </tr>

              <tr>
                <td colspan="2">
                  <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
              </tr>

          </table>
      </form>

    </div> 
  </div>

  <?php include('partials/footer.php'); ?>

  <?php
    if(isset($_POST['submit']))
    {

      //echo "Button Clicked";
        $full_name = $_POST['full_name'];
        $username = $_POST['Username'];
        $password =md5($_POST['password']);


        $sql = "INSERT INTO tbl_admin SET
                full_name='$full_name',
                username='$username',
                password='$password'
                
                ";

               $conn = mysqli_connect('localhost','root','') or die($mysqli->error());
               $db_select = mysqli_select_db($conn,'food-order') or die ($mysqli->error());
                
              $res = mysqli_query($conn, $sql) or die($mysqli->error());

              if($res==TRUE)
              {
                   // echo"DATA INSERTED";
                  $_SESSION['add'] = "admin added successfully";
                    header("location:".SITEURL.'admin/manage-admin.php');
              }
              else
              {
                 //echo"FAILED TO  INSERTDATA";
                $_SESSION['add'] = "FAILED TO Add Admin";
                header("location:".SITEURL.'admin/add-admin.php');
              }
    }
  
   // else{
     // echo"buttom not clicked";
   // }

    
   
  ?>