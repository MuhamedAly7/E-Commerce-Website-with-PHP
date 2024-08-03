<?php
// session_start();
include("../includes/connect.php");
include("../funcs/common_function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="POST">
                    <!-- Username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" autocomplete="off" placeholder="Enter your username" required="required" name="user_username">
                    </div>
                    <!-- Password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" autocomplete="off" placeholder="Enter your password" required="required" name="user_password">
                    </div>
                    <div class="form-outline mb-4">
                        <a href="#">Forget password</a>
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?<a href="user_registration.php"> Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
if(isset($_POST['user_login'])) {
    $username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_ip = getIPAddress();
    $user_table_name = 'user_table';
    $select_user_query = 'SELECT * FROM ' . $user_table_name . ' WHERE username = ?';
    $user_obj = $con->prepare($select_user_query);
    $user_obj->bind_param('s', $username);
    if($user_obj->execute()) {
        $res = $user_obj->get_result();

        // Cart Item
        $cart_table_name = 'cart_details';
        $select_item_query = 'SELECT * FROM ' . $cart_table_name . ' WHERE ip_address=?';
        $item_object = $con->prepare($select_item_query);
        $item_object->bind_param('s', $user_ip);
        $item_object->execute();
        $item_res = $item_object->get_result();
        $items_count = $item_res->num_rows;

        if($res->num_rows > 0) {
            $row_data = $res->fetch_assoc();
            if(password_verify($user_password, $row_data['user_password'])) {
                $_SESSION['username'] = $username;
                if($items_count == 0) {
                    echo "<script>window.open('profile.php', '_self');</script>";
                } else {
                    echo "<script>window.open('payment.php', '_self');</script>";
                }
                exit();
            } else {
                echo "<script>alert('Invalid Credentials');</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    } else {
        echo "<script>alert('Error executing query');</script>";
    }
}
?>
