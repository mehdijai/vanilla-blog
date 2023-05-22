<div class="flex flex-col bg-white max-w-sm px-6 py-4 mx-auto rounded-lg shadow-md">
    <ul class="-mx-4">
        <?php foreach($authors as $author) : ?>
        <li class="flex items-center my-2">
            <img class="h-10 w-10 rounded-full object-cover mx-4" src="<?= $author['profile_picture']?>" alt="<?= $author['name'] ?>">
            <p>
                <a class="text-gray-700 font-bold mx-1 hover:underline" href="#"><?= $author['name'] ?></a>
                <span class="text-gray-700 text-sm font-light">Articles <?= $author['posts_count'] ?></span>
            </p>
        </li>
        <?php endforeach ?>
    </ul>
</div>