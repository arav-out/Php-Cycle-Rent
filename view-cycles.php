<?php
session_start();
if($_SESSION['user_role']=="user"){
    echo "Not admin cannot see page";
    exit();
}





?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booked</title>
</head>
<body>
    <div class="content">
        
    </div>
</body>
</html>