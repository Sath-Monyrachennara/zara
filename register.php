<?php
    session_start();
    require_once('database.php');
    
    // Session
    global $userId, $userName;
    if(isset($_SESSION['user_Id'])) {
        $userId = $_SESSION['user_Id'];
        $userName = $_SESSION['userName'];
    }
    $comid = db()->query("SELECT * FROM `user` WHERE `id` = '$userId'");
    $row = mysqli_num_rows($comid);
    if($row >0 ) {
        $userId = $_SESSION['user_Id'];
    }else {
        $userId = 0;
    } 

    global $email, $name, $password, $com_password, $dateofBirth, $number, $gender, $zodicSign;
    if(isset($_POST['submit'])) {
        $name = $_POST['lastName']." ".$_POST['firstName'];
        $dateofBirth = $_POST['yearOfBirth']."/".$_POST['monthOfBirth']."/".$_POST['dayOfBirth'];
        $number = $_POST['number'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $com_password =$_POST['comPassword'];
        $zodicSign = $_POST['zodicsign'];
    }

    $user_img = $zodicSign.'.jpg';
    $compare = db()->query("SELECT * FROM user WHERE email = '$email'");
    $num_row = mysqli_num_rows($compare);
    if($num_row <= 0 && ($password == $com_password)) {
        $insertData = db()->query("INSERT INTO `user`(`email`, `name`, `dateof_birth`, `number`, `gender`, `password`, `confirm_password`, `zodic_sign`, `user_img`) 
                                   VALUES('$email','$name','$dateofBirth','$number','$gender','$password','$com_password','$zodicSign', '$user_img')"); 
    }else {
        echo '<script>You already have an account.</script>';
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Ajax Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font awsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- Bootstrap CND Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="signup">
        <div class="pageHeader">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb regiHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="register.php">Register</li>
                </ol>
            </nav>
        </div>
        
        <div class="signupForm">
            <h2>CREATE AN ACCOUNT</h2>
            <p>Save your information to check out faster, save items to your wishlist, and view your purchase and return history.</p>
            <p>Note: Only orders that are placed after account creation will be reflected in your Zara account.</p>
            <form action="register.php" method="post">
                <p id="heading">* These fields are required</p>
                <input type="text" id="firstName" class="firstName" name="firstName" placeholder="First Name*" required>
                <input type="text" id="lastName" class="lastName" name="lastName" placeholder="Last Name*" required>

                <div class="dateBirth">
                    <label for="db">Date of Birth*: </label>
                    <select name="yearOfBirth" id="yearOfBirth" value="YYY">
                        <option value="" disabled>YYYY</option>
                        <option hidden>YYYY</option>
                        <?php
                            for($i=2004; $i>=1969; $i--){

                        ?>

                            <option value="<?php echo $i ?>"> <?php echo $i ?> </option>
                        <?php
                            }
                        ?>
                    </select>

                    <p>/</p>
                    <select name="monthOfBirth" id="monthOfBirth">
                        <option value="" disabled>MM</option>
                        <option hidden>MM</option>
                        <?php
                            for($i=1; $i<=12; $i++){
                                if($i >=10){
                                    $i = $i;
                                }else {
                                    $i = "0".$i;
                                }
                        ?>
                            <option value="<?php echo $i ?>"> <?php echo $i ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                        
                    <p>/</p>
                    <select name="dayOfBirth" id="dayOfBirth">
                        <option value="" disabled>DD</option>
                        <option hidden>DD</option>
                        <?php
                            for($i=1; $i<=31; $i++){
                                
                        ?>
                            <option value="<?php echo $i ?>"> <?php echo $i ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="contNum">
                    <label for="number">Contact Number*: </label>
                    <input type="number" id="number" class="number" name="number" placeholder="Contact Number">
                </div>
                    
                <div class="genders">
                    <label for="gender">Gender*: </label>
                    <select name="gender" id="gender">
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                        <option value="notSay">Prefer Not To Say</option>
                    </select>
                </div>
                    
                <input type="email" id="emails" class="email" name="email" placeholder="Email Address*" >
                <input type="password" id="password" class="password" name="password" placeholder="Password*" >
                <input type="password" id="comPassword" class="comPassword" name="comPassword" placeholder="Confirm Password*" >
                
                <div class="zodicSign">
                    <label for="hearUs">What's your zodic sign?*: </label>
                    <select name="zodicsign" id="hearUs">
                        <option disabled selected>Select One</option>
                        <?php
                            $zodic = array("Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", " Libra", "Scorpius", "Sagittarius", "Capricornus", "Aquarius", "Pisces");
                            
                            for($i=0; $i<12; $i++){
                        ?>
                                <option value="<?=$zodic[$i]?>"><?=$zodic[$i]?></option>                     
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <button type="submit" name="submit">CREATE AN ACCOUNT</button>
                <p id="haveAcc">have an account? <a href="signIn.php">Sign in</a></p>
            </form>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script type="text/javascript">
    $(document).ready(function(){
        var name = $("#proName").text();
    //    console.log(name);
        $("#delete_btn").on("click", function(){
            $.ajax({
                url:'favorite.php',
                method:'get',
                data: {proName:name},
                success:function(){
                    alert("Your product is deleted in favorite!");     
                }
            });
        });
    });
    </script>
    
    <!-- JavaScript File -->
    <script src="js/script.js"></script>
    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>