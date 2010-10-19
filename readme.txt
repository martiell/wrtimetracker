Anuko Time Tracker.
Copyright (c) 2004-2010 Anuko (http://www.anuko.com).

Project home page: http://www.anuko.com/content/time_tracker/index.htm
Free hosting of Anuko Time Tracker for individuals and small teams is available at http://timetracker.wrconsulting.com
 
Each file in this archive is protected by the LIBERAL FREEWARE LICENSE. 
Please read the file license.txt for details.


INSTALLATION INSTRUCTIONS

Detailed documentation is available at http://www.anuko.com/content/time_tracker/install_guide/index.htm

The general installation procedure looks like this:

- Install a web server and make sure it can serve HTML documents.
- Install PHP, configure your server to work with PHP scripts, and make sure it can work with PHP files. 
- Install the following PHP extensions: MySQL and GD. The GD extension is needed for pie-charts only.
- Install a database server such as MySQL and make sure it is working properly. 
- Install, configure, and test Anuko Time Tracker like so: 

1) Unpack distribution files into a selected directory for Apache web server.
2) Create a database using the mysql.sql file in the distribution.
3) If you are upgrading from earlier versions run dbinstall.php from your browser and do the required "Update database structure" steps.
4) Create user name and password to access the time tracker database. 
5) Change $dsn value in /WEB-INF/config.php file to reflect your database connection parameters (user name and password).
6) For UNIX systems set full access rights for catalog WEB-INF/templates_c/ (chmod 777 templates_c).
7) Set MULTITEAM_MODE = "true" in /WEB-INF/config.php file if you want to allow users create their own teams. By default it is "false", which means that only admin can create teams.
8) If you install time tracker into a sub-directory of your site reflect this in the APP_NAME parameter in /WEB-INF/config.php file. For example, for http://localhost/timetracker/ set APP_NAME = "timetracker".
9) Login to your time tracker site as admin with password "secret" without quotes and create at least one team.
10) Change admin password (on the admin "options" page). You can also use the following SQL console command: 
  update users set u_password = md5('new_password_here') where u_login='admin'
  or by using the "Change password of administrator account" option in http://your_time_tracker_site/dbinstall.php
11) Test if everything is working.
12) Remove dbinstall.php file from your installation directory.


BLANK PAGES IN ANUKO TIME TRACKER

If you see a blank page in when trying to access Anuko Tie Tracker it may mean many things, among others, such as:

    * MySQL extension for PHP not installed or not working.
    * Time tracker database not created.
    * Access (login / password) to the database is not configured properly in config.php.
    * MySQL service is down. 
    * On UNIX systems - no full access rights for catalog WEB-INF/templates_c/ (chmod 777 templates_c).

You need to thoroughly test each and every component to make sure they work together nicely.



CHANGE LOG

v1.2.40.628 - October 19, 2010
- Finished simplifying the code that deals with entries marked as deleted.

v1.2.39.627 - October 19, 2010
- Simplification of the code continued.

v1.2.39.626 - October 18, 2010
- Started to simplify code that deals with entries marked as deleted.

v1.2.39.624 - October 16, 2010
- Cosmetic code cleanup.

v1.2.39.623 - October 16, 2010
- Improved people_edit.php code so that it removes unnecessary user binds.

v1.2.38.622 - October 16, 2010
- Improved people_add.php code so that it does not insert unnecessary user binds.

v1.2.38.621 - October 16, 2010
- Refactoring of the code related to user to project binds.

v1.2.38.620 - October 16, 2010
- Some code refactoring related to export of team data to file.

v1.2.38.618 - October 15, 2010
- Removed no longer used a_project_id field from the activities table.

v1.2.37.617 - October 15, 2010
- Refactoring: renamed a few variables for consistence.

v1.2.37.616 - October 15, 2010
- Bug fix: Ivoice header discount field is now imported correctly between servers.

v1.2.36.615 - October 14, 2010
- Password storage mechanism changed to md5 hashes to obtain compatibility between servers.

v1.2.35.614 - October 14, 2010
- Bug fix: DB maintenance code will not consider admin account as inactive no matter how old it is.

v1.2.34.613 - October 12, 2010
- DB maintenance code improved.

v1.2.34.612 - October 12, 2010
- Minor bug fixed in 2 queries to obtain totals of billable time.

v1.2.33.611 - October 12, 2010
- Added an index to user_bind table to improve performance.

