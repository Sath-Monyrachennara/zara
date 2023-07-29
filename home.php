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
    <title>Home </title>
    <!-- Ajax Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font awsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
<?php include 'header.php'; ?>

    <section class="home">
        <div class="homeImg">
            <div class="showHomeImg">
                <img src="Images/homeImg/img1.jpg" alt="Image1">
            </div>
            <a href="shop.php" class="shop_btn">SHOP</a>
        </div>
        
        <div class="typeProds">
            <h2>Which products are you looking for?</h2>
            <!-- Row 1 -->
            <div class="row">
                <div class="col">
                    <a href="shop.php"> <img src="Images/homeImg/img9.jpg" alt="Image9"> </a>
                    <a href="shop.php"> <p>shoes</p> </a>
                </div>
                <div class="col">
                    <a href="jackets.php"> <img src="Images/homeImg/img11.jpg" alt="Image11"> </a>
                    <a href="jackets.php"> <p>jackets | overshirts</p> </a>
                </div>
                <div class="col">
                    <a href="bags.php"> <img src="Images/homeImg/img10.jpg" alt="Image14"> </a>
                    <a href="bags.php"> <p>bags | accessories</p> </a>
                </div>
                <div class="col">
                    <a href="dresses.php"> <img src="Images/homeImg/img14.jpg" alt="Image14"> </a>
                    <a href="dresses.php"> <p>dresses</p> </a>
                </div>
            </div>
        </div>

        <div class="shownewPro" id="shownewPro">
            <div class="shownewPro_title">
                <button type="button" id="newarrivalPage" class="activePage" onclick="showPage(1)">new arrivals</button>
                <button type="button" id="trendingPage" onclick="showPage(2)">what's trending</button>
                <button type="button" id="popularPage" onclick="showPage(3)">popular products</button>
            </div>
            
            <div class="newProd newArrivals" id="newArrivals">
                <p id="page" style="display:none;">newarrivals</p>
                <div class="showFeaProd">
                    <div class="row" id="row1">
                    <?php
                        global $result, $num_row;
                        $result = db()->query("SELECT * FROM product WHERE (id=3||id=4||id=9||id=14) || (id=16||id=10||id=30||id=32) || (id=26||id=28||id=25||id=19)");   
                        $num_row = mysqli_num_rows($result);
                        
                        if($num_row >0){
                            for($i=1; $i<=$num_row; $i++){
                                if($row = mysqli_fetch_array($result)){
                                    $id = $row['id'];
                                    $image = $row['image'];
                                    $pro_name = $row['pro_name'];
                                    $pro_price = $row['pro_price'];
                                } 
                    ?>
                                <div class="col">
                                    <a href="productDetail.php?id=<?=$id?>"> <img src="Images/productImg/<?=$image?>" alt="image"> </a>
                                    <div class="proItem">
                                        <a href="productDetail.php?id=<?=$id?>" id="productName"><?=$pro_name?></a>
                                        <p id="productPrice">$<?=$pro_price?>.00</p>
                                    </div>
                                </div>
                    <?php
                                if($i%4 ==0){
                                    $total_row = $i/4 + 1;
                                    echo '</div>';
                                    echo '<div class="row" id="row'.$total_row.'">';
                                }
                            }
                        }
                    ?>
                    </div>
                </div>
            </div> 
            <?php include 'popularPage.php'; ?>
            <?php include 'trendingPage.php'; ?> 

            <div class="homePagn" id="homePagn">
                <button type="button" id="pagnLeft" onclick="pageNum('next')"> <i class="fa-solid fa-arrow-right"></i> </button>
                <button type="button" id="pagnRight" onclick="pageNum('prev')"> <i class="fa-solid fa-arrow-left"></i> </button>
                <p id="currentPage" style="display:none;"></p>
                <div class="homebottPagn">
                    <i class="fa-solid fa-minus" onclick="pageNum(1)"></i>
                    <i class="fa-solid fa-minus" onclick="pageNum(2)"></i>
                    <i class="fa-solid fa-minus" onclick="pageNum(3)"></i>
                </div>
            </div>   
        </div>

        <div class="showPic">
            <div class="picture">
                <img src="Images/homeImg/img7.jpg" alt="img7">
                <div class="para">
                    <h2>Bags For Women</h2>
                    <p>Many bags are designed for women and the pices are good for our lady, go and see it.</p>
                    <a href="bags.php" class="shopNow_btn">SHOP NOW</a>
                </div>
            </div>
        
            <div class="picture">
                <img src="Images/homeImg/img8.jpg" alt="img8">
                <div class="para">
                    <h2>Fabric Crossbody Bag</h2>
                    <p>Crossbody bag with fabric exterior. Lined interior. Contrast-coloured detail.</p>
                    <a href="productDetail.php?id=3" class="shopNow_btn">SHOP NOW</a>
                </div>
            </div>

            <div class="picture">
                <img src="Images/homeImg/img6.jpg" alt="img6">
                <div class="para">
                    <h2>Special Prices</h2>
                    <p>Get products with special prices and high quality. Many products in our brand has discounted.</p>
                    <a href="productDetail.php?id=2" class="shopNow_btn">SHOP NOW</a>
                </div>
            </div>

            <div class="picture">
                <img src="Images/homeImg/img5.jpg" alt="img5">
                <div class="para">
                    <h2>Awesome Blank Outfit</h2>
                    <p>The newest blank outfits has been released, the style with amazing idea.</p>
                    <a href="jackets.php" class="shopNow_btn">SHOP NOW</a>
                </div>
            </div>
        </div>

        <div class="showSpecialEdit">
            <h2>special edition</h2>
            <div class="specialEdit">
                <div class="specialeImg">
                    <img src="Images/homeImg/img19.png" alt="Image19">
                </div>
                <div class="speDetail">
                    <h3>Y2K | METAVERSE</h3>
                    <p>With the release of its phydigital collection Y2C Creatures, the Spanish multinational retail apparel giant ZARA announces its foray into the metaverse.</p>
                    <p>Users will be able to create their own looks on the app by wearing new pieces from the clothing line, and by sharing a screenshot across social media, they will be entered to win 20,000 coins, with a total of 50 winners.</p>
                    <p id="brandName">ZARA - Y2K Special Edition.</p>
                </div>
            </div>
        </div>
        
        <div class="showPic">
            <div class="picture">
                <img src="Images/homeImg/img15.jpg" alt="img15">
                <div class="para">
                    <h2>CASCADE CHOKER</h2>
                    <p>Metal choker with rhinestone appliqués. Lobster clasp fastening.</p>
                    <a href="bags.php" class="shopNow_btn">SEE MORE</a>
                </div>
            </div>
            <div class="picture">
                <img src="Images/homeImg/img16.jpg" alt="img16">
                <div class="para">
                    <h2>TIE NECKLACE-RHINESTONE</h2>
                    <p>Metal necklace with rhinestone appliqués. Lobster clasp closure. It has high-quality.</p>
                    <a href="productDetail.php?id=12" class="shopNow_btn">DISCOVER</a>
                </div>
            </div>
            <div class="picture">
                <img src="Images/homeImg/img18.jpg" alt="img18">
                <div class="para">
                    <h2>OVAL DENIM BAG</h2>
                    <p>Oval bucket bag. Denim fabric exterior with pleats and diamanté details.</p>
                    <a href="productDetail.php?id=1" class="shopNow_btn">DISCOVER</a>
                </div>
            </div>
            <div class="picture">
                <img src="Images/homeImg/img17.jpg" alt="img17">
                <div class="para">
                    <h2>PRINTED DRESS WITH KNOT</h2>
                    <p>Midi dress with a surplice neckline, front tie and long sleeves. Front slit.</p>
                    <a href="dresses.php" class="shopNow_btn">SEE MORE</a>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>
