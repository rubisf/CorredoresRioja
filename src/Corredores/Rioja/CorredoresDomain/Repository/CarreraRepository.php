<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author ruben
 */

namespace Corredores\Rioja\CorredoresDomain\Repository;

use Corredores\Rioja\CorredoresDomain\Model\Carrera;
use Corredores\Rioja\CorredoresDomain\Model\Organizacion;


interface CarreraRepository {
    //put your code here
    function crearCarrera(Carrera $c);
    function actualizarCarrera(Carrera $c);
    function eliminarCarrera(Carrera $c);
    function buscarCarreraPorSlug($slug);
    function buscarCarreraDisputadaDeOrganizacion(Organizacion $o);
    function buscarCarreraPorDisputarDeOrganizacion(Organizacion $o);
    function buscarTodasCarreras();
    function buscarCarrerasDisputadas();
    function buscarCarrerasPorDisputar();
}
