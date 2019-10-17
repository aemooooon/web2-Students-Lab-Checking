
<?php
  include 'inc/header.html.php';
?>

    <div class="container bg_white">
        <br><br><br><br><br>
        <a href="#" onclick="JavaScript:window.history.back();" class="btn btn-primary pull-right"><i class="fa fa-backward"></i>
            Back</a> <br><br>
        <div class="card">
            <h5 class="card-header"><img src="<?php echo URLROOT; ?>/project/images/error.png" alt="Error"> Error Message</h5>
            <div class="card-body">
                <h5 class="card-title">
                <?php
                if (isset($error)) {
                    echo $error;
                }
                echo "<br>";
                if (isset($e)) {
                    echo $e->getMessage();
                }
                ?>
                </h5>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <?php
  include 'inc/footer.html.php';
