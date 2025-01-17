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
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
   
   <!--Nav bar-->
   <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
      <a style="text-decoration: none;" href="index.php"><img class="logo" src="assets/imgs/pp.png" alt=""></a>
      <a style="text-decoration: none;" href="index.php"><h2 class="brand">hopSavvy</h2>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button></a>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
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