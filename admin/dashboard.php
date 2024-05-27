<?php session_start();?>
<?php include('../server/connection.php');?>
<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mrabet Mohamed, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard Template - Bootstrap v5.1</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.png">
    <lin k rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <link rel="stylesheet" href="admin.css">
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

<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
        <?php include('sidemenu.php');?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Tableau de bord</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">

            </div>
        </div>
    </div>


    <div class="container-fluid">
	<div class="row">
		<div class="col-md-4"></div>
			<div class="col-md-4"> <h1><center>PAGE ADMIN</center></h1></div>
      <div class="col-md-2"></div>
      <div class="col-md-2">
       
    </div></div>
	<span><br><br><br></span>
  <div class="row">
    <div class="col-md-4"></div>
      <div class="col-md-4"> <h4><b><u>STATISTIQUES :</u></b> </h4>
      </div></div>
      <span><br></span>
	<div class="row">
		<div class="col-md-4"></div>


	</div>

</div>

<section>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-3">

      <!--ls categories-->
      
        <table class="table table-striped"><thead class="thead-dark"><tr><th>CATEGORIE TENDENCES</th><th><center>VISITES</center></th>
       <?php 
        
        
        $get_cat="SELECT * FROM `products` GROUP BY `products`.`product_category` ORDER BY `products`.`nbreVisite` DESC LIMIT 4";
        $run=mysqli_query($conn,$get_cat);
        while($resultat = mysqli_fetch_array($run))
        {
          echo '<tr>';
          echo '<td>'.$resultat['product_category'].'</td>';
          echo '<td>'.$resultat['nbreVisite'].'</td>';
          echo '</tr>';

          
        }
      
  ?></center></table>
      
    </div>

    <div class="col-md-3">

       <!--ls produits les plus visité-->
      
        <table class="table table-striped"><thead class="thead-dark"><tr><th>PRODUIT EN FEU</th><th><center>VISITES</center></th>
       <?php 
        
        
        $get_pro="SELECT * FROM products ORDER BY products.nbreClick DESC LIMIT 6";
        $run=mysqli_query($conn,$get_pro);
        while($resultat = mysqli_fetch_array($run))
        {
          echo '<tr>';
          echo '<td>'.$resultat['product_name'].'</td>';
          echo '<td>'.$resultat['nbreClick'].'</td>';
          echo '</tr>';

          
        }
      
  ?></center></table>
      
    </div>

    <div class="col-md-4">

       <!--les dernier produit ajoutée-->
      
        <table class="table table-striped"><thead class="thead-dark"><tr><th>DERNIER PRODUIT APPROUVEES</th><th><center>DATE</center></th><th>VISITE</th>
       <?php 
        
        
        $get_lpro="SELECT * FROM products ORDER BY products.date_appro DESC LIMIT 4";
        $run=mysqli_query($conn,$get_lpro);
        while($resultat = mysqli_fetch_array($run))
        {
          echo '<tr>';
          echo '<td>'.$resultat['product_name'].'</td>';
          echo '<td>'.$resultat['date_appro'].'</td>';
          echo '<td>'.$resultat['nbreClick'].'</td>';
          echo '</tr>';

          
        }
      
  ?></center></table>
      
    </div>


  </div>

</section>
<section>
    
        <div class="row" >
            <div class="col-md-1"></div>
            <div class="col-md-5" style="padding-bottom: 20px;background-color:darkgrey;border-radius: 20px;margin-right: 10px;margin-top: 20px;">
               <h1><u><center>Produit plus Vendu</center></u></h1>

                 
                    <div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  <?php
  $getcat = mysqli_query($conn, "SELECT * FROM products  ORDER BY `products`.`nbreVendu` DESC LIMIT 6");
  $labels = "";
  $stats="";
  while ($cat = mysqli_fetch_array($getcat)) {
    $nomCategorie = $cat['product_name'];
    $nombrevisit=$cat['nbreVendu'];
    $stats.="'$nombrevisit', ";
    $labels .= "'$nomCategorie', ";
  }
  $stats = rtrim($stats,', ');
  $labels = rtrim($labels, ', ');

  ?>

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [<?php echo $labels; ?>],
      datasets: [{
        label: 'NOMBRE VENDU',
        data: [<?php echo $stats; ?>],
        borderWidth: 1
      }]
    },
    options: {
      
    }
  });
</script>


              
            </div><div class="col-md-5" style="padding-bottom: 20px;background-color:whitesmoke;border-radius: 20px;margin-top: 20px;">
              <h1><u><center>Produit moins Vendu</center></u></h1>
             <div>
  <canvas id="myChart2"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
  const ctx2 = document.getElementById('myChart2');

  <?php
  $getprod = mysqli_query($conn, "SELECT * FROM products  ORDER BY `products`.`nbreVendu` ASC LIMIT 6");
  $labels = "";
  $stats="";
  while ($prod = mysqli_fetch_array($getprod)) {
    $nomprod = $prod['product_name'];
    $nombrevisit=$prod['nbreVendu'];
    $stats.="'$nombrevisit', ";
    $labels .= "'$nomprod', ";
  }
  $stats = rtrim($stats,', ');
  $labels = rtrim($labels, ', ');

  ?>

  new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: [<?php echo $labels; ?>],
      datasets: [{
        label: 'NOMBRE VENDU',
        data: [<?php echo $stats; ?>],
        borderWidth: 2
      }]
    },
    options: {
      title: {
      display: true,
      text: 'NOMBRE VENDU'
    }
      
    }
  });
</script>



</div>





            <div class="col-md-1"></div>
        </div>
    
</section>
</main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>