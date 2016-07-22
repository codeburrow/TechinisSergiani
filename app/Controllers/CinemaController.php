<?php
namespace Kourtis\Controllers;

use Kourtis\Database\CinemaDB;

class CinemaController extends Controller
{
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function showAllPosts()
    {
        $cinemaDB = new CinemaDB();

        $posts = $cinemaDB->getAllPosts();

        $sector = $this->sector;
        
        echo $this->twig->render( 'post_list.twig', array('posts'=>$posts, 'sector'=>$sector) );
    }

    public function single_post()
    {
        $sector = $this->sector;

        $cinemaDB = new CinemaDB();
        
        $post = $cinemaDB->getPostFromUrlName($this->post);

        if ( !empty($post) ){
            $post = $post[0];

            echo $this->twig->render('single_post.twig', array('post' => $post, 'sector'=>$sector));
        } else { //if no items found
            echo '404';
        }
    }

}