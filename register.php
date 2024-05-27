<?php

session_start();
//include('../server/connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
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

      //if user has already registered, then take user to account page
    if(isset($_SESSION['logged_in'])){
      header('location: account.php');
      exit;
    }
?>




<!--Register-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        
        <hr class="mx-auto"/>
    </div>
    <div class="center mx-auto container">

    <?php if($_SERVER["REQUEST_METHOD"] == "POST"){
  
 
  
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      header('location: register.php?error=Only letters and white space allowed');
      exit();
    }
    

 
 
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header('location: register.php?error=Invalid email format');
      exit();
    }
   

  
  
    $password = test_input(md5($_POST["password"]));
   
    
   
      $passConf = test_input(md5($_POST["confirmPassword"]));
      
  
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^\d{10}$/",$phone)) {
          header('location: register.php?error=Only ten numbers allowed');
          exit();
          }
       
          $city = test_input($_POST["city"]);
       
        
            $address = test_input($_POST["address"]);
            

  
  //if passwords dont match
  if($password !== $passConf){
    header('location: register.php?error=passwords dont match');
    exit();
  

  //if password is less than 6 characters
  }elseif(strlen($password) < 6){
    header('location: register.php?error=password must be at least 6 charachters');
    exit();
 
   //if there is no error
  }else{
        //check whether there is a user with this eamil or not
        $stmt1=$conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $stmt1->bind_param('s',$email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();
        //if there is a user already registered with this email 
        if($num_rows != 0){
          header('location: register.php?error=user with this email already exists');
          exit();
          //if no user regited with this email before
        }else{


              //create a new user
              $stmt=$conn->prepare("INSERT INTO users (user_name,user_email,user_password,user_phone,user_city,user_address)
                                     VALUES (?,?,?,?,?,?)");
      
              $stmt->bind_param('sssiss',$name,$email,md5($password),$phone,$city,$address);
              
              //if aacount was created successfully
              if($stmt->execute()){
                $user_id=$stmt->insert_id;
                $_SESSION['user_id']=$user_id;
                $_SESSION['user_email']=$email;
                $_SESSION['user_name']=$name;
                $_SESSION['user_phone']=$phone;
                $_SESSION['user_city']=$city;
                $_SESSION['user_address']=$address;
                $_SESSION['logged_in']=true;
                header('location: account.php?register_success=You registered successfully');
                exit();

                //account could not be created
              }else{
                header('location: register.php?error=could not create an account at the moment');
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
?><br><br>
     <h2 style="text-align:center; color: white;">Register</h2>
        <form method="POST" action="<?php echo
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
            <div class="txt_field">
                <input type="text"  name="name"  placeholder="Name" required/>
                <span></span>
          <label>Name</label>
              </div>
            <div class="txt_field">
                <input type="text" name="email"  placeholder="Email" required/>
                <span></span>
          <label>Email</label>
              </div>
            <div class="txt_field">
                <input type="password" name="password" placeholder="Password" required/>
                <span></span>
          <label>Password</label>
              </div>
            <div class="txt_field">
                <input type="password" name="confirmPassword"  placeholder="Confirm Password" required/>
                <span></span>
          <label>Confirm Password</label>
              </div>
            <div class="txt_field">
                <input type="text"  name="phone"  placeholder="Phone" required/>
                <span></span>
          <label>Phone</label>
              </div>
            <div class="txt_field">
                <input type="text" name="city"  placeholder="City" required/>
                <span></span>
          <label>City</label>
              </div>
            <div class="txt_field">
                <input type="text" name="address"  placeholder="Address" required/>
                <span></span>
          <label>Address</label>
              </div>
            
                <input type="submit" class="btn btn-primary" name="register" value="Register"/>
            
            <div class="signup_link">
             <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>   
            </div>
        </form>

    </div>
</section>
<br><br><br><br><br><br><br><br><br><br>

<?php include('layouts/footer.php');?>
