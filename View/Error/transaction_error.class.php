<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: transaction_error.class.php
 * Description: This class extends the View class. The "display" method displays an error message.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */

//create the class
class TransactionError extends View
{
    //define the display method
    public function display($message): void
    {

        //call the header method defined in the parent class to add the header
        parent::header();
        ?>
        <!-- page specific content starts -->
        <h1 style="color: navy">Error</h1>

        <!-- error message -->
        <div>
            <h3 style="color: navy">We are sorry, but an transaction error has occurred.</h3>
            <p><?= $message ?></p>
        </div>


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::footer();
    }
}

