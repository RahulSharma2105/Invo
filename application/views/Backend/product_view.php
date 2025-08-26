<?php include('include/header.php'); ?>

<div class="container">
  <h3>Product Details</h3>

  <div class="card mb-3">
    <div class="card-body">
      <h4 class="card-title"><?= $product['product_name'] ?></h4>
      <p><strong>Price:</strong> <?= $product['price'] ?></p>
      <hr>
      <h5>Images</h5>
      <div style="display:flex;flex-wrap:wrap;gap:15px;">
        <?php if(!empty($product['images'])): ?>
          <?php foreach($product['images'] as $img): ?>
            <img src="<?= base_url($img) ?>" 
                 style="height:100px;border:1px solid #ccc;padding:3px;">
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-muted">No images uploaded.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Back to List</a>
  <a href="<?= base_url('admin/products/edit/'.$product['id']) ?>" class="btn btn-primary">Edit Product</a>
</div>

<?php include('include/footer.php'); ?>
