<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BlogController extends AbstractController
{
    /**
     * @Route("/", methods="GET", name="blog_index")
     */
    public function index(Request $request, PostRepository $postRepo): Response
    {
        $searchTerms = $request->query->get('q', '');
        $posts = $postRepo->findAllPosts(trim($searchTerms));
        return $this->render('blog/index.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/post/{slug}", methods="GET", name="blog_post")
     */
    public function show(Post $post): Response
    {
        return $this->render('blog/post_show.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/comment/{slug}/new", methods="POST", name="comment_new")
     */
    public function commentNew(Request $request, Post $post): Response
    {
        $comment = new Comment();
        $comment->setPublishedAt(new \DateTime('now'));
        $post->addComment($comment);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            //return $this->json(['message' => 'Added successfully', 'type' => 'success']);
            return $this->redirectToRoute('blog_post', ['slug' => $post->getSlug()]);
        }

        return $this->json(['message' => 'Comment should not be empty', 'type' => 'error']);
    }

    public function commentForm(Post $post): Response
    {
        $form = $this->createForm(CommentType::class);

        return $this->render('blog/_comment_form.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}
