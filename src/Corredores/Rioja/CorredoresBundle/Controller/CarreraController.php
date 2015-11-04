<?php

namespace Corredores\Rioja\CorredoresBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CarreraController extends Controller
{
    /*
public function mostrarTodasCarrerasAction()
{
    $carreras=$this->get('carrerarepository')->buscarTodasCarreras();
    $corredores=$this->get('corredorrepository')->buscarTodosCorredores();
    $participaciones=$this->get('participanterepository')->buscarParticipantesDeCarrera($carreras[0]);
    
    
    return new Response(implode("<br/>",$participaciones));
}*/

public function mostrarCarreraAction($slug){ 
    
    $carrera=$this->get('carrerarepository')->buscarCarreraPorSlug($slug);
    //PILLO LOS CORREDORES INSCRITOS
    $participantes=$this->get('participanterepository')->buscarParticipantesDeCarrera($carrera);
    

    usort($participantes, function ($a,$b){ 
        
                if ($a[2] == $b[2]) {
                return 0;
            }
            return ($a[2] > $b[2]) ? -1 : 1;
    });

    for($i=0;$i<sizeof($participantes);$i++){
        if(isset($participantes[$i][1]))
            $participantes[$i][1] = gmdate("H:i:s", (int)$participantes[$i][1]);
    }
    
    return $this->render( 'CorredoresRiojaCorredoresBundle:Corredores:carrera.htm.twig' , array ( 'carrera' => $carrera, 'participantes' => $participantes ));
}

public function mostrarTodasCarrerasAction(){ 
    
    $carreras=$this->get('carrerarepository')->buscarCarrerasPorDisputar();
    return $this->render( 'CorredoresRiojaCorredoresBundle:Corredores:carrerasBienvenido.htm.twig' , array ( 'carreras' => $carreras ));
}

public function mostrarCarrerasAction(){ 
    
    $carrerasD=$this->get('carrerarepository')->buscarCarrerasDisputadas();
    $carreras = $this->get('carrerarepository')->buscarCarrerasPorDisputar();
    return $this->render( 'CorredoresRiojaCorredoresBundle:Corredores:carreras.htm.twig' , array ( 'carreras' => $carreras, 'carrerasD' => $carrerasD ));
}

public function adminAction(){
    return new Response("Página de administración");
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

/*
public function login_checkAction(){   
    $userLogin = $this->get('corredores_user_provider')->loadUserByUsername($this->getRequest()->request->get('_username'));
    
    $user = $userLogin;
    $plainPassword=$this->getRequest()->request->get('_password');
    $encoder=$this->get('security.encoder_factory')->getEncoder($user);
    $encoded=$encoder->encodePassword($plainPassword,$user->getSalt());
    
    if($encoded == $user->getPassword()){
        return new Response("Puedes acceder al sistema");
    }

    return new Response("No puedes acceder al sistema ".$encoded." ".$user->getSalt());
    
}
*/
 

public function indexAction()
{

return new Response('Wellhithere'.$user->getFirstName());
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
        
        
        
                
        $form->handleRequest($peticion);
        
        /*
        
        $data = $peticion->request->all();

print("REQUEST DATA<br/>");
foreach ($data as $k => $d) {
    print("$k: <pre>"); print_r($d); print("</pre>");
}

$children = $form->all();

print("<br/>FORM CHILDREN<br/>");
foreach ($children as $ch) {
    print($ch->getName() . "<br/>");
}

$data = array_diff_key($data, $children);
//$data contains now extra fields

print("<br/>DIFF DATA<br/>");
foreach ($data as $k => $d) {
    print("$k: <pre>"); print_r($d); print("</pre>");
}
        
        */
        
        
        
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


