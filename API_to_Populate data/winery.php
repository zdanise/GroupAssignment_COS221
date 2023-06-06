<?php
// Create a new database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gws_group27vs";
$conn = new mysqli($servername, $username, $password, $dbname);

// Make a request to the API endpoint
$url = "https://api.sampleapis.com/wines/reds";
$data = file_get_contents($url);

// Parse the JSON response and format the data as an SQL insert statement
$json = json_decode($data);
$values = array();
foreach ($json as $row) {
    
   
    $WineName = $conn->real_escape_string($row->winery);
    $location=$conn->real_escape_string($row->location);

   
    
   
  
    $values[] = "( '$WineName', '$location')";
}
$sql = "INSERT INTO winery (  winery_name, location) VALUES " . implode(", ", $values);

// Execute the SQL insert statement
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>