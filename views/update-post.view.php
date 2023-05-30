<?php component("head") ?>

<div class="bg-white px-6 py-24 sm:py-32 lg:px-8">
	<div class="mx-auto max-w-2xl text-center">
		<h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Update post</h2>
	</div>
	<form method="POST" action="/posts/update" class="mx-auto mt-16 max-w-xl sm:mt-20" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PATCH">
		<input type="hidden" name="id" value="<?= $post['id'] ?>">

		<div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
			<div class="sm:col-span-2">
				<img class="w-1/2 mx-auto border border-gray-300 rounded-lg" src="/<?= $post['thumbnail'] ?>" alt="<?= $post['title'] ?>">
			</div>
			<div>
				<label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Title</label>
				<div class="mt-2.5">
					<input require minlength="8" maxlength="200" value="<?= $_POST['title'] ?? $post['title'] ?>" type="text" name="title" id="title" autocomplete="title" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
				</div>
				<?php if (isset($errors['title'])) : ?>
					<span class="text-red-500 text-xs font-medium"><?= $errors['title'] ?></span>
				<?php endif ?>
			</div>
			<div>
				<label class="block text-sm font-semibold leading-6 text-gray-900" for="thumbnail">Thumbnail</label>
				<input require accept="image/*" id="thumbnail" name="thumbnail" class="block mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file">
				<?php if (isset($errors['thumbnail'])) : ?>
					<span class="text-red-500 text-xs font-medium"><?= $errors['thumbnail'] ?></span>
				<?php endif ?>
				<span class="text-gray-500 text-xs font-medium">Leave it empty if you dont want to updated it.</span>
			</div>
			<div class="sm:col-span-2">
				<label for="description" class="block text-sm font-semibold leading-6 text-gray-900">Description</label>
				<div class="mt-2.5">
					<textarea require minlength="8" maxlength="200" name="description" id="description" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $_POST['description'] ?? $post['description'] ?></textarea>
				</div>
				<?php if (isset($errors['description'])) : ?>
					<span class="text-red-500 text-xs font-medium"><?= $errors['description'] ?></span>
				<?php endif ?>
			</div>
			<div class="sm:col-span-2">
				<label for="body" class="block text-sm font-semibold leading-6 text-gray-900">Body</label>
				<div class="mt-2.5">
					<textarea require minlength="8" maxlength="1000" name="body" id="body" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $_POST['body'] ?? $post['body']  ?></textarea>
				</div>
				<?php if (isset($errors['body'])) : ?>
					<span class="text-red-500 text-xs font-medium"><?= $errors['body'] ?></span>
				<?php endif ?>
			</div>
			<div class="sm:col-span-2">
				<label for="draft" class="relative inline-flex items-center cursor-pointer">
					<input type="checkbox" <?= isset($_POST['draft']) ? 'checked' : ($post['draft'] ? 'checked' : '') ?> class="sr-only peer" id="draft" name="draft">
					<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
					<span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Save to draft</span>
				</label>
			</div>
		</div>
		<div class="mt-10">
			<button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
		</div>
	</form>
</div>

<?php component("footer") ?>