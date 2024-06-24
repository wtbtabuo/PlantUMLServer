<?php
$data = json_decode(file_get_contents('data/training.json'), true);
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
        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['title']; ?></td>
            <td><?php echo $data['theme']; ?></td>
        </tr>
    </tbody>
</table>
<div class="pagination">
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
</div>
