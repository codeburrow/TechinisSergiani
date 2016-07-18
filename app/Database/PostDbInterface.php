<?php
namespace Kourtis\Database;

interface PostDbInterface
{
    public function getPost($urlName);

    public function getAllPosts();

    public function getPostFromID($id);
}