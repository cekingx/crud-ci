<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>
  <?php if (isset($message)) {
    echo '<p class="alert alert-danger"><strong>Message: </strong>'.$message.'</p>';
  }?>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($products as $product): ?>
      <tr>
        <td><?php echo $product['name'] ?></td>
        <td><?php echo $product['price'] ?></td>
        <td>
          <img 
            src="<?php echo base_url('upload/product/' . $product['image'])?>" 
            alt="<?php echo $product['image'] ?>"
          >
        </td>
        <td><?php echo $product['description'] ?></td>
        <td>
          <a href="<?php echo site_url('product/edit/' . $product['id']) ?>">Edit</a>
          <a href="<?php echo site_url('product/delete/'.$product['id']) ?>">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>