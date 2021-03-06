<?php include('partials/menu.php'); ?>

    <div Class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php 

                //1.get the id of selected admin
                $id=$_GET['id'];

                //2.create sql query
                $sql="SELECT * FROM tbl_admin WHERE id=$id";

                //3.execute the query
                $res=mysqli_query($conn, $sql);

                //check the query is executed or not
                if($res==TRUE)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //echo"Admin available";   
                        $row=mysqli_fetch_assoc($res);

                        $full_name=$row['full_name'];
                        $username=$row['username'];
                    }
                    else
                    {
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
            
            ?>

            <form action=""method="POST">

                <table Class="tbl-30">

                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name;?>">
                        </td>
                    </tr>
                    <tr>

                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Updata Admin" Class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>
        </div>

    </div>

<?php

        if(isset($_POST['submit']))
        {
           // echo"button clicked";
           $id=$_POST['id'];
           $full_name= $_POST['full_name'];
           $username= $_POST['username'];

           //create sql query to updata admin
           $sql="UPDATE tbl_admin SET
           full_name= '$full_name',
           username= '$username' 
           WHERE id='$id'
           ";

           //execute the query
           $res= mysqli_query($conn, $sql);

           //check whether the query executed or not
           if($res==TRUE)
           {
               $_SESSION['update'] ="<div Class='success'>Admin updated succesfully.</div>";
               header('location:'.SITEURL.'admin/manage-admin.php');
           }
           else
           {
                
               $_SESSION['update'] ="<div Class='error'>Failed to update admin.</div>";
               header('location:'.SITEURL.'admin/manage-admin.php');
           }
        }
?>

<?php include('partials/footer.php'); ?>
