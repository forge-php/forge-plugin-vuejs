<?php

namespace Forge\Plugins\VueJs;

use Forge\Composer\Composer;
use Forge\Plugins\Plugin;
use Forge\Plugins\PluginServiceProviderInterface as ServiceProvider;
use Forge\Plugins\VueJs\Commands\InitializeCommand;

class VueJsPlugin extends Plugin
{
    public function __construct(protected Composer $composer) {}

    public static function name(): string
    {
        return 'VueJsPlugin';
    }

    /**
     * @return array<int, string>
     */
    public function commands(): array
    {
        $commands = [
            InitializeCommand::class,
        ];
        return $commands;
    }

    public function boot(ServiceProvider $provider): void
    {
        $commands = $this->commands();
        if (count($commands) > 0) {
            $provider->commands($commands);
        }

        $provider->loadStubsFrom(__DIR__ . '/../stubs', $this->name());
    }
}
