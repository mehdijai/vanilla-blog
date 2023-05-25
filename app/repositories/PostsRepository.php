<?php

namespace App\Repositories;

use App\Core\Database;

class PostsRepository
{
    public static function all(Database $db)
    {
        $query = 'select * from V_AllPosts;';

        $posts = $db->query($query)->all();

        $posts = array_map(function ($post) {
            $post['post_categories'] = json_decode($post['post_categories'], true);
            return $post;
        }, $posts);

        return $posts;
    }

    public static function get(Database $db, string $slug)
    {
        $query = "SELECT
                    posts.*,
                    authors.name AS author,
                    authors.slug AS author_slug,
                    authors.profile_picture AS profile_picture,
                    IF(COUNT(categories.title) = 0, '[]', JSON_ARRAYAGG(JSON_OBJECT('title', categories.title, 'slug', categories.slug))) AS post_categories
                FROM
                    posts
                    INNER JOIN authors ON posts.author_id = authors.id
                    LEFT JOIN category_post ON posts.id = category_post.post_id
                    LEFT JOIN categories ON category_post.category_id = categories.id
                WHERE
                    posts.draft = 0 AND
                    posts.slug = :slug;";

        $post = $db->query($query, compact('slug'))->findOrFail();

        $post['post_categories'] = json_decode($post['post_categories'], true);

        return $post;
    }

    public static function store(Database $db, array $data)
    {
        $data['draft'] = (int)$data['draft'];
        $query = 'insert into posts 
                (author_id, title, body, description, thumbnail, slug, module_id, draft) 
                values 
                (:author_id, :title, :body, :description, :thumbnail, :slug, :module_id, :draft);';

        $db->query($query, $data);
    }

    public static function delete(Database $db, array $data)
    {
        $query = 'delete from posts where id = :id';

        $db->query($query, $data);
    }

    public static function updateDraftState(Database $db, array $data)
    {
        $data['draft'] = (int)$data['draft'];

        $query = 'update posts set draft = :draft where id = :id';

        $db->query($query, $data);
    }
}
