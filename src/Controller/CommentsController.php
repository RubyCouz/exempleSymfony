<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Products;
use App\Entity\User;
use App\Form\CommentsType;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comments")
 */
class CommentsController extends AbstractController
{
    /**
     * @Route("/", name="comments_index", methods={"GET"})
     * @param CommentsRepository $commentsRepository
     * @return Response
     */
    public function index(CommentsRepository $commentsRepository): Response
    {
        return $this->render('comments/index.html.twig', [
            'comments' => $commentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="comments_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $comment->setEditing(0);
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('comments_index');
        }

        return $this->render('comments/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comments_show", methods={"GET"})
     * @param Comments $comment
     * @return Response
     */
    public function show(Comments $comment): Response
    {
        return $this->render('comments/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/{id}/edit/{product}/{user}", name="comments_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Comments $comment
     * @param Products $product
     * @param User $user
     * @return Response
     */
    public function edit(Request $request, Comments $comment, Products $product, User $user): Response
    {
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
//            $date = new \DateTime();
//            $comment->setDateUpdate($date);
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('products_show', [
//                'id' => $product->getId(),
//                'user' => $user->getId(),
//            ]);
//        }

        return $this->render('comments/edit.html.twig', [
            'user' => $user->getId(),
            'product' => $product,
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/{user}/{product}", name="comments_delete", methods={"DELETE"})
     * @param Request $request
     * @param Comments $comment
     * @param Products $product
     * @param User $user
     * @return Response
     */
    public function delete(Request $request, Comments $comment, Products $product, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('products_show',
        [
            'id'=> $product->getId(),
            'user' => $user->getId()
        ]);
    }
}
