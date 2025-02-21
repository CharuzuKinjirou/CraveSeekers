<?php include('partials-front/menu.php'); ?>

    
    <!--Slider section start-->
    <div class="home" id="Home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper wrapper">
                <div class="swiper-slide slide slide1">
                    <div class="content">
                        <img src="images/crown-symbol.png">
                        
                        <h3>Food Order and Reservation</h3>
                        <h1>CraveSeekers</h1>
                        <p>
                            Hungry? Pre-order your food now!
                        </p>
                       
                    </div>
                </div>

                <div class="swiper-slide slide slide2">
                    <div class="content">
                        <img src="images/crown-symbol.png">
                        
                        <h3>Checkout our Menu</h3>
                        <h1>CraveSeekers</h1>
                        <p>
                            Pick your Favorite Foods, Drinks, and Desserts!
                        </p>
                        <a href="<?php echo SITEURL; ?>foods.php" class="btnslider">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide slide slide3">
                    <div class="content">
                        <img src="images/crown-symbol.png">
                        
                        <h3>Business Team</h3>
                        <h1>CraveSeekers</h1>
                        <p>
                            Get to Know our chef's and staffs
                        </p>
                        <a href="<?php echo SITEURL; ?>staffs.php" class="btnslider">Read More</a>
                    </div>
                </div>

                
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!--Slider section end-->

  

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //Create SQl query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the query
                $res = mysqli_query($conn, $sql);
                //count rows wether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //getting values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>Desserts.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php 
                                        if($image_name=="")
                                        {
                                            //display image
                                            echo "<div class='error'>Image not Available</div>";
                                        }
                                        else
                                        {
                                            //image Available
                                            ?>
                                                 <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Desserts" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                   <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    //categories not available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

      <!-- fOOD sEARCH Section Starts Here -->
      <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php 
            //getting food from database that are active and featured
            //sql querry
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //count rows
            $count2 = mysqli_num_rows($res2);

            //check wether the food is available or not
            if($count2>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //check wether image available or not
                                    if($image_name=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                             <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pork Sisig" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                               
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₱<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                    <?php
                }
            }
            else
            {
                //food not available
                echo "<div class='error'>Food not available.</div>";
            }
            
            
            ?>
               
           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".home-slider", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        loop: true,
      });
    </script>

     <script type="text/javascript">
     let menu = document.querySelector('#menu');
     let navbar = document.querySelector('.navbar');

     menu.onclick = () => {
         menu.classList.toggle('fa-times');
         navbar.classList.toggle('active');
     }
 </script>  

<?php include('partials-front/footer.php'); ?>
