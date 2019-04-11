<?php
class iconexion{
	
	function iconexion()
	{
		$this->host = 'localhost';
		$this->db = 'dgr';
		$this->user = 'root';
		$this->pass = 'root';
	}
	
	function iconectar()
	{
	    $conexion = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
		if (!$conexion) 
		{  
			printf("Coneccion fallida de MySQLi: %s\n", mysqli_connect_error());   
			exit();
		}
    	//echo $mysqli->host_info . "\n";
		return $conexion;
	} 
	
	function idesconectar()
	{
		mysqli_close($this->iconectar());
	}
	function iresult($sql)
	{
		mysqli_free_result($sql);
	}
	//-------------------------------------------------- SELECT -------------------------------------------------------
	function iselect($sql,$bitacora = false)
	{
		/*
		$conn = $this->conectar();
		$result = $conn->prepare($sql);
		$result->execute();
		return $resultado;
		*/
		
		$resultado = mysqli_query($this->iconectar(),$sql) or die("<p style='background:white; color: red; padding:5px'>".mysqli_error()." <br> - <b>Consulta Select</b>: ".nl2br($sql)."</p>");
		return $resultado;
	}
	
	function iinsert($sql,$bitacora = true)
	{
		$resultado = mysqli_query($this->iconectar(),$sql) or die(mysqli_error()." <br> - <b>Consulta Insert</b>: ".nl2br($sql));
		return $resultado;
	}
	
	function iupdate($sql,$bitacora = true)
	{
		$resultado = mysqli_query($this->iconectar(),$sql) or die(mysqli_error()." <br> - <b>Consulta Update</b>: ".nl2br($sql));
		return $resultado;
	}
	
	function idelete($sql,$bitacora = true)
	{
		$resultado = mysqli_query($this->iconectar(),$sql) or die(mysqli_error()." <br> - <b>Consulta Delete</b>: ".nl2br($sql)); 
		return $resultado;
	}
}
?>