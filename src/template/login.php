            <section>
                <h2>Login</h2>
                <?php if(isset($templateParams["errore"])): ?>
                    <p><?php echo $templateParams["errore"]; ?></p>
                <?php endif; ?>
                <form action="#" method="POST">
                    <ul>
                        <li>
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" />
                        </li>
                        <li>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Invia" />
                        </li>
                    </ul>
                </form>
                <p>Se non sei ancora registrato <a href="registrazione.php">Registrati!</a></p>
            </section>