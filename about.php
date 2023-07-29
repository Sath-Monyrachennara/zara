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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About </title>
    <!-- Ajax Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font awsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,500;1,400&display=swap" rel="stylesheet">
    <!-- Bootstrap CND Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="about">
        <div class="pageHeader">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shopHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="about.php">About</li>
                </ol>
            </nav>
        </div>
        
        <div class="aboutItem" id="itemOne">
            <h2>About ZARA</h2>
            <p>NO MATTER WHERE THEY ARE, WITH THE INSPIRINGLY BEAUTIFUL.</p>
            <p id="smallitemOne">ZARA IS A FORWARD-THINKING FORCE IN FASHION.</p>
        </div>

        <div class="aboutItem" id="itemThree">
            <img src="Images/aboutImg/img5.jpg" alt="aboutImg5">
            <div class="aboutContent">
                <h2>Beginning The Cycle</h2>
                <p>
                    We have ambitious sustainable targets for our key raw materials. 
                    Our move to innovative, organic or recycled raw materials is a key path to transform our industry, 
                    reduce our emissions and use clean energy and water. 
                </p>
                <p>
                    Circularity goes hand in hand with great design. Every one of our designers is trained to create our products with their complete life-cycle loop in mind, 
                    while embracing new ideas, constantly experimenting and remaining true to our free-thinking culture. 
                </p>
                <p>
                    The impact of climate change, the human influence on the natural world, and a scarcity of natural resources impacts us all. 
                </p>
                <div class="shop_btn">
                    <a href="shop.php">Shop Now</a>    
                </div>
            </div>
        </div>

        <div class="aboutItem" id="itemFour">
            <div class="imgItem">
                <img src="Images/aboutImg/img6.jpg" alt="aboutImg6" id="sm_imgItem">
                <img src="Images/aboutImg/img4.jpg" alt="aboutImg4">
            </div>

            <div class="aboutContent">
                <h2>Sharing is Caring</h2>
                <p>
                    We promote community projects to maximize their positive impact. 
                    In the last three years, we have directly supported 7.9 million people in need, 
                    in collaboration with more than 400 nonprofit entities -such as ACNUR, MSF or Water.org- to tackle activities mainly related to social welfare, education and emergency relief.
                </p>
                <img src="Images/aboutImg/img7.jpg" alt="aboutImg7">
            </div>
        </div>

        <div class="aboutItem" id="itemFive">
            <div class="aboutContent">
                <h2>Our Path!</h2>
                <p>
                    The impact of climate change, the human influence on the natural world, and a scarcity of natural resources impacts us all. At Inditex, we believe fashion is universal, 
                    and it must be a force for good, which is why we are going "all in" to transform our industry.
                </p>
                <p>
                    Inditex is an agent of change. Over the past two decades we have also demonstrated a longstanding commitment to people and environment, beginning with the company.
                </p>
                <img src="Images/aboutImg/img10.jpg" alt="aboutImg10">
            </div>

            <div class="imgItem">
                <img src="Images/aboutImg/img9.jpg" alt="aboutImg9">
                <img src="Images/aboutImg/img3.jpg" alt="aboutImg3" id="sm_imgItem">
                <img src="Images/aboutImg/img8.jpg" alt="aboutImg8" id="xsm_imgItem">
            </div>
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