<?php include('include/header.php'); ?>

<div class="d-flex justify-content-between mb-3">
  <h3>Products</h3>
  <a href="<?= base_url('admin/products/create') ?>" class="btn btn-success">Add Product</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Images</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($products)): ?>
      <?php foreach($products as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= $p['product_name'] ?></td>
          <td><?= $p['price'] ?></td>
          <td>
            <?php if(!empty($p['images'])): ?>
              <?php foreach($p['images'] as $img): ?>
                <img src="<?= base_url($img) ?>" style="height:40px;margin-right:6px;">
              <?php endforeach; ?>
            <?php else: ?>
              <span class="text-muted">No Image</span>
            <?php endif; ?>
          </td>
          <td>
            <a href="<?= base_url('admin/products/view/'.$p['id']) ?>" class="btn btn-sm btn-info">View</a>
            <a href="<?= base_url('admin/products/edit/'.$p['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
            <a href="<?= base_url('admin/products/delete/'.$p['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?> 
    <?php else: ?>
      <tr><td colspan="5" class="text-center">No products found</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<?php include('include/footer.php'); ?>
