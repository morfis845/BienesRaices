<?php
namespace App;

class ActiveRecord{
    //**Base de datos**
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla  = '';
    //**Base de datos**
    //Errores
    protected static $errores = [];
    //Errores


    //Definir conexion base de datos
    public static function setDB($database){
        self::$db = $database;
    }
    public function guardar($carpeta){
        if(!is_null($this->id)){
            //Actualizar registro
            $this->actualizar($carpeta);
        }
        else{
            //Crear un nuevo registro
            $this->crear($carpeta);
        }
    }
    public function crear($carpeta){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        //Insertar en la base de datos
        $query = "INSERT INTO ".static::$tabla." (";
        $query .= join(', ',array_keys($atributos));
        $query .= " ) VALUES(' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ');";
        $resultado = self::$db->query($query);
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin/'. $carpeta .'/crear.php?resultado=1');
        }
    }
    public function actualizar($carpeta){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " .static::$tabla ." SET "; 
        $query .= join(', ', $valores);
        $query .= "WHERE id= '" . self::$db->escape_string($this->id) . "'";
        $query .= "LIMIT 1;";

        $resultado = self::$db->query($query);
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: '. $carpeta .'?resultado=2');
        }
    }
    //Eliminar un registro
    public function eliminar($carpeta){
        $query = "DELETE FROM " .static::$tabla. " WHERE id = " . self::$db->escape_string($this->id). " LIMIT 1;";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header('Location: '. $carpeta .'?resultado=3');
        }
    }
    //Identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    //Sanitiza los atributos antes de guardarlos en la BD
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    //Subida de archivos
    public function setImagen($imagen){
        //Elimina imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        //Asignar al atributo de imagen el nombre de la  imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }
    //Elimina el archivo
    public function borrarImagen(){
        //Comprovar si existe el archivo
        $existeArchivo =  file_exists(CARPETAS_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETAS_IMAGENES . $this->imagen);
        }
    }
    //Validacion
    public static function getErrores(){
        return static::$errores;
    }
    public function validar(){
        static::$errores = [];
        return static::$errores;
    }
    //Lista todos los registros
    public static function getAll(){
        $query = "SELECT * FROM ". static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //Obtiene registros con limite
    public static function get($cantidad){
        $query = "SELECT * FROM ". static::$tabla . " LIMIT ".$cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //Busca un registro por su id
    public static function find($id){
        $query = "SELECT * FROM ".static::$tabla." WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }
        //Liberar la memoria
        $resultado->free();
        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    //Sincroniza el objeto en memoria con los cambios realizados  por el usuario
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key)  && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}