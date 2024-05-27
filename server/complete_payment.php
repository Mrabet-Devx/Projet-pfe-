<?php
session_start();
include('connection.php');
if(isset($_GET['transaction_id']) && isset($_GET['order_id'])){

    $order_id=$_GET['order_id'];
    $order_status="payé";
    $transaction_id=$_GET['transaction_id'];
    $user_id=$_SESSION['user_id'];
    $payment_date=date('Y-m-d H:i:s');

    //change order_status to paid
    $stmt= $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si',$order_status,$order_id);

    $stmt->execute();

    // Récupérer les informations sur le produit
$getpro = mysqli_query($conn, "SELECT product_id FROM order_items WHERE order_id = $order_id");
$getpro1 = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN (SELECT product_id FROM order_items WHERE order_id = $order_id)");
$produit = mysqli_fetch_assoc($getpro);
$produit1 = mysqli_fetch_assoc($getpro1);

//if (isset($_GET['order_id']) && ($_GET['order_id'] == $produit['order_id'])) {
            $nbrclic = $produit1['nbreVendu'] + 1;
            mysqli_query($conn, "UPDATE products SET  nbreVendu = (nbreVendu + 1) WHERE product_id IN (SELECT product_id FROM order_items WHERE order_id = $order_id)");
            mysqli_query($conn, "UPDATE products SET  quantite = (quantite - 1) WHERE product_id IN (SELECT product_id FROM order_items WHERE order_id = $order_id)");
  //    }


    //store payment
    $stmt1=$conn->prepare("INSERT INTO payments (order_id,user_id,transaction_id,payment_date)
                            VALUES (?,?,?,?);");

    $stmt1->bind_param('iiss',$order_id,$user_id,$transaction_id,$payment_date);
    $stmt1->execute();



    //go to user account
    header("location: ../account.php?payment_message=Payé avec succès, Merci pour vos achats chez nous");
    exit();
}else{
    header("location: index.php");
    exit;
}
?>