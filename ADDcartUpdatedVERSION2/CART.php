<?php



// $json=json_decode(file_get_contents('php://input'), true);
// $receiveddata=json_decode($json);



// $servername="127.0.0.1";
// $uusername="root";
// $passsword ="";
// $dbname = "gws_group27vs3";
//  $conn = new mysqli($servername, $uusername, $passsword, $dbname);


// var_dump($_POST['view']);
// if (isset($_POST['view'])) {
    
//         $sql2 = "SELECT
//                     w.wine_name,
//                     w.wine_type,
//                     w.image,
//                     w.price,
//                     uc.quantity
//                 FROM
//                     wine AS w
//                 JOIN
//                     user_cart AS uc ON w.wine_id = uc.wine_id
//                 WHERE
//                     uc.user_id = '$user_id'";

//         $result = $conn->query($sql2);
//         $CARTitems = array();

//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $CARTitems[] = $row;
//             }
//         }

//         header('Content-Type: application/json');
//         echo json_encode($CARTitems);
    
// } else if (isset($_POST['add'])) {
//     $user_id = $_POST['user_id'];
//     $wine_id = $_POST['wine_id'];
//     $quantity = $_POST['quantity'];

//     $sql1 = 'INSERT INTO user_cart (user_id, wine_id, quantity)
//             VALUES (?, ?, ?)
//             ON DUPLICATE KEY UPDATE quantity = VALUES(quantity)';

//     $stmt = mysqli_stmt_init($conn);

//     if (mysqli_stmt_prepare($stmt, $sql1)) {
//         mysqli_stmt_bind_param($stmt, "iii", $user_id, $wine_id, $quantity);
//         mysqli_stmt_execute($stmt);
//     }

//     $sql2 = "SELECT
//                 w.wine_name,
//                 w.wine_type,
//                 w.image,
//                 w.price,
//                 uc.quantity
//             FROM
//                 wine AS w
//             JOIN
//                 user_cart AS uc ON w.wine_id = uc.wine_id
//             WHERE
//                 uc.user_id = '$user_id'";

//     $result = $conn->query($sql2);
//     $CARTitems = array();

//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             $CARTitems[] = $row;
//         }
//     }

//     header('Content-Type: application/json');
//     echo json_encode($CARTitems);
// } else if (isset($_POST['cancel'])) {
//     $user_id = $_POST['user_id'];
//     $sql = "DELETE FROM user_cart WHERE user_id = ?";
//     $stmt = mysqli_stmt_init($conn);

//     if (mysqli_stmt_prepare($stmt, $sql)) {
//         mysqli_stmt_bind_param($stmt, "s", $user_id);
//         mysqli_stmt_execute($stmt);
//     }
// }
$json = json_decode(file_get_contents('php://input'), true);
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gws_group27vs3";
$conn = new mysqli($servername, $username, $password, $dbname);
var_dump($json["view"]);
if (isset($json["view"])) {
    echo "hiii";
    $user_id = $json['user_id'];

    $sql2 = "SELECT
                w.wine_name,
                w.wine_type,
                w.image,
                w.price,
                uc.quantity
            FROM
                wine AS w
            JOIN
                user_cart AS uc ON w.wine_id = uc.wine_id
            WHERE
                uc.user_id = '$user_id'";

    $result = $conn->query($sql2);
    $CARTitems = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $CARTitems[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($CARTitems);
} else if (isset($json['add'])) {
    $user_id = $json['user_id'];
    $wine_id = $json['wine_id'];
    $quantity = $json['quantity'];

    $sql1 = 'INSERT INTO user_cart (user_id, wine_id, quantity)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE quantity = VALUES(quantity)';

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql1)) {
        mysqli_stmt_bind_param($stmt, "iii", $user_id, $wine_id, $quantity);
        mysqli_stmt_execute($stmt);
    }

    $sql2 = "SELECT
                w.wine_name,
                w.wine_type,
                w.image,
                w.price,
                uc.quantity
            FROM
                wine AS w
            JOIN
                user_cart AS uc ON w.wine_id = uc.wine_id
            WHERE
                uc.user_id = '$user_id'";

    $result = $conn->query($sql2);
    $CARTitems = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $CARTitems[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($CARTitems);
} else if (isset($json['cancel'])) {
    $user_id = $json['user_id'];
    $sql = "DELETE FROM user_cart WHERE user_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
    }
}

$conn->close();