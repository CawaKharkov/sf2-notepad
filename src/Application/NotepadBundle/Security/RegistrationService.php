<?php

namespace Application\NotepadBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of RegistrationService
 *
 * @author cawa
 */
class RegistrationService
{

    protected $em;
    protected $entity = 'Application\NotepadBundle\Entity\User';

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function registerUser(UserInterface $user)
    {
        $registration = $signupForm->getData();
        var_dump($signupForm->getData());
        die();
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($registration);
        $password = $encoder->encodePassword('ryanpass', $registration->getSalt());
        $registration->setPassword($password);
        $em->persist($registration);
        $em->flush();
    }

}
