<?php component("head") ?>

<main class="grid place-items-center bg-white px-6 py-12 sm:py-16 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm col-span-full">
        <h2 class="my-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register to a new account</h2>
    </div>
    <form method="POST" action="" class="min-w-[40%]">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? '' ?>" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <?php if (isset($errors['name'])) : ?>
                            <span class="text-red-500 text-xs font-medium"><?= $errors['name'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                        <div class="mt-2">
                            <input id="username" name="username" type="text" value="<?= $_POST['username'] ?? '' ?>" autocomplete="username" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <?php if (isset($errors['username'])) : ?>
                            <span class="text-red-500 text-xs font-medium"><?= $errors['username'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" value="<?= $_POST['email'] ?? '' ?>" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <?php if (isset($errors['email'])) : ?>
                            <span class="text-red-500 text-xs font-medium"><?= $errors['email'] ?></span>
                        <?php endif ?>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="mt-2">
                            <input id="password" name="password" value="<?= $_POST['password'] ?? '' ?>" type="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <?php if (isset($errors['password'])) : ?>
                            <span class="text-red-500 text-xs font-medium"><?= $errors['password'] ?></span>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
        </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
        Already a member
        <a href="/auth/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Log in</a>
    </p>
</main>


<?php component("footer") ?>