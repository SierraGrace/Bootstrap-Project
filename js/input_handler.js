const nameLabel = document.getElementById('userNameInput');
const loginLabel = document.getElementById('loginInput');
const passwordLabel = document.getElementById('passwordInput');
const isAdminLabel = document.getElementById('isAdminCheck');

const loginSignIn = document.getElementById('loginSignIn');
const passwordSignIn = document.getElementById('passwordSignIn');

const textInput = document.getElementById('textInput');

const ws = new WebSocket('ws://localhost:8001');

function createLabel(colClass, textContent, labelId, labelText) {
    var labelWrapper = document.createElement('label');
    labelWrapper.className = colClass;
    labelWrapper.textContent = textContent;

    var labelElement = document.createElement('label');
    labelElement.id = labelId;
    labelElement.textContent = labelText;

    labelWrapper.appendChild(labelElement);
    return labelWrapper;
};

ws.onmessage = response => {
	const message = JSON.parse(response.data);

	switch (message.type) {
		case "Session id":
			var existingDiv = document.getElementById(message.value);
			if (!existingDiv) {
				var containerDiv = document.createElement('div');
				containerDiv.id = message.value;
	        	// Создаем и добавляем h5 элемент
		        var h5Element = document.createElement('h5');
		        h5Element.textContent = 'Unregistered user';
		        containerDiv.appendChild(h5Element);
		        // Создаем и добавляем h6 элемент
		        var h6SignUp = document.createElement('h6');
		        h6SignUp.textContent = 'Sign up form';
		        containerDiv.appendChild(h6SignUp);
		        // Создаем первый row div
		        var rowDiv1 = document.createElement('div');
		        rowDiv1.className = 'row';
		        rowDiv1.appendChild(createLabel('col', 'User name: ', 'userNameInput', 'Default name'));
		        rowDiv1.appendChild(createLabel('col', 'Login: ', 'loginInput', 'Default login'));
		        rowDiv1.appendChild(createLabel('col', 'Password: ', 'passwordInput', 'Default password'));
		        rowDiv1.appendChild(createLabel('col', 'Is Admin: ', 'isAdminCheck', 'False'));
		        containerDiv.appendChild(rowDiv1);
		        // Создаем и добавляем второй h6 элемент
		        var h6SignIn = document.createElement('h6');
		        h6SignIn.textContent = 'Sign in form';
		        containerDiv.appendChild(h6SignIn);
		        // Создаем второй row div
		        var rowDiv2 = document.createElement('div');
		        rowDiv2.className = 'row';
		        // Добавляем label элементы во второй row div
		        rowDiv2.appendChild(createLabel('col', 'Login: ', 'loginSignIn', 'Default login'));
		        rowDiv2.appendChild(createLabel('col', 'Password: ', 'passwordSignIn', 'Default password'));
		        containerDiv.appendChild(rowDiv2);
		        // Создаем и добавляем hr элемент
		        var hrElement = document.createElement('hr');
		        containerDiv.appendChild(hrElement);
		        // Добавляем созданный контейнер в DOM
		        document.getElementById('unregisteredUsers').appendChild(containerDiv);
				console.log("Session id successfully transfered: " + message.value);
				//console.log(containerDiv);
			}
			break;
		case "User name":
			nameLabel.textContent = message.value;
			break;
		case "Login":
			loginLabel.textContent = message.value;
			break;
		case "Password":
			passwordLabel.textContent = message.value;
			break;
		case "Is Admin":
			isAdminLabel.textContent = message.value;
			break;
		case "Login Sign In":
			loginSignIn.textContent = message.value;
			break;
		case "Password Sign In":
			passwordSignIn.textContent = message.value;
			break;
		case "Text input":
			textInput.textContent = message.value;
			break;
		default:
			break;
	}
};