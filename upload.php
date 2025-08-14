<?php
// 上传目录，需确保有写入权限
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// 处理上传请求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $targetPath = $uploadDir . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => '文件上传成功']);
        exit;
    }
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => '文件上传失败']);
    exit;
}

// 处理获取文件列表请求
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $files = array_diff(scandir($uploadDir), ['.', '..']);
    $fileList = [];
    foreach ($files as $file) {
        $fileList[] = [
            'name' => $file,
            'size' => filesize($uploadDir . $file),
            'url' => $uploadDir . $file
        ];
    }
    echo json_encode(['status' => 'success', 'files' => $fileList]);
    exit;
}
?>