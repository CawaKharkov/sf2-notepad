<?php

namespace Application\NotepadBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\EntityManager;

/**
 * Description of UserProvider
 *
 * @author cawa
 */
class UserProvider implements UserProviderInterface
{

    protected $em;
    protected $entity = 'Application\NotepadBundle\Entity\User';

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function loadUserByUsername($username)
    {

        $query = $this->em->createQuery('SELECT u FROM Application\NotepadBundle\Entity\User u '
                . 'WHERE u.username = :username OR u.email = :email');
        $query->setParameters(['username' => $username, 'email' => $username]);

        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $user = $query->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf(
                    'Unable to find an active admin ApplicationNotepadByndle:User object identified by "%s".', $username
            );
            throw new UsernameNotFoundException($message, 0, $e);
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
            sprintf(
                    'Instances of "%s" are not supported.', $class
            )
            );
        }

        return $this->em->getRepository($this->entity)->find($user->getId());
    }

    public function supportsClass($class)
    {

        return $class === $this->entity;
    }

}
