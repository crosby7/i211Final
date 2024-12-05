<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: create_account.class.php
 * Description:
 */

//create the class
class Create extends View
{
    //define the display method
    public function display(): void
    {
        //call the header
        $this->header(); ?>

<form class="new-media" action="" method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
    <input type="hidden" name="id" value="10">
    <p><strong>Account Nickname</strong>:
        <input name="accountNickname" type="text" size="350" value="" autofocus=""></p>
    <p><strong>Account Type</strong>:
        <input type="checkbox" id="account1" name="account1" value="checking">
        <label for="account1"> I want to create a checking account</label><br>
        <input type="checkbox" id="account2" name="account2" value="savings">
        <label for="account2"> I want to create a savings account</label><br>
    <p><strong>User ID</strong>: <br>
        <input name="userID" type="number" size="100" required=""></p>
    <input type="submit" name="action" value="Create Account">
    <input type="button" value="Cancel" onclick="window.location.href = "<?= BASE_URL ?>/BankAccount/all">
</form>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}
