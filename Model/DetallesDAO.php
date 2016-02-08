<?php

class DetallesDAO{

    private $costo_total = 0;
    private $arreglo;
    public function __construct() {
    
    }   
    
    public function agregar($codigo,$nombre,$cantidad,$costo){
        $producto = array("codigo"=>$codigo,"nombre"=>$nombre,"cantidad"=>$cantidad,"costo"=>$costo);
        $this->arreglo[] = $producto;
    }
    
    public function borrar($posicion){
        unset($this->arreglo[$posicion]);
    }
    
    public function mostrar(){
            return $this->arreglo; 
    }
    
    public function calculo_total(){
        foreach($this->arreglo as $array){
                $this->costo_total +=  $array['cantidad'] * $array['costo'];
        }
        return $this->costo_total;
    }

}
?>