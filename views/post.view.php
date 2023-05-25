<?php component("head") ?>

<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
	<div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
		<article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
			<header class="mb-4 lg:mb-6 not-format">
				<address class="flex items-center mb-6 not-italic">
					<div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
						<img class="mr-4 w-16 h-16 object-cover rounded-full" src="<?= $post['profile_picture'] ?>" alt="<?= $post['author'] ?>">
						<div>
							<a href="/authors/<?= $post['author_slug'] ?>" rel="author" class="text-xl font-bold text-gray-900 dark:text-white"><?= $post['author'] ?></a>
							<p class="text-base font-light text-gray-500 dark:text-gray-400"><time pubdate datetime="<?= formatDate($post['created_at']) ?>" title="<?= $post['created_at'] ?>"><?= formatDate($post['created_at']) ?></time></p>
						</div>
					</div>
				</address>
				<h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white"><?= $post['title'] ?></h1>
			</header>
			<div class="flex mb-3 gap-3 items-center">
				<?php foreach ($post["post_categories"] as $category) : ?>
					<a class="inline-flex items-center rounded-md bg-blue-50 hover:bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10" href="/category/<?= $category['slug'] ?>"><?= $category['title'] ?></a>
				<?php endforeach ?>
			</div>
			<p class="text-lg text-gray-500 font-medium"><?= $post['description'] ?></p>
			<hr class="my-2.5">
			<p class="text-gray-900"><?= $post['body'] ?></p>
		</article>
	</div>
</main>

<?php component("footer") ?>