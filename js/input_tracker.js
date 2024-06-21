// const userNameInput = document.getElementById('userNameInput');
// const loginInput = document.getElementById('loginInput');
// const passwordInput = document.getElementById('passwordInput');
// const isAdminCheck = document.getElementById('isAdminCheck');

 // const loginSignIn = document.getElementById('loginSignIn');
 // const passwordSignIn = document.getElementById('passwordSignIn');
 //Why does it work?
let message = {
	//"logged_in" : 0,
	"session_id" : "session_id,",
	"type" : "type",
	"value" : "value"
};

userNameInput.addEventListener('keyup', event => {
	//message.logged_in = 0;
	message.session_id = sessionData.value;
	message.type = "User name";
	message.value = userNameInput.value;

	console.log(sessionData);
	console.log(message.value);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

loginInput.addEventListener('keyup', event => {
	message.session_id = sessionData.value;
	message.type = "Login";
	message.value = loginInput.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

passwordInput.addEventListener('keyup', event => {
	message.session_id = sessionData.value;
	message.type = "Password";
	message.value = passwordInput.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

isAdminCheck.addEventListener('change', event => {
	message.session_id = sessionData.value;
	message.type = "Is Admin";
	message.value = isAdminCheck.checked;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

loginSignIn.addEventListener('keyup', event => {
	message.session_id = sessionData.value;
	message.type = "Login Sign In";
	message.value = loginSignIn.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});

passwordSignIn.addEventListener('keyup', event => {
	message.session_id = sessionData.value;
	message.type = "Password Sign In";
	message.value = passwordSignIn.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});