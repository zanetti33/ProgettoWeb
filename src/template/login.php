            <section>
                <h2>Login</h2>
                <?php if(isset($templateParams["messaggio"])): ?>
                    <p><?php echo $templateParams["messaggio"]; ?></p>
                <?php endif; ?>
                <form action="" method="POST">
                    <ul>
                        <li>
                            <label for="email">Email:</label>
                            <input required type="text" id="email" name="email" />
                        </li>
                        <li>
                            <label for="password">Password:</label>
                            <input required type="password" id="password" name="password" />
                        </li>
                        <li>
                            <input type="submit" name="invioLogin" value="Invia" />
                        </li>
                    </ul>
                </form>
                <p>Se non sei ancora registrato <a href="registrazione.php">Registrati!</a></p>
            </section>