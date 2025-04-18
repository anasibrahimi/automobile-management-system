
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Voiture</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-5">Update Voiture</h1>
        <form method="POST" class="bg-white p-6 rounded shadow-md" action="/automobile/voitures/update">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($voiture->getId()); ?>">
            <div class="mb-4">
                <label for="modele" class="block text-gray-700">Model</label>
                <input type="text" id="modele" name="modele" value="<?php echo htmlspecialchars($voiture->getModele()); ?>" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="prix" class="block text-gray-700">Price</label>
                <input type="number" id="prix" name="prix" value="<?php echo htmlspecialchars($voiture->getPrix()); ?>" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="client_id" class="block text-gray-700">Client</label>
                <select id="client_id" name="client_id" class="w-full px-4 py-2 border rounded" required>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo htmlspecialchars($client->getId()); ?>" 
                            <?php echo $client->getId() == $voiture->getClientId() ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($client->getName()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
        </form>
    </div>
</body>
</html>
