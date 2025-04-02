<?php include $_SERVER['DOCUMENT_ROOT'] . '/automobile/views/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-5">Add Client</h1>
        <form method="POST" class="bg-white p-6 rounded shadow-md" action="../public/client.php">
            <input type="hidden" name="action" value="createClient">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add</button>
        </form>
    </div>
</body>
</html>
