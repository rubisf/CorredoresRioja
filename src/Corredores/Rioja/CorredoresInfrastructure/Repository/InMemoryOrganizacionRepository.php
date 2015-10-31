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

use Corredores\Rioja\CorredoresDomain\Model\Organizacion;

class InMemoryOrganizacionRepository implements OrganizacionRepository{
    
    private $organizacion = array();
    
    //put your code here
    function __construct(){
        $this->registrarOrganizacion(new Organizacion());
    }
    
    function registrarOrganizacion(Organizacion $o){
        $this->organizacion[$o->getMail()] = $o;
    }
    function actualizarOrganizacion(Organizacion $o){
        $this->organizacion[$o->getMail()] = $o;
    }
    function eliminarOrganizacion(Organizacion $o){
        unset($this->organizacion[$o->getMail()]);
    }
    function buscarOrganizacionPorSlug($slug){
        $salida = array();
        
        foreach($this->organizacion as $o){
            if($o->getSlug($o->getMail())){
                return $o;
            }
        }
        
        return null;
    }
    function buscarOrganizacionPorMail($mail){
        return $this->organizacion[$o->getMail()];
    }
    function buscarTodasOrganizaciones(){
        return $this->organizacion;
    }
}
