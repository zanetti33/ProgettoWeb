			<?php require("credenziali.php") ?>
            <section>
                <h2>Aggiunta scorte</h2>
                <div>
                    <?php if(isset($templateParams["messaggio2"])):?>
                    <p><?php echo $templateParams["messaggio2"]; ?></p>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <ul>
                            <li>
                                <label for="idMaglia">Id Maglia:</label>
                                <input required type="number" id="idMaglia" name="idMaglia" />
                            </li>
                            <li>
                                <label for="quantità">Quantità da aggiungere:</label>
                                <input required type="number" id="quantità" name="quantità" />
                            </li>
                            <li>
                                <input type="submit" name="aggiungi" value="aggiungi" />
                            </li>
                        </ul>
                    </form>
                </div>
            </section>
            <section>
                <h2>Ultimi ordini</h2>
                <?php foreach($templateParams["ordini"] as $ordine): ?>
                <div>
                    <ul>
                        <li>
                            Id Ordine: <?php echo $ordine["idOrdine"] ?>
                        </li>
                        <li>
                            Email cliente: <?php echo $ordine["email"] ?>
                        </li>
                        <li>
                            Data pagamento: <?php echo $ordine["dataPagamento"] ?>
                        </li>
                        <li>
                            Stato ordine: <?php echo $ordine["stato"]; ?>
                        </li>
                        <li>
                            Elenco Prodotti:
                            <table>
                                <tr>
                                    <th id="idmaglia">Id Maglia</th>
                                    <th id="quantità">Quantità</th>
                                </tr>
                                <?php foreach(explode(",", $ordine["maglie"]) as $maglia): 
                                    $maglia = explode(".", $maglia)?>
                                <tr>
                                    <td header="idmaglia"><?php echo $maglia[0] ?></td>
                                    <td header="quantità"><?php echo $maglia[1] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </li>
                    </ul>
                </div>
                <?php endforeach; ?>
            </section>
            <section>
                <h2>Elenco prodotti</h2>
                <div>
                    <?php if(isset($templateParams["messaggio1"])):?>
                    <p><?php echo $templateParams["messaggio1"]; ?></p>
                    <?php endif; ?>
                    <a href="gestisci-prodotto.php?action=1">Inserisci Maglia</a>
                    <table>
                        <thead>
                            <tr>
                                <th id="id">Id Maglia</th>
                                <th id="quantità">Quantità</th>
                                <th id="immagine">Immagine</th>
                                <th id="azioni">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($templateParams["prodotti"] as $maglia): ?>
                            <tr>
                                <th id="<?php echo $maglia["idMaglia"]; ?>" header="id"><?php echo $maglia["idMaglia"]; ?></td>
                                <td headers="<?php echo $maglia["idMaglia"]; ?> quantità"><?php echo $maglia["dispMagazzino"]; ?></td>
                                <td headers="<?php echo $maglia["idMaglia"]; ?> immagine"><img src="<?php echo UPLOAD_DIR.$maglia["immagineFronte"]; ?>" alt="" /></td>
                                <td headers="<?php echo $maglia["idMaglia"]; ?> azioni">
                                    <a href="gestisci-prodotto.php?action=2&id=<?php echo $maglia["idMaglia"]; ?>"> Modifica </a>
                                    <a href="gestisci-prodotto.php?action=3&id=<?php echo $maglia["idMaglia"]; ?>"> Cancella </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>