<div class="newProd popular" id="popular">
    <div class="showFeaProd">
        <div class="row" id="row1">
            <?php
                global $result, $num_row;
                $result = db()->query("SELECT * FROM product WHERE (id=6||id=8||id=10||id=11) || (id=14||id=20||id=34||id=25) || (id=28||id=36||id=33||id=19)");   
                $num_row = mysqli_num_rows($result);
                        
                if($num_row >0){
                    for($i=1; $i<=4; $i++){
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
                    }
                }
            ?>          
            </div>
        </div>
    </div>