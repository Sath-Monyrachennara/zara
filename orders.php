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
    <title>Oders </title>
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
    <section class="orders">
        <div class="pageHeader">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb regiHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="orders.php">Orders</li>
                </ol>
            </nav>
        </div>

        <h2>Your Oders</h2>
        <div class="showOrders">
            <?php
                $result = db()->query("SELECT * FROM `orders` WHERE `user_id` = '$userId'");
                $num_row = mysqli_num_rows($result);
                if($num_row >0){
                    for($i=1; $i<=$num_row; $i++){
                        if($row = mysqli_fetch_array($result)){
                            $date = $row['date'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $number = $row['number'];
                            $address = $row['address'];
                            $payment_method	= $row['payment_method'];
                            $orders = $row['products'];
                            $total = $row['total'];
                            $payment_status	= $row['payment_status'];
                        }
            ?>
                        <div class="orderData">
                            <p id="ordNum">1</p>
                            <div class="showData">
                                <p>Name : <span><?=$name?></span></p>
                                <p>Email : <span><?=$email?></span></p>
                                <p>Number : <span><?=$number?></span></p>
                                <p>Address : <span><?=$address?></span></p>
                                <p>Payment method : <span><?=$payment_method?></span></p>
                                <p>Products : <span><?=$orders?></span></p>
                                <p>Total : <span>$<?=$total?></span></p>
                                <p>Payment status : <span><?=$payment_status?></span></p>
                            </div>
                                
                            <div class="botOrder">
                                <div class="deleteIcon">
                                    <i class="fa-solid fa-trash"></i>
                                    <p>Delete</p>
                                </div>
                                <p id="orderDate">Date: <span><?= $date ?></span> </p>
                            </div>
                        </div>
            <?php
                    }
                }else {
                    echo '<p class="cartEmpty">Your cart is empty!</p>';
                }
            ?>

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