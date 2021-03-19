<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Generating social images can sometimes take a couple of seconds. To get past
    | this, Social Shots will cache the filename of the last generated social image.
    | You can configure how long you'd like the cache to be valid for. You can
    | invalidate the cache at any time.
    |
    */

    'cache_length' => 60, // In minutes

    /*
    |--------------------------------------------------------------------------
    | Filesystem
    |--------------------------------------------------------------------------
    |
    | Where should generated social shots be saved to? You're free to change this
    | to any filesystem you have configured in config/filesystems.php.
    |
    */

    'filesystem_disk' => 'public',

];
