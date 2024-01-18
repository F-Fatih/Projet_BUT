<?php


/**
 * Fonction échappant les caractères html dans $message
 * @param string $message chaîne à échapper
 * @return string chaîne échappée
 */
function e($message)
{
    if ($message !== null) {
        return htmlspecialchars($message, ENT_QUOTES);
    } else {
        return '';
    }
}
