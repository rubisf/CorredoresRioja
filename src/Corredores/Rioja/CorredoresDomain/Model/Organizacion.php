<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Organizacion
 *
 * @author ruben
 */

namespace Corredores\Rioja\CorredoresDomain\Model;


class Organizacion {
    //put your code here
    
    private $salt;
    
    private $nombreOrganizador;
    
    private $mail;
    
    
    function __construct($organizador){
        $this->salt = md5(time());
        $this->nombreOrganizador = $organizador;
    }
    
    function getNombreOrganizador(){
        return $this->nombreOrganizador;
    }
    
    function getMail(){
        return $this->mail;
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
