<?php

try {
    $dsn = "mysql:host=sql7.freesqldatabase.com;dbname=sql7780794";
    $username = "sql7780794";
    $password = "WZ2vk8QA66";
    $pseudo = $_POST["pseudo"];

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare('SELECT id FROM Users WHERE pseudo = :pseudo');
    $stmt->execute([':pseudo' => $pseudo]);

    $result = $stmt->fetch();

    if ($result) {
        echo json_encode(['id' => -1, 'success' => false]);
    } else {
        $insert = $pdo->prepare('INSERT INTO Users (pseudo) VALUES (:pseudo)');
        $insert->execute([':pseudo' => $pseudo]);
        $id = $pdo->lastInsertId();
        echo json_encode(['id' => $id, 'success' => true]);

    }


} catch (PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage();
}
?>
