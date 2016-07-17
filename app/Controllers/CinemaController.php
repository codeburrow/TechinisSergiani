<?php
namespace Kourtis\Controllers;

use Kourtis\Database\DB;

class CinemaController extends Controller
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

        $sector = $this->data[1];
        
        echo $this->twig->render( 'post_list.twig', array('posts'=>$posts, 'sector'=>$sector) );
    }

    public function single_post()
    {
        $DB = new DB();

        var_dump($this->post);

        $post = $DB->getPost($this->post);

        if ( !empty($post) ){
            $post = $post[0];

            echo $this->twig->render('single_post.twig', array('post' => $post));
        } else { //if no items found
            echo '404';
        }
    }

    public function test()
    {
        /** Create urlName for New Posts */

        $myDB = new DB();

        var_dump($this->data);

        $post = $myDB->getPostFromID($this->data[2]);

        var_dump($post);

        $explodeResult = explode(' ', $post['title']);

        var_dump($explodeResult);

        $implodeResult = implode('-', $explodeResult);

        var_dump($implodeResult);
    }

}