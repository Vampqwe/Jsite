<?php
	
	//class JFileMS extends JFileManagementSystem {

		private $pathDir;
		private $count;
		
		public function setPathNameFile($pathDir = [], $count = 0){
			$this->pathDir = $pathDir;
			$this->count = $count;
		}
		
		public function existPathFile () {
			if (!is_dir($this->pathDir)) {
				return "ERROR_PATH";
			}
		}
		
		public function createDir ($mode = 0777, $recursive = TRUE) {
			if (empty($this->pathDir)) {
				return $this->pathDir = "";
			}elseif (!mkdir($this->pathDir,$mode,$recursive)){
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		public function autoCreateMultipleDir () {
			if (!is_array($this->pathDir) or !is_integer($this->count)) {
				JErrorManagementSystem::systemMSG("Invalid input data type",
											__FILE__,__CLASS__,__METHOD__,__LINE__);
			}else{
				$countArr = count($this->pathDir);
				foreach ($this->pathDir as $key => $val) {
					if(!$this->existPathFile()) {
						$this->createDir($this->pathDir,$mode,$recursive);
					}else{
						echo "Path is Loaded!";
					}
					$this->pathDir++;
					if ($count == $countArr) {
						return FALSE;
					}
				}
			}
		}
	}
?>