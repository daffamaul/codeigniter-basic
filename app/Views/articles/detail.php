<?= $this->include('templates/header') ?>
<article class="entry">
    <h2><?= $slug['title'] ?></h2>
    <img src="<?= base_url('/gambar/' . $slug['image']) ?>" alt="<?= $slug['title'] ?>">
    <p><?= $slug['content'] ?></p>
</article>
<?= $this->include('templates/footer') ?>