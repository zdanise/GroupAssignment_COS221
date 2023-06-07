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
    //print_r($_POST);

    if (isset($_POST["submit"])) {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeatPassword"];

        $errors = array();

        if (empty($firstname) or empty($lastname) or empty($email) or empty($username) or empty($password) or empty($repeatPassword)) {
            array_push($errors, "Missing information");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email");
        }
        if (strlen($username) > 10) {
            array_push($errors, "Username must have 10 characters");
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
            $sqlQuery = "INSERT INTO users (firstname,secondname, email, username, password) VALUES ( ? , ? , ? , ? , ? )";

            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sqlQuery);

            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "sssss", $firstname, $secondname, $email, $username, $password);
                mysqli_stmt_execute($stmt);
                echo "<div>You have successfully signed up</div>";
            } else {
                die("Not successful");
            }
        }
        //check witht the database guys to ask about the user/customer table
    }
    ?>
    <div class="Container">
        <form action="signup.php" method="POST">
            <div>
                <input type="text" name="firstname" placeholder="First name:">
            </div>
            <div>
                <input type="text" name="lastname" placeholder="Last name:">
            </div>
            <div>
                <input type="text" name="email" placeholder="Email:">
            </div>
            <div>
                <input type="text" name="username" placeholder="username number:">
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