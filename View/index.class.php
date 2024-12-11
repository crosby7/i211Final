<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: index.class.php
 * Description: This class extends the View class. The "display" method displays the home screen with a button to go to all accounts.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */

//create the class
class Index extends View
{
    //define the display method
    public function display():void
    {
        //call the header
        $this->header(); ?>
<!--            page specific content and button-->

           <h1 style="color: green">Welcome to the Home Screen</h1>
        <h2><a href='<?= BASE_URL ?>/User/login'>Click Here to Log in</a></h2>
        <h2>Don't have an account?</h2>
        <h3><a href='<?= BASE_URL ?>/User/register'>Click Here to Create an Account</a></h3>

        <?php
        //call the footer
        $this->footer();
    }
}
