<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: accounts_error.class.php
 * Description: This class extends the View class. The "display" method displays an error message.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */

//create the class
class AccountError extends View
{
    //define the display method
    public function display($message): void
    {

        //call the header method defined in the parent class to add the header
        parent::header();
        ?>
        <!-- page specific content starts -->
        <h1>Error</h1>

        <!-- error message -->
        <div class="middle-row">
            <h3>We are sorry, but an error has occurred.</h3>
            <p><?= $message ?></p>
        </div>


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::footer();
    }
}
