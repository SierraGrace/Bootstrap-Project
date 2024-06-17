const nameLabel = document.getElementById('userNameInput');
const loginLabel = document.getElementById('loginInput');
const passwordLabel = document.getElementById('passwordInput');

const ws = new WebSocket('ws://localhost:8001');

ws.onmessage = response => {
	const message = JSON.parse(response.data);

	if(message.type === "User name") {
		nameLabel.textContent = message.value;
	} else if (message.type === "Login") {
		loginLabel.textContent = message.value;
	} else if (message.type === "Password") {
		passwordLabel.textContent = message.value;
	}
};