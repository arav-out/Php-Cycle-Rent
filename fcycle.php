<?php
include("connect.php");

session_start();
$user=$_SESSION['user_id'];
if (!array_key_exists('user_id', $_SESSION) && empty($_SESSION['user_id'])) {
	header('Location: ./login.php');
}

$sql = "SELECT * FROM cycle WHERE cycle_type='fat' ";
$all_fat = $conn->query($sql);

?>

<head>
   <title>
    fat cycles</title>
    <link rel="stylesheet" href="fat.css">
</head>
<header>
<?php 
//include('./navbar.php');
?>
</header>
<body>

<div class="cycle-box"><?php
          while($row = mysqli_fetch_assoc($all_fat)){
       ?>
<div class="cycle <?php echo 'cycle-00'.$row['cycle_id']?>">


 <img class ="cycle-image"src="cycle-images/<?php echo $row['image']; ?>"  >
 <br>
 <form action="cart-functions.php" method="post">
   <input type="text" hidden value="insert" name='action'>
   <input type="number" hidden value="<?php echo $row['cycle_id']?>" name='id'>
   <input type="number" hidden value="<?php echo $row['rent_price']?>" name='price'>
 <button class="add" type="submit" name="submit">add to cart</button>
 </form>
</div>


<?php
}
?>
<?php 
      $cart_items="select * from cart inner join cycle on cart.cycle_id=cycle.cycle_id where uid=$user";
      $cart_result=mysqli_query($conn,$cart_items);
      
?>
</div>
<?php
if(mysqli_num_rows($cart_result)>0){
   ?>

<div class="tray">
   <div class="content">
      
      <?php
      while($row=mysqli_fetch_assoc($cart_result)){
         ?>
<div class="item">
        
            
         </div>
         
      </div>
         <?php
      }
      ?><a style="height: 26px;">Proceed</a>
      

     
      
      </div>
   </div>
</div>
   <?php
}
?>


</body>
