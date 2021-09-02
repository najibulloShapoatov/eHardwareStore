<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Feedback extends Model
{
    public function sandFeedback($input)
    {
        $name = trim(htmlspecialchars($input['name']));
        $email = trim(htmlspecialchars($input['email']));
        $messageText = trim(htmlspecialchars($input['message']));

        if(empty($name) || strlen($name) < 4){
            $error = ['error_code' => 1, 'msg' => 'Введите имя'];
            return $error;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = ['error_code' => 1, 'msg' => 'Введите эл. почту.'];
            return $error;
        }

        if(empty($messageText) || strlen($messageText) < 15){
            $error = ['error_code' => 1, 'msg' => 'Введите текст сообщения, содержащее больше 15 символов'];
            return $error;
        }

        // sand to email
        $subject = 'Форма обратной связи';
        $to_name = $name;
        //$to_email = 'info@azimistroy.tj';
        $to_email = 'info@gravity.tj';

        Mail::send('mail.feedback', compact(['messageText']), function($message) use ($subject, $to_name, $to_email) {
            $message->to($to_email, $to_name)->subject($subject);
            $message->from('azimistroy@gmail.com','Обратная связь');
        });

        return ['error_code' => 0, 'msg' => 'Спасибо! Ваш запрос успешно отправлен. В ближайшее время наш менеджер свяжется с вами!'];

    }
}
