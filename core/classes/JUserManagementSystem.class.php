<?php
/**
 * Класс управляет объектом Пользователь
 * 
 * Авторизация, Регистрация, Идентифекация, Сессии...
 * 
 * 
 * Установка:
 * !===============WARNING====================!
 * !!
 * !==========================================!
 * @author Vampqwe <Doktor_try@mail.ru>
 * @version 1.0
 * @package JUserManagementSystem.php
 * @category class
 * @todo описание необходимых доработок
 * @example http://Doktor_try@mail.ru/example.php
 * @copyright Copyright (c) 2018, Coder BY
 */
	
	class JUserManagementSystem {
		
		private $userDt = ["login" => "Guest",
						"password" => "root",
						"passRpt" => "root",
						"mail" => "mail.ru",
						"coin" => 0,
						"acces" => 0];
		private $dbRslt;
		private $DB_EMS;
		private $FILE_EMS;
		
		public function __construct () {
			
			$this->DB_EMS = new JDb();
			$this->FILE_EMS = new JFileManagementSystem();
		}
		
		public function getPregRepDt() {
			return $this->userDt['login'] = preg_replace ("/[^a-zA-Z0-9\s]/","",$this->userDt['login']);
		}
		
		public function getSessionId () {
			return session_id();
		}
		
		
		public function startSession () {
			session_start();
			if (!$this->getSessStatus ()) {
			$_SESSION['login'] = $this->userDt['login'];
			$_SESSION['acces'] = $this->userDt['acces'];
			}
		}
		
		public function setSessionDt ($sessArr = []) {
			foreach ($sessArr as $key => $val) {
				$_SESSION[$key] = $val;
			}
		}
		
		public function getSession () {
			return $_SESSION;
		}
		
		public function getSessUserAcces () {
			return $_SESSION['acces'];
		}
		
		public function getSessStatus () {
			if (empty($this->getSession())) {
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		public function stopSession () {
			session_destroy();
		}
		
		public function getSessAccesName () {
			switch ($this->getSessUserAcces()) {
				case 1:
				return "Рядовой";
				break;
				
				case 2:
				return "Сержант";
				break;
				
				case 3:
				return "Прапорщик";
				break;
				
				case 4:
				return "Лейтенант";
				break;
				
				case 5:
				return "Майор";
				break;
				
				case 6:
				return "Маршал";
				break;
				
				default:
				return "Гость";
				break;
			}
		}
		
		public function passCompare () {
			if ($this->userDt['password'] != $this->userDt['passRpt']) {
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		public function getHashUserPass () {
			return $this->userDt['password'] = password_hash($this->userDt['password'],PASSWORD_DEFAULT);
		}
		
		public function verifyUserPass () {
			$sql = "SELECT `password` FROM `user` WHERE `login` = '".$this->userDt['login']."'";
			$this->dbRslt = $this->DB_EMS->dbQuery($sql);
			if (!password_verify($this->userDt['password'], $this->dbRslt[0]['password'])) {
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		public function getAllUserRsltDb () {
			$sql = "SELECT * FROM `user`";
			$this->dbRslt = $this->DB_EMS->dbQuery($sql);
			return $this->dbRslt;
		}
		
		public function getUserDbAcces () {
			$sql = "SELECT `acces` FROM `user` WHERE `login` = '".$this->userDt['login']."'";
			$this->dbRslt = $this->DB_EMS->dbQuery($sql);
			return $this->dbRslt;
		}
		public function getUser () {
			$sql = "SELECT `id`, `login`, `mail` FROM `user` 
				WHERE `login` = '".$this->userDt['login']."'";
			$this->dbRslt = $this->DB_EMS->dbQuery($sql);
			return $this->dbRslt;
		}
		
		public function setUserDt ($userDtArr = []) {
			$this->userDt = $userDtArr;
		}
		
		public function getUserDt () {
			return $this->userDt;
		}
		
		public function userExist () {
			$sql = "SELECT `id` FROM `user` WHERE `login` = '".$this->userDt['login']."'";
			$this->dbRslt = $this->DB_EMS->dbQuery($sql);
			if (empty($this->dbRslt)) {
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		public function authUser () {
			$sql = "SELECT `mail`, 
							`coin`,
							`ip`, 
							`datereg`, 
							`acces` FROM `user` WHERE `login` = '".$this->userDt['login']."'";
			$this->dbRslt = $this->DB_EMS->dbQuery($sql);
			$this->setSessionDt(["login" => $this->userDt['login'],
							"mail" => $this->dbRslt[0]['mail'],
							"coin" => $this->dbRslt[0]['coin'],
							"datereg" => $this->dbRslt[0]['datereg'],
							"ip" => $this->dbRslt[0]['ip'],
							"acces" => $this->dbRslt[0]['acces']]);
		
		}
		
		public function regUser () {
			$sql = "INSERT INTO `user` (`login`, `password`, `mail`, `coin`, `sessid`, `ip`, `datereg`, `acces`) 
			VALUES ('".$this->userDt['login']."', 
			'".$this->userDt['password']."', 
			'".$this->userDt['mail']."', 
			'".$this->userDt['coin']."', 
			'".$this->getSessionId()."', 
			'".JServer::getIpUser()."', 
			'".JHelper::getDate()."',
			'".ACCES_NEW_USER."'
			)";
			$this->dbRslt = $this->DB_EMS->dbExec($sql);
			if (!$this->dbRslt) {
				return FALSE;
			}else{
				$this->createDirUser();
				return TRUE;
			}
		}
		public function createDirUser () {
			$this->FILE_EMS->setPathNameFile("userConfig.txt",
										"user/". $this->userDt['login']."/");
			$this->FILE_EMS->createDir();
			$this->FILE_EMS->openFile("a");
			$this->FILE_EMS->writeToFile("<!-- Данный файл содержит конфигурацию пользователя!-->");
		}
	}
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
