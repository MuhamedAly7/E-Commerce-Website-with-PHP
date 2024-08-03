<?php

// include("./includes/connect.php");

// getting products
function getProducts()
{
    global $con;

    if(!isset($_GET['category']))
    {
        if(!isset($_GET['brand']))
        {
            $products_table_name = "products";
            $select_product_query = "SELECT * FROM " . $products_table_name . " ORDER BY RAND() LIMIT 0,6";
            $products_obj = $con->prepare($select_product_query);
            if($products_obj->execute())
            {
                $res = $products_obj->get_result();
                while($row_data = $res->fetch_assoc())
                {
                    $product_id = $row_data['product_id'];
                    $product_title = $row_data['product_title'];
                    $product_description = $row_data['product_description'];
                    // $product_keywords = $row_data['product_keywords'];
                    $product_image1 = $row_data['product_image1'];
                    $product_price = $row_data['product_price'];
                    $product_category_id = $row_data['category_id'];
                    $product_brand_id = $row_data['brand_id'];
        
                    echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$product_description</p>
                                        <p class='card-text'>Price: $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                    </div>
                                </div>
                            </div>";
                }
            }
            else
            {
                
            }
        }
        else
        {

        }
    }
    else
    {

    }
}


// View details
function viewDetails()
{
    global $con;

    if(isset($_GET['product_id']))
    {
        if(!isset($_GET['category']))
        {
            if(!isset($_GET['brand']))
            {
                $product_id = $_GET['product_id'];
                $products_table_name = "products";
                $select_product_query = "SELECT * FROM " . $products_table_name . " WHERE product_id = ?";
                $products_obj = $con->prepare($select_product_query);
                $products_obj->bind_param("i", $product_id);
                if($products_obj->execute())
                {
                    $res = $products_obj->get_result();
                    while($row_data = $res->fetch_assoc())
                    {
                        $product_id = $row_data['product_id'];
                        $product_title = $row_data['product_title'];
                        $product_description = $row_data['product_description'];
                        // $product_keywords = $row_data['product_keywords'];
                        $product_image1 = $row_data['product_image1'];
                        $product_image2 = $row_data['product_image2'];
                        $product_image3 = $row_data['product_image3'];
                        $product_price = $row_data['product_price'];
                        $product_category_id = $row_data['category_id'];
                        $product_brand_id = $row_data['brand_id'];
            
                        echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$product_description</p>
                                        <p class='card-text'>Price: $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                        <a href='index.php' class='btn btn-secondary'>Go Home</a>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-8'>
                                 <div class='row'>
                                    <div class='col-md-12'>
                                        <h4 class='text-center text-info mb-5'>
                                            Related Products
                                        </h4>
                                    </div>
                                    <div class='col-md-6'>
                                        <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                                    </div>
                                    <div class='col-md-6'>
                                        <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>
                                    </div>
                                 </div>
                            </div>
                            ";
                    }
                }
                else
                {
                    
                }
            }
            else
            {
    
            }
        }
        else
        {
    
        }
    }
    else
    {

    }
}


// getting all products
function getAllProducts()
{
    global $con;

    if(!isset($_GET['category']))
    {
        if(!isset($_GET['brand']))
        {
            $products_table_name = "products";
            $select_product_query = "SELECT * FROM " . $products_table_name . " ORDER BY RAND()";
            $products_obj = $con->prepare($select_product_query);
            if($products_obj->execute())
            {
                $res = $products_obj->get_result();
                while($row_data = $res->fetch_assoc())
                {
                    $product_id = $row_data['product_id'];
                    $product_title = $row_data['product_title'];
                    $product_description = $row_data['product_description'];
                    // $product_keywords = $row_data['product_keywords'];
                    $product_image1 = $row_data['product_image1'];
                    $product_price = $row_data['product_price'];
                    $product_category_id = $row_data['category_id'];
                    $product_brand_id = $row_data['brand_id'];
        
                    echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$product_description</p>
                                        <p class='card-text'>Price: $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                    </div>
                                </div>
                            </div>";
                }
            }
            else
            {
                
            }
        }
        else
        {

        }
    }
    else
    {

    }
}


// Getting unique categories
function getUniqueCategories()
{
    global $con;

    if(isset($_GET['category']))
    {
        $category_id = $_GET['category'];
        $products_table_name = "products";
        $select_product_query = "SELECT * FROM " . $products_table_name . " WHERE category_id = ?";
        $products_obj = $con->prepare($select_product_query);
        $products_obj->bind_param("i", $category_id);
        if($products_obj->execute())
        {
            $res = $products_obj->get_result();
            if($res->num_rows > 0)
            {
                while($row_data = $res->fetch_assoc())
                {
                    $product_id = $row_data['product_id'];
                    $product_title = $row_data['product_title'];
                    $product_description = $row_data['product_description'];
                    // $product_keywords = $row_data['product_keywords'];
                    $product_image1 = $row_data['product_image1'];
                    $product_price = $row_data['product_price'];
                    $product_category_id = $row_data['category_id'];
                    $product_brand_id = $row_data['brand_id'];
            
                    echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$product_description</p>
                                        <p class='card-text'>Price: $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                    </div>
                                </div>
                            </div>";
                }
            }
            else
            {
                echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
            }
        }
        else
        {
            
        }
    }
    else
    {

    }
}


// Getting unique brands
function getUniqueBrands()
{
    global $con;

    if(isset($_GET['brand']))
    {
        $brand_id = $_GET['brand'];
        $products_table_name = "products";
        $select_product_query = "SELECT * FROM " . $products_table_name . " WHERE brand_id = ?";
        $products_obj = $con->prepare($select_product_query);
        $products_obj->bind_param("i", $brand_id);
        if($products_obj->execute())
        {
            $res = $products_obj->get_result();
            if($res->num_rows > 0)
            {
                while($row_data = $res->fetch_assoc())
                {
                    $product_id = $row_data['product_id'];
                    $product_title = $row_data['product_title'];
                    $product_description = $row_data['product_description'];
                    // $product_keywords = $row_data['product_keywords'];
                    $product_image1 = $row_data['product_image1'];
                    $product_price = $row_data['product_price'];
                    $product_category_id = $row_data['category_id'];
                    $product_brand_id = $row_data['brand_id'];
            
                    echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$product_description</p>
                                        <p class='card-text'>Price: $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                    </div>
                                </div>
                            </div>";
                }
            }
            else
            {
                echo "<h2 class='text-center text-danger'>No stock for this brand</h2>";
            }
        }
        else
        {
            
        }
    }
    else
    {

    }
}


function getBrands()
{
    global $con;
    $brands_table_name = "brands";
    $select_brands_query = "SELECT * FROM " . $brands_table_name;
    $brands_obj = $con->prepare($select_brands_query);
    if($brands_obj->execute())
    {
        $res = $brands_obj->get_result();
        while($row_data = $res->fetch_assoc())
        {
            $brand_title = $row_data['brand_title'];
            $brand_id = $row_data['brand_id'];
            // echo $brand_title;
            echo "<li class='nav-item'>
            <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
            </li>";
        }
    }
    else
    {

    }
}

function getCategories()
{
    global $con;
    $categories_table_name = "categories";
    $select_categories_query = "SELECT * FROM " . $categories_table_name;
    $categories_obj = $con->prepare($select_categories_query);
    if($categories_obj->execute())
    {
        $res = $categories_obj->get_result();
        while($row_data = $res->fetch_assoc())
        {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];
            // echo $category_title;
            echo "<li class='nav-item'>
            <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
            </li>";
        }
    }
    else
    {

    }
}

// Searching products
function searchProduct()
{
    global $con;
    if(isset($_GET['search_data_product']))
    {
        $products_table_name = "products";
        $user_search = $_GET['search_data'];
        $search_product_query = "SELECT * FROM " . $products_table_name . " WHERE product_keywords LIKE '%$user_search%'";
        $products_obj = $con->prepare($search_product_query);
        if($products_obj->execute())
        {
            $res = $products_obj->get_result();
            if($res->num_rows > 0)
            {
                while($row_data = $res->fetch_assoc())
                {
                    $product_id = $row_data['product_id'];
                    $product_title = $row_data['product_title'];
                    $product_description = $row_data['product_description'];
                    // $product_keywords = $row_data['product_keywords'];
                    $product_image1 = $row_data['product_image1'];
                    $product_price = $row_data['product_price'];
                    $product_category_id = $row_data['category_id'];
                    $product_brand_id = $row_data['brand_id'];
            
                    echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$product_description</p>
                                        <p class='card-text'>Price: $product_price/-</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                    </div>
                                </div>
                            </div>";
                }
            }
            else
            {
                echo "<h2 class='text-center text-danger'>No results matches. No products on this category!</h2>";
            }
        }
        else
        {
                
        }
    }
    else
    {

    }
}

// Getting ip address
function getIPAddress() 
{  
    //whether ip is from the share internet  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    //whether ip is from the proxy  
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    //whether ip is from the remote address  
    else
    {  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}


// cart function
function cart()
{
    if(isset($_GET['add_to_cart']))
    {
        global $con;
        $ip = getIPAddress();
        $product_id = $_GET['add_to_cart'];
        $quantity = 1;
        $cart_table_name = "cart_details";
        $select_product_query = "SELECT * FROM " . $cart_table_name . " WHERE ip_address = ? AND product_id = ?";

        $cart_obj = $con->prepare($select_product_query);
        $cart_obj->bind_param("si", $ip, $product_id);
        if($cart_obj->execute())
        {
            $res = $cart_obj->get_result();
            if($res->num_rows > 0)
            {
                echo "<script>alert('This item is already exists inside cart!');</script>";
                echo "<script>window.open('index.php','_self');</script>";
            }
            else
            {
                $insert_cart_query = "INSERT INTO " . $cart_table_name . " (product_id,ip_address,quantity) VALUES (?,?,?)";
                $cart_obj = $con->prepare($insert_cart_query);
                $cart_obj->bind_param("isi", $product_id, $ip, $quantity);
                if($cart_obj->execute())
                {
                    echo "<script>window.open('index.php','_self');</script>";
                }
                else
                {

                }
            }
        }
        else
        {

        }
    }
}


// Getting cart item numbers
function cartItem()
{
    if(isset($_GET['add_to_cart']))
    {
        global $con;
        $ip = getIPAddress();
        $cart_table_name = "cart_details";
        $select_product_query = "SELECT * FROM " . $cart_table_name . " WHERE ip_address = ?";

        $cart_obj = $con->prepare($select_product_query);
        $cart_obj->bind_param("s", $ip);
        $cart_obj->execute();
        $res = $cart_obj->get_result();
        $count_cart_items = $res->num_rows;
    }
    else
    {
        global $con;
        $ip = getIPAddress();
        $cart_table_name = "cart_details";
        $select_product_query = "SELECT * FROM " . $cart_table_name . " WHERE ip_address = ?";

        $cart_obj = $con->prepare($select_product_query);
        $cart_obj->bind_param("s", $ip);
        $cart_obj->execute();
        $res = $cart_obj->get_result();
        $count_cart_items = $res->num_rows;
    }
    echo $count_cart_items;
}


// Total Price function
function totalCartPrice()
{
    global $con;
    $ip = getIPAddress();
    $total_price = 0;
    $cart_table_name = "cart_details";
    $select_product_query = "SELECT * FROM " . $cart_table_name . " WHERE ip_address = ?";
    $cart_obj = $con->prepare($select_product_query);
    $cart_obj->bind_param("s", $ip);
    if($cart_obj->execute())
    {
        $res = $cart_obj->get_result();
        if($res->num_rows > 0)
        {
            while($row_data = $res->fetch_assoc())
            {
                $product_id = $row_data['product_id'];
                $products_table_name = "products";
                $select_products_query = "SELECT * FROM " . $products_table_name . " WHERE product_id = ?";
                $products_obj = $con->prepare($select_products_query);
                $products_obj->bind_param("i", $product_id);
                if($products_obj->execute())
                {
                    $res_products = $products_obj->get_result();
                    if($res_products->num_rows > 0)
                    {
                        while($row_data_products = $res_products->fetch_assoc())
                        {
                            $product_price = array($row_data_products['product_price'] * $row_data['quantity']);
                            $product_values = array_sum($product_price);
                            $total_price += $product_values;
                        }
                    }
                    else
                    {

                    }
                }
                else
                {

                }
            }
        }
        else
        {

        }
    }
    else
    {

    }

    echo $total_price;
}


// This function to display info and update quantity and remove carts
function manageCart()
{
    global $con;
    $ip = getIPAddress();
    $total_price = 0;
    $cart_table_name = "cart_details";
    $select_product_query = "SELECT * FROM " . $cart_table_name . " WHERE ip_address = ?";
    $cart_obj = $con->prepare($select_product_query);
    $cart_obj->bind_param("s", $ip);
    if ($cart_obj->execute()) {
        $res = $cart_obj->get_result();
        if($res->num_rows > 0) {
            // show the head of table if and only if there is a product in table
            echo "<thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <!-- <th>Remove</th> -->
                            <th colspan='2'>Operations</th>
                        </tr>
                    </thead>";
            while ($row_data = $res->fetch_assoc()) {
                $product_id = $row_data['product_id'];
                $products_table_name = "products";
                $select_products_query = "SELECT * FROM " . $products_table_name . " WHERE product_id = ?";
                $products_obj = $con->prepare($select_products_query);
                $products_obj->bind_param("i", $product_id);
                if ($products_obj->execute()) {
                    $res_products = $products_obj->get_result();
                    if ($res_products->num_rows > 0) {
                        while ($row_data_products = $res_products->fetch_assoc()) {
                            $product_price = array($row_data_products['product_price'] * $row_data['quantity']);
                            $price_table = $row_data_products['product_price'] * $row_data['quantity'];
                            $product_title = $row_data_products['product_title'];
                            $product_image1 = $row_data_products['product_image1'];
                            $product_values = array_sum($product_price);
                            $total_price += $product_values;
                            ?>
                            <tr>
                                <td><?php echo $product_title; ?></td>
                                <td><img src="./admin_area/product_images/<?php echo $product_image1; ?>" alt="" class="cart_img"></td>
                                <td><input type="text" name="quantity[<?php echo $product_id; ?>]" class="form-input w-50 my-2" value="<?php echo $row_data['quantity']; ?>"></td>
                                <td><?php echo $price_table; ?>/-</td>
                                <!-- <td><input type="checkbox" name="remove[]" value="<?php echo $product_id; ?>"></td> -->
                                <td>
                                    <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                                    <button type="submit" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart" value="<?php echo $product_id; ?>">Remove Cart</button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
            }
        }
        else
        {
            echo "<h2 class='text-center text-danger'>Cart is Empty!</h2>";
        }
    }

    // Update cart event
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            if (filter_var($quantity, FILTER_VALIDATE_INT) !== false) {
                $update_cart_query = "UPDATE " . $cart_table_name . " SET quantity = ? WHERE ip_address = ? AND product_id = ?";
                $update_cart_obj = $con->prepare($update_cart_query);
                $update_cart_obj->bind_param("isi", $quantity, $ip, $product_id);
                $update_cart_obj->execute();
                echo "<script>window.open('cart.php','_self');</script>";
            } else {
                echo "<script>alert('Quantity must be a number!');</script>";
                echo "<script>window.open('cart.php','_self');</script>";
            }
        }
    }

    // remove cart event
    if (isset($_POST['remove_cart'])) {
        $product_id = $_POST['remove_cart'];
        $delete_cart_query = "DELETE FROM " . $cart_table_name . " WHERE ip_address = ? AND product_id = ?";
        $delete_cart_obj = $con->prepare($delete_cart_query);
        $delete_cart_obj->bind_param("si", $ip, $product_id);
        $delete_cart_obj->execute();
        echo "<script>window.open('cart.php','_self');</script>";
    }

}





?>