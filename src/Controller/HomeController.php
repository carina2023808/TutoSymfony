<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController 
{
    #[Route(path : '/', name: 'home')]
    public function index(Request $request): Response{
        //var_dump classic php
        // var_dump($request);
       // dump($request);//dump  e a version var_dump de symfony
        //die;
        // dd($request); //dd is a version of dump that stops the execution of the script utiliar essa version
        // return new Response("Hello ".$request->query->get("nom", "World !!!"));
        return $this->render('home/index.html.twig');
    }
}
