<?php
/*
 * Author: Millie Jones
 * Date: 11/21/24
 * Name: all_users.class.php
 * Description: This class extends the View class. The "display" method displays a table with all created users.
 *				To create the page header and footer, the display method calls the header and footer
 *				methods defined in the parent class.
 */


//create the class
class AllUser extends View
{
    //display method
    public function display(array $users): void
    {
        //call the header
        $this->header();
        ?>
        <?php
        $role = $_SESSION['role'];
        if ($role === 'Admin') {
            ?>
            <h2 style="color: navy">All User Accounts</h2>
            <?php
        } elseif ($role === 'User') { ?>
            <h2 style="color: navy">My User Account</h2>
        <?php }else {?>
            <h2 style="color: navy">Guest Account</h2>
            <?php } ?>

        <!--        create the table-->
        <table>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            <?php
            //begin the foreach loop to iterate through all objects in the accounts array
            foreach ($users as $u) {
                ?>
                    <tr>
                <!--                print accounts information in the table-->
                <td><a href="<?= BASE_URL ?>/User/details/<?= $u->getId() ?>"><?= $u->getId() ?></a></td>
                <td><?= $u->getFirstName() ?></td>
                <td><?= $u->getLastName() ?></td>
                <td><?= $u->getEmail() ?></td>
                <td><?= $u->getRole() ?></td>
                    </tr>
                <?php
            } ?>

        </table>
        <div style="padding-top: 50px;">
            <a href='<?= BASE_URL ?>/User/register'>
                <input type="submit" class="button" value="Create a new User">
            </a>
        </div>
        <?php
        //call the footer
        $this->footer();
    }
}
