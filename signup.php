<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
</head>

<body>
    <?php
    print_r($_POST);

    if (isset($_POST["submit"])) {
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeatPassword"];

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();

        if (empty($fullname) or empty($email) or empty($phoneNumber) or empty($password) or empty($repeatPassword)) {
            array_push($errors, "Missing information");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email");
        }
        if (strlen($phoneNumber) !== 10) {
            array_push($errors, "Phone number must have 10 characters");
        }
        if (strlen($password) < 10) {
            array_push($errors, "Password must be 12 characters long");
        }
        if ($password !== $repeatPassword) {
            array_push($errors, "Passwords do not match");
        }

        require_once "database.php";
        
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result  = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            array_push($errors, "Email already exists");
        }
        

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div>$error</div>";
            }
        } else {
            $sqlQuery = "INSERT INTO users (fullname, email, phonenumber, password) VALUES ( ? , ? , ? , ? )";
            
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sqlQuery);

            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"ssss", $fullname, $email, $phoneNumber, $password_hash);
                mysqli_stmt_execute($stmt);
                echo "<div>You have successfully signed up</div>";
            } else {
                die("Not successful");
            }
        }
    }
    ?>
    <div class="Container">
        <form action="signup.php" method="POST">
            <div>
                <input type="text" name="fullname" placeholder="Full name:">
            </div>
            <div>
                <input type="text" name="email" placeholder="Email:">
            </div>
            <div>
                <input type="text" name="phoneNumber" placeholder="Phone number:">
            </div>
            <div>
                <input type="text" name="password" placeholder="Password:">
            </div>
            <div>
                <input type="text" name="repeatPassword" placeholder="Repeat password:">
            </div>
            <div>
                <input type="submit" value="Sign up" name="submit">
            </div>
        </form>
    </div>
</body>

</html>
