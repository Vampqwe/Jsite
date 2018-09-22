<?php
	class JErrorManagementSystem {
		
		private $errorMsg;
		private $errorNamber;
		private $param;
		
		public function __construct () {
			
		}
		
		public function setNumberError ($numError, $param = NULL) {
			$this->param = $param;
			$this->errorNamber = $numError;

		}
		
		public function getNumberError () {
			return $this->errorNamber;

		}
		
		public function lackyMsg ($msg) {
			echo $msg;
			return TRUE;
		}
		
		public static function systemMSG ($msg, $file, $class, $method, $line) {
			echo "System Error:".$msg." <br> In file: "."*".$file.
					"*<br> In class: *".$class.
					"*<br> In method: *".$method.
					"*<br>In line: *".$line."*";
		}
		
		
		public function getErrorMsg () {
			
			switch ($this->errorNamber) {
				case "!_REGx0L_":
				echo $this->ErrorMsg = "Логин должен состоять из не менее ".$this->param."-ти символов!";
				break;
				
				case "!_REGx0P_":
				echo $this->errorMsg = "Пароль должен состоять из не менее ".$this->param."-ти символов!";
				break;
				
				case "!_REGx1P_":
				echo $this->errorMsg = "Пароли не совпадают!";
				break;
				
				case "!_REGx0M_":
				echo $this->errorMsg = "Почта не коректна!";
				break;
				
				case "!_REGDBx0_":
				echo $this->errorMsg = "Такой ник зарегестрирован!";
				break;
				
				case "!_AUTHx0L_":
				echo $this->ErrorMsg = "Пользователь с таким именем не найден";
				break;
				
				case "!_AUTHx1P_":
				echo $this->ErrorMsg = "Неверный пароль!";
				break;
				
				case "!_ADMxACCES_":
				echo $this->ErrorMsg = "Вы не администратор!";
				break;
				
				case "!_unknown_":
				echo $this->errorMsg = "Что то пошло не так тут ->".$this->param;
				break;

			}
		}
		
		public function dmp ($dmp = []) {
			if (empty($dmp)) {
				var_dump(FALSE);
			}else{
				var_dump($dmp);
			}
		}
		
		
		
		
	}
?>














