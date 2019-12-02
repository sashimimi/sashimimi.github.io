<?php
require_once("connect.php");

$id = $_POST['id'];
$selectQuery="SELECT * FROM crops WHERE id = $id";
$selectResult = $conn->query($selectQuery) or die(mysqli_error($conn));
$row = $selectResult->fetch_assoc();

$crop = $row['crop'];

if ($crop != "Blue Jazz")
{
    $_SESSION['donotdelete'] = true;
}
else
{
    $_SESSION['donotdelete'] = false;
    $resultQuery = "DELETE FROM crops WHERE crop = '$crop'";
    $result = $conn -> query($resultQuery) or die (mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Portfolio - Mimi Lam</title>
    <link rel="icon" href="../../../favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../main.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        body 
        {
            text-align: center;
        }
    </style>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="../../../index.html">
				<img src="../../../favicon.ico"/>
				Mimi Lam
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar">
				<div class="navbar-nav">
					<a href="phpdatabase.html" class="btn btn-outline-primary" role="button">Back to Project</a> <p>&#8205;</p>
				</div>
			</div>
        </nav>
    </header>
    <br/>
    <?php if ($_SESSION['donotdelete']) { ?>
        <p>For the purposes of this demo, only the "Blue Jazz" item is allowed to be modified.</p>
        <a href="login.php"><input type="button" class="btn btn-primary" name="backtologin" value="Back to Main"/></a>
    <?php } 
    else if (!$_SESSION['donotdelete']) { ?>
        <p>Item deleted successfully.</p>
        <a href="login.php"><input type="button" class="btn btn-primary" name="backtologin" value="Back to Main"/></a>
    <?php } ?>
</body>
</html>