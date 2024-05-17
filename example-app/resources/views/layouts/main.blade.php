<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/css/index.css')
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
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
