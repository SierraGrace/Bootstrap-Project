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
});

login.addEventListener('keyup', event => {
	message.type = "Login";
	message.value = login.value;

	console.log(message);
});

password.addEventListener('keyup', event => {
	message.type = "Password";
	message.value = password.value;

	console.log(message);
});

adminCheck.addEventListener('change', event => {
	message.type = "Is Admin";
	message.value = adminCheck.checked;

	console.log(message);
});

auth_login.addEventListener('keyup', event => {
	message.type = "Login Sign In";
	message.value = auth_login.value;

	console.log(message);
});

auth_password.addEventListener('keyup', event => {
	message.type = "Password Sign In";
	message.value = auth_password.value;

	console.log(message);
});