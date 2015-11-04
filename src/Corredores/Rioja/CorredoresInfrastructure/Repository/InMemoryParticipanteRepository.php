<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InMemoryParticipanteRepository
 *
 * @author ruben
 */

namespace Corredores\Rioja\CorredoresInfrastructure\Repository;

use Corredores\Rioja\CorredoresInfrastructure\Repository\InMemoryCarreraRepository;
use Corredores\Rioja\CorredoresInfrastructure\Repository\InMemoryCorredorRepository;
use Corredores\Rioja\CorredoresInfrastructure\Repository\InMemoryOrganizacionRepository;
use Corredores\Rioja\CorredoresDomain\Model\Carrera;
use Corredores\Rioja\CorredoresDomain\Model\Corredor;



class InMemoryParticipanteRepository {
    //put your code here
    
    private $listado = array();
    private $corredoresInst;
    private $carrerasInst;
    private $corredores;
    private $carreras;
    
    function __construct(){
        $this->corredoresInst = new InMemoryCorredorRepository();
        $this->corredores= $this->corredoresInst->buscarTodosCorredores();
        $this->carrerasInst = new InMemoryCarreraRepository();
        $this->carreras =$this->carrerasInst->buscarTodasCarreras();
        
        $this->inscribirParticipanteEnCarrera($this->corredores[0], $this->carreras[0]);
        $this->inscribirParticipanteEnCarrera($this->corredores[1], $this->carreras[0]);
        $this->inscribirParticipanteEnCarrera($this->corredores[1], $this->carreras[1]);
        
        $this->setTiempoEnCarrera($this->corredores[0], $this->carreras[0], 3708, 123);
        $this->setTiempoEnCarrera($this->corredores[1], $this->carreras[0], 2615, 123);
        
    }
    
    function setTiempoEnCarrera(Corredor $c,Carrera $d, $tiempo, $dorsal){
        $this->listado[$c->getDni()][$c->getSlug($d->getNombreCarrera())] = array($c, $tiempo, $dorsal);
    }
    
    function inscribirParticipanteEnCarrera(Corredor $c,Carrera $d){
        if(! isset ($this->listado[$c->getDni()])){
            $this->listado[$c->getDni()] = array();
        }
        $this->listado[$c->getDni()][$c->getSlug($d->getNombreCarrera())] = array($c);
    } 
    function buscarParticipacionesDe(Corredor $c){
        
    }
    function buscarParticipantesDeCarrera(Carrera $d){
        $lisparticipantes = array();
        
        foreach($this->listado as $dni=>$carreras){
            foreach($carreras as $slug=>$valor){
                if($d == $this->carrerasInst->buscarCarreraPorSlug($slug)) {
                    
                    $c = $this->corredoresInst->buscarCorredor($dni);
                    
                    
                    $lisparticipantes[] = $this->listado[$c->getDni()][$c->getSlug($d->getNombreCarrera())];
                }
            }
        }
        
        return $lisparticipantes;
    }
    function buscarCarreraDisputadaDe(Corredor $c){
        $carreras = array();
        
        foreach($this->listado[$c->getDni()] as $slug=>$valor){
            $car = $this->carrerasInst->buscarCarreraPorSlug($slug);
            if($car->getFechaRealizacion() < time()){
                $carreras[] = $car;
            }
        }
        
        return carreras;
    }
    function buscarCarrerasPorDisputarDe(Corredor $c){
        $carreras = array();
        
        foreach($this->listado[$c->getDni()] as $slug=>$valor){
            $car = $this->carrerasInst->buscarCarreraPorSlug($slug);
            if($car->getFechaRealizacion() > time()){
                $carreras[] = $car;
            }
        }
        
        return carreras;
    }
    function comprobarInscripcionEnCarrera(Corredor $c, Carrera $d){
        if (isset($this->listado[$c->getDni()][$c->getSlug($d->getNombreCarrera())])){
            return true;
        }
        
        return false;
    }
    function actualizarTiempoEnCarrera(Corredor $c, Carrera $d, long $s){
        $this->listado[$c->getDni()][$c->getSlug($d->getNombreCarrera())] = $s;
    }
    function eliminarParticipacion(Corredor $c, Carrera $d){
        unset($this->listado[$c->getDni()][$c->getSlug($d->getNombreCarrera())]);
    }
}
