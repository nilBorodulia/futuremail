<?php namespace NilBorodulya\FutureMail\Components;

use Cms\Classes\ComponentBase;
use NilBorodulya\FutureMail\Models\Emails;
use NilBorodulya\FutureMail\Models\EmailTemplate;
use Validator;
use Flash;
use ValidationException;
use System\Models\MailTemplate;

class Mails extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Mails Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    
    public function onSaveMail()
    {
        $data = post();
       
        $rules = [
            'date'    => 'required',
            'subject' => 'required',
            'email'   => 'required',
            'body'    => 'required'
        ];
        
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }
        
        $emails = explode(',', trim($data['email']));
        $data['email'] = json_encode($emails);
        
        $this->_doSaveEmail($data);
        
        Flash::success('Jobs done!');
        
        //\Queue::push('\NilBorodulya\FutureMail\Components\Mails@SendEmail', ['message' => 'test'], 'emails');
       return true;
    }
    
    private function _doSaveEmail($data)
    {
        $email = new Emails();
        $email->subject = $data['subject'];
        $email->sendTo = $data['email'];
        $email->body = $data['body'];
        $email->cdate = date('Y-m-d H:i:s');
        $email->template = $data['template'];
        $email->date_send = $data['date'];
        $email->is_send = 0;
        $email->save();
        
        return true;
    }
    
    public function getTemplates()
    {
        return MailTemplate::where('code', 'LIKE', '%future%')->get();
        //return EmailTemplate::orderBy('id', 'desc')->get();
    }
        
    public function SendEmail($job, $data)
    {
        print_r($data);
        exit;
    }
}
