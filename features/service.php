<div class="box rounded accent my-3">
    <?php if ($service["status"] == 1) { ?>
        <button type="button" class="btn btn-custom px-2 mx-1 w-auto" onclick="window.location.href='functions.php?undetected'">Detected <i class="fas fa-check-circle"></i></button>
    <?php } else { ?>
        <button type="button" class="btn btn-custom px-2 mx-1 w-auto" onclick="window.location.href='functions.php?detected'">Detected <i class="fas fa-times-circle"></i></button>
    <?php } ?>

    <?php if ($service["maintenance"] == 1) { ?>
        <button type="button" class="btn btn-custom px-2 mx-1 w-auto" onclick="window.location.href='functions.php?maintenance'">Maintenance <i class="fas fa-check-circle"></i></button>
    <?php } else { ?>
        <button type="button" class="btn btn-custom px-2 mx-1 w-auto" onclick="window.location.href='functions.php?under_maintenance'">Maintenance <i class="fas fa-times-circle"></i></button>
    <?php } ?>

</div>

<div class="box rounded accent my-3">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($version_err)) ? 'has-error' : ''; ?>">
            <label>Update loader version</label>
            <input type="text" name="version" class="form-control form-control-sm" value="<?php echo $version; ?>">
            <span class="help-block"><?php echo $version_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </form>
</div>