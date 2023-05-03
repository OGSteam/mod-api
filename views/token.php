<h2><?php
    if (!defined('IN_SPYOGAME'))
        die("Hacking attempt"); // Pas d'accès direct


    $t = new modapi_token();
    $user_id = $user_data["user_id"];

    ?>
    <h2>Token<h2>

            <table class ="modapi">
                <?php if ($t->isExist($user_id) == false): ?>
                    <tr>
                        <td>
                            Vous ne disposez pas de token valide
                        </td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <th>
                            Nom
                        </th>
                        <th>
                            Token
                        </th>
                        <th>
                            Expire le
                        </th>
                        <th colspan="3">
                            Actions
                        </th>

                    </tr>
                    <?php foreach ($t->get_modapi_tokens($user_id) as $token) : ?>
                        <tr>
                            <td>
                                <?php echo $token["name"]; ?>
                            </td>
                            <td>
                                <?php echo $token["token"]; ?>
                            </td>
                            <td>
                                <?php echo date("d m Y", $token["expiration_date"]); ?>
                            </td>
                            <td>
                                <a href="index.php?action=api&subaction=token&name=<?php echo $token["name"]; ?>&renew">Renouveller</a>
                            </td>
                            <td>
                                <a href="index.php?action=api&subaction=token&name=<?php echo $token["name"]; ?>&prolong">Prolonger</a>
                            </td>
                            <td>
                                <a href="index.php?action=api&subaction=token&name=<?php echo $token["name"]; ?>&delete">Supprimer</a>
                            </td>


                        </tr>

                    <?php endforeach; ?>
                <?php endif; ?>

            </table>            


            <p><a href="index.php?action=api&subaction=token&create">Creer un nouveau token ?</a></p>
