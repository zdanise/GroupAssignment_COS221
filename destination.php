<?php
$ddata = file_get_contents('php://input');
$data = json_decode($ddata);
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gws_group27vs";   //check to see you using the right database name
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($data->tables))
{
    
      if($data->tables==="Farm")
      {
        $sql = "SELECT winery_name,winery_image, location,
        (SELECT NULLIF(family_name, '') FROM farm_winery WHERE farm_winery.winery_id = winery.winery_id) AS Family_name , (SELECT NULLIF(restaurant_name, '') FROM farm_winery_restaurants WHERE farm_winery_restaurants.winery_id = winery.winery_id) AS Restaurant
    FROM winery
    HAVING Family_name IS NOT NULL
    ORDER BY RAND()";     //add winery_image column
        $result = $conn->query($sql);
        $wines = [];
        while ($row = $result->fetch_assoc()) {
          
            $wines[] = [
                
                'image_url' => $row['winery_image'],
                'location'=>$row['location'],
                'winery_name'=>$row['winery_name'],
                'Family_name'=>$row['Family_name'],
                'Restaurant'=>$row['Restaurant']
               
           
            ];

        }
        $send = array(
            "type" => "farm",
            "data" => $wines
        );
      
      
        header('Content-Type: application/json');
        echo json_encode( $send);


      }
      else if($data->tables==="destination")
      {
        $sql = 'SELECT winery_name,winery_image, location,
        (SELECT BnB_Name FROM destination_winery WHERE destination_winery.winery_id = winery.winery_id AND BnB_Name IS NOT NULL) AS BnB
    FROM winery
    WHERE (SELECT BnB_Name FROM destination_winery WHERE destination_winery.winery_id = winery.winery_id AND BnB_Name IS NOT NULL) IS NOT NULL
    ORDER BY RAND()';     //add winery_image column
        $result = $conn->query($sql);
        $wines = [];
        while ($row = $result->fetch_assoc()) {
          
            $wines[] = [
                
               
                'image_url' => $row['winery_image'],
                'location'=>$row['location'],
                'winery_name'=>$row['winery_name'],
                'BnB_Name'=>$row['BnB']
           
            ];
        }
      
       
        $send = array(
            "type" => "destination",
            "data" => $wines
        );
      
        header('Content-Type: application/json');
        echo json_encode( $send);


      }
      else
      {
        $sql = 'SELECT winery_name,winery_image, location,
        (SELECT Reservations FROM vineyard_winery WHERE vineyard_winery.winery_id = winery.winery_id) AS Reservations,
        (SELECT tutorials FROM vineyard_winery WHERE vineyard_winery.winery_id = winery.winery_id) AS tutorials
    FROM winery
    WHERE 
        (SELECT Reservations FROM vineyard_winery WHERE vineyard_winery.winery_id = winery.winery_id) IS NOT NULL
        AND (SELECT tutorials FROM vineyard_winery WHERE vineyard_winery.winery_id = winery.winery_id) IS NOT NULL
    ORDER BY RAND()';     //add winery_image column
        $result = $conn->query($sql);
        $wines = [];
        while ($row = $result->fetch_assoc()) {
          
            $wines[] = [
                
                'image_url' => $row['winery_image'],
                'location'=>$row['location'],
                'winery_name'=>$row['winery_name'],
                'Reservations'=>$row['Reservations'],
           
                'tutorials'=>$row['tutorials']
           
           
            ];
        }

        $send = array(
            "type" => "vineyard",
            "data" => $wines
        );
      
      
      
        header('Content-Type: application/json');
        echo json_encode( $send);



      }
}
else{
    $sql = 'SELECT winery_name,winery_image location FROM winery ORDER BY RAND()   LIMIT 10';     //add winery_image column
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $wines = [];
    while ($row = $result->fetch_assoc()) {
      
        $wines[] = [
            'image_url' => $row['winery_image'],
            'winery_name' => $row['winery_name'],
            'location'=>$row['location']
        ];
       
      
    }
    $send = array(
        "type" => "Everything",
        "data" => $wines
    );
  
    header('Content-Type: application/json');
    echo json_encode($send);
} else {
    echo 'No wines found';
}

}



