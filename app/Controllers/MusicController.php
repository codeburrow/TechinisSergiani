<?php
namespace Kourtis\Controllers;

use Kourtis\Database\MusicDB;

class MusicController extends Controller
{
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function showAllPosts()
    {
        $musicDB = new MusicDB();

        $posts = $musicDB->getAllPosts();

        $sector = $this->data[1];

        echo $this->twig->render( 'post_list.twig', array('posts'=>$posts, 'sector'=>$sector) );
    }

    public function single_post()
    {
        $musicDB = new MusicDB();

        $post = $musicDB->getPost($this->post);

        if ( !empty($post) ){
            $post = $post[0];

            echo $this->twig->render('single_post.twig', array('post' => $post));
        } else { //if no items found
            echo '404';
        }
    }

}