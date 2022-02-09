			<section>
                <h2>I miei ordini</h2>
                <?php foreach($templateParams["ordini"] as $ordine): ?>
                    <div>
                        <h2> Data pagamento: <?php echo $ordine["dataPagamento"] ?></h2>
                        <h3> Stato: <?php echo $ordine["stato"] ?></h3>
                        <table>
                            <thead>
                                <tr>
                                    <th id="maglia">Maglia</th>
                                    <th id="scritta">Scritta</th>
                                    <th id="numero">Numero</th>
                                    <th id="quantità">Quantità</th>
                                    <th id="costo">Costo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dbh->getProductsInOrder($ordine["idOrdine"]) as $product): ?>
                                <tr>
                                    <td header="maglia">
                                        <a href="singolo-prodotto.php?idMaglia=<?php echo $product["idMaglia"]; ?>">
                                            <img src="<?php echo $IMG_DIR.$product["immagineFronte"]; ?>" alt="<?php echo $product["immagineFronte"]; ?>">
                                        </a>
                                    </td>
                                    <td header="scritta">
                                        <?php echo $product["nomePersonalizzato"]; ?>
                                    </td>
                                    <td header="numero">
                                        <?php echo $product["numeroPersonalizzato"]; ?>
                                    </td>
                                    <td header="quantità">
                                        <?php echo $product["quantità"]; ?>
                                    </td>
                                    <td header="costo">
                                        <?php echo $product["costo"]; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th id="totale">Totale:</th>
                                    <td colspan=4 header="totale"><?php echo $ordine["totale"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </section>
            <?php require("credenziali.php") ?>