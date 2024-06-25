<?php
// IDを取得
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// JSONファイルの内容を取得
$data = json_decode(file_get_contents('data/training.json'), true);

// 対象のデータを検索
$detail = null;
foreach ($data as $item) {
    if ($item['id'] == $id) {
        $detail = $item;
        break;
    }
}

if ($detail === null) {
    echo "項目が見つかりませんでした。";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>項目の詳細</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>項目の詳細</h1>
    </header>
    <div>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($detail['id']); ?></p>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($detail['title']); ?></p>
        <p><strong>Theme:</strong> <?php echo htmlspecialchars($detail['theme']); ?></p>
        <a href="javascript:history.back()">戻る</a>
    </div>
</body>
</html>
