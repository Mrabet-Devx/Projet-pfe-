<?php

session_start();
//include('../server/connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="styl.css"/>
</head>
<body>
   
   <!--Nav bar-->
   <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
      <img class="logo" src="assets/imgs/pp.png" alt="">
      <h2 class="brand">hopSavvy</h2>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact As</a>
          </li>

          <li class="nav-item">
            <a href="cart.php">
                <i class="fas fa-shopping-bag">
                    <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                        <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                    <?php } ?>
                </i>
            </a>
          </li>
          <li>
            <a href="account.php"><i class="fas fa-user"></i></a>
          </li>
          
        
          
        </ul>
      
      </div>
    </div>
  </nav>
<?php

include('server/connection.php');
if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}
if(isset($_POST['login_btn'])){
  $email=$_POST['email'];
  $password=md5($_POST['password']);

  $stmt=$conn->prepare("SELECT user_id,user_name, user_email, user_password, user_phone, user_city, user_address FROM users WHERE user_email=? AND user_password=? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
    $stmt->bind_result($user_id,$user_name,$user_email,$user_password,$user_phone,$user_city,$user_address);
    $stmt->store_result();
    if($stmt->num_rows()==1){
      $stmt->fetch();

      $_SESSION['user_id']=$user_id;
      $_SESSION['user_name']=$user_name;
      $_SESSION['user_email']=$user_email;
      $_SESSION['user_phone']=$user_phone;
      $_SESSION['user_city']=$user_city;
      $_SESSION['user_address']=$user_address;
      $_SESSION['logged_in']=true;

      header('location: account.php?login_success=logged in successfully');

    }else{
      header('location: login.php?error=could not verify your account');
    }
  }else{
    //error
    header('location: login.php?error=something went wrong');

  }


}else{

}
?>


<!--login-->
<!-- <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto"/>
    </div>
    <div class="mx-auto container">
        <form id="login-form" method="POST" action="login.php">
          <p style="color:red" class="text-center">/*<?php if(isset($_GET['error'])){ echo $_GET['error'];}?>*/</p>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
            </div>
            <div class="form-group">
             <a id="register-url" href="register.php" class="btn">D'ont have account? Register</a>   
            </div>
        </form>

    </div>
</section> -->
<br><br><br>

<section class="my-5 py-5">
<div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold"></h2>
        <hr class="mx-auto"/>
    </div>
<div class="center mx-auto container">
      <h1 style="color: white;">Login</h1>
      <form method="post" action="login.php">
      <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>

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
        <a id="register-url" href="register.php" class="btn">D'ont have account? Register</a>        </div>
      </form>
    </div>
    </section>
<br>
<?php include('layouts/footer.php');?>