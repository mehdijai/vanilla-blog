<?php

use App\Core\Auth;

component("head")
?>

<div class="px-6 py-8">
    <div class="flex justify-between container mx-auto">
        <div class="w-full lg:w-8/12">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">All Authors</h1>
            </div>
            <?php foreach ($authors as $author) : ?>
                <li class="flex items-center my-3">
                    <img class="h-9 w-9 <?= Auth::me($author['id']) ? 'ring-4 ring-purple-300' : '' ?> rounded-full object-cover mx-4" src="<?= $author['profile_picture'] ?>" alt="<?= $author['name'] ?>">
                    <p>
                        <a class="text-gray-700 font-bold ml-1 hover:underline" href="/authors/<?= $author['username'] ?>"><?= $author['name'] ?></a>
                        <?php if (Auth::me($author['id'])) : ?>
                            <span class="text-gray-800 text-sm italic">(You)</span>
                        <?php endif ?>
                        <span class="text-gray-700 ml-1 text-sm font-light">Articles (<?= $author['posts_count'] ?>)</span>
                    </p>
                </li>
            <?php endforeach ?>
            <div class="mt-8">
                <button class="block w-fit mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Load more authors
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