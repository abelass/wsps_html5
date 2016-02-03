<?php
/**
 * Plugin My Chacra - Pack basique
 * (c) 2012 My Chacra
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

// La feuille de style
function wsps_html5_insert_head($flux){
		$flux .= recuperer_fond('inclure/inc-head');
	return $flux;
}

// Modifier l'affichage des menus
function wsps_html5_ajouter_menus($flux){
	include_spip('inc/config');
	include_spip('inc/session');
	$webmestre=session_get('webmestre');
	if($webmestre!='oui'){
		$menus_cache=lire_config('wsps_html5/cacher_menu')?lire_config('wsps_html5/cacher_menu'):array();		


		foreach($flux AS $menu=>$conteu){
			if(in_array($menu,$menus_cache)){
				unset($flux[$menu]);
				}
			}
		}	
	return $flux;
}

// Intervenir sur l'affichage des squelettes
function wsps_html5_recuperer_fond($flux){
	include_spip('inc/config');
	include_spip('inc/session');
	$fond=$flux['args']['fond'];
	$objet=$flux['args']['contexte']['objet'];
	$id_objet=$flux['args']['contexte']['id_objet'];
	$webmestre=session_get('webmestre');
	if($webmestre!='oui'){
		// Cacher le formulaire ajouter document et le portfolio si choisit dans la config
		if($objet=='article' AND $id_objet)$id_rubrique=sql_getfetsel('id_rubrique','spip_articles','id_article='.$id_objet);
		elseif($objet=='rubrique')$id_rubrique=$id_objet;		
		$cacher_documents=lire_config('wsps_html5/cacher_documents')?lire_config('wsps_html5/cacher_documents'):array();
		$rubriques=explode(',',str_replace('rubrique|','',implode(',',$cacher_documents)));
		if(($fond=='prive/objets/editer/colonne_document' OR $fond=='prive/objets/contenu/portfolio_document.html') AND in_array($id_rubrique,$rubriques)){
			 $flux['texte']='';
			}
		}

	//	Cacher le menu rubriques dans la colonne navigation si le menu barre nav est choisit
	if($fond=='inclure/rubriques' AND lire_config('wsps_html5/menu_barre_nav')){	
		 $flux['texte']='';
		}
		//echo $fond;	
	return $flux;
}

