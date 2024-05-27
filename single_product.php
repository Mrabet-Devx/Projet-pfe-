<?php include('layouts/header.php');?>
<?php
include('server/connection.php');?>

<?php include('server/get_bags.php');?>
<?php include('server/get_coats.php');?>
<?php include('server/get_shoes.php');?>
<?php include('server/get_watches.php');?>
<?php
if(isset($_GET['product_id']) && isset($_GET['product_category'])){
  $product_id=$_GET['product_id'];
  $product_category=$_GET['product_category'];
   $stmt=$conn->prepare("SELECT * FROM products WHERE product_id=?");
   $stmt->bind_param("i",$product_id);
   $stmt->execute();
   $product=$stmt->get_result();


if($product_category=="shoes"){
  $pro=$shoes;
}elseif($product_category=="watches"){
  $pro=$watches;
}elseif($product_category=="coats"){
  $pro=$coats_products;
}elseif($product_category=="bags"){
  $pro=$bags;
}


// Récupérer les informations sur le produit
$getpro = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $product_id");
$produit = mysqli_fetch_assoc($getpro);

if (isset($_GET['product_id']) && ($_GET['product_id'] == $produit['product_id'])) {
            $nbrclic = $produit['nbreClick'] + 1;
            mysqli_query($conn, "UPDATE products SET nbreClick = '$nbrclic' WHERE product_id = '" . $produit['product_id'] . "'");
        }
   // no produts id was given
}else{
  header('location: index.php');
}

?>




<!--Single Product-->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

      <?php while($row=$product->fetch_assoc()){ ?>
        
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image1']; ?>" id="mainImg"/>
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image1']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img"/>
                </div>
            </div>
        </div>
        

        <div class="col-lg-6 col-md-12 col-12">
            <h6> </h6>
            <h3 style="color: saddlebrown;" class="py-4"><?php echo $row['product_name']; ?></h3>
            <h2>$<?php echo $row['product_price']; ?></h2>
            
            <form method="POST" action="cart.php">
               <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
               <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
               <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
               <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
               <input type="number" name="product_quantity" value="1" step="1" min="1">
               <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
               
            </form>
           
          
            <h4 class="mt-5 mb-5">Détails du produit</h4>
            <span><?php echo $row['product_description']; ?>
            </span>
        </div>
        
       
        <?php } ?>
    </div>

</section>


<!--Related products-->
<section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Produits connexes</h3>
      <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">
  
    
   
    <?php while($row=$pro->fetch_assoc()){?>
     
      
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/></a>
        
      <h5 class="p-name"><b style="color: saddlebrown;"><?php echo $row['product_name']; ?></b></h5>
      <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
        <a href="<?php echo "single_product.php?product_id=".$row['product_id']."&product_category=".$row['product_category'];?>"><button class="buy-btn">Acheter maintenant</button></a>
      </div>
      <?php } ?> 
  
      
      
    </div>
  </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        var mainImg=document.getElementById("mainImg");
        var smallImg=document.getElementsByClassName("small-img");
        for(let i=0;i<4;i++){
            smallImg[i].onclick=function(){
                mainImg.src=smallImg[i].src;
            }
        }



    </script>


<?php include('layouts/footer.php');?>