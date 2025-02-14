document.addEventListener("DOMContentLoaded", function () {
  const chatBox = document.getElementById("chat-box");
  const chatForm = document.getElementById("chat-form");
  const nameInput = document.getElementById("name");
  const messageInput = document.getElementById("message");

  let lastMessageId = null;

  function fetchMessages() {
    fetch("../core/apiChat.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {

          if (data.messages.length === 0 || (lastMessageId && lastMessageId === data.messages[0].id)) {
            return;
          }
          lastMessageId = data.messages[0].id;

          chatBox.innerHTML = "";
          data.messages.forEach((msg) => {
            const messageElem = document.createElement("div");
            messageElem.classList.add("chat-message");


            const nameSpan = document.createElement("span");
            nameSpan.classList.add("name");
            nameSpan.textContent = msg.name;

            const timeSpan = document.createElement("span");
            timeSpan.classList.add("time");
            timeSpan.textContent = `[${msg.created_at}]`;

            const textDiv = document.createElement("div");
            textDiv.classList.add("text");
            textDiv.textContent = msg.message;

            messageElem.appendChild(nameSpan);
            messageElem.appendChild(timeSpan);
            messageElem.appendChild(textDiv);
            chatBox.appendChild(messageElem);
          });
          chatBox.scrollTop = chatBox.scrollHeight;
        }
      })
      .catch((error) => console.error("Error fetching messages:", error));
  }

  fetchMessages();

  setInterval(fetchMessages, 5000); // Оновлюємо чат кожні 5 секунд

  chatForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const name = nameInput.value.trim();
    const message = messageInput.value.trim();

    // Валідація введених даних
    if (name === "") {
      alert("Ім'я не може бути порожнім");
      return;
    }
    if (name.length > 50) {
      alert("Ім'я не повинно перевищувати 50 символів");
      return;
    }
    if (message === "") {
      alert("Повідомлення не може бути порожнім");
      return;
    }
    if (message.length > 500) {
      alert("Повідомлення не повинно перевищувати 500 символів");
      return;
    }

    const formData = new FormData(chatForm);
    fetch("../core/apiChat.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          chatForm.reset();
          fetchMessages();
        } else {
          alert(data.message);
        }
      })
      .catch((error) => console.error("Error sending message:", error));
  });
});
