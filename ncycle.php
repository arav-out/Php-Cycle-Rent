<?php
include("connect.php");



$sql = "SELECT * FROM cycle WHERE cycle_type='normal' ";
$all_fat = $conn->query($sql);

?>

<head>
   <title>
   NORMAL cycles</title>
    <link rel="stylesheet" href="fat.css">
</head>
<header>
<?php 
include('./navbar.php');
?>
</header>
<body>

<div class="cycle-box"><?php
          while($row = mysqli_fetch_assoc($all_fat)){
       ?>
<div class="cycle <?php echo 'cycle-00'.$row['cycle_id']?>">


 <img class ="cycle-image"src="cycle-images/<?php echo $row['image']; ?>"  >
 <br>
 <button class="add">add to cart</button>
</div>
<?php
}
?>

</div>



</body>
