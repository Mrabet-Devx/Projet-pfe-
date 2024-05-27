
<?php include('header.php');?>
<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit();
    }
?>



<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
<?php include('sidemenu.php');?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">   </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">

            </div>
        </div>
    </div>
<section>
    <div class="row">
    <h1 class="h2">   Gérer Categories & Produits   </h1><br>
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <br>
            <form method="POST" class="d-flex">
                <select class="form-select" name="products" style="background-color: lightslategrey;">
    <?php 
    $get_cat="SELECT *,COUNT(product_category) FROM products GROUP BY `products`.`product_category` DESC";
    $run=mysqli_query($conn,$get_cat);
    while($resultat = mysqli_fetch_array($run))
    {      
        $selected = (isset($_POST['products']) && $_POST['products']==$resultat['product_category']) ? 'selected' : '';
        echo '<option style="text-align:center" value="'.$resultat['product_category'].'" '.$selected.'>'.$resultat['product_category'] .' ('.$resultat['COUNT(product_category)'].')</option>';       
    }
    ?>
</select>

                </div>
                <div class="col-md-1">

<br>
                    <button type="submit" id="submit" name="submit" class="btn btn-success">O</button></div>


                    
               
            </form>

        
    </div>
    <br><br>
    <?php 
    
if (isset($_POST['submit'])) {
     
      $categorie = $_POST['products'];
      $sql = mysqli_query($conn,"SELECT * FROM products WHERE product_category='$categorie'");
      if (mysqli_num_rows($sql) > 0) {
      
      $cat=mysqli_fetch_array($sql);
      
      $getpro = mysqli_query($conn,"SELECT * FROM products WHERE product_category = '".$cat['product_category']."'");
      $count = mysqli_num_rows($getpro);
  
      if ($count == 0) {
        echo "<center><b><u>cette categorie est vide</u></b></center>";
    } else { ?>
        <div class="table-responsive">
     <?php     echo '<table class="table table-striped table-sm" ><thead class="thead-dark"><tr><th scope="col">PRODUIT</th><th scope="col"><center>Clics</center></th><th scope="col"><center>DESCRIPTION</center></th><th scope="col">PRIX</th><th scope="col">Img</th><th scope="col"><center>Action</center></th></tr></thead>';
  
          while ($res = mysqli_fetch_array($getpro)) {
              echo '<tr>';
              echo '<td>'.$res['product_name'].'</td>';
              echo '<td>'.$res['nbreClick'].'</td>';
              echo '<td>'.$res['product_description'].'</td>';
              echo '<td>$'.$res['product_price'].'</td>';
              echo '<td><img src="../'.$res['product_image'].'" style="width: 80px; height: 80px;"></td>';
              
              echo '<td>';?>
                      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                         <?php echo '<input type="hidden" name="idProduit" value="'.$res['product_id'].'">
                          <center><button class="btn btn-danger" name="delete" style="width: 100px;"><center>Supprimer</center></button></center>
                      </form>
                  </td>';
              echo '</tr>';
          }
          echo '</table>';
  
        }    
      
        echo '</div><div class="row"><div class="col-1"></div>
        <div class="col-10">';
    echo '<form method="POST">
                    <input type="hidden" name="idCat" value="'.$cat['product_category'].'">
                    <center><button class="btn btn-danger" name="deletecat" style="width: auto;"><center>Supprimer la Categorie</center></button></center>
                </form></div></div>';




    }else {
    echo "<center><b><u>cette categorie n'existe pas</u></b></center>";
    }
}
/*if (isset($_POST['delete'])) {
  $id=$_POST['idProduit'];
  $del="DELETE FROM products WHERE product_id = $id";
  mysqli_query($conn,$del);
}*/

if (isset($_POST['delete'])) {
    $id = $_POST['idProduit'];
    $query = "DELETE FROM products WHERE product_id='$id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
    /*  echo '<script>document.getElementById("submit").click();</script>';
      
      //$categorie = $_POST['categorie'];
      //$getpro = mysqli_query($conn, "SELECT * FROM produit WHERE idCat='$categorie'");
    } else {*/
      echo "Failed to delete product";
    }
}
  

if (isset($_POST['deletecat'])) {
  $id=$_POST['idCat'];
  $del="DELETE FROM products WHERE product_category = '$id'";
  mysqli_query($conn,$del);
}
  
  
     





                ?>
           


     
    

</section>


</main>
</div></div>


</body>
<center><?php include './footeradmin.php'; ?></center>
</html>