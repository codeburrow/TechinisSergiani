<?php
namespace Kourtis\Database;

interface PostDbInterface
{
    public function getPostFromUrlName($urlName);

    public function getAllPosts();

    public function getPostFromID($id);
}