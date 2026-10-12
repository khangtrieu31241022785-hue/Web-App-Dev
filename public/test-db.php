<?php
// File kiểm tra kết nối DB tạm thời. XÓA file này trước khi nộp/deploy.
require __DIR__ . '/../app/core/Database.php';

try {
    $pdo  = Database::getConnection();
    $info = $pdo->query('SELECT VERSION() AS version, DATABASE() AS db')->fetch();
    $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

    echo '<h3>Kết nối thành công</h3>';
    echo '<p>MariaDB: ' . htmlspecialchars($info['version']) . '<br>';
    echo 'Database: ' . htmlspecialchars($info['db']) . '</p>';
    echo '<p>Các bảng hiện có (' . count($tables) . '): ' . htmlspecialchars(implode(', ', $tables)) . '</p>';
} catch (Throwable $e) {
    echo 'Lỗi: ' . htmlspecialchars($e->getMessage());
}
