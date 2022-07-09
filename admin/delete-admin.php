<?php

    //include constants php file here

    include('../config/constants.php');
    
    //1.get the id of admin to be delete

         $id = $_GET['id'];
    //2.create sql query to delete the admin

        $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //execute the qurey

        $res =mysqli_query($conn, $sql);

    //check whether query executed or not
    if($res==TRUE)
    {
       // echo"admin deleted";
       //create session variable to display messages
       $_SESSION['delete']= "<div Class='success'>Admin deleted succesfully.</div>";
       //redirect to manage admin page
       header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
      //  echo"failed to delete admin";
      $_SESSION['delete']= "<div Class='error'>failed to delete. Try again later</div>";
      //redirect to manage admin page
      header('location:'.SITEURL.'admin/manage-admin.php');

    }

    //3.redirect to manage admin page



?>
