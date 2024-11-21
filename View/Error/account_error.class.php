<?php

class AccountError extends View {
    public function display($message): void {

        //call the header method defined in the parent class to add the header
        parent::header();
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <h1>Error</h1>

        <!-- middle row -->
        <div class="middle-row">
            <h3>We are sorry, but an error has occurred.</h3>
            <p><?= $message ?></p>
        </div>


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::footer();
    }
}
