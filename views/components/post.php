<div class="w-full px-10 py-6 bg-white rounded-lg shadow-md">
    <div class="flex gap-3 items-center">
        <span class="font-light text-gray-600 mr-auto"><?= formatDate($post["created_at"]) ?></span>
        <?php foreach ($post["post_categories"] as $category) : ?>
            <a class="inline-flex items-center rounded-md bg-blue-50 hover:bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10" href="/category/<?= $category['slug'] ?>"><?= $category['title'] ?></a>
        <?php endforeach ?>
    </div>
    <div class="mt-2">
        <a class="text-2xl text-gray-700 font-bold hover:underline" href="/posts/<?= $post['slug'] ?>"><?= $post["title"] ?></a>
        <p class="mt-2 text-gray-600"><?= $post["body"] ?></p>
    </div>
    <div class="flex justify-between items-center mt-4">
        <a class="text-blue-500 hover:underline" href="/posts/<?= $post['slug'] ?>">Read more</a>
        <div>
            <a class="flex items-center" href="/authors/<?= $post['author_slug'] ?>">
                <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="<?= $post['profile_picture'] ?>" alt="avatar">
                <h1 class="text-gray-700 font-bold hover:underline"><?= $post["author"] ?></h1>
            </a>
        </div>
    </div>
</div>