<?php include('layouts/header.php');?>
<?php


if(isset($_POST['order_pay_btn'])){
    $order_status=$_POST['order_status'];
    $order_total_price=$_POST['order_total_price'];
}

?>



<!--Payment-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Paiement</h2>
        <hr class="mx-auto"/>
        <br><br><br><br><br><br>
        <div class="center mx-auto container">

        <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "impayé"){ ?>
            <?php $amount=strval($_POST['order_total_price']);?>
            <?php $order_id=$_POST['order_id'];?>
            <p>Paiement Total: $<?php echo $_POST['order_total_price'];?></p>
            <!-- <input class="btn btn-primary" type="submit" value="Pay Now"> -->
            <!-- Set up a container element for the button -->
                <div style="left:40px;" id="paypal-button-container"></div>    

        <?php } elseif(isset($_SESSION['total']) && $_SESSION['total'] != 0){ ?>
            <?php $amount=strval($_SESSION['total']);?>
            <?php $order_id=$_SESSION['order_id'];?>
            <p>Paiement Total: $<?php echo $_SESSION['total']; ?></p>
            <!-- <input class="btn btn-primary" type="submit" value="Pay Now"> -->
            <!-- Set up a container element for the button -->
                <div id="paypal-button-container"></div>
       

        <?php }else{ ?>
            <p>Vous n'avez pas de commande</p>
        <?php } ?>
        </div>
    </div>
    
</section>

<!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AaGIt4dJhjfMXUxNjbtelvD4NPdh3UPQM6E3C0MRhgzBk_TPlKOiK4Ns5rK6a8mPefJKw_l-E00ZeXT5&currency=USD"></script>



<script>
    paypal.Buttons({
        //Sets up the transaction when a payment button is clicked
        createOrder: function(date, actions){
            return actions.order.create({
                purchase_units:  [{
                    amount: {
                        value: '<?php echo $amount;?>'  //Can reference variables or functions. Example: `value: document.getElementById('...').value`
                    }
                }]
            });
        },

        // Finalize the transaction after payer approval
        onApprove: function(data, actions){
            return actions.order.capture().then(function(orderData) {
                //Successful capture! for dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee concole for all available details');
                    
                    window.location.href="server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id;?>;
                //When ready to go live, remove the alert and show a success message within this page. For example:
                //var element = document.getElementById('paypal-button-container');
                //element.innerHTML = '';
                //element.innerHTML = '<h3>Thank you for your payment!</h3>';
                //Dr go to another URL: actions.redirect('thank_you.html);
            });
        }
    }).render('#paypal-button-container');

</script>



<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php include('layouts/footer.php');?>
