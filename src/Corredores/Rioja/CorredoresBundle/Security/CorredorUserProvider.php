<?php
namespace Corredores\Rioja\CorredoresBundle\Security;
use Corredores\Rioja\CorredoresBundle\Security\CorredorUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Corredores\Rioja\CorredoresDomain\Repository\CorredorRepository;

class CorredorUserProvider implements UserProviderInterface{
    private $corredoresrepository;
    
    public function __construct(CorredorRepository $repository){
        //Inyectamoselrepositorio
        $this->corredoresrepository=$repository;
    }
    public function loadUserByUsername($username){
        //buscamoselusuario
        $userData=$this->corredoresrepository->buscaCorredor($username);
        //siexisteelcorredor,devolvemosunCorredorUserde
        //locontrariodevolvemosunaexcepción
        if($userData){
            $password=$userData->getPassword();
            $salt=$userData->getSalt();
            return new CorredorUser($username,$password,$salt);
        }
        
        throw new UsernameNotFoundException(
            sprintf('No existe un usuario con DNI "%s".',$username)
        );
    }
    //Ladefinicióndeestasdosfuncionesescasisiemprelamisma
    public function refreshUser(UserInterface $user){
        if(! $user instanceof CorredorUser){
            throw new UnsupportedUserException(
            sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
        return $this->loadUserByUsername($user->getUsername());
    }
    public function supportsClass($class){
        return $class === 'Corredores\Rioja\CorredoresBundle\Security\CorredorUser';
    }
}
