<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CmsBlockWidget;

use Spryker\Yves\CmsContentWidget\Plugin\CmsTwigContentRendererPluginInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerShop\Yves\CmsBlockWidget\Dependency\Client\CmsBlockWidgetToCmsBlockStorageClientInterface;
use SprykerShop\Yves\CmsBlockWidget\Dependency\Client\CmsBlockWidgetToStoreClientInterface;
use SprykerShop\Yves\CmsBlockWidget\Validator\CmsBlockValidator;
use SprykerShop\Yves\CmsBlockWidget\Validator\CmsBlockValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CmsBlockWidgetFactory extends AbstractFactory
{
    public function createCmsBlockValidator(): CmsBlockValidatorInterface
    {
        return new CmsBlockValidator();
    }

    public function getStoreClient(): CmsBlockWidgetToStoreClientInterface
    {
        return $this->getProvidedDependency(CmsBlockWidgetDependencyProvider::CLIENT_STORE);
    }

    /**
     * @return array<\Spryker\Shared\Twig\TwigExtensionInterface>
     */
    public function getTwigExtensionPlugins(): array
    {
        return $this->getProvidedDependency(CmsBlockWidgetDependencyProvider::TWIG_EXTENSION_PLUGINS);
    }

    public function getCmsBlockStorageClient(): CmsBlockWidgetToCmsBlockStorageClientInterface
    {
        return $this->getProvidedDependency(CmsBlockWidgetDependencyProvider::CLIENT_CMS_BLOCK_STORAGE);
    }

    public function getCmsTwigContentRendererPlugin(): CmsTwigContentRendererPluginInterface
    {
        return $this->getProvidedDependency(CmsBlockWidgetDependencyProvider::CMS_TWIG_CONTENT_RENDERER_PLUGIN);
    }

    public function getTranslatorService(): TranslatorInterface
    {
        return $this->getProvidedDependency(CmsBlockWidgetDependencyProvider::SERVICE_TRANSLATOR);
    }
}
