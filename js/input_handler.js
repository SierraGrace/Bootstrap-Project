const nameLabel = document.getElementById('userNameInput');
const loginLabel = document.getElementById('loginInput');
const passwordLabel = document.getElementById('passwordInput');
const isAdminLabel = document.getElementById('isAdminCheck');

const loginSignIn = document.getElementById('loginSignIn');
const passwordSignIn = document.getElementById('passwordSignIn');

const textInput = document.getElementById('textInput');

const ws = new WebSocket('ws://localhost:8001');

ws.onmessage = response => {
	const message = JSON.parse(response.data);

	if(message.type === "User name") {
		nameLabel.textContent = message.value;
	} else if (message.type === "Login") {
		loginLabel.textContent = message.value;
	} else if (message.type === "Password") {
		passwordLabel.textContent = message.value;
	} else if (message.type === "Is Admin") {
		isAdminLabel.textContent = message.value;
	} else if (message.type === "Login Sign In") {
		loginSignIn.textContent = message.value;
	} else if (message.type === "Password Sign In") {
		passwordSignIn.textContent = message.value;
	} else if (message.type === "Text input") {
		textInput.textContent = message.value;
	}
};