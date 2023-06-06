<?php
$servername="127.0.0.1";
$uusername="root";
$passsword ="";
$dbname = "gws_group27vs";
 $conn = new mysqli($servername, $uusername, $passsword, $dbname);

// Make a request to the API endpoint
$url ="https://randomuser.me/api";
$response = file_get_contents($url);
$data = json_decode($response, true);

// Parse the JSON response and format the data as an SQL insert statement
// $json=json_decode($data);
 $values =array();
// foreach ($json as $row) {
 
    
    
   


    $password=$conn->real_escape_string($data['results'][0]['login']['password']);
    
    $values[] = "( '$password')";
// }  
    $sql = "INSERT INTO winery (password) VALUES " . implode(", ", $values) .WHERE winery_name=;
  
    

// // Execute the SQL insert statement
 if ($conn->query($sql) === TRUE) {
     echo "Data inserted successfully.";
 } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
 }

 // Close the database connection
 $conn->close();

?>