<?php include'../view/header.php'; ?>
<body>
    <h2>Enter the Notice# or License Plate#</h2>
    <form METHOD="post">
        <div>
	  <input type="text" placeholder="Notice# or License Plate#">
        </div>
        <div class = "center">
          <button type="submit" name="violation_n" class="search_b">Search</button>
        </div>
    </form>
<?php include'../view/footer.php'; ?>
