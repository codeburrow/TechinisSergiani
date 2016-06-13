<?php
namespace Kourtis\Controllers;

class PostsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function showAllPosts()
    {
        echo $this->twig->render('post_list.twig');
    }

    public function single_post()
    {
        echo $this->twig->render('single_post.twig');
    }

}