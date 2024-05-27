<?php include('layouts/header.php');?>
<?php

include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
  header(('location: login.php'));
  exit;
}
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_phone']);
    unset($_SESSION['user_city']);
    unset($_SESSION['user_address']);
    header('location: login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){
  $password=$_POST['password'];
  $confirmPassword=$_POST['confirmPassword'];
  $user_email=$_SESSION['user_email'];
  $user_phone=$_SESSION['user_phone'];
  $user_city=$_SESSION['user_city'];
  $user_address=$_SESSION['user_address'];

  //if passwords dont match
  if($password !== $confirmPassword){
    header('location: account.php?error=passwords dont match');
  

  //if password is less than 6 characters
  }elseif(strlen($password) < 6){
    header('location: account.php?error=password must be at least 6 charachters');
  //no errors
  }else{
    $stmt= $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss',md5($password),$user_email);
   
   if($stmt->execute()){
      header('location: account.php?message=password has been updated successfully');
   }else{
    header('location: account.php?error=could not update password');
   }
  }

}

//get orders
if(isset($_SESSION['logged_in'])){
  $user_id=$_SESSION['user_id'];
  $stmt=$conn->prepare("SELECT * FROM orders WHERE user_id=? ");
  $stmt->bind_param('i',$user_id);
  $stmt->execute();
  $orders=$stmt->get_result(); //[]

}
?>






      <!--Account-->
<section  class="orders container my-5 py-5">
    <div class="row container mx-auto">
      <?php if(isset($_GET['payment_message'])){ ?>
        <p class="mt-5 text-center" style="color: green;"><?php echo $_GET['payment_message']; ?></p>
      <?php } ?>
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <p class="text-center" style="color: green;"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success'] ;} ?></p>
        <p class="text-center" style="color: green;"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success'] ;} ?></p>
            <h3 class="font-weight-bold">Informations de compte</h3>
            <hr class="mx-auto">
            <div class="account-info">
            <table class="mt-5 pt-5">
                <tr><th><p><b>Nom    :</b></th><td><span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];}?></span></p></td></tr>
                <tr><th><p><b>Email  :</b></th><td><span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];}?></span></p></td></tr> 
                <tr><th><p><b>Tél    :</b></th><td><span><?php if(isset($_SESSION['user_phone'])){ echo $_SESSION['user_phone'];}?></span></p></td></tr>               
                <tr><th><p><b>Adresse:</b></th><td><span><?php if(isset($_SESSION['user_address'])){ echo $_SESSION['user_address'];}?></span></p></td></tr>
                <tr><th><p><b>Ville  :</b></th><td><span><?php if(isset($_SESSION['user_city'])){ echo $_SESSION['user_city'];}?></span></p></td></tr>                
                </table>
                <p><a href="#orders" id="orders-btn">Vos commandes</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Se déconnecter</a></p>
            
              </div>
      
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="account.php">
              <p class="text-center" style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error'] ;} ?></p>
              <p class="text-center" style="color: green;"><?php if(isset($_GET['message'])){ echo $_GET['message'] ;} ?></p>
                <h3>Changer le mot de passe</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Mot de Passe</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Confirmez le mot de passe</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>
    </div>
</section>



<!--Orders-->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
    <h2 class="font-weight-bold text-center">Vos Commandes</h2>
    <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
    <tr>
        <th>Id</th>
        <th>Coût</th>
        <th>Statut</th>
        <th>Date</th>
        <th>Details</th>
       
    
    </tr>
    <?php foreach($orders as $row) { ?>
   <tr>
        <td>
           <!--<div class="product-info">
           <img src="assets/imgs/featured2.png"/> 
          <div>
            <p class="mt-3"><?php echo $row['order_id'];?></p>
          </div>
        </div> -->
        <span><?php echo $row['order_id'];?></span>
        </td>
        <td>
          <span><?php echo $row['order_cost'];?></span>
        </td>
        <td>
          <span><?php echo $row['order_status'];?></span>
        </td>
        <td>
          <span><?php echo $row['order_date'];?></span>
        </td>
        <td>
          <form method="POST" action="order_details.php">
          <input type="hidden" value="<?php echo $row['order_status'];?>" name="order_status">
            <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id">
            <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details">
          </form>
        </td>
       
      
    </tr>
   <?php } ?>
 
    
   
    </table>
    
    
    
    
</section>






<?php include('layouts/footer.php');?>