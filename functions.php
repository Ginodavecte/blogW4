<?php
//redirect functie
function redirect_to($new_location){
    header("Location: " . $new_location);
    exit;
}

function fill_category($connection)
{
    $output = '';
    $sql = "SELECT * FROM category ORDER BY id";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result))
    {
        $output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
    }
    return $output;
}