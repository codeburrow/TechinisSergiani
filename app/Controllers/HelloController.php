<?php
namespace Kourtis\Controllers;

class HelloController
{

    public function __construct()
    {
    }

    public function hello()
    {
        include __DIR__ . '/../Views/index.twig';
    }
    
}