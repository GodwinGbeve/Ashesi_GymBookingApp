<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            color: #4e73df;
            text-align: center;
            padding: 50px;
        }

        .error {
            font-size: 100px;
            margin-bottom: 20px;
            color: #4e73df;
            position: relative;
            animation: glitch-animation 2s infinite;
        }

        .lead {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .text-gray-800 {
            color: #858796;
        }

        .text-gray-500 {
            color: #aab2bd;
        }

        a {
            color: #4e73df;
            text-decoration: none;
        }

        a:hover {
            color: #2e59d9;
            text-decoration: underline;
        }

        @keyframes glitch-animation {
            0% {
                opacity: 1;
            }

            20% {
                opacity: 0.8;
            }

            40% {
                opacity: 0.6;
            }

            60% {
                opacity: 0.4;
            }

            80% {
                opacity: 0.2;
            }

            100% {
                opacity: 0;
            }
        }
        
        /* Beautified text styles */
        .beautify-text {
            font-weight: bold;
            font-size: 32px;
       
            margin-bottom: 10px;
        }

        .glitch-text {
            font-size: 18px;
            color: #858796;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center">
            <!-- Glitch effect inspired error -->
            <div class="error" data-text="404">404</div>
            <!-- Beautified text -->
            <p class="beautify-text">Page Not Found</p>
            <!-- Glitch-inspired text -->
            <p class="glitch-text">It looks like you found a glitch in the matrix...</p>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
 
</body>

</html>
