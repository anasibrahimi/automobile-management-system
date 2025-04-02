<?php include $_SERVER['DOCUMENT_ROOT'] . '/automobile/views/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Voiture</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-5">Add Voiture</h1>
        <form method="POST" class="bg-white p-6 rounded shadow-md" action="../public/index.php">
            <input type="hidden" name="action" value="create"> <!-- Ensure action is set -->
            <div class="mb-4">
                <label for="modele" class="block text-gray-700">Model</label>
                <input type="text" id="modele" name="modele" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="prix" class="block text-gray-700">Price</label>
                <input type="number" id="prix" name="prix" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="client" class="block text-gray-700">Client</label>
                <select id="client" name="client_id" class="w-full px-4 py-2 border rounded" required>
                <?php foreach ($clients as $client): ?>
                        <option value="<?php echo $client->getId(); ?>" >
                            <?php echo htmlspecialchars($client->getName()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add</button>
        </form>
    </div>
</body>
</html>
