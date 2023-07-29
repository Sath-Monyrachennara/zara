<?php
    require_once('database.php');
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
    <title>Bags </title>
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
    <section class="shop">
        <div class="pageHeader">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shopHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="bags.php">Bags | Accessoris</li>
                </ol>
            </nav>
        </div>

        <div class="shopImg" id="bigImg">
            <img src="Images/productImg/img15.jpg" alt="Image 15">
            <img src="Images/productImg/img16.jpg" alt="Image 16">
        </div>

        <div class="shopContent">
            <h3>BAGS AND ACCESSORIES FROM WOMAN</h3>
            <p>WOMEN’S BAGS CAN BE SMART OR CASUAL, BIG OR SMALL, BUT ALWAYS SHOULD BE FUNCTIONAL AND FASHIONABLE. THE COLLECTION FEATURES BAGS TO SUIT ALL MANNER OF NEEDS AND SITUATIONS. CROSSBODY, BUCKET BAGS AND SHOULDER BAGS MAKE FOR EASY EVERYDAY COMPANIONS, WHETHER USED FOR WORK OR</p>
            <button class="viewMore_btn" id="viewMore_btn" onclick="viewBtn('viewmore')">View more</button>
            <p id="paragraph" style="display:none;">RUNNING ERRANDS; RUCKSACKS AND BACKPACKS ARE USEFUL AND SUPPORTIVE HOLDALLS FOR BELONGINGS SUCH AS BOOKS AND LAPTOPS AS WELL AS EXERCISE KITS; WHILE CAPACIOUS CARRYALLS – INCLUDING SHOPPERS AND LARGE TOTES – ARE PERFECT FOR MYRIAD OCCASIONS. FOR EVENINGS OUT OR DAYS THAT REQUIRE BASICS ONLY, CLUTCHES RANGE IN STYLE FROM PLAIN AND SIMPLE TO BEADED, EMBELLISHED AND STATEMENT MAKING. FROM TOP HANDLES TO BUCKLED STRAPS, FASTENINGS BECOME A CONSIDERED DESIGN DETAIL THAT ELEVATE EACH BAG, WHILE INSIDE, CONCEALED POCKETS AND SAFE ZIPPED COMPARTMENTS ENSURE THAT THERE IS A PLACE FOR EVERYTHING. THE COLLECTION IS AS TACTILE AS IT IS TRENDY. LEATHER AND FAUX LEATHER FEATURE PROMINENTLY, AS DOES SUEDE, MOCK-CROC, WOVEN COTTON AND TOWELLING TEXTURES. FOR A STATEMENT-MAKING ACCESSORY, METALLIC TOTES, QUILTED CROSSBODY BAGS AND MINI BOWLING BAGS WILL IMBUE YOUR LOOK WITH NEW-SEASON CREDENTIALS.</p>
            <button class="viewLess_btn" id="viewLess_btn" style="display:none;" onclick="viewBtn('viewless')">View less</button>
        </div>

        <div class="showShopPro">
            <div class="shopPro">
                <?php
                    $result = db()->query("SELECT * FROM product WHERE types = 'bags' OR types='accessories'");
                    $num_row = mysqli_num_rows($result);
                    if($num_row > 0){
                        for($i=1; $i<=$num_row; $i++){
                            if($row = mysqli_fetch_array($result)){
                                $id = $row['id'];
                                $pro_img = $row['image'];
                                $pro_name = $row['pro_name'];
                                $pro_price = $row['pro_price'];
                            }
                ?>
                            <div class="Pro">
                                <a href="productDetail.php?id=<?=$id?>"> <img src="Images/productImg/<?=$pro_img ?>" alt="image1"> </a>
                                <div class="itemPro">
                                    <a href="productDetail.php?id=<?=$id?>"><p><?= $pro_name ?></p> </a>
                                    <p id="price">$<?=$pro_price ?>.00</p>
                                </div> 
                            </div>
                <?php
                            if($i%4 == 0){
                                echo '</div>';
                                echo '<div class="shopPro">';
                            }
                        }
                    }
                ?>
            </div>      
        </div>

        <nav aria-label="">
            <ul class="pagination justify-content-center pangNum">
                <li class="page-item">
                    <a class="page-link npBtn" href="jackets.php"> <i class="fa-solid fa-chevron-left"></i> </a>
                </li>
                <li class="page-item" aria-current="page">
                    <a class="page-link" href="shop.php">01</a>
                </li>
                <li class="page-item"> <a class="page-link" href="jackets.php">02</a> </li>
                <li class="page-item"> <a class="page-link active" href="bags.php">03</a> </li>
                <li class="page-item"> <a class="page-link" href="dresses.php">04</a> </li>
                <li class="page-item">
                    <a class="page-link npBtn" href="dresses.php"> <i class="fa-solid fa-chevron-right"></i> </a>
                </li>
            </ul>
        </nav>
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