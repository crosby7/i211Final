<?php

/**
 * Author: Cameron Crosby
 * Date: 12/12/2024
 * File: no_account_notice.class.php
 * Description: Defines the NoAccountNotice view. This displays when there are no BankAccounts or Transactions for a user/account
 */

class NoAccountNotice extends View
{
    // public function to display a message
    public function display($msg, $controllerName): void {
        //call the header
        $this->header(); ?>
        <h1>Notice</h1>
        <p><?= $msg ?></p>
        <div>
            <p>Would you like to create a new one?</p>
            <a href='<?= BASE_URL ?>/<?= $controllerName ?>/create'>
                <input type="submit" class="button" value="Create an Entry">
            </a>
        </div>
        <?php
        //call the footer
        $this->footer();
    }
}