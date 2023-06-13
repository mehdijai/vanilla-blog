<?php

use App\Core\Auth;

component("head")

?>

<div class="bg-indigo-50">
	<hr>
	<?php if (Auth::me($post['author_id'])) : ?>
		<div class="lg:flex lg:items-center lg:justify-between p-5">
			<div class="min-w-0 flex-1">
				<h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Post Manager</h2>
				<div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
					<div title="publish date" class="mt-2 flex items-center text-sm text-gray-500">
						<span class="material-symbols-rounded mr-1 text-xl">
							publish
						</span>
						<?= $post['created_at'] ?>
					</div>
					<div title="update date" class="mt-2 flex items-center text-sm text-gray-500">
						<span class="material-symbols-rounded mr-1 text-xl">
							schedule
						</span>
						<?= $post['updated_at'] ?>
					</div>
					<div class="mt-2 flex items-center text-sm font-medium <?= $post['draft'] ? 'text-gray-500' : 'text-green-500' ?>">
						<span class="material-symbols-rounded mr-1 text-xl">
							<?= $post['draft'] ? 'draft' : 'cell_tower' ?>
						</span>
						<?= $post['draft'] ? 'Draft' : 'Live' ?>
					</div>
					<div class="mt-2 flex items-center text-sm text-gray-500">
						<span class="material-symbols-rounded mr-1 text-xl">
							account_circle
						</span>
						<?= $post['author'] ?> (You)
					</div>
				</div>
			</div>
			<div class="mt-5 flex lg:ml-4 lg:mt-0">

				<span class="hidden sm:block">
					<a href="/posts/update/<?= $post['slug'] ?>" class="inline-flex items-center rounded-md bg-white px-3 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
						<span class="material-symbols-rounded mr-2 text-xl">
							border_color
						</span>
						Edit
					</a>
				</span>

				<span class="ml-3 hidden sm:block">
					<form action="/posts" method="post">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="id" value="<?= $post['id'] ?>">
						<button class="inline-flex items-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-500">
							<span class="material-symbols-rounded mr-2 text-xl">
								delete_forever
							</span>
							Delete
						</button>
					</form>
				</span>

				<span class="sm:ml-3">
					<form action="/posts" method="post">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="id" value="<?= $post['id'] ?>">
						<input type="hidden" name="draft" value="<?= $post['draft'] ?>">
						<button class="<?= $post['draft'] ? 'bg-indigo-600 hover:bg-indigo-500' : 'bg-teal-600 hover:bg-teal-500' ?> inline-flex items-center rounded-md px-3 py-1.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
							<span class="material-symbols-rounded mr-2 text-xl">
								<?= $post['draft'] ? 'check' : 'place_item' ?>
							</span>
							<?= $post['draft'] ? 'Publish' : 'Set to draft' ?>
						</button>
					</form>
				</span>

				<!-- Dropdown -->
				<div class="relative ml-3 sm:hidden">
					<button @click.stop="isOpenFilterOption = !isOpenFilterOption" type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400" id="mobile-menu-button" aria-expanded="false" aria-haspopup="true">
						More
						<svg class="-mr-1 ml-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
						</svg>
					</button>

					<div x-show="isOpenFilterOption" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 z-10 -mr-1 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu-button" tabindex="-1">
						<a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="mobile-menu-item-0">Edit</a>
						<a href="#" class="block px-4 py-2 text-sm text-white bg-red-600 hover:bg-red-500" role="menuitem" tabindex="-1" id="mobile-menu-item-1">Delete</a>
					</div>
				</div>
			</div>
		</div>
	<?php endif ?>
	<hr>
</div>
<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
	<div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
		<article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
			<header class="mb-4 lg:mb-6 not-format">
				<address class="flex items-center mb-6 not-italic">
					<div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
						<img class="mr-4 w-16 h-16 object-cover rounded-full" src="<?= $post['profile_picture'] ?>" alt="<?= $post['author'] ?>">
						<div>
							<a href="/authors/<?= $post['author_username'] ?>" rel="author" class="text-xl font-bold text-gray-900 dark:text-white"><?= $post['author'] ?></a>
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