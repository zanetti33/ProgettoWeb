<?php $maglia = $templateParams["maglia"]; ?>
            <section>
                <div>
                    <img src="<?php echo $IMG_DIR.$maglia["immagineFronte"]; ?>" alt="<?php echo $maglia["immagineFronte"]; ?>">
                </div>
                <div>
                    <img src="<?php echo $IMG_DIR.$maglia["immagineRetro"]; ?>" alt="<?php echo $maglia["immagineRetro"]; ?>">
                </div>
                <form>
                    <fieldset>Personalizza:
                    <ul>
                        <li>
                            <label>Taglia:</label>
                            <select required name="taglia">
                                <?php foreach($templateParams["taglie"] as $taglia): ?>
                                    <option value="<?php echo toTag($taglia["taglia"])?>"><?php echo $taglia["taglia"]?></option>
                                <?php endforeach; ?>
                            </select>
                        </li>
                        <li>
                            <label>Quantità:</label>
                            <input required type="number" name="quantità" min="1"/>
                        </li>
                        <li>
                            <label>Nome(+5€):</label>
                            <input type="text" id="nomePersonalizzato" name="nomePersonalizzato"/>
                        </li>
                        <li>
                            <label>Numero(+5€):</label>
                            <input type="number" name="numeroPersonalizzato" min="1" max="99"/>
                        </li>
                        <li>
                            <input type="submit" value="Aggiungi al carrello"/>
                        </li>
                    </ul>
                    </fieldset>
                </form>
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