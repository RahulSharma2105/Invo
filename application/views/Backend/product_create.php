<?php include('include/header.php'); ?>
<h3>Add Product</h3>
<form method="post" enctype="multipart/form-data">
  <div class="form-group"><label>Name</label><input class="form-control" name="product_name" required></div>
  <div class="form-group"><label>Price</label><input class="form-control" name="price" type="number" step="0.01" required></div>
  <div class="form-group"><label>Description</label><textarea class="form-control" name="description"></textarea></div>
  <div class="form-group"><label>Images</label><input type="file" name="images[]" multiple></div>
  <div class="form-group"><label><input type="checkbox" name="status" checked> Active</label></div>
  <button class="btn btn-primary">Save</button>
</form>
<?php include('include/footer.php'); ?> 