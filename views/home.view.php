<?php component("head") ?>

<div class="px-6 py-8">
    <div class="flex justify-between container mx-auto">
        <div class="w-full lg:w-8/12">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Featured articles</h1>
                <?php component("post-filter") ?>
            </div>
            <?php foreach ($posts as $post) : ?>
                <div class="mt-6">
                    <?php component("post", compact('post')); ?>
                </div>
            <?php endforeach ?>
            <div class="mt-8">
                <?php component("pagination") ?>
            </div>
        </div>
        <div class="-mx-8 w-4/12 hidden lg:block">
            <div class="px-8">
                <h1 class="mb-4 text-xl font-bold text-gray-700">Authors</h1>
                <?php component("authors", compact('authors')) ?>
            </div>
            <div class="mt-10 px-8">
                <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
                <?php component("categories") ?>
            </div>
        </div>
    </div>
</div>

<?php component("footer") ?>