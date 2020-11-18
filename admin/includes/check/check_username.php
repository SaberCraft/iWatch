<?php
// mysql connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "shop";
$con = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($con));

if (isset($_POST["username"]))
{
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $sql = "select user_name from users where user_name='$username'";
    $result = mysqli_query($con, $sql);
    echo mysqli_num_rows($result);
}

if (isset($_POST["new_username"]))
{
    $new = $_POST["new_username"];

    $new_username = mysqli_real_escape_string($con, $new);
    $sql = "SELECT user_id FROM users WHERE user_name = '$new_username'";
    $result = mysqli_query($con, $sql);
    echo mysqli_num_rows($result);
}
?>