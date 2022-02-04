			<section>
                <div>
                        <img src="./img/ProdottiUomo.jpg" alt="prodotti uomo" />
                </div>
                <form>
                    <ul>
                        <li>
                            <label>Taglia
                                <select name="taglia">
                                    <option value="xs">XS</option>
                                    <option value="s">S</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                    <option value="xl">XL</option>
                                </select>
                                </label>
                            <label>Quantità<input type="number" name="quantità" min="1"/>
                            </label>
                        </li>
                        <li>
                            <input type="submit" value="Aggiungi al carrello"/>
                        </li>
                    </ul>
                </form>
            </section>
            <section>
                <h2>Descrizione prodotto:</h2>
                <article>

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