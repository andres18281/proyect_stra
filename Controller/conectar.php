
<?php
 
 
/**
 * Clase para acceso a datos
 * @package dbAccess
 */

  class Conectar{
             
        //atributos
        public $host;
        public $user;
        public $pass; 
        private $mysqli;
        public $db;
	      public $array = array();
        public function __construct(){
           //  $this->host = "localhost";//"190.84.233.180";
            // $this->user = "root";
           ///  $this->pass = "123456";
          //   $this->db = "stratecsa%%";
               
          //$this->mbd = new PDO('mysql:host=127.0.0.1;dbname=stra_stra_stratecsa_serve;port=3306', 'stra_user_factur', 'NTfLK,x7FQ6H');
          $this->mbd = new PDO('mysql:host=127.0.0.1;dbname=stratecsa%%;port=3306', 'root', '123456');
            
        }

      function inserta($tablas,$params = array()){
        $inserta = 'INSERT INTO `'.$tablas.'` (`'.implode('`, `',array_keys($params)).'`) VALUES ("' . implode('", "', $params) . '")';
        echo $inserta;
        $sentencia = $this->mbd->prepare($inserta);
        $dato = $sentencia->execute();
        $response = $sentencia->fetch(PDO::FETCH_ASSOC);
        if(isset($response)){
          $array = array("exito"=>"Insercion con exito",
                        "last_cod_id"=>$this->mbd->lastInsertId(),
                        "mensaje"=>"Si inserto");
        }else if($response == false){
          $array = array("error"=>$this->mbd->errorInfo());
        }
        return $array;
      }


      function consultas($sql){
        $data = $this->mbd->prepare($sql);
        $data->execute();
        $num = $data->rowCount();
        if($num > 1){
          $result = $data->fetchAll(PDO::FETCH_ASSOC); 
        }else{
          $result = $data->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
      }


      public function update_query($query){
        $stmt = $this->mbd->prepare($query); 
        $stmt->execute();
        $response = $stmt->fetch(PDO::FETCH_BOTH);
        if(isset($response)){
          $salida = array("exito"=>"Actualizacion con exito","last_cod_id"=>$this->mbd->lastInsertId());                     
        }else{
          $salida = array("error"=>"Problemas, no hay actualizacion",
                        "codigo"=>$response['errorInfo']);
        }
        return $salida;    
      }


      public function insert_update($table,$params){
        $values = '';
        $query = 'INSERT INTO `'.$table.'`(`'.implode('`, `',array_keys($params)).'`) VALUES ("' . implode('", "', $params) . '")';
        foreach ($params as $key => $value) {       
          $values .= $key.'="'.$value.'",';       
        }
        $values = substr($values, 0,strlen($values)-1);
        $query = $query.' ON DUPLICATE KEY UPDATE '.$values;
        $stmt = $this->mbd->prepare($query); 
        $stmt->execute();
        $response = $stmt->fetch(PDO::FETCH_BOTH);
        if(isset($response)){
          $salida = array("exito"=>"Actualizacion con exito","last_cod_id"=>$this->mbd->lastInsertId());                     
        }else{
          $salida = array("error"=>"Problemas, no hay actualizacion",
                        "codigo"=>$response['errorInfo']);
        }
      }




        


}


 
?>
























 