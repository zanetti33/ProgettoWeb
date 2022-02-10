            <section>
                <h2>Credenziali</h2>
                <?php if(isset($_SESSION["email"])): ?>
                    <p>Email: <?php echo $_SESSION["email"]; ?></p>
                <?php endif; ?>
                <form action="" method="POST">
                    <input type="submit" name="logout" value="Logout" /> 
                </form>
                <form action="" method="POST">
                    <fieldset>Cambia password:
                    <ul>
                        <li>
                            <label for="vecchiaPassword">Vecchia Password:</label>
                            <input type="password" id="vecchiaPassword" name="vecchiaPassword" />
                        </li>
                        <li>
                            <label for="nuovaPassword">Nuova Password:</label>
                            <input type="password" id="nuovaPassword" name="nuovaPassword" />
                        </li>
                        <li> 
                            <input type="submit" name="submit" value="Invia" /> 
                        </li>
                    </ul>
                    </fieldset>
                </form>
                <?php if(isset($templateParams["messaggio"])): ?>
                    <p><?php echo $templateParams["messaggio"]; ?></p>
                <?php endif; ?>
            </section>