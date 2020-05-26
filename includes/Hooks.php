<?php

namespace MediaWiki\Extension\AutoCreatedUserRedirector;

use User;

class Hooks {
    const SESSION_KEY = 'AUTO_CREATED_NEW_USER_CREATED';

    /**
     * Remember if a new user is autocreated
     *
     * @param User $user
     * @param bool $autocreated
     */
    public static function onLocalUserCreated( $user, $autocreated ) {
        if ( $autocreated ) {
            $_SESSION[static::SESSION_KEY] = $user->getId();
        }
    }

    /**
     * While being redirected after login, see if we want to redirect to specific page for new users.
     *
     * @param string &$returnTo page name to redirect to
     * @param array &$returnToQuery key value pairs of url parameters
     * @param string &$type login redirect condition
     * @return true
     */
    public static function onPostLoginRedirect( &$returnTo, &$returnToQuery, &$type ) {
        if ( $type == 'successredirect' ) {
            global $wgUser;

            if ( isset( $_SESSION[static::SESSION_KEY] ) && $_SESSION[static::SESSION_KEY] === $wgUser->getId()) {
                unset($_SESSION[static::SESSION_KEY]);
                if ( isset( $GLOBALS['wgAutoCreatedUserRedirect'] ) ) {
                    $returnTo = $GLOBALS['wgAutoCreatedUserRedirect'];                    
                }
            }
        }

        return true;
    }
}