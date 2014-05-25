<?php

namespace Application\NotepadBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class for user registration methods
 * 
 * @author cawa
 */
class RegistrationService implements ContainerAwareInterface
{

    protected $em;
    protected $entity = 'Application\NotepadBundle\Entity\User';
    private $container;

    /**
     * Create RegistrationService and set em
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Inject DI Container
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * Create user
     * If $login == true, login
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @param bool $login
     */
    public function registerUser(UserInterface $user, $login = false)
    {
        $factory = $this->container->get('security.encoder_factory');

        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());

        $user->setPassword($password);

        $this->em->persist($user);
        $this->em->flush();

        if ($login) {
            $this->afterRegister($user);
        }
    }

    
    /**
     * Set security context
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     */
    protected function afterRegister(UserInterface $user)
    {
        $token = new UsernamePasswordToken($user, null, 'secured_area', $user->getRoles());
        $this->container->get('security.context')->setToken($token);
    }

}
