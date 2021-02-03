# PHP Tasks

## Requirements

 * PHP 7.3
 * Composer

## How to install
 * Fork your own copy of repository to your account
 * Clone to your PC
 * `cd` into cloned repository folder
 * Execute in terminal `git remote add upstream https://github.com/LvivScriptCommunity/phplab-tasks.git`
 * Execute in terminal `composer install`
 
## PHP Unit
https://phpunit.readthedocs.io/en/9.2/textui.html
 
#### How to run all tests
 * Windows users: `.\vendor\bin\phpunit`
 * Linux users: `./vendor/bin/phpunit`
 
#### How to run all tests from specific file
 * Windows users: `.\vendor\bin\phpunit --filter=IsLeapYearTest`
 * Linux users: `./vendor/bin/phpunit --filter=IsLeapYearTest`
 
## How to Keep a Git Fork up to Date
 * `cd` into cloned repository folder
 * Execute in terminal `git fetch upstream`
 * Execute in terminal `git pull upstream master`
 * Execute in terminal `composer dump-autoload`
 
OR

Follow the instruction to update from GitHub Web UI: 
 * https://www.earthdatascience.org/courses/intro-to-earth-data-science/git-github/github-collaboration/update-github-repositories-with-changes-by-others/

## How to resolve conflicts
 * https://www.youtube.com/watch?v=JtIX3HJKwfo
 * https://www.youtube.com/watch?v=xNVM5UxlFSA
