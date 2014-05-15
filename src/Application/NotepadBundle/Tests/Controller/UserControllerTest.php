<?php

namespace Application\NotepadBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/login');
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/');
    }

    public function testLogout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/logout');
    }

}
