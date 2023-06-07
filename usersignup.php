    <?php
    //print_r($_POST);
    include_once("connect.php");
    if (isset($_POST["submit"])) {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["signUsername"];
        $email = $_POST["email"];
        $password = $_POST["signPassword"];
        $repeatPassword = $_POST["signRPassword"];

        //$password_hash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();

        if (empty($firstname) or empty($lastname) or empty($email) or empty($username) or empty($password) ) {
            echo"<script>alert('All fields are required')</script>";
            $response['status'] = 'error';
            $response['message'] = 'All fields are required';
            // array_push($errors, "Missing information");
        }
        else{

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo"<script>alert('Invalid email')</script>";
                $response['status'] = 'error';
                $response['message'] = 'Invalid email';
                
            }
            else{
    
                if (strlen($username) < 5) {
                    echo"<script>alert('Username must have more than 4 characters')</script>";
                    $response['status'] = 'error';
                    $response['message'] = "Username must have more than 4 characters";
                    // array_push($errors, "Username must have more than 4 characters");
                }
                else{

                    if (strlen($password) < 6) {
                        echo"<script>alert('Password must have more than 5 characters')</script>";
                        $response['status'] = 'error';
                        $response['message'] = "Password must have more than 5 characters";
                        
                        // array_push($errors, "Password must be 6-15 characters long");
                    }
                    else{
                        if ($password !== $repeatPassword) {
                            echo"<script>alert('Passwords must match')</script>";
                            $response['status'] = 'error';
                            $response['message'] = "Passwords must match";
                        }
                        else{
                            require_once "database.php";
                    
                            $sql = "SELECT * FROM user WHERE username = '$username'";
                            $result  = mysqli_query($conn, $sql);
                            $rowCount = mysqli_num_rows($result);
                            
                            if ($rowCount > 0) {
                                echo"<script>alert('Username already exists');</script>";
                                $response['status'] = 'error';
                                $response['message'] = "Username already exists";
                                
                                
                            }
                            else{
                                $sqlQuery = "INSERT INTO user (first_name,last_name, email, username, password) VALUES ( ? , ? , ? , ? , ? )";
                        
                                $stmt = mysqli_stmt_init($conn);
                                $prepareStmt = mysqli_stmt_prepare($stmt, $sqlQuery);
                                //echo "<script>alert('Signup Successful');</script>";
                                if ($prepareStmt) {
                                    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $username, $password);
                                    mysqli_stmt_execute($stmt);
                                    $_SESSION["userSignedUp"] = true;
                                    echo "<script>alert('Signup Successful');</script>";
                                    //header("Location:index.html");
                                } else {
                                    echo("<script>alert('Problem on our side');</script>");
                                }

                            }
                        }
                    }
                }
            }
        }


    }
    ?>
    
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
                        <a  href="destination.html" class="nav__link">Destinations</a>
                    </li>
                    <li class="nav__item">
                        <a  href="wines.html" class="nav__link">Wine store</a>
                    </li>
                    <li class="nav__item">
                        <a  href="wineryLogin.php" class="nav__link">Winery club</a>
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