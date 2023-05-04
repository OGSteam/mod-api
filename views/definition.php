<?php

/**
 * @package [Mod] modapi
 * @author Machine
 * @copyright Copyright &copy; 2016, https://ogsteam.eu/
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 */ 

if (!defined('IN_SPYOGAME'))
    die("Hacking attempt"); // Pas d'accès direct


$def = webApi::getDefinition(); ?>


<h2>Liste des appels</h2>

<table>

    <tbody>
        <?php foreach ($def as $ressource => $definitions) : ?>
            <tr> 
                <td class="c" colspan="7"><?php echo $ressource; ?></td>
            </tr>
            <?php if (isset($definitions["description"])) : ?>
                <tr>
                    <td colspan="7"><?php echo $definitions["description"]; ?></td>
                </tr>
            <?php endif; ?>

            <?php if (isset($definitions["arguments"]) && count($definitions["arguments"]) > 0) : ?>
                <tr>
                    <td></td>
                    <th>Argument</th>
                    <th>cast</th>
                    <th>required</th>
                    <th>min</th>
                    <th>max</th>
                    <th>description</th>
                </tr>

                <?php foreach ($definitions["arguments"] as $key => $value) : ?>
                    <tr>
                        <td> </td>
                        <td><?php echo $key; ?> </td>
                        <td><?php echo $value["cast"]; ?> </td>
                        <td><?php echo $value["required"] ? 'Oui' : 'Non';  ?> </td>
                        <td><?php echo $value["min"]; ?> </td>
                        <td><?php echo $value["max"]; ?> </td>
                        <td><?php echo $value["description"]; ?> </td>.
                    </tr> 
                <?php endforeach; ?>

            <?php endif; ?>

        <?php endforeach; ?>




    </tbody>


</table>        
