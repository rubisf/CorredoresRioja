<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Corredores\Rioja\CorredoresDomain\Model;
use Corredores\Rioja\CorredoresDomain\Model\Organizacion;

class Carrera{
    
    private $organizador;
    private $nombreCarrera;
    private $kms;
    private $imagen;
    private $descripcion;
    private $fechaRealizacion;
    private $inscripcionAbierta;
    private $clasificacion = array();
    private $slug;
    
    public function __construct(Organizacion $organizador,$nombreCarrera,$kms,$imagen,$descripcion,$fecha,$inscripcionAbierta){
        $this->organizador = $organizador;
        $this->nombreCarrera = $nombreCarrera;
        $this->kms = $kms;
        $this->imagen = $imagen;
        $this->descripcion = $descripcion;
        $this->fechaRealizacion = $fecha;
        $this->inscripcionAbierta = $inscripcionAbierta;
        $this->slug = $this->getSlug($this->nombreCarrera);
    }
    
    public function getClasificacion(){
        return $this->clasificacion;
    }
    
    public function setClasificacion($clasi){
        $this->clasificacion = $clasi;
    }
    
    public function getSlug2(){
        return $this->slug;
    }
    
    
    public function getInscripcionAbierta(){
        return $this->inscripcionAbierta;
    }
    
    public function getNombreCarrera(){
        return $this->nombreCarrera;
    }
    
    public function getOrganizador(){
        return $this->organizador;
    }
    
    public function getFechaRealizacion(){
        return $this->fechaRealizacion;
    }
    
    public function getImagen(){
        return $this->imagen;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function getkms(){
        return $this->kms;
    }
    
    public function __toString() {
        
        return "Nombre: ".$this->getNombreCarrera()."<br>";
    }
    
    
    static public function getSlug ( $cadena, $separador = '-') {
// Código copiado de http://cubiq.org/the-perfect-php-clean-url-generator
$slug = iconv ( 'UTF-8' , 'ASCII//TRANSLIT' , $cadena );
$slug = preg_replace ( "/[^a-zA-Z0-9\/_|+ -]/" , '' , $slug );
$slug = strtolower ( trim ( $slug , $separador ));
$slug = preg_replace ( "/[\/_|+ -]+/" , $separador , $slug );
return $slug;
}
}