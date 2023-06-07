<?php
$dbhost = "wheatley.cs.up.ac.za";
$dbuser = "u22768352";
$dbpass = "P2EN4I3XZRQ3OTHFUWCTDOVJC3JPDIJC";
$dbname = "u22768352_221";

try 
{
    $con = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
}
catch(Exception $th){  
    die("Could not connect!");
}
 

// Handle different types of HTTP requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    fetchWineList();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addWine();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    updateWine();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    deleteWine();
}

// Fetch the wine list from the database and send as a JSON response
function fetchWineList() {
    global $con;

    $query_get = "SELECT * FROM wine";
    $result = mysqli_query($con, $query_get);

    if ($result) {
        $wineData = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $wineData[] = $row;
        }

        $get_response = array(
            'status' => 'success',
            'data' => $wineData
        );
        echo json_encode($get_response);
    } else {
        $get_response = array(
            'status' => 'error',
            'message' => 'Failed to fetch wine list'
        );
        echo json_encode($get_response);
    }
    //die;
}

// Add a new wine to the database
function addWine() {
    global $con;

    $wine = json_decode(file_get_contents('php://input'), true);
var_dump($wine);
    $wine_name = mysqli_real_escape_string($con, $wine['wine_name']);
    $wine_age = mysqli_real_escape_string($con, $wine['wine_age']);
    $bottle_size = mysqli_real_escape_string($con, $wine['bottle_size']);
    $wine_type = mysqli_real_escape_string($con, $wine['wine_type']);
    $winery_id = mysqli_real_escape_string($con, $wine['winery_id']);
    $image = mysqli_real_escape_string($con, $wine['image']);
    $price = mysqli_real_escape_string($con, $wine['price']);

    $query_add = "INSERT INTO wine (wine_name, wine_age, bottle_size, wine_type, winery_id, image, price) VALUES ('$wine_name', '$wine_age', '$bottle_size', '$wine_type', '$winery_id', '$image', '$price')";

    $result = mysqli_query($con, $query_add);

    if ($result) {
        $add_response = array(
            'status' => 'success',
            'message' => 'Wine added successfully'
        );
        echo json_encode($add_response);
    } else {
        $add_response = array(
            'status' => 'error',
            'message' => 'Failed to add wine'
        );
        echo json_encode($add_response);
    }
    die;
}

// Update an existing wine in the database
function updateWine() {
    global $con;

    $wineId = mysqli_real_escape_string($con, $_GET['id']);
    $updatedWine = json_decode(file_get_contents('php://input'), true);

    // Extract the updated values
    $wine_name = mysqli_real_escape_string($con, $updatedWine['wine_name']);
    $wine_age = mysqli_real_escape_string($con, $updatedWine['wine_age']);
    $bottle_size = mysqli_real_escape_string($con, $updatedWine['bottle_size']);
    $wine_type = mysqli_real_escape_string($con, $updatedWine['wine_type']);
    $winery_id = mysqli_real_escape_string($con, $updatedWine['winery_id']);
    $image = mysqli_real_escape_string($con, $updatedWine['image']);
    $price = mysqli_real_escape_string($con, $updatedWine['price']);

    $query_update = "UPDATE wine SET wine_name='$wine_name', wine_age='$wine_age', bottle_size='$bottle_size', wine_type='$wine_type', winery_id='$winery_id', image='$image', price='$price' WHERE wine_id='$wineId'";

    $result = mysqli_query($con, $query_update);

    if ($result) {
        $update_response = array(
            'status' => 'success',
            'message' => 'Wine updated successfully'
        );
        echo json_encode($update_response);
    } else {
        $update_response = array(
            'status' => 'error',
            'message' => 'Failed to update wine'
        );
        echo json_encode($update_response);
    }
    die;
}

// Delete a wine from the database
function deleteWine() {
    global $con;

    $wineId = mysqli_real_escape_string($con, $_GET['id']);

    $query_delete = "DELETE FROM wine WHERE wine_id='$wineId'";

    $result = mysqli_query($con, $query_delete);

    if ($result) {
        $delete_response = array(
            'status' => 'success',
            'message' => 'Wine deleted successfully'
        );
        echo json_encode($delete_response);
    } else {
        $delete_response = array(
            'status' => 'error',
            'message' => 'Failed to delete wine'
        );
        echo json_encode($delete_response);
    }
    die;
}

mysqli_close($con);
?>
