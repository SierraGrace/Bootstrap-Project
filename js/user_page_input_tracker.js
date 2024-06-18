const textInput = document.getElementById('textInput');

const ws = new WebSocket('ws://localhost:8001');

let message = {
	"type" : "type",
	"value" : "value"
};

textInput.addEventListener('keyup', event => {
	message.type = "Text input";
	message.value = textInput.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});