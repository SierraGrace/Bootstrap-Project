let message = {
	"logged_in" : 1,
	"session_id" : "session_id",
	"type" : "type",
	"value" : "value"
};

usertext.addEventListener('keyup', event => {
	message.type = "Text";
	message.value = usertext.value;

	console.log(message);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});