<?php
include("connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$name       = $_POST['name'];
$mobile     = $_POST['Mobile'];   // FIXED
$password   = $_POST['password'];
$cpassword  = $_POST['cpassword'];
$address    = $_POST['address'];
$image      = $_FILES['photo']['name'];
$tmp_name   = $_FILES['photo']['tmp_name'];
$role       = $_POST['role'];

if($password == $cpassword){

    // UPLOAD IMAGE (CORRECT PATH)
    move_uploaded_file($tmp_name, "uploads/$image");

    // FIXED QUERY — IMPORTANT!
    $insert = mysqli_query($connect, 
        "INSERT INTO user(name, mobile, address, password, photo, role, status, votes) 
        VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', 0, 0)"
    );

    if($insert){
        echo "
            <script>
                alert('Registration Successful!');
                window.location = 'index.html';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Some error occurred! Check database connection.');
                window.location = 'register.html';
            </script>
        ";
    }

} else {
    echo "
        <script>
            alert('Password and confirm password do not match.');
            window.location = 'register.html';
        </script>
    ";
}
?>
