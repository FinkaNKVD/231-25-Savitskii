<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Платформа для онлайн-курсов – Обучение и сертификация</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            line-height: 1.6;
            color: #333;
        }
        header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: #fff;
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        header h1 {
            font-size: 3rem;
            margin: 0;
            animation: fadeIn 1.5s ease-in-out;
        }
        header p {
            font-size: 1.3rem;
            margin: 15px 0 0;
            opacity: 0.9;
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        nav {
            background: #2c3e50;
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        nav a {
            color: #fff;
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            transition: color 0.3s;
            padding: 5px 10px;
            border-radius: 4px;
        }
        nav a:hover {
            color: #f39c12;
            background: rgba(255,255,255,0.1);
        }
        .container {
            width: 85%;
            max-width: 1200px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
        }
        footer {
            text-align: center;     
            padding: 30px;
            background: #2c3e50;
            color: #fff;
            margin-top: 40px;
        }
        .course {
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin-bottom: 25px;
            background: #fff;
            border-radius: 8px;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }
        .course:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .course h3 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 1.5rem;
        }
        .course .meta {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        .course button {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .course button:hover {
            background: #2980b9;
        }
        .course-details {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            animation: fadeIn 0.5s ease-out;
        }
        .course-details.active {
            display: block;
        }
        .course-details ul {
            padding-left: 20px;
        }
        .course-details li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 20px;
        }
        .course-details li:before {
            content: "✓";
            color: #27ae60;
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        .testimonials {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        .testimonial {
            background: #fff;
            border: 1px solid #e0e0e0;
            padding: 25px;
            width: 30%;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .testimonial:hover {
            transform: translateY(-5px);
        }
        .testimonial p {
            font-style: italic;
            color: #555;
        }
        .testimonial h4 {
            margin: 15px 0 0;
            color: #2c3e50;
        }
        .testimonial .position {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .pricing {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        .price-plan {
            background: #fff;
            border: 1px solid #e0e0e0;
            padding: 30px;
            width: 30%;
            text-align: center;
            border-radius: 8px;
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .price-plan.popular {
            border: 2px solid #3498db;
            position: relative;
        }
        .price-plan.popular:before {
            content: "Популярный";
            position: absolute;
            top: -12px;
            right: 20px;
            background: #3498db;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .price-plan h3 {
            margin-top: 0;
            color: #2c3e50;
        }
        .price-plan .price {
            font-size: 2rem;
            font-weight: bold;
            color: #3498db;
            margin: 20px 0;
        }
        .price-plan .price span {
            font-size: 1rem;
            color: #7f8c8d;
        }
        .price-plan ul {
            list-style: none;
            padding: 0;
            margin: 25px 0;
        }
        .price-plan ul li {
            margin: 15px 0;
            position: relative;
            padding-left: 25px;
            text-align: left;
        }
        .price-plan ul li:before {
            content: "•";
            color: #3498db;
            position: absolute;
            left: 0;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .price-plan button {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        .price-plan button:hover {
            background: #2980b9;
        }
        .auth-form {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .auth-form input {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .auth-form button {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s;
        }
        .auth-form button:hover {
            background: #2980b9;
        }
        .hero {
            text-align: center;
            padding: 60px 30px;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: #fff;
            border-radius: 8px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }
        .hero:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover;
            opacity: 0.2;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .hero h2 {
            font-size: 2.5rem;
            margin: 0;
            animation: fadeIn 1s ease-in-out;
        }
        .hero p {
            font-size: 1.3rem;
            margin: 20px 0 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeIn 1.5s ease-in-out;
        }
        .hero button {
            background: #f39c12;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s, transform 0.3s;
            animation: fadeIn 2s ease-in-out;
        }
        .hero button:hover {
            background: #e67e22;
            transform: translateY(-3px);
        }
        .benefits {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 40px;
        }
        .benefit {
            background: #fff;
            border: 1px solid #e0e0e0;
            padding: 30px;
            width: 30%;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .benefit:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .benefit i {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 20px;
            display: block;
        }
        .benefit h3 {
            margin-top: 0;
            color: #2c3e50;
        }
        .benefit p {
            color: #555;
        }
        .about-section {
            margin-top: 40px;
        }
        .about-section h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 30px;
        }
        .about-section p {
            text-align: justify;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .mission-values {
            display: flex;
            margin: 40px 0;
        }
        .mission {
            width: 60%;
            padding-right: 30px;
        }
        .values {
            width: 40%;
            background: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
        }
        .values h3 {
            margin-top: 0;
            color: #2c3e50;
        }
        .values ul {
            padding-left: 20px;
        }
        .values li {
            margin-bottom: 15px;
            position: relative;
            padding-left: 25px;
        }
        .values li:before {
            content: "✓";
            color: #27ae60;
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        .team {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 40px;
        }
        .team-member {
            background: #fff;
            border: 1px solid #e0e0e0;
            padding: 30px;
            width: 22%;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 30px;
            transition: transform 0.3s;
        }
        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .team-member h4 {
            margin: 0 0 10px;
            color: #2c3e50;
            font-size: 1.3rem;
        }
        .team-member .position {
            font-style: italic;
            color: #7f8c8d;
            margin-bottom: 15px;
            font-size: 1rem;
        }
        .team-member .bio {
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .team-member .social {
            margin-top: 20px;
        }
        .team-member .social a {
            color: #3498db;
            margin: 0 8px;
            font-size: 1.2rem;
            transition: color 0.3s;
        }
        .team-member .social a:hover {
            color: #2980b9;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            background: #2c3e50;
            color: #fff;
            padding: 60px 0;
            margin: 60px 0;
            border-radius: 8px;
            text-align: center;
        }
        .stat-item h3 {
            font-size: 3rem;
            margin: 0;
            color: #f39c12;
        }
        .stat-item p {
            margin: 10px 0 0;
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .certification {
            background: #f8f9fa;
            padding: 60px;
            border-radius: 8px;
            margin: 60px 0;
            text-align: center;
        }
        .certification h2 {
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .certification p {
            max-width: 800px;
            margin: 0 auto 30px;
            line-height: 1.8;
        }
        .certificate-sample {
            margin: 40px auto;
            max-width: 800px;
            border: 10px solid #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .learning-process {
            margin: 60px 0;
        }
        .process-steps {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            position: relative;
        }
        .process-steps:before {
            content: "";
            position: absolute;
            top: 50px;
            left: 0;
            right: 0;
            height: 3px;
            background: #3498db;
            z-index: 0;
        }
        .process-step {
            width: 22%;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .step-number {
            width: 60px;
            height: 60px;
            background: #3498db;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 20px;
        }
        .process-step h4 {
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .process-step p {
            color: #555;
            font-size: 0.9rem;
        }
        .partners {
            margin: 60px 0;
            text-align: center;
        }
        .partner-logos {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        .partner-logo {
            margin: 15px 30px;
            text-align: center;
            transition: all 0.3s;
            width: 120px;
        }
        .partner-logo i {
            margin-bottom: 10px;
            transition: transform 0.3s;
        }
        .partner-logo:hover i {
            transform: scale(1.1);
        }
        .partner-logo p {
            margin: 0;
            font-weight: bold;
            color: #2c3e50;
        }
        .contact-info {
            display: flex;
            margin-top: 40px;
        }
        .contact-form {
            width: 60%;
            padding-right: 30px;
        }
        .contact-details {
            width: 40%;
            background: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
        }
        .contact-details h3 {
            margin-top: 0;
            color: #2c3e50;
        }
        .contact-details p {
            margin-bottom: 20px;
        }
        .contact-details .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .contact-details .info-item i {
            margin-right: 15px;
            color: #3498db;
            font-size: 1.2rem;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .form-group textarea {
            height: 150px;
        }
        .submit-btn {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        .submit-btn:hover {
            background: #2980b9;
        }
        .section-title {
            text-align: center;
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 40px;
            position: relative;
        }
        .section-title:after {
            content: "";
            display: block;
            width: 80px;
            height: 4px;
            background: #3498db;
            margin: 15px auto 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: #3498db;
            color: #fff;
            borderRadius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .btn-orange {
            background: #f39c12;
        }
        .btn-orange:hover {
            background: #e67e22;
        }
        .text-center {
            text-align: center;
        }
        .mt-30 {
            margin-top: 30px;
        }
        .mb-30 {
            margin-bottom: 30px;
        }
        .highlight {
            background: #f8f9fa;
            padding: 60px 0;
            margin: 60px 0;
        }
        .highlight-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        .highlight h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .highlight p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        /* Адаптивность */
        @media (max-width: 992px) {
            .benefit, .price-plan, .team-member {
                width: 48%;
            }
            .mission-values {
                flex-direction: column;
            }
            .mission, .values {
                width: 100%;
            }
            .mission {
                padding-right: 0;
                margin-bottom: 30px;
            }
            .contact-info {
                flex-direction: column;
            }
            .contact-form, .contact-details {
                width: 100%;
            }
            .contact-form {
                padding-right: 0;
                margin-bottom: 30px;
            }
        }
        @media (max-width: 768px) {
            .benefit, .price-plan, .team-member, .testimonial, .process-step {
                width: 100%;
            }
            .process-steps {
                flex-direction: column;
            }
            .process-steps:before {
                display: none;
            }
            .process-step {
                margin-bottom: 30px;
            }
            .stats {
                flex-direction: column;
            }
            .stat-item {
                margin-bottom: 30px;
            }
            nav a {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<header>
    <h1>Академия Профессионального Развития</h1>
    <p>Превращаем знания в карьерные возможности с 2015 года</p>
</header>

<nav>
    <a href="index.php">Главная</a>
    <a href="#courses">Курсы</a>
    <a href="#about">О нас</a>
    <a href="#teachers">Преподаватели</a>
    <a href="#process">Процесс обучения</a>
    <a href="#certification">Сертификация</a>
    <a href="#testimonials">Отзывы</a>
    <a href="#pricing">Цены</a>
    <a href="#contact">Контакты</a>
    <?php if ($isLoggedIn): ?>
        <a href="personal.php">Личный кабинет</a>
    <?php else: ?>
        <a href="login.html">Вход</a>
        <a href="register.html">Регистрация</a>
    <?php endif; ?>
</nav>

<div class="container">
    <!-- Приветственный блок -->
    <section class="hero">
        <div class="hero-content">
            <h2>Инвестируйте в свое будущее сегодня!</h2>
            <p>Более 50,000 выпускников, 95% из которых получили работу или повышение в течение 6 месяцев после окончания курсов</p>
            <button onclick="location.href='register.html'">Начать обучение бесплатно</button>
        </div>
    </section>

    <!-- Преимущества платформы -->
    <section id="benefits">
        <h2 class="section-title">Почему выбирают нашу академию?</h2>
        <div class="benefits">
            <div class="benefit">
                <i class="fas fa-graduation-cap"></i>
                <h3>Экспертные знания</h3>
                <p>Наши курсы разрабатываются ведущими специалистами индустрии с актуальным практическим опытом</p>
            </div>
            <div class="benefit">
                <i class="fas fa-briefcase"></i>
                <h3>Карьерная поддержка</h3>
                <p>Помощь в составлении резюме, подготовка к собеседованиям и доступ к базе вакансий партнеров</p>
            </div>
            <div class="benefit">
                <i class="fas fa-certificate"></i>
                <h3>Признанные сертификаты</h3>
                <p>Наши сертификаты признаются ведущими компаниями и добавляют вес вашему резюме</p>
            </div>
        </div>
    </section>

    <!-- Статистика -->
    <section class="stats">
        <div class="stat-item">
            <h3>50,000+</h3>
            <p>Выпускников</p>
        </div>
        <div class="stat-item">
            <h3>120+</h3>
            <p>Профессиональных курсов</p>
        </div>
        <div class="stat-item">
            <h3>95%</h3>
            <p>Трудоустройство выпускников</p>
        </div>
        <div class="stat-item">
            <h3>200+</h3>
            <p>Компаний-партнеров</p>
        </div>
    </section>

    <!-- Популярные курсы -->
    <section id="courses">
        <h2 class="section-title">Наши популярные курсы</h2>
        <div class="course">
            <h3>Профессия Fullstack-разработчик</h3>
            <div class="meta">
                <span><i class="far fa-clock"></i> 8 месяцев</span>
                <span><i class="fas fa-user-tie"></i> Сергей Петров, Lead Developer в Яндекс</span>
                <span><i class="fas fa-star"></i> 4.9/5 (420 отзывов)</span>
            </div>
            <p>Комплексная программа подготовки fullstack-разработчиков с нуля до профессионального уровня. Изучите JavaScript, React, Node.js, базы данных и DevOps основы.</p>
            <button onclick="toggleCourseDetails('web-development')">Подробнее о курсе</button>
            <div id="web-development" class="course-details">
                <h4>Программа курса:</h4>
                <ul>
                    <li>Основы программирования и алгоритмы</li>
                    <li>HTML5, CSS3 и адаптивная верстка</li>
                    <li>JavaScript ES6+ и продвинутые концепции</li>
                    <li>React и современные фронтенд-фреймворки</li>
                    <li>Node.js и серверная разработка</li>
                    <li>Базы данных: SQL и NoSQL</li>
                    <li>DevOps основы: Docker, CI/CD</li>
                    <li>Командная разработка проекта</li>
                </ul>
                <h4>Результаты обучения:</h4>
                <p>После окончания курса вы сможете разрабатывать полноценные веб-приложения, работать как во фронтенд, так и в бэкенд разработке, и претендовать на позиции Junior Fullstack Developer.</p>
                <h4>Формат обучения:</h4>
                <p>Занятия 2 раза в неделю по вечерам, домашние задания с проверкой ментором, финальный проект для портфолио.</p>
                <button class="btn">Записаться на курс</button>
            </div>
        </div>
        <div class="course">
            <h3>Data Science с нуля до PRO</h3>
            <div class="meta">
                <span><i class="far fa-clock"></i> 6 месяцев</span>
                <span><i class="fas fa-user-tie"></i> Анна Смирнова, Data Scientist в Mail.ru Group</span>
                <span><i class="fas fa-star"></i> 4.8/5 (380 отзывов)</span>
            </div>
            <p>Практический курс по Data Science и Machine Learning с использованием Python. Научитесь анализировать данные, строить предсказательные модели и визуализировать результаты.</p>
            <button onclick="toggleCourseDetails('data-science')">Подробнее о курсе</button>
            <div id="data-science" class="course-details">
                <h4>Программа курса:</h4>
                <ul>
                    <li>Основы Python для анализа данных</li>
                    <li>Библиотеки Pandas, NumPy, Matplotlib</li>
                    <li>Очистка и предобработка данных</li>
                    <li>Статистический анализ и визуализация</li>
                    <li>Машинное обучение с Scikit-learn</li>
                    <li>Нейронные сети и глубокое обучение</li>
                    <li>Работа с большими данными</li>
                    <li>Реальные кейсы из бизнеса</li>
                </ul>
                <h4>Результаты обучения:</h4>
                <p>Вы освоите полный цикл работы с данными: от сбора и очистки до построения и внедрения моделей машинного обучения, сможете решать реальные бизнес-задачи.</p>
                <h4>Формат обучения:</h4>
                <p>Видеолекции, практические задания на реальных датасетах, менторская поддержка, финальный проект для портфолио.</p>
                <button class="btn">Записаться на курс</button>
            </div>
        </div>
        <div class="course">
            <h3>Профессия Digital-маркетолог</h3>
            <div class="meta">
                <span><i class="far fa-clock"></i> 4 месяца</span>
                <span><i class="fas fa-user-tie"></i> Дмитрий Иванов, Marketing Director в Avito</span>
                <span><i class="fas fa-star"></i> 4.7/5 (350 отзывов)</span>
            </div>
            <p>Комплексное обучение digital-маркетингу: от SEO и контекстной рекламы до SMM и email-маркетинга. Научитесь привлекать клиентов и увеличивать продажи.</p>
            <button onclick="toggleCourseDetails('digital-marketing')">Подробнее о курсе</button>
            <div id="digital-marketing" class="course-details">
                <h4>Программа курса:</h4>
                <ul>
                    <li>Стратегии digital-маркетинга</li>
                    <li>SEO: оптимизация и продвижение сайтов</li>
                    <li>Контекстная реклама: Google Ads, Яндекс.Директ</li>
                    <li>Таргетированная реклама в соцсетях</li>
                    <li>Контент-маркетинг и копирайтинг</li>
                    <li>Email-маркетинг и CRM</li>
                    <li>Аналитика: Google Analytics, Яндекс.Метрика</li>
                    <li>Управление digital-проектами</li>
                </ul>
                <h4>Результаты обучения:</h4>
                <p>Вы сможете разрабатывать и реализовывать комплексные digital-стратегии, запускать и оптимизировать рекламные кампании, анализировать их эффективность.</p>
                <h4>Формат обучения:</h4>
                <p>Интерактивные вебинары, разбор реальных кейсов, практические задания с обратной связью, разработка маркетингового плана для реального бизнеса.</p>
                <button class="btn">Записаться на курс</button>
            </div>
        </div>
        <div class="text-center mt-30">
            <a href="#all-courses" class="btn btn-orange">Смотреть все курсы (120+)</a>
        </div>
    </section>

    <!-- Процесс обучения -->
    <section id="process" class="learning-process">
        <h2 class="section-title">Как проходит обучение</h2>
        <div class="process-steps">
            <div class="process-step">
                <div class="step-number">1</div>
                <h4>Запись на курс</h4>
                <p>Выбираете подходящий курс, оформляете заявку и получаете доступ к учебным материалам</p>
            </div>
            <div class="process-step">
                <div class="step-number">2</div>
                <h4>Теоретическая подготовка</h4>
                <p>Изучаете материалы в удобном темпе: видеоуроки, статьи, презентации и дополнительные ресурсы</p>
            </div>
            <div class="process-step">
                <div class="step-number">3</div>
                <h4>Практические задания</h4>
                <p>Выполняете задания, получаете обратную связь от преподавателей и совершенствуете навыки</p>
            </div>
            <div class="process-step">
                <div class="step-number">4</div>
                <h4>Финальный проект</h4>
                <p>Разрабатываете проект для портфолио, который демонстрирует ваши новые профессиональные навыки</p>
            </div>
        </div>
    </section>

    <!-- Сертификация -->
    <section id="certification" class="certification">
        <h2>Сертификация </h2>
        <p>После успешного завершения курса вы получите официальный сертификат нашей академии, который подтверждает ваши профессиональные компетенции и высоко ценится работодателями.</p>
        
        <div class="certificate-sample">
            <img src="sertificat.png" alt="Образец сертификата" style="width:100%;">
        </div>
        
        <h3>Преимущества нашего сертификата:</h3>
        <div class="benefits">
            <div class="benefit">
                <i class="fas fa-check-circle"></i>
                <h4>Официальный документ</h4>
                <p>Сертификат установленного образца с защитой от подделки</p>
            </div>
            <div class="benefit">
                <i class="fas fa-building"></i>
                <h4>Признание работодателями</h4>
                <p>Более 200 компаний-партнеров признают наши сертификаты</p>
            </div>
            <div class="benefit">
                <i class="fas fa-globe"></i>
                <h4>Международное признание</h4>
                <p>Возможность нострификации для работы за рубежом</p>
            </div>
        </div>
        
        <p class="mt-30">Все выпускники получают доступ к базе вакансий наших партнеров и приглашения на специализированные карьерные мероприятия.</p>
    </section>

    <!-- О нас -->
    <section id="about" class="about-section">
        <h2 class="section-title">О нашей академии</h2>
        <p>
            Академия Профессионального Развития — это ведущая образовательная платформа, которая с 2015 года помогает людям осваивать востребованные профессии и развивать карьеру. Мы объединяем экспертов-практиков и современные образовательные технологии, чтобы дать нашим студентам актуальные знания и практические навыки.
        </p>
        
        <div class="mission-values">
            <div class="mission">
                <h3>Наша миссия</h3>
                <p>
                    Мы стремимся сделать качественное профессиональное образование доступным для каждого, независимо от возраста, местоположения и начального уровня подготовки. Наша цель — помочь людям реализовать свой потенциал, найти любимую работу или создать собственный бизнес.
                </p>
                <p>
                    В отличие от традиционных учебных заведений, мы фокусируемся на практических навыках, которые действительно востребованы на рынке труда. Наши программы регулярно обновляются с учетом изменений в индустрии.
                </p>
            </div>
            <div class="values">
                <h3>Наши ценности</h3>
                <ul>
                    <li><strong>Практическая направленность:</strong> 80% времени — практика и реальные кейсы</li>
                    <li><strong>Доступность:</strong> Гибкие форматы обучения и платежей</li>
                    <li><strong>Качество:</strong> Преподаватели-практики с опытом работы в ведущих компаниях</li>
                    <li><strong>Поддержка:</strong> Персональные менторы и карьерные консультанты</li>
                    <li><strong>Сообщество:</strong> Доступ к сети выпускников и профессиональным мероприятиям</li>
                </ul>
            </div>
        </div>
        
        <h3>Наши достижения</h3>
        <p>
            За 8 лет работы мы выпустили более 50,000 специалистов, 95% из которых успешно трудостроились или получили повышение. Наши курсы прошли сотрудники таких компаний как Яндекс, Сбербанк, Mail.ru Group, Google и многих других. В 2022 году мы вошли в топ-5 лучших образовательных платформ по версии РБК.
        </p>
        
        <h3>Партнеры</h3>
        <div class="partners">
            <div class="partner-logos">
                <div class="partner-logo">
                    <i class="fab fa-yandex" style="font-size: 3rem; color: #FF0000;"></i>
                    <p>Яндекс</p>
                </div>
                <div class="partner-logo">
                    <i class="fas fa-university" style="font-size: 3rem; color: #1A9F29;"></i>
                    <p>Сбербанк</p>
                </div>
                <div class="partner-logo">
                    <i class="fas fa-envelope" style="font-size: 3rem; color: #005FF9;"></i>
                    <p>Mail.ru Group</p>
                </div>
                <div class="partner-logo">
                    <i class="fas fa-shopping-cart" style="font-size: 3rem; color: #FF6A00;"></i>
                    <p>Avito</p>
                </div>
                <div class="partner-logo">
                    <i class="fas fa-credit-card" style="font-size: 3rem; color: #FFDD2D;"></i>
                    <p>Тинькофф</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Преподаватели -->
    <section id="teachers">
        <h2 class="section-title">Наши преподаватели</h2>
        <p class="text-center mb-30">Учитесь у лучших экспертов-практиков с опытом работы в ведущих компаниях</p>
        
        <div class="team">
            <div class="team-member">
                <h4>Сергей Петров</h4>
                <p class="position">Lead Developer, Яндекс</p>
                <p class="bio">10+ лет опыта в веб-разработке, автор 3 патентов, руководитель команды разработки поискового алгоритма</p>
                <div class="social">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fas fa-globe"></i></a>
                </div>
            </div>
            <div class="team-member">
                <h4>Анна Смирнова</h4>
                <p class="position">Senior Data Scientist, Mail.ru Group</p>
                <p class="bio">Эксперт в машинном обучении и анализе больших данных, PhD по компьютерным наукам, спикер на международных конференциях</p>
                <div class="social">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-researchgate"></i></a>
                    <a href="#"><i class="fas fa-globe"></i></a>
                </div>
            </div>
            <div class="team-member">
                <h4>Дмитрий Иванов</h4>
                <p class="position">Marketing Director, Avito</p>
                <p class="bio">15 лет в digital-маркетинге, запустил более 200 успешных рекламных кампаний, автор книги "Digital-маркетинг в реалиях Рунета"</p>
                <div class="social">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fas fa-globe"></i></a>
                </div>
            </div>
            <div class="team-member">
                <h4>Елена Кузнецова</h4>
                <p class="position">UX/UI Lead, Сбербанк</p>
                <p class="bio">Специалист по пользовательскому опыту с 12-летним стажем, работала над интерфейсами для 10+ миллионов пользователей</p>
                <div class="social">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-behance"></i></a>
                    <a href="#"><i class="fas fa-globe"></i></a>
                </div>
            </div>
        </div>
        
        <div class="highlight">
            <div class="highlight-content">
                <h2>Как стать преподавателем в нашей академии?</h2>
                <p>Мы всегда открыты для сотрудничества с талантливыми специалистами-практиками. Если у вас есть экспертиза в востребованной области и желание делиться знаниями, присылайте свое резюме и предложение по курсу на hr@academypro.ru</p>
                <p>Наши преподаватели получают:</p>
                <ul style="text-align: left; display: inline-block;">
                    <li>Конкурентную оплату и гибкий график</li>
                    <li>Поддержку методистов в подготовке материалов</li>
                    <li>Доступ к современной образовательной платформе</li>
                    <li>Возможность влиять на развитие профессии</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Отзывы -->
    <section id="testimonials">
        <h2 class="section-title">Истории успеха наших выпускников</h2>
        <div class="testimonials">
            <div class="testimonial">
                <p>"После курса по веб-разработке я сменил профессию в 35 лет и устроился в IT-компанию. Через год уже стал тимлидом небольшой команды. Спасибо за качественное обучение и поддержку!"</p>
                <h4>Иван Петров</h4>
                <p class="position">Team Lead, WebStudio</p>
            </div>
            <div class="testimonial">
                <p>"Курс по Data Science дал мне системные знания и уверенность. После защиты дипломного проекта меня пригласили на работу в крупный банк. Мечта сбылась!"</p>
                <h4>Мария Иванова</h4>
                <p class="position">Data Analyst, Альфа-Банк</p>
            </div>
            <div class="testimonial">
                <p>"Благодаря курсу по digital-маркетингу я запустила успешный бизнес в инстаграме. За полгода вышла на доход 200к в месяц. Преподаватели - настоящие профессионалы!"</p>
                <h4>Анна Соколова</h4>
                <p class="position">Основатель, BeautyBox</p>
            </div>
        </div>
    </section>

    <!-- Цены -->
    <section id="pricing">
        <h2 class="section-title">Выберите подходящий формат обучения</h2>
        <div class="pricing">
            <div class="price-plan">
                <h3>Самостоятельный</h3>
                <p class="price">19,900 ₽ <span>/ курс</span></p>
                <ul>
                    <li>Доступ ко всем учебным материалам</li>
                    <li>Проверка домашних заданий</li>
                    <li>Сертификат об окончании</li>
                    <li>Доступ к комьюнити</li>
                    <li>Поддержка в чате</li>
                </ul>
                <button>Выбрать</button>
            </div>
            <div class="price-plan popular">
                <h3>Стандартный</h3>
                <p class="price">34,900 ₽ <span>/ курс</span></p>
                <ul>
                    <li>Все из тарифа "Самостоятельный"</li>
                    <li>Персональный ментор</li>
                    <li>Разбор ошибок и рекомендации</li>
                    <li>Доступ к закрытым вебинарам</li>
                    <li>Карьерная консультация</li>
                </ul>
                <button>Выбрать</button>
            </div>
            <div class="price-plan">
                <h3>Премиум</h3>
                <p class="price">59,900 ₽ <span>/ курс</span></p>
                <ul>
                    <li>Все из тарифа "Стандартный"</li>
                    <li>Индивидуальный график</li>
                    <li>Дополнительные практические кейсы</li>
                    <li>Гарантированное трудоустройство</li>
                    <li>Сертификат с отличием</li>
                </ul>
                <button>Выбрать</button>
            </div>
        </div>
        
        <div class="highlight">
            <div class="highlight-content">
                <h2>Рассрочка и корпоративное обучение</h2>
                <p>Мы предлагаем гибкие условия оплаты: рассрочку на 12 месяцев без переплат. Для компаний — специальные условия и адаптация программ под ваши бизнес-задачи.</p>
                <a href="#contact" class="btn btn-orange">Узнать подробности</a>
            </div>
        </div>
    </section>

    <!-- Контакты -->
    <section id="contact">
        <h2 class="section-title">Свяжитесь с нами</h2>
        <div class="contact-info">
            <div class="contact-form">
                <form>
                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" id="name" placeholder="Иван Иванов">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="example@mail.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" placeholder="+7 (123) 456-78-90">
                    </div>
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea id="message" placeholder="Ваш вопрос или комментарий"></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Отправить сообщение</button>
                </form>
            </div>
            <div class="contact-details">
                <h3>Контактная информация</h3>
                <p>Мы всегда рады ответить на ваши вопросы и помочь с выбором курса.</p>
                
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Колпино, бул. Трудящихся, 29</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <p>+7 (950) 046-30-00</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <p>lodkavovan@gmail.com</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <p>Пн-Пт: 9:00 - 20:00<br>Сб-Вс: 10:00 - 18:00</p>
                </div>
                
                <h3>Мы в соцсетях</h3>
                <div style="font-size: 1.5rem; margin-top: 15px;">
                    <a href="#" style="color: #3498db; margin-right: 15px;"><i class="fab fa-vk"></i></a>
                    <a href="#" style="color: #3498db; margin-right: 15px;"><i class="fab fa-telegram"></i></a>
                    <a href="#" style="color: #3498db; margin-right: 15px;"><i class="fab fa-youtube"></i></a>
                    <a href="#" style="color: #3498db;"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </section>
</div>

<footer>
    <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; flex-wrap: wrap;">
        <div style="width: 30%; margin-bottom: 20px;">
            <h3 style="color: #f39c12;">Академия Профессионального Развития</h3>
            <p>Лицензия на образовательную деятельность №123456 от 01.01.2020</p>
        </div>
        <div style="width: 20%; margin-bottom: 20px;">
            <h4>Курсы</h4>
            <ul style="list-style: none; padding: 0;">
                <li><a href="#" style="color: #fff; text-decoration: none;">Программирование</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Дизайн</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Маркетинг</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Аналитика</a></li>
            </ul>
        </div>
        <div style="width: 20%; margin-bottom: 20px;">
            <h4>Компания</h4>
            <ul style="list-style: none; padding: 0;">
                <li><a href="#" style="color: #fff; text-decoration: none;">О нас</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Преподаватели</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Вакансии</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Блог</a></li>
            </ul>
        </div>
        <div style="width: 20%; margin-bottom: 20px;">
            <h4>Поддержка</h4>
            <ul style="list-style: none; padding: 0;">
                <li><a href="#" style="color: #fff; text-decoration: none;">Контакты</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">FAQ</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Документы</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Политика конфиденциальности</a></li>
            </ul>
        </div>
    </div>
    <p style="margin-top: 30px;">&copy; 2025 Академия Профессионального Развития. Все права защищены.</p>
</footer>

<script>
    function toggleCourseDetails(id) {
        const details = document.getElementById(id);
        details.classList.toggle('active');
    }

    // Check if user is logged in
    function checkLoginStatus() {
        // This is a placeholder - in a real application, you would check the actual login status
        // For example, from localStorage, sessionStorage, or a server-side session
        const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
        
        const authButtons = document.getElementById('auth-buttons');
        const personalCabinet = document.getElementById('personal-cabinet');
        
        if (isLoggedIn) {
            authButtons.style.display = 'none';
            personalCabinet.style.display = 'inline-block';
        } else {
            authButtons.style.display = 'inline-block';
            personalCabinet.style.display = 'none';
        }
    }

    // Check login status when page loads
    document.addEventListener('DOMContentLoaded', checkLoginStatus);
</script>
</body>
</html>                                                         