<?php 
if ( isset( $_SESSION['error'] ) && !empty( $_SESSION['error'] ) ) : ?>
    <div class="alert alert-danger" role="alert">
        <?php
            // show error messsage 
            echo $_SESSION['error']; 
            // reset error message
            unset( $_SESSION['error'] );
        ?>
    </div>
<?php endif;