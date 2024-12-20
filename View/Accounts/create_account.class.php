<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: create_account.class.php
 * Description: This class displays the view form for creating an account
 */

//create the class
class CreateAccount extends View
{
    //define the display method
    public function display(): void
    {
        //call the header
        $this->header(); ?>
<!--            create form-->
<div>
<form class="new-media" action="<?= BASE_URL ?>/BankAccount/create" method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
    <input type="hidden" name="id" value="10">
    <p><strong>Account Nickname</strong>:
        <input name="accountNickname" type="text" size="100" value="" autofocus=""></p>
    <p><strong>Account Type</strong>:
        <select name="accountType" id="accountType">
            <option value="Checking">I want a checking account</option>
            <option value="Savings">I want a saving account</option>
        </select>
    <input type="submit" name="action" value="Create Account">
        <a href='<?= BASE_URL ?>/BankAccount/all'>
            <input type="button" class="button" value="Cancel">
        </a>
</form>
</div>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}
