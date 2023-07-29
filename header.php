<section class="header">
    <div class="headerItem itemOne">
        <a href="home.php" id="logo">zara</a>
        <div class="searchPro">
            <input type="text" id="search" class="search" name="search" placeholder="Search for shoes, bags and more...">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        
        <div class="icons">
            <i class="fa-regular fa-user" id="user"></i>
            <i class="fa-regular fa-heart" id="heart"></i>
            <?php
                global $count, $userId;
                if(isset($_SESSION['user_Id'])){
                    $userId = $_SESSION['user_Id'];
                }
                
                $results = db()->query("SELECT * FROM cart WHERE user_id = '$userId'");
                $count = mysqli_num_rows($results);
            ?>
            <i class="fa-solid fa-bag-shopping" id="addcart"><sup><?=$count?></sup></i>
        </div>
    </div>

    <div class="headerItem">
        <ul class="navbar">
            <li> <a href="home.php">home</a> </li>
            <li> <a href="shop.php">shop</a> </li>
            <li> <a href="about.php">about</a> </li>
            <li> <a href="contact.php">contact</a> </li>
            <li> <a href="orders.php">orders</a> </li>
            <li> <a href="specialPrice.php">special price <sup>NEW</sup> </a> </li>
            <li> <a href="faq.php">faq</a> </li>
        </ul>
    </div>
    <!-- Favorite -->
    <?php include 'favorite.php'; ?>
    <!-- Cart -->
    <?php include 'cart.php'; ?>
    <!-- Sign in -->
    <div id="showUser">
        <?php include ($userId==0) ? 'signIn.php' : 'userAccount.php' ?>
    </div>

</section>