v1.2.32.610 - October 11, 2010
- Invoice generation slightly optimized.

v1.2.31.609 - October 10, 2010
- Default character set defined as utf8 in mysql.sql.

v1.2.31.604 - October 9, 2010
- "limit 1000" removed in DB maintenance code.

v1.2.31.603 - October 8, 2010
- Comment added to maint_db.sh script.

v1.2.31.602 - October 8, 2010
- A bug in edit profile fixed. DB maintenance code improved.

v1.2.30.601 - October 8, 2010
- A bug in db maintenance code fixed.

v1.2.30.600 - October 7, 2010
- Some preliminary maintenance code added, mostly to clean up the production system from older, inactive teams.

v1.2.29.598 - October 6, 2010
- Fixed a bug with deleting older teams where u_company_id = NULL.

v1.2.28.595 - October 5, 2010
- PEAR:DB module removed from the distribution.

v1.2.27.593 - October 5, 2010
- getConnection2 function removed.

v1.2.27.592 - October 5, 2010
- Finished using getConnection2 function.

v1.2.27.591 - October 5, 2010
- Renaming of getConnection2 to getConnection continued.

v1.2.27.590 - October 5, 2010
- Renaming of getConnection2 to getConnection started.

v1.2.27.589 - October 5, 2010
- pear_mdb2_quote calls replaced with mdb2_quote.

v1.2.26.588 - October 5, 2010
- WEB-INF/lib/TimeHelper.class.php - refactored.

v1.2.26.587 - October 5, 2010
- WEB-INF/lib/SysConfig.class.php - refactored.

v1.2.26.586 - October 5, 2010
- WEB-INF/lib/ReportHelper.class.php - refactored.

v1.2.26.585 - October 4, 2010
- WEB-INF/lib/ProjectHelper.class.php - refactored.

v1.2.26.584 - October 3, 2010
- WEB-INF/lib/ProjectHelper.class.php - partially refactored.

v1.2.26.583 - October 3, 2010
- WEB-INF/lib/ProjectHelper.class.php - partially refactored.

v1.2.26.582 - October 3, 2010
- WEB-INF/lib/ProjectHelper.class.php - partially refactored.

v1.2.26.581 - October 2, 2010
- WEB-INF/lib/ProjectHelper.class.php - partially refactored.

v1.2.26.580 - October 2, 2010
- WEB-INF/lib/InvoiceHelper.class.php refactored.

v1.2.26.579 - October 2, 2010
- WEB-INF/lib/ClientHelper.class.php refactored.

v1.2.26.578 - October 2, 2010
- WEB-INF/lib/ActivityHelper.class.php refactored.

v1.2.26.577 - October 2, 2010
- Process of replacing pear_mdb2_quote with mdb2_quote started.

v1.2.26.576 - October 2, 2010
- pear_db_quote function removed.

v1.2.26.575 - September 30, 2010
- Transition from PEAR::DB to PEAR::MDB2 complete.

v1.2.25.574 - September 28, 2010
- Further refactoring of WEB-INF/lib/UserHelper.class.php.

v1.2.25.573 - September 28, 2010
- Further refactoring of WEB-INF/lib/UserHelper.class.php.

v1.2.25.572 - September 28, 2010
- Further refactoring of WEB-INF/lib/UserHelper.class.php.

v1.2.25.571 - September 27, 2010
- Further refactoring of WEB-INF/lib/UserHelper.class.php. Fixed a bug with UserHelper::deleteAccount.

v1.2.25.570 - September 27, 2010
- Further refactoring of WEB-INF/lib/UserHelper.class.php. 

v1.2.25.569 - September 27, 2010
- Fixed data migration problem when activity binds were not imported. 

v1.2.24.567 - September 26, 2010
- Password recovery bug fixed. 

v1.2.23.562 - September 26, 2010
- A little bit more refactoring. 

v1.2.23.560 - September 25, 2010
- A fix that allows to add users normally. 

v1.2.23.558 - September 25, 2010
- Refactoring of WEB-INF/lib/TimeHelper.class.php completed.

v1.2.23.557 - September 25, 2010
- Further refactoring of WEB-INF/lib/TimeHelper.class.php.

v1.2.23.556 - September 25, 2010
- TimeHelper::delete function refactored.

v1.2.23.555 - September 25, 2010
- Further refactoring of WEB-INF/lib/TimeHelper.class.php.

