<?php require_once 'tree_node.php'; ?>
 
<?php 
        


/* for Auto build of page*/
function htmlbuilder(){
        
  if (isset($_GET['submit'])=="NEXT") {
    $num_string=array('One','Tow','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve','Thirteen','Fourteen','Fiveteen','Sixteen','Seventeen','Eightteen','Nineteen');
              
            
    //build page 2
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


    //build page 3  
    if ($_GET['submit']=="NEXT"  && isset($_GET['Step_two']) ) {
        $state_names=array();
        $state_number=$_GET['number'];
        $state_type=$_GET['type'];
              
        for ($i=0; $i < $state_number ; $i++) { 
          array_push($state_names, $_GET["state$i"]);
        } 
              
        echo "<form action=\"index.php\"><br><br><h3>Check Path:</h3>";
        
        if ($state_type=="direct") {
          for ($i=0; $i <sizeof($state_names) ; $i++) { 
            for ($j=0; $j <sizeof($state_names) ; $j++) { 
              if ($i != $j)
                echo  "<input type=\"checkbox\" name=\"$i$j\" value=\"1\"> ".$state_names[$i]." TO ".$state_names[$j]." <br>";  
              }
                  echo "<br>";
            }
          }

        if ($state_type=="non_direct") {
          for ($i=0; $i <sizeof($state_names) ; $i++) { 
            for ($j=0; $j <$i ; $j++) { 
              if ($i != $j)
                echo  "<input type=\"checkbox\" name=\"$i$j\" value=\"1\"> ".$state_names[$i]." AND ".$state_names[$j]." <br>"; 
              }
            echo "<br>";
          }
        }

        echo "<input type=\"hidden\" name=\"number\" value=\"".$state_number."\" required>";
      
        for ($i=0; $i < $state_number ; $i++)
          echo "<input type=\"hidden\" name=\"state$i\" value=\"$state_names[$i]\" required>";

        echo "<input type=\"hidden\" name=\"Step_three\" value=\"1\" required>";
        
        echo "<br>";
        echo "inital state : <select name=\"init_state\" required> ";
      
      for ($i=0; $i < $state_number ; $i++)
        echo "<option name=\"init_state\" value=\"$state_names[$i]\">$state_names[$i]</option>";
      echo "</select><br><br>";
      
      echo "final state : <select name=\"final_state\" required> ";
      
      for ($i=0; $i < $state_number ; $i++)
        echo "<option name=\"final_state\" value=\"$state_names[$i]\">$state_names[$i]</option>";
      echo "</select>";
        echo "<input type=\"hidden\" name=\"type\" value=\"".$state_type."\" required>";
        echo "<br><br><input type=\"submit\" name=\"submit\" value=\"NEXT\"></form>";
      }
            
      //build page 4
      if ($_GET['submit']=="NEXT" && isset($_GET['Step_three']) ) {
        $state_names=array();
        $state_number=$_GET['number'];
        $state_type=$_GET['type'];
      
        for ($i=0; $i < $state_number ; $i++)
          array_push($state_names, $_GET["state$i"]);
              
          echo "<form action=\"index.php\"><br><br><h3>Check Path:</h3>";
          for ($i=0; $i <sizeof($state_names) ; $i++) { 
            for ($j=0; $j <sizeof($state_names) ; $j++) {
              $z="$i";
              $z=$z."$j";
              if (isset( $_GET[$z] ))
                echo  "<input class=\"button_style\" type=\"number\" name=\"cost$i$j\" placeholder=\"Path cost ".$state_names[$i]." to ".$state_names[$j]." \" required>";
            }
          }
            
      echo "<input type=\"hidden\" name=\"number\" value=\"".$state_number."\" required>";
        echo "<input type=\"hidden\" name=\"Step_four\" value=\"1\" required>"; 
      
      for ($i=0; $i < $state_number ; $i++)
          echo "<input type=\"hidden\" name=\"state$i\" value=\"$state_names[$i]\" required>";
        
        echo "<input type=\"hidden\" name=\"init_state\" value=\"".$_GET['init_state']."\" required>";
        echo "<input type=\"hidden\" name=\"final_state\" value=\"".$_GET['final_state']."\" required>";
        echo "<input type=\"hidden\" name=\"type\" value=\"".$state_type."\" required>";
            
      echo "<br><br><input type=\"submit\" name=\"submit\" value=\"NEXT\"></form>";
    }
          
    //build page 5
    if ($_GET['submit']=="NEXT" && isset($_GET['Step_four']) ) {
        $state_names=array();
        global $matrix;
        $matrix=array();
      $state_number=$_GET['number'];
      $state_type=$_GET['type'];
        


      for ($i=0; $i < $state_number ; $i++)
        array_push($state_names, $_GET["state$i"]);
        
        
        for ($i=0; $i <sizeof($state_names) ; $i++) { 
          for ($j=0; $j <sizeof($state_names) ; $j++) {
            $z="$i";
            $z=$z."$j";
            if (isset( $_GET["cost".$z] ))
              array_push($matrix, "1.".$_GET["cost".$z]);
            else
              array_push($matrix, 0);     
          }
        }
        if ($state_type=="non_direct") {
          for ($i=0; $i <$state_number*$state_number ; $i++) { 
            if ($matrix[$i]) {
              $row=(int)($i/$state_number);
              $column=(int)($i%$state_number);
              $matrix[$row+($column*6)]=$matrix[$i];
            }
          }
        }


    } 
      
  }
  
    //build page 1     
    else{
    echo "<form action=\"index.php\">" ;
    echo "  <br><br>";
    echo "  <h3>Please specify the number of your nodes</h3>";
    echo "  <input type=\"number\" name=\"number\" placeholder=\"Number\" required>";
    echo "  <input type=\"radio\" name=\"type\" value=\"direct\" >Directed graph";
    echo "  <input type=\"radio\" name=\"type\" value=\"non_direct\"> Non-directional graph";
    echo "  <input type=\"hidden\" name=\"Step_one\" value=\"1\" required>";    
    echo "  <br><br>";
    echo "  <input type=\"submit\" name=\"submit\" value=\"NEXT\">";
    echo "</form>";
  }



}
?>