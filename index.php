<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat System in PHP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		function ajax(){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function(){
				if(req.readyState == 4 && req.status == 200){
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}
			req.open('GET', 'chat.php', true);
			req.send();
		}
		setInterval(function(){ajax()},1000);//auto refresh page 
	</script>
</head>

<body onload="ajax();">

<div id="container">
	<div id="chat_box">
		<div id="chat"></div>
	</div>
	<form method="post" action="index.php">
		<input type="text" name="name" placeholder="enter name">
		<textarea name="msg"  placeholder="enter message"></textarea>
		<input type="submit" name="submit"  value="Send it">
	</form>
	<?php 
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$msg = $_POST['msg'];
			$query = "INSERT INTO chat (name, msg) values ('$name', '$msg')";
			$run = $con->query($query);
			if($run){
				echo "<embed loop='false' src='sound.mp3' hidden='true' autoplay='true'/>";
			}
		}
	?>
</div>

</body>
</html>