<?php 
session_start();
include '../server/connection.php';

if(isset($_POST['submit'])){
$nom=$_POST['nom'];

$email=$_POST['email'];
$mdp=$_POST['mdp'];
$mdpcon=$_POST['mdpcon'];


if(!preg_match("/^[a-zA-Z ]*$/",$name)){
	header("location:./addadmin.php?error=nOnly letters and white space allowed");
}
elseif(empty($nom)){
	header("location:./addadmin.php?error=nom required");
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($email)) {
    header("location :./addadmin.php?error=L'adresse email n'est pas valide.");
}elseif (empty($mdp)) {
	header("location:./addadmin.php?error=Password required");
}elseif (8 > strlen($mdp) ) {
 	header("location:./addadmin.php?error=password court");
 }elseif (empty($mdpcon)) {
	header("location:./addadmin.php?error=Confirmer votre password");
}
 elseif ($mdp != $mdpcon) {
	header("location:./addadmin.php?error=Passwords non identique");
}else{
	$check_query = "SELECT * FROM admins WHERE admin_email = '$email'";
        $result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($result) > 0){
            header("Location: ./addadmin.php?error=Adresse email déjà utilisée");
            exit;
        }else{
	$add_admin="INSERT INTO admins (admin_name,admin_email,admin_password) VALUES ('$nom','$email','$mdp')";
	mysqli_query($conn,$add_admin);
	if(mysqli_affected_rows($conn) > 0) {
    echo '<script>alert("Admin ajouté!");</script>'; 
    header("refresh:0;url=./");
} else {
    header("location:index.php?error=Admin non ajouté");
} 
}
}
}

 ?>