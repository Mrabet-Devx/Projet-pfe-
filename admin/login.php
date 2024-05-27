<?php session_start();?>
<?php include('../server/connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mrabet Mohamed, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login Form in HTML and CSS</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.png">
    <lin k rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <meta name="theme-color" content="#7952b3">

    <style>
        .bd-placeholder-img{
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;

        }
        @media (min-width: 760px) {
            .bd-placeholder-img-lg{
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
 <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">ShopSavvy</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button">
        <span class="navbar-toggler"></span>
    </button>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <?php if(isset($_SESSION['admin_logged_in'])) { ?>
            <a class="nav-link px-3" href="logout.php?logout=1">Sign out</a>
            <?php } ?>
        </div>
    </div>
 
 </header>
<?php

include('../server/connection.php');
if(isset($_SESSION['admin_logged_in'])){
  header('location: index.php');
  exit;
}
if(isset($_POST['login_btn'])){
  $email = test_input($_POST["email"]);
  $password = test_input(md5($_POST["password"]));

  $stmt=$conn->prepare("SELECT admin_id,admin_name, admin_email, admin_password FROM admins WHERE admin_email=? AND admin_password=? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
    $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
    $stmt->store_result();
    if($stmt->num_rows()==1){
      $stmt->fetch();

      $_SESSION['admin_id']=$admin_id;
      $_SESSION['admin_name']=$admin_name;
      $_SESSION['admin_email']=$admin_email;
      $_SESSION['admin_logged_in']=true;

      header('location: dashboard.php?login_success=logged in successfully');

    }else{
      header('location: login.php?error=vous n\'avez pas pu vérifier votre compte');
    }
  }else{
    //error
    header('location: login.php?error=Quelque chose s\'est mal passé');

  }


}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
?>



<!--
<div class="wrapper text-center">
  <form method="POST" action="login.php">
    <h1>Login</h1>
    <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
    <div class="input-box">
      <input type="text" name="email" placeholder="Email" required><i class='bx bxs-user'></i>
    </div>
    <div class="input-box">
      <input type="password" name="password" placeholder="Password" required><i class='bx bxs-lock-alt'></i>
    </div>
    <div class="remember-forgot">
      <label><input type="checkout"> Remember me</label>
      <a href="#">Forgot password?</a>
    </div>
    <div class="form-group mt-3">
                <input type="submit" class="btn btn-primary" name="login_btn" value="Login"/>
            </div>
    <div class="register-link">
      <p>Don't have an account? <a href="#">Register</a></p>
    </div>
  </form>
</div> -->


<div class="center">
      <h1>Login</h1>
      <form method="post" action="<?php echo
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>

        <div class="txt_field">
        <input type="text" name="email" placeholder="Email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
        <input type="password" name="password" placeholder="Password" required>
          <span></span>
          <label>Password</label>
        </div>
        
        <input type="submit" class="btn btn-primary" name="login_btn" value="Login"/>
        <div class="signup_link">
          Not a member? <a href="#">Signup</a>
        </div>
      </form>
    </div>
 
</body>
</html>