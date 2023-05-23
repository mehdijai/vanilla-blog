<div class="flex flex-col bg-white px-4 py-6 max-w-sm mx-auto rounded-lg shadow-md">
    <ul class="">
        <?php foreach ($categories as $category) : ?>
            <li class="py-1">
                <a class="inline-flex items-center rounded-md bg-blue-50 hover:bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10" href="/category/<?= $category['slug'] ?>"><?= $category['title'] ?></a>
            </li>
        <?php endforeach ?>
    </ul>
</div>