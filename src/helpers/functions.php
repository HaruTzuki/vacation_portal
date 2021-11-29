<?php

use VacationPortal\Data\Model\Communication\NotificationHeader;
use VacationPortal\Helpers\Enumerations\NotificationAction;

/**
     * Hashing a plain text to Sha512 Algorithm.
     * @param string $plainText: Not hashed password.
     * @return string Returing the hashed text.
     */
    function hashPassword(string $plainText) : string{
        return hash("sha512", SALT . $plainText . SALT);
    }

    /**
     * Compare non-hashed password with one hashed pasword.
     * @param string $plainText: Not hashed password.
     * @param string $hashedText: Hashed text password.
     * @return bool Returning the result of comparisson.
     */
    function comparePasswords(string $plainText, string $hashedText) : bool{
        $hashed = hashPassword($plainText);
        
        return $hashed == $hashedText;
    }

    function getHeader(){
        include_once APP_SITE . "/shared/header.php";
    }

    function getSidebar(){
        include_once APP_SITE . "/shared/sidebar.php";
    }

    function getScripts(){
        include_once APP_SITE . "/shared/scripts.php";
    }

    function getStyles(){
        include_once APP_SITE . "/shared/styles.php";
    }

    function getModals(){
        include_once APP_SITE . "/shared/modals.php";
    }

    function getFooter(){
        include_once APP_SITE . "/shared/footer.php";
    }

    function view(string $view){
        include_once APP_SITE . '/views/' . $view . '.php';
    }