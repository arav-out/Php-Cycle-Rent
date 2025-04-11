<?php

if(!empty($_POST['submit'])){

    include("connect.php");
    session_start();
    $name = $_POST['uname'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $phoneno = $_POST['phno'];
    $role='user';

    $sql = "select * from users where email = '$email'";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) == 0) {
    //this if checks if the user entered email is already  taked by another user 
    $sql = "insert into users(username,email,password,role,phno) values('$name','$email','$pass','$role','$phoneno')";

    if ($conn->query($sql) === TRUE) {
        //this if confirms that data has entered the databses or inserted succesfully
        $sql = "select * from users where username='$name' and email='$email'";
        $result = $conn->query($sql);
        //this while takes the inserted data from db and place it in session for multiple use
        while ($row = mysqli_fetch_row($result)){
            session_regenerate_id(true);
            $_SESSION['user_id'] = $row[0];
            $_SESSION['user_name'] = $row[1];
            $_SESSION['user_email'] = $row[2];
            $_SESSION['user_role'] = $row[3];
            break;
        }
        //display sign up success for user
        header("location:home.php");
        echo  "Signup up success";
        
        } 
        else{
        echo "error";
    }
    }else{
    echo "email already taken";

    }

}
    
?>

<html>
    <head>
        <title>
            New account
        </title>
        <link rel="stylesheet" href="newacc.css">
        <script src="new.js"></script>
    </head>
    <body>
        <div class="div3" id="div3">
            <video loop src="m1.mp4.mp4" class="div2" autoplay="autoplay" >
            </video>
        </div>

        <div class="div1">
<h1>Create your account </h1>


<form method="post"action="signup.php">

    <label>Email</label><br>
    <input type="email" class="s1" id="email" name="email" value="Auser@virus.com"><br><br>

    <label>username</label><br>
    <input type="text" class="s1" id="uname" name="uname" value="NewUser"><br><br>

    <label>Password</label><br>
    <input type="password" class="s1" id="password" name="pass" value="superpass"><br><br>

    <label>phnumber</label><br>
    <input type="number" class="s1" name="phno" id="phno" value="90909090"><br><br>

   
    <input type="submit" value="Create you account" name="submit" class="s2" id=""><br><br>


</form>

        </div>

    </body>
</html>