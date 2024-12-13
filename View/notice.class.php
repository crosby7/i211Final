<?php

/**
 * Author: Cameron Crosby
 * Date: 12/5/2024
 * File: notice.class.php
 * Description: Defines the Notice class. Alerts users when a change has occurred.
 */
class Notice extends View
{
    // public function to display a message
    public function display(
            String $msg,
            String $controller = 'BankAccount',
            String $method = 'index',
            String $buttonText = 'Return',
    ): void {
        //call the header
        $this->header(); ?>
        <h1 style = "color: dodgerblue">Notice</h1>
        <p style = "color: navy"><?= $msg ?></p>
        <div>
            <a href='<?= BASE_URL ?>/<?= $controller ?>/<?= $method ?>'>
                <input type="submit" class="button" value="<?= $buttonText ?>">
            </a>
        </div>
        <?php
        //call the footer
        $this->footer();
    }
}