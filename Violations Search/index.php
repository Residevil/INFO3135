<?php include'../view/header.php'; ?>


	<body>
		<form METHOD="post">
			<div>
				<input type="text" placeholder="Search...">
			</div>
		
			<div>
				<button type="submit" name="violation_n" class="search_b">Violation Number</button>
				<button type="submit" name="licence_p" class="search_b">Licence Plate</button>
			</div>
		</form>
		
		<b><a href=<?php echo'../Login'?>>Staff Login</a></b>
	</body>
</html>