<?php include('header.php');?>
<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit();
    }
?>
<?php
//1. determine page no
if(isset($_Get['page_no']) && $_GET['page_no'] != ""){
    //if user has already entered page then page number is the one that selected
    $page_no=$_GET['page_no'];
 }else{
    //if user just entered the page then default page is 1
    $page_no=1;
 }
 //2. return number of products
 $stmt1=$conn->prepare("SELECT COUNT(*) As total_records FROM products");
 $stmt1->execute();
 $stmt1->bind_result($total_records);
 $stmt1->store_result();
 $stmt1->fetch();
 
 //3. products per page
 $total_records_per_page=20;
 $offset= ($page_no-1) * $total_records_per_page;
 $previous_page=$page_no - 1;
 $next_page=$page_no + 1;
 $adjacents="2";
 $total_no_of_pages=ceil($total_records/$total_records_per_page);

 //4. get all products
 $stmt2=$conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
 $stmt2->execute();
 $products=$stmt2->get_result();



  
?>
  
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


    <h1>Produits</h1><br>
    <?php if(isset($_GET['edit_success_message'])){?>
        <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'];?></p>
    <?php } ?>
    <?php if(isset($_GET['deleted_successfully'])){?>
        <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'];?></p>
    <?php } ?>
    <?php if(isset($_GET['edit_failure_message'])){?>
        <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message'];?></p>
    <?php } ?>
    <?php if(isset($_GET['deleted_failure'])){?>
        <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'];?></p>
    <?php } ?>



    <?php if(isset($_GET['product_created'])){?>
        <p class="text-center" style="color: green;"><?php echo $_GET['product_created'];?></p>
    <?php } ?>
    <?php if(isset($_GET['product_failed'])){?>
        <p class="text-center" style="color: red;"><?php echo $_GET['product_failed'];?></p>
    <?php } ?>
    <?php if(isset($_GET['images_updated'])){?>
        <p class="text-center" style="color: green;"><?php echo $_GET['images_updated'];?></p>
    <?php } ?>
    <?php if(isset($_GET['images_failed'])){?>
        <p class="text-center" style="color: red;"><?php echo $_GET['images_failed'];?></p>
    <?php } ?>


    <p class="text-center"></p>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Nbr_Visite</th>
                    <th scope="col">Nbr_Vendu</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Couleur</th>
                    <th scope="col">Modifier_Img</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($products as $product){?>
                <tr>
                    <td><?php echo $product['product_id'];?></td>
                    <td><img src="<?php echo "../assets/imgs/". $product['product_image'];?>" style="width: 70px; height: 70px;"/></td>
                    <td><?php echo $product['product_name'];?></td>
                    <td><?php echo "$". $product['product_price'];?></td>
                    <td><?php echo $product['nbreVisite'];?></td>
                    <td><?php echo $product['nbreVendu'];?></td>
                    <td><?php echo $product['quantite'];?></td>
                    <td><?php echo $product['product_category'];?></td>
                    <td><?php echo $product['product_color'];?></td>
                    <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name'];?>">Modifier_Img</a></td>
                    <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id'];?>">Modifier</a></td>
                    <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id'];?>">Supprimer</a></td>
                </tr>
              <?php }?>
               
            </tbody>
        </table>

        <nav aria-label="Page navigation example" class="mx-auto">
        <ul class="pagination mt-5 mx-auto">

          <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
          <a class="page-link" href="<?php if($page_no<=1){echo '#';}else{ echo "?page_no=".($page_no-1);} ?>">Précédent</a>
        </li>
          <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
          <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
          <?php if($page_no >=3){?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no;?></a></li>
          <?php } ?>
          <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';}?>">
          <a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';}else{ echo "?page_no=".($page_no+1);}?>">Suivant</a></li>
        </ul>
      </nav>

    </div>
</main>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>