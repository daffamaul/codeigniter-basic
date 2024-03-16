<?= $this->include('templates/admin_header') ?>
<h2><?= $title ?></h2>
<?= validation_list_errors() ?>
<form action="" method="post">
    <p>
        <input type="text" name="title" value="<?= $article['title'] ?>">
    </p>
    <textarea name="content" cols="30" rows="10"><?= $article['content'] ?></textarea>
    <p>
        <input type="submit" value="submit" class="btn btn-large">
    </p>
</form>
<?= $this->include('templates/admin_footer') ?>