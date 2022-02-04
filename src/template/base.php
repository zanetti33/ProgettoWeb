<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
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
		<ul>
			<?php require("menu.php") ?>
        </ul>
    </header>
    <main>
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
	if(isset($templateParams["consigliati"])): ?>
		<section>
                <h2>Prodotti Popolari</h2>
                <div>
                    <a href="#">prev</a>
                    <img src="./img/Maglia-Azzurro-01-D-B-Fronte.jpeg" alt="maglia azzurra"/>
                    <a href="#">next</a>
                </div>
        </section>
    <?php endif ?>
    </main>
	<footer>
		<?php require("contatti.php") ?>
        <section>
            <h2>Info</h2>
            <p>Sede: Via Pinco Pallino 1</p>
        </section>
        <p>Progetto Tecnologie Web - A.A. 2021/2022, Pedrini Fabio, Zanetti Lorenzo, Zanzi Alessandro</p>
    </footer>
</body>
</html>