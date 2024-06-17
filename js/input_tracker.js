const userNameInput = document.getElementById('userNameInput');
const loginInput = document.getElementById('loginInput');
const passwordInput = document.getElementById('passwordInput');

const ws = new WebSocket('ws://localhost:8001');

userNameInput.addEventListener('keyup', event => {
	ws.send(userNameInput.value);
	console.log('meh');
});

// loginInput.addEventListener('keyup', event => {
// 	ws.send(loginInput.value);
// });

// passwordInput.addEventListener('keyup', event => {
// 	ws.send(passwordInput.value);
// });