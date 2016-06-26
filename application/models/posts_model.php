<?php

require_once('/application/models/post_model.php');

class Posts extends Model
{

    public function __construct()
    {
        @parent::__construct();

        $id         = null;
        $title      = null;
        $content    = null;
        $created_by = null;
        $created_on = null;
        $edited_by  = null;
        $edited_on  = null;
        $author     = null;
    }

    public function getPosts($additional_conditions = null)
    {
        $posts = array();

        $query = "SELECT p.*, u.user_nickname author FROM blog_post p, blog_user u WHERE p.post_created_by = u.id ";

        if ($additional_conditions)
        {
            foreach ($additional_conditions as $condition)
            {
                $query .= $condition;
            }
        }
        $query .= ';';

        $results = $this->query($query);

        if ($results)
        {
            foreach ($results as $result)
            {
                $post = new Post();
                $post = $this->assign_post_fields($post, $result);
                $posts[] = $post;
            }
        }

        return $posts;
    }

    public function getPostById($id)
    {
        $post = new Post();

        $id = (int)$this->escapeString($id);
        $query = sprintf("SELECT p.*, u.user_nickname author FROM blog_post p, blog_user u WHERE p.id = %d AND p.post_created_by = u.id LIMIT 1", $id);
        $result = $this->query($query);

        $post = $this->assign_post_fields($post, $result[0]);

        return $post;
    }

    private function assign_post_fields($post, $fields)
    {
        $post->id         = $fields->id;
        $post->title      = $fields->post_title;
        $post->content    = $fields->post_content;
        $post->created_by = $fields->post_created_by;
        $post->created_on = $fields->post_created_on;
        $post->edited_by  = $fields->post_edited_by;
        $post->edited_on  = $fields->post_edited_on;
        $post->author     = $fields->author;

        return $post;
    }

    public function getAuthorNickname()
    {
        $query          = sprintf("SELECT user_nickname FROM blog_user WHERE id = %d LIMIT 1", $this->created_by);
        $result         = $this->query($query);
        $this->author   = $result[0]->user_nickname;
    }

}


?>