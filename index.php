
<?php 
include('layouts/header.php');?>

<!--Home-->
<section id="home">
  <div class="container">
<h5>Nouvelles Arrivées</h5>
<h1><span>Meilleurs prix</span>  Cette Saison</h1> 
<p>Eshop propose les meilleurs produits aux prix les plus abordables</p>
<a href="shop.php"><button class="text-uppercase">Achetez Maintenant</button></a>

</div>
</section>
<br><br>
<!--Brand
<section id="brand" class="container">
  <div class="row m-0">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12"  src="assets/imgs/brand1.jpg">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12"  src="assets/imgs/brand2.jpg">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12"  src="assets/imgs/brand3.jpg">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12"  src="assets/imgs/brand4.jpg">
    </div>
</section> -->
<!--New-->
<section id="new" class="w-100">
  <div class="row p-0 m-0">
   <!--One-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/3.png" >
      <div class="details">
        <h2>Des chaussures vraiment géniales</h2>
       <a href="shop.php"><button class="text-uppercase">Achetez Maintenant</button></a>
      </div>
    </div>
<!--Two-->
<div class="one col-lg-4 col-md-12 col-sm-12 p-0">
  <img class="img-fluid" src="assets/imgs/2.png" >
  <div class="details">
    <h2>Superbe veste</h2>
    <a href="shop.php"><button class="text-uppercase">Achetez Maintenant</button></a>
  </div>
</div>
<!--Three-->
<div class="one col-lg-4 col-md-12 col-sm-12 p-0">
  <img class="img-fluid" src="assets/imgs/1.png" >
  <div class="details">
    <h2>50% Montres OFF</h2>
    <a href="shop.php"><button class="text-uppercase">Achetez Maintenant</button></a>
  </div>
</div>
  </div>
</section>
<!--Featured-->
<section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Notre vedette</h3>
    <hr class="mx-auto">
    <p>Ici vous pouvez consulter nos produits vedettes</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php include('server/get_featured_products.php');?>
    <?php while($row=$featured_products->fetch_assoc()){?>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
    <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/></a>
      
      <h5 class="p-name"><b style="color: saddlebrown;"><?php echo $row['product_name']; ?></b></h5>
      <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
      <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><button class="buy-btn">Acheter Maintenant</button></a>
    </div>
   <?php } ?>

    
    
  </div>
</section>

<!-- Banner -->
<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4>SOLDES DE MI-SAISON</h4>
    <h1>Collection d'Automne <br> JUSQU'À 30% DE RÉDUCTION</h1>
    <a href="shop.php"><button class="text-uppercase">Achetez Maintenant</button></a>

  </div>
</section>

<!--Clothes-->
<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Vêtements</h3>
    <hr class="mx-auto">
    <p>Ici vous pouvez découvrir nos superbes vêtements</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_coats.php'); ?>
  <?php while($row=$coats_products->fetch_assoc()){?>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
    <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/></a>
      
      <h5 class="p-name"><b style="color: saddlebrown;"><?php echo $row['product_name']; ?></b></h5>
      <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
      <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
  <?php } ?>
    
  </div>
</section>

<!--Watches-->
<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Meilleures montres</h3>
    <hr class="mx-auto">
    <p>Découvrez nos montres uniques</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_watches.php'); ?>
  <?php while($row=$watches->fetch_assoc()){?>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
    <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/></a>
      
      <h5 class="p-name"><b style="color: saddlebrown;"><?php echo $row['product_name']; ?></b></h5>
      <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
      <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
  <?php } ?>
    
  </div>
</section>

<!--Shoes-->
<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Chaussures</h3>
    <hr class="mx-auto">
    <p>Ici vous pouvez découvrir nos superbes chaussures</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_shoes.php'); ?>
  <?php while($row=$shoes->fetch_assoc()){?>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
    <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/></a>
      
      <h5 class="p-name"><b style="color: saddlebrown;"><?php echo $row['product_name']; ?></b></h5>
      <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
      <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
  <?php } ?>
    
  </div>
</section>

<!--Sacs-->
<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Sac a Dos</h3>
    <hr class="mx-auto">
    <p>Ici vous pouvez découvrir nos Sac a Dos pour Hommes et Femmes</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_bags.php'); ?>
  <?php while($row=$bags->fetch_assoc()){?>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
    <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/></a>
      
      <h5 class="p-name"><b style="color: saddlebrown;"><?php echo $row['product_name']; ?></b></h5>
      <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
      <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
  <?php } ?>
    
  </div>
</section>


<?php include('layouts/footer.php');?>