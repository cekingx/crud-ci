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
  <?php echo form_open('/product/store', 'enctype="multipart/form-data"'); ?>
    <label for="name">Name</label>
    <input type="text" name="name" required>
    <br>
    <label for="price">Price</label>
    <input type="text" name="price" required>
    <br>
    <label for="image">Image</label>
    <input type="file" name="image" required>
    <br>
    <label for="description">Description</label>
    <!-- <input type="text" name="description" required> -->
    <textarea name="description" id="ckeditor" required></textarea>
    <br>
    <button type="submit">Submit</button>
  <?php echo form_close(); ?>

  <script src="<?php echo base_url('assets/jquery/jquery-3.5.1.min.js');?>"></script>
  <script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>"></script>
  <script type="text/javascript">
    $(function () {
      CKEDITOR.replace('ckeditor',{
        filebrowserImageBrowseUrl : '<?php echo base_url('assets/kcfinder/browse.php');?>',
        height: '400px'             
      });
    });
  </script>
</body>
</html>