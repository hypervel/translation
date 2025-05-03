<?php

declare(strict_types=1);

namespace Hypervel\Translation;

use Hypervel\Filesystem\Filesystem;
use Hypervel\Foundation\Contracts\Application as ApplicationContract;
use Hypervel\Translation\Contracts\Loader as LoaderContract;
use Psr\Container\ContainerInterface;

class LoaderFactory
{
    public function __invoke(ContainerInterface $container): LoaderContract
    {
        $langPath = $container instanceof ApplicationContract
            ? $container->langPath()
            : BASE_PATH . DIRECTORY_SEPARATOR . 'lang';

        return new FileLoader(
            $container->get(Filesystem::class),
            [
                dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lang',
                $langPath,
            ]
        );
    }
}
