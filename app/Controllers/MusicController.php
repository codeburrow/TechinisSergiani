<?php
namespace Kourtis\Controllers;

use Kourtis\Database\DB;

class MusicController extends Controller
{
    protected $staticBlogRepo;
    
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function showAllPosts()
    {
        $myDB = new DB();

        $posts = $myDB->getAllPosts();

        echo $this->twig->render( 'post_list.twig', array('posts' => $posts) );

    }

    public function single_post()
    {
        $DB = new DB();

        $post = $DB->getPost($this->post);

        if ( !empty($post) ){
            $post = $post[0];

            echo $this->twig->render('single_post.twig', array('post' => $post));
        } else { //if no items found
            echo '404';
        }
    }

}