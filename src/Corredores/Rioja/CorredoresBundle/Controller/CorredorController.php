<?php

namespace Corredores\Rioja\CorredoresBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CorredorController extends Controller
{

public function mostrarMisCarrerasAction(){ 
    
    //Capturo el usuario actual
    $user=$this->get('security.token_storage')->getToken()->getUser();
    
    $corredor = $this->get('corredorrepository')->buscarCorredor($user->getUsername());

    $carreras =  $this->get('participanterepository')->buscarCarrerasPorDisputarDe($corredor);
    $carrerasD =  $this->get('participanterepository')->buscarCarrerasDisputadasDe($corredor);

    return $this->render( 'CorredoresRiojaCorredoresBundle:Corredores:carreras.htm.twig' , array ( 'carreras' => $carreras, 'carrerasD' => $carrerasD ));
}

public function loginAction()
{
    $authenticationUtils=$this->get('security.authentication_utils');
    //gettheloginerrorifthereisone
    $error=$authenticationUtils->getLastAuthenticationError();
    //lastusernameenteredbytheuser
    $lastUsername=$authenticationUtils->getLastUsername();
    return $this->render(
        'CorredoresRiojaCorredoresBundle:Security:login.htm.twig',
        array(
            //lastusernameenteredbytheuser
            'last_username'=>$lastUsername,
            'error' =>$error,
        )
    );
}

public function registerAction(){
    
        $corredor=$this->get('corredorrepository')->getCorredorVacio();
        
        $form = $this->createFormBuilder($corredor)//Creamoselconstructordeformulario
        //Añadimoslosdistintoscamposdelformulario
        ->add('nombre','text')
        ->add('apellido','text')
        ->add('apellido2','text')
        ->add('email','email')
        ->add('fechaNacimiento','date')
        ->add('club','text')
        ->add('dni','text')
        ->add('direccion','text')
        ->add('password','password')
        //Añadimoselbotóndeenviar
        ->add('enviar','submit',array('label'=>'Enviar'))
        //Finalmenteobtenemoselformulario
        ->getForm();

        
        return $this->render("CorredoresRiojaCorredoresBundle:Security:register_user.htm.twig",array('formulario'=>$form->createView()));
    }
    
    function registerValidateAction(){

        $corredor=$this->get('corredorrepository')->getCorredorVacio();
        $peticion=$this->getRequest();
        $form=$this->createFormBuilder($corredor)
        //Añadimoslosdistintoscamposdelformulario
        ->add('nombre','text')->add('apellido','text')->add('apellido2','text')
        ->add('email','email')->add('fechaNacimiento','date')->add('club','text')
        ->add('dni','text')->add('direccion','text')->add('password','password')
        //Añadimoselbotóndeenviar
        ->add('enviar','submit',array('label'=>'Enviar'))
        //Finalmenteobtenemoselformulario
        ->getForm();    
        $form->handleRequest($peticion);
        
        if($form->isValid()){
            //Encripto la contraseña:
            //Le encripto la contraseña
            
            $user = $corredor;
            $plainPassword=$user->getPassword();
            $encoder=$this->get('security.encoder_factory')->getEncoder($user);
            $encoded=$encoder->encodePassword($plainPassword,$user->getSalt());
            $user->setPassword($encoded);
            //LO AÑADO A MEMORIA
            $this->get('corredorrepository')->registrarCorredor($corredor);
            return $this->render("CorredoresRiojaCorredoresBundle:Security:registerOk.htm.twig",array('corredor'=>$corredor));
        }
        return $this->render("CorredoresRiojaCorredoresBundle:Security:register_user.htm.twig",array('formulario'=>$form->createView()));
}

}


