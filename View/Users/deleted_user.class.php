<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: create_account.class.php
 * Description:
 */

//create the class
class DeletedUser extends View
{
    //define the display method
    public function display(): void
    {
        //call the header
        $this->header(); ?>

        <h1 style="text-align: center">You have successfully deleted your user account.</h1>
        <h3 style="text-align: center">All associated bank accounts have been deleted.</h3>
        <input type="submit" name="action" value="Create New User" onclick = "window.location.href = "<?=BASE_URL ?>/User/create">
        <input type="button" value="Home" onclick="window.location.href = "<?= BASE_URL ?>/index.php">
        <?php
        //call the footer
        $this->footer();
    } // End Display

}