v1.2.23.554 - September 25, 2010
- WEB-INF/lib/SysConfig.class.php refactored. Started refactoring WEB-INF/lib/TimeHelper.class.php.

v1.2.23.553 - September 24, 2010
- Refactoring of WEB-INF/lib/ReportHelper.class.php completed.

v1.2.23.552 - September 24, 2010
- Refactoring of WEB-INF/lib/ReportHelper.class.php continued.

v1.2.23.551 - September 24, 2010
- Refactoring of WEB-INF/lib/ReportHelper.class.php continued.

v1.2.23.550 - September 24, 2010
- Refactoring of WEB-INF/lib/ReportHelper.class.php started.

v1.2.23.549 - September 24, 2010
- Minor refactoring of WEB-INF/lib/InvoiceHelper.class.php and WEB-INF/lib/ProjectHelper.class.php files.

v1.2.23.548 - September 23, 2010
- WEB-INF/lib/ProjectHelper.class.php refactored.

v1.2.23.547 - September 23, 2010
- Further refactoring, replacing PEAR::DB with PEAR::MDB2 calls.

v1.2.23.546 - September 23, 2010
- Further refactoring, replacing PEAR::DB with PEAR::MDB2 calls.

v1.2.23.545 - September 23, 2010
- Defined default charset as utf-8 in .htaccess. Many web servers have this as windows-1251.
- Added "php_flag magic_quotes_gpc Off" to .htaccess. Many web servers have this on.
- Error reporting changed to E_ALL ^ E_NOTICE.
- Further refactoring, replacing PEAR::DB with PEAR::MDB2 calls.

v1.2.22.544 - September 17, 2010
- Further refactoring of WEB-INF/lib/UserHelper.class.php.
- Added a call to restore MDB2 fetch mode upon exit from WEB-INF/resources/prepare.report_timesheet.php.

v1.2.22.543 - September 17, 2010
- Refactoring started on WEB-INF/lib/UserHelper.class.php.

v1.2.22.542 - September 17, 2010
- WEB-INF/lib/User.class.php refactored (from DB to MDB2 usage).

v1.2.22.541 - September 16, 2010
- WEB-INF/resources/prepare.report_timesheet.php refactored. It may affect reports. Therefore, a minor version change.

v1.2.21.540 - September 16, 2010
- WEB-INF/lib/auth/Auth_db.class.php refactored.

v1.2.21.539 - September 16, 2010
- More refactoring in project_edit.php and send_password.php.

v1.2.21.538 - September 16, 2010
- Minor code refactoring in 4 files.

v1.2.21.537 - September 15, 2010
- A little bit more migration from DB to MDB2 (in initialize.php).

v1.2.21.536 - September 15, 2010
- A little bit more migration from DB to MDB2 (in dbinstall.php).

v1.2.21.535 - September 15, 2010
- Removed no longer needed file convert.php.

v1.2.21.534 - September 15, 2010
- A little bit more migration from DB to MDB2.

v1.2.21.533 - September 14, 2010
- set_include_path fixed for Linux systems in config.php.dist.

v1.2.20.531 - September 14, 2010
- PEAR library updated. Migration from PEAR::DB to PEAR:MDB2 started.

v1.2.19.526 - September 13, 2010
- A problem with entering uncompleted time entries fixed.

v1.2.18.525 - September 11, 2010
- Unneeded al_proof and al_charge fields removed from activity_log table.

v1.2.17.522 - September 11, 2010
- Entering entries with finish time less than start time is prohibited. Code to split such entries
into 2 (one before midnight and another on the next day) is fixed (to an extent).
Comment added to TimeHelper.class.php explaining the problem.

v1.2.16.521 - September 11, 2010
- Trimming added to start, finish, duration, and note values on time entries to allow trimmed entries as legitimate.

v1.2.15.520 - September 4, 2010
- A problem with adding a project fixed.

v1.2.15.518 - September 4, 2010
- Final round of patching from a large contributed patch. Changes are mostly related to DB connect calls.

v1.2.14.517 - September 4, 2010
- Removed delete_svn.bat. This file is no longer needed.

v1.2.14.516 - September 4, 2010
- Patching, refactoring. 4 more files patched with small changes.

v1.2.14.515 - September 3, 2010
- Cosmetic presentation improvement on invoices (removed not needed *** symbols).

v1.2.14.514 - September 3, 2010
- Patching, refactoring. 4 more files patched with small changes.

