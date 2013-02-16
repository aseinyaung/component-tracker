<p class="error">The following error<?= count($data['error']) > 1 
                                        ? 's have' 
                                        : ' has' ?> occured.</p>

<ul>
    <?php foreach ($data['error'] as $error): ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
</ul>