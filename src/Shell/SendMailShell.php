<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Shell;
use Cake\Mailer\Email;
use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

class SendMailShell extends Shell {
    
    public function initialize() {
        parent::initialize();
        date_default_timezone_set('Asia/Tokyo');
    }

    public function main() {
        $today = date("Y-m-d H:i");
        $schedules = TableRegistry::get("Schedules")
                ->find('all' ,['contain' => ['Users']])
                ->toArray();

        foreach ($schedules as $schedule):
            if (strtotime($today) === strtotime($schedule->notification_date)) {
                $email = new Email('default');
                $email  ->attachments(WWW_ROOT.$schedule->image_pass);
                $email  ->from(['pee.llgm@gmail.com' => 'Andow'])
                        ->to($schedule->user->email)
                        ->subject("講義名:".$schedule->lecture)
                        ->send("講義メモ:".$schedule->memo."\n課題のレビューにご協力いただける場合は下記リンクをクリックし、必要事項をご記入ください。\nhttp://157.80.139.88/Andow/taskreviews/add");

            }
        endforeach;   
    }
}

