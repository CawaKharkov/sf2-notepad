<?php

namespace Application\NotepadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class NotesController extends Controller
{
    /**
     * @Route("/notes", name="notes")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/notes/view", name="view_note")
     * @Template()
     */
    public function viewAction()
    {
    }

}
