<?php
	
	class JRoute {
		
		private $pathArr;
		
		public function __construct () {
			
		}
		
		public function setPathLink ($pathArr=[]) {
			foreach ($pathArr as $key => $val) {
				$this->pathArr[$key] = $val;
			}
		}
		
		public function getPathArr () {
			return $this->pathArr;
		}
		
		public function getLinc ($name) {
			if(array_key_exists($name, $this->pathArr)) {
				echo "<a href = '".$this->pathArr[$name]."'>$name</a>";
			}else{
				return FALSE;
			}	
		}
	}
?>