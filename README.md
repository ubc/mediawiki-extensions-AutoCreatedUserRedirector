# mediawiki-extensions-AutoCreatedUserRedirector

When a user login mediawiki via external authentication (e.g. LDAP), a local user account is created automatically.  This extension will listen to account auto-creation event and redirect the user to a specific page.

## Setup

In `LocalSettings.php`, set the variable `$wgAutoCreatedUserRedirect` to the wiki page name (e.g. `Main_Page`).

