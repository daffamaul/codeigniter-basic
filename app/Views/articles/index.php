<?= $this->include('templates/header') ?>

<?php if ($articles) : ?>
    <?php foreach ($articles as $article) : ?>
        <article class="entry">
            <h2>
                <a href="<?= base_url('/articles/' . $article['slug']) ?>">
                    <?= $article['title'] ?>
                </a>
            </h2>
            <img src="<?= base_url('/images/' . $article['image']) ?>" alt="<?= $article['title'] ?>">
            <p>
                <?= substr($article['content'], 0, 200) ?>
            </p>
            <hr class="divider">
        </article>
    <?php endforeach ?>
<?php else : ?>
    <article class="entry">
        <h2>Articles does not exist.</h2>
    </article>
<?php endif ?>

<?= $this->include('templates/footer') ?>