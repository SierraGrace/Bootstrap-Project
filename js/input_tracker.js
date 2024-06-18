const userNameInput = document.getElementById('userNameInput');
const loginInput = document.getElementById('loginInput');
const passwordInput = document.getElementById('passwordInput');
const isAdminCheck = document.getElementById('isAdminCheck');

const ws = new WebSocket('ws://localhost:8001');

let message = {
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

isAdminCheck.addEventListener('change', event => {
	message.type = "Is Admin";
	message.value = isAdminCheck.checked;
	console.log("admin state changed");

	let jsonMessage = JSON.stringify(message);
	console.log(jsonMessage);
	ws.send(jsonMessage);
});