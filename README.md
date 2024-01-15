# ACME-DoorPad
ACME Doorpad Tech Test

# Introduction

This tech test is the result of a week of struggles and pain!   It has dropped at a time when I am juggling house sale and purchase, and large projects at work.

I've worked odd hours as and when they're available and have done what I can to get this as far along as possible.  Late nights, blood, sweat and tears has gone into this.  But it has been fun despite the challenges! :) 

This is the composer package application, which contains the core functionality for the key pad.  You can find a quick start project [here.]([https://github.com/Vince-C9/ACME-DoorPad](https://github.com/Vince-C9/ACME-DoorPadProject/tree/main))

Please note that I wasn't able to complete this to a standard I would like to have.  Some parts are missing (Admin panel, front end in general) and in places I've had to cut corners to get a minimum version ready.  From here, of course, we'd iterate up in that agile fashion. ;)   I have used PostMan from my starter project to test whether the package works. 

Annoyingly, at 2am tonight I hit an issue where calling the endpoint on the starter project would cause it to redirect back to the home page.  This is surely something simple, but I just don't have time to finish it.  

The tests and functionality within this repo, however, do work, including the elimination of that frustrating redirect issue.

Thanks for your time and for bearing with my current personal situation.


# Installation (package dev environment)
To install this on your local environment, just clone it down!  I have used Testbench, so it should be self contained while in development.

Once cloned you'll need to run `composer install` to pull in the required packages.

You can run the tests by using `vendor/bin/phpunit`. 

![image](https://github.com/Vince-C9/ACME-DoorPad/assets/78065068/ac40f75e-611c-47f6-87fd-fdb6c7ba6efd)

Editing can be done in the testbench as though it were a laravel project (please do not push back to this repo while it is publically available).

# Installation (onto a project)

Note:  Assumptions are that you have already set up your base laravel project with a key and any standard migrations from out of the box.  If not, [the guide is here](https://laravel.com/docs/10.x/installation)

1. Add the following config to your composer.json.  If you already have a repositories section, make sure that you refactor this to fit in with your current settings.
 ```
"repositories": {
        "vince/acme-door-pad": {
            "type": "git",
            "url": "https://github.com/Vince-C9/ACME-DoorPad.git"
        }
    },
```

2. Now you can run `composer require vince/acme-door-pad` to include the package in your project.
3. You will need to publish the config: `php artisan vendor:publish --tag=acme-config`
4. Finally you will need to migrate the data tables.  These are not yet configurable and one is called "keys" and the other "keypad_users". `php artisan migrate`

5. You should now have your new tables and config files installed.  Unfortunately I ran out of time to debug a few of the issues with the 'runner' project, and when running on this project, if you try to access the login page, you'll be redirected back to the home page.

# Console Commands
There are three console commands you should be able to use with this plugin in place to generate keys.   You will need to run these from your project, not from the package route.

1. You can use `(docker prefix) php artisan security:keyAdd --amount=x` to queue up X amount of keys.  This will batch into chunks of 100 and dispatch them asyncrhonously.
2. You can use `(docker prefix) security:associate {user_id} {key}` to associate a user in the KeypadUsers table with the provided key.  You will need to use Tinker to add a user at this time.
3. You can use `(docker prefix) security:dissociateKey {user_id}` to remove a users assigned key.

At this time, there are no Admin API pages that allow the addition and removal of users or keys due to time constraints.

# Custom Functionality 
The guts of the functionality runs through the services and models provided in the package.  These can be found in their standard locations when compared to Laravel, however the KeyCodeService I've written is in its own 'services' folder, within src.

The service can be instantiated thus:  `$keyService = new Vince\AcmeDoorPad\Services\KeyCodes\KeyCodeService` (do feel free to use case or alias this).
The primary method is called `generateUniqueKey()` and this will make a key that fits the required criteria of the task:
- No palindromes
- No sequences above 3
- No repitition above 3
- Must be unique

The other methods may be called at your leisure.

# Sign off 
Thanks again for your patience.  I hope this is all within the spirit of the tech test.  I will await review, then probably build on this to get it over the line as time allows.  It's been interesting!
