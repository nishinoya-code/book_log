<?php

function validate($reviews)
{
  $errors = [];

  //書籍名が正しく入力されているかチェック
  if (!mb_strlen($reviews['title'])) {
    $errors['title'] = '書籍名を入力して下さい';
  } elseif (mb_strlen($reviews['title']) > 255) {
    $errors['title'] = '書籍名は255文字以内で入力して下さい';
  }
  //著者名
  if (!mb_strlen($reviews['author'])) {
    $errors['author'] = '著者名を入力して下さい';
  } elseif (mb_strlen($reviews['author']) > 255) {
    $errors['author'] = '著者名は255文字以内で入力して下さい';
  }
  //読書状況
  if (!in_array($reviews['progress'], ['未読', '読んでる', '読了'], true)) {
    $errors['progress'] = '読書状況は「未読」、「読んでる」、「読了」のいずれかにして下さい';
  }
  //評価が正しく入力されているかチェック
  if ($reviews['review'] < 1 || $reviews['review'] > 5) {
    $errors['review'] = '評価は1~5の整数で入力して下さい';
  }
  //感想
  if (!mb_strlen($reviews['impression'])) {
    $errors['impression'] = '感想を入力して下さい';
  } elseif (mb_strlen($reviews['impression']) > 255) {
    $errors['impression'] = '感想は255文字以内で入力して下さい';
  }

  return $errors;
}

function dbConnect()
{
  $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

  if (!$link) {
    echo 'Error: データベースに接続できませんでした' . PHP_EOL;
    echo ' Debugging error: ' . mysqli_connect_error() . PHP_EOL;
    exit;
  }

  return $link;
}

function addBooks($link)
{
  $reviews = [];

  echo '読書ログを登録して下さい' . PHP_EOL;
  echo '書籍名: ';
  $reviews['title'] = trim(fgets(STDIN));

  echo '著者名: ';
  $reviews['author'] = trim(fgets(STDIN));

  echo '読書状況(未読,読んでる,読了): ';
  $reviews['progress'] = trim(fgets(STDIN));

  echo '評価(5点満点の整数): ';
  $reviews['review'] = (int) trim(fgets(STDIN));

  echo '感想: ';
  $reviews['impression'] = trim(fgets(STDIN));

  $validated = validate($reviews);
  if (count($validated) > 0) {
    foreach ($validated as $error) {
      echo $error . PHP_EOL;
    }
    return;
  }

  echo '登録が完了しました' . PHP_EOL . PHP_EOL;

  $sql = <<<EOT
INSERT INTO books (
  title,
  author,
  progress,
  review,
  impression
) VALUES (
  "{$reviews['title']}",
  "{$reviews['author']}",
  "{$reviews['progress']}",
  "{$reviews['review']}",
  "{$reviews['impression']}"
);

EOT;

  $result = mysqli_query($link, $sql);
  if ($result) {
    echo 'データを追加しました' . PHP_EOL;
  } else {
    echo 'Error: データの追加に失敗しました' . PHP_EOL;
    echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
  }

  mysqli_close($link);
  echo 'データベースとの接続を切断しました' . PHP_EOL;
}

function callBooks($link)
{
  echo '読書ログを表示します' . PHP_EOL;

  $sql = 'SELECT * FROM books';
  $result = mysqli_query($link, $sql);

  while ($review = mysqli_fetch_assoc($result)) {
    echo "書籍名:" . $review['title'] . PHP_EOL;
    echo "著者名:" . $review['author'] . PHP_EOL;
    echo "読書状況:" . $review['progress'] . PHP_EOL;
    echo "評価:" . $review['review'] . PHP_EOL;
    echo "感想:" . $review['impression'] . PHP_EOL;
    echo '-------------' . PHP_EOL;
  }

  mysqli_free_result($result);
}

// $books = [];

$link = dbConnect();

while (true) {
  echo '1.読書ログを登録' . PHP_EOL;
  echo '2.読書ログを表示' . PHP_EOL;
  echo '9.アプリケーションを終了' . PHP_EOL;
  echo '番号を選択して下さい(1,2,9) :';
  $num = trim(fgets(STDIN));

  if ($num === '1') {
    $books[] = addBooks($link);
  } elseif ($num === '2') {
    callBooks($link);
  } elseif ($num === '9') {
    mysqli_close($link);
    break;
  }
}

// var_export($books);
