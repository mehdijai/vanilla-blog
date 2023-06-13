<?php

namespace App\Repositories;

class PostsRepository extends Repository
{
    public static function all()
    {
        $query = 'select * from V_AllPosts;';

        $posts = self::db()->query($query)->all();

        $posts = array_map(function ($post) {
            $post['post_categories'] = json_decode($post['post_categories'], true);
            return $post;
        }, $posts);

        return $posts;
    }

    public static function get(string $slug)
    {
        $query = "SELECT
                    posts.*,
                    authors.name AS author,
                    authors.username AS author_username,
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

        $post = self::db()->query($query, compact('slug'))->findOrFail();

        $post['post_categories'] = json_decode($post['post_categories'], true);

        return $post;
    }

    public static function store(array $data)
    {
        $data['draft'] = (int)$data['draft'];
        $query = 'insert into posts 
                (author_id, title, body, description, thumbnail, slug, module_id, draft) 
                values 
                (:author_id, :title, :body, :description, :thumbnail, :slug, :module_id, :draft);';

        self::db()->query($query, $data)->close();
    }

    public static function delete(array $data)
    {
        $query = 'delete from posts where id = :id and author_id = :author_id';

        self::db()->query($query, $data)->close();
    }

    public static function updateDraftState(array $data)
    {
        $data['draft'] = (int)$data['draft'];

        $query = 'update posts set draft = :draft where id = :id and author_id = :author_id';

        self::db()->query($query, $data)->close();
    }

    public static function update(array $data)
    {
        $data['draft'] = (int)$data['draft'];

        $id = $data['id'];
        $author_id = $data['author_id'];

        
        unset($data['id']);
        unset($data['author_id']);
        
        $post = self::db()->query('select * from posts where id = :id and author_id = :author_id', compact('id', 'author_id'))->find();
        $inter = array_intersect_key($data, $post);
        
        $toUpdate = [];
        
        foreach ($inter as $key => $value) {
            if ($value != $post[$key]) {
                if ($key === 'thumbnail') {
                    if ($value != null) {
                        $toUpdate[$key] = $value;
                    }
                } else {
                    $toUpdate[$key] = $value;
                }
            }
        }
        
        $keys = array_map(fn ($key) => "{$key} = :{$key}", array_keys($toUpdate));

        
        $query = "update posts set " . join(", ", $keys) . " where id = :id;";
        
        $toUpdate = [...$toUpdate, ...compact("id")];

        self::db()->query($query, $toUpdate)->close();
    }
}
