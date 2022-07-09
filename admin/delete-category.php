<?php
    //include constatns file
    include('../config/constants.php');

  //  echo "delete category";

  if(isset($_GET['id']) AND isset($_GET['image_name']))
  {
   // echo "get value and delete";

    $id=$_GET['id'];
    $image_name= $_GET['image_name'];

    if($image_name!=="")
    {
        $path ="../images/category/".$image_name;

        $remove =unlink($path);

        if($remove==false)
        {
            $_SESSION['remove'] = "<div Class='error'>Faile to delete category Image.</div>";

            header('location:'.SITEURL.'admin/manage-category.php');

            die();
        }
    }

    $sql="DELETE FROM tbl_category WHERE id=$id";

    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] ="<div Class='success'>Category Deleted succesfully.</div>";

        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {

        $_SESSION['delete'] ="<div Class='error'>Failed to Delete Category.</div>";

        header('location:'.SITEURL.'admin/manage-category.php');
    }

  }
  else
  {
    header('location:'.SITEURL.'admin/manage-category.php');
  }

?>