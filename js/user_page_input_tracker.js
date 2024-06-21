// let textInput;
const textInput = document.getElementById('textInput');

// if (document.getElementById('textInput')) {
// 	console.log("Kuru kuru");
// } else {
// 	console.log("Not kuru kuru(((");
// }

//const ws = new WebSocket('ws://localhost:8001');

let message = {
	"logged_in" : 1,
	"session_id" : sessionData.value,
	"type" : "type",
	"value" : "value"
};

textInput.addEventListener('keyup', event => {
	message.type = "Text input";
	message.value = textInput.value;

	console.log(message.logged_in);
	console.log(message.session_id);

	let jsonMessage = JSON.stringify(message);
	ws.send(jsonMessage);
});