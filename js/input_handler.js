const nameLabel = document.getElementById('userNameInput');
// const label = document.getElementById('loginInput');
// const label = document.getElementById('passwordInput');

const ws = new WebSocket('ws://localhost:8001');

ws.onmessage = response => {
	let value = response.data;
	nameLabel.textContent = value;
};  