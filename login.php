<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<
>, initial-scale=1.0">
    <title>Document</title>
</head>

<title>hehe</title>  
<link rel="stylesheet" href="style.css"> 
<body>
   <aside>
    <img src="logo2.png.png" class="logo">
   <h1>Hi!Welcome to Cycle Rental</h1>
   <h2>Sign into your account</h2>
   <form method="post" action="login.php" >
    <input type="text" placeholder="enter your username" class="form1" name="uname" value="ar"><br><br>
    <input type="password" placeholder="password" name="pass" class="form2"><br><br>
    <input type="submit"  class="login" value="login" name="submit">
    </form>
    <p >OR</p>
    <a href="signup.php">sign up</a>
    <p style="color: red;" id="login-result"></p>
</aside>
    <section>
        <img src="2.png.jpeg" class="sign">
    </section> 
 <script src="hehe.js"></script>
</body>
</html>

<?php
if(!empty($_POST['submit'])){
    
$name = $_POST['uname'];
$pass = $_POST['pass'];
$sql = "select * from users where username ='$name' and password = '$pass'" ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
      //echo "id: " . $row["uid"]. " - Name: " . $row["username"]. " " . $row["password"]. "<br>";
      $_SESSION['user_id']=$row["uid"];
      $_SESSION['user_email']=$row["email"];
      $_SESSION['user_role']=$row["role"];
      header("location:home.php");

    }
  } else {
    ?><script>
        let p = document.getElementById('login-result')
        p.textContent="Username or password incorrect"
    </script>
    <?php
  }



}


?>

