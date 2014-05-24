<?php

namespace Application\NotepadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $blockRepo = $this->getDoctrine()->getManager()->getRepository('ApplicationNotepadBundle:NoteBlock');

        return ['notes' => $blockRepo->findAll()];
    }

}
