document.addEventListener('DOMContentLoaded', function () {
    var eventsData = null;//document.getElementById('eventsData').textContent;
    var jsonData = null;//JSON.parse(eventsData);
    var allEvents = null; // Store all events to reset the filter later
    fetch("/events")
        .then(res => res.json())
        .then(res => {
            jsonData = res;
            allEvents = transformEvents(jsonData).events; // Store all events
            initializeCalendar(allEvents);
        });


    document.getElementById('brainsterFilter').addEventListener('change', function () {
        const calendar = document.getElementById('calendar').calendar;
        calendar.refetchEvents();
    });

    document.getElementById('mobFilter').addEventListener('change', function () {
        const calendar = document.getElementById('calendar').calendar;
        calendar.refetchEvents();
    });

    document.getElementById('laboratoriumFilter').addEventListener('change', function () {
        const calendar = document.getElementById('calendar').calendar;
        calendar.refetchEvents();
    });

    // Function to get checked filters
    function getCheckedFilters() {
        const checkedFilters = [];
        if (document.getElementById('brainsterFilter').checked) {
            checkedFilters.push('Brainster');
        }
        if (document.getElementById('mobFilter').checked) {
            checkedFilters.push('Mobs');
        }
        if (document.getElementById('laboratoriumFilter').checked) {
            checkedFilters.push('Laboratorium');
        }
        return checkedFilters;
    }

    // Function to filter events based on checked filters
    function filterEventsByCheckedFilters(events) {
        const checkedFilters = getCheckedFilters();
        console.log(checkedFilters);
        if (checkedFilters.length === 0) {
            return events; // Return all events if no filter is checked
        }

        const filteredEvents = [];
        for (const event of events) {
            console.log(event)
            const eventTitleLower = event.extendedProps.users.company.toLowerCase();
            for (const filter of checkedFilters) {
                if (eventTitleLower.includes(filter.toLowerCase())) {
                    filteredEvents.push(event);
                    break; // Once a match is found, no need to check further filters
                }
            }
        }

        return filteredEvents;
    }



    function transformEvents(jsonData) {
        const events = [];
        const eventCountPerDay = {};

        jsonData.forEach(eventData => {
            const start = new Date(eventData.from);
            const end = new Date(eventData.to);

            // Iterate through each day between start and end date
            for (let d = new Date(start); d <= end; d.setDate(d.getDate() + 1)) {
                const dateString = d.toISOString().split('T')[0];

                if (!eventCountPerDay[dateString]) {
                    eventCountPerDay[dateString] = 0;
                }
                eventCountPerDay[dateString]++;
                events.push({
                    title: eventData.title,
                    start: dateString,
                    start_date: start.toISOString().split('T')[1].split('.')[0].slice(0, 5),
                    end_date: end.toISOString().split('T')[1].split('.')[0].slice(0, 5),
                    contact: eventData.contact,
                    ticket_price: eventData.ticket_price,
                    ticket_url: eventData.ticket_url,
                    location: eventData.location,
                    rendering: 'background',
                    extendedProps: {
                        bgImage: eventData.image_url,
                        bgColor: eventData.users.color,
                        description: eventData.comment,
                        type: eventData.type,
                        city: eventData.city,
                        city_name: eventData.city.name,
                        users: eventData.users
                    }
                });
            }
        });
        console.log('Transformed events:', events); // Add this line to log transformed events
        return {
            events,
            eventCountPerDay
        };
    }

    function initializeCalendar(events) {
        // const {
        //     events,
        //     eventCountPerDay
        // } = transformEvents(jsonData);
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

            events: function (fetchInfo, successCallback, failureCallback) {
                const eventTypeFilter = parseInt(document.getElementById('eventTypeFilter').value);
                const cityFilter = parseInt(document.getElementById('cityFilter').value);
                const filteredEvents = filterEventsByCheckedFilters(allEvents).filter(event => filterEvents(allEvents, eventTypeFilter, cityFilter).includes(event));
                console.log("filtered Events after click");
                console.log(filteredEvents);
                successCallback(filteredEvents);
            },

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
                    container.style.backgroundColor = info.event.extendedProps.bgColor; // Event color
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
                    container.style.backgroundColor = info.event.extendedProps.bgColor; // Event color
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

                eventElement.addEventListener('click', function (t) {
                    if (eventsOnDate.length > 1) {
                        // If there are multiple events on the clicked date, display the multi-event modal
                        const modalBody = document.getElementById('multiEventModalBody');
                        modalBody.innerHTML = '';

                        eventsOnDate.forEach(event => {
                            const eventElement = document.createElement('div');

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

                        singleModalContent.innerHTML = `<p>${singleEvent.title}</p><p>Start: ${singleEvent.startStr}</p><p>Description: ${singleEvent.extendedProps.description}</p>`;

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
                        eventElement.classList.add('custom-event', 'w-full', '!h-48');
                        eventElement.style.backgroundColor = event.extendedProps.bgColor;

                        if (event.extendedProps.bgImage) {
                            const imageElement = document.createElement('img');
                            imageElement.src = event.extendedProps.bgImage;
                            imageElement.style.width = '100%';
                            imageElement.style.height = '50%';
                            eventElement.appendChild(imageElement);
                        }

                        const infoContainer = document.createElement('div');
                        infoContainer.classList.add('event-info');

                        // First row: Time and Title
                        const timeTitleRow = document.createElement('div');
                        timeTitleRow.classList.add('info-row');

                        // Time
                        const timeLabel = document.createElement('div');
                        timeLabel.classList.add('event-label');
                        timeLabel.textContent = 'Time:';
                        const timeValue = document.createElement('div');
                        timeValue.classList.add('event-value');
                        timeValue.textContent = event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        timeTitleRow.appendChild(timeLabel);
                        timeTitleRow.appendChild(timeValue);

                        // Title
                        const titleLabel = document.createElement('div');
                        titleLabel.classList.add('event-label');
                        titleLabel.textContent = 'Title:';
                        const titleValue = document.createElement('div');
                        titleValue.classList.add('event-value');
                        titleValue.textContent = event.title;
                        timeTitleRow.appendChild(titleLabel);
                        timeTitleRow.appendChild(titleValue);

                        infoContainer.appendChild(timeTitleRow);

                        // Second row: Ticket Price and City
                        const ticketCityRow = document.createElement('div');
                        ticketCityRow.classList.add('info-row');

                        // Ticket Price
                        const ticketLabel = document.createElement('div');
                        ticketLabel.classList.add('event-label');
                        ticketLabel.textContent = 'Ticket Price:';
                        const ticketValue = document.createElement('div');
                        ticketValue.classList.add('event-value');
                        ticketValue.textContent = event.extendedProps.ticket_price;
                        ticketCityRow.appendChild(ticketLabel);
                        ticketCityRow.appendChild(ticketValue);

                        // City
                        const cityLabel = document.createElement('div');
                        cityLabel.classList.add('event-label');
                        cityLabel.textContent = 'City:';
                        const cityValue = document.createElement('div');
                        cityValue.classList.add('event-value');
                        cityValue.textContent = event.extendedProps.city_name;
                        ticketCityRow.appendChild(cityLabel);
                        ticketCityRow.appendChild(cityValue);

                        infoContainer.appendChild(ticketCityRow);

                        // Third row: Contact and Drinks
                        const contactDrinksRow = document.createElement('div');
                        contactDrinksRow.classList.add('info-row');

                        // Contact
                        const contactLabel = document.createElement('div');
                        contactLabel.classList.add('event-label');
                        contactLabel.textContent = 'Contact:';
                        const contactValue = document.createElement('div');
                        contactValue.classList.add('event-value');
                        contactValue.textContent = event.extendedProps.contact;
                        contactDrinksRow.appendChild(contactLabel);
                        contactDrinksRow.appendChild(contactValue);

                        // Drinks
                        const drinksLabel = document.createElement('div');
                        drinksLabel.classList.add('event-label');
                        drinksLabel.textContent = '-20% Drinks:';
                        const drinksValue = document.createElement('div');
                        contactDrinksRow.appendChild(drinksLabel);

                        infoContainer.appendChild(contactDrinksRow);

                        // Append info container to the event element
                        eventElement.appendChild(infoContainer);

                        // Add data-start attribute to event element
                        eventElement.dataset.start = event.start.toISOString().split('T')[0];
                        eventElement.addEventListener('click', function () { });
                        modalBody.appendChild(eventElement);
                    });

                    document.getElementById('multiEventModal').classList.remove('hidden');
                } else if (eventsOnDate.length === 1) {
                    const singleEvent = eventsOnDate[0];
                    console.log(singleEvent);
                    const singleModalContent = document.getElementById('singleModalContent');
                    const singleModalImageContainer = document.getElementById('singleModalImageContainer');

                    if (singleEvent.extendedProps.bgImage) {
                        singleModalImageContainer.innerHTML = ''; // Clear previous images

                        const imgElement = document.createElement('img');
                        imgElement.src = singleEvent.extendedProps.bgImage;
                        imgElement.classList.add('w-full', 'h-64', 'object-cover', 'relative'); // Adding relative positioning
                        singleModalImageContainer.appendChild(imgElement);

                        // Create close button
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = 'x'; // Close button as 'x'
                        closeButton.classList.add('absolute', 'top-0', 'right-0', 'm-2', 'text-white', '!bg-transparent', 'p-2', 'rounded-full'); // Positioning and styling
                        closeButton.onclick = function () {
                            document.getElementById('singleEventModal').classList.add('hidden'); // Hide modal on click
                        };
                        imgElement.appendChild(closeButton); // Append close button to image container
                    }

                    singleModalContent.innerHTML = `<div class="flex flex-col items-center justify-center text-center">
                                                        <h1 class="mb-4 text-2xl font-semibold">${singleEvent.title}</h1>
                                                        <p>Start: ${singleEvent.extendedProps.start_date}</p>
                                                        <p>End: ${singleEvent.extendedProps.end_date}</p>
                                                        <p>Lokacija: ${singleEvent.extendedProps.location}</p>
                                                        <p>Cena: ${singleEvent.extendedProps.ticket_price}</p>
                                                        <p>Kontakt: ${singleEvent.extendedProps.contact}</p>
                                                        <p>Promocija: -50% pijaloci</p>
                                                        <p>link do karti: ${singleEvent.extendedProps.ticket_price}</p>
                                                    </div>`;

                    document.getElementById('singleEventModal').classList.remove('hidden');
                }

            },
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            }

        }

        );
        document.getElementById('calendar').calendar = calendar;

        document.getElementById('eventTypeFilter').addEventListener('change', function () {
            calendar.refetchEvents();
        });


        calendar.render();
        function filterEvents(events, eventTypeFilter, cityFilter) {
            if (!eventTypeFilter && !cityFilter) {
                return events; // Return all events if no filter is applied
            }

            return events.filter(event => {
                const typeMatch = eventTypeFilter ? event.extendedProps.type.id === parseInt(eventTypeFilter) : true;
                const cityMatch = cityFilter ? event.extendedProps.city.id === parseInt(cityFilter) : true;
                return typeMatch && cityMatch;
            });
        }

        document.getElementById('eventTypeFilter').addEventListener('change', function () {
            const calendar = document.getElementById('calendar').calendar;
            calendar.refetchEvents();
        });
        document.getElementById('cityFilter').addEventListener('change', function () {
            console.log("here")
            const eventTypeFilter = parseInt(document.getElementById('eventTypeFilter').value);
            const cityFilter = parseInt(this.value);
            const calendar = document.getElementById('calendar').calendar;
            calendar.refetchEvents();
        });
        document.getElementById('closeMultiEventModal').addEventListener('click', function () {
            document.getElementById('multiEventModal').classList.add('hidden');
        });




        function displayEventInfoInModal(event) {
            const singleModalContent = document.getElementById('singleModalContent');
            const singleEvent = event;
            const singleModalImageContainer = document.getElementById('singleModalImageContainer');

            if (singleEvent.extendedProps.bgImage) {
                singleModalImageContainer.innerHTML = ''; // Clear previous images

                const imgElement = document.createElement('img');
                imgElement.src = singleEvent.extendedProps.bgImage;
                imgElement.classList.add('w-full', 'h-64', 'object-cover', 'relative'); // Adding relative positioning
                singleModalImageContainer.appendChild(imgElement);

                // Create close button
                const closeButton = document.createElement('button');
                closeButton.innerHTML = 'x'; // Close button as 'x'
                closeButton.classList.add('absolute', 'top-0', 'right-0', 'm-2', 'text-white', 'bg-black', 'p-2', 'rounded-full'); // Positioning and styling
                closeButton.onclick = function () {
                    document.getElementById('singleEventModal').classList.add('hidden'); // Hide modal on click
                };
                imgElement.appendChild(closeButton); // Append close button to image container
            }

            singleModalContent.innerHTML = `<div class="flex flex-col items-center justify-center text-center">
            <h1 class="mb-4 text-2xl font-semibold">${singleEvent.title}</h1>
            <p>Start: ${singleEvent.extendedProps.start_date}</p>
            <p>End: ${singleEvent.extendedProps.end_date}</p>
            <p>Lokacija: ${singleEvent.extendedProps.location}</p>
            <p>Cena: ${singleEvent.extendedProps.ticket_price}</p>
            <p>Kontakt: ${singleEvent.extendedProps.contact}</p>
            <p>Promocija: -50% pijaloci</p>
            <p>link do karti: ${singleEvent.extendedProps.ticket_price}</p>
                                                    </div>`;

            document.getElementById('singleEventModal').classList.remove('hidden');
        }

        document.getElementById('multiEventModalBody').addEventListener('click', function (event) {
            const clickedElement = event.target.closest('.custom-event');
            if (clickedElement) {
                const clickedDate = clickedElement.dataset.start;
                const eventsOnDate = calendar.getEvents().filter(eventItem => {
                    return eventItem.start.toISOString().split('T')[0] === clickedDate;
                });

                const eventTitleElement = clickedElement.querySelector('.event-value:nth-child(4)');
                if (eventTitleElement) {
                    const clickedEvent = eventsOnDate.find(eventItem => {
                        return eventItem.title === eventTitleElement.textContent;
                    });

                    if (clickedEvent) {
                        displayEventInfoInModal(clickedEvent);
                        document.getElementById('multiEventModal').classList.add('hidden');
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
    }
});
