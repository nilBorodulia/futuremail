<?php namespace NilBorodulya\FutureMail;

use Backend;
use System\Classes\PluginBase;
use NilBorodulya\FutureMail\Models\Emails;
use NilBorodulya\FutureMail\Models\EmailTemplate;
use System\Models\MailTemplate;
use Mail;
/**
 * futureMail Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'futureMail',
            'description' => 'No description provided yet...',
            'author'      => 'nilBorodulya',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
    
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'NilBorodulya\FutureMail\Components\Mails' => 'capsuleMails',
            'NilBorodulya\FutureMail\Components\MailTemplates' => 'templateMail',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'nilborodulya.futuremail.some_permission' => [
                'tab' => 'futureMail',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'futuremail' => [
                'label'       => 'Email Templates',
                'url'         => Backend::url('nilborodulya/futuremail/emailtemplates'),
                'icon'        => 'icon-leaf',
                'permissions' => ['nilborodulya.futuremail.*'],
                'order'       => 500,
            ],
        ];
    }
    
    public function registerSchedule($schedule)
    {   
        
        $schedule->command('emails:send')->withoutOverlapping();
        $schedule->call(function () {
            
            $emailsData = Emails::where('date_send', '<=', date('Y-m-d H:i:s'))->where('is_send', 0)->get();
            
            foreach ($emailsData as $item) {
                $data = [
                    'subject' => $item->subject, 
                    'body'    => nl2br($item->body)
                ];
                Mail::send($item->template, $data, function($message) use ($item) {
                    $emailList = json_decode($item->sendTo, true);
                    $message->to($emailList);
                    $message->subject($item->subject);
                });
                
                $item->is_send = 1;
                $item->save();
            }
        })->everyMinute();
    }

}
