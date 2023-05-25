<?php component("head") ?>

<div class="px-6 py-8">
    <div class="flex justify-between container mx-auto">
        <div class="w-full">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">All articles</h1>
                <?php component("post-filter") ?>
            </div>
            <?php foreach ($posts as $post) : ?>
                <div class="mt-6">
                    <?php component("post", compact('post')); ?>
                </div>
            <?php endforeach ?>
            <div class="mt-8">
                <a href="/posts" class="block w-fit mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Load more posts
                </a>
            </div>
        </div>
    </div>
</div>

<?php component("footer") ?>