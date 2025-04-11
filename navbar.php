

<style>
header {
  margin: 1px;
  font-family: Arial, Helvetica, sans-serif;
  
}

.nav {
  overflow: hidden;
  background-color: #ffffff;

  width: 1143px;
  margin-top: 10px;
  margin-left: 750px;
}

.nav a {
  float: right;
  color: #220606;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  transition: all .45s ease;
}

.nav a:hover {
  background-color: #d159c7;
  color: black;
  border-radius: 10px;
}
.a1{
  height: 150px;
  width: 150px;
 
  position:absolute;
}
.user-icon{
  color:#9a2baf;
  margin-top: 7px;
  display: inline;
}
.user-part{
  border: 2px solid transparent;
  display: flex;
  padding: 0 10px;
  justify-content: center;
  border-radius: 10px;
  transition: .45s all ease;
  float: right;
  p{
    display: inline;
  }
}
.all{
  position: absolute;
 
  height: 150px;
}

.user-part:hover{
  border-color: #9a2baf;
}
</style>

<header >
  <div class="all">
  <div class="a1"><img src="img/logo2.png.png"class="a1"></div>
<div class="nav">
<a   href="#home">Contact</a>
<a href="#">Cycles</a>
<a href=""  >About</a>
<a href="" class="home">Home</a>


<?php
if (array_key_exists('user_id', $_SESSION) && isset($_SESSION['user_id'])) {
  echo "<a href='./logout.php'  >Log out</a>";
	if ($_SESSION['user_role'] == "admin") {
    echo "<a href='view-cycles.php'>", "visit admin page", "</a>";
  }
}


if(array_key_exists('username',$_SESSION) && !empty($_SESSION['username'])){
    ?> 
    
    <div class="user-part">
    <svg  xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-person-fill user-icon" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>
<p class="username"><?php echo $_SESSION['username'] ?></p>
    </div>

    <?php 
}else{
    ?>

<a href="login.php">LOGIN </a><a>/</a>
<a   href="signup.php">SIGNUP </a>
<?php 
}?>

</div>
  </div>

</header>