v1.2.14.513 - September 2, 2010
- Some more patching and refactoring. More functions redeclared as static to eliminate PHP warnings.

v1.2.14.511 - September 2, 2010
- Patch: some class functions redeclared as static to eliminate PHP warnings.

v1.2.14.507 - August 31, 2010
- Integration of mytime.php and mytime_edit.php patches.

v1.2.14.506 - August 30, 2010
- Login.php code slightly changed to improve login efficiency on busy servers with many users.

v1.2.14.505 - August 29, 2010
- Error reporting level defined. Added a function to report missing PHP extensions.

v1.2.13.488 - August 29, 2010
- Started to integrate a patch that improves database connect calls. The point is that we should now see an error in output when connect fails.

v1.2.12.487 - May 20, 2010
- Catalan translation added.

v1.2.12.486 - October 3, 2009
- Readme updated.

v1.2.12.483 - October 3, 2009
- PEAR and its modules integrated into the distribution to simplify installation. The only change is to config.php.dist file to set the include path. PEAR files are taken from pear.php.net.

v1.2.11.453 - July 10, 2009
- Fixed a bug with saving existing time entries as new after changing their date.

v1.2.11.451 - July 10, 2009
- Fixed a critical bug with the billable flag, which was introduced after code refactoring (approx. in v1.2.9.439 - July 2, 2009).

v1.2.10.449 - July 8, 2009
- German translation improved.

v1.2.10.448 - July 8, 2009
- Chinese file replaced with Chinese Simplified translation (used to be Chinese Traditional).
- A separate Chinese Traditional translation file introduced.
- Public holidays corrected in Chinese Traditional translation (to match Taiwan) and both Chinese and Chinese Simplified translations (to match China).

v1.2.10.446 - July 8, 2009
- Brought new labels in compliance with the naming standard.

v1.2.10.445 - July 8, 2009
- Smarty updated to version 2.6.26.

v1.2.10.444 - July 8, 2009
- Fixed the problem with entering time in build 442.

v1.2.10.442 - July 7, 2009
- Refactoring: stripping slashes for magic_quotes_gpc=On and using DB::quoteSmart() for escaping and quoting.

v1.2.9.439 - July 2, 2009
- Code refactored: got rid of long function parameters lists, replaced with assoc arrays.
- Code refactored: merged lib and clib directories.
- Localized "Today" and "Close" in small calendar in reports.
- On the team import page removed the box to select compression. Instead, we now automatically recognize compression type from the file name.

v1.2.8.424 - June 27, 2009
- Minor corrections to localization files.

v1.2.7.423 - June 26, 2009
- Added short description on the login screen.
- Big fix for handling of special characters in passwords on systems with magic quotes in PHP.

v1.2.6.422 - June 25, 2009
- Bug fix: added handling of special characters in passwords. Passwords containing special characters such as ', !, ?, & should now work properly.
- Changed version numbering to another model where the last large number represents SVN version number.

v1.2.5.1 - June 21, 2009
- Logo on top linked to the home page of the project.
- Title of the pages changed to reflect the new name of the product.

v1.2.5 - June 12, 2009
- Links to support website pages changed to reflect changes on the site. 
- Info on support website updated.

Chinese Simplified language translation added.

v1.2.4 - June 9, 2009
- Chinese Simplified language translation added.

v1.2.3.3 - June 4, 2009
- Correction of the Chinese Traditional language translation.

v1.2.3.2 - June 4, 2009
- Code extended to support additional languages. For example, we can now have Chinese Simplified in addition to Chinese Traditional, etc. Older 2-letter language encoding (ISO 639) is now obsolete.
- Chinese Traditional translation file improved.
- Partially translated Slovenian language file added.

v1.2.3.1 - June 3, 2009
- Partially translated Chinese Traditional language file added.
- An error in Polish language file corrected.

v1.2.3 - June 1, 2009
- Browser-default option added to determine presentation language.

v1.2.2.3 - May 29, 2009
- Korean and Japanese translations improved.

v1.2.2.2 - May 29, 2009
- Correction of time duration entries such as 1.999 and 0.999 on "my time" page, which were interpreted incorrectly.

v1.2.2.1 - May 29, 2009
- Corrected handling of large time entries on the "my time" page. Entries like 101, 103 were incorrectly interpreted as 1:01, 1:03, etc.

v1.2.2 - May 28, 2009
- Japanese translation added.
- Public holidays in Korean language file corrected. Minor improvements made to Korean translation.

