<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add cycle</title>
</head>
<body>
<form id=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" class="" enctype="multipart/form-data">



    <input type="text" name="cycle-name"><p>Enter cycle name</p> <br>
    <input type="number" name="cycle-rent"><p>Enter cycle rent price</p> <br>
    

    <br>
    <select name="cycle-type" id="">
        <option value="gear">gear</option>
        <option value="electric">electric</option>
        <option value="normal">normal</option>
        <option value="fat">fatcycle</option>
    </select><br><br>
    <input type="file" name="cycle-image"><p>Enter cycle name</p> <br>
    <input type="submit" name="submit">
</form>
</body>
</html>

<?php
include('../connect.php');
if (!empty($_POST['submit'])) {
    $target_dir = "../cycle-images/";
	$randomString = bin2hex(random_bytes(10));

	$target_file = $target_dir . basename($_FILES["cycle-image"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$_FILES['cycle-image']['name'] = $randomString . "." . $imageFileType;

	$target_file = $target_dir . basename($_FILES["cycle-image"]["name"]);
	$file_name = $_FILES['cycle-image']['name'];
	if (!is_dir($target_dir)) {
		mkdir($target_dir, 0777, true);
	}
	$maxSize = 4000000;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	$target_file = $target_dir . basename($_FILES["cycle-image"]["name"]);

	if ($_FILES["cycle-image"]["size"] > $maxSize) {
		echo "<h1>Sorry, your file is too large Or File type " . $_FILES['cycle-image']['size'] . "</h1><br>";
		
	} else{
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp") {
			echo "<h1> File type ==>>" . $_FILES['cycle-image']['type'] . " bytes not supported</h1><br>";
			//echo "<script>typeProblem()</script>";
		} else {
			// Move the uploaded file to the target directory
			if (move_uploaded_file($_FILES["cycle-image"]["tmp_name"], $target_file)) {
				echo "<h1>Uploaded and moved </h1>" . " Image size " . $_FILES['cycle-image']['size'] . "<br>Allowded size $maxSize";
                $cycle_type=$_POST['cycle-type'];
                $cycle_name=$_POST['cycle-name'];
                $cycle_rent=$_POST['cycle-rent'];

                $sql= "insert into cycle (cycle_id, cycle_name, rent_price, cycle_type, image) value (null, '$cycle_name', $cycle_rent, '$cycle_type', '$file_name' )";
                if(mysqli_query($conn, $sql)){
                    echo "Data inserted successfully";
                }
            }
        }


    }
}
?>
