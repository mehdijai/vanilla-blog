<?php component("head") ?>

<div class="bg-white px-6 py-24 sm:py-32 lg:px-8">
	<div class="mx-auto max-w-2xl text-center">
		<h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Create a new post</h2>
	</div>
	<form action="/posts/store" method="POST" class="mx-auto mt-16 max-w-xl sm:mt-20" enctype="multipart/form-data">
		<div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
			<div>
				<label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Title</label>
				<div class="mt-2.5">
					<input type="text" name="title" id="title" autocomplete="title" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
				</div>
			</div>
			<div>
				<label class="block text-sm font-semibold leading-6 text-gray-900" for="thumbnail">Thumbnail</label>
				<label for=thumbnail class="rounded-md ring-1 ring-inset ring-gray-300 border border-gray-100 bg-white hover:bg-indigo-100 p-2.5 mt-2 flex items-center gap-1 cursor-pointer">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-white stroke-indigo-600" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
					</svg>
					<span class="text-gray-500 font-medium text-sm">Upload file</span>
					<input class="hidden" aria-describedby="user_avatar_help" id="thumbnail" name="thumbnail" type="file">
				</label>
			</div>
			<div class="sm:col-span-2">
				<label for="description" class="block text-sm font-semibold leading-6 text-gray-900">Description</label>
				<div class="mt-2.5">
					<textarea name="description" id="description" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
				</div>
			</div>
			<div class="sm:col-span-2">
				<label for="body" class="block text-sm font-semibold leading-6 text-gray-900">Body</label>
				<div class="mt-2.5">
					<textarea name="body" id="body" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
				</div>
			</div>
			<div class="sm:col-span-2">
				<label for="draft" class="relative inline-flex items-center cursor-pointer">
					<input type="checkbox" checked class="sr-only peer" id="draft" name="draft">
					<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
					<span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Save to draft</span>
				</label>
			</div>
		</div>
		<div class="mt-10">
			<button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
		</div>
	</form>
</div>

<?php component("footer") ?>