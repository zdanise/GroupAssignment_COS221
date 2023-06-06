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
 
    $location1 = $data['results'][0]['location'];
    $streetNumber = $location1['street']['number'];
    $streetName = $location1['street']['name'];
    $location2 =$streetNumber ." ". $streetName;
    
   


    $phone=$conn->real_escape_string($data['results'][0]['phone']);
    $location=$conn->real_escape_string($location2);
    $password=$conn->real_escape_string($data['results'][0]['login']['password']);
    $email=$conn->real_escape_string($data['results'][0]['email']);
    $Firstname=$conn->real_escape_string($data['results'][0]['name']['first']);
    $Lastname=$conn->real_escape_string($data['results'][0]['name']['last']);
   $username=$conn->real_escape_string($data['results'][0]['login']['username']);

    $values[] = "('$password', '$email', '$Firstname',' $Lastname', '$username')";
// }  
    $sql = "INSERT INTO user(  password, email, first_name, last_name, username) VALUES " . implode(", ", $values);
  
    

// // Execute the SQL insert statement
 if ($conn->query($sql) === TRUE) {
     echo "Data inserted successfully.";
 } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
 }

 // Close the database connection
 $conn->close();

?>