<?php

require_once('application/models/post_model.php');

class Posts_model extends Model
{

    private $insertPostSql = "INSERT
                        INTO
                        `blog_post`(
                            `post_title`,
                            `post_content`,
                            `post_created_by`,
                            `post_enabled`
                        )
                        VALUES( '{{post_name}}', '{{post_desc}}',  1, 1);";

    private $insertPostCategorySql = "INSERT INTO `blog_posts_categories`(`category_id`, `post_id`) VALUES ( {{parent}}, (SELECT id FROM blog_post WHERE post_title = '{{post_name}}'))";

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

        $query = "SELECT 
                        p.id,
                        p.post_title,
                        p.post_content,
                        p.post_created_on,
                        p.post_created_by,
                        p.post_edited_on,
                        p.post_edited_by,
                        u.user_nickname author,
                        COUNT(c.id) AS comments_count
                    FROM
                        blog_post p
                            LEFT JOIN
                        blog_user u ON p.post_created_by = u.id
                            AND u.user_active = TRUE
                            LEFT JOIN
                        blog_comment c ON p.id = c.id 
                            AND c.comment_enabled = TRUE
                    WHERE
                      p.post_enabled = TRUE 
                      ";


        if ($additional_conditions)
        {
            foreach ($additional_conditions as $condition)
            {
                $query .= $condition;
            }
        }
        $query .= " GROUP BY p.id;";

        $posts_info = $this->query($query);

        if ($posts_info)
        {
            foreach ($posts_info as $post_info)
            {
                $post = new Post();
                $post = $this->assign_post_fields($post, $post_info);

                // Changed original posts query
                //$post->comments_count = $this->getCommentsCount($post->id);
                $posts[] = $post;
            }
        }

        return $posts;
    }

    public function getPostById($id)
    {
        $post = new Post();

        $id = (int)$this->escapeString($id);

        $query = "SELECT 
                    p.*, 
                    u.user_nickname AS author 
                  FROM 
                    blog_post p, 
                    blog_user u 
                  WHERE 
                    p.id = %d 
                  AND 
                    p.post_created_by = u.id LIMIT 1;";
        $query = sprintf($query, $id);

        $result = $this->query($query);

        $post = $this->assign_post_fields($post, $result[0]);

        return $post;
    }

    private function assign_post_fields($post, $fields)
    {
        $post->id               = $fields->id;
        $post->title            = $fields->post_title;
        $post->content          = $fields->post_content;
        $post->created_by       = $fields->post_created_by;
        $post->created_on       = $fields->post_created_on;
        $post->edited_by        = $fields->post_edited_by;
        $post->edited_on        = $fields->post_edited_on;
        $post->author           = $fields->author;
        //$post->comments_count   = $fields->comments_count;

        return $post;
    }

    public function getAuthorNickname()
    {
        $query          = sprintf("SELECT user_nickname FROM blog_user WHERE id = %d LIMIT 1", $this->created_by);
        $result         = $this->query($query);
        $this->author   = $result[0]->user_nickname;
    }

    public function getCommentsCount($id)
    {
        $comments_count = 0;

        $query = "SELECT 
                    COUNT(id) AS comments_count 
                  FROM 
                    blog_comment 
                  WHERE 
                    comment_parent_post_id = %d 
                    AND comment_enabled = true;";
        $query = sprintf($query, $id);

        $comments_count_result = $this->query($query);
        if($comments_count_result)
        {
            $comments_count = $comments_count_result[0]->comments_count;
        }
        return $comments_count;
    }

    public function add_post($post_name, $post_desc, $parent) {

        $savePostSql = str_replace('{{post_name}}', $post_name, $this->insertPostSql);
        $savePostSql = str_replace('{{post_desc}}', $post_desc, $savePostSql);

        $savePostResult = $this->execute($savePostSql);
        
        $savePostCategory = str_replace('{{parent}}', $parent, $this->insertPostCategorySql);
        $savePostCategory = str_replace('{{post_name}}', $post_name, $savePostCategory);

        $savePostCategoryResult =  $this->execute($savePostCategory);

        return ($savePostResult && $savePostCategoryResult);
    }

}


?>