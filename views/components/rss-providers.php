<div class="flex flex-col bg-white max-w-sm px-6 py-4 mx-auto rounded-lg shadow-md">
    <ul class="-mx-4">
        <?php foreach($rss_providers as $provider) { ?>
        <li class="flex items-center my-2">
            <img class="w-10 object-cover mx-4" src="<?= $provider['logo']?>" alt="<?= $provider['title'] ?>">
            <p>
                <a class="text-gray-700 font-bold mx-1 hover:underline" href="#"><?= $provider['title'] ?></a>
                <span class="text-gray-700 text-sm font-light">Updated <?= formatDate($provider['updated_at']) ?></span>
            </p>
        </li>
        <?php } ?>
    </ul>
</div>