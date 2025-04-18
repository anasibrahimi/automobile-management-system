<?php
include $_SERVER['DOCUMENT_ROOT'] . '/automobile/views/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-5">List of Voitures</h1>
        <div class="flex justify-end mb-5">
            <a href="/automobile/voitures/add" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Voiture</a>
             </div>
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Model</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Client Name</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead> 
            <tbody>
                <?php foreach ($voitures as $voitureData): ?>
                    <?php 
                        $voiture = $voitureData['voiture'];
                        $clientName = $voitureData['client_name'];
                    ?>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center"><?php echo htmlspecialchars($voiture->getId()); ?></td>
                        <td class="px-4 py-2 text-center"><?php echo htmlspecialchars($voiture->getModele()); ?></td>
                        <td class="px-4 py-2 text-center"><?php echo htmlspecialchars($voiture->getPrix()); ?> $</td>
                        <td class="px-4 py-2 text-center"><?php echo htmlspecialchars($clientName ?? 'N/A'); ?></td>
                        <td class="px-4 py-2 text-center">
                            <a href="/automobile/voitures/edit/<?php echo $voiture->getId(); ?>" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Modify</a>
                            <a href="/automobile/voitures/delete/<?php echo $voiture->getId(); ?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
