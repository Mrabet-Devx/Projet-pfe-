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
    <title>Backend</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.png">
    <lin k rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <link rel="stylesheet" href="admin.css">
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
      
   
   .submit-button {
     background-color: black;
     color: white;
   }
 
   .submit-button:hover {
     background-color: lightgreen;
     color: black;
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
            <a class="nav-link px-3" href="logout.php?logout=1">Se déconnecter</a>
            <a href="quantite.php">
                <i class="fas fa-shopping-bag">
                <?php $count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products WHERE quantite < 5");
                                                      $count_array = mysqli_fetch_array($count_query);
                                                      $count = $count_array["total"];
                                                      if($count > 0){ ?>
                        <span class="cart-quantity">
                                                    <?php    echo $count;
                                                      }
                                                     ?></span>
                    <?php } ?>
                </i>
            </a>
        </div>
    </div>
 
 </header>