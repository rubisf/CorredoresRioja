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

use Corredores\Rioja\CorredoresDomain\Model\Corredor;

interface CorredorRepository {
    //put your code here
    function registrarCorredor(Corredor $c);
    function actualizarCorredorInfo(Corredor $c);
    function eliminarCorredor(Corredor $c);
    function buscarCorredor($dni);
    function buscarTodosCorredores();
}
