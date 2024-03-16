<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">
</head>

<body>
    <div class="container">
        <header>
            <h1>Articles Admin Page</h1>
        </header>
        <nav>
            <a href="<?= base_url('admin'); ?>" class="active">Dashboard</a>
            <a href="<?= base_url('admin/articles'); ?>">Articles</a>
            <a href="<?= base_url('admin/article/add'); ?>">Adding Article</a>
        </nav>
        <section class="wrapper">
            <section class="main">