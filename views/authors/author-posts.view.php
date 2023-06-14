<?php

use App\Core\Auth;

component("head");
?>

<div class="px-6 py-8">
    <div class="flex justify-between container mx-auto">
        <div class="w-full lg:w-8/12">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">My Articles</h1>
                <?php component("post-filter") ?>
            </div>
            <?php foreach ($posts as $post) : ?>
                <div class="mt-6">
                    <div class="w-full grid min-h-[288px] grid-cols-3 <?= $post["draft"] ? 'bg-orange-50 ring ring-2 ring-orange-200' : 'bg-white' ?> rounded-lg shadow-md overflow-hidden">
                        <img class="w-full h-full object-cover bg-gray-50" src="<?= $post['thumbnail'] ?>" alt="<?= $post['title'] ?>">
                        <div class="col-span-2 px-10 py-6 col-4">
                            <div class="flex gap-3 items-center">
                                <span class="font-light text-gray-600"><?= formatDate($post["created_at"]) ?></span>
                                <?php if ($post["draft"]) : ?>
                                    <span class="font-bold text-orange-600 mr-auto">Draft</span>
                                <?php endif ?>
                                <?php foreach ($post["post_categories"] as $category) : ?>
                                    <a class="inline-flex items-center rounded-md bg-blue-50 hover:bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10" href="/category/<?= $category['slug'] ?>"><?= $category['title'] ?></a>
                                <?php endforeach ?>
                            </div>
                            <div class="mt-2">
                                <a class="text-2xl text-gray-700 font-bold hover:underline" href="/authors/posts/<?= $post['slug'] ?>"><?= $post["title"] ?></a>
                                <p class="mt-2 text-gray-600"><?= $post["description"] ?></p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <a class="text-blue-500 hover:underline" href="/authors/posts/<?= $post['slug'] ?>">Read more</a>
                                <div>
                                    <a class="flex items-center" href="/authors/<?= $post['author_username'] ?>">
                                        <img class="mx-4 w-10 ring-1 ring-purple-400 h-10 object-cover rounded-full hidden sm:block" src="<?= $post['profile_picture'] ?>" alt="avatar">
                                        <span class="text-gray-700 font-bold hover:underline"><?= $post["author"] ?></span>
                                        <?php if (Auth::me($post['author_id'])) : ?>
                                            <span class="text-gray-800 ml-1 text-sm italic">(You)</span>
                                        <?php endif ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="mt-8">
                <button class="block w-fit mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Load more posts
                </button>
            </div>
        </div>
        <div class="-mx-8 w-4/12 hidden lg:block">
            <div class="px-8">
                <h1 class="mb-4 text-xl font-bold text-gray-700">Filter</h1>
                <div class="flex flex-col bg-white max-w-sm px-6 py-4 mx-auto rounded-lg shadow-md">
                    <ul class="-mx-4">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php component("footer") ?>