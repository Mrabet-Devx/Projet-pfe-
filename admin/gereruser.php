
<?php include('header.php');?>
<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit();
    }
?>



<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
<?php include('sidemenu.php');?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2"></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">

            </div>
        </div>
    </div>
            

    <h1><center><u><br>GERER LES UTILISATEURS :</u></center></h1>    
    
    <?php 
    

    echo '<div class="row">
            <div class="col-1"></div>
            <div class="col-10">';
            $email = mysqli_real_escape_string($conn, $_SESSION['admin_email']);


            //;

    
    $sql = mysqli_query($conn,"SELECT * FROM users WHERE user_email <> '$_SESSION[admin_email]' AND user_email NOT IN (SELECT admin_email FROM admins)");
            echo '<table class="table table-bordered table-striped" style="margin:40px 140px 40px 40px;top:0;"><thead class="thead-dark"><tr><th>NOM</th><th><center>EMAIL</center></th><th><center>Action</center></th></tr></thead>';

        while ($res=mysqli_fetch_array($sql)) {
            echo '<tr>';
            echo '<td>'.$res['user_name'].'</td>';
            
            echo '<td>'.$res['user_email'].'</td>';
            $getpro = mysqli_query($conn,"SELECT * FROM users WHERE user_id = '".$res['user_id']."'");
    $count = mysqli_num_rows($getpro);



          
            
            
            echo '<td>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="'.$res['user_id'].'">
                        <center><button class="btn btn-success" name="proum" style="width: 100%;"><center>Rendre admin</center></button></center>
                        <input type="hidden" name="user_d" value="'.$res['user_id'].'">
                        <center><button class="btn btn-danger" name="delete" style="width: 100%;"><center>Supprimer User</center></button></center>

                    </form>
                </td>';
            echo '</tr>';
       }
        echo '</table>';


echo '<center><button class="btn btn-dark" style="width: 80%;color:black;"><center><a href="./addadmin.php" style="color:white;">AJOUTER UN ADMIN</a></center></button></center>';
        

 



if (isset($_POST['delete'])) {
  $id = $_POST['user_d'];
  $query = "DELETE FROM users WHERE user_id='$id'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    echo '<script>document.getElementById("submit").click();</script>';
    
    
  } else {
    echo "Failed to delete User";
  }
}

if (isset($_POST['proum'])) {
    $id=$_POST['user_id'];
    $sqli=mysqli_query($conn,"SELECT * FROM users WHERE user_id='$id'");
    $res=mysqli_fetch_array($sqli);
    $nom = $res['user_name'];
   
    $email = $res['user_email'];
    $password = $res['user_password'];
    
    $proum="INSERT INTO admins (admin_name, admin_email, admin_password) VALUES ('$nom', '$email', '$password')";
    mysqli_query($conn,$proum);
}


                ?>
           

     
    

</main>
</div></div>

</body>
<center><?php include './footeradmin.php'; ?></center>
</html>