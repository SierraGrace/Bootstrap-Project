let message = {
	"logged_in" : 0,
	"session_id" : "session_id",
	"type" : "type",
	"value" : "value"
};

username.addEventListener('keyup', event => {
	message.type = "User name";
	message.value = username.value;

	console.log(message);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

login.addEventListener('keyup', event => {
	message.type = "Login";
	message.value = login.value;

	console.log(message);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

password.addEventListener('keyup', event => {
	message.type = "Password";
	message.value = password.value;

	console.log(message);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

adminCheck.addEventListener('change', event => {
	message.type = "Is Admin";
	message.value = adminCheck.checked;

	console.log(message);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

auth_login.addEventListener('keyup', event => {
	message.type = "Login Sign In";
	message.value = auth_login.value;

	console.log(message);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

auth_password.addEventListener('keyup', event => {
	message.type = "Password Sign In";
	message.value = auth_password.value;

	console.log(message);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});