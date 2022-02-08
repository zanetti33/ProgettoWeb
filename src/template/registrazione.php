            <section>
                <h2>Registrazione</h2>
                <?php if(isset($templateParams["errore"])): ?>
                    <p><?php echo $templateParams["errore"]; ?></p>
                <?php endif; ?>
                <form action="#" method="POST">
                    <ul>
                        <li>
                            <label for="nomeRegistrazione">Nome:</label>
                            <input type="text" id="nomeRegistrazione" name="nomeRegistrazione" />
                        </li>
                        <li>
                            <label for="cognomeRegistrazione">Cognome:</label>
                            <input type="text" id="cognomeRegistrazione" name="cognomeRegistrazione" />
                        </li>
                        <li>
                            <label for="emailRegistrazione">Email:</label>
                            <input type="text" id="emailRegistrazione" name="emailRegistrazione" />
                        </li>
                        <li>
                            <label for="telefonoRegistrazione">Numero di telefono:</label>
                            <input type="text" id="telefonoRegistrazione" name="telefonoRegistrazione" />
                        </li>
                        <li>
                            <label for="passwordRegistrazione">Password:</label>
                            <input type="password" id="passwordRegistrazione" name="passwordRegistrazione" />
                        </li>
                        <li>
                            <label for="confermaPassword">Conferma password:</label>
                            <input type="password" id="confermaPassword" name="confermaPassword" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Invia" />
                        </li>
                    </ul>
                </form>
                <p>Se sei già registrato allora <a href="login.php">Accedi!</a></p>
            </section>