// Общие функции для всех страниц (можно вынести в отдельный файл script.js)
document.addEventListener('DOMContentLoaded', function() {
    // Плавная прокрутка для якорных ссылок
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  
    // Обработчик для всех форм
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Очистка предыдущих сообщений об ошибках
        const errorMessage = document.getElementById('error-message');
        errorMessage.style.display = 'none';
        
        try {
          const formData = new FormData(this);
          const response = await fetch(this.action, {
            method: 'POST',
            body: formData
          });
          
          if (!response.ok) {
            throw new Error('Ошибка сервера');
          }
          
          const result = await response.json();
          
          if (result.success) {
            // Сохранение данных пользователя в localStorage
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('userData', JSON.stringify(result.user));
            
            // Перенаправление на главную страницу
            window.location.href = 'index.html';
          } else {
            // Отображение сообщения об ошибке
            errorMessage.textContent = result.message;
            errorMessage.style.display = 'block';
            
            // Добавление класса ошибки к полям формы
            if (result.field) {
              const input = document.getElementById(result.field);
              if (input) {
                input.classList.add('error');
                input.focus();
              }
            }
          }
        } catch (error) {
          errorMessage.textContent = 'Произошла ошибка при авторизации. Пожалуйста, попробуйте позже.';
          errorMessage.style.display = 'block';
        }
      });
    });
  
    // Инициализация функционала для главной страницы
    if (document.querySelector('.container')) {
      initHomePage();
    }
  
    // Проверка авторизации
    checkAuthStatus();
  });
  
  // Функции для главной страницы
  function initHomePage() {
    // Переключение деталей курса
    document.querySelectorAll('.course button').forEach(button => {
      button.addEventListener('click', function() {
        const details = this.nextElementSibling;
        details.classList.toggle('active');
        this.textContent = details.classList.contains('active') ? 'Скрыть детали' : 'Подробнее о курсе';
      });
    });
  
    // Обработчик для кнопок "Записаться на курс"
    document.querySelectorAll('.course .btn').forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        if (!localStorage.getItem('isLoggedIn')) {
          window.location.href = 'login.html';
        } else {
          // Логика записи на курс...
        }
      });
    });
  }
  
  // Функции авторизации
  function checkAuthStatus() {
    if (localStorage.getItem('isLoggedIn')) {
      document.querySelectorAll('.auth-link').forEach(link => {
        link.style.display = 'none';
      });
    }
  }
  
  // Модальное окно (общее для всех страниц)
  function showModal(title, content) {
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.innerHTML = `
      <div class="modal-content">
        <h3>${title}</h3>
        <p>${content}</p>
        <button class="modal-close">Закрыть</button>
      </div>
    `;
    document.body.appendChild(modal);
  
    modal.querySelector('.modal-close').addEventListener('click', () => {
      modal.remove();
    });
  }
  
  // Валидация форм
  function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
  }
  
  function validatePassword(password) {
    return password.length >= 6;
  }