<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\PodcastsDB;

class PodcastsAdminController extends AdminController
{
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function addPost(){
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('podcasts/addPodcastPost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function postAddPost(){
        //ToDo
    }

    public function editPost(){
        if ($this->adminIsLoggedIn()){

            $podcastsDB = new PodcastsDB();
            $posts = $podcastsDB->getAllPosts();

            echo $this->twig->render('podcasts/editPodcastPost.twig', array('posts'=>$posts));
        }
        else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postEditItem(){
        //ToDo
    }

    public function deletePost(){
        if ($this->adminIsLoggedIn()){

            $podcastsDB = new PodcastsDB();
            $posts = $podcastsDB->getAllPosts();

            echo $this->twig->render('podcasts/deletePodcastPost.twig', array('posts'=>$posts));
        }
        else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postDeleteItem(){
        //ToDo
    }

}