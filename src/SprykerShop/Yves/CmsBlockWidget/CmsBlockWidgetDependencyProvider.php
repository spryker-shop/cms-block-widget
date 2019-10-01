<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CmsBlockWidget;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CmsBlockWidget\Dependency\Client\CmsBlockWidgetToCmsBlockStorageClientBridge;
use SprykerShop\Yves\CmsBlockWidget\Dependency\Client\CmsBlockWidgetToStoreClientBridge;

class CmsBlockWidgetDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @deprecated Use `static::TWIG_EXTENSION_PLUGINS` instead.
     */
    public const TWIG_FUNCTION_PLUGINS = 'TWIG_FUNCTION_PLUGINS';

    public const TWIG_EXTENSION_PLUGINS = 'TWIG_EXTENSION_PLUGINS';
    public const CLIENT_CMS_BLOCK_STORAGE = 'CLIENT_CMS_BLOCK_STORAGE';
    public const CLIENT_STORE = 'CLIENT_STORE';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addTwigFunctionPlugins($container);
        $container = $this->addTwigExtensionPlugins($container);
        $container = $this->addCmsBlockStorageClient($container);
        $container = $this->addStoreClient($container);

        return $container;
    }

    /**
     * @deprecated Use `addTwigExtensionPlugins` instead.
     *
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addTwigFunctionPlugins(Container $container)
    {
        $container[static::TWIG_FUNCTION_PLUGINS] = function () {
            return $this->getTwigFunctionPlugins();
        };

        return $container;
    }

    /**
     * @deprecatd Use `getTwigExtensionPlugins` instead.
     *
     * @return \Spryker\Yves\Twig\Plugin\TwigFunctionPluginInterface[]
     */
    protected function getTwigFunctionPlugins()
    {
        return [];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addTwigExtensionPlugins(Container $container): Container
    {
        $container->set(static::TWIG_EXTENSION_PLUGINS, function () {
            return $this->getTwigExtensionPlugins();
        });

        return $container;
    }

    /**
     * @return \Spryker\Shared\Twig\TwigExtensionInterface[]
     */
    protected function getTwigExtensionPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCmsBlockStorageClient(Container $container)
    {
        $container[static::CLIENT_CMS_BLOCK_STORAGE] = function (Container $container) {
            return new CmsBlockWidgetToCmsBlockStorageClientBridge($container->getLocator()->cmsBlockStorage()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStoreClient(Container $container): Container
    {
        $container->set(static::CLIENT_STORE, function (Container $container) {
            return new CmsBlockWidgetToStoreClientBridge($container->getLocator()->store()->client());
        });

        return $container;
    }
}
