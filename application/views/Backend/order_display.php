<?php include('include/header.php'); ?>
<?php //echo '<pre>'; print_r($order_items); die;?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>User Id</th>
      <th>Order Id</th>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($order_items)): ?>
      <?php foreach($order_items as $item): ?>
        <tr>
          <td><?= $item['id'] ?></td>
          <td><?= $item['user_id'] ?></td>
          <td><?= $item['order_id'] ?></td>
          <td><?= $item['product_name'] ?></td>
          <td><?= $item['price'] ?></td>
        <td><?= $item['quantity'] ?></td>
         <td><?= $item['subtotal'] ?></td>
        </tr>
      <?php endforeach; ?> 
    <?php else: ?>
      <tr><td colspan="5" class="text-center">No products found</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<?php include('include/footer.php'); ?>
