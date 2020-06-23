<?php

namespace App\Controller;

use App\Entity\Suppliers;
use App\Form\SuppliersType;
use App\Repository\SuppliersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/suppliers")
 */
class SuppliersController extends AbstractController
{
    /**
     * @Route("/", name="suppliers_index", methods={"GET"})
     * @param SuppliersRepository $suppliersRepository
     * @return Response
     */
    public function index(SuppliersRepository $suppliersRepository): Response
    {
        return $this->render('suppliers/index.html.twig', [
            'suppliers' => $suppliersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="suppliers_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $supplier = new Suppliers();
        $form = $this->createForm(SuppliersType::class, $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($supplier);
            $entityManager->flush();

            return $this->redirectToRoute('suppliers_index');
        }

        return $this->render('suppliers/new.html.twig', [
            'supplier' => $supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="suppliers_show", methods={"GET"})
     */
    public function show(Suppliers $supplier): Response
    {
        return $this->render('suppliers/show.html.twig', [
            'supplier' => $supplier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="suppliers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Suppliers $supplier): Response
    {
        $form = $this->createForm(SuppliersType::class, $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('suppliers_index');
        }

        return $this->render('suppliers/edit.html.twig', [
            'supplier' => $supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="suppliers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Suppliers $supplier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supplier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($supplier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('suppliers_index');
    }
}
