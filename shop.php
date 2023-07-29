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
    <title>Shop </title>
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
                    <li class="breadcrumb-item active" aria-current="shop.php">Shop</li>
                </ol>
            </nav>
        </div>

        <div class="shopImg" id="bigImg">
            <img src="Images/productImg/img13.jpg" alt="Image 13">
            <img src="Images/productImg/img14.jpg" alt="Image 14">
        </div>

        <div class="shopContent">
            <h3>SHOES FOR WOMEN</h3>
            <p>ZARA PRESENTS ITS FOOTWEAR COLLECTION FOR WOMEN, AN EDITION IN WHICH STYLE IS THE MAIN PRINCIPLE, AND ZARA SHOES PAIR UP PERFECTLY WITH THE REST OF THE GARMENTS IN THE EDITION TO ENHANCE THE STYLE OF ANY LOOK. FOR STRONG LOOKS, ZARA'S BOOTS AND ANKLE BOOTS, AVAILABLE IN DIFFERENT SHAFTS AND</p>
            <button class="viewMore_btn" id="viewMore_btn" onclick="viewBtn('viewmore')">View more</button>
            <p id="paragraph" style="display:none;">TO FORMAL OUTFITS AND STYLE TO SPORTY ENSEMBLES. ZARA'S WOMEN'S TRAINERS DESIGNS ARE IDEAL FOR PAIRING WITH OFFICE WEAR, AS THEY ARE AVAILABLE IN SMART STYLES AND NEUTRAL COLOURS. THEY'RE A WINNING BET WHEN IT COMES TO TAKING THE FORMALITY OUT OF SUITS AND DRESSY OUTFITS IN LAID-BACK WORK ENVIRONMENTS. BOOTS AND ANKLE BOOTS HAVE BECOME ONE OF THE MOST SPECIAL PIECES IN OUR COLLECTION, FOR THEIR VERSATILITY AND ABILITY TO ELEVATE THE STYLE OF ANY OUTFIT. ZARA'S SELECTION OF BOOTS OFFERS A WIDE VARIETY OF DESIGNS, INCLUDING THE LATEST TRENDS AND REVISITED CLASSICS. FOR A CONTEMPORARY LOOK, ZARA WOMEN'S MILITARY STYLE ANKLE BOOTS WILL ADD STRENGTH AND CONFIDENCE TO OUTFITS AIMED AT EXPRESSING PERSONALITY.</p>
            <button class="viewLess_btn" id="viewLess_btn" style="display:none;" onclick="viewBtn('viewless')">View less</button>
        </div>

        <div class="showShopPro">
            <div class="shopPro">
                <?php
                    $result = db()->query("SELECT * FROM product WHERE types = 'shoes'");
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
                                    <a href="detail.php?id=<?=$id?>"><p><?= $pro_name ?></p> </a>
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
                    <a class="page-link npBtn" href="shop.php"> <i class="fa-solid fa-chevron-left"></i> </a>
                </li>
                <li class="page-item" aria-current="page">
                    <a class="page-link active" href="shop.php">01</a>
                </li>
                <li class="page-item"> <a class="page-link" href="jackets.php">02</a> </li>
                <li class="page-item"> <a class="page-link" href="bags.php">03</a> </li>
                <li class="page-item"> <a class="page-link" href="dresses.php">04</a> </li>
                <li class="page-item">
                    <a class="page-link npBtn" href="jackets.php"> <i class="fa-solid fa-chevron-right"></i> </a>
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