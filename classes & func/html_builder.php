<?php require_once 'tree_node.php'; ?>
 
<?php 
  			



function htmlbuilder(){
  			
	if (isset($_GET['submit'])=="NEXT") {
		$num_string=array('One','Tow','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve','Thirteen','Fourteen','Fiveteen','Sixteen','Seventeen','Eightteen','Nineteen');
  						
  					

		if ($_GET['submit']=="NEXT" && isset($_GET['Step_one']) ) {
  			$state_number=$_GET['number'];
  			$state_type=$_GET['type'];
  			
  			echo "<form action=\"index.php\"><br><br><h3>Fill State names:</h3>";
  			
  			for ($i=0; $i <$state_number ; $i++)
  				echo "<input type=\"text\" name=\"state".$i."\" placeholder=\"state ".$num_string[$i]." \" required>";
  						
  			echo "<input type=\"hidden\" name=\"number\" value=\"".$state_number."\" required>";
  			echo "<input type=\"hidden\" name=\"type\" value=\"".$state_type."\" required>";
  			echo "<input type=\"hidden\" name=\"Step_two\" value=\"1\" required>";
  			
  			echo "<br><br><input type=\"submit\" name=\"submit\" value=\"NEXT\"></form>";
  		}

			
	}
  			
  	else{
		echo "<form action=\"index.php\">" ;
		echo "	<br><br>";
		echo "	<h3>Please specify the number of your nodes</h3>";
		echo "	<input type=\"number\" name=\"number\" placeholder=\"Number\" required>";
		echo "	<input type=\"radio\" name=\"type\" value=\"direct\" >Directed graph";
		echo "	<input type=\"radio\" name=\"type\" value=\"non_direct\"> Non-directional graph";
		echo "	<input type=\"hidden\" name=\"Step_one\" value=\"1\" required>";		
		echo "	<br><br>";
		echo "	<input type=\"submit\" name=\"submit\" value=\"NEXT\">";
		echo "</form>";
	}



}
?>