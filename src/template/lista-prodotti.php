<?php foreach($templateParams["maglieFiltrate"] as $maglia): ?>
    <div>
        <a href="singolo-prodotto.php?idMaglia=<?php echo $maglia["idMaglia"]; ?>">
        <figure>
            <img src="<?php echo $IMG_DIR.$maglia["immagineFronte"]; ?>" alt="<?php echo $maglia["immagineFronte"]; ?>">
            <figcaption>
                <?php echo $maglia["modello"]?> - <?php echo $maglia["genere"]?> <br> <?php echo $maglia["prezzo"]?>€</figcaption>
        </figure>
        </a>
    </div>
<?php endforeach; ?>
    




