<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "verify_member.php";
	require "header_member.php";
?>

<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="css/home_style.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_radio_button_style.css">
	</head>
	<body>
    <form class="cd-form" method="POST">
		
        <legend>Add balance</legend>
        
        <div class="error-message" id="error-message">
            <p id="error"></p>
        </div>
        
        <div class="icon">
            <input type="text"id="balance" name="m_balance" placeholder="balance to add" value="0" required />
        </div>
        
        <input type="submit" value="Add" name="add_balance"/>
        <br><br>
        <label id = current_balance></label>

        <br /><br /><br /><br />
    </form>
    <br><br>
        <?php
        
        if(isset($_POST['add_balance']))
		{
            $query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
			$query->bind_param("s", $_SESSION['username']);
			$query->execute();
			$balance = (int)$query->get_result()->fetch_array()[0];
            $balance = $balance  + $_POST['m_balance'];
            $query = $con->prepare("UPDATE member SET balance = ? where username = ? ;");
						$query->bind_param("ss", $balance,$_SESSION['username']);
						if($query->execute())
							echo success("your balance have been updated");
						else
							echo error_without_field("Couldn\'t add balance. Please try again later");
            $query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
            $query->bind_param("s", $_SESSION['username']);
            $query->execute();
            $balance = (int)$query->get_result()->fetch_array()[0];
		}
        ?>
        <script>
            var current_balance = "<?php echo $balance ?>";
            document.getElementById('current_balance').innerText = "current balance = " + current_balance;
        </script>
	</body>
</html>