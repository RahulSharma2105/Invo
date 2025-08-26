<?php include('include/header.php'); ?>

<h3>Edit Product</h3>

<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Name</label>
    <input type="text" name="product_name" class="form-control" value="<?= $product['product_name'] ?>" required>
  </div>
  <div class="mb-3">
    <label>Price</label>
    <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required>
  </div>
  <div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
  </div>
  <div class="mb-3">
    <label>Status</label>
    <input type="checkbox" name="status" value="1" <?= ($product['status'] == 1) ? 'checked' : '' ?>>
  </div>

  <div class="mb-3">
    <label>Existing Images</label><br>
    <?php if(!empty($product['images'])): ?>
      <div class="d-flex flex-wrap mb-2">
        <?php foreach($product['images'] as $index => $img): ?>
          <div style="margin-right:10px;text-align:center;">
            
            <img src="<?= base_url($img) ?>" style="height:60px;border:1px solid #ccc;padding:2px;display:block;">
            <a href="<?= base_url('admin/products/delete_image/'.$product['id'].'/'.$index) ?>" 
               class="btn btn-sm btn-danger mt-1"
               onclick="return confirm('Delete this image?')">Delete</a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-muted">No images uploaded yet.</p>
    <?php endif; ?>
  </div>

  <div class="mb-3">
    <label>Add New Images</label>
    <input type="file" name="images[]" multiple class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
  <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Cancel</a>
</form>

<?php include('include/footer.php'); ?>
