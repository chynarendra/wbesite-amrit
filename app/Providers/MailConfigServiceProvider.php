<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $mail_setting = systemSetting();
//        if ($mail_setting) {
//            $config = array(
//                'driver'     => $mail_setting->mail_driver,
//                'host'       => $mail_setting->mail_host_name,
//                'port'       => $mail_setting->mail_port,
//                'username'   => $mail_setting->mail_user_name,
//                'password'   => $mail_setting->mail_password,
//                'encryption' => $mail_setting->mail_encryption,
//                'from'       => array('address' => $mail_setting->mail_from_address, 'name' => $mail_setting->app_name),
//                'sendmail'   => '/usr/sbin/sendmail -bs',
//                'pretend'    => false,
//            );
//
//            Config::set('mail', $config);
//        }
    }
}