<script>
    function showPage(page){
        
        var page_num = page;
        // Head of each page
        var newarrival_head = document.getElementById("newarrivalPage");
        var trending_head = document.getElementById("trendingPage");
        var popular_head = document.getElementById("popularPage");
        
        // Link to page
        var newarrival = document.getElementById("newArrivals");
        var trending = document.getElementById("trending");
        var popular = document.getElementById("popular");

        // Display none for trending page and popular page
        var homePagn = document.getElementById("homePagn");

        switch(page_num){
            case 1:
                newarrival_head.style.cssText = `color: #000000; font-weight: bold; border-bottom: 2px solid #000000; padding-bottom: 5px;`;
                trending_head.style.cssText = `color: #656464; font-weight: normal; border: none; padding-bottom: 0px;`;
                popular_head.style.cssText = `color: #656464; font-weight: normal; border: none; padding-bottom: 0px;`;
                
                newarrival.style.display = "flex";
                homePagn.style.display = "block";
                trending.style.display = "none";
                popular.style.display = "none";

                break;
            case 2:
                trending_head.style.cssText = `color: #000000; font-weight: bold; border-bottom: 2px solid #000000; padding-bottom: 5px;`;
                newarrival_head.style.cssText = `color: #656464; font-weight: normal; border: none; padding-bottom: 0px;`;
                popular_head.style.cssText = `color: #656464; font-weight: normal; border: none; padding-bottom: 0px;`;
                
                newarrival.style.display = "none";
                trending.style.display = "flex";
                homePagn.style.display = "none";
                popular.style.display = "none";
                break;
            case 3:
                popular_head.style.cssText = `color: #000000; font-weight: bold; border-bottom: 2px solid #000000; padding-bottom: 5px;`;
                newarrival_head.style.cssText = `color: #656464; font-weight: normal; border: none; padding-bottom: 0px;`;
                trending_head.style.cssText = `color: #656464; font-weight: normal; border: none; padding-bottom: 0px;`;
                
                newarrival.style.display = "none";
                trending.style.display = "none";
                popular.style.display = "flex";
                homePagn.style.display = "none";
                break;
            default:
                break;
        }
    }
</script>

<!-- JavaScript File -->
<script src="js/script.js"></script>

</body>
</html>