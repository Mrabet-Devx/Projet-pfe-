<?php include('header.php');?>
<?php
    if(isset($_GET['product_id'])){
        $product_id=$_GET['product_id'];
        $stmt=$conn->prepare("SELECT * FROM products WHERE product_id=?");
        $stmt->bind_param('i',$product_id);
        $stmt->execute();
        $products=$stmt->get_result(); //[]
    }elseif(isset($_POST['edit_btn'])){
        $product_id=$_POST['product_id'];
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $offer=$_POST['offer'];
        $quantite=$_POST['quantite'];
        $color=$_POST['color'];
        $category=$_POST['category'];
        $stmt= $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?,
                              product_special_offer=?,quantite=?, product_color=?, product_category=? WHERE product_id=?");
        $stmt->bind_param('ssssissi',$title,$description,$price,$offer,$quantite,$color,$category,$product_id);
       if($stmt->execute()){
        header('location: products.php?edit_success_message=Product has been updated successfully');
       }else{
        header('location: products.php?edit_failure_message=Error occured, try again');
       }
    }else{
        header('products.php');
        exit;
    }

?>
<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
        <?php include('sidemenu.php');?>

        <main class="col-md-6 mx-auto col-lg-6 px-md-4 text-center">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">

                </div>
            </div>
        </div>
        <h2>Modifier Produit</h2>
        <div class="wrapper table-responsive">

        <div class="mx-auto container">
               <form id="login-form" method="POST" action="edit_product.php">
                 <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                   <div class="form-group mt-2">
                    <?php foreach($products as $product){?>
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>"/>
                       <label>Titre</label>
                       <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name'];?>" name="title" placeholder="Title" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Description</label>
                       <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description'];?>" name="description" placeholder="Description" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Prix</label>
                       <input type="number" step="0.01" min="0" class="form-control" id="product-price" value="<?php echo $product['product_price'];?>" name="price" placeholder="Price" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Catégorie</label>
                       <select class="form-select" required name="category">
                       <?php 
    $get_cat="SELECT * FROM products GROUP BY `products`.`product_category` DESC";
    $run=mysqli_query($conn,$get_cat);
    while($resultat = mysqli_fetch_array($run))
    {      
        $selected = (isset($_POST['products']) && $_POST['products']==$resultat['product_category']) ? 'selected' : '';
        echo '<option value="'.$resultat['product_category'].'" '.$selected.'>'.$resultat['product_category'].'</option>';       
    }
    ?>
                       </select>

                   </div>
                   <div class="form-group mt-2">
                       <label>Couleur</label>
                       <input type="text" class="form-control" value="<?php echo $product['product_color'];?>" id="product-color" name="couleur" placeholder="Color" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Offre spéciale/Vente</label>
                       <input type="number" step="1" min="0" max="100" class="form-control" value="<?php echo $product['product_special_offer'];?>" id="product-offer" name="offer" placeholder="Vente %" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Quantitée</label>
                       <input type="number" step="1" min="0" class="form-control" value="<?php echo $product['quantite'];?>" id="quantite" name="quantite" placeholder="Quantitée" required/>
                   </div>
       
                   <div class="form-group mt-3">
                       <input type="submit" class="btn btn-primary" name="edit_btn" value="Modifier"/>
                   </div>
                  <?php }?>
               </form>

        </div>
    
    
    </div>
</div>