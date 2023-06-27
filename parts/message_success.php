<?php 
if ( isset( $_SESSION['success'] ) && !empty( $_SESSION['success'] ) ) : ?>
    <div class="alert alert-success" role="alert">
        <?php
            // show success messsage 
            echo $_SESSION['success']; 
            // reset success message
            unset( $_SESSION['success'] );
        ?>
    </div>
<?php endif;