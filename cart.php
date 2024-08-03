<?php
session_start();
include("./includes/connect.php");
include("./funcs/common_function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website Cart Page.</title>
    <!-- bootstarp CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS file -->
    <link rel="stylesheet" href="style.css">
    <style>
        .footer{
            position: absolute;
            width: 100%;
            bottom: 0;
        }
        .cart_img{
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="./images/shopping_logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cartItem(); ?></sup></a>
                        </li>
                    </ul> 
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if(! isset($_SESSION['username']))
                {
                    echo "<li class='nav-item'>
                            <a href='#' class='nav-link'>Welcome Guest</a>
                        </li>";
                }
                else
                {
                    echo "<li class='nav-item'>
                            <a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>
                        </li>";
                }
                
                if(! isset($_SESSION['username']))
                {
                    echo "<li class='nav-item'>
                            <a href='./users_area/user_login.php' class='nav-link'>Login</a>
                        </li>";
                }
                else
                {
                    echo "<li class='nav-item'>
                            <a href='./users_area/user_logout.php' class='nav-link'>Logout</a>
                        </li>";
                }
                
                
                ?>
            </ul>
        </nav>

        <!-- Third child -->
         <div class="bg-light">
            <h3 class="text-center">First Store</h3>
            <p class="text-center">Communications is at the heart of e-commerce and community</p>
         </div>

        
        <!-- Fourth child -->
        <div class="container">
            <form action="" method="POST">
                <div class="row">
                    <table class="table table-bordered text-center">
                        <!-- the table head is managed inside "manageCart" function -->
                        <tbody>
                            <!-- PHP for display real and dynamic data -->
                            <?php
                            manageCart();
                            ?>
                        </tbody>
                    </table>
                    <!-- sub-total -->
                    <?php
                    ob_start();
                    totalCartPrice();
                    $output = ob_get_clean();
                    $total_prices_on_cart = (int)$output;
                    if($total_prices_on_cart > 0)
                    {
                        ?>
                        <div class="d-flex mb-5">
                            <h4 class="px-3">Subtotal:<strong class="text-info"><?php totalCartPrice(); ?>/-</strong></h4>
                            <input type="submit" value="Continue Shopping" class="bg-info px-3 py-2 border-0 mx-3" name="continue_shopping">
                            <button class="bg-secondary text-light px-3 py-2 border-0 mx-3"><a href="./users_area/checkout.php" class="text-light text-decoration-none" >Checkout</a></button>
                        </div>
                        <?php
                        if(isset($_POST['continue_shopping']))
                        {
                            echo "<script>window.open('index.php', '_self');</script>";
                        }
                        ?>
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>

<!-- Update Cart data -->
<?php
// updateCart();
// removeCart();
?>

        <!-- last child -->
        <div class="bg-info p-3 text-center footer">
           <p>This Website Designed For Developed Online Shop</p>
        </div>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>