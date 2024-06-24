<?php
// JSONファイルの内容を取得
$data = json_decode(file_get_contents('data/training.json'), true);

// 1ページあたりの項目数
$itemsPerPage = 5;

// 現在のページ番号を取得（デフォルトは1）
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 表示する項目の開始位置と終了位置を計算
$start = ($page - 1) * $itemsPerPage;
$end = $start + $itemsPerPage;

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
            <tr>
                <td><?php echo htmlspecialchars($item['id']); ?></td>
                <td><?php echo htmlspecialchars($item['title']); ?></td>
                <td><?php echo htmlspecialchars($item['theme']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <a href="#" class="<?php echo $i == $page ? 'active' : ''; ?>" onclick="loadPage(<?php echo $i; ?>)"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<script>
    function loadPage(page) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "trainings.php?page=" + page, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("table-container").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>
