<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package    MetaModels
 * @subpackage FilterText
 * @author     Christian de la Haye <service@delahaye.de>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

/**
 * filter types
 */
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['text']     = 'Text filter';


/**
 * fields
 */
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['textsearch']   = array('Search type', 'Finding text parts.');
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['placeholder']  = array('Placeholder', 'Show this text as long as the field is empty (requires HTML5).');


/**
 * references
 */
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['exact']      = 'exact search';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['beginswith'] = 'begins with search term';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['endswith']   = 'ends with search term';