<?php
/**
 * Created by PhpStorm.
 * User: narendra
 * Date: 12/11/21
 * Time: 12:16 AM
 */

namespace App\Repository;


use App\Repository\appUserRepository\AppUserRepository;

class PushNotificationRepository
{
    /**
     * @var AppUserRepository
     */
    private $appUserRepository;

    public function __construct(AppUserRepository $appUserRepository)
    {

        $this->appUserRepository = $appUserRepository;
    }

    function send_notification_FCM($title) {

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token ='AAAA9Bqc7kc:APA91bHc3KkPvGmejprdKL_7SSqk70LddwFiqpBqA0mCAk4tGR_Vb6ArhwY4SxXD1Nax_PRlywDI4LLtJHVMtrD23cHzcC-dyU3K8I5BFdkL77pZWWDDL_8KZEWcAB2n6Fzx5-SjGQzi';

        $users=$this->appUserRepository->getUsersFCMToken();

        $notification = [
            'title' => $title,
            'sound' => true,
        ];

        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'registration_ids'        => $users, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key='.$token,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

}