<?php

/**
 * This file is part of MetaModels/filter_text.
 *
 * (c) 2012-2016 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage FilterText
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Christian de la Haye <service@delahaye.de>
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @author     David Molineus <mail@netzmacht.de>
 * @author     David Maack <david.maack@arcor.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Christopher Boelter <christopher@boelter.eu>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2016 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_text/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\Filter\Setting;

use MetaModels\Filter\IFilter;
use MetaModels\Filter\Rules\SearchAttribute;
use MetaModels\Filter\Rules\StaticIdList;
use MetaModels\FrontendIntegration\FrontendFilterOptions;

/**
 * Filter "text field" for FE-filtering, based on filters by the MetaModels team.
 */
class Text extends SimpleLookup
{
    /**
     * Overrides the parent implementation to always return true, as this setting is always optional.
     *
     * @return bool true if all matches shall be returned, false otherwise.
     */
    public function allowEmpty()
    {
        return true;
    }

    /**
     * Overrides the parent implementation to always return true, as this setting is always available for FE filtering.
     *
     * @return bool true as this setting is always available.
     */
    public function enableFEFilterWidget()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function prepareRules(IFilter $objFilter, $arrFilterUrl)
    {
        $objMetaModel  = $this->getMetaModel();
        $objAttribute  = $objMetaModel->getAttributeById($this->get('attr_id'));
        $strParamName  = $this->getParamName();
        $strParamValue = $arrFilterUrl[$strParamName];
        $strTextsearch = $this->get('textsearch');

        // React on wildcard, overriding the search type.
        if (strpos($strParamValue, '*') !== false) {
            $strTextsearch = 'exact';
        }

        // Type of search.
        switch ($strTextsearch) {
            case 'beginswith':
                $strWhat = $strParamValue . '%';
                break;
            case 'endswith':
                $strWhat = '%' . $strParamValue;
                break;
            case 'exact':
                $strWhat = $strParamValue;
                break;
            default:
                $strWhat = '%' . $strParamValue . '%';
                break;
        }

        if ($objAttribute && $strParamName && $strParamValue) {
            $objFilter->addFilterRule(new SearchAttribute($objAttribute, $strWhat));
            return;
        }

        $objFilter->addFilterRule(new StaticIdList(null));
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterFilterWidgets(
        $arrIds,
        $arrFilterUrl,
        $arrJumpTo,
        FrontendFilterOptions $objFrontendFilterOptions
    ) {
        // If defined as static, return nothing as not to be manipulated via editors.
        if (!$this->enableFEFilterWidget()) {
            return array();
        }

        if (!($attribute = $this->getFilteredAttribute())) {
            return array();
        }

        $arrReturn = array();
        $this->addFilterParam($this->getParamName());

        // Text search.
        $arrCount  = array();
        $arrWidget = array(
            'label'     => array(
                $this->getLabel(),
                'GET: ' . $this->getParamName()
            ),
            'inputType' => 'text',
            'count'     => $arrCount,
            'showCount' => $objFrontendFilterOptions->isShowCountValues(),
            'eval'      => array(
                'colname'     => $attribute->getColname(),
                'urlparam'    => $this->getParamName(),
                'template'    => $this->get('template'),
                'placeholder' => $this->get('placeholder'),
            )
        );

        // Add filter.
        $arrReturn[$this->getParamName()] =
            $this->prepareFrontendFilterWidget($arrWidget, $arrFilterUrl, $arrJumpTo, $objFrontendFilterOptions);

        return $arrReturn;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterDCA()
    {
        return array();
    }

    /**
     * Add Param to global filter params array.
     *
     * @param string $strParam Name of filter param.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    private function addFilterParam($strParam)
    {
        $GLOBALS['MM_FILTER_PARAMS'][] = $strParam;
    }
}
