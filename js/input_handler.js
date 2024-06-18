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

	switch (message.type) {
		case "User name":
			nameLabel.textContent = message.value;
			break;
		case "Login":
			loginLabel.textContent = message.value;
			break;
		case "Password":
			passwordLabel.textContent = message.value;
			break;
		case "Is Admin":
			isAdminLabel.textContent = message.value;
			break;
		case "Login Sign In":
			loginSignIn.textContent = message.value;
			break;
		case "Password Sign In":
			passwordSignIn.textContent = message.value;
			break;
		case "Text input":
			textInput.textContent = message.value;
			break;
		default:
			break;
	}
};