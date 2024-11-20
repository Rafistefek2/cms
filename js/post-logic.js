document.addEventListener('DOMContentLoaded', () => {
    //? kod się wywalal to gpt zaproponowal zaladowanie domu boje sie sprawdzic 
    //?                                     czy defer dzialaloby tak samo


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
                const isExpanded = postContent.classList.contains('post-showed');
                
                postContent.classList.toggle('post-hidden', isExpanded);
                postContent.classList.toggle('post-showed', !isExpanded);

                showButton.setAttribute('aria-expanded', !isExpanded);
                showButton.textContent = isExpanded ? 'czytaj więcej' : 'zwiń';
            });
        }
    });
});