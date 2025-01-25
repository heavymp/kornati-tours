<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Kornati Tours') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            Welcome to Kornati Tours
        </h1>
        <p class="text-center text-gray-600">
            Your gateway to exploring the beautiful Kornati Islands
        </p>
    </div>
</body>
</html> 