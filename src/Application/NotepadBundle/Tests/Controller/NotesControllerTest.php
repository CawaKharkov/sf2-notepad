<?php

namespace Application\NotepadBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NotesControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/notes');
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/notes/view');
    }

}
