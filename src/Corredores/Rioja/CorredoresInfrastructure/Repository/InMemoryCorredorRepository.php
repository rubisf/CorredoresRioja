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


use Corredores\Rioja\CorredoresDomain\Model\Corredor;
use Corredores\Rioja\CorredoresDomain\Repository\CorredorRepository;


class InMemoryCorredorRepository implements CorredorRepository {
    
    private $corredor = array();
    
    function __construct(){
        
        $c1 = new Corredor("Manolo","Perez","Rodriguez",time(),"Maraton Rioja","000000","Dir1","asdf","asdf@asdf.com");
        $c2 = new Corredor("Carlos","Casas","Rodriguez",time(),"Añares","1111111","Dir2","asdf","asdf@asdf.com");
        $c3 = new Corredor("Pepe","Saez","Rodriguez",time(),"Beronia","222222","Dir3","asdf","asdf@asdf.com");
        
        $salt='0df49b291afb4f39b348a849eba94a94';
        $pass='$2y$12$0df49b291afb4f39b348au6JsMTFP4nGJGMpS6YkgjQIyKQzYyt8q';
        $c1->setPassword($pass);
        $c1->setSalt($salt);
        
        $c2->setPassword($pass);
        $c2->setSalt($salt);
        
        $c3->setPassword($pass);
        $c3->setSalt($salt);
        
        
        $this->registrarCorredor($c1);
        $this->registrarCorredor($c2);
        $this->registrarCorredor($c3);

    }
    
    function getCorredorVacio(){
        return new Corredor("","","", null,"","","","","");
    }
    
    function registrarCorredor(Corredor $c){
        $this->corredor[$c->getDni()] = $c;
    }
    function actualizarCorredorInfo(Corredor $c){
        $this->corredor[$c->getDni()] = $c;
    }
    function eliminarCorredor(Corredor $c){
        unset($this->corredor[$c->getDni()]);
    }
    function buscarCorredor($dni){
        return $this->corredor[$dni];
    }
    function buscaCorredor($dni){
        if (isset ($this->corredor[$dni]))
            return $this->corredor[$dni];
        return false;
    }
    function buscarTodosCorredores(){
        $cor = array();
        foreach($this->corredor as $clave => $valor){
            $cor[]=$valor;
        }
        return $cor;
    }
}
