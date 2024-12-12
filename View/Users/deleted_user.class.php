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
        <div>
            <a href='<?= BASE_URL ?>/User/create/'>
                <input type="submit" class="button" value="Create Account">
            </a>
        </div>
        <div>
            <a href='<?= BASE_URL ?>/index.php/'>
                <input type="submit" class="button" value="Home">
            </a>
        </div>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}


