            <section>
                <h2>Contatti</h2>
                <table>
                    <tr>
                        <th id="autore">Autore</th>
                        <th id="email">Email</th>
                    </tr>
                    <?php foreach($dbh->getAdmins() as $admin): ?>
                        <tr>
                            <th id="<?php echo toTag($admin["nome"]), toTag($admin["cognome"]); ?>"><?php echo $admin["nome"], " ", $admin["cognome"]; ?></th>
                            <td headers="<?php echo toTag($admin["nome"]), toTag($admin["cognome"]); ?> email"><?php echo $admin["email"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>