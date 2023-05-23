<?php

class PostsRepository
{
    public static function all(Database $db)
    {
        $query = 'select * from V_AllPosts;';

        $posts = $db->query($query)->all();

        $posts = array_map(function($post){
            $post['post_categories'] = json_decode($post['post_categories'], true);
            return $post;
        }, $posts);

        return $posts;
    }

    public static function get(Database $db, string $slug)
    {
        $query = 'select * from posts where slug = :slug';

        return $db->query($query, compact('slug'))->findOrFail();
    }
}
