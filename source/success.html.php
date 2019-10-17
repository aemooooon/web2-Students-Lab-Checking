
<?php
  include 'inc/header.html.php';
?>

    <div class="container bg_white">
    <br><br><br><br><br>
        <div class="card">
            <h5 class="card-header"><img src="<?php echo URLROOT; ?>/project/images/success.png" alt="Success"> Success Message</h5>
            <div class="card-body">
                <h5 class="card-title">
                    <?php
                if (isset($success_message)) {
                    echo $success_message;
                }
                ?>
                </h5>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <?php
  include 'inc/footer.html.php';
