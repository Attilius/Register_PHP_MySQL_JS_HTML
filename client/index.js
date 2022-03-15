const menuLogin = document.getElementById('menu-login');
const menuRegister = document.getElementById('menu-register');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

menuLogin.addEventListener("click", () => {
    loginForm.style.display = "flex";
});

menuRegister.addEventListener("click", () => {
    registerForm.style.display = "flex";
});

registerForm.addEventListener("submit", register);
loginForm.addEventListener("submit", login);

function login(e) {
    e.preventDefault();

    const params = `login-email=${document.getElementById('login-email').value}&login-passwd=${document.getElementById('login-passwd').value}`;

    const xhr = new XMLHttpRequest(),
        method = 'POST',
        url = 'http://localhost/helio/server/login.php';

    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        const resp = JSON.parse(this.responseText);

        if (resp.message === 'Successful') {
            document.getElementById('login-dropdown').style.display = "none";
            document.getElementById('loggedin-dropdown').style.display = "block";
            document.getElementById('user-email').textContent = resp.user;
            loginForm.style.display = "none";
        } else {
            return;
        }
    }

    xhr.send(params);
}
function register(e) {
    e.preventDefault();

    const passwd = document.getElementById('reg-passwd').value;
    const confirm_passwd = document.getElementById('confirm_passwd').value;

    if (passwd === confirm_passwd) {
        const params = `reg-email=${document.getElementById('reg-email').value}&reg-passwd=${passwd}`;

        const xhr = new XMLHttpRequest(),
            method = 'POST',
            url = 'http://localhost/helio/server/register.php';

        xhr.open(method, url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            const resp = JSON.parse(this.responseText);

            if (resp.message === 'Successful') {
                registerForm.style.display = "none";
                loginForm.style.display = "flex";
            } else {
                return;
            }
        }

        xhr.send(params);
    } else {
        document.getElementById('error-msg').textContent = "The both password is not equal!"
    }


}