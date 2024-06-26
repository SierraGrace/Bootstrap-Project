let message = {
	"logged_in" : 0,
	"session_id" : sessionData.value,
	"type" : "type",
	"value" : "value"
};

userNameInput.addEventListener('keyup', event => {
	message.type = "User name";
	message.value = userNameInput.value;

	console.log(message);

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

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

loginSignIn.addEventListener('keyup', event => {
	message.type = "Login Sign In";
	message.value = loginSignIn.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

passwordSignIn.addEventListener('keyup', event => {
	message.type = "Password Sign In";
	message.value = passwordSignIn.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});