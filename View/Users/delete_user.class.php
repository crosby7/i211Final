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
    public function display(int $id): void
    {
        //call the header
        $this->header(); ?>

        <h1 style="text-align: center">Attention! Are you sure you want to delete this account? </h1>
        <h3 style="text-align: center">Deleting your user account will delete all associated bank accounts.</h3>

        <div>
            <a href='<?= BASE_URL ?>/User/delete/<?=$id ?>'>
                <input type="submit" class="button" value="Yes, Delete User Account">
            </a>
        </div>
        <div>
            <a href='<?= BASE_URL ?>/User/all/'>
                <input type="submit" class="button" value="No, Cancel">
            </a>
        </div>

        <?php
        //call the footer
        $this->footer();
    } // End Display

}

