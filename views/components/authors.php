<?php

use App\Core\Auth;

?>

<div class="flex flex-col bg-white max-w-sm px-6 py-4 mx-auto rounded-lg shadow-md">
    <ul class="-mx-4">
        <?php foreach ($authors as $author) : ?>
            <li class="flex items-center my-3">
                <img class="h-9 w-9 <?= Auth::me($author['id']) ? 'ring-4 ring-purple-300' : '' ?> rounded-full object-cover mx-4" src="<?= $author['profile_picture'] ?>" alt="<?= $author['name'] ?>">
                <p>
                    <a class="text-gray-700 font-bold ml-1 hover:underline" href="#"><?= $author['name'] ?></a>
                    <?php if (Auth::me($author['id'])) : ?>
                        <span class="text-gray-800 text-sm italic">(You)</span>
                    <?php endif ?>
                    <span class="text-gray-700 ml-1 text-sm font-light">Articles (<?= $author['posts_count'] ?>)</span>
                </p>
            </li>
        <?php endforeach ?>
    </ul>
</div>