<?php

namespace PF\HomesteadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PFHomesteadBundle:Default:index.html.twig', array('name' => $name));
    }
}
