<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InMemoryCarreraRepository
 *
 * @author ruben
 */

namespace Corredores\Rioja\CorredoresInfrastructure\Repository;


use Corredores\Rioja\CorredoresDomain\Model\Carrera;
use Corredores\Rioja\CorredoresDomain\Model\Organizacion;
use Corredores\Rioja\CorredoresDomain\Repository\CarreraRepository;


class InMemoryCarreraRepository implements CarreraRepository{
    
    private $carrera = array();
    
    //put your code here
    function __construct(){
        $this->crearCarrera(new Carrera(new Organizacion("Organización1"),"Carrera de Matute","10","matutrail.jpg","Carrera técnica de montaña",time()-500,0));
        $this->crearCarrera(new Carrera(new Organizacion("Organización2"),"Carrera de Ledesma","5","entrevinedos.jpg","Carrera ",time()+500,1));
    
        
    }
    
    function crearCarrera(Carrera $c){
        $this->carrera[$c->getSlug($c->getNombreCarrera())] = $c;
    }
    
    function actualizarCarrera(Carrera $c){
        $this->carrera[$c->getSlug($c->getNombreCarrera())] = $c;
    }
    
    function eliminarCarrera(Carrera $c){
        unset($this->carrera[$c->getSlug($c->getNombreCarrera())]);
    }
    
    function buscarCarreraPorSlug($slug){
        $carrera = null;
        if (isset($this->carrera[$slug]))
            $carrera = $this->carrera[$slug];
        return $carrera;
    }
    
    function buscarCarreraDisputadaDeOrganizacion(Organizacion $o){
        $salida = array();
        foreach($this->carrera as $c){
            if($c->getOrganizador() == $o){
                if($c->getFechaRealizacion() < time())
                    $salida[] = $c;
            }
        }
        
        return $salida;
    }
    
    function buscarCarreraPorDisputarDeOrganizacion(Organizacion $o){
        $salida = array();
        foreach($this->carrera as $c){
            if($c->getOrganizador() == $o){
                if($c->getFechaRealizacion() > time())
                    $salida[] = $c;
            }
        }
        
        return $salida;
    }
    
    function buscarTodasCarreras(){
        $salida = array();
        foreach($this->carrera as $c){
            $salida[] = $c;
        }
        
        return $salida;
    }
    
    function buscarCarrerasDisputadas(){
        $salida = array();
        foreach($this->carrera as $c){
            if($c->getFechaRealizacion() < time())
                $salida[] = $c;
        }
        
        return $salida;
    }
    
    function buscarCarrerasPorDisputar(){
        $salida = array();
        foreach($this->carrera as $c){
            if($c->getFechaRealizacion() > time())
                $salida[] = $c;
        }
        
        return $salida;
    }
}
