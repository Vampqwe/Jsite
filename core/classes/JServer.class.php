<?php
	class JServer {
		
		private static $method;
		private static $inputPostArr;
		private static $inputGetArr;
		private static $inputGet;
		private static $inputPost;
		private static $selfPage;
		private static $queryStr;
		private static $pathPageScript;
		
		public static function getMethod () {
			self::$method = filter_input(INPUT_SERVER,"REQUEST_METHOD");
			return self::$method;
		}
		
		public static function getPostArr ($arr = []) {
			self::$inputPostArr = filter_input_array(INPUT_POST, $arr);
			return self::$inputPostArr;
		}
		
		public static function getGetArr ($arr = []) {
			self::$inputGetArr = filter_input_array(INPUT_GET, $arr);
			return self::$inputGetArr;
		}
		
		public static function inputPost ($post) {
			self::$inputPost = filter_input(INPUT_POST, $post);
			return self::$inputPost;
		}
		
		public static function inputGet ($get) {
			self::$inputGet = filter_input(INPUT_GET, $get);
			return self::$inputGet;
		}
		
		public static function getIpUser () {
			return filter_input(INPUT_SERVER,"REMOTE_ADDR",FILTER_VALIDATE_IP);
		}
		
		public static function getSelfPage () {
			self::$selfPage = filter_input(INPUT_SERVER,"PHP_SELF");
			return self::$selfPage;
		}
		
		public static function getQueryStr () {
			self::$queryStr = filter_input(INPUT_SERVER,"QUERY_STRING");
			return self::$queryStr;
		}
		
		public static function getPageScript () {
			self::$pathPageScript = filter_input(INPUT_SERVER, "REQUEST_URI");
			return self::$pathPageScript;
		}
	}