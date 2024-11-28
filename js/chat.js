document.addEventListener('DOMContentLoaded', () => {
    console.log('dupa1234523')
    const chatContent = document.getElementById('chatcontent');
    const chatForm = document.querySelector('.czat');

    // Function to fetch and update chat messages
    const updateChat = () => {
        fetch('fetch_chat.php') // Fetch chat messages from the server
            .then(response => response.text())
            .then(data => {
                chatContent.innerHTML = data; // Update the chat content
            })
            .catch(error => console.error('Error fetching chat:', error));
    };

    // Periodically refresh chat messages
    setInterval(updateChat, 2000);

    // Submit chat message via form
    chatForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent default form submission
        const formData = new FormData(chatForm);

        fetch('index.php', { // Send form data to the same PHP file
            method: 'POST',
            body: formData
        })
        .then(() => {
            document.getElementById('inputsend').value = ''; // Clear input field
            updateChat(); // Refresh chat content
        })
        .catch(error => console.error('Error submitting message:', error));
    });

    // Initial chat load
    updateChat();
});