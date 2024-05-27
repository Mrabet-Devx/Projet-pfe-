<?php include('header.php');?>
<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit();
    }
?>
<?php 



if($_SERVER["REQUEST_METHOD"] == "POST"){
$name=test_input($_POST['nom']);
if(!preg_match("/^[a-zA-Z ]*$/",$name)){
	header("location: addadmin.php?error=Name: Only letters and white space allowed in the Name field");
  exit();
}
$email=test_input($_POST['email']);
if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
  header("location : addadmin.php?error=Invalid email format");
  exit();
}
$password=test_input(md5($_POST['mdp']));
$mdpcon=test_input(md5($_POST['mdpcon']));

if ($password != $mdpcon) {
	header("location: addadmin.php?error=Passwords non identique");
  exit();
}elseif(strlen($password) < 6) {
  header('location: addadmin.php?error=password court');
  exit();
}else{
  //check whether there is a user with this eamil or not
  $stmt1=$conn->prepare("SELECT count(*) FROM admins WHERE admin_email=?");
  $stmt1->bind_param('s',$email);
  $stmt1->execute();
  $stmt1->bind_result($num_rows);
  $stmt1->store_result();
  $stmt1->fetch();
  //if there is a user already registered with this email 
  if($num_rows != 0){
    header('location: addadmin.php?error=admin with this email already exists');
    exit();
    //if no user regited with this email before
  }else{


        //create a new user
        $stmt=$conn->prepare("INSERT INTO admins (admin_name,admin_email,admin_password)
                               VALUES (?,?,?)");

        $stmt->bind_param('sss',$name,$email,md5($password));
        
        //if aacount was created successfully
        if($stmt->execute()){
          $admin_id=$stmt->insert_id;
          $_SESSION['admin_id']=$admin_id;
          $_SESSION['admin_email']=$email;
          $_SESSION['admin_name']=$name;
          $_SESSION['admin_logged_in']=true;
          header('location: gereruser.php?register_success=You registered successfully');
          exit();

          //account could not be created
        }else{
          header('location: addadmin.php?error=could not create an account at the moment');
          exit();
        }
  }

}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

<div class="table-responsive">
                <div class="wrapper mx-auto container">

      <h1><u><b><i class="fa fa-plus" aria-hidden="true" style="width:80px;margin-bottom: 10px;"></i>AJOUTER UN ADMIN</b></u></h1>
      <form method="POST" action="<?php echo
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>



      <input type="text" placeholder="Nom" name="nom" required>
      
      <input type="text" placeholder="Email" name="email" required>
      <input type="password" placeholder="Password" name="mdp" required>
      <input type="password" placeholder="Confirmer Password" name="mdpcon" required>
      <input type="submit" name="submit" value="Deposer" class="submit-button">
    </form> </div>
            </div>
        </main>
    </div>
</div>

<center><?php include './footeradmin.php'; ?></center>  
</body>
</html>
