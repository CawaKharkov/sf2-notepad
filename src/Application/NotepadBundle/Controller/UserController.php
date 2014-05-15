<?php

namespace Application\NotepadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{

    /**
     * @Route("", name="user_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $loginForm = $this->createForm($this->get('notepad.form.login'), null, ['action' => '/user/login']);

        $loginForm->handleRequest($request);
        if ($loginForm->isValid()) {
            var_dump($loginForm->getData());
        }

        return ['loginForm' => $loginForm->createView()];
    }

    /**
     * @Route("/user/login", name="user_login_page")
     * @Template()
     */
    public function loginPageAction(Request $request)
    {
        $loginForm = $this->createForm($this->get('notepad.form.login'), null, ['action' => $this->generateUrl('user_login_check')]);

        $loginForm->handleRequest($request);
        if ($loginForm->isValid()) {
            var_dump($loginForm->getData());
        }

        return ['loginForm' => $loginForm->createView()];
    }

    /**
     * @Route("/user/check", name="user_login_check")
     * @Template()
     */
    public function loginCheckAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }
        
        var_dump($error);
        die();

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
