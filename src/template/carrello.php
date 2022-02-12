			<section>
                <h2>Riepilogo ordine</h2>
                <?php if(isset($templateParams["messaggioCarrello"])): ?>
                    <p><?php echo $templateParams["messaggioCarrello"]; ?></p>
                <?php endif; ?>
                <?php if(count($templateParams["maglie"]) == 0): ?>
                    <h3> Il tuo carrello è vuoto </h3>
                <?php else: ?>
                    <table>
                    <thead>
                        <tr>
                            <th id="maglia">Maglia</th>
                            <th id="taglia">Taglia</th>
                            <th id="scritta">Scritta</th>
                            <th id="numero">Numero</th>
                            <th id="quantità">Quantità</th>
                            <th id="costo">Costo</th>
                            <th id="azione">Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($templateParams["maglie"] as $maglia): ?>
                        <tr>
                            <td header="maglia">
                                <a href="singolo-prodotto.php?idMaglia=<?php echo $maglia["idMaglia"]; ?>">
                                    <img src="<?php echo $IMG_DIR.$maglia["immagineFronte"]; ?>" alt="<?php echo $maglia["immagineFronte"]; ?>">
                                </a>
                            </td>
                            <td header="taglia">
                                <?php echo $maglia["taglia"]; ?>
                            </td>
                            <td header="scritta">
                                <?php echo $maglia["nomePersonalizzato"]; ?>
                            </td>
                            <td header="numero">
                                <?php echo $maglia["numeroPersonalizzato"]; ?>
                            </td>
                            <td header="quantità">
                                <?php echo $maglia["quantità"]; ?>
                            </td>
                            <td header="costo">
                                <?php echo $maglia["costo"]; ?>
                            </td>
                            <td>
                                <a href="rimozione-carrello.php?idRiga=<?php echo $maglia["idRiga"]; ?>">rimuovi</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th id="totale">Totale:</th>
                            <td colspan=6 header="totale"><?php echo totalCart($templateParams["maglie"]) ?></td>
                        </tr>
                    </tbody>
                    </table>
                <?php endif; ?>
            </section>
            <section>
                <?php if(isset($templateParams["messaggio"])): ?>
                    <p><?php echo $templateParams["messaggio"]; ?></p>
                <?php endif; ?>
                <form action="" method="POST">
                    <fieldset>Pagamento
                    <ul>
                        <li>
                            <label for="nomePagamento">Nome:</label>
                            <input required type="text" id="nomePagamento" name="nomePagamento" />
                        </li>
                        <li>
                            <label for="cognomePagamento">Cognome:</label>
                            <input required type="text" id="cognomePagamento" name="cognomePagamento" />
                        </li>
                        <li>
                            <label for="numeroCarta">Numero carta:</label>
                            <input required type="text" id="numeroCarta" name="numeroCarta" />
                        </li>
                        <li>
                            <label for="cvv">CVV:</label>
                            <input required type="text" id="cvv" name="cvv" />
                        </li>
                        <li>
                            <label for="scadenzaCarta">Data Scadenza:</label>
                            <input required type="month" id="scadenzaCarta" name="scadenzaCarta" />
                        </li>
                        <li>
                            <input type="submit" name="acquista" value="acquista" />
                        </li>
                    </ul>
                    </fieldset>
                </form>
            </section>