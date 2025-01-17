<?php include('header.php');?>
<?php
 if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    $stmt=$conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order=$stmt->get_result(); //[]
}elseif(isset($_POST['edit_order'])){
    $order_status=$_POST['order_status'];
    $order_id=$_POST['order_id'];
    $stmt= $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si',$order_status,$order_id);
    if($stmt->execute()){
    header('location: index.php?order_updated=Order has been updated successfully');
    }else{
    header('location: products.php?order_failed=Error occured, try again');
    }
}else{
    header('location: index.php');
    exit;
}
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


            <h2>Modifier la Commande</h2>
            <div class="wrapper table-responsive">
            <div class="mx-auto container">
                <form id="login-form" method="POST" action="edit_order.php">
                    <?php foreach($order as $r){?>
                  <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                    <div class="form-group my-3">
                        <label>Id</label>
                        <p class="my-4"><?php echo $r['order_id'];?></p>

                    </div>
                    <div class="form-group my-3">
                        <label>Prix</label>
                        <p class="my-4"><?php echo $r['order_cost'];?></p>

                    </div>
                    
                    <input type="hidden" name="order_id" value="<?php echo $r['order_id'];?>">

                    <div class="form-group my-3">
                        <label>Statut</label>
                        <select class="form-select" required name="order_status">
                            
                            <option value="impayé" <?php if($r['order_status']=='impayé'){ echo "selected";}?>>Impayé</option>
                            <option value="payé" <?php if($r['order_status']=='payé'){ echo "selected";}?>>Payé</option>
                            <option value="expédié" <?php if($r['order_status']=='expédié'){ echo "selected";}?>>Expédié</option>
                            <option value="livré" <?php if($r['order_status']=='livré'){ echo "selected";}?>>Livré</option>
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label>Date</label>
                        <p class="my-4"><?php echo $r['order_date'];?></p>

                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="edit_order" value="Modifier">
                    </div>
                    <?php } ?>
                </form>
            </div>
            </div>
        </main>
    </div>
</div>
