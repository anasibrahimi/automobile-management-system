<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-gray-100 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="../public/index.php?action=list" class="text-gray-800 text-lg font-bold">Logo</a>
            <div class="flex space-x-4">
                <a href="/automobile/voitures/list" class="text-gray-800 text-lg font-semibold hover:text-blue-500">Afficher Voiture</a>
                <a href="/automobile/clients/" class="text-gray-800 text-lg font-semibold hover:text-blue-500">Afficher Client</a>
                <a href="/automobile/users/add" class="text-gray-800 text-lg font-semibold hover:text-blue-500">Add User</a>
                <a href="/automobile/logout" class="text-gray-800 text-lg font-semibold hover:text-blue-500">Logout</a>
            </div>
        </div>
    </nav>
</body>
</html>
