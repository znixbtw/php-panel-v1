<table class="box accent table">
    <thead>
        <tr class="text-center">
            <th scope="col">UID</th>
            <th scope="col">USERNAME</th>
            <th scope="col">Last Inject</th>
            <th scope="col">ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //$i = 1;
        while ($row = mysqli_fetch_array($user_list)) { ?>
            <tr class="text-center">

                <th scope="row"><?php echo $row['id']; ?></th>

                <td><?php echo htmlspecialchars($row['username']); ?> <?php if ($row["admin"] == 1) { ?><i class="fas fa-check-circle"></i><?php } else {
                                                                                                                        } ?></td>

                <td>
                    <?php
                    echo($row["inject"]);?>
                </td>

                <td class="text-left">

                            <?php if ($row["banned"] == 1) { ?>
                                <a href="functions.php?unban=<?php echo $row['id'] ?>" title="Unban User"><i class="fas fa-user-slash white p-1"></i></a></i>
                            <?php } else { ?>
                                <a href="functions.php?ban=<?php echo $row['id'] ?>" title="Ban User"><i class="fas fa-user-check white p-1"></i></a></i>
                            <?php } ?>
                            <?php if ($row["active"] == 1) { ?>
                                <a href="functions.php?inactive=<?php echo $row['id'] ?>" title="End Sub"><i class="fas fa-circle green p-1"></i></a>
                            <?php } else { ?>
                                <a href="functions.php?active=<?php echo $row['id'] ?>" title="Start Sub"><i class="fas fa-circle red p-1"></i></a>
                            <?php } ?>
                            <?php if ($row["admin"] == 1) { ?>
                                <a href="functions.php?notadmin=<?php echo $row['id'] ?>" title="Remove Admin"><i class="fas fa-user-cog white p-1"></i></a>
                            <?php } else { ?>
                                <a href="functions.php?admin=<?php echo $row['id'] ?>" title="Make Admin"><i class="fas fa-user white p-1"></i></a>
                            <?php } ?>

                            <?php if ($row["hwid"] != NULL) { ?>
                                <a href="functions.php?hwid=<?php echo $row['id'] ?>" title="Reset HWID"><i class="fas fa-microchip white p-1"></i></a>
                            <?php } else ?>


                </td>

            </tr>
        <?php //$i++;
        } ?>
    </tbody>
</table>