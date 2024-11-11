<?php

namespace Forge\Plugins\VueJs\Commands;

use Forge\Plugins\VueJs\Services\ProjectDetectionService;
use Illuminate\Console\Command;
use function Laravel\Prompts\form;


class InitializeCommand extends Command
{
    protected $signature =  'vue:init';
    protected $description = 'Initialize a VueJs project structure';

    public function __construct(
        protected ProjectDetectionService  $projectDetectionService
    )
    {
        parent::__construct();
    }


    public function handle(): int
    {
        $projectDirectory = $this->projectDetectionService->getVueJsRoot();
        $form = form()
            ->select(
                label: 'Do you want to use a state management library?',
                name: 'state_management',
                options: [
                    'vuex' => 'Vuex',
                    'pinia' => 'Pinia',
                    'none' => 'None'
                ],
                default: 'none'
            )
            ->select(
                label: 'Do you want to use a router?',
                name: 'router',
                options: [
                    'vue-router' => 'Vue Router',
                    'none' => 'None'
                ],
                default: 'none'
            )
            ->confirm(
                label: 'Do you want to use SCSS?',
                name: 'scss'
            )
            ->select(
                label: 'Choose the flavor of VueJs you want to use',
                name: 'flavor',
                options: [
                    'options' => 'Options API',
                    'composition' => 'Composition API'
                ],
            )
            ->submit();

        $dependencies = [];

        if ($form['state_management'] !== 'none') {
            $dependencies[] = $form['state_management'];
        }

        if ($form['router'] !== 'none') {
            $dependencies[] = $form['router'];
        }

        if ($form['scss']) {
            $dependencies[] = 'sass';
        }



        return self::SUCCESS;
    }
}
