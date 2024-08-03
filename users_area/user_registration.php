<?php
session_start();
include("../includes/connect.php");
include("../funcs/common_function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootstarp CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- Username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" autocomplete="off" placeholder="Enter your username" required="required" name="user_username">
                    </div>
                    <!-- Email field -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" autocomplete="off" placeholder="Enter your email" required="required" name="user_email">
                    </div>
                    <!-- Image field -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image">
                    </div>
                    <!-- Password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" autocomplete="off" placeholder="Enter your password" required="required" name="user_password">
                    </div>
                    <!-- Confirm field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" autocomplete="off" placeholder="Confirm password" required="required" name="conf_user_password">
                    </div>
                    <!-- Address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" autocomplete="off" placeholder="Enter your address" required="required" name="user_address">
                    </div>
                    <!-- Contact field -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control" autocomplete="off" placeholder="Enter your mobile number" required="required" name="user_contact">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account?<a href="user_login.php"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>

    </div>

<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


<?php

if(isset($_POST['user_register']))
{
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();    
    $users_table_name = "user_table";
    $cart_table_name = "cart_details";

    // select query to avoid duplication of username
    $user_select_query = "SELECT * FROM " . $users_table_name . " WHERE username = ? OR user_email = ?";
    $user_obj = $con->prepare($user_select_query);
    $user_obj->bind_param("ss", $user_username, $user_email);
    if($user_obj->execute())
    {
        $res = $user_obj->get_result();
        if($res->num_rows > 0)
        {
            echo "<script>alert('Username or Email is already exists!');</script>";
        }
        elseif($user_password != $conf_user_password)
        {
            echo "<script>alert('Passwords does not match!');</script>";
        }
        else
        {
            move_uploaded_file($user_image_tmp, "./user_images/$user_image");
            $user_insert_query = "INSERT INTO " . $users_table_name . "(username,user_email,user_password,user_image,user_ip,user_address,user_mobile) VALUES (?,?,?,?,?,?,?)";
            $user_insert_obj = $con->prepare($user_insert_query);
            $user_insert_obj->bind_param("sssssss", $user_username, $user_email, $hash_password, $user_image, $user_ip, $user_address, $user_contact);
            if($user_insert_obj->execute())
            {
                echo "<script>alert('User inserted successfully!');</script>";
            }
            else
            {
                echo "<script>alert('Failed to insert user!');</script>";
            }
        }
    }

    // selecting cart items
    $select_cart_items = "SELECT * FROM " . $cart_table_name . " WHERE ip_address = ?";
    $select_cart_obj = $con->prepare($select_cart_items);
    $select_cart_obj->bind_param("s", $user_ip);
    if($select_cart_obj->execute())
    {
        $result = $select_cart_obj->get_result();
        if($result->num_rows > 0)
        {
            $_SESSION['username'] = $user_username;
            echo "<script>alert('You have items in your cart');</script>";
            echo "<script>window.open('checkout.php', '_self');</script>";
        }
        else
        {
            $_SESSION['username'] = $user_username;
            echo "<script>window.open('../index.php', '_self');</script>";

        }
    }
    else
    {

    }
}

?>