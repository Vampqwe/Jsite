<?php
/**
* class Db
* 
* Класс работы с базой данных!
* 
* @Vampqwe <Doktor_try@mail.ru>
* @version 0.0.1
* @copyright Copyright (c) 2018, Vampqwe
*/
try{
	
	class JDb {
		
		private $dbConnect;
		
		public function __construct () {
			$this->dbConnect();
		}
		
		private function dbConnect () {
			$this->dbConnect = new PDO (
                                DB_DSN,
                                DB_LOGIN,
                                DB_PASSWORD,
                                $DB_OPTION);
			return $this->dbConnect;
		}
		
		public function dbExec ($sql) {
			
			$r = $this->dbConnect->prepare($sql);
			return $r->execute();
			
		}
		
		public function dbQuery ($sql) {
			
			$exe = $this->dbConnect->prepare($sql);
			$exe->execute();
			$result = $exe->fetchAll();
			if ($result === false) {
				throw new Exception ("false query");
				return [];
			}
			return $result;
		}
	}
}catch(Exception $e) {
	echo $e->getMessage();
}