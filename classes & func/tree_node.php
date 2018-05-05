
<?php 

	/*START NODE CLASS */
	class Node 
	{
		public $element;
		public $parent;
		public $action;
		public $path_cost;
		public $depth;

		//CONSTRUCTOR
		public function __construct($element,$parent,$action,$path_cost,$depth){
			$this->element=$element;
			$this->parent=$parent;
			$this->action=$action;
			$this->path_cost=$path_cost;
			$this->depth=$depth;	
		}	

	}
	/*END NODE CLASS */
	
	/*START TREE CLASS */
	class Tree
	{
		public $root;
		public $target;
		public $nodenum=0;
		public $nodes=array();
		public $STATE =array();

		//build new node
		protected function Allocate_Node($self,$parent_key,$action,$path_cost,$depth){
			$node = new Node($self,$parent_key,$action,$path_cost,$depth);					
			$this->nodes[] = $node;														
			if ($this->nodenum == 0) 
				$this->root=$node;							
			$this->nodenum++;
		}	



		//search node in nodes field with name
		protected function Search_Node($goal_value){								
			foreach ($this->nodes as $key => $obj) {
				if ($obj->element==$goal_value) {
					return $key;
				}
			}
			return null;
		}

		
		//search node in nodes field with object
		protected function Search_Node_obj($goal_value){								
			foreach ($this->nodes as $key => $obj) {
				if ($obj==$goal_value) {
					return $key;
				}

			}
			return null;
		}


		//find index of state in STATE filed
		protected function Find_in_STATE($node_num,$element){								
			for ($i=0; $i < $node_num ; $i++) { 
				
					if ($this->STATE[$i]==$element) {
						return $i;	
					}	
				}
			return null;
		}

		//build tree with matrix for traverse
		public function martix_to_tree($matrix,$node_num,$root,$target){


			$node_queue = new SplQueue();
		
			$this->Allocate_Node($root,null,null,0,0);
			$this->target=$target;
		
			$node_queue->enqueue(0);
			$parent_node_ele=$this->root;
			$limit=$node_num*$node_num;
			
			$cycle=0;
			while (  sizeof($node_queue) &&  $limit>$cycle) {
				$target_node_index=$node_queue[0];
				$target_node=$this->nodes[$target_node_index]->element;
				$parent_row=$this->Find_in_STATE($node_num,$target_node); 
				$parent_node=$this->nodes[$target_node_index];	
				$child_depth=$parent_node->depth + 1;	
				for ($i=$parent_row*$node_num ; $i < ($parent_row+1)*$node_num  ; $i++ ) { 
					if ($matrix[$i]) {
						$child_node_ele=$this->STATE[$i%$node_num];
						$explode_index=explode(".",$matrix[$i]);
						$child_path_cost=$parent_node->path_cost + $explode_index[1];
						$this->Allocate_Node($child_node_ele,$target_node_index,null,$child_path_cost,$child_depth);
						$node_queue->enqueue( sizeof($this->nodes)-1);

					}

				}
				
				$node_queue->dequeue();		
				$cycle++;				
				}

		}


		//show path of traverse
		protected function come_back($target_node){
			$path=array();
			$parent_key=$target_node->parent;
			while (!is_null($parent_key)) {
				$path[]=$target_node->element;
				$target_node=$this->nodes[$parent_key];
				$parent_key=$target_node->parent;
			}
			$path[]=$target_node->element;
			$this->show_path($path);
		}

		//print path of traverse
		protected function show_path($path){

			for ($i=sizeof($path)-1; $i >= 0; $i--) { 
				if ($i==0)
					echo $path[$i];
				else
					echo $path[$i]."->";	
			}
			
		}

		//Breadth First Search
		public function BFS(){
				
			$node_queue = new SplQueue();
			$node_queue->enqueue($this->root);
		
			while (sizeof($node_queue) > 0) {
			
				$target_node=$node_queue->dequeue();
				$this->come_back($target_node);
				echo " (Path cost:".$target_node->path_cost;
				echo " -- Depth :".$target_node->depth.")";
				echo "<br>";
		
				if ($target_node->element==$this->target) {			
						echo "<br><br>-------<br><br>";
						echo "Result:<br>";
						$this->come_back($target_node);
						echo " (Path cost:".$target_node->path_cost;
						echo " -- Depth :".$target_node->depth.")";
						echo "<br>";
		
						break;
					}
				
				$target_key=$this->Search_Node_obj($target_node);
				
				foreach ($this->nodes as $key => $obj) {
					if ($obj->parent==$target_key && isset($obj->parent)) {
						$node_queue->enqueue($obj);
					}
				}
			
			}
		}

		//Depth First Search
		public function DFS(){
			
			$node_stack = new SplStack();
			$node_stack[]=$this->root;
			

			while (sizeof($node_stack) > 0) {
				$target_node=$node_stack->pop();
				$this->come_back($target_node);
				echo " (Path cost:".$target_node->path_cost;
				echo " -- Depth :".$target_node->depth.")";
				echo "<br>";
		
				if ($target_node->element==$this->target) {			
						echo "<br><br>-------<br><br>";
						echo "Result:<br>";
					
						$this->come_back($target_node);
						echo " (Path cost:".$target_node->path_cost;
						echo " -- Depth :".$target_node->depth.")";
						echo "<br>";
		
						break;
					}
			
				$target_key=$this->Search_Node($target_node->element);
				
				foreach ($this->nodes as $key => $obj) {
					if ($obj->parent==$target_key && isset($obj->parent)) {
						$node_stack->push($obj);
					}
				}

			}
		}
		//Iterative Deepening Search
		public function IDS($depth){
			
			$node_stack = new SplStack();
			$node_stack[]=$this->root;
			

			while (sizeof($node_stack) > 0) {
				$target_node=$node_stack->pop();
				$this->come_back($target_node);
				echo " (Path cost:".$target_node->path_cost;
				echo " -- Depth :".$target_node->depth.")";
				echo "<br>";
		
				if ($target_node->element==$this->target) {			
						echo "<br><br>-------<br><br>";
						echo "Result:<br>";
						
						$this->come_back($target_node);
						echo " (Path cost:".$target_node->path_cost;
						echo " -- Depth :".$target_node->depth.")";
						echo "<br>";
		
						break;
					}
			
				$target_key=$this->Search_Node($target_node->element);
				
				foreach ($this->nodes as $key => $obj) {
					if ($obj->parent==$target_key && isset($obj->parent) && $obj->depth<=$depth) {
						$node_stack->push($obj);
					}
				}

			}
		}		
	}
	/*END TREE CLASS */
	

?>

