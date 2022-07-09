<?php include('partials/menu.php'); ?>

    <div class="main content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php 
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
            ?>
            <form action="" method="POST">

                <table Class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="password" name="current_password" placeholder= "Current Password">
                        </td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_password" placeholder= "New Password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder= "Confirm Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" Class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>

<?php 

    //check weather the submit button is clicked or not
    if(isset($_POST['submit']))
    {
       //  echo "clicked";

       //1.get the data

       $id=$_POST['id'];
       $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

        //2.sql query
        $sql= "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //3.execute the query

        $res=mysqli_query($conn, $sql);

        if($res==true)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
               // echo"user found";
               if($new_password==$confirm_password)
               {
                  //echo"password match"; 
                  $sql2= "UPDATE tbl_admin SET
                  password='$new_password'
                  WHERE id=$id
                  ";

                  $res=mysqli_query($conn, $sql2);

                  if($res==true)
                  {
                    $_SESSION['change-pwd']= "<div class='success'>password changed succesfully.</div> ";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                  }
                  else
                  {
                    $_SESSION['change-pwd']= "<div class='error'>failed to change password.</div> ";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                  }
                }
                  
               }
               else
               {
                $_SESSION['pwd-not-match']= "<div class='error'>password did not match</div> ";
                header('location:'.SITEURL.'admin/manage-admin.php');
               }
            }
            else
            {
                $_SESSION['user-not-found']= "<div class='error'>User Not Found</div> ";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    

?>

<?php include('partials/footer.php'); ?>