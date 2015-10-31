<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Corredor
 *
 * @author ruben
 */


namespace Corredores\Rioja\CorredoresDomain\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Corredor {
    //put your code here
    
    private $salt;
    /**
    *@Assert\NotBlank()
    */
    private $nombre;
    /**
    * @Assert\NotBlank()
    */
    private $apellido;
    
    private $apellido2;
    /**
    * @Assert\NotBlank()
    */
    private $fechaNacimiento;
    
    /**
    * @Assert\NotBlank()
    */
    private $club;
    
    /**
    * @Assert\NotBlank()
    */
    private $dni;
    
    /**
    * @Assert\NotBlank()
    */
    private $direccion;
    
    /**
    * @Assert\NotBlank()
    * @Assert\Email()
    */
    private $email;
    
    /**
    * @Assert\NotBlank()
    */
    private $password;

    
    function __construct($nombre,$apellido,$apellido2,$fechaNacimiento,$club,$dni,$direccion, $password,$email){
        $this->salt = md5(time());
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->apellido2 = $apellido2;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->club = $club;
        $this->dni = $dni;
        $this->direccion = $direccion;
        $this->password = $password;
    }
    
    function getDni(){
        return $this->dni;
    }
    
    function setDni($dni){
        $this->dni = $dni;
    }
    
    function getSalt(){
        return $this->salt;
    }
    
    function setSalt($salt){
        $this->salt = $salt;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function setPassword($dni){
        $this->password = $dni;
    }
    
    function getNombreCompleto(){
        return $this->nombre." ".$this->apellido." ".$this->apellido2;
    }
    
    
    function getClub(){
        return $this->club;
    }
    
    function setClub($dni){
        $this->club = $dni;
    }
    
    function getDireccion(){
        return $this->direccion;
    }
    
    function setDireccion($dni){
        $this->direccion = $dni;
    }
    
    function getFechaNacimiento(){
        $fecha = new \DateTime();
        $fecha->setTimestamp($this->fechaNacimiento);
        return  $fecha;
    }
    
    function setFechaNacimiento($dni){
        $this->fechaNacimiento = $dni;
    }
    
    function getNombre(){
        return $this->nombre;
    }
    
    function setNombre($dni){
        $this->nombre = $dni;
    }
    
    function getApellido(){
        return $this->apellido;
    }
    
    function setApellido($dni){
        $this->apellido = $dni;
    }
    
    function getApellido2(){
        return $this->apellido2;
    }
    
    function setApellido2($dni){
        $this->apellido2 = $dni;
    }
    
    function getEmail(){
        return $this->email;
    }
    
    function setEmail($dni){
        $this->email = $dni;
    }
    

    
    function __toString() {
        return $this->nombre." ".$this->apellido." ".$this->apellido2;
    }
    
    static public function getSlug ( $cadena , $separador = '-') {
        // Código copiado de http://cubiq.org/the-perfect-php-clean-url-generator
        $slug = iconv ( 'UTF-8' , 'ASCII//TRANSLIT' , $cadena );
        $slug = preg_replace ( "/[^a-zA-Z0-9\/_|+ -]/" , '' , $slug );
        $slug = strtolower ( trim ( $slug , $separador ));
        $slug = preg_replace ( "/[\/_|+ -]+/" , $separador , $slug );
        return $slug;
    }
}
