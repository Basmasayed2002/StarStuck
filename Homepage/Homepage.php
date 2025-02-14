<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Starstruck</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welkom bij Hotel Starstruck</h1>
        <nav>
            <ul>
                <li><a href="#over">Over Ons</a></li>
                <li><a href="#kamers">Kamers</a></li>
                <li><a href="#artiesten">Artiesten</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    <section id="over">
        <h2>Over Ons</h2>
        <p>Hotel Starstruck is een luxueus hotel waar beroemdheden vaak verblijven en optreden.</p>
    </section>
    <section id="artiesten">
        <h2>Optredende Artiesten</h2>
        <div class="slideshow-container">
            <?php foreach ($artiesten as $index => $artiest): ?>
                <div class="slide" id="slide<?php echo $index; ?>">
                    <img src="<?php echo $artiest['afbeelding']; ?>" alt="<?php echo $artiest['naam']; ?>">
                    <p><?php echo $artiest['naam']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <footer>
        <p>&copy; 2025 Hotel Starstruck</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>