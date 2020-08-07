<div class="box rounded accent">
    <button type="button" class="btn btn-custom px-2 mx-1" onclick="window.location.href='functions.php?gencode'">Gen Inv</button>
</div>

<table class="box accent table">
    <thead>
        <tr class="text-center">
            <th scope="col">UID</th>
            <th scope="col">CODE</th>
            <th scope="col">USED</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //$i = 1;
        while ($row = mysqli_fetch_array($invite_list)) { ?>
            <tr class="text-center">
                <th scope="row"><?php echo $row['uid']; ?></th>
                <td><?php echo $row['code']; ?></td>
                <td><?php if ($row["used"] == 1) { ?><i class="fas fa-check-circle"></i><?php } else { ?><i class="fas fa-times-circle"></i><?php } ?></td>
            </tr>
        <?php //$i++;
        } ?>
    </tbody>
</table>