<p id="page" style="display:none;">trending</p>
<div class="newProd trending" id="trending">
    <div class="showFeaProd">
        <div class="row" id="row1">
            <?php
                global $result, $num_row;
                $result = db()->query("SELECT * FROM product WHERE (id=7||id=1||id=13||id=15) || (id=21||id=20||id=23||id=27) || (id=24||id=29||id=35||id=22)");   
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
