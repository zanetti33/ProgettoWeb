                <?php if(isset($_SESSION["admin"]) && (!$_SESSION["admin"])): ?>
                <li>
                    <a href="carrello.php">
                        <img src="./img/cart.png" alt="carrello">
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="login.php">
                        <img src="./img/avatar.png" alt="opzioni">
                    </a>
                </li>