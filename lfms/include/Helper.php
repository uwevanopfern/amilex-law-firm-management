<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/19/2019
 * Time: 9:45 AM
 */
class Helper
{
    public function sendSMSAlert($phone, $message)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "8080",
            CURLOPT_URL => "http://rslr.connectbind.com:8080/bulksms/bulksms?username=1212-aime&password=Aime123&type=0&dlr=1&destination=$phone&source=Abayo%20lfms&message=$message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function sendEmailAlert($recipients, $message)
    {
        $headers = "From: LFMS<info@lfmsystem.com>" . "\r\n" .
            $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";

        mail($recipients, 'Alert of next payment ', $message, $headers);
    }
}