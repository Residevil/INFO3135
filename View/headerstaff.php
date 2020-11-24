<!Doctype HTML>
<html>
	<header>
		<title>XYZ Traffic Enforcement</title>
		
		<h1>Staff</h1>
	
		<?php
        //get url
        $link = $_SERVER['REQUEST_URI'];
    
        //break down url into array using explode()
        $pieces = explode("/", $link);
    
        //populate link list
        echo "<table><tr>";
        for($i = 0; $i < count($pieces); $i++)
        {
            if($pieces[$i] != "")
            {
                echo '<td><a class="navi" href="';
            
                for($s = 0; $s <= $i; $s++)
                {
                    if($pieces[$s] != "")
                    echo "/" . $pieces[$s]; 
                }
            
                echo '">' . '  /  ' . urldecode($pieces[$i]) . '</a></td>';
            }
         }
         echo "</tr></table>";
    
        ?>
  
     </header>