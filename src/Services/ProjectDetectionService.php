<?php

namespace Forge\Plugins\VueJs\Services;

use Forge\Composer\Composer;

class ProjectDetectionService {
    public function __construct(
        protected Composer $composer,
    ){}

    public function getVueJsRoot(): string
    {
        if (!$this->composer->isComposerProject()) {
            return sprintf('%s/src/js', getcwd());
        }
        if ($this->composer->has('laravel/framework')) {
            return sprintf('%s/resources/js', getcwd());
        }

        if ($this->composer->has('pimcore/pimcore')) {
            return sprintf('%s/assets/js/', getcwd());
        }

        return sprintf('%s/src/', getcwd());
    }
}
