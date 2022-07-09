<?php include('partials/menu.php'); ?>

    <div Class="main-content">
        <div Class="wrapper">
            <h1>Update Category</h1>

            <br><br>


            <?php
                if(isset($_GET['id']))
                {
                   // echo "getting the data";
                   $id=$_GET['id'];

                   $sql="SELECT  * FROM tbl_category WHERE id=$id";

                   $res=mysqli_query($conn, $sql);

                   $count=mysqli_num_rows($res);

                   if($count==1)
                   {
                        $row= mysqli_fetch_assoc($res);
                        $title= $row['title'];
                        $current_image= $row['image_name'];
                        $featured= $row['featured'];
                        $active= $row['active'];
                   }
                   else
                   {
                       $_SESSION['no-category-found']="<div Class='error'>Category Not Found.</div>";
                       header('location:'.SITEURL.'admin/manage-category.php');
                   }
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table Class="table-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                           <?php
                                if($current_image !="")
                                {
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                    <?php
                                }
                                else
                                {
                                    echo "<div Class='error'>Image not added.</div>";
                                }
                           ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes

                            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" Class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            
                if(isset($_POST['submit']))
                {
                   // echo "clicked";

                    $id=$_POST['id'];
                
                   $title=$_POST['title'];
                   $current_image= $POST['current_image'];
                   $featured= $_POST['featured'];
                   $active= $_POST['active'];

                   //update new image

                   if(isset($_FILES['image']['name']))
                   {
                        $image_name= $_FILES['image']['name'];

                        if($image_name !="")
                        {
                            //image available

                              //auto rename image

                        $ext=end(explode('.', $image_name));


                        $image_name="Food_Category_".rand(000, 999).'.'.$ext;



                        $source_path= $_FILES['image']['tmp_name'];


                        $destination_path= "../images/category/".$image_name;

                        //upload the image
                        $upload=move_uploaded_file( $source_path, $destination_path);

                        //check weather the image is uploaded or not
                        if($upload==false)
                        {
                            $_SESSION['upload']=  "<div Class='error'>Failed to upload Image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');

                            die();

                        }
                        //remove the current image
                        if($current_image!="")
                        {

                        
                            $remove_path= "../images/category/".$current_image;

                            $remove = unlink();

                            //check weather the image is removed or not

                            if($remove==false)
                            {
                                $_SESSION['failed-remove']= "<div class='error'>Failed to remove current image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }

                        }
                        else
                        {
                            $image_name=$current_image;
                        }
                   }
                   else
                   {
                       $image_name=$current_image;
                   }
 
                   //update database

                   $sql2 = "UPDATE tbl_category SET
                            title='$title',
                            image_name='$image_name',
                            featured='$featured',
                            active='$active'
                            WHERE id=$id
                            ";

                    $res2=mysqli_query($conn, $sql2);

                            

                   //redirect to manage category page

                   if($res2==true)
                   {
                        $_SESSION['update']= "<div Class='success'>Category updated succesfully. </div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                   }
                   else
                   {
                         $_SESSION['update']= "<div Class='error'>Failed to update category. </div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                   }

                }
            ?>
        </div>
    </div>
  

<?php include('partials/footer.php'); ?>