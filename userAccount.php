<!-- Show user account -->
<div class="show_userAcc" id="show_userAcc"> 
    <i class="fa-solid fa-xmark" id="userExit"></i>
    <div class="userImg">
        <?php
            $result = db()->query("SELECT * FROM user WHERE id = '$userId'");
            $num_row = mysqli_num_rows($result);
            if($num_row >0){
                if($row = mysqli_fetch_array($result)){
                    $image = $row['user_img'];
                }
            } 
        ?>
        <img src="Images/userImg/<?=$image?>"  alt="zodic">
    </div>
    <p id="userName"><?= $_SESSION['userName']?></p>
    <p id="email"><?= $_SESSION['email'] ?></p>
    <div class="logoutBtn">
        <a href="signUp.php">Sign out</a>
    </div>
</div>