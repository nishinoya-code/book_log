<h1 class="h2 text-dark mt-4 mb-4">会社情報の登録</h1>
<form action="create.php" method="post">
  <?php if (count($errors)) : ?>
    <ul class="text-danger">
      <?php foreach ($errors as $error) : ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <div class="form-group">
    <label for="name">会社名</label>
    <input type="text" id="name" name="name" class="form-control" value="<?php echo $company['name']; ?>">
  </div>
  <div class="form-group">
    <label for="establishment_date">設立日</label>
    <input type="date" id="establishment_date" name="establishment_date" class="form-control" value="<?php echo $company['establishment_date']; ?>">
  </div>
  <div class="form-group">
    <label for="founder">代表者</label>
    <input type="text" id="founder" name="founder" class="form-control" value="<?php echo $company['founder']; ?>">
  </div>
  <button type="submit" class="btn btn-primary">登録する</button>
</form>
