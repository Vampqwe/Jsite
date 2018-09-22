<?php
	
	class JFileManagementSystem {
		
		private $pathToFile;
		private $nameFile;
		private $openFile;
		
		public function setPathNameFile ($nameFile = "", $pathToFile = "") {
			$this->pathToFile = $pathToFile;
			$this->nameFile = $nameFile;
		}
		
		public function getPath () {
			$path = $this->pathToFile.$this->nameFile;
			return $path;
		}
		
		public function existPathFile () {
			if (!is_dir($this->pathToFile)) {
				return "ERROR_PATH";
			}elseif (!file_exists($this->getPath())) {
				return "ERROR_FILE";
			}elseif (!is_file($this->getPath())){
				return FALSE;
			}
		}
		public function createDir ($mode = 0777, $recursive = TRUE) {
			if (empty($this->pathToFile)) {
				return $this->pathToFile = "";
			}elseif (!mkdir($this->pathToFile,$mode,$recursive)){
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		public function getSizeFile () {
			return filesize($this->getFoolLinc());
		}
		
		public function getInfoFile () {
			return pathinfo($this->getFoolLinc());
		}
		
		public function getMimeType () {
			return mime_content_type($this->getFoolPath ());
		}
		
		public function getContentDir () {
			if (empty($this->pathToFile)) {
				return "";
			}else{
				$contentDir = scandir($this->pathToFile);
				array_shift($contentDir);
				array_shift($contentDir);
				return $contentDir;
			}
		}
		
		public function getModifiedMimeType () {
			$mimeTypeArr = [
			"application/xhtml+xml" => "XHTML",
			"application/zip" => "ZIP",
			"application/x-bittorrent" => "BitTorrent",
			"application/xml" => "XML",
			"application/x-rar-compressed" => "RAR",
			"application/x-rar" => "RAR",
			//Audio
			"audio/mp4" => "MP4",
			"audio/mpeg" => "MP3",
			"audio/x-ms-wma" => "WMA",
			"audio/vnd.wave" => "WAV",
			//Image
			"image/gif" => "GIF",
			"image/jpeg" => "JPEG",
			"image/pjpeg" => "JPEG",
			"image/png" => "PNG",
			//Text
			"text/css" => "CSS",
			"text/csv" => "CSV",
			"text/html" => "HTML",
			"text/javascript" => "JS",
			"text/plain" => "TXT",
			"text/php" => "PHP",
			"text/x-php" => "PHP",
			"text/xml" => "ExML",
			"text/cache-manifest" => "manifest",
			//Video
			"video/mpeg" => "MPEG-1",
			"video/mp4" => "MP4",
			"video/ogg" => "Ogg",
			"video/quicktime" => "QuickTime",
			"video/webm" => "WebM",
			"video/x-ms-wmv" => "WMV",
			"video/x-flv" => "FLV",
			"video/3gpp" => ".3gpp .3gp",
			"video/3gpp2" => ".3gpp2 .3g2"
			];
			if (!array_key_exists($this->getMimeType(), $mimeTypeArr)) {
				return FALSE;
			}else{
				return $mimeTypeArr[$this->getMimeType()];
			}
			
		}
		
		public function openFile ($mode) {
			return $this->openFile = fopen($this->pathToFile.$this->nameFile,$mode);
		}
		
		public function writeToFile ($str) {
			fwrite($this->openFile, $str);
		}
	}
	

	
	
	
	
	
	
	
	
?>