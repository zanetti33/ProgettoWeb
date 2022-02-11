<?php $maglia = $templateParams["maglia"]; ?>
    <section>
        <div>
            <img src="<?php echo $IMG_DIR.$maglia["immagineFronte"]; ?>" alt="<?php echo $maglia["immagineFronte"]; ?>">
        </div>
        <div>
            <img src="<?php echo $IMG_DIR.$maglia["immagineRetro"]; ?>" alt="<?php echo $maglia["immagineRetro"]; ?>">
        </div>
            <fieldset><legend>Personalizza:</legend>
                <ul>
                    <li>
                        <p>Taglia: <?php echo $maglia["taglia"]?></p>
                    </li>
                    <li>
                        <label for="taglia">Seleziona un'altra taglia:</label>
                        <?php /* NON FUNZIONAAAAAAAAAA */ ?>
                        <form action="" method="POST">
                        <ul>
                            <?php foreach($templateParams["taglie"] as $taglia): ?>
                                <?php if($taglia["taglia"] != $maglia["taglia"]): ?>
                                    <li>
                                        <label><?php echo $taglia["taglia"]?></label>
                                        <input type="radio" name="taglia" value="<?php echo $taglia["taglia"]?>"/>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <li>
                                <input type="submit" name="cambioTaglia" value="Cambia taglia"/>
                            </li>
                        </ul>
                    </form>
                    <?php/* ANDREBBE FATTA LA STESSA COSA ANCHE CON I COLORI */?>
                    </li>
                </ul>
                    <form>
                        <ul>
                        <li>
                            <label for="quantity">Quantità:</label>
                            <input required type="quantity" name="quantità" min="1" max="<?php echo $maglia["dispMagazzino"]?>"/>
                            <p>(ne sono rimaste solo <?php echo $maglia["dispMagazzino"]?>)</p>
                        </li>
                        <li>
                            <label for="name">Nome(+5€):</label>
                            <input type="name" id="nomePersonalizzato" name="nomePersonalizzato"/>
                        </li>
                        <li>
                            <label for="number">Numero(+5€):</label>
                            <input type="number" name="numeroPersonalizzato" min="1" max="99"/>
                        </li>
                        <li>
                            <?php if($maglia["dispMagazzino"] <= 0): ?>
                                <p>In questo momento la maglia non è disponibile!</p>
                                <input type="submit" value="Aggiungi al carrello" disabled/>
                            <?php else: ?>
                                <input type="submit" value="Aggiungi al carrello"/>
                            <?php endif; ?>
                        </li>
                        </ul>
                        </form>
                    
                    </fieldset>
                
            </section>
            <section>
                <h2>Descrizione prodotto:</h2>
                <article>
                    <h3><?php echo $maglia["modello"]?></h3>
                    <br><?php echo $maglia["descrizione"]?>
                    <br><?php echo $maglia["genere"]?>
                    <br><?php echo $maglia["colore"]?>
                    <br><?php echo $maglia["prezzo"]?>€
                    <br><br>
                </article>
                <table>
                    <caption>Guida alle taglie (cm):</caption>
                    <thead>
                        <tr>
                            <th scope="col" id="taglia">Taglia</th>
                            <th scope="col" id="it">IT</th>
                            <th scope="col" id="spalla">Spalla</th>
                            <th scope="col" id="lung">Lunghezza</th>
                            <th scope="col" id="manica">Manica</th>
                            <th scope="col" id="torace">Torace</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td headers="taglia">XS</td>
                            <td headers="it">44</td>
                            <td headers="spalla">45</td>
                            <td headers="lung">66</td>
                            <td headers="manica">20</td>
                            <td headers="torace">100</td>
                        </tr>
                        <tr>
                            <td headers="taglia">S</td>
                            <td headers="it">46</td>
                            <td headers="spalla">45.5</td>
                            <td headers="lung">68</td>
                            <td headers="manica">20.5</td>
                            <td headers="torace">104</td>
                        </tr>
                        <tr>
                            <td headers="taglia">M</td>
                            <td headers="it">48</td>
                            <td headers="spalla">46</td>
                            <td headers="lung">70</td>
                            <td headers="manica">21</td>
                            <td headers="torace">108</td>
                        </tr>
                        <tr>
                            <td headers="taglia">L</td>
                            <td headers="it">50</td>
                            <td headers="spalla">47</td>
                            <td headers="lung">72</td>
                            <td headers="manica">21.5</td>
                            <td headers="torace">112</td>
                        </tr>
                        <tr>
                            <td headers="taglia">XL</td>
                            <td headers="it">52</td>
                            <td headers="spalla">50</td>
                            <td headers="lung">74</td>
                            <td headers="manica">22</td>
                            <td headers="torace">116</td>
                        </tr>
                    </tbody>
                </table>
            </section>