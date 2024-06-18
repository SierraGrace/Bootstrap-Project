const textInput = document.getElementById('textInput');

const ws = new WebSocket('ws://localhost:8001');

let message = {
	"type" : "type",
	"value" : "value"
};

textInput.addEventListener('keyup', event => {
	message.type = "Text input";
	message.value = textInput.value;
	console.log("Message saved");

	let jsonMessage = JSON.stringify(message);
	console.log(jsonMessage);
	ws.send(jsonMessage);
	console.log("Message send");
});