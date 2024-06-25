<?php
// JSONファイルの内容を取得
$data = json_decode(file_get_contents('data/training.json'), true);

// 1ページあたりの項目数
$itemsPerPage = 5;

// 現在のページ番号を取得（デフォルトは1）
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 表示する項目の開始位置を計算
$start = ($page - 1) * $itemsPerPage;

// データの一部を抽出
$pageData = array_slice($data, $start, $itemsPerPage);

// 全ページ数を計算
$totalPages = ceil(count($data) / $itemsPerPage);
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Theme</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pageData as $item) : ?>
            <tr onclick="location.href='detail.php?id=<?php echo htmlspecialchars($item['id']); ?>'">
                <td><?php echo htmlspecialchars($item['id']); ?></td>
                <td><?php echo htmlspecialchars($item['title']); ?></td>
                <td><?php echo htmlspecialchars($item['theme']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <a href="#" class="<?php echo $i == $page ? 'active' : ''; ?>" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>