v1.2.1 - May 27, 2009
- Korean translation added.

v1.2 - May 26, 2009
- Critical error with large TIME values is addressed as per http://www.anuko.com/forum/viewtopic.php?t=723

v1.1.3.2 - May 25, 2009
- Public holidays corrected in all available language files.

v1.1.3.1 - May 23, 2009
- WEB-INF/config.php renamed to WEB-INF/config.php.dist to simplify updates.

v1.1.3.0 - May 23, 2009
- Rounding error fix as per http://www.anuko.com/forum/viewtopic.php?t=720

v1.1.2.2 - May 19, 2009
- libchart updated to solve pie-chart display problems.
- The decimal_to_time function in common.lip.php improved for better handling of decimal time durations.

v1.1.2.1 - April 25, 2009
- Several minor bugs fixed, all related to export / import functionality (some properties were not imported correctly).

v1.1.2 - April 23, 2009
- Extended export / import functionality by including all properties set for teams.

v1.1.1 - April 20, 2009
- Added delete_svn.bat script to source tree to delete unneeded .svn catalogs to keep the size of the archive smaller.

v1.1.0 - April 19, 2009
- Corrected a critical problem with Spanish translation file.

v1.0.9 - April 4, 2009
- Minor improvements associated with adding email field to user records.

v1.0.8 - April 1, 2009
- Translation files improved and organized.

v1.0.7 - March 25, 2009
- email field added to user records.

v1.0.6 - March 25, 2009
- Translation files improved for proper handling of week start day.

v1.0.5 - March 17, 2009
- Week start day is now configurable by admin and team managers.
- Team managers can now remove the world clock flash plugin if they wish to do so.

v1.0.4 - March 11, 2009
- "date string" configuration option removed for simplification. "date format" is now used instead.
- Percentage signs removed from visual representation of date and time format strings to make the formats easier to understand.

v1.0.3 - March 10, 2009
- Anuko Time Tracker Gadget files (for personalized igoogle.com pages) integrated.
- Durations specified as 1.5h, 3.25h (decimal notation with an h in the end) became better supported.

v1.0.2 - March 8, 2009
- Admin and team managers now can select date and time formats.
- Manager and co-managers now can edit their logins from the "people" page.
- Fixed a bug with presentation of generated invoices.

v1.0.0 - March 1, 2009
- Fixed a script error on reports for teams with users without assigned projects.

v0.9.9 - February 24, 2009
- Logo replaced.

v0.9.8 - February 19, 2009
- Bug fix: mail problem with gmail is resolved.
- World clock plugin made optional as per admin settings.

v0.9.7 - February 02, 2009
- Bug fix: user language is now exported properly using team import-export.
- Bug fix: allow users to change their language flag is now exported properly.
- Fug fix: delete team from admin interface now works properly.

v0.9.6 - January 31, 2009
- Team import function modified to work correctly with apostrophes.

