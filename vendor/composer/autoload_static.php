<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4d12d5617ed50cea33318fde1cf8368d
{
    public static $classMap = array (
        'AccountError' => __DIR__ . '/../..' . '/View/Error/account_error.class.php',
        'AccountSearch' => __DIR__ . '/../..' . '/View/Accounts/account_search.class.php',
        'Accounts' => __DIR__ . '/../..' . '/View/Accounts/all_accounts.class.php',
        'BankAccount' => __DIR__ . '/../..' . '/models/BankAccount/bank_account.class.php',
        'BankAccountController' => __DIR__ . '/../..' . '/controllers/bank_account_controller_class.php',
        'BankAccountModel' => __DIR__ . '/../..' . '/models/BankAccount/bank_account_model.class.php',
        'ComposerAutoloaderInit4d12d5617ed50cea33318fde1cf8368d' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit4d12d5617ed50cea33318fde1cf8368d' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Console' => __DIR__ . '/../..' . '/application/console_php.php',
        'Create' => __DIR__ . '/../..' . '/View/Accounts/create_account.class.php',
        'Database' => __DIR__ . '/../..' . '/application/database.class.php',
        'Details' => __DIR__ . '/../..' . '/View/Accounts/accounts_details.class.php',
        'Dispatcher' => __DIR__ . '/../..' . '/application/dispatcher.class.php',
        'Index' => __DIR__ . '/../..' . '/View/index.class.php',
        'Notice' => __DIR__ . '/../..' . '/View/notice.class.php',
        'Transaction' => __DIR__ . '/../..' . '/models/Transaction/transaction.class.php',
        'TransactionController' => __DIR__ . '/../..' . '/controllers/transaction_controller.class.php',
        'TransactionModel' => __DIR__ . '/../..' . '/models/Transaction/transaction_model.class.php',
        'User' => __DIR__ . '/../..' . '/models/User/user.class.php',
        'UserController' => __DIR__ . '/../..' . '/controllers/user_controller.class.php',
        'UserModel' => __DIR__ . '/../..' . '/models/User/user_model.class.php',
        'View' => __DIR__ . '/../..' . '/View/view.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit4d12d5617ed50cea33318fde1cf8368d::$classMap;

        }, null, ClassLoader::class);
    }
}
