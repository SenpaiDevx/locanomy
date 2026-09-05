<?php

namespace App\Providers;

use Spatie\TypeScriptTransformer\Formatters\PrettierFormatter;
use Spatie\TypeScriptTransformer\Transformers\AttributedClassTransformer;
use Spatie\TypeScriptTransformer\Transformers\EnumTransformer;
use Spatie\TypeScriptTransformer\TypeScriptTransformerConfigFactory;
use Spatie\TypeScriptTransformer\Writers\ModuleWriter;
use Spatie\LaravelTypeScriptTransformer\TypeScriptTransformerApplicationServiceProvider as BaseTypeScriptTransformerServiceProvider;


use Spatie\LaravelTypeScriptTransformer\LaravelTypeScriptTransformerExtension;
class TypeScriptTransformerServiceProvider extends BaseTypeScriptTransformerServiceProvider
{
    protected function configure(TypeScriptTransformerConfigFactory $config): void
    {
        $config
            ->extension(new LaravelTypeScriptTransformerExtension())
            ->transformer(AttributedClassTransformer::class)
            ->transformer(EnumTransformer::class)
            ->transformDirectories(base_path('modules'))
            ->outputDirectory(resource_path('js/Modules'))
            ->writer(new ModuleWriter(path : null, moduleFilename: 'index.d.ts'))
            ->formatter(PrettierFormatter::class);
    }
}