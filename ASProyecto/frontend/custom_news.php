<?php
    session_start(); 
    require 'dbkon.php'; //DBarekin konexioa egitea beharrezkoa baita

    // Session global variable erabili ahal izateko

    // Your Python API endpoint
    $pythonApiEndpoint = "http://python-api:5000/get_news"; // Replace with the actual hostname or IP addr>

    // Fetch JSON data from the Python API
    $jsonData = file_get_contents($pythonApiEndpoint);

    // Check if the request was successful
    if ($jsonData !== false) {
        // Decode JSON data
        $data = json_decode($jsonData, true);

        // Check if decoding was successful and there are articles
        if ($data !== null && isset($data[0])) {
		$firstTenArticles = array_slice($data, 0, 10);
        }
            foreach ($firstTenArticles as $article) {
                $author = 'NewsAPI'; 
                $title = mysqli_real_escape_string($con, $article['title']);
                $description = mysqli_real_escape_string($con, $article['description']);
            
                $sql = "INSERT INTO posts (nombre, titulo, texto) VALUES (?, ?, ?)";
                
                $stmt = mysqli_prepare($con, $sql);
            
                // Check if the statement was prepared successfully
                if ($stmt) {
                    // Bind parameters
                    mysqli_stmt_bind_param($stmt, "sss", $author, $title, $description);
            
                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Record inserted successfully
                    }
            
                    // Close the statement
                    mysqli_stmt_close($stmt);
                } else {
                    echo '<div class="error-message">Ha habido un error al preparar la declaración: ' . mysqli_error($con) . '</div>';
                }
        }

        $sql = "SELECT nombre, titulo, texto FROM posts WHERE nombre = 'NewsAPI' ORDER BY id DESC";    
        $resultado = $con->query($sql);
        
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xtra Blog</title>
	<link rel="stylesheet" href="fontawesome/css/all.min.css"> <!-- https://fontawesome.com/ -->
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet"> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-xtra-blog.css" rel="stylesheet">
<!--
    
TemplateMo 553 Xtra Blog

https://templatemo.com/tm-553-xtra-blog

-->
</head>
<body>
	<header class="tm-header" id="tm-header">
        <div class="tm-header-wrapper">
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="tm-site-header">
                <div class="mb-3 mx-auto tm-site-logo"><i class="fas fa-times fa-2x"></i></div>            
                <h1 class="text-center">Xtra Blog</h1>
            </div>
            <nav class="tm-nav" id="tm-nav">            
                <ul>
                    <li class="tm-nav-item"><a href="home.php" class="tm-nav-link">
                        <i class="fas fa-home"></i>
                        Inicio
                    </a></li>
                    <li class="tm-nav-item active"><a href="makepost.php" class="tm-nav-link">
                        <i class="far fa-comments"></i>
                        Postear
                    </a></li>
                    <li class="tm-nav-item active"><a href="custom_news.php" class="tm-nav-link">
                        <i class="far fa-comments"></i>
                        Global
                    </a></li>
                </ul>
            </nav>
            <div class="tm-mb-65">
                <a rel="nofollow" href="https://fb.com/templatemo" class="tm-social-link">
                    <i class="fab fa-facebook tm-social-icon"></i>
                </a>
                <a href="https://twitter.com" class="tm-social-link">
                    <i class="fab fa-twitter tm-social-icon"></i>
                </a>
                <a href="https://instagram.com" class="tm-social-link">
                    <i class="fab fa-instagram tm-social-icon"></i>
                </a>
                <a href="https://linkedin.com" class="tm-social-link">
                    <i class="fab fa-linkedin tm-social-icon"></i>
                </a>
            </div>
            <p class="tm-mb-80 pr-5 text-white">
                Este blog es un blog de diversos temas donde cualquier usuario puede hablar de los temas que desee.
            </p>
        </div>
    </header>
    <div class="container-fluid">
        <main class="tm-main">
            <div class="row tm-row">
                <article class="col-12 col-md-6 tm-post">
                    <hr class="tm-hr-primary">
                    <a class="effect-lily tm-post-link tm-pt-60">
                        <?php
                        if ($resultado->num_rows > 0) {
                            // Iterar sobre los resultados y generar HTML dinámicamente
                            while ($fila = $resultado->fetch_assoc()) {
                            echo '<h2 class="pt-30 tm-color-primary tm-post-title">' . $fila["titulo"] . '</h2>';
                            echo '</a>';  
                            echo '<p class="tm-mb-40"> posted by ' . $fila["nombre"] . '</p>';
                            echo '<p class="tm-pt-30">' . $fila["texto"] . '</p>'; 
                            }
                        } else {
                            echo "No se encontraron posts.";
                        }
                        ?>
                    <hr>
                </article>
            </div>          
            <footer class="row tm-row">
                <hr class="col-12">
                <div class="col-md-6 col-12 tm-color-gray">
                    Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-external-link">TemplateMo</a>
                </div>
                <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                    Copyright 2020 Xtra Blog Company Co. Ltd.
                </div>
            </footer>
        </main>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/templatemo-script.js"></script>
</body>
</html>
