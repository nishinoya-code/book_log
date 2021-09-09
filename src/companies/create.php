<?php

require_once __DIR__ . '/lib/mysqli.php';

function createCompany($link, $company)
{
    $sql = <<<EOT
INSERT INTO companies (
    name,
    establishment_date,
    founder
) VALUES (
    "{$company['name']}",
    "{$company['establishment_date']}",
    "{$company['founder']}"
)
EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to create company');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

function validate($company)
{
    $errors = [];
    // 会社名
    if (!strlen($company['name'])) {
        $errors['name'] = '会社名を入力して下さい';
    } elseif (strlen($company['name']) > 255) {
        $errors['name'] = '会社名は255文字以内で入力して下さい';
    }

    //設立日
    $dates = explode('-', $company['establishment_date']);
    if (!strlen($company['establishment_date'])) {
        $errors['establishment_date'] = '設立日を入力して下さい';
    } elseif (count($dates) !== 3) {
        $errors['establishment_date'] = '設立日を正しい形式で入力して下さい';
    } elseif (!checkdate($dates[1], $dates[2], $dates[0])) {
        $errors['establishment_date'] = '設立日を正しい日付で入力して下さい';
    }

    //代表者
    if (!strlen($company['founder'])) {
        $errors['founder'] = '代表者名を入力して下さい';
    } elseif (strlen($company['founder']) > 100) {
        $errors['founder'] = '代表者名は100文字以内で入力して下さい';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = [
        'name' => $_POST['name'],
        'establishment_date' => $_POST['establishment_date'],
        'founder' => $_POST['founder']
    ];

    $errors = validate($company);
    if (!count($errors)) {
        $link = dbConnect();
        createCompany($link, $company);
        mysqli_close($link);
        header("location: index.php");
    }
}

include 'views/new.php';
