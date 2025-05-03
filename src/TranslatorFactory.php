<?php

declare(strict_types=1);

namespace Hypervel\Translation;

use Hyperf\Contract\ConfigInterface;
use Hypervel\Translation\Contracts\Loader as LoaderContract;
use Hypervel\Translation\Contracts\Translator as TranslatorContract;
use Psr\Container\ContainerInterface;

class TranslatorFactory
{
    public function __invoke(ContainerInterface $container): TranslatorContract
    {
        $config = $container->get(ConfigInterface::class);

        // When registering the translator component, we'll need to set the default
        // locale as well as the fallback locale. So, we'll grab the application
        // configuration so we can easily get both of these values from there.
        $trans = new Translator(
            $container->get(LoaderContract::class),
            $config->get('app.locale', 'en')
        );

        $trans->setFallback($config->get('app.fallback_locale', 'en'));

        return $trans;
    }
}
