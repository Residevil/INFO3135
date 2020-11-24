<?php include'../view/header.php'; ?>
<body>
     <h2>Please either enter your Notice # or your License Plate Number</h2>
    <form METHOD="post">
        <div class = "center">
	<input type="text" placeholder="Notice# or License Plate Number">
        </div>
        <div class = "center">
                <button type="submit" name="violation_n" class="search_b">Search</button>
        </div>
    </form>
<?php include'../view/footer.php'; ?>
