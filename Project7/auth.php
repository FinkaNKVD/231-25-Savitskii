<?php
header('Content-Type: application/json');

// Подключение к базе данных (замените на ваши данные)
$db = new PDO('mysql:host=localhost;dbname=academy', 'root', '');

// Получение данных из POST запроса
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Проверка наличия всех необходимых данных
if (empty($email) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Пожалуйста, заполните все поля'
    ]);
    exit;
}

// Поиск пользователя в базе данных
$stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode([
        'success' => false,
        'message' => 'Пользователь с таким email не найден'
    ]);
    exit;
}

// Проверка пароля
if (!password_verify($password, $user['password'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Неверный пароль'
    ]);
    exit;
}

// Успешная авторизация
echo json_encode([
    'success' => true,
    'message' => 'Успешный вход в систему',
    'user' => [
        'id' => $user['id'],
        'email' => $user['email'],
        'name' => $user['name']
    ]
]); 