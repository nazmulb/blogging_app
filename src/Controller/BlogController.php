<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class BlogController extends AbstractController
{
    /**
     * @Route("/", methods="GET", name="blog_index")
     */
    public function index(PostRepository $postRepo): Response
    {
        $posts = $postRepo->findAll();
        return $this->render('blog/index.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/post/{slug}", methods="GET", name="blog_post")
     */
    public function show(Post $post): Response
    {
        return $this->render('blog/post_show.html.twig', ['post' => $post]);
    }
}
