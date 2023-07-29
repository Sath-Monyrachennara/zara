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
    
    global $result, $name, $email, $number, $address, $messages;
    if(isset($_POST['sendMess'])){
        $name = $_POST['lastName']." ".$_POST['firstName'];
        $email = $_POST['email'];
        $number = $_POST['phone'];
        $address = $_POST['address']." ". $_POST['country'];
        $messages = $_POST['message'];
    }

    $compare = db()->query("SELECT * FROM `contactus` WHERE `message` = '$messages' AND user_id ='$userId'");
    $num_row = mysqli_num_rows($compare);
    if(isset($_POST['sendMess']) && $num_row == 0) {
        $result = db()->query("INSERT INTO `contactus`(`user_id`, `name`, `email`, `phone`, `address`, `message`) 
        VALUES('$userId', '$name', '$email', '$number', '$address', '$messages')");
        echo '<script>alert("Your information is submitted!");</script>';    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact </title>
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
    <section class="contact">
        <div class="pageHeader">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb regiHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="contact.php">Contact</li>
                </ol>
            </nav>
        </div> 

        <div class="contactUs">
            <div class="contItem">
                <h2>Contact Information</h2>
                <p>Fill up the form and our Team will get back to you within 24 hours.</p>
                <div class="contIcon">
                    <div class="info_cont">
                        <i class="fa-solid fa-phone"></i>
                        <p>(607) 936-8085</p>
                    </div>

                    <div class="info_cont">
                        <i class="fa-solid fa-envelope"></i>
                        <p>Zara@Gmail.Com</p>
                    </div>

                    <div class="info_cont">
                        <i class="fa-solid fa-location-dot" id="location_icon"></i>
                        <p>412 State 424 Rte Beaver Dams</p>
                    </div>
                </div>
                
                <div class="social_icons">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-linkedin-in"></i>   
                </div>
            </div>

            <form action="contact.php" method="post" class="contForm" enctype="multipart/form-data">
                <div class="contRow">
                    <div class="cont">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="Nara">

                        <label for="email">Mail</label>
                        <input type="email" id="email" name="email" placeholder="monyrasath44@gmail.com">
                    </div>

                    <div class="cont">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Sath">

                        <label for="phone">Phone</label>
                        <input type="number" id="phone" name="phone" placeholder="010 23 45 60">
                    </div>
                </div>

                <div class="contRow" id="contRow2">    
                    <div class="cont"> 
                        <label for="address">Address</label>   
                        <input type="text" id="address" name="address" placeholder="st12 PP ">
                    </div>   
                    <div class="cont"> 
                        <label for="country">Country</label>   
                        <input type="text" id="country" name="country" placeholder="Cambodia">
                    </div>                
                </div>

                <div class="contRow" id="contRow3">
                    <div class="cont">
                        <label for="message">Message</label>
                        <input type="text" id="message" name="message" placeholder="Write your message...">
                    </div>
                </div>

                <div class="send_btn">
                    <button type="submit" name="sendMess" class="sendMess">Send Message</button>
                </div>
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