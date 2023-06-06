<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = '127.0.0.1';
$username = 'root';
$password = 'Tails!=Heads';
$dbname = 'gws_group27vs4';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$sortby = isset($data['sortby']) ? $data['sortby'] : '';
$searchby = isset($data['searchby']) ? " AND wine_name LIKE '%" . $data['searchby'] . "%'" : '';
$filterby = isset($data['filterby']) ? " AND wine_type LIKE '%" . $data['filterby'] . "%'" : '';
$orderby = isset($data['orderby']) ? $data['orderby'] : '';

$sql = "SELECT w.*, 
       IFNULL(r.retailer_name, 'No retailer sells this wine') AS retailer,
       IFNULL(wn.winery_name, 'GWS') AS winery
FROM wine AS w
LEFT JOIN retailer_stock AS rs ON w.wine_id = rs.wine_id
LEFT JOIN retailer AS r ON rs.retailer_id = r.retailer_id
LEFT JOIN winery AS wn ON w.winery_id = wn.winery_id
WHERE 1=1 ".$searchby." ".$filterby."
ORDER BY ".$sortby." ".$orderby;

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $wines = [];
    while ($row = $result->fetch_assoc()) {
        $wines[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($wines);
} else {
    echo 'No wines found';
}

$conn->close();
?>
