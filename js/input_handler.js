// const nameLabel = document.getElementById('userNameInput');
// const loginLabel = document.getElementById('loginInput');
// const passwordLabel = document.getElementById('passwordInput');
// const isAdminLabel = document.getElementById('isAdminCheck');

// const loginSignIn = document.getElementById('loginSignIn');
// const passwordSignIn = document.getElementById('passwordSignIn');

const textInput = document.getElementById('textInput');

const ws = new WebSocket('ws://localhost:8001');

function createLabel(colClass, labelWrapId, textContent, labelId, labelText) {
    var labelWrapper = document.createElement('label');
    labelWrapper.className = colClass;
    labelWrapper.id = labelWrapId;
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
			console.log("Kuru kuru");
			console.log(message.session_id);
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
		        rowDiv1.id = 'signUp';
		        rowDiv1.appendChild(createLabel('col', 'name', 'User name: ', 'userNameInput', 'Default name'));
		        rowDiv1.appendChild(createLabel('col', 'login', 'Login: ', 'loginInput', 'Default login'));
		        rowDiv1.appendChild(createLabel('col', 'password', 'Password: ', 'passwordInput', 'Default password'));
		        rowDiv1.appendChild(createLabel('col', 'isAdmin', 'Is Admin: ', 'isAdminCheck', 'False'));
		        containerDiv.appendChild(rowDiv1);
		        // Создаем и добавляем второй h6 элемент
		        var h6SignIn = document.createElement('h6');
		        h6SignIn.textContent = 'Sign in form';
		        containerDiv.appendChild(h6SignIn);
		        // Создаем второй row div
		        var rowDiv2 = document.createElement('div');
		        rowDiv2.className = 'row';
		        rowDiv2.id = 'signIn';
		        // Добавляем label элементы во второй row div
		        rowDiv2.appendChild(createLabel('col', 'loginSignIn', 'Login: ', 'loginSignIn', 'Default login'));
		        rowDiv2.appendChild(createLabel('col', 'passwordSignIn','Password: ', 'passwordSignIn', 'Default password'));
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
			console.log(message.session_id);
			var userDiv = document.getElementById(message.session_id);
			var row = userDiv.querySelector('#signUp');
			var label = row.querySelector('#name');
			var innerLabel = label.querySelector('#userNameInput');
			innerLabel.textContent = message.value;
			break;
		case "Login":
			var userDiv = document.getElementById(message.session_id);
			var row = userDiv.querySelector('#signUp');
			var label = row.querySelector('#login');
			var innerLabel = label.querySelector('#loginInput');
			innerLabel.textContent = message.value;
			break;
		case "Password":
			var userDiv = document.getElementById(message.session_id);
			var row = userDiv.querySelector('#signUp');
			var label = row.querySelector('#password');
			var innerLabel = label.querySelector('#passwordInput');
			innerLabel.textContent = message.value;
			break;
		case "Is Admin":
			var userDiv = document.getElementById(message.session_id);
			var row = userDiv.querySelector('#signUp');
			var label = row.querySelector('#isAdmin');
			var innerLabel = label.querySelector('#isAdminCheck');
			innerLabel.textContent = message.value;
			break;
		case "Login Sign In":
			var userDiv = document.getElementById(message.session_id);
			var row = userDiv.querySelector('#signIn');
			var label = row.querySelector('#loginSignIn');
			var innerLabel = label.querySelector('#loginSignIn');
			innerLabel.textContent = message.value;
			break;
		case "Password Sign In":
			var userDiv = document.getElementById(message.session_id);
			var row = userDiv.querySelector('#signIn');
			var label = row.querySelector('#passwordSignIn');
			var innerLabel = label.querySelector('#passwordSignIn');
			innerLabel.textContent = message.value;
			break;
		case "Text input":
			var userDiv = document.getElementById(message.session_id);
			var row = userDiv.querySelector('.row');
			var label = row.querySelector('#name');
			var innerLabel = label.querySelector('#userNameInput');
			textInput.textContent = message.value;
			break;
		default:
			break;
	}
};