v0.9.5
- Manager can now edit his/her own login.
- Added a check to verify password match on password reset form.
- Users who are not assigned to any projects now are not able to see them.
- A bug fixed on assignment people to projects.
- mysql.sql script updated to generate correct database structure (without a need to use dbinstall.php.
- Export-import functionality fixed to work correctly with apostrophes.

v0.9.4
- English and Russian localization files improved to accommodate integration of different authentication modules.

v0.9.3
- Code rearranged to allow for different authentication methods.
- A demo version of LDAP auth module was added. It can authenticate users in Windows Active Directory.

v0.9.2
- Changed database structure update procedure v0.8-v0.9 in dbinstall.php by introducing a default NULL value for user language field (u_lang). This fixes the "unable to create user" problem with current latest MySQL version 5.1.30.
- Czech translation added.

v0.9.1
- Team language setting is moved into team manager's profile.
- Admin can now set up the default language for the entire site.
- Hebrew localization improved.
- Localization files extended to allow for some additional strings to be localized (like some error messages, etc.).
- Minor bugs have been fixed. 

v0.9
- Team language settings are redone.

v0.8.1
- Bi-directional language support.

v0.8
- Minor fixes and code adjustent to accommodate the latest releases of MySQL, PHP, and Apache.

v0.6
- Notes section made larger and the entire UI made more readable.
- Weekly total added onto my time page.
- Week start day can be defined in language localization files.
- New projects are assigned to all people and all activities upon creation.
- Time entry blocking feature is introduced, which protects older entries from modifications.
- Additional languages are integrated into distribution. Localizations now include:
  Dutch, English, French, German, Norwegian, Portuguese, Romanian, Russian, and Spanish.
- WR Time Trackers adapted to use WR Localization Service for new localizations so that adding new localizations becomes easy.
- Billable / not billable flag introduced.
- Donation button added.
- Cookie-based mechanism to remember logins introduced.
- Pie chart added on my time page to show breakdown of activities.

v0.5
- Team data export / import added.
- Public holidays support in calendar via localization files.
- Mapping of activities to projects extended to 1:many.
- Admin interface improved.
- Project filter added on activities page.
- Totals only option for reports.
- Separate rates depending on projects.
- Daily subtotals option for invoices.
- Discount option for invoices.
- Clients page added for working with multiple clients.
- Reports can be saved as favorites and reused. 

v0.4.1
- Support for MySQL 4.1.
- Support for PHP5.
- Minor bug fixes.

v0.4
- Co-managers are implemented. Co-manager has full access to reports and partial access to team management and working on behalf. 
- Passwords are stored as hashes now. Mechanism to reset passwords is redone. 
- config.php has an option whether to allow creation of new teams or not. Default option is OFF. 
- Admin account is added to the system for simple management of teams. 
- Entering times in military time format is extended. For example, 1730 means 5:30 PM, 930 and 0930 mean 9:30 AM. 
- Today link under the calendar is using the now() function instead of a static date. 
- When end time is less than the start time 2 time records are created - on for the start day ending at midnight and another for the following day starting at midnight. 
- Users are allowed to "punch in" only start time. Then, when users log in again, they are given a chance to edit this partially filled time record. 
- On time record editing page we now have a button called "save as new" which allows creating similar records quickly. 

v0.3
- Code reorganized into classes.
- Started to use Smarty templates.
- Support for Unicode.
- Added German, Portuguese, and Norwegian localizations.

v0.2.3
- First attempt to integrate French.
- Changed the Russian resource to reflect days of week in calendar using 3 letters instead of 2.

v0.2.2
- Implemented "on behalf" functionality for managers to edit team members data.

v0.2.1
- Added error_log call in db_connect function to log errors upon unsuccessful connection
to the database.


OBSOLETE BUT MAYBE USEFUL NOTES FROM HERE DOWN BELOW

POSSIBLE REASONS WHY WR TIME TRACKER IS NOT WORKING
- No connection to the database.
- WR Time Tracker was developed and tested for PHP <=5.1.2, MySQL <=4.1, Apache <=1.3.23. Trying with radically different versions above or below may cause problems.
- PHP compiled without session support.

NOTE FOR USERS OF MySQL 4.1 AND ABOVE:
- MySQL v4.1 is supported if you use WR Time Tracker v0.4.1 and later versions.
- If you are migrating your database from earlier MySQL versions you might need to configure your server to support old passwords to allow existing users log on as before.
- If things do not work consider reading this document http://dev.mysql.com/doc/refman/5.0/en/old-client.html


NOTE FOR PHP4 AND PHP5 USERS:
- Both PHP4 and PHP5 versions are supported.


UPGRADE INSTRUCTIONS FROM v0.3
- Backup database and the code on the site.
- Deploy new distribution code.
- Change $dsn value in /WEB-INF/config.php file to reflect your database connection parameters (user name and password).
- For UNIX systems set up full access rights for catalog WEB-INF/templates_c/ (chmod 777 templates_c).
- Launch http://your_time_tracker_site/dbinstall.php utility. Sequentially execute an UPDATE and then CONVERT PASSWORDS operations. Remove /dbinstall.php after use.
- Check whether your site is still working with old passwords, rollback if necessary.


UPGRADE INSTRUCTIONS FROM v0.4 or v0.5
- Backup database and the code on the site.
- Deploy new distribution code.
- Change $dsn value in /WEB-INF/config.php file to reflect your database connection parameters (user name and password).
- For UNIX systems set up full access rights for catalog WEB-INF/templates_c/ (chmod 777 templates_c).
- Launch http://your_time_tracker_site/dbinstall.php utility. Sequentially execute the 
 "Update database structure (v0.4 to v0.5)" and "Update database structure (v0.5 to v0.6)" operations. Remove /dbinstall.php after use.
- Check whether your site is still working, rollback if necessary.


