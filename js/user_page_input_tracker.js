let textInput;

if (document.getElementById('textInput')) {
	console.log("Kuru kuru");
} else {
	console.log("Not kuru kuru(((");
}

const ws = new WebSocket('ws://localhost:8001');

let message = {
	//"logged_in" : 0,
	//"session_id" : "session_id,",
	"type" : "type",
	"value" : "value"
};

textInput.addEventListener('keyup', event => {
	message.type = "Text input";
	message.value = textInput.value;

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});