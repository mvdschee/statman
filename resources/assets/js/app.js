var pathname = window.location.pathname;
page = pathname.substring(1, pathname.length);

var loginTab = document.getElementById('js-login-tab');
var registerTab = document.getElementById('js-register-tab');

var loginPage = document.getElementById('login');
var registerPage = document.getElementById('register');

var error = document.getElementById('js-error');
var close = document.getElementById('js-close');

if (close) {
	close.addEventListener('click', removeError);
}

// this function checks what page you're on (login or register) and loads the correct html
function loadPage(){
	var pageDiv = document.getElementById(page);
	var progress = document.getElementById('js-progress');
	var view = document.getElementById('js-view');

	if (page == 'login' || page == 'register') {
		var pageTab = document.getElementById('js-'+page+'-tab');
		progress.classList.remove('invisible');
	}

	if (page != 'login' && page != 'register') {
		view.classList.add('full-width');
	}

	pageDiv.classList.remove('invisible');
	pageTab.classList.add('tab-active');
}

// switches from the register form to the login form
function login() {
	loginTab.classList.add('tab-active');
	registerTab.classList.remove('tab-active');

	loginPage.classList.remove('invisible');
	registerPage.classList.add('invisible');
}

// switches from the login form to the register form
function register() {
	registerTab.classList.add('tab-active');
	loginTab.classList.remove('tab-active');

	registerPage.classList.remove('invisible');
	loginPage.classList.add('invisible');
}

function removeError() {
	error.classList.add('invisible');
}