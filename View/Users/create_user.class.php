<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: create_account.class.php
 * Description:
 */

//create the class
class CreateUser extends View
{
    //define the display method
    public function display(): void
    {
        //call the header
        $this->header(); ?>

        <form class="new-media" action="<?= BASE_URL ?>/User/register" method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="10">
            <p><strong>First Name</strong>: <br>
                <input name="firstName" type="text" size="100" value="" autofocus=""></p>
            <p><strong>Last Name</strong>: <br>
                <input name="lastName" type="text" size="100" value="" autofocus=""></p>
            <p><strong>Email</strong>: <br>
                <input name="email" type="text" size="100" required=""></p>
            <p><strong>Password</strong>: <br>
                <input name="password" type="text" size="100" required=""></p>
            <input type="submit" name="action" value="Create User">
        </form>
        <a href='<?= BASE_URL ?>/User/all'>
            <input type="submit" class="button" value="Cancel">
        </a>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}
