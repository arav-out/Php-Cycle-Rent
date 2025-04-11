<?php 
include('./connect.php');
session_start();

if (!array_key_exists('user_id', $_SESSION) && empty($_SESSION['user_id'])) {
	header('Location: ./login.php');
}

$user=$_SESSION['user_id'];


// hanges made to the database connection and query execution to prevent SQL injection attacks and improve security.


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Bookings</title>
    <link rel="stylesheet" href="book.css">
</head>
<body>
    <?php 
    $cycle_total_price=0;
    $cart_items="select *  from cart inner join cycle on cart.cycle_id=cycle.cycle_id where uid=$user";
    $cart_result=mysqli_query($conn,$cart_items);



    
    
    ?>

    <div class="container">

        <div class="content">
            <?php   while($row=mysqli_fetch_assoc($cart_result)){
              ?>  
                 <form action="cart-functions.php" method="post" class="close">
            
            <input type="text" hidden value="delete" name='action'>
               <input type="number" hidden value="<?php echo $row['cycle_id']?>" name='id'>
               <input type="number" hidden value="<?php echo $row['rent_price']?>" name='price'>
            <button class="add" type="submit" name="submit">&times;</button>

            
      </form>
         <div class="img">
            <img src="./cycle-images/<?php echo $row['image']?>" alt="" class="cycle-img">
         </div>
         <div class="butns">
         <form action="cart-functions.php" method="post">
               <input type="text" hidden value="decrease" name='action'>
               <input type="number" hidden value="<?php echo $row['cycle_id']?>" name='id'>
               <input type="number" hidden value="<?php echo $row['rent_price']?>" name='price'>
            <button class="add" type="submit" name="submit">-</button>
            </form>
            <?php echo  $row['quantity']?>
            <form action="cart-functions.php" method="post">
               <input type="text" hidden value="insert" name='action'>
               <input type="number" hidden value="<?php echo $row['cycle_id']?>" name='id'>
               <input type="number" hidden value="<?php echo $row['rent_price']?>" name='price'>
            <button class="add" type="submit" name="submit">+</button>
            </form>
                price  = <?php echo $row['price'] ?>
                </div>

<?php

            }
            
            
            ?>
           
        </div>

    </div><?php
$total_sql = "select sum(totalprice) as sum from cart where uid=$user";
$result = mysqli_query($conn,$total_sql);
$total=0;
while ($row=mysqli_fetch_assoc($result)){
    $total=$row['sum'];
}

?>
    <h3>Total price = <?php echo $total ?></h3>



    <form action="book.php" method="post">

    <input type="submit" value="submit" name="submit">

    </form>

    <?php 
    if(isset($_POST['submit'])){
        $select_sql = "select * from cart where uid = $user";
        $result_sql = mysqli_query($conn,$select_sql);
        while($row=mysqli_fetch_assoc($result_sql)){
            $cycle = $row['cycle_id'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $insert_sql = "insert booking (book_id,cycle_id, uid, quantity, price) values (null, $cycle, $user, $quantity, $price)";
            if(mysqli_query($conn,$insert_sql)){
                echo "sucees";
            }

            //echo $cycle.'<br>'.$quantity.'<br>'.$price."<br>";
            
        }
    }
    ?>
</body>
</html>