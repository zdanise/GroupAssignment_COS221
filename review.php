<?php



// }
$json = json_decode(file_get_contents('php://input'), true);
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gws_group27vs4"; //please make sure the database name is the same
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($json['BasedOnwine'])) {

    $wine_id = $json['wine_id'];

    $sql2 = "SELECT rate, wine_id, COMMENT, (SELECT wine_name FROM wine WHERE wine_id=$wine_id) AS wine_name FROM review WHERE wine_id=$wine_id";

    $result = $conn->query($sql2);
    $rowCount = mysqli_num_rows($result);
    if($rowCount===0)
    {
        $send = array(
            "type" => "NoReviews",
            "message"=>"No reviews on this wine has been made."
            
        );
      
        header('Content-Type: application/json');
        echo json_encode( $send); 
    }
    else
    {
        $ReviewItems = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ReviewItems[] = $row;
            }
        }
    
        $send = array(
            "type" => "BasedonWine",
            "data" => $ReviewItems
        );
  
    
    header('Content-Type: application/json');
    echo json_encode( $send);
    }

}
else if(isset($json['BasedOnUser']))
{
    //check to see if the user is a customer first
    $user_id= $json['user_id'];
    
    $sqlCheck="SELECT customer_id FROM customer WHERE user_id=$user_id LIMIT 1";
    $result = $conn->query($sqlCheck);
   
        $rowCount = mysqli_num_rows($result);
        if ($rowCount=== 0) {
            $send = array(
                "type" => "Notcustomer",
                "message"=>"User has never purchased before therefore user has not written a review."
                
            );
          
            header('Content-Type: application/json');
            echo json_encode( $send);
        }
        else
        {  
            //we extract the customer id from the result
            $row = mysqli_fetch_assoc($result);
            $customer_id = $row['customer_id'];
          

            $user_id= $json['user_id'];

           $sql2 = "SELECT rate, wine_id, COMMENT, (SELECT wine_name FROM wine WHERE wine_id=$wine_id) AS wine_name FROM review WHERE wine_id=$wine_id";

                $result = $conn->query($sql2);
                $ReviewItems = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $ReviewItems[] = $row;
                    }
                }
                $send = array(
                    "type" => "BasedonUser",
                    "data" => $ReviewItems
                );

               
                header('Content-Type: application/json');
                echo json_encode( $send);
        }




      
}




