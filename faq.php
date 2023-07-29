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
    <title>Faq </title>
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
    <section class="faq">
        <div class="pageHeader">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb regiHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="faq.php">FAQs</li>
                </ol>
            </nav>
        </div>

        <h2>FAQ<small>s</small></h2>
        <div class="faqInfo">
            <div class="faqSearch">
                <div class="searchOne">
                    <input type="text" id="searFaq" name="searFaq" placeholder="Search something...">
                    <i class="fa-solid fa-magnifying-glass" id="beforeSearch"></i>
                </div>

                <div class="searchTwo">
                    <i class="fa-solid fa-magnifying-glass" id="searhBnt"></i>
                    <input type="text" id="searFaq1" name="searFaq" placeholder="Searching...">
                    <i class="fa-solid fa-xmark" id="faqexit"></i>
                </div>  
            </div>

            <div class="faqRow" id="faqRow1">
                <?php
                    $result = db()->query("SELECT * FROM `faqs`");
                    $num_row = mysqli_num_rows($result);
                    if($num_row > 0){
                        for($i=1; $i<=$num_row; $i++){
                            if($row = mysqli_fetch_array($result)){
                                $id = $row['id'];
                                $question = $row['question'];
                                $answer = $row['answer'];
                            }
                ?>
                            <div class="que">
                                <h3><?= $question ?></h3>
                                <p><?= $answer ?></p>
                                <div class="faqIcons">
                                    <i class="fa-brands fa-facebook-f"></i>
                                    <i class="fa-brands fa-instagram"></i>
                                    <i class="fa-brands fa-twitter"></i>
                                </div>
                            </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="faqRow" id="faqRow2"></div>
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