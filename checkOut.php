<?php
    require_once('database.php');
    session_start();

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
    
    global $name, $email, $address, $number, $payment_method, $total, $result, $num_row;
    $total = 0;
    $orderproducts = "";

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $name = $_POST['lname']." ".$_POST['fname'];
        $address = $_POST['address'] . " ".$_POST['city']." ".$_POST['country'];
        $number = $_POST['phone'];
        $payment_method = $_POST['payment'];
    }

    $result = db()->query("SELECT * FROM cart WHERE user_id = '$userId'");
    $num_row = mysqli_num_rows($result);

    for($i=1; $i<=$num_row; $i++){
        if($row = mysqli_fetch_array($result)){
            $productsName = $row['pro_name'];
            $productsPrice = $row['pro_price'];
        }
           
        $total = $total + $productsPrice;
        $orderproducts = $orderproducts . $productsName . ', ';
    }

    $compare = db()->query("SELECT * FROM `orders` WHERE `user_id` = '$userId' AND (`payment_method` = '$payment_method' AND `total` = '$total')");
    $num_rows = mysqli_num_rows($compare);

    if($num_rows > 0 || empty($total) || empty($name)){
        
    }else {
        $insertData = db()->query("INSERT INTO `orders`(`user_id`, `name`, `email`, `number`, `address`, `payment_method`, `products`, `total`) 
                                   VALUES ('$userId','$name','$email','$number','$address','$payment_method','$orderproducts','$total')");
        $deletedCart = db()->query("DELETE FROM `cart` WHERE user_id='$userId'");
        if($deletedCart) {
            alert("Your oders is submitted! Thanks you.");
        }    
}  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout </title>
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
    <section class="checkOut">
        <div class="pageHeader">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb regiHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="checkOut.php">Checkout</li>
                </ol>
            </nav>
        </div>

        <div class="checkoutCont">
            <div class="checkoutInfo">
                <h1>Checkout</h1>
                <h2>Customer Information</h2>
                <form action="checkOut.php" method="post">
                    <div class="cusInfo">
                        <label for="email">Email: </label>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="cusInfo">
                        <label for="fname">First name: </label>
                        <input type="text" id="fname" name="fname" placeholder="First name" required>
                    </div>
                    <div class="cusInfo">
                        <label for="lname">Last name: </label>
                        <input type="text" id="lname" name="lname" placeholder="Last name" required>
                    </div>
                    <div class="cusInfo">
                        <label for="address">Address: </label>
                        <input type="text" id="address" name="address" placeholder="Address" required>
                    </div>
                    <div class="cusInfo">
                        <label for="city">City: </label>
                        <input type="text" id="city" name="city" placeholder="City" required>
                    </div>
                    <div class="cusInfo">
                        <label for="country">Country: </label>
                        <input type="text" id="country" name="country" placeholder="Country" required>
                    </div>
                    <div class="cusInfo">
                        <label for="phone">Phone: </label>
                        <input type="number" id="phone" name="phone" placeholder="Phone" required>
                    </div>
                    <div class="cusInfo">
                        <label for="payment">Payment method: </label>
                        <select id="payment" name="payment">
                            <option value="" disabled>Pay Pal</option>
                            <option value="aba">ABA</option>
                            <option value="paypal">Pay Pal</option>
                            <option value="wing">Wing</option>
                            <option value="armet">Armet</option>
                        </select>
                    </div>
                    <button id="submit" name="submit">Submit</button>
                </form>
            </div>

            <div class="orderSumm">
                <h2>Order Summary</h2>
                <div class="summaryPro">
                    <?php
                        $results = db()->query("SELECT * FROM cart WHERE user_id = $userId");
                        $num_row = mysqli_num_rows($results);
                        if($num_row>0){
                            for($i=1; $i<=$num_row; $i++){
                                if($rows = mysqli_fetch_array($results)){
                                    $pro_name = $rows['pro_name'];
                                    $pro_price = $rows['pro_price'];
                                    $qty = $rows['quantity'];
                                    $size = $rows['size'];
                                    $color = $rows['color'];
                                    $image = $rows['pro_image'];
                                    $date = $rows['date'];
                                }
                    ?>
                                <div class="sumPro">
                                    <img src="Images/productImg/<?=$image?>" alt="">
                                    <div class="sumproDet">
                                        <div>
                                            <p><?=$pro_name?> <span>x <?=$qty?></span></p>
                                            <p class="price">$<?=$pro_price?>.00</p>
                                        </div>
                                        <p><?= ($size)=="" ? "none": $size?></p>
                                        <p><?=$color?></p>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    ?>
                </div>
                
                <div class="subTotal">
                    <p>Subtotal <span>$<?=$total?>.00</span></p>
                    <p>Shipping <span>__</span></p>
                    <p>Taxes <span>__</span></p>
                </div>
                <div class="total">
                    <p>Total <span>$<?=$total?>.00</span></p>
                </div>
                <div class="date">
                    <p>Date <span><?=$date?></span></p>
                </div>
            </div>
        </div>
        
        
    </section>      

    <?php include 'footer.php'; ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#searFaq").focus(function(){
                $(".searchOne").css("display", "none");
                $(".searchTwo").css("display", "block");
            });

            $("#faqexit").on("click", function(){
                $(".searchOne").css("display", "block");
                $(".searchTwo").css("display", "none");
            });

            $("#searFaq1").on("input", function(){
                var input = $(this).val();
                $.ajax({
                    url:'searchresult.php',
                    method:'post',
                    data:{input:input},
                    success: function(data){
                        $("#faqRow1").css("display", "none");
                        $("#faqRow2").html(data);
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