

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <title>Other Page</title>
    <style>
        .message-container {
            display: none; /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border: 2px solid #0083fa;
            border-radius: 8px;
            text-align: center;
            z-index: 1000;
        }
    </style>
</head>
<body>
    nothing to see here yet
    <!-- Message container -->
    <div class="message-container" id="messageContainer">
        <p>You have already submitted the exam, you cannot go back to the previous page.</p>
        <button id="okButton">OK</button>
    </div>

    <!-- script -->
    <script src="../../javaScripts/notGoback.js"></script>
</body>
</html>

