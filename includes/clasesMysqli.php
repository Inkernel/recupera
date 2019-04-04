<?php
class conexion{
	
	function conexion()
	{
		$this->host = 'localhost';
		$this->db = 'dgr2';
		$this->user = 'root';
		$this->pass = 'root';
	}
	
	function conectar()
	{
	    $conexion = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
		if (!$conexion) 
		{  
			printf("Coneccion fallida de MySQLi: %s\n", mysqli_connect_error());   
			exit();
		}
    	//echo $mysqli->host_info . "\n";
		else 
		{
			mysqli_query($conexion,"SET NAMES 'utf8'");
			return $conexion;
		}
	} 
	
	function desconectar()
	{
		mysqli_close($this->conectar());
	}
	function result($sql)
	{
		mysqli_free_result($sql);
	}
	//-------------------------------------------------- SELECT -------------------------------------------------------
	function select($sql,$bitacora = false)
	{
		/*
		$conn = $this->conectar();
		$result = $conn->prepare($sql);
		$result->execute();
		return $resultado;
		*/
		
		$resultado = mysqli_query($this->conectar(),$sql) or die("<p style='background:white; color: red; padding:5px'>".mysqli_error()." <br> - <b>Consulta Select</b>: ".nl2br($sql)."</p>");
		return $resultado;
	}
	
	function insert($sql,$bitacora = true)
	{
		$resultado = mysqli_query($this->conectar(),$sql) or die(mysqli_error()." <br> - <b>Consulta Insert</b>: ".nl2br($sql));
		return $resultado;
	}
	
	function update($sql,$bitacora = true)
	{
		$resultado = mysqli_query($this->conectar(),$sql) or die(mysqli_error()." <br> - <b>Consulta Update</b>: ".nl2br($sql));
		return $resultado;
	}
	
	function delete($sql,$bitacora = true)
	{
		$resultado = mysqli_query($this->conectar(),$sql) or die(mysqli_error()." <br> - <b>Consulta Delete</b>: ".nl2br($sql)); 
		return $resultado;
	}
}
?>