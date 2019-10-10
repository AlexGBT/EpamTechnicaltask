<?php

namespace Controllers;


use View\View;

abstract class AbstractController
{
    protected $view;


    public function __construct()
    {
         $this->view = new View(__DIR__ . '/../templates');
    }
}