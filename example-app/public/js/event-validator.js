document.getElementById('event-form').addEventListener('submit', function(event) {
    let isValid = true;
    
    document.querySelectorAll('.text-red-500').forEach(el => el.textContent = '');

    const title = document.getElementById('event-name').value.trim();
    if (title === '') {
        isValid = false;
        document.getElementById('title-error').textContent = 'Event name is required.';
    }

    const startDate = document.getElementById('start-date').value.trim();
    if (startDate === '') {
        isValid = false;
        document.getElementById('start-date-error').textContent = 'Start date is required.';
    }

    const endDate = document.getElementById('end-date').value.trim();
    if (endDate === '') {
        isValid = false;
        document.getElementById('end-date-error').textContent = 'End date is required.';
    } else if (startDate !== '' && new Date(startDate) > new Date(endDate)) {
        isValid = false;
        document.getElementById('end-date-error').textContent = 'End date must be after start date.';
    }

    const comment = document.getElementById('comment').value.trim();
    if (comment === '') {
        isValid = false;
        document.getElementById('comment-error').textContent = 'Comment is required.';
    }

    const contact = document.getElementById('contact').value.trim();
    if (contact === '') {
        isValid = false;
        document.getElementById('contact-error').textContent = 'Contact information is required.';
    }

    const location = document.getElementById('location').value.trim();
    if (location === '') {
        isValid = false;
        document.getElementById('location-error').textContent = 'Location is required.';
    }

    const type = document.getElementById('type').value.trim();
    if (type === '') {
        isValid = false;
        document.getElementById('type-error').textContent = 'Type is required.';
    }

    const imageUrl = document.getElementById('image-url').value.trim();
    if (imageUrl === '') {
        isValid = false;
        document.getElementById('image-url-error').textContent = 'Image URL is required.';
    } else {
        try {
            new URL(imageUrl);
        } catch (_) {
            isValid = false;
            document.getElementById('image-url-error').textContent = 'Invalid URL format.';
        }
    }

    if (!isValid) {
        event.preventDefault();
    }
});



