<?php
include("../includes/connect.php");

if(isset($_POST['insert_product']))
{
    $product_title = $_POST['product_title'];
    $product_description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // Accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Accessing image temp name
    $tmp_image1 = $_FILES['product_image1']['tmp_name'];
    $tmp_image2 = $_FILES['product_image2']['tmp_name'];
    $tmp_image3 = $_FILES['product_image3']['tmp_name'];

    // checking if these empty
    if(empty($product_title) or empty($product_description) or empty($product_keywords) or empty($product_category) or empty($product_brand) or empty($product_price) or empty($product_image1) or empty($product_image2) or empty($product_image3))
    {
        echo "<script>alert('Please fill all available fields.');</script>";
        exit();
    }
    else
    {
        move_uploaded_file($tmp_image1, "./product_images/$product_image1");
        move_uploaded_file($tmp_image2, "./product_images/$product_image2");
        move_uploaded_file($tmp_image3, "./product_images/$product_image3");

        // start inserting query
        $products_table_name = "products";
        $insert_product_query = "INSERT INTO " . $products_table_name . " (product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,status) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $product_obj = $con->prepare($insert_product_query);
        $product_obj->bind_param("sssiisssss", $product_title, $product_description, $product_keywords, $product_category, $product_brand, $product_image1, $product_image2, $product_image3, $product_price, $product_status);
        if($product_obj->execute())
        {
            echo "<script>alert('Product inserted successfully');</script>";
        }
        else
        {
            echo "<script>alert('Failed to add the product!');</script>";
        }
    }
}
else
{

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Page</title>
    <!-- bootstarp css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS file -->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Producs</h1>
        <!-- Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- product title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- product description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!-- product keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>

            <!-- Categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select A Category</option>
                    <?php
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
                                echo "<option value='$category_id'>$category_title</option>";
                            }
                        }
                        else
                        {

                        }
                    // End of php tag?>
                </select>
            </div>

            <!-- Brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brand" id="" class="form-select">
                    <option value="">Select A Brand</option>
                    <?php
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
                                echo "<option value='$brand_id'>$brand_title</option>";
                            }
                        }
                        else
                        {
    
                        }
                    // End of php tag?>
                </select>
            </div>

            <!-- Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>

            <!-- Image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
            </div>

            <!-- Image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
            </div>

            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>

            <!-- Submit inserting -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Product">
            </div>
        </form>
    </div>
    
    <!-- bootstarp js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>