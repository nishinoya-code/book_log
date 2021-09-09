    <h2 class="h3 text-dark mb-4">読書ログの登録</h2>
    <form action="create.php" method="post">
      <?php if (count($errors)) : ?>
        <ul>
          <?php foreach ($errors as $error) : ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <div class="form-group">
        <label for="name">書籍名</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo $review['title']; ?>">
      </div>
      <div class="form-group">
        <label for="name">著者名</label>
        <input type="text" id="author" name="author" class="form-control" value="<?php echo $review['author']; ?>">
      </div>
      <div class="form-group">
        <label>読書状況</label>
        <div class="">
          <div class="form-check form-check-inline">
            <input type="radio" name="status" class="form-check-input" id="status1" value="未読" <?php echo ($review['status'] === "未読") ? 'checked' : ''; ?>>
            <label class="form-check-label" for="status1">未読</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="status" class="form-check-input" id="status2" value="読んでる" <?php echo ($review['status'] === "読んでる") ? 'checked' : ''; ?>>
            <label class="form-check-label" for="status2">読んでる</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="status" class="form-check-input" id="status3" value="読了" <?php echo ($review['status'] === "読了") ? 'checked' : ''; ?>>
            <label class="form-check-label" for="status3">読了</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="score">評価(5点満点の整数)</label>
        <input type="number" id="score" name="score" class="form-control" value="<?php echo $review['score']; ?>">
      </div>
      <div class="form-group">
        <label for="summary">感想</label>
        <textarea name="summary" id="summary" cols="30" class="form-control" rows="10"><?php echo $review['summary']; ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">登録する</button>
    </form>
