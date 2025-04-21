// docs/assets/auth.js
const DEMO_USER = { email: 'admin@example.com', pass: 'qwerty' };

function isLoggedIn() {
  return localStorage.getItem('loggedIn') === 'yes';
}

function requireAuth() {
  if (!isLoggedIn()) location = 'index.html';
}

function login(e) {
  e.preventDefault();
  if (
    document.getElementById('email').value.trim() === DEMO_USER.email &&
    document.getElementById('password').value.trim() === DEMO_USER.pass
  ) {
    localStorage.setItem('loggedIn', 'yes');
    location = 'books.html';
  } else {
    alert('Неверный логин или пароль');
  }
}

function logout() {
  localStorage.removeItem('loggedIn');
  location = 'index.html';
}
