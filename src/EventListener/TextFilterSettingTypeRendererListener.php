<?php

/**
 * This file is part of MetaModels/filter_text.
 *
 * (c) 2012-2019 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels/filter_text
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  2012-2019 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_text/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\FilterTextBundle\EventListener;

use ContaoCommunityAlliance\DcGeneral\Data\ModelInterface;
use ContaoCommunityAlliance\DcGeneral\EnvironmentInterface;
use MetaModels\CoreBundle\EventListener\DcGeneral\Table\FilterSetting\AbstractFilterSettingTypeRenderer;

/**
 * Handles rendering of model from tl_metamodel_filtersetting.
 */
class TextFilterSettingTypeRendererListener extends AbstractFilterSettingTypeRenderer
{
    /**
     * {@inheritdoc}
     */
    protected function getTypes()
    {
        return ['text'];
    }

    /**
     * {@inheritdoc}
     */
    protected function getLabelParameters(EnvironmentInterface $environment, ModelInterface $model)
    {
        return $this->getLabelParametersWithAttributeAndUrlParam($environment, $model);
    }
}
