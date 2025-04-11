<?php 
include ('./connect.php');
session_start();
if (!array_key_exists('user_id', $_SESSION) && empty($_SESSION['user_id'])) {
	header('Location: ./login.php');
}
$user=$_SESSION['user_id'];
echo 'User= '.$user;
if(isset($_POST['submit'])){
    $id= $_POST['id'];
$action = $_POST['action'];
$price = $_POST['price'];
$link = $_SERVER['HTTP_REFERER'];
echo $link;

echo "$id, $action";
if($action=="insert"){
    insert_to_cart($conn);
    
}else if($action=="decrease"){
    decrease_cart($conn);
}else if($action=="delete"){
    delete_cycle($conn);
}else{
    echo "Invalid action";
}
}


function decrease_cart($connection){
    echo "deletion";
    global $id, $user ,$price,$link;
    $sql = "select quantity,totalprice from cart where cycle_id=$id and uid = $user";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) != 1) {
			return;

		}
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<h2>" . $row['quantity'] . "</h2>";
			$quantity = $row['quantity'];
			$item_total = $row['totalprice'];
		}
		if($quantity==1){
			$remove_sql="delete from cart where cycle_id=$id and uid = $user";
			if (mysqli_query($connection, $remove_sql)) {

				
				echo "<br><br><br>Removed  product success (quantity decreased)<br><br><br>";
                
				header("Location:$link");
				return;
			}
			echo "<h2 style='color: red; font-family:sans-serif'>Product insert Unsuccessfull</h2>";

		}elseif($quantity>1){
			$update_sql = "update cart set quantity= quantity-1, totalprice = $item_total-price where uid = $user and cycle_id = $id";
			if (mysqli_query($connection, $update_sql)) {

				header("Location:$link");
				
				echo "<h2 style='color: red; font-family:sans-serif'>Product Update Successfull (quantity decreased)</h2>";
				return;
			}
			echo "<h2 style='color: red; font-family:sans-serif'>Product Update UNsuccessfull</h2>";
			
		}
}
function insert_to_cart($conn){
    global $id, $user ,$price,$link;
    $find_data="select * from cart where cycle_id=$id and uid=$user";
    $find_result=mysqli_query($conn,$find_data);
    if(mysqli_num_rows($find_result)==0){
        echo "inrease function";
        
        
            
            $insert_sql= "insert into cart (cart_id,uid,cycle_id,quantity, price, totalprice ) values (null,$user, $id, 1, $price,$price*1)";
            if(mysqli_query($conn,$insert_sql)){
                echo "Sucesss"; 
                header("Location:$link");
            }
        

    }else{
        
        $update_sql="update cart set quantity = quantity + 1 , totalprice = price*(quantity)";
        if(mysqli_query($conn,$update_sql)){
            echo "<h2>Update sucess</h2>";
            header("Location:$link");
        }
    }
    
    
}



function delete_cycle($connection){
    echo "<h2 style='color: red; font-family:sans-serif'>Delete function</h2>";
    global $id,$user,$link;
    $sql = "delete  from cart where cycle_id=$id and uid = $user";
    if(mysqli_query($connection,$sql)){
        echo "<h2 style='color: red; font-family:sans-serif'>Product Delete Successfull (quantity DELETED)</h2>";
       
        header("Location:$link");
        return;
    }
    echo "<h2 style='color: red; font-family:sans-serif'>Product Delete Unsuccessfull </h2>";
    


}
?>

<a href="http://localhost/website/fcycle.php">Back</a>

