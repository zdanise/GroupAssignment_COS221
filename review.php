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

    $sql2 = "SELECT rate, wine_id, comment,
    (SELECT wine_name FROM wine WHERE wine_id = $wine_id) AS wine_name,
    ROUND((SELECT AVG(rate) FROM review WHERE wine_id =$wine_id), 1) AS average_rate
FROM review
WHERE wine_id = $wine_id";

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

           $sql2 = "SELECT r.review_id, r.wine_id, r.comment, w.wine_name, ROUND(AVG(r.rate), 1) AS average_rate
           FROM review r
           JOIN wine w ON w.wine_id = r.wine_id
           WHERE r.customer_id = $customer_id
           GROUP BY r.review_id, r.wine_id, r.comment, w.wine_name";

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
else if(isset($json['AddReview']))
{
    $wine_id = $json['wine_id'];
    $user_id = $json['user_id'];
    //check if user is a customer
    $sqlCheck="SELECT customer_id FROM customer Where user_id=$user_id LIMIT 1";
    $result = $conn->query($sqlCheck);
   
        $rowCount = mysqli_num_rows($result);
        if ($rowCount=== 0) {
            $send = array(
                "type" => "Notcustomer",
                "message"=>"User has never purchased before therefore user cannot write a review."
                
            );
          
            header('Content-Type: application/json');
            echo json_encode( $send);
        }
        else{
            //extracting customer id
            $row = mysqli_fetch_assoc($result);
            $customer_id = $row['customer_id']; 
            $wine_id=$json['wine_id'];
            if(isset($json['comment']))
            {
                $comment = $json['comment'];
            }
            else
            {
                $comment ="no comment";
            }
            if(isset($json['rate']) && $json['rate']!=null )
            {
                $rate = $json['rate'];
            }
            else
            {
                $rate=0;
            }
            
              
            
    

            $sql1 = 'INSERT INTO review ( wine_id, rate, comment, customer_id)
            VALUES (?, ?, ?, ?)';

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql1)) {
        mysqli_stmt_bind_param($stmt, "iisi",  $wine_id, $rate, $comment, $customer_id);
        mysqli_stmt_execute($stmt);

    }
    $sql2 = "SELECT r.review_id, r.wine_id, r.comment, w.wine_name, ROUND(AVG(r.rate), 1) AS average_rate
    FROM review r
    JOIN wine w ON w.wine_id = r.wine_id
    GROUP BY r.review_id, r.wine_id, r.comment, w.wine_name";

    $result = $conn->query($sql2);
    $ReviewItems = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ReviewItems[] = $row;
        }
    }
    $send = array(
        "type" => "AfterAdding",
        "data" => $ReviewItems
    );

   
    header('Content-Type: application/json');
    echo json_encode( $send);


        }

}
else if (isset($json['view']))
{
    $sql2 = "SELECT r.review_id, r.wine_id, r.comment, w.wine_name, ROUND(AVG(r.rate), 1) AS average_rate
    FROM review r
    JOIN wine w ON w.wine_id = r.wine_id
   
    GROUP BY r.review_id, r.wine_id, r.comment, w.wine_name";

    $result = $conn->query($sql2);
    $ReviewItems = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ReviewItems[] = $row;
        }
    }
    $send = array(
        "type" => "Viewing",
        "data" => $ReviewItems
    );

   
    header('Content-Type: application/json');
    echo json_encode( $send);


        
}
if(isset($json['BasedOnwineADD'])) {
///////////////////////////////////////////////////////////////////
//checking if the user is allowed to make a review
    $wine_id = $json['wine_id'];
    $user_id = $json['user_id'];
    //check if user is a customer
    $sqlCheck="SELECT customer_id FROM customer Where user_id=$user_id LIMIT 1";
    $result = $conn->query($sqlCheck);
   
        $rowCount = mysqli_num_rows($result);
        if ($rowCount=== 0) {
            $send = array(
                "type" => "Notcustomer",
                "message"=>"User has never purchased before therefore user cannot write a review."
                
            );
          
            header('Content-Type: application/json');
            echo json_encode( $send);
        }
        else{
            //extracting customer id
            //add users review
            $row = mysqli_fetch_assoc($result);
            $customer_id = $row['customer_id']; 
         
            if(isset($json['comment']))
            {
                $comment = $json['comment'];
            }
            else
            {
                $comment ="no comment";
            }
            if(isset($json['rate']) && $json['rate']!=null )
            {
                $rate = $json['rate'];
            }
            else
            {
                $rate=0;
            }
          
            
               
            
    

            $sql1 = 'INSERT INTO review ( wine_id, rate, comment, customer_id)
            VALUES (?, ?, ?, ?)';

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql1)) {
        mysqli_stmt_bind_param($stmt, "iisi",  $wine_id, $rate, $comment, $customer_id);
        mysqli_stmt_execute($stmt);
    }
    ////////////////////////////////////////////////////
    //showing updated review based on wine id
    $sql2 = "SELECT rate, wine_id, comment,
    (SELECT wine_name FROM wine WHERE wine_id = $wine_id) AS wine_name,
    ROUND((SELECT AVG(rate) FROM review WHERE wine_id =$wine_id), 1) AS average_rate
FROM review
WHERE wine_id = $wine_id";

    $result = $conn->query($sql2);
    $rowCount = mysqli_num_rows($result);
    ////////no results
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
    { ///if there is results
        $ReviewItems = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ReviewItems[] = $row;
            }
        }
    
        $send = array(
            "type" => "BasedonWineAdded",
            "data" => $ReviewItems
        );
  
    
    header('Content-Type: application/json');
    echo json_encode( $send);

    }
}






















    ////////////////////////////////////////////////////////////////////////////////

   

}




