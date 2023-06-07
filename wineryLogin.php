<?php
    include_once("connect.php");
    // include "header.php";

    //print_r($_POST);
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $winery_name = $_POST['wineryname'];
        $password = $_POST['logPassword'];
        $response = array();
        $query_check = "select * from winery where winery_name = '$winery_name' limit 1";
        if(!empty($winery_name) && !empty($password))
        {
            $result = mysqli_query($con, $query_check);
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $data =mysqli_fetch_assoc($result);
                    if($data['password']==$password)
                    {
                        $wineryid=$data['winery_id'];
                        $query_check = "select wine_name, wine_age, bottle_size, price from wine where winery_id='$wineryid'";
                        $result = mysqli_query($con, $query_check);
                        $_SESSION['winery_name']= $data['winery_name'];
                        $_SESSION['winery_id'] = $wineryid;

                        // $response['status'] = 'success';
                        // $response['message'] = 'Login successful';
                        // $response['winery_id']=$data['winery_id'];
                        // $response['winery_name']=$data['winery_name'];
                        $data = mysqli_fetch_assoc($result);
                        $response['wines']= $data;
                        print_r($response['wines']);

                        //Catalogue HTML
                        echo'<!DOCTYPE html>
                        <html>
                        <head>
                          <title>Winery Catalog</title>
                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                          <link rel="stylesheet" href="style.css">
                        </head>
                        <body>
                            <div class="hero">
                                <video autoplay loop muted plays-inline class="back-video" >
                                    <source src="images/winevideo.mp4" type="video/mp4">
                                </video>
                        
                        
                                <nav>
                                   <img src="images/download.jpeg" class="logo">
                                    <ul>
                                        <li><a href="#">HOME</a></li> <!--to be confirmed-->
                                        <li><a href="#">CONTACT US</a></li> <!--to be confirmed-->
                                        <li><a href="#">LOG OUT</a></li><!--to be confirmed-->
                        
                                    </ul>
                        
                                </nav>
                                <div class="content">
                                    <br/>
                                    <br/>
                                    <br/>
                          <h1>Wine Catalog</h1>
                          <div id="wineList"></div>
                        
                          <h2>Add Wine</h2>
                          <form id="addForm">
                            <label for="wineName">Name:</label>
                            <br/>
                            <input type="text" id="wineName" name="wineName" required><br>
                        
                            <label for="wineAge">Age:</label>
                            <br/>
                            <input type="number" id="wineAge" name="wineAge" required><br>
                        
                            <label for="bottleSize">Bottle Size:</label>
                            <br/>
                            <input type="text" id="bottleSize" name="bottleSize" required><br>
                        
                            <label for="wineType">Type:</label>
                            <br/>
                            <input type="text" id="wineType" name="wineType" required><br>
                        
                            <label for="wineryId">Winery ID:</label>
                            <br/>
                            <input type="text" id="wineryId" name="wineryId" required><br>
                        
                            <label for="image">Image Link:</label>
                            <br/>
                            <input type="text" id="image" name="image" required><br>
                        
                            <label for="price">Price:</label>
                            <br/>
                            <input type="number" id="price" name="price"required><br>
                            <br/>
                            <button type="submit">Add</button>
                          </form>
                        </div>
                          <script src="script.js"></script>
                        </div>
                        </body>
                        </html>';
                        //Start of catalogue api
                        if($_SESSION['winery_id']){
                        if($_SERVER['REQUEST_METHOD']=="POST"){
                            $wine_name = $response['wines']['wineName'];
                            $wine_age = $response['wines']['wineAge'];
                            $bottle_size = $response['wines']['bottleSize'];
                            $wine_type = $response['wines']['wineType'];
                            $winery_id = $response['wines']['wineryId'];
                            $image = $response['wines']['image'];
                            $prices = $response['wines']['price'];
                    
                            if(!empty($wine_name) && !empty($winery_id) && !empty($wine_age) && !empty($bottle_size) && !empty($wine_type) && !empty($image) && !empty($prices))
                            {
                                $query_check = "select * from wines where wine_name='$wine_name'";
                                $result = mysqli_query($con, $query_check);
                                $row = mysqli_num_rows($result);
                                if($row<=0){
                                    $query_insert = "INSERT INTO wines (wine_name, wine_age, bottle_size, wine_type, winery_id, image, price) VALUE ('$wine_name','$wine_age','$bottle_size','$wine_type','$winery_id', '$image', '$prices')";
                                    $result = mysqli_query($con, $query_check);
                                    if($result){
                                        $add_response = array(
                                            'status' => 'success',
                                            'message' => 'Wine added successfully'
                                        );
                                        echo json_encode($add_response);
                                    die;
                                    }else{
                                        $add_response = array(
                                            'status' => 'error',
                                            'message' => 'Failed to add wine'
                                        );
                                        echo json_encode($add_response);
                                    }
                                }else
                                {
                                    $add_response = array(
                                        'status' => 'error',
                                        'message' => 'Wine already exists'
                                    );
                                    echo json_encode($add_response);
                                }
                    
                            }
                            $add_response = array(
                                'status' => 'error',
                                'message' => 'Unable to add wine to catalogue please ensure all fields are filled in correctly'
                            );
                            echo json_encode($add_response);
                        }
                    
                        if($_SERVER['REQUEST_METHOD']==="DELETE")//thi might cause issues
                        {
                            $urlExtract = explode('/', $_SERVER['REQUEST_URI']);
                            $wineId = $urlExtract[count($urlParts) - 1];
                            $query_delete = "DELETE FROM wines WHERE wine_id = ?";
                            $stmt = $con->prepare($query_delete);
                            $stmt->bind_param("i", $wineId);
                            if ($stmt->execute()) {
                                $del_response = array(
                                    'status' => 'success',
                                    'message' => 'Wine deleted successfully'
                                );
                                echo json_encode($del_response);
                            } else {
                                $del_response = array(
                                    'status' => 'error',
                                    'message' => 'Failed to delete wine'
                                );
                                echo json_encode($del_response);
                            }
                            $stmt->close();
                        }
                    
                        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {//this code segment could also cause errors
                            $urlExtract = explode('/', $_SERVER['REQUEST_URI']);
                            $wineId = $urlExtract[count($urlExtract) - 1];
                            $update = json_decode(file_get_contents('php://input'), true);
                            $wine_name = $update['wine_name'];
                            $wine_age = $update['wine_age'];
                            $bottle_size = $update['bottle_size'];
                            $wine_type = $update['wine_type'];
                            $winery_id = $update['winery_id'];
                            $image = $update['image'];
                            $price = $update['price'];
                        
                            $query = "UPDATE wines SET wine_name = ?, wine_age = ?, bottle_size = ?, wine_type = ?, winery_id = ?, image = ?, price = ? WHERE wine_id = ?";
                            $stmt = $con->prepare($query);
                            $stmt->bind_param("ssssissi", $wine_name, $wineAge, $bottle_size, $wine_type, $wineryId, $image, $price, $wineId);
                            
                            if ($stmt->execute()) {
                                $put_response = array(
                                    'status' => 'success',
                                    'message' => 'Wine updated successfully'
                                );
                                echo json_encode($put_response);
                            } else {
                                $put_response = array(
                                    'status' => 'error',
                                    'message' => 'Failed to update wine'
                                );
                                echo json_encode($put_response);
                            }
                        
                            $stmt->close();
                        }//End of catalogue api
                    }
                        die;
                    }
                }
            }
            $response['status'] = 'error';
            $response['message'] = 'Winery name or password is incorrect';
            echo"<script>alert('Winery name or password is incorrect')</script>";
        }
        else{
            $response['status'] = 'error';
            $response['message'] = 'All fields are required';
            echo"<script>alert('All fields are required')</script>";
        }
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/winery.css">
    <title> Winery Login</title>
</head>
<body>
    <header class="header" id="header">
        <nav class="nav containerH">
            
            <img src="assets/img/logo.png" alt="" class="logo" id="logo" width="100">
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a  href="index.html" class="nav__link ">Home</a>
                    </li>
                    
                    <li class="nav__item">
                        <a  href="userlogin.php" class="nav__link">Login/Signup</a>
                    </li>
                    
                </ul>

                <i class="ri-close-line nav__close" id="nav-close"></i>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-function-line"></i>
            </div>
        </nav>
    </header>

    <div id="alert" class="alert hide">
        <span class="fas fa-exclamation-circle"></span>
        <span id="msg" class="msg">warning: this is an error warning</span>
        <span id="close-btn" class="close-btn">
            <span class="fas fa-times"></span>
        </span>
    </div>

    <div class="container right-panel-active" id="container">
        <div class="form-container sign-up-container">
            <form action="wineries_signup.php" method="post" onsubmit="return validateWinerySignUp()">
                <h1>Create Account</h1>

                <span></span>
                <input autocomplete="off" name="winery_name" id="iSignName"type="text" placeholder="Winery Name" />
                <input autocomplete="off" name="wineryType" id="iSignType"type="text" placeholder="Winery Type" />
                <input autocomplete="off" name="location" id="iSignLocation"type="text" pattern="[A-Z][a-z]+([\s]{0,1}[A-Z][a-z]+)*, [A-Z][a-z]+([\s]{0,1}[A-Z][a-z]+)*" placeholder="Country, Region" />
                <input autocomplete="off" name="email" id="iSignEmail"type="text" placeholder="Email" />
                <input autocomplete="off" name="signPassword" id="iSignPassword" type="password" placeholder="Password" />
                <input autocomplete="off" name="repeatPassword" id="iRepeatPassword"type="password" placeholder="Repeat Password" />
                <button name="submit" id="btnSignUp">Sign Up</button>
            </form>
        </div>
        <div class="form-container log-in-container">
            <form action="wineryLogin.php" method="post" onsubmit="return validateWineryLogin()">
                <h1>Log in</h1>
                
                <span></span>
                <input autocomplete="off" name="wineryname" id="iLoginName" type="text" placeholder="Winery Name" />
                <input autocomplete="off" name="logPassword" id="iLoginPass" type="password" placeholder="Password" />
                <!-- <a href="#">Forgot your password?</a> -->
                <button id="btnLogin">Log In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Already have an account? Log In</p>
                    <button class="ghost" id="logIn">Log In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, There!</h1>
                    <p>Don't have an account? Sign Up Free</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/wineryLogin.js"></script>
</body>
</html>

    <!-- include "footer.php"; -->
