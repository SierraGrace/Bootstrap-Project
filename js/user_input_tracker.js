let message = {
	"logged_in" : 0,
	"session_id" : "session_id",
	"type" : "type",
	"value" : "value"
};

usertext.addEventListener('keyup', event => {
	message.type = "Text";
	message.value = usertext.value;

	console.log(message);
});