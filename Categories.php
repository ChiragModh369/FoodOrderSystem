<?php
include('partials-front/menu.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Categories</title>
<style>
*{
    padding:0;
	margin:0;
    font-family: Arial, Helvetica, sans-serif;
}
/* CSS Starts For Categories */
.categories
{
    padding: 4% 0;
}

.text-center
{
    text-align: center;
}
h2
{
    color: #2f3542;
    font-size: 2rem;
    margin-bottom: 2%;
}

h3
{
    font-size: 1.5rem;
}

.box-3
{
    width: 28%;
    float: left;
    margin: 2%;
}
.float-container
{
    position: relative;
}
.img-responsive
{
    width: 100%;
}
.img-curve
{
    border-radius: 15px;
}
.text-white
{
    color: white;
}
.float-text
{
    position: absolute;
    bottom: 50px;
    left: 40%;
}
.clearfix{
    clear: both;
    float: none;
}

</style>
</head>



<!-- Category Starts Here -->

<section class="categories">
	<div class="container">
		<h2 class="text-center">Explore Foods</h2>

        <?php 
        
            // Display All The Categories that are Active
            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count the rows  
            $count = mysqli_num_rows($res);

            // checl whether categories available or not
            if($count>0)
            {
                // Categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //  get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="<?php echo SITEURL;?>foods-category.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container" style="margin-left:29px;">

                        <?php  
                        
                            if($image_name=="")
                            {
                                // Image not available
                                echo "<div class='error'>Image Not Found.</div>";
                            }
                            else
                            {
                                // Image available
                                ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve" style="width:400px; height:535px;" >

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
                // Categories not avaialable
                echo "<div class='error'>Category Not Found.</div>";
                
            }

        ?>
		
	    
		

		<div class="clearfix"></div>
	</div>
	
</section>

<!-- Category Section Ends Here -->



<body>
</body>
</html>

<?php
include('partials-front/footer.php');
?>
