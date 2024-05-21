<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/css/index.css')
    @vite('resources/css/calendar.css')
    <link href='https://unpkg.com/fullcalendar@5.11.0/main.css' rel='stylesheet' />
    <script src='https://unpkg.com/fullcalendar@5.11.0/main.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        body {
            background-color: #101010;
        }
        .label-color {
            color: #8448e5; /* Violetova */
        }
        .field-color {
            color: #a0aec0; /* Siva */
        }
        ::placeholder {
            color: #000000 !important; /* Placeholder color */
        }
        .hamburger {
            cursor: pointer;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 4px;
            transition: 0.4s;
        }

        .hidden {
    display: none;
}

#passwordRequirements {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: 10px;
    margin-top: 10px;
    border-radius: 0.375rem;
}

#passwordRequirements p {
    margin: 5px 0;
}

.valid {
    color: green;
}

.invalid {
    color: red;
}

        @keyframes slideIn {
            0% {opacity: 0;}
            20% {opacity: 1;}
            80% {opacity: 1;}
            100% {opacity: 0;}
        }

        .slide-in {
            animation: slideIn 10s infinite;
        }
    </style>

</head>
<body>
    @yield('content')
</body>
</html>
