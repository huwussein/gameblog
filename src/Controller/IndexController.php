<?php

namespace App\Controller;

use App\Repository\NieuwsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(NieuwsRepository $nieuwsRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'nieuws' => $nieuwsRepository->findAll(),
        ]);
    }}
