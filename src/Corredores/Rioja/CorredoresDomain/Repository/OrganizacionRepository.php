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
use Corredores\Rioja\CorredoresDomain\Model\Organizacion;

interface OrganizacionRepository {
    //put your code here
    
    function registrarOrganizacion(Organizacion $o);
    function actualizarOrganizacion(Organizacion $o);
    function eliminarOrganizacion(Organizacion $o);
    function buscarOrganizacionPorSlug($slug);
    function buscarOrganizacionPorMail($mail);
    function buscarTodasOrganizaciones();
}



