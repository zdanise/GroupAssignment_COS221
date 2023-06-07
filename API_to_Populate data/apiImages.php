<?php
// Create a new database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gws_group27vs";
$conn = new mysqli($servername, $username, $password, $dbname);

// Make a request to the API endpoint
$url = "https://api.sampleapis.com/wines/rose";
$data = file_get_contents($url);

// Parse the JSON response and format the data as an SQL insert statement
$json = json_decode($data);
$values = array();
foreach ($json as $row) {
    $WineID = $conn->real_escape_string($row->id);
   
    $WineName = $conn->real_escape_string($row->wine);
    $image = $conn->real_escape_string($row->image);
    
   
  
    $values[] = "( '$WineName', 'Rose', '$image')";
}
$sql = "INSERT INTO wine (  wine_name, wine_type, image) VALUES " . implode(", ", $values);

// Execute the SQL insert statement
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>