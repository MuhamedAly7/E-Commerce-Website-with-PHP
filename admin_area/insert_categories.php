<?php
include("../includes/connect.php");

if(isset($_POST["cat_title"]))
{
    $category_title = $_POST["cat_title"];    
    if(!empty($category_title))
    {
        // Select input data from database to insure that we do not have same category
        $category_table_name = 'categories';
        $select_category_query = "SELECT * FROM " . $category_table_name . " WHERE category_title = ?";
        $cat_obj = $con->prepare($select_category_query);
        $cat_obj->bind_param("s", $category_title);
        if($cat_obj->execute())
        {
            $data = $cat_obj->get_result();
            if($data->num_rows > 0)
            {
                echo "<script>alert('" . $category_title . " category already exists!');</script>";
            }
            else
            {
                $insert_category_query = "INSERT INTO " . $category_table_name . " (category_title) VALUES(?)";
                $cat_obj = $con->prepare($insert_category_query);
                $cat_obj->bind_param("s", $category_title);
                if($cat_obj->execute())
                {
                    echo "<script>alert('" . $category_title . " category has been inserted successfully!');</script>";
                }
                else
                {
                    echo "<script>alert('Failed to insert " . $category_title . " category!');</script>";
                }
            }
        }
        else
        {
            echo "<script>alert('Failed to search the category inside shop!');</script>";
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

<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="Categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert-cat" value="Insert Categories">
        <!-- <button class="bg-info p-1 m-3 border-0">Insert Categories</button> -->
    </div>
</form>