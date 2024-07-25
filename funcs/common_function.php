<?php

include("./includes/connect.php");

// getting products
function getProducts()
{
    global $con;

    if(!isset($_GET['category']))
    {
        if(!isset($_GET['brand']))
        {
            $products_table_name = "products";
            $select_product_query = "SELECT * FROM " . $products_table_name . " ORDER BY RAND() LIMIT 0,9";
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
                                        <a href='#' class='btn btn-info'>Add to cart</a>
                                        <a href='#' class='btn btn-secondary'>View more</a>
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
                                        <a href='#' class='btn btn-info'>Add to cart</a>
                                        <a href='#' class='btn btn-secondary'>View more</a>
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
                                        <a href='#' class='btn btn-info'>Add to cart</a>
                                        <a href='#' class='btn btn-secondary'>View more</a>
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


?>