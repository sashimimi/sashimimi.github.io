<?php
require_once("connect.php");
session_start();

$id = $_POST['id'];
$query="SELECT * FROM crops WHERE id = $id";
$result = $conn->query($query) or die(mysqli_error($conn));
$row = $result->fetch_assoc();

$id = $row['id'];
$crop = $row['crop'];
$season = $row['season'];
$price = $row['price'];
$description = $row['description'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['submit']))
{
    $id = $_POST['id'];
    $crop = "Blue Jazz"; //$_POST['crop'];
    $season = "Spring"; //$_POST['season'];
    $price = $_POST['hiddenupdate'];
    $description = "A flower."; //$_POST['description'];

    $query = "UPDATE crops SET crop = '$crop', season = '$season', price = '$price', description = '$description' WHERE id = $id";

    $result = $conn->query($query) or die(mysqli_error($conn));

    $_SESSION['updatesuccess'] = true;
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
    <h1>Update item</h1>
    <br/>
    <?php if ($crop != "Blue Jazz") { ?>
        <p>For the purposes of this demo, only the "Blue Jazz" item is allowed to be modified.</p>
        <a href="search.html"><input type="button" class="btn btn-primary" name="backtosearch" value="Search Again"/></a>
        <a href="login.php"><input type="button" class="btn btn-primary" name="backtologin" value="Back to Main"/></a>
    <?php }
    else { ?>
    <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
        <input type="radio" name="radiogroup" class="radiogroup" value="100" /> <label>Update Price to "100"</label><br/>
        <input type="radio" name="radiogroup" class="radiogroup" value="30" /> <label>Update Price to "30"</label><br/>
        <br/>
        <input type = "hidden" name = "id" value = "<?php echo $id ?>"/>
        <label>Crop name: </label> <input type = "text" name="crop" value = "<?php echo $crop ?> " disabled /><br><br>
        <label>Season: </label> <input type = "text" name="season" value = "<?php echo $season ?> " disabled /><br><br>
        <label>Price: </label> <input type = "text" name="price" value = "<?php echo $price ?> " class="update" disabled /><br><br>
        <input type="hidden" name="hiddenupdate" class="update"/>
        <label>Description: </label> <input type = "text" name="description" value = "<?php echo $description ?> " disabled /><br><br>
        <input name = "submit" type = "submit" class="btn btn-primary" value = "Update Record" />
        <a href="search.html"><input type="button" class="btn btn-primary" name="backtosearch" value="Search Again"/></a>
        <a href="login.php"><input type="button" class="btn btn-primary" name="backtologin" value="Back to Main"/></a>
    </form>
    <br/>
    <?php if ($_SESSION['updatesuccess']) { ?>
        <p>Item updated successfully.</p>
        <a href="search.html"><input type="button" class="btn btn-primary" name="backtosearch" value="Search Again"/></a>
    <?php } $_SESSION['updatesuccess'] = false; ?>
    <?php } ?>
    </body>
    <script>
        $('.radiogroup').change(function(e){
            if ($(this).val() == '100')
            {
                $('.update').val(100);
            }
            else if ($(this).val() == '30')
            {
                $('.update').val(30);
            }
        });
    </script>
</html>