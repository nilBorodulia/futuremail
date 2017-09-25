<?php namespace NilBorodulya\Futuremail\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Email Templates Back-end Controller
 */
class EmailTemplates extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('NilBorodulya.Futuremail', 'futuremail', 'emailtemplates');
    }
}
