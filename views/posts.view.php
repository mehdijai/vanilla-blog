<?php component("head") ?>

<div class="px-6 py-8">
    <div class="flex justify-between container mx-auto">
        <div class="w-full lg:w-8/12">
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