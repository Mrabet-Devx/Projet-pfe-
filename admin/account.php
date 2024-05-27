<?php include('header.php'); ?>

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
                <h1 class="h2">Compte Administrateur</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>
                </div>
            </div>

            <div class="container">
                <p>Id:    <b><?php echo $_SESSION['admin_id'];?></b></p>
                <p>Nom:   <b><?php echo $_SESSION['admin_name'];?></b></p>
                <p>Email: <b><?php echo $_SESSION['admin_email'];?></b></p>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
