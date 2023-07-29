<?php
    require_once('database.php');
    global $input;
    if(isset($_POST['input'])){
        $input = $_POST['input'];
    }
    $results = db()->query("SELECT * FROM faqs WHERE question LIKE '{$input}%' OR answer LIKE '{$input}%'");
    $num_rows = mysqli_num_rows($results);
    if($num_rows>0){
        for($j=1; $j<=$num_rows; $j++){
            if($rows = mysqli_fetch_array($results)){
                $questions = $rows['question'];
                $answers = $rows['answer'];
            }
?>
           <div class="que">
                <h3><?= $questions ?></h3>
                <p><?= $answers ?></p>
                <div class="faqIcons">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-twitter"></i>
                </div>
            </div>
<?php
        }
    }else {
        echo '<p class="nodata">Your cart is empty!</p>';
    }
?>