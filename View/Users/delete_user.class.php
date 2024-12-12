<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: create_account.class.php
 * Description:
 */

//create the class
class DeleteUser extends View
{
    //define the display method
    public function display(): void
    {
        //call the header
        $this->header(); ?>

        <h1 style="text-align: center">Attention! Are you sure you want to delete this account? </h1>
        <h3 style="text-align: center">Deleting your user account will delete all associated bank accounts.</h3>
                <input type="button" name="action" value="Yes, Delete User Account" onclick = "window.location.href = "<?=BASE_URL ?>/User/delete">
                <input type="button" value="No, Cancel" onclick="window.location.href = "<?= BASE_URL ?>/User/all">
        <?php
        //call the footer
        $this->footer();
    } // End Display

}

