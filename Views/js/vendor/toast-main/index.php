<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="toast-main-right.css?v=<?php echo (rand()); ?>">
    <style>
        body {
            background-color: darkslategray;
        }
    </style>
</head>

<body>
    <div class="notifications">

    </div>
    <div class="buttons">
        <button class="btn" id="success" onclick="createSuccessToast('hola','hola que ase',true,2,'30px',false)">Success</button>
        <button class="btn" id="error" onclick="createErrorToast('hola','hola que ase',true,2,'30px',false)">Error</button>
        <button class="btn" id="warning" onclick="createWarningToast('hola','hola que ase',true,2,'30px',false)">Warning</button>
        <button class="btn" id="info" onclick="createInfoToast('hola','hola que ase',true,2,'30px',false)">Info</button>
    </div>

    <script src="toast-main.js?v=<?php echo (rand()); ?>"></script>
</body>

</html>