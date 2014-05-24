<?php

namespace Application\NotepadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AuthController extends Controller
{

    /**
     * @Route("/user/check", name="_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout/", name="_user_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/user/login", name="_user_login_page")
     * @Template()
     */
    public function loginPageAction(Request $request)
    {
        $loginForm = $this->get('form.factory')
                ->createNamedBuilder(null, 'form')
                 ->setAction($this->generateUrl('_security_check'))
                ->add('_username', 'text', ['required' => true, 'label' => 'Логин','attr' => ['class' => 'form-control input-lg',
                        'placeholder' => 'Ваш логин']])
                // ->add('name', 'text', ['required'=>true, 'attr'=>['class'=>'form-control', 'placeholder'=>'Ваш ник']])
                ->add('_password', 'password', ['required' => true, 'label' => 'Пароль', 'attr' => ['class' => 'form-control input-lg',
                        'placeholder' => 'Пароль']])
                ->add('login', 'submit', ['label' => 'Войти','attr' => ['class' => 'btn btn-primary btn-lg btn-block']])
                
                ->getForm();
        //['action' => $this->generateUrl('user_login_page')]);

        $loginForm->handleRequest($request);
        if ($loginForm->isValid()) {
          //  var_dump($loginForm->getData());
        }

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        return ['loginForm' => $loginForm->createView(),'error' => $error];
    }
  
}
