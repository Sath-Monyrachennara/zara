<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once('database.php');
    global $email, $password, $userName, $userId;
    if(isset($_POST['signIn_btn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
    }

    if(!empty($email) && !empty($password)){
        $result = db()->query("SELECT * FROM user WHERE email = '$email' AND `password` = '$password'");
        if(mysqli_num_rows($result) === 1 ){
            if($row = mysqli_fetch_array($result)){
                $_SESSION['user_Id'] = $row['id'];
                $_SESSION['userName'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];     
                $_SESSION['zodic_sign'] = $row['zodic_sign'];  
            }
        }
        header("Location: home.php");
    }

    if(isset($_SESSION['user_Id'])){
        $userId = $_SESSION['user_Id'];
    }
?>

<section class="signinForm" id="signinForm">
    <i class="fa-solid fa-xmark exituser" id="exitform"></i>
    <h3>sign in</h3>
    <p>Password details are case sensitive.</p>

    <form action="signIn.php" method="post">
        <input type="email" id="emails" class="email" name="email" placeholder="Email Address" required>
        <input type="password" id="password" class="password" name="password" placeholder="Password" required>
        <button type="submit" class="signIn_btn" name="signIn_btn">SIGN IN</button>
        <small>Forgot your password?</small>
    </form>
    <a href="register.php">create an account</a>
</section>    