<?php include('include/header.php'); ?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>User Id</th>
      <th>Name</th>
      <th>Price</th>
      <th>Images</th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($cart_items)): ?>
      <?php foreach($cart_items as $item): ?>
        <tr>
          <td><?= $item['id'] ?></td>
          <td><?= $item['user_id'] ?></td>
          <td><?= $item['product_name'] ?></td>
          <td><?= $item['price'] ?></td>
          <td>
            <?php if(!empty($item['images'])): ?>
              <?php foreach($item['images'] as $img): ?>
                <img src="<?= base_url($img) ?>" style="height:40px;margin-right:6px;">
              <?php endforeach; ?>
            <?php else: ?>
              <span class="text-muted">No Image</span>
            <?php endif; ?>
          </td>
         
        </tr>
      <?php endforeach; ?> 
    <?php else: ?>
      <tr><td colspan="5" class="text-center">No products found</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<?php include('include/footer.php'); ?>
