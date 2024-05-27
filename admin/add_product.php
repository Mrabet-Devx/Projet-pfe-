<?php include('header.php');?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
        <?php include('sidemenu.php');?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2"></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>
                </div>
            </div>


            <h2>Ajouter un nouveau produit</h2>
            <div class="wrapper table-responsive">
                <div class="mx-auto container">
                  <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
                    <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                    <div class="form-group mt-2">
                       <label>Titre</label>
                       <input type="text" class="form-control" id="product-name" name="name" placeholder="Titre" required/>
                    </div>
                    <div class="form-group mt-2">
                       <label>Description</label>
                       <input type="text" class="form-control" id="product-desc" name="description" placeholder="Description" required/>
                    </div>
                    <div class="form-group mt-2">
                       <label>Prix</label>
                       <input type="number" step="0.01" min="0" class="form-control" id="product-price" name="price" placeholder="Prix" required/>
                    </div>
                    <div class="form-group mt-2">
                       <label>Offre spéciale/Vente</label>
                       <input type="number" step="1" min="0" max="100" class="form-control" id="product-offer" name="offer" placeholder="Offre %" required/>
                    </div>
                    <div class="form-group mt-2">
                       <label>Quantitée</label>
                       <input type="number" step="1" min="0" class="form-control" id="quantite" name="quantite" placeholder="Quantitée" required/>
                    </div>
                    <div class="form-group mt-2">
                       <label>Catégorie</label>
                
                       <select class="form-select" name="category" required>
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
                       <input type="text" class="form-control" id="product-color" name="color" placeholder="Couleur" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Image </label>
                       <input type="file" class="form-control" id="image" name="image" placeholder="Image" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Image 1</label>
                       <input type="file" class="form-control" id="image1" name="image1" placeholder="Image 1" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Image 2</label>
                       <input type="file" class="form-control" id="image2" name="image2" placeholder="Image 2" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Image 3</label>
                       <input type="file" class="form-control" id="image3" name="image3" placeholder="Image 3" required/>
                   </div>
                   <div class="form-group mt-2">
                       <label>Image 4</label>
                       <input type="file" class="form-control" id="image4" name="image4" placeholder="Image 4" required/>
                   </div>
                   <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="create_product" value="Créer">
                    </div>
                  </form>
                </div>
            </div>
        </main>
    </div>
</div>