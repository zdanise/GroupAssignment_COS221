<?php
$json = file_get_contents('php://input');
$data = json_decode($json);


//$data = new stdClass();
/*
        $data->user_id = 9;    
        $data->quantity = 5;        
        $data->wine_id = 8;
        */


/*$data->user_id = 13;    
        $data->quantity = 2;        
        $data->wine_id = 8;
        */


require_once "database.php";

if ($data !== null) {

    //print_r($_POST);

    $user_id = $data->user_id;
    $wine_id = $data->wine_id;
    $quantity = $data->quantity;
    $received = 3;

    $sql = "SELECT * FROM customer WHERE user_id = '$user_id'";
    $result  = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        $order_placement_insert = false;
        $user_id = $data->user_id;
        $wine_id = $data->wine_id;
        $quantity = $data->quantity;

        $sql2 = "SELECT customer_id FROM customer WHERE user_id = '$user_id'";
        $result1  = mysqli_query($conn, $sql2);
        $rowCount1 = mysqli_num_rows($result1);

        if ($rowCount1 > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $customer_id = $row1['customer_id'];
            }
        }

        $order_placement_query = "INSERT INTO order_placement (customer_id, wine_id, quantity, received) VALUES ( ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $order_placement_query);


        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $customer_id, $wine_id, $quantity, $received);
            mysqli_stmt_execute($stmt);
            $order_placement_insert = true;
        }


        if ($order_placement_insert) {
            $myQuery = "SELECT * FROM order_placement WHERE customer_id = '$customer_id'";
            $result = $conn->query($myQuery);
            $orderedItems = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $orderedItems[] = $row;
                }
            }
        }

        //clear cart

        $checkQuery = "SELECT COUNT(*) as total FROM user_cart";
        $result = $conn->query($checkQuery);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            $sql = "DELETE FROM user_cart";
            $conn->query($sql);
        }



        header('Content-Type: application/json');
        echo json_encode($orderedItems);
    } else {
        require "cartUserDetails.php";
        $order_placement_insert = false;

        if (isset($_POST["submit"])) {
            $address = $_POST["address"];
            $phoneNumber = $_POST["phoneNumber"];
            $Age_ = $_POST["$Age_"];
            $Company_Name = $_POST["Company_Name"];

            $errors = array();

            if (empty($address) or empty($phoneNumber)) {
                array_push($errors, "Missing information");
            }

            /*
                if (empty($Age_) and empty($Company_Name)) {
                    array_push($errors, "Missing information age or company name");
                }
                */


            $sql7 = "SELECT * FROM corporate_customer WHERE $Company_Name = '$Company_Name'";
            $result7  = mysqli_query($conn, $sql7);
            $rowCount7 = mysqli_num_rows($result7);
            if ($rowCount7 > 0) {
                array_push($errors, "Company already exists");
            }


            $sql6 = "SELECT * FROM customer WHERE phone = '$phoneNumber'";
            $result6  = mysqli_query($conn, $sql6);
            $rowCount6 = mysqli_num_rows($result6);
            if ($rowCount6 > 0) {
                array_push($errors, "Number already exists");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div>$error</div>";
                }
            } else {

                if (!empty($Company_Name)) {

                    $sqlQuery = "INSERT INTO corporate_customer (company_name) VALUES ( ? )";

                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sqlQuery);


                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "s", $Company_Name);
                        mysqli_stmt_execute($stmt);
                    }


                    $sql2 = "SELECT customer_id FROM corporate_customer WHERE company_name = '$Company_Name'";
                    $result1  = mysqli_query($conn, $sql2);
                    $rowCount1 = mysqli_num_rows($result1);
                    if ($rowCount1 > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            $customer_id = $row['customer_id'];
                        }
                    }



                    $order_placement_query = "INSERT INTO order_placement (customer_id, wine_id, quantity) VALUES ( ?, ?, ?)";


                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $order_placement_query);


                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $customer_id, $wine_id, $quantity, $received);
                        mysqli_stmt_execute($stmt);
                        $order_placement_insert = true;
                    }
                } else {


                    $sqlQuery = "INSERT INTO customer (phone, address, user_id) VALUES ( ? , ? , ?)";

                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sqlQuery);


                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $phoneNumber, $address, $user_id);
                        mysqli_stmt_execute($stmt);
                        //inserting into customer successful
                    }

                    //debug insert into order_placement

                    $sql2 = "SELECT customer_id FROM customer WHERE user_id = '$user_id'";
                    $result1  = mysqli_query($conn, $sql2);
                    $rowCount1 = mysqli_num_rows($result1);
                    if ($rowCount1 > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            $customer_id = $row['customer_id'];
                        }
                    }



                    $order_placement_query = "INSERT INTO order_placement (customer_id, wine_id, quantity) VALUES ( ?, ?, ?)";


                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $order_placement_query);


                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $customer_id, $wine_id, $quantity, $received);
                        mysqli_stmt_execute($stmt);
                        $order_placement_insert = true;
                    }
                }
            }

            if ($order_placement_insert) {

                $myQuery = "SELECT * FROM order_placement WHERE customer_id = '$customer_id'";
                $result = $conn->query($myQuery);
                $orderedItems = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $orderedItems[] = $row;
                    }
                }

                header('Content-Type: application/json');
                echo json_encode($orderedItems);
            }
        }
        //clear cart

        $checkQuery = "SELECT COUNT(*) as total FROM user_cart";
        $result = $conn->query($checkQuery);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            $sql = "DELETE FROM user_cart";
            $conn->query($sql);
        }
    }
} else {
    echo "Cart is empty!";
}