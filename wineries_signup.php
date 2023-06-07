<?php
// include "connect.php";
// include "header.php";
    //print_r($_POST);
    include_once("connect.php");
    if (isset($_POST["submit"])) 
    {
        $winery_name = $_POST["winery_name"];
        $location = $_POST["location"];
        $email = $_POST["email"];
        $password = $_POST["signPassword"];
        $repeatPassword = $_POST["repeatPassword"];

        if(empty($winery_name) or empty($location) or empty($email) or empty($password) or empty($repeatPassword)) 
        {
            echo"<script>alert('Missing information')</script>";
            $response['status'] = 'error';
            $response['message'] = 'Missing information';   
        }
        else{
        
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                echo"<script>alert('Invalid email')</script>";
                $response['status'] = 'error';
                $response['message'] = 'Invalid email';   
            }
            else{
                if (strlen($password) < 6) {
                    echo"<script>alert('Password must be more than 5 characters long')</script>";
                    $response['status'] = 'error';
                    $response['message'] = 'Password must be more than 5 characters long';   
                }
                else{
                    if ($password !== $repeatPassword) 
                    {
                        echo"<script>alert('Passwords do not match')</script>";
                        $response['status'] = 'error';
                        $response['message'] = 'Passwords do not match';   
                    }
                    else{
                        require_once "database.php";

                        $sql = "SELECT * FROM winery WHERE winery_name = '$winery_name'";
                        $result  = mysqli_query($conn, $sql);
                        $rowCount = mysqli_num_rows($result);

                        if ($rowCount > 0) 
                        {
                            echo"<script>alert('Winery account already exists')</script>";
                            $response['status'] = 'error';
                            $response['message'] = 'Winery already registered';
                        }
                        else{
                            $_SESSION["winerySignedUp"] = true;
                        }
                    }
                }
            }
        }
        // 
        //check with the database guys to ask about the user/customer table
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
    <title>GWS Winery Login/SignUp</title>
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
                        <a  href="destination.html" class="nav__link">Destinations</a>
                    </li>
                    <li class="nav__item">
                        <a  href="wines.html" class="nav__link">Wine store</a>
                    </li>
                    <li class="nav__item">
                        <a  href="#" class="nav__link active-link">Winery club</a>
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

    <?php
        if(!isset($_SESSION["winerySignedUp"]) || $_SESSION["winerySignedUp"] == false){

            echo"<div class='container right-panel-active' id='container'>";
        }
        else{
            echo"<div class='container left-panel-active' id='container'>";
        }
    ?>
        <div class="form-container sign-up-container">
            <form action="wineries_signup.php" method="post" onsubmit="return validateWinerySignUp()">
                <h1>Create Account</h1>

                <span></span>
                <input autocomplete="off" name="winery_name" id="iSignName"type="text" placeholder="Winery Name" />
                <input autocomplete="off" name="" id="iSignType"type="text" placeholder="Winery Type" />
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
            <?php
                if(!isset($_SESSION["winerySignedUp"]) || $_SESSION["winerySignedUp"] == false){

                    echo"<div class='overlay-panel overlay-left'>
                        <h1>Welcome Back!</h1>
                        <p>Already have an account? Log In</p>
                        <button class='ghost' id='logIn'>Log In</button>
                    </div>
                    <div class='overlay-panel overlay-right'>
                        <h1>Hello, There!</h1>
                        <p>Don't have an account? Sign Up Free</p>
                        <button class='ghost' id='signUp'>Sign Up</button>
                    </div>";
                }
                else{
                     echo"<div class='overlay-panel overlay-left'>
                        <h1>Welcome Back!</h1>
                        <p>Already have an account? Log In</p>
                        <button class='ghost' id='logIn'>Log In</button>
                    </div>
                    <div class='overlay-panel overlay-right'>
                        <button disabled style='background-Color: #32dbaeab;' class='ghost' id='signUp'>Signup will be processed within 2-3 days!!</button>
                    </div>";
                }
            ?>
            </div>
        </div>
    </div>

    <script src="assets/js/wineryLogin.js"></script>
</body>
</html>
<!-- include "footer.php"; -->