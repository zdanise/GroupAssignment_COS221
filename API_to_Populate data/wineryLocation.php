<?php
// Create a new database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gws_group27";
$conn = new mysqli($servername, $username, $password, $dbname);

// Make a request to the API endpoint
$url = "https://api.sampleapis.com/wines/reds";
$data = file_get_contents($url);

// Parse the JSON response and format the data as an SQL insert statement
$json = json_decode($data);
$values = array();
foreach ($json as $row) {
    $WineID = $conn->real_escape_string($row->id);
   
    $WineName = $conn->real_escape_string($row->wine);
    $location = $conn->real_escape_string($row->location);
    
   
  
    $values[] = "('$WineID', '$location')";
}
$sql = "INSERT INTO winery_location ( winery_id,winery_location) VALUES " . implode(", ", $values);

// Execute the SQL insert statement
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>