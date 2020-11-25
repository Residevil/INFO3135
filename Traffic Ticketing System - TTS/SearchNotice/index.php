<?php include'../view/header.php'; ?>
<body>
    <div class="center">
        <h1>Search for a Notice</h1>
        <h2>Please either enter your Notice # or your License Plate Number</h2>
    </div>
    <form METHOD="post" action = ../NoticeSummary/>
        <div class = "center">
                <h3>Notice# or License Plate#</h3>
	<input type="text" name="SearchNoticeBar" placeholder="Notice# or License Plate Number">
                
        </div>
        <div class = "center">
                <button type="submit" name="SearchNoticeButton">Search</button>
        </div>
    </form>
    
<?php include'../view/footer.php'; ?>
