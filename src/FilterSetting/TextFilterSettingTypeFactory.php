<?php

/**
 * This file is part of MetaModels/filter_text.
 *
 * (c) 2012-2025 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels/filter_text
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Christopher Boelter <christopher@boelter.eu>
 * @author     Marc Reimann <reimann@mediendepot-ruhr.de>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2025 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_text/blob/master/LICENSE LGPL-3.0-or-later
 * @filesource
 */

namespace MetaModels\FilterTextBundle\FilterSetting;

use MetaModels\Filter\FilterUrlBuilder;
use MetaModels\Filter\Setting\AbstractFilterSettingTypeFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Attribute type factory for text filter settings.
 */
class TextFilterSettingTypeFactory extends AbstractFilterSettingTypeFactory
{
    /**
     * The event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * The filter URL builder.
     *
     * @var FilterUrlBuilder
     */
    private $filterUrlBuilder;

    /**
     * {@inheritDoc}
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        FilterUrlBuilder $filterUrlBuilder,
        private readonly TranslatorInterface $translator
    ) {
        parent::__construct();

        $this
            ->setTypeName('text')
            ->setTypeIcon('bundles/metamodelsfiltertext/filter_text.png')
            ->setTypeClass(Text::class)
            ->allowAttributeTypes(
                'longtext',
                'text',
                'translatedtext',
                'translatedlongtext',
                'combinedvalues',
                'translatedcombinedvalues'
            );

        $this->dispatcher       = $dispatcher;
        $this->filterUrlBuilder = $filterUrlBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function createInstance($information, $filterSettings)
    {
        return new Text($filterSettings, $information, $this->dispatcher, $this->filterUrlBuilder, $this->translator);
    }
}
