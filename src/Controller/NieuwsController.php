<?php

namespace App\Controller;

use App\Entity\Nieuws;
use App\Form\NieuwsType;
use App\Repository\NieuwsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/nieuws")
 */
class NieuwsController extends AbstractController
{
    /**
     * @Route("/", name="nieuws_index", methods={"GET"})
     */
    public function index(NieuwsRepository $nieuwsRepository): Response
    {
        return $this->render('nieuws/index.html.twig', [
            'nieuws' => $nieuwsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nieuws_new", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function new(Request $request): Response
    {
        $nieuw = new Nieuws();
        $nieuw->setDatum(new \DateTime('now'));
        $form = $this->createForm(NieuwsType::class, $nieuw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nieuw);
            $entityManager->flush();

            return $this->redirectToRoute('nieuws_index');
        }

        return $this->render('nieuws/new.html.twig', [
            'nieuw' => $nieuw,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nieuws_show", methods={"GET"})
     */
    public function show(Nieuws $nieuw): Response
    {
        return $this->render('nieuws/show.html.twig', [
            'nieuw' => $nieuw,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nieuws_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function edit(Request $request, Nieuws $nieuw): Response
    {
        $form = $this->createForm(NieuwsType::class, $nieuw);
        $nieuw->setDatum(new \DateTime('now'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nieuws_index');
        }

        return $this->render('nieuws/edit.html.twig', [
            'nieuw' => $nieuw,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nieuws_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Nieuws $nieuw): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nieuw->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nieuw);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nieuws_index');
    }
}
