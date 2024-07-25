
<?php
include("../includes/connect.php");

if(isset($_POST["brand_title"]))
{
    $brand_title = $_POST["brand_title"];
    if(!empty($brand_title))
    {
        // Select input data from database to insure that we do not have same brand
        $brand_table_name = 'brands';
        $select_brand_query = "SELECT * FROM " . $brand_table_name . " WHERE brand_title = ?";
        $brand_obj = $con->prepare($select_brand_query);
        $brand_obj->bind_param("s", $brand_title);
        if($brand_obj->execute())
        {
            $data = $brand_obj->get_result();
            if($data->num_rows > 0)
            {
                echo "<script>alert('" . $brand_title . " brand already exists!');</script>";
            }
            else
            {
                $insert_brand_query = "INSERT INTO " . $brand_table_name . " (brand_title) VALUES(?)";
                $brand_obj = $con->prepare($insert_brand_query);
                $brand_obj->bind_param("s", $brand_title);
                if($brand_obj->execute())
                {
                    echo "<script>alert('" . $brand_title . " brand has been inserted successfully!');</script>";
                }
                else
                {
                    echo "<script>alert('Failed to insert " . $brand_title . " brand!');</script>";
                }
            }
        }
        else
        {
            echo "<script>alert('Failed to search the brand inside shop!');</script>";
        }
    }
    else
    {
        echo "<script>alert('Empty Input!');</script>";
    }
}
else
{

}

?>


<h2 class="text-center">Insert Brands</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brands" aria-label="brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="bg-info border-0 p-2 my-3" name="insert-brand" value="Insert Brands">
        <!-- <button class="bg-info p-1 m-3 border-0">Insert Brands</button> -->
    </div>
</form>