<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>Keep Notes</title>
</head>

<body class="bg-primary font-body text-white">
    <header class="border-b border-gray mb-20">
        <h1 class="text-4xl mblr-4">Keep Notes</h1>
    </header>
    <main>
        <div class="container md:w-1/2 w-auto mx-auto border border-gray overflow-auto rounded-lg">
            <?= $content ?>
        </div>
    </main>
    <footer>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script src="../public/js/script.js"></script>
    </footer>

</body>

</html>