<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
</head>
<body>
  <?php if (isset($error)) {
    echo '<p class="alert alert-danger"><strong>Error: </strong>'.$error.'</p>';
  }?>
  <?php echo form_open('/product/update'); ?>
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <label for="name">Name</label>
    <input type="text" name="name" value="<?php echo $product['name'] ?>">
    <br>
    <label for="price">Price</label>
    <input type="text" name="price" value="<?php echo $product['price'] ?>">
    <br>
    <label for="image">Image</label>
    <input type="file" name="image">
    <br>
    <input type="hidden" name="old_image" value="<?php echo $product['image']?>">
    <label for="description">Description</label>
    <input type="text" name="description" value="<?php echo $product['description'] ?>">
    <br>
    <button type="submit">Submit</button>
  <?php echo form_close(); ?>
</body>