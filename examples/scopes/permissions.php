<?php

// If you are using Composer
//require 'vendor/autoload.php';

//If you are not using Composer
require __DIR__ . '/../../lib/loader.php';

    var_dump(
        (new SendGrid\Permissions())
            -> scopeStart()
            -> read('tracking_settings')
            -> update('whitelabel')
            -> create('suppression.bounces')
            -> send('this.does.not.exist')
            -> scopeGet()
    );

    var_dump(
        (new SendGrid\Permissions())
            -> mailSendFullAccess()
    );

    var_dump(
        (new SendGrid\Permissions())
            -> ipManagementFullAccess()
    );

    var_dump(
        (new SendGrid\Permissions())
            -> mailSettingsFullAccess()
    );

    var_dump(
        (new SendGrid\Permissions())
            -> adminAccess()
    );
?>