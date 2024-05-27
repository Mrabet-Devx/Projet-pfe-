<?php session_start();?>
<?php include('../server/connection.php');?>
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
 $stmt2=$conn->prepare("SELECT * FROM products WHERE quantite < 5 ORDER BY quantite DESC LIMIT $offset,$total_records_per_page");
 $stmt2->execute();
 $products=$stmt2->get_result();



  
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
            <a class="nav-link px-3" href="logout.php?logout=1">Sign out</a>
           

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
        <h1 class="h2"></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">

            </div>
        </div>
    </div>




    <h2>Products</h2>
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
                    <th scope="col">Product Id</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Offer</th>
                    <th scope="col" style="color: red;">Product Quantite</th>
                    <th scope="col">Product Category</th>
                    <th scope="col">Product Color</th>
                  
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($products as $product){?>
                <tr>
                    <td><?php echo $product['product_id'];?></td>
                    <td><img src="<?php echo "../assets/imgs/". $product['product_image'];?>" style="width: 70px; height: 70px;"/></td>
                    <td><?php echo $product['product_name'];?></td>
                    <td><?php echo "$". $product['product_price'];?></td>
                    <td><?php echo $product['product_special_offer']."%";?></td>
                    <td style="color: red;"><?php echo $product['quantite'];?></td>
                    <td><?php echo $product['product_category'];?></td>
                    <td><?php echo $product['product_color'];?></td>
                    
                    <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id'];?>">Edit</a></td>
                    <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id'];?>">Delete</a></td>
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
