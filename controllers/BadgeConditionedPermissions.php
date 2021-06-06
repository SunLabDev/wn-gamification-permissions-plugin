<?php namespace SunLab\GamificationPermissions\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use System\Classes\SettingsManager;

/**
 * Badge Conditioned Permissions Back-end Controller
 */
class BadgeConditionedPermissions extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();


        BackendMenu::setContext('Winter.System', 'system', 'settings');
        SettingsManager::setContext('SunLab.GamificationPermissions', 'bcp');
    }
}
