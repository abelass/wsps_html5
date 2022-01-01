<?php
/**
 * Plugin Web Simple - Pack basique
 * (c) 2012 - 2022 Web Simple
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/*
 * Un fichier d'autorisations permet de regrouper
 * les fonctions d'autorisations de votre plugin
 */

// declaration vide pour ce pipeline.
function wsps_html5_autoriser(){}



function autoriser_configurer_wsps_html5_dist($faire, $type, $id, $qui, $opt) {

	return autoriser('webmestre', $type, $id, $qui, $opt); // seulement les webmestres

}

?>
