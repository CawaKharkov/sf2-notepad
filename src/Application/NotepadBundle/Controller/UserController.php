<?php

namespace Application\NotepadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Application\NotepadBundle\Entity\User;

class UserController extends Controller
{

    /**
     * @Route("/user/", name="user")
     * @Template()
     */
    public function viewAction(Request $request)
    {
        $loginForm = $this->createForm($this->get('notepad.form.login'));

        $loginForm->handleRequest($request);
        if ($loginForm->isValid()) {
            var_dump($loginForm->getData());
        }

        return ['loginForm' => $loginForm->createView()];
    }

    /**
     * @Route("/user/signup", name="user_signup")
     * @Template()
     */
    public function signupAction(Request $request)
    {
        $signupForm = $this->createForm('signup', null, ['action' => $this->generateUrl('user_create')]);

        $signupForm->handleRequest($request);
        if ($signupForm->isValid()) {
            var_dump($signupForm->getData());
            die();
        }

        return ['signupForm' => $signupForm->createView()];
    }

    /**
     * @Route("/user/create", name="user_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $signupForm = $this->createForm('signup', new User());

        $signupForm->handleRequest($request);
        $valid = false;
        if ($signupForm->isValid()) {
            $registration = $signupForm->getData();
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($registration);
            $password = $encoder->encodePassword('ryanpass', $registration->getSalt());
            $registration->setPassword($password);
            $em->persist($registration);
            $em->flush();
            $valid = true;
        }

        return $this->render(
                        'ApplicationNotepadBundle:User:signup.html.twig', [
    'signupForm' => $signupForm->createView(),
                            'valid' => $valid]
        );
    }

}
