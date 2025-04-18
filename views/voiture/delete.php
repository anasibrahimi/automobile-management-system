
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Are you sure you want to delete <?php echo htmlspecialchars($voiture->getModele()); ?></h1>
        <form method="post" action="/automobile/voitures/remove" class="space-y-4">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($voiture->getId()); ?>">
            <input type="hidden" name="action" value="remove">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($voiture->getId()); ?>">
            <button type="submit" name="confirm" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Confirm
            </button>
            <a href="?action=list" class="inline-block">
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Cancel
                </button>
            </a>
        </form>
    </div>
</body>
</html>
