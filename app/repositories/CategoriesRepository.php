<?php

namespace App\Repositories;

class CategoriesRepository extends Repository
{
    public static function all()
    {
        $query = 'select title, slug from categories order by created_at desc;';

        return self::db()->query($query)->all();
    }

    public static function post_by_category(string $slug)
    {
        $query = 'select c.*, p.* 
                from categories
                inner join category_post as cp on cp.category.id = c.id
                inner join posts on cp.post_id = p.id
                where c.slug = :slug';

        return self::db()->query($query, compact('slug'))->findOrFail();
    }
}
