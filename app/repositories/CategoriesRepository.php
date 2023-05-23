<?php

class CategoriesRepository
{
    public static function all(Database $db)
    {
        $query = 'select title, slug from categories order by created_at desc;';

        return $db->query($query)->all();
    }

    public static function post_by_category(Database $db, string $slug)
    {
        $query = 'select c.*, p.* 
                from categories
                inner join category_post as cp on cp.category.id = c.id
                inner join posts on cp.post_id = p.id
                where c.slug = :slug';

        return $db->query($query, compact('slug'))->findOrFail();
    }
}
