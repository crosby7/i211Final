<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: create_account.class.php
 * Description:
 */

//create the class
class EditUser extends View
{
    //define the display method
    public function display(string $firstName, string $lastName, string $email): void
    {
        //call the header
        $this->header(); ?>

        <form class="new-media" action="<?= BASE_URL ?>/User/edit" method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="10">
            <p><strong>First Name</strong>:
                <input name="firstName" type="text" size="350" value="<?=$firstName?>" autofocus=""></p>
            <p><strong>Last Name</strong>:
                <input name="lastName" type="text" size="350" value="<?=$lastName?>" autofocus=""></p>
            <p><strong>Email</strong>: <br>
                <input name="email" type="text" size="350" value = "<?=$email?>" required=""></p>
            <p><strong>Password</strong>: <br>
                <input name="password" type="text" size="350" required=""></p>
            <input type="submit" name="action" value="Edit Account" onclick = "window.location.href = "<?=BASE_URL ?>/User/all">
            <input type="button" value="Cancel" onclick="window.location.href = "<?= BASE_URL ?>/User/all">
        </form>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}
