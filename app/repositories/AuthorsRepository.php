<?php

namespace App\Repositories;

class AuthorsRepository extends Repository
{
    public static function all()
    {
        $query = 'select a.id, a.name, a.username, a.email, a.profile_picture, a.created_at, COUNT(p.author_id) as posts_count
            from authors as a
            LEFT OUTER JOIN posts as p
            on p.author_id = a.id
            GROUP BY a.id
            ORDER BY a.created_at';

        return self::db()->query($query)->all();
    }

    public static function get(string $username)
    {
        $query = 'select * from authors where username = :username';

        return self::db()->query($query, compact('username'))->findOrFail();
    }
}
