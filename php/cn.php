<?php
class Conexion
{

    public $servidor  = "localhost";
    public $usuario   = "root";
    public $password  = "";
    public $basedatos = "bdcomandas23";

    public $con;

    public function conectar()
    {
        $this->con = mysqli_connect($this->servidor, $this->usuario, $this->password, $this->basedatos);
        // Verifica si hubo error
        if ($this->con->connect_errno) {
            // Despliega mensaje de Error
            die("Error en Conexión :<br>" . $this->con->connect_error);
        }

        // Verifica conexion a BD
        if (!$this->con->select_db($this->basedatos))
            die("Error en Selección de Base de Datos :<br>" . $this->con->error);
    }
}
