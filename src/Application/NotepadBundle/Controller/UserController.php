<?php

namespace Application\NotepadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Application\NotepadBundle\Entity\User;

class UserController extends Controller
{

    /**
     * @Route("/user/signup", name="user_signup")
     * @Template()
     */
    public function signupAction(Request $request)
    {
        $signupForm = $this->createForm('signup', new User());
        $signupForm->handleRequest($request);

        $isCreated = false;
        if ($signupForm->isValid()) {
            $this->get('application_notepad.security.registration')->registerUser($signupForm->getData(),true);
            $isCreated = true;
        }

        return $isCreated
                ? $this->redirect($this->generateUrl('home'))
                : ['signupForm' => $signupForm->createView()];
    }

}
