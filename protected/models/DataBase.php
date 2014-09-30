<?php


class DataBase {
	

	public static function guardar_usuario($dni, $name_surname, $address, $sexo ,$pass, $email, $descripcion, $newsletter, $codigo_verificacion) {
		
		$conection = Yii::app()->db;
		$table = 'usuarios';
		$dni = sha1($dni);
		$pass = sha1($pass);
		
		$descripcion = self::limpiar_datos($descripcion);
		$address = self::limpiar_datos($address);
		$name_surname = self::limpiar_datos($name_surname);
		$name_surname = ucwords($name_surname); // cadena a titulo
		
		$consulta = "INSERT INTO " . $table
					. "(id, dni, username, address, sexo, password, email,"
					. "description, newsletter, verification_code, active)"
					. " VALUES ('NULL', '$dni', '$name_surname', '$address',"
					. "'$sexo', '$pass', '$email', '$descripcion',"
					. "'$newsletter', '$codigo_verificacion', b'0');"; 
		
		$conection->createCommand($consulta)->execute();
		
				
	}
	
	/*
	 * @return false si el campo no esta disponible (osea que ya se encuentra registrado en la BD)
	 *	
	 * */
	public static function esta_disponible($campo, $valor) {
	
		$conection = Yii::app()->db;
		$table = 'usuarios';
		
		$sql = 'SELECT ' . $campo . ' FROM ' . $table . ' WHERE ' . $campo . '="' . $valor . '"';
				
		$result = $conection->createCommand($sql)->execute();
		
		//~ el campo ya está registrado
		if ($result)
			return false;
			
		//~ el campo está disponible
		else
			return true;
	
	}
	
	/*
	 * 
	 * @return campo solicitado de la BD a partir del DNI
	 * 
	 * */
	public static function get_campo($campo, $dni) {

		$conection = Yii::app()->db;
		$table = 'usuarios';
		
		$sql = 'SELECT ' . $campo . ' FROM ' . $table . ' WHERE dni="' . $dni . '"';
				
		$result = $conection->createCommand($sql);
		$filas = $result->query();
		
		foreach($filas as $fila)
			return $fila[$campo];
	}
	/* *
	 * 
	 * se setea el campo indicado con el valor ingresado segun el dni ingresado (todos son parametros)
	 * 
	 * */	
	public static function set_campo($dni, $campo, $valor) {
		
		//~ si dni no esta disponible, quiere decir que existen en la BD
		//~ por lo tanto es válido y se procede a setear el campo indicado
		if (!self::esta_disponible('dni', $dni)) {
			
			$conection = Yii::app()->db;
			$table = 'usuarios';
			
			$sql = "UPDATE ". $table ." SET ". $campo ."='". $valor ."' WHERE "
							. "dni='" . $dni . "'";
			
			$conection->createCommand($sql)->execute();	
	
		}
	}

	/* *
	 * 
	 * se setea la fecha de login segun el dni ingresado
	 * 
	 * */	
	private static function set_fecha_login($dni, $pass) {
		
		$dni = sha1($dni);
		//~ si dni no esta disponible, quiere decir que existen en la BD
		//~ por lo tanto es válido y se procede a setear el campo indicado
		if (!self::esta_disponible('dni', $dni)) {
			
			if (self::get_campo('password', $dni) === sha1($pass)) {
				
				$conection = Yii::app()->db;
				$table = 'usuarios';
				$fecha = date("Y-m-d");
				
				$sql = "UPDATE " . $table . " SET fecha_ultimo_login='" . $fecha . "' WHERE "
								 . "dni='" . $dni . "'";
				
				$conection->createCommand($sql)->execute();		
			}	
		}
	}

	
	/* *
	 * 
	 * @return query dni, pass
	 * 
	 * */
	public static function authenticate_get_query($dni, $password) {
		
		$conection = Yii::app()->db;
		$table = 'usuarios';
		
		$sql = "SELECT dni, password FROM " . $table
						. " WHERE dni='" . sha1($dni) . "' AND "
						. "password='" . sha1($password) . "' AND active=1";
		
		self::set_fecha_login($dni, $password);
		return $conection->createCommand($sql)->query();	
	
	
	}
	
	/* *
	 * 
	 * se activa la cuenta registrada en la BD siempre y cuando sea válida
	 * 
	 * */	
	public static function activar_cuenta($username, $verifyCode) {
		
		$username = self::limpiar_datos($username);
		$verifyCode = self::limpiar_datos($verifyCode);
		//~ si ningun campo esta disponible, quiere decir que existen en la BD
		//~ por lo tanto son datos válidos y se procede a activar la cuenta
		if (!self::esta_disponible('dni', $username) && !self::esta_disponible('verification_code', $verifyCode)) {
			
			$conection = Yii::app()->db;
			$table = 'usuarios';
			$fecha = date("Y-m-d");
			
			$sql = "UPDATE " . $table . " SET active=1, fecha_alta='" . $fecha . "' WHERE "
							 . "dni='" . $username . "' AND "
							 . "verification_code='" . $verifyCode . "'";
			
			$conection->createCommand($sql)->execute();	
	
		}
	}
	
	/*
	 * procesa la cadena input 
	 */
	private static function limpiar_datos($input) {
	   $input = trim($input);
	   $input = stripslashes($input);
	   $input = htmlspecialchars($input);
	   return $input;
	}
	
}



















?>
