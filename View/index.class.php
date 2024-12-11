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

           <h1 style="color: lightpink">Welcome to the Home Screen</h1>
           <div>
               <a href='<?= BASE_URL ?>/BankAccount/all'>
                    <input type="submit" class="button" value="Go to All Accounts">
               </a>
           </div>
        <?php
        //call the footer
        $this->footer();
    }
}
