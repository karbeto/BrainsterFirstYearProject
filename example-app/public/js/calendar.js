document.addEventListener('DOMContentLoaded', function () {
    var eventsData = document.getElementById('eventsData').textContent;

    var jsonData = JSON.parse(eventsData);
    decodeURI(jsonData);
    function transformEvents(jsonData) {
        const events = [];
        const eventCountPerDay = {};

        jsonData.forEach(eventData => {
            const start = new Date(eventData.from);
            const end = new Date(eventData.to);
            let currentDate = new Date(start);

            while (currentDate <= end) {
                const dateString = currentDate.toISOString().split('T')[0];
                if (!eventCountPerDay[dateString]) {
                    eventCountPerDay[dateString] = 0;
                }
                eventCountPerDay[dateString]++;
                events.push({
                    title: eventData.title,
                    start: dateString,
                    end: end.toISOString().split('T')[0],
                    contact: eventData.contact,
                    ticket_price: eventData.ticket_price,
                    ticket_url: eventData.ticket_url,
                    location: eventData.location,
                    rendering: 'background',
                    extendedProps: {
                        bgImage: eventData.image_url,
                        bgColor: eventData.color,
                        description: eventData.comment
                    }
                });
                currentDate.setDate(currentDate.getDate() + 1);
            }
        });

        return {
            events,
            eventCountPerDay
        };
    }

    const {
        events,
        eventCountPerDay
    } = transformEvents(jsonData);
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'customDayGrid',
        showNonCurrentDates: false,
        fixedWeekCount: false,
        handleWindowResize: true,
        height: 1750,
        views: {
            customDayGrid: {
                type: 'dayGridMonth',
                dayCell: function (info) {
                    const date = info.date;
                    const lastDayOfMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                    const dateString = date.toISOString().split('T')[0];
                    if (date.getMonth() !== info.date.getMonth() && date.getMonth() === lastDayOfMonth.getMonth()) {
                        const cellElement = document.createElement('div');
                        cellElement.textContent = date.getDate();
                        cellElement.classList.add('next-month-last-week');
                        return {
                            domNodes: [cellElement]
                        };
                    }

                    const cellElement = document.createElement('div');
                    cellElement.textContent = date.getDate();
                    cellElement.classList.add('custom-cell');
                    if (eventCountPerDay[dateString] && eventCountPerDay[dateString] > 3) {
                        cellElement.classList.add('scrollable');
                    }
                    return {
                        domNodes: [cellElement]
                    };
                }
            }
        },
        events: events,

        eventContent: function (info) {
            const eventElement = document.createElement('div');
            const eventTime = info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const eventsOnDate = calendar.getEvents().filter(eventItem => {
                return eventItem.start.toISOString().split('T')[0] === info.event.start.toISOString().split('T')[0];
            });
            if (eventsOnDate.length === 1) {
                eventElement.classList.add('custom-events', 'fc-h-event', 'single-event');
                // Create a div for the background image
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('event-image');
                imageContainer.style.backgroundImage = `url(${info.event.extendedProps.bgImage})`;
                imageContainer.style.backgroundSize = 'cover';
                imageContainer.style.height = '100%'; // 80% height
            
                // Create an img element for the event image
                const imgElement = document.createElement('img');
                imgElement.src = info.event.extendedProps.bgImage;
                imgElement.style.width = '100%'; // Adjusted to fill the container width
                imgElement.style.height = '100%'; // Adjusted to fill the container height
                imgElement.style.objectFit = 'cover'; // Ensures the image covers the entire space
                imgElement.style.objectPosition = 'center'; // Centers the image
                
                imageContainer.appendChild(imgElement);
                eventElement.appendChild(imageContainer);
            
                // Create a container for the title and time
                const container = document.createElement('div');
                container.classList.add('flex', 'flex-col', 'items-center', 'justify-center', 'h-full');
            
                // Create a div for the event title
                const titleContainer = document.createElement('div');
                titleContainer.classList.add('event-title', 'mb-2'); // Add margin bottom using Tailwind class
                titleContainer.textContent = info.event.title;
                titleContainer.style.backgroundColor = info.event.extendedProps.bgColor; // Event color
                // titleContainer.style.height = '50%'; // 50% height
                container.appendChild(titleContainer);
                eventElement.appendChild(container);
                // Create a div for the event time
                const timeElement = document.createElement('div');
                timeElement.classList.add('text-white');
                timeElement.textContent = eventTime; // Set event time text
                container.appendChild(timeElement);
            
                eventElement.appendChild(container);
            }
            else if (eventsOnDate.length === 2) {
                eventElement.classList.add('h-1/2');
                // Create a div for the background image
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('event-image');
                imageContainer.style.backgroundImage = `url(${info.event.extendedProps.bgImage})`;
                imageContainer.style.backgroundSize = 'cover';
                imageContainer.style.height = '80%'; // 80% height

                // Create an img element for the event image
                const imgElement = document.createElement('img');
                imgElement.src = info.event.extendedProps.bgImage;
                imgElement.style.width = '100%';
                imgElement.style.height = '100%';
                imgElement.style.objectFit = 'cover';

                imageContainer.appendChild(imgElement);
                eventElement.appendChild(imageContainer);

                const container = document.createElement('div');
                container.classList.add('flex', 'items-center');
                const timeElement = document.createElement('div');
                timeElement.classList.add('mr-2', 'text-white'); // Add margin and color using Tailwind classes
                timeElement.textContent = eventTime; // Set event time text
                container.appendChild(timeElement);
                // Create a div for the event title
                const titleContainer = document.createElement('div');
                titleContainer.classList.add('event-title');
                titleContainer.textContent = info.event.title;
                titleContainer.style.backgroundColor = info.event.extendedProps.bgColor; // Event color
                titleContainer.style.height = '20%'; // 20% height

                container.appendChild(titleContainer);
                eventElement.appendChild(container);

                // Append the event wrapper to the calendar
            }
            else {
                eventElement.classList.add('custom-event', 'fc-daygrid-event', 'fc-h-event');
                eventElement.style.backgroundColor = info.event.extendedProps.bgColor;

                const container = document.createElement('div');
                container.classList.add('flex', 'items-center');
                const timeElement = document.createElement('div');
                timeElement.classList.add('mr-2', 'text-white'); // Add margin and color using Tailwind classes
                timeElement.textContent = eventTime; // Set event time text
                container.appendChild(timeElement);
                const textElement = document.createElement('div');
                textElement.classList.add('event-title');
                textElement.textContent = info.event.title;
                container.appendChild(textElement);
                eventElement.appendChild(container);
            }

            eventElement.addEventListener('click', function () {
                if (eventsOnDate.length > 1) {
                    // If there are multiple events on the clicked date, display the multi-event modal
                    const modalBody = document.getElementById('multiEventModalBody');
                    modalBody.innerHTML = '';

                    eventsOnDate.forEach(event => {
                        const eventElement = document.createElement('div');
                        console.log(event.extendedProps);
                        
                        eventElement.classList.add('custom-event', event.extendedProps.bgColor);

                        if (event.extendedProps.bgImage) {
                            const imageElement = document.createElement('img');
                            imageElement.src = event.extendedProps.bgImage;
                            imageElement.style.width = '100%';
                            imageElement.style.height = '50px';
                            eventElement.appendChild(imageElement);
                        }

                        const textElement = document.createElement('div');
                        textElement.classList.add('event-title');
                        textElement.textContent = event.title;
                        eventElement.appendChild(textElement);
                        // Add data-start attribute to event element
                        eventElement.dataset.start = event.start.toISOString().split('T')[0];

                        modalBody.appendChild(eventElement);
                    });

                    document.getElementById('multiEventModal').classList.remove('hidden');
                } else {
                    // If there's only one event on the clicked date, display the single event modal
                    const singleEvent = eventsOnDate[0];
                    const singleModalContent = document.getElementById('singleModalContent');
                    const singleModalImageContainer = document.getElementById('singleModalImageContainer');

                    if (singleEvent.extendedProps.bgImage) {
                        singleModalImageContainer.innerHTML = ''; // Clear previous images

                        const imgElement = document.createElement('img');
                        imgElement.src = singleEvent.extendedProps.bgImage;
                        imgElement.classList.add('w-full', 'h-64', 'object-cover');
                        singleModalImageContainer.appendChild(imgElement);
                    }

                    singleModalContent.innerHTML = `<p>${singleEvent.title}</p><p>Start: ${singleEvent.startStr}</p><p>End: ${singleEvent.endStr}</p><p>Description: ${singleEvent.extendedProps.description}</p>`;

                    document.getElementById('singleEventModal').classList.remove('hidden');
                }
            });


            return {
                domNodes: [eventElement]
            };
        },

        eventClick: function (info) {
            const eventsOnDate = calendar.getEvents().filter(event => {
                return event.start.toISOString().split('T')[0] === info.event.start.toISOString().split('T')[0];
            });

            if (eventsOnDate.length > 1) {
                const modalBody = document.getElementById('multiEventModalBody');
                modalBody.innerHTML = ''; // Clear previous events

                eventsOnDate.forEach(event => {
                    const eventElement = document.createElement('div');
                    eventElement.classList.add('custom-event', 'w-full');
                    eventElement.style.backgroundColor = event.extendedProps.bgColor;

                    if (event.extendedProps.bgImage) {
                        const imageElement = document.createElement('img');
                        imageElement.src = event.extendedProps.bgImage;
                        imageElement.style.width = '100%';
                        imageElement.style.height = '50px';
                        eventElement.appendChild(imageElement);
                    }

                    const textElement = document.createElement('div');
                    textElement.classList.add('event-title');
                    textElement.textContent = event.title;
                    eventElement.appendChild(textElement);

                    // Add data-start attribute to event element
                    eventElement.dataset.start = event.start.toISOString().split('T')[0];

                    modalBody.appendChild(eventElement);
                });

                document.getElementById('multiEventModal').classList.remove('hidden');
            } else if (eventsOnDate.length === 1) {
                const singleEvent = eventsOnDate[0];
                const singleModalContent = document.getElementById('singleModalContent');
                const singleModalImageContainer = document.getElementById('singleModalImageContainer');

                if (singleEvent.extendedProps.bgImage) {
                    singleModalImageContainer.innerHTML = ''; // Clear previous images

                    const imgElement = document.createElement('img');
                    imgElement.src = singleEvent.extendedProps.bgImage;
                    imgElement.classList.add('w-full', 'h-64', 'object-cover');
                    singleModalImageContainer.appendChild(imgElement);
                }


                singleModalContent.innerHTML = `<p>${singleEvent.title}</p><p>Start: ${singleEvent.startStr}</p><p>End: ${singleEvent.endStr}</p><p>Description: ${singleEvent.extendedProps.description}</p>`;

                document.getElementById('singleEventModal').classList.remove('hidden');
            }
        },
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        }
    });

    calendar.render();

    document.getElementById('closeMultiEventModal').addEventListener('click', function () {
        document.getElementById('multiEventModal').classList.add('hidden');
    });

    function displayEventInfoInModal(event) {
        const singleModalContent = document.getElementById('singleModalContent');
        const singleModalImageContainer = document.getElementById('singleModalImageContainer');

        if (event.extendedProps.bgImage) {
            singleModalImageContainer.innerHTML = ''; // Clear previous images

            const imgElement = document.createElement('img');
            imgElement.src = event.extendedProps.bgImage;
            imgElement.classList.add('w-full', 'h-64', 'object-cover');
            singleModalImageContainer.appendChild(imgElement);
        }

        singleModalContent.innerHTML = `<p>${event.title}</p><p>Start: ${event.startStr}</p><p>End: ${event.endStr}</p><p>Description: ${event.extendedProps.description}</p>`;

        document.getElementById('singleEventModal').classList.remove('hidden');
    }

    document.getElementById('multiEventModalBody').addEventListener('click', function (event) {

        // Traverse up the DOM tree until we find an element with the 'custom-event' class
        let clickedElement = event.target;
        while (clickedElement) {
            if (clickedElement.classList.contains('custom-event')) {
                break;
            }
            clickedElement = clickedElement.parentElement;
        }

        // If we found an element with the 'custom-event' class, proceed to handle the click
        if (clickedElement && clickedElement.classList.contains('custom-event')) {
            const clickedDate = clickedElement.dataset.start;

            const eventsOnDate = calendar.getEvents().filter(eventItem => {
                return eventItem.start.toISOString().split('T')[0] === clickedDate;
            });

            // Find the clicked event within the eventsOnDate array
            const eventTitleElement = clickedElement.querySelector('.event-title');
            if (eventTitleElement) {
                const clickedEvent = eventsOnDate.find(eventItem => {
                    return eventItem.title === eventTitleElement.textContent;
                });

                if (clickedEvent) {
                    displayEventInfoInModal(clickedEvent);
                }
            }
        }
    });


    // Function to show multi-event modal and overlay


    document.getElementById('closeSingleModal').addEventListener('click', function () {
        document.getElementById('singleEventModal').classList.add('hidden');
    });

    document.getElementById('closeMultiEventModal').addEventListener('click', function () {
        document.getElementById('multiEventModal').classList.add('hidden');
    });

});