<!Doctype HTML>
<html>
	<header>
		<title>XYZ Traffic Enforcement</title>
	
		<?php
        
        $link = $_SERVER['REQUEST_URI'];
    
        
        $pieces = explode("/", $link);
    
        
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
            
                echo '">' . '  /  ' . $pieces[$i] . '</a></td>';
            }
         }
         echo "</tr></table>";
    
        ?>
  
     </header>