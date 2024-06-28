const textInput = document.getElementById('textInput');

const ws = new WebSocket('ws://localhost:8001');

ws.onopen = function() {
	ws.send('admin');
};

let createdFlag = 0;


/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////

function getRowType(type) {
    switch (type) {
        case "User name":
            return '#name';
        case "Login":
            return '#login';
        case "Password":
            return '#password';
        case "Is Admin":
            return '#isAdmin';
        case "Login Sign In":
            return '#loginSignIn';
        case "Password Sign In":
            return '#passwordSignIn';
        case "Text input":
            return '#inputWrapper';
        default:
            return '';
    }
};

function getLabelType(type) {
    switch (type) {
        case "User name":
            return '#userNameInput';
        case "Login":
            return '#loginInput';
        case "Password":
            return '#passwordInput';
        case "Is Admin":
            return '#isAdminCheck';
        case "Login Sign In":
            return '#loginSignIn';
        case "Password Sign In":
            return '#passwordSignIn';
        case "Text input":
            return '#textInput';
        default:
            return '';
    }
};

/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////


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

function changeDivData(session_id, formType, rowType, lableType, messageValue) {
	var userDiv = document.getElementById(session_id);
	var row = userDiv.querySelector(formType);
	var label = row.querySelector(rowType);
	var innerLabel = label.querySelector(lableType);
	innerLabel.textContent = messageValue;
};

function createUnregisteredUserDiv(message) {
	var containerDiv = document.createElement('div');
	containerDiv.id = message.value;

    var h5Element = document.createElement('h5');
    h5Element.textContent = 'Unregistered user';
    containerDiv.appendChild(h5Element);

    var h6SignUp = document.createElement('h6');
    h6SignUp.textContent = 'Sign up form';
    containerDiv.appendChild(h6SignUp);

    var rowDiv1 = document.createElement('div');
    rowDiv1.className = 'row';
    rowDiv1.id = 'signUp';
    rowDiv1.appendChild(createLabel('col', 'name', 'User name: ', 'userNameInput', 'Default name'));
    rowDiv1.appendChild(createLabel('col', 'login', 'Login: ', 'loginInput', 'Default login'));
    rowDiv1.appendChild(createLabel('col', 'password', 'Password: ', 'passwordInput', 'Default password'));
    rowDiv1.appendChild(createLabel('col', 'isAdmin', 'Is Admin: ', 'isAdminCheck', 'False'));
    containerDiv.appendChild(rowDiv1);

    var h6SignIn = document.createElement('h6');
    h6SignIn.textContent = 'Sign in form';
    containerDiv.appendChild(h6SignIn);

    var rowDiv2 = document.createElement('div');
    rowDiv2.className = 'row';
    rowDiv2.id = 'signIn';

    rowDiv2.appendChild(createLabel('col', 'loginSignIn', 'Login: ', 'loginSignIn', 'Default login'));
    rowDiv2.appendChild(createLabel('col', 'passwordSignIn', 'Password: ', 'passwordSignIn', 'Default password'));
    containerDiv.appendChild(rowDiv2);

    var hrElement = document.createElement('hr');
    containerDiv.appendChild(hrElement);

	document.getElementById('unregisteredUsers').appendChild(containerDiv);
};

function createRegisteredUserDiv(message) {
	var containerDiv = document.createElement('div');
	containerDiv.id = message.value;

	var h5Element = document.createElement('h5');
	h5Element.textContent = 'Registered user';

	containerDiv.appendChild(h5Element);

	var h6Inp = document.createElement('h6');
	h6Inp.textContent = 'Input field';

	containerDiv.appendChild(h6Inp);

	var rowDiv1 = document.createElement('div');
	rowDiv1.className = 'row';
	rowDiv1.id = 'input';

	rowDiv1.appendChild(createLabel('col', 'inputWrapper', 'Text: ', 'textInput', 'Default text'));
	containerDiv.appendChild(rowDiv1);

	var hrElement = document.createElement('hr');
	containerDiv.appendChild(hrElement);

	document.getElementById('registeredUsers').appendChild(containerDiv);
};

ws.onmessage = response => {

	const message = JSON.parse(response.data);

	if (message.type === 'existing_data') {

		const existingData = message.data;
        
        for (const sessionId in existingData) {
            const userData = existingData[sessionId];

            if (userData.logged_in === 0) {
                createUnregisteredUserDiv({value: sessionId});
            } else if (userData.logged_in === 1) {
                createRegisteredUserDiv({value: sessionId});
            }

            userData.messages.forEach(msg => {
                switch (msg.type) {
                    case "Session id":
                        break;
                    case "User name":
                        changeDivData(sessionId, '#signUp', '#name', '#userNameInput', msg.value);
                        break;
                    case "Login":
                        changeDivData(sessionId, '#signUp', '#login', '#loginInput', msg.value);
                        break;
                    case "Password":
                        changeDivData(sessionId, '#signUp', '#password', '#passwordInput', msg.value);
                        break;
                    case "Is Admin":
                        changeDivData(sessionId, '#signUp', '#isAdmin', '#isAdminCheck', msg.value);
                        break;
                    case "Login Sign In":
                        changeDivData(sessionId, '#signIn', '#loginSignIn', '#loginSignIn', msg.value);
                        break;
                    case "Password Sign In":
                        changeDivData(sessionId, '#signIn', '#passwordSignIn', '#passwordSignIn', msg.value);
                        break;
                    case "Text input":
                        changeDivData(sessionId, '#input', '#inputWrapper', '#textInput', msg.value);
                        break;
                    default:
                        break;
                }
            });
        }
	} else {
		switch (message.type) {
			case "Session id":
		        if (message.logged_in === 0) {
		        	var existingDiv = document.getElementById(message.value);

		        	if (!existingDiv) {
		        		createUnregisteredUserDiv(message);
		        		createdFlag = 1;
						console.log("Session id successfully transfered: " + message.value);
		        	} else if (existingDiv) {
		        		console.log(message.value);
		        		existingDiv.remove();
		        		createUnregisteredUserDiv(message);
		        	}
		    	} else if (message.logged_in === 1) {
		    		var existingDiv = document.getElementById(message.value);

		        	if (existingDiv) {
					 	existingDiv.remove();

					 	createRegisteredUserDiv(message);
					 	createdFlag = 1;
						
						console.log("Session id successfully transfered: " + message.value);
					}
				}
				break;
			case "User name":
				changeDivData(message.session_id, '#signUp', '#name', '#userNameInput', message.value);
				break;
			case "Login":
				changeDivData(message.session_id, '#signUp', '#login', '#loginInput', message.value);
				break;
			case "Password":
				changeDivData(message.session_id, '#signUp', '#password', '#passwordInput', message.value);
				break;
			case "Is Admin":
				changeDivData(message.session_id, '#signUp', '#isAdmin', '#isAdminCheck', message.value);
				break;
			case "Login Sign In":
				changeDivData(message.session_id, '#signIn', '#loginSignIn', '#loginSignIn', message.value);
				break;
			case "Password Sign In":
				changeDivData(message.session_id, '#signIn', '#passwordSignIn', '#passwordSignIn', message.value);
				break;
			case "Text input":
				changeDivData(message.session_id, '#input', '#inputWrapper', '#textInput', message.value);
				break;
			default:
				break;
		}
	}
};