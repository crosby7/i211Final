<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: user_details.class.php
 * Description: This class extends the View class. The "display" method displays a table with the details of a particular user.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */

//create the class
class Details extends View
{
    //define the display method
    public function display(Users $user): void
    {
        //call the header
        $this->header(); ?>

        <h2>User Details</h2>
        <!--        create the table-->
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            <tr>
                <!--                retrieve account details and print in table-->
                <td><?= $user->getFirstName() ?></td>
                <td><?= $user->getLastName() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getRole() ?></td>

            </tr>
        </table>
        <div>
            <a href='<?= BASE_URL ?>/User/all'>
                <input type="submit" class="button" value="Back to all Users">
            </a>
        </div>
        <div>
            <a href='<?= BASE_URL ?>/User/delete/<?= $user->getID() ?>'>
                <input type="submit" class="button" value="Delete Account">
            </a>
        </div>
        <?php
        //call the footer
        $this->footer();
    } // End Display

}
