<?php

namespace Application\NotepadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{

    /**
     * @Route("/user/login", name="user_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $loginForm = $this->createForm($this->get('notepad.form.login'));

        $loginForm->handleRequest($request);
        if ($loginForm->isValid()) {
            var_dump($loginForm->getData());
        }

        return ['loginForm' => $loginForm->createView()];
    }

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
     * @Route("/user/logout", name="user_logout")
     * @Template()
     */
    public function logoutAction()
    {
        return [];
    }

}
