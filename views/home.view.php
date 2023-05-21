<?php require("components/head.php") ?>

<div class="px-6 py-8">
    <div class="flex justify-between container mx-auto">
        <div class="w-full lg:w-8/12">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
                <?php require("components/post-filter.php") ?>
            </div>
            <?php foreach ($posts as $post) { ?>
                <div class="mt-6">
                    <?php require("components/post.php"); ?>
                </div>
            <?php } ?>
            <div class="mt-8">
                <?php require("components/pagination.php") ?>
            </div>
        </div>
        <div class="-mx-8 w-4/12 hidden lg:block">
            <div class="px-8">
                <h1 class="mb-4 text-xl font-bold text-gray-700">RSS Providers</h1>
                <?php require("components/rss-providers.php") ?>
            </div>
            <div class="mt-10 px-8">
                <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
                <?php require("components/categories.php") ?>
            </div>
        </div>
    </div>
</div>

<?php require("components/footer.php") ?>