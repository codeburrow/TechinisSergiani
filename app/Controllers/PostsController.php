<?php
namespace Kourtis\Controllers;

use Kourtis\Repositories\StaticBlogRepo;

class PostsController extends Controller
{
    protected $staticBlogRepo;
    
    public function __construct()
    {
        parent::__construct();
        $this->staticBlogRepo = new StaticBlogRepo();
    }

    public function showAllPosts()
    {
        $posts = $this->staticBlogRepo->getAllPosts();

        echo $this->twig->render( 'post_list.twig', array('posts' => $posts) );
    }

    public function single_post()
    {
        echo $this->twig->render('single_post.twig');
    }

}