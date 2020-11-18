<?php
// mysql connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "shop";
$con = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($con));

if (isset($_POST["cat_name"]))
{
    $cat_name = mysqli_real_escape_string($con, $_POST["cat_name"]);
    $sql = "select cat_name from categories where cat_name='$cat_name'";
    $result = mysqli_query($con, $sql);
    echo mysqli_num_rows($result);
}

if (isset($_POST["new_cat_name"]))
{
    $new = $_POST["new_cat_name"];

    $new_cat_name = mysqli_real_escape_string($con, $new);
    $sql = "SELECT cat_id FROM categories WHERE cat_name = '$new_cat_name'";
    $result = mysqli_query($con, $sql);
    echo mysqli_num_rows($result);   
}
?>