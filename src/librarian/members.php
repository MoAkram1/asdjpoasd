<?php
	require "../db_connect.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>

<html>
    <head>
        <title> All members</title><link rel="stylesheet" type="text/css" href="../css/global_styles.css">
        <link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="css/home_style.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_radio_button_style.css">
	</head>
	<body>
		<?php
			$query = $con->prepare("SELECT `id`, `username`, `name`, `email`, `balance` FROM `member`  ORDER BY id");
			$query->execute();
			$result = $query->get_result();
			if(!$result)
				die("ERROR: Couldn't fetch books");
			$rows = mysqli_num_rows($result);
			if($rows == 0)
				echo "<h2 align='center'>No members registered yet</h2>";
			else
			{
				echo "<form class='cd-form' method='POST' action='#'>";
				echo "<legend>Available members</legend>";
				echo "<div class='error-message' id='error-message'>
						<p id='error'></p>
					</div>";
				echo "<table width='100%' cellpadding=10 cellspacing=10>";
				echo "<tr>
						<th></th>
						<th>ID<hr></th>
						<th>username<hr></th>
						<th>name<hr></th>
						<th>email<hr></th>
						<th>available balance<hr></th>
					</tr>";
				for($i=0; $i<$rows; $i++)
				{
					$row = mysqli_fetch_array($result);
					// echo "<tr>
					// 		<td>
					// 			<label class='control control--radio'>
					// 				<input type='radio' name='rd_book' value=".$row[0]." />
					// 			<div class='control__indicator'></div>
					// 		</td>";
                    echo "<tr>
							<td>
							</td>";
					for($j=0; $j<5; $j++)
						if($j == 4)
							echo "<td>$".$row[$j]."</td>";
						else
							echo "<td>".$row[$j]."</td>";
					echo "</tr>";
				}
			}
		?>
		<script>
			var number_of_rows = "<?php echo $rows ?>";
			if(number_of_rows != 0)
			{
				for(i=0; i<number_of_rows; i++)
				{
					row = "<?php echo mysqli_fetch_array($result)?>";
                    // document.write("<tr> <td> </td>");
					// for(j=0; j<5; j++)
					// 	if(j == 4)
					// 	{
					// 		document.write( "<td>"+ "hello" +"</td>");
					// 	}			
					// 	else
					// 	{
					// 		document.write("<td> not last </td>")
					// 	}
				}
			}

		</script>
	</body>
</html>