document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.post').forEach(post => {
        const postContent = post.querySelector('.post-content');
        const showButton = post.querySelector('.btn-show');

        // Check if content exceeds the visible area
        const isOverflowing = postContent.scrollHeight > postContent.offsetHeight;

        if (!isOverflowing) {
            // Hide the button if there is no additional content to show
            showButton.style.display = 'none';
        } else {
            // Attach the event listener for toggling content
            showButton.addEventListener('click', () => {
                console.log("klikam klikam");
                const isExpanded = postContent.classList.contains('expanded');
                
                // Toggle the `expanded` class on the `postContent`
                if (isExpanded) {
                    postContent.classList.remove('expanded');
                } else {
                    postContent.classList.add('expanded');
                }

                // Update the button state and text
                showButton.setAttribute('aria-expanded', !isExpanded);
                showButton.textContent = isExpanded ? 'czytaj więcej' : 'zwiń';
            });
        }
    });
});
