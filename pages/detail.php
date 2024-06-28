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
    <script src="https://cdn.jsdelivr.net/npm/plantuml-encoder@1.4.0/dist/plantuml-encoder.min.js"></script>
    <script>
        function encodeUML(umlText) {
            return plantumlEncoder.encode(umlText);
        }

        function updateUserSVG() {
            var userInput = document.getElementById('umlInput').value;
            var encoded = encodeUML(userInput);
            var imgSrc = "http://www.plantuml.com/plantuml/svg/" + encoded;
            document.getElementById('userSVG').src = imgSrc;
        }

        window.onload = function() {
            var encoded = encodeUML(`<?php echo $detail['uml']; ?>`);
            var imgSrc = "http://www.plantuml.com/plantuml/svg/" + encoded;
            document.getElementById('jsonSVG').src = imgSrc;
            showAnswerUML();  // デフォルトでAnswer UMLを表示
        };

        function showAnswerUML() {
            document.getElementById('jsonSVGContainer').style.display = 'block';
            document.getElementById('answerCodeContainer').style.display = 'none';
        }

        function showAnswerCode() {
            document.getElementById('jsonSVGContainer').style.display = 'none';
            document.getElementById('answerCodeContainer').style.display = 'block';
        }
    </script>
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            align-items: stretch; /* 各カラムの高さを揃える */
        }
        .column {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        textarea {
            width: 100%;
            height: calc(50% - 40px); /* 画面の縦半分の高さ */
            box-sizing: border-box;
        }
        iframe {
            width: 100%;
            height: calc(50% - 40px); /* 画面の縦半分の高さ */
            border: none;
        }
        button {
            margin-left: 10px;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }
        .button-container {
            text-align: right;
        }
        #answerCodeContainer {
            display: none;
            flex: 1;
            overflow-y: auto;
        }
        #jsonSVGContainer {
            flex: 1;
            overflow-y: auto;
        }
        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="column">
        <h2>UML入力</h2>
        <textarea id="umlInput" oninput="updateUserSVG()"></textarea>
    </div>
    <div class="column">
        <h2>リアルタイムプレビュー</h2>
        <iframe id="userSVG"></iframe>
    </div>
    <div class="column">
        <h2 style="display:inline;">参考UML</h2>
        <div class="button-container">
            <button onclick="showAnswerUML()">Answer UML</button>
            <button onclick="showAnswerCode()">Answer Code</button>
        </div>
        <div id="jsonSVGContainer">
            <iframe id="jsonSVG"></iframe>
        </div>
        <div id="answerCodeContainer">
            <pre><?php echo htmlspecialchars($detail['uml']); ?></pre>
        </div>
    </div>
</body>
</html>
