<?php include $_SERVER['DOCUMENT_ROOT'] . '/automobile/views/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Clients</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-5">List of Clients</h1>
        <div class="flex justify-end mb-5">
            <a href="../public/client.php?action=addClient" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Client</a>
        </div>
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Phone</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center"><?php echo htmlspecialchars($client->getId()); ?></td>
                        <td class="px-4 py-2 text-center"><?php echo htmlspecialchars($client->getName()); ?></td>
                        <td class="px-4 py-2 text-center"><?php echo htmlspecialchars($client->getPhone()); ?></td>
                        <td class="px-4 py-2 text-center">
                            <a href="../public/client.php?action=editClient&id=<?php echo $client->getId(); ?>" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Modify</a>
                            <a href="../public/client.php?action=deleteClient&id=<?php echo $client->getId(); ?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
