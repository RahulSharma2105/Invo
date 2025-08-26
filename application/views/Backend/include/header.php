<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>INOVANT SOLUTIONS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>.container{margin-top:20px;}</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">INOVANT SOLUTIONS </a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/products') ?>">Products</a></li>
      <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/cart') ?>">Cart</a></li>
      <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/cart/order') ?>">Order</a></li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/logout') ?>">Logout</a></li>
    </ul>
  </div>
</nav>
<div class="container">
