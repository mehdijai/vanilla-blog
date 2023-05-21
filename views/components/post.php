<div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center">
        <span class="font-light text-gray-600"><?= $post["date"] ?></span>
        <a class="inline-flex items-center rounded-md bg-blue-50 hover:bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10" href="#"><?= $post["tag"] ?></a>
    </div>
    <div class="mt-2">
        <a class="text-2xl text-gray-700 font-bold hover:underline" href="#"><?= $post["title"] ?></a>
        <p class="mt-2 text-gray-600"><?= $post["body"] ?></p>
    </div>
    <div class="flex justify-between items-center mt-4">
        <a class="text-blue-500 hover:underline" href="#">Read more</a>
        <div>
            <a class="flex items-center" href="#">
                <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="<?=$post['image']?>" alt="avatar">
                <h1 class="text-gray-700 font-bold hover:underline"><?= $post["userName"] ?></h1>
            </a>
        </div>
    </div>
</div>