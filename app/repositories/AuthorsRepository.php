<?php

class AuthorsRepository
{
    public static function all(Database $db)
    {
        $query = 'select a.id, a.name, a.slug, a.email, a.profile_picture, a.created_at, COUNT(p.author_id) as posts_count
            from authors as a
            LEFT OUTER JOIN posts as p
            on p.author_id = a.id
            GROUP BY a.id
            ORDER BY a.created_at';

        return $db->query($query)->all();
    }

    public static function get(Database $db, string $slug)
    {
        $query = 'select * from authors where slug = :slug';

        return $db->query($query, compact('slug'))->findOrFail();
    }
}
