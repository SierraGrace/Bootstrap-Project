const userNameInput = document.getElementById('userNameInput');
const loginInput = document.getElementById('loginInput');
const passwordInput = document.getElementById('passwordInput');

const ws = new WebSocket('ws://localhost:8001');

 const message = {
	"type" : "type",
	"value" : "value"
};

userNameInput.addEventListener('keyup', event => {
	message.type = "User name";
	message.value = userNameInput.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

loginInput.addEventListener('keyup', event => {
	message.type = "Login";
	message.value = loginInput.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

passwordInput.addEventListener('keyup', event => {
	message.type = "Password";
	message.value = passwordInput.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});