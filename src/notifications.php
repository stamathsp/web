<?php
function send_push_notification($user_key, $title, $message) {
    $url = 'https://api.simplepush.io/send';
    $data = array(
        'key' => $user_key,
        'title' => $title,
        'msg' => $message
    );

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;
}
