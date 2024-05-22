document.addEventListener('DOMContentLoaded', function() {
    // var eventsData = document.getElementById('eventsData').textContent;
    // var slides = JSON.parse(eventsData);
    var eventsData = null;//document.getElementById('eventsData').textContent;
    var slides = null;//JSON.parse(eventsData);
    fetch("/events")
        .then(res => res.json())
        .then(res => {
            console.log('here' , res);
            slides = res;
            initSlider(slides);
        })

   

    function initSlider(slides) {
        const listContainer = document.querySelector('.list');
        const thumbnailContainer = document.querySelector('.thumbnail');
    
        // Clear existing content
        listContainer.innerHTML = '';
        thumbnailContainer.innerHTML = '';
    
        slides.forEach((slide, index) => {
            const listItem = document.createElement('div');
            listItem.className = 'item' + (index === slides.length - 1 ? ' active' : '');
            listItem.innerHTML = `
                <img src="${slide.image_url}">
                <div class="content">
                    <p>design</p>
                    <div id="poz2" class="inline-block relative">
                        <div id="poz2" class="-z-10 absolute -left-0 -top-10 transform">
                            <img src="./images/e1.png">
                        </div>
                    </div>
                    <h2>${slide.title}</h2>
                    <p>${slide.comment}</p>
                </div>
            `;
            // Use prepend to add the item at the beginning of the container
            listContainer.prepend(listItem);
    
            // Create thumbnail item
            const thumbnailItem = document.createElement('div');
            thumbnailItem.className = 'item' + (index === slides.length - 1 ? ' active' : '');
            thumbnailItem.innerHTML = `
                <img src="${slide.image_url}">
                <div class="content">
                    <h4>${slide.title}</h4>
                    <div>
                    <p>Start: ${slide.from}</p>
                    <p>End: ${slide.to}</p>
                    </div>
                </div>
            `;
            thumbnailItem.addEventListener('click', () => {
                updateActiveSlide(index);
            });
            // Use prepend to add the thumbnail at the beginning of the container
            thumbnailContainer.prepend(thumbnailItem);
        });
    
        initSmoothScrolling(thumbnailContainer);
        initDragToScroll(thumbnailContainer);
    }

    function updateActiveSlide(newActiveIndex) {
        const items = Array.from(document.querySelectorAll('.slider .list .item')).reverse();
        const thumbnails = Array.from(document.querySelectorAll('.thumbnail .item')).reverse();

        // Remove 'active' class from all items and thumbnails
        document.querySelector('.slider .list .item.active').classList.remove('active');
        document.querySelector('.thumbnail .item.active').classList.remove('active');

        // Add 'active' class to new active items and thumbnails
        items[newActiveIndex].classList.add('active');
        thumbnails[newActiveIndex].classList.add('active');
    }

    function initSmoothScrolling(container) {
        let startX;
        let isTouching = false;

        container.addEventListener('touchstart', e => {
            startX = e.touches[0].pageX;  // Initialize startX on touchstart
            isTouching = true;
        });

        container.addEventListener('touchmove', e => {
            if (!isTouching) return;
            const deltaX = e.touches[0].pageX - startX;
            startX = e.touches[0].pageX; // Update startX to the new touch position
            container.scrollLeft -= deltaX;
        }, { passive: true });

        container.addEventListener('touchend', () => {
            isTouching = false;
        });
    }

    function initDragToScroll(container) {
        let startX;
        let scrollStartX;
        let isDragging = false;

        container.addEventListener('mousedown', e => {
            isDragging = true;
            startX = e.pageX; // Initialize startX on mousedown
            scrollStartX = container.scrollLeft;
            e.preventDefault(); // Prevent default drag behavior
        });

        document.addEventListener('mousemove', e => {
            if (!isDragging) return;
            const deltaX = e.pageX - startX;
            container.scrollLeft -= deltaX;
            startX = e.pageX; // Update startX to the new mouse position
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });
    }
});
