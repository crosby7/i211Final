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
    public function display($msg, $controllerName): void {
        //call the header
        $this->header(); ?>
        <h1>Notice</h1>
        <p><?= $msg ?></p>
        <div>
            <a href='<?= BASE_URL ?>/index.php'>
                <input type="submit" class="button" value="Go Home">
            </a>
        </div>
        <?php
        //call the footer
        $this->footer();
    }
}