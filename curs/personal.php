<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user'])) {
    // Если пользователь не авторизован, перенаправляем на страницу входа
    header('Location: login.html');
    exit;
}

// Получаем данные пользователя из сессии
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - Академия Профессионального Развития</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #4cc9f0;
            --text-color: #2b2d42;
            --bg-color: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            margin: 2rem auto;
            max-width: 1400px;
            padding: 0 1rem;
        }

        .sidebar {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            height: fit-content;
            position: sticky;
            top: 2rem;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 1rem;
            border: 4px solid var(--primary-color);
            padding: 3px;
            transition: var(--transition);
        }

        .avatar:hover {
            transform: scale(1.05);
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            margin: 0.5rem 0;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 8px;
            transition: var(--transition);
            font-weight: 500;
        }

        .sidebar-nav a i {
            margin-right: 0.8rem;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-nav a:hover {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateX(5px);
        }

        .sidebar-nav a.active {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: var(--card-shadow);
        }

        .main-content {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .welcome-message {
            text-align: center;
            padding: 2rem;
        }

        .welcome-message h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .welcome-message p {
            color: var(--text-color);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                position: static;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="profile-header">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['name']); ?>&background=4361ee&color=fff" alt="Аватар" class="avatar">
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <nav class="sidebar-nav">
                <a href="index.php">
                    <i class="fas fa-home"></i>
                    На главную
                </a>
                <a href="personal.php" class="active">
                    <i class="fas fa-user"></i>
                    Личный кабинет
                </a>
                <a href="my-courses.php">
                    <i class="fas fa-book"></i>
                    Мои курсы
                </a>
                <a href="certificates.php">
                    <i class="fas fa-certificate"></i>
                    Сертификаты
                </a>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    Выйти
                </a>
            </nav>
        </div>
        <div class="main-content">
            <h1 class="section-title">Добро пожаловать, <?php echo htmlspecialchars($user['name']); ?>!</h1>
            
            <div class="welcome-message">
                <h2>Ваш личный кабинет</h2>
                <p>Здесь вы можете управлять своими курсами, просматривать сертификаты и настраивать свой профиль.</p>
            </div>
        </div>
    </div>
</body>
</html>