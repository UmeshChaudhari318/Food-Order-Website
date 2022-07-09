<?php include('partials/menu.php'); ?>

<div Class="main-content">
    <div Class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
    
            <table Class="table-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" > 

                            <?php   
                                //create to display category from database

                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                $res=mysqli_query($conn, $sql);

                                $count=mysqli_num_rows($res);

                                if($count>0)
                                {
                                    //we have category

                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //do not have category

                                    ?>
                                        <option value="0">No Category Found</option>
                                    <?php
                                }
                            
                            ?>
                        

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                         <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" Class="btn-secondary">
                    </td>
                </tr>
                

            </table>
        </form>

        <?php

            //check the button is clicked or not
            if(isset($_POST['submit']))
            {
               // echo "button clicked";

               $title= $_POST['title'];
               $description= $_POST['description'];
               $price= $_POST['price'];
               $category= $_POST['category'];

               if(isset($_POST['featured']))
               {
                   $featured= $_POST['featured'];

               }
               else
               {
                   $featured= "No";
               }

               if(isset($_POST['active']))
               {
                   $active= $_POST['active'];

               }
               else
               {
                   $active= "No";
               }

               //2.

               if(isset($_FILES['image']['name']))
               {
                    $image_name=$_FILES['image']['name'];

                    if($image_name !="")
                    {
                        //image is selected

                        $ext=end(explode('.', $image_name));

                        $image_name= "Food-Name-".rand(0000, 9999).".".$ext;

                        $src= $_FILES['image']['tmp_name'];

                        $dst = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src, $dst);

                        if($upload==false)
                        {
                            //failed to upload the image
                            $_SESSION['upload'] = "<div Class= 'error'>Failed to upload image. </div>";
                            header('location:'.SITEURL.'admin/add-food.php');

                            die();
                        }
                    }
               }
               else
               {
                   $image_name= "";
               }

               //3.

               $sql2 = "INSERT INTO tbl_food SET
                        title= '$title',
                        description= '$description',
                        price = '$price',
                        image_name = '$image_name',
                        category_id ='$category',
                        featured = '$featured',
                        active= '$active'
                        ";

                        $res2 =mysqli_query($conn, $sql2);

                  //4.
        

                        if($res2==true)
                        {
                            $_SESSION['add']= "<div Class='success'>Food Added Succesfully.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                        else
                        {
                            $_SESSION['add']= "<div Class='error'>Failed to add Food.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }

               

            }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>