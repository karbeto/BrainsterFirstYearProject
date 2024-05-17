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
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
