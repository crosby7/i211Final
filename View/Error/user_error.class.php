<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: user_error.class.php
 * Description: This class extends the View class. The "display" method displays an error message.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */

//create the class
class UserError extends View
{
    //define the display method
    public function display($message): void
    {

        //call the header method defined in the parent class to add the header
        parent::header();
        ?>
        <!-- page specific content starts -->
        <h1 style="color: green">Error</h1>

        <!-- error message -->
        <div>
            <h3 style="color: green">We are sorry, but an user error has occurred.</h3>
            <p><?= $message ?></p>
        </div>


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::footer();
    }
}

