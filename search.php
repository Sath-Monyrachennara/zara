<?php
    require_once('database.php');    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <!-- Ajax Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font awsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
    <div class="searchpro">
        <input type="text" id="searchPro" class="search" name="searchPro" placeholder="SEARCHING">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>

    <div class="searching" id="searching">
        <i class="fa-solid fa-xmark" id="sexit"></i>
        <h2>trending searches</h2>
        <div class="searchCont">
            <a href="bags.php">Bags</a>
            <a href="shop.php">Shoes</a>
            <a href="jackets.php">Jackets</a>
            <a href="bags.php">Accessories</a>
            <a href="dresses.php">Dress</a>
        </div>
        <div id="showResults"></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#sexit").on("click", function(){
                $(".searching").css("display", "none");
            });

            $("#searchPro").on("input", function(){
                var input = $(this).val();
                $.ajax({
                    url:'navsearchResult.php',
                    method:'post',
                    data:{input:input},
                    success: function(data){
                        $(".searchCont").css("display", "none");
                        $("#showResults").html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>
