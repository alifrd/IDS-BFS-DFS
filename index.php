 <?php require_once './classes & func/tree_node.php'; ?>
 <?php require_once './classes & func/html_builder.php'; ?>
 <!-- ALI FRD-->
 <html>
	
	<head>
		<title>AI</title>
		<meta charset="UTF-8">
	
		<link rel="stylesheet" type="text/css" href="style/main.css">
	</head>
	

	<body>
		
		<!-- START HEADER -->	
		<header>
			<h2>BFS & DFS & IDS</h2>		
		</header>
		<!-- END HEADER -->
		

		<!-- START MAIN -->
		<main class="help">
			
			
  			


  			<?php 
  				htmlbuilder();

  				if (isset($_GET["Step_four"])) {
	  				$tree1 = new Tree();
	  				$root=$_GET["init_state"];
					$nodenum=$_GET["number"];
					$target=$_GET["final_state"];
					$type=$_GET["type"];
					for ($i=0; $i < $nodenum ; $i++) { 
		  				array_push($tree1->STATE, $_GET["state$i"]);
		  			}	
		  				$tree1->martix_to_tree($matrix,$nodenum,$root,$target);	
  						

  					}
  			?>

  			
	
			<div class="divsion">
					<?php
					if (isset($_GET["Step_four"])) {
						echo "BFS:<br>";
						$tree1->BFS();
					}
					?>
			</div>
			<div class="divsion">
					<?php 
					if (isset($_GET["Step_four"])) {
						echo "DFS:<br>";
						$tree1->DFS();
					}	
					?>
			</div>
			<div class="divsion">
					<?php 
					if (isset($_GET["Step_four"])) {
						echo "IDS:<br>";
						$tree1->IDS(2);
					}	
					?>
			</div>

			<pre>
				<?php 
				//print_r($tree1->nodes);
				 ?>
			</pre>

			<br><br><br><br>
			<br><br><br><br>
			<br><br><br><br>
			<br><br><br><br>
			<br><br><br><br>
			<br><br><br><br>
			<br><br><br><br>
			<br><br><br><br>
			<br><br><br><br>
			<br><br><br><br>
					

		</main>
		<!-- END MAIN-->
		
		<a class="link" href="index.php">STEP ONE</a>
		
		
	
	</body>

</html>	
