<?php
    include_once("connect.php");
    // include "header.php";

    
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $response = array();
        $query_check = "select password from user where username = '$username' OR email = '$username' limit 1";
        if(!empty($username) && !empty($password))
        {
            $result = mysqli_query($con, $query_check);
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {       
                    $data =mysqli_fetch_assoc($result);
                    if($data['password'] == $password)
                    {       
                        $_SESSION['username']= $username;
                        $_SESSION['userLoggedIn']= true;
                        $response['status'] = 'success';
                        $response['message'] = 'Login successful';
                        $response['data']=$data;
                        // echo json_encode($response,JSON_PRETTY_PRINT);
                        header("Location:index.html");
                        //echo"<script>alert('Login Successful')</script>";
                    }
                    else{
                        echo"<script>alert('Incorrect username or password')</script>";                    
                        $response['status'] = 'error';
                        $response['message'] = 'Invalid username or password';
                    }
                }
                else{
                    echo"<script>alert('Incorrect username or password')</script>";
                    $response['status'] = 'error';
                    $response['message'] = 'Invalid username or password';
                }
            }
            else{
                echo"<script>alert('Problem on our side')</script>";
                $response['status'] = 'error';
                $response['message'] = 'Incorrect username or password';
                // echo json_encode($response,JSON_PRETTY_PRINT);
            }

        }
        else{
            echo"<script>alert('All fields are required')</script>";
            $response['status'] = 'error';
            $response['message'] = 'Invalid username or password';
            // echo json_encode($response,JSON_PRETTY_PRINT);
        }
    }
?>
 <!-- <div>
     <form method = "post">
        <h3>Login</h3>
         <br>
         <input type="text" name="username" placeholder="Enter username or email address"><br><br>
         <input type="password" name="password" placeholder="Enter password"><br><br>
         <input type="submit" value="login"><br><br>
         <a href="signup.php">Click here to create an account</a><br>
     </form>
</div> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/login.css">

     <!-- for alert -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous" ></script>
    <title>GWS User Login/Signup</title>
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
                        <a  href="wineries_signup.php" class="nav__link">Winery club</a>
                    </li>
                    <li class="nav__item">
                        <a  href="#" class="nav__link active-link">Login/Signup</a>
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

    <div class="container" id="container">

        <div class="form-container sign-up-container">
            <form id="signupForm" action="usersignup.php" method="post" onsubmit="return validateUserSignUp()">
                <h2>Create Account</h2>
                <span></span>
                <input autocomplete="off" name="firstname" id="iSignName" type="text" placeholder="Name"/>
                <input autocomplete="off" name="lastname" id="iSignSurname" type="text" placeholder="Surname" />
                <input autocomplete="off" name="signUsername" id="iSignUsername" type="text" placeholder="Username"/>
                <input autocomplete="off" name="email" id="iSignEmail" type="email" placeholder="Email" />
                <input autocomplete="off" name="signPassword" id="iSignPassword" type="password" placeholder="Password"/>
                <input autocomplete="off" name="signRPassword" id="iSignRPassword" type="password" placeholder="Repeat Password"/>
                <button name="submit" id="btnSignUp">Sign Up</button>
            </form>
        </div>
        <div class="form-container log-in-container">
            <form id="loginForm" action="userlogin.php" method="post" onsubmit="return validateUserLogin()">
                <h1>Log in</h1>
                
                <span></span>
                <input autocomplete="off" name="username" id="iLoginUsername" type="text" placeholder="Username"/>
                <input autocomplete="off" name="password" id="iLoginPassword" type="password" placeholder="Password"/>
                <button  type="submit" id="btnLogin">Log In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">

                    <div class='overlay-panel overlay-left'>
                        <h1>Welcome Back!</h1>
                        <p>Already have an account? Log In</p>
                        <button class='ghost' id='logIn'>Log In</button>
                    </div>
                    <div class='overlay-panel overlay-right'>
                        <h1>Hello, There!</h1>
                        <p>Don't have an account? Sign Up Free</p>
                        <button class='ghost' id='signUp'>Sign Up</button>
                    </div>
            </div>
        </div>
    </div>

    <script src="assets/js/userLogin.js"></script>
</body>
</html>
<?php

    // include "footer.php"; 
?>
 