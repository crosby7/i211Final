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
            <p><strong>First Name</strong>:
                <input name="firstName" type="text" size="350" value="" autofocus=""></p>
            <p><strong>Last Name</strong>:
                <input name="lastName" type="text" size="350" value="" autofocus=""></p>
            <p><strong>Email</strong>: <br>
                <input name="email" type="text" size="350" required=""></p>
            <p><strong>Password</strong>: <br>
                <input name="password" type="text" size="350" required=""></p>
            <select name="role" id="accountType">
                <option value="User">Regular User</option>
                <option value="Admin">Admin User</option>
            </select>
            <input type="submit" name="action" value="Create User">
            <input type="button" value="Cancel" onclick="window.location.href = "<?= BASE_URL ?>/User/all">
        </form>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}
