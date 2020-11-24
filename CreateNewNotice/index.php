<?php include'../view/header.php'; ?>
<body>
    <h2>Enter all the information.</h2>
    <form METHOD="post">
        <div>
	  <input type="text" placeholder="Notice#">
          <input type="text" placeholder="License Plate Number">
	  <input type="text" placeholder="Driver's Name">
	  <input type="text" placeholder="Driver's Address">
	  <input type="text" placeholder="Violation Type">
	  <input type="text" placeholder="Fine Amount">
	  <input type="text" placeholder="Fine Due Date">
        </div>
        <div class = "center">
          <button type="submit" name="violation_n" class="search_b">Search</button>
        </div>
    </form>
<?php include'../view/footer.php'; ?>
