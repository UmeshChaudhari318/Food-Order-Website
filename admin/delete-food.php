<?php

    //include constants page
    include('../config/constants.php');

   // echo"delete food page";

   if(isset($_GET['id']) && isset($_GET['image_name']))
   {
       // echo "process to delete";

       //1.

       $id= $_GET['id'];
       $image_name = $_GET['image_name'];

       //2.

       if($image_name != "")
       {

            $path ="../images/food/".$image_name;

            $remove =unlink($path);

            if($remove==false)
            {
                $_SESSION['upload'] ="<div Class='error'>Failed to remove image file.</div>";

                header('location:'.SITEURL.'admin/manage-food.php');

                die();
            }
       }
       
       //3.

            $sql="DELETE  FROM tbl_food WHERE id=$id";

            $res =mysqli_query($conn, $sql);

             //4.

            if($res==true)
            {
                //food delete
                $_SESSION['delete']="<div Class='success'>Food deleted succesfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

            }
            else
            {
                //failed to delete
                $_SESSION['delete']="<div Class='error'>Failed to delete food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

            }

      
   }
   else
   {
        $_SESSION['unauthorized'] = "<div Class= 'error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
   }
?>