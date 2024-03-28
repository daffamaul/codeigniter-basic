<?= $this->include('templates/admin_header') ?>
<form action="" method="get">
    <input type="text" name="q" value="<?= $q ?>">
    <input type="button" value="Cari">
</form>
<table border="2">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($articles) : ?>
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td><?= $article['id'] ?></td>
                    <td><?= $article['title'] ?></td>
                    <td><?= $article['status'] ?></td>
                    <td>
                        <a href="<?= base_url('admin/article/edit/' . $article['id']) ?>">Edit</a> |
                        <a href="<?= base_url('admin/article/delete/' . $article['id']) ?>" onclick="return confirm('yakin ingin menghapusnya?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td rowspan="4">Articles does not exist.</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>
<?= $pager->links() ?>
<?= $this->include('templates/admin_footer') ?>