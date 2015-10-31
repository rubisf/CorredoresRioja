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
use Corredores\Rioja\CorredoresDomain\Model\Corredor;

interface ParticipanteRepository {
    //put your code here
    function inscribirParticipanteEnCarrera(Corredor $c,Carrera $d);
    function buscarParticipacionesDe(Corredor $c);
    function buscarParticipantesDeCarrera(Carrera $d);
    function buscarCarreraDisputadaDe(Corredor $c);
    function buscarCarrerasPorDisputarDe(Corredor $c);
    function comprobarInscripcionEnCarrera(Corredor $c, Carrera $d);
    function actualizarTiempoEnCarrera(Corredor $c, Carrera $d, long $s);
    function eliminarParticipacion(Corredor $c, Carrera $d);
    
}
