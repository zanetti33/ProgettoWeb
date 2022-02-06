<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <?php
    if(isset($templateParams["nome"]) && $templateParams["nome"] == "lista-prodotti.php"): ?>
		<link rel="stylesheet" type="text/css" href="./css/list-style.css" />
    <?php endif; ?>
    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</head>
<body>
    <header>
        <h1><a <?php isActive("index.php");?> href="index.php">Kits</a></h1>
		<nav>
            <ul>
                <?php require("menu.php") ?>
            </ul>
        </nav>
    </header>
    <?php
    if(isset($templateParams["nome"]) && $templateParams["nome"] == "lista-prodotti.php"){
        require("filtro.php");
    }
    ?>
    <main>
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
	if(isset($templateParams["nome"]) && $templateParams["nome"] == "home.php"): ?>
		<section>
                <h2>Prodotti Popolari</h2>
                <img src="./img/back.png" alt="precedente"/>
                <div>
                    <img src="./img/Maglia-Azzurro-01-D-B-Fronte.jpeg" alt="maglia azzurra"/>
                    <img src="./img/Maglia-Azzurro-01-D-B-Retro.jpeg" alt="maglia azzurra retro"/>
                    <img src="./img/Maglia-Bianco-01-U-D-B-Fronte.jpeg" alt="maglia bianca"/>
                </div>
                <img src="./img/next.png" alt="prossima"/>
        </section>
    <?php endif ?>
    </main>
	<footer>
		<?php require("contatti.php") ?>
        <section>
            <h2>Info</h2>
            <p>Telefono: 3773893029</p>
            <p>Sede: Via Pinco Pallino 1</p>
        </section>
        <p>Progetto Tecnologie Web - A.A. 2021/2022, Pedrini Fabio, Zanetti Lorenzo, Zanzi Alessandro</p>
    </footer>
</body>
</html>