<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (softwarekashyap@gmail.com)
 * @package Kashyap_Reindex
*/

namespace Kashyap\Reindex\Block\Adminhtml\System\Config\Form\Composer;

use Exception;
use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Data\Form\Element\AbstractElement as AbstractElementAlias;
use Magento\Framework\Filesystem\Directory\ReadFactory;
use Magento\Framework\Phrase;

/**
 * Admin block class for composer version
 */
class Version extends Field
{

    /**
     * @var DeploymentConfig
     */
    protected $deploymentConfig;

    /**
     * @var ComponentRegistrarInterface
     */
    protected $componentRegistrar;

    /**
     * @var ReadFactory
     */
    protected $readFactory;

    /**
     * @param Context $context
     * @param DeploymentConfig $deploymentConfig
     * @param ComponentRegistrarInterface $componentRegistrar
     * @param ReadFactory $readFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        DeploymentConfig $deploymentConfig,
        ComponentRegistrarInterface $componentRegistrar,
        ReadFactory $readFactory,
        array $data = []
    ) {
        $this->deploymentConfig = $deploymentConfig;
        $this->componentRegistrar = $componentRegistrar;
        $this->readFactory = $readFactory;
        parent::__construct($context, $data);
    }

    /**
     * Render button
     *
     * @param AbstractElementAlias $element
     * @return string
     */
    public function render(AbstractElementAlias $element)
    {
        // Remove scope label
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return element html
     *
     * @param AbstractElementAlias $element
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _getElementHtml(AbstractElementAlias $element)
    {
        return 'v' . $this->getVersion();
    }

    /**
     * Get Module version number
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->getComposerVersion($this->getModuleName());
    }

    /**
     * Get module composer version
     *
     * @param $moduleName
     * @return Phrase|string|void
     */
    public function getComposerVersion($moduleName)
    {
        $path = $this->componentRegistrar->getPath(
            ComponentRegistrar::MODULE,
            $moduleName
        );

        try {
            $directoryRead = $this->readFactory->create($path);
            $composerJsonData = $directoryRead->readFile('composer.json');
            if ($composerJsonData) {
                $data = json_decode($composerJsonData);
                if (!empty($data->version)) {
                    return $data->version;
                }
            }
            return __('Unknown');
        } catch (Exception $e) {
            return __('Unknown');
        }
    }
}
