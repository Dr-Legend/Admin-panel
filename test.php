<?php
    $url = "https://fcm.googleapis.com/fcm/send";
    $token = "d2tXRijESPc:APA91bE6Q8wxoRWWMV85abkIvtnZQIRj8TmkemEkCTn0RY785XwGINrjC5lCxuAH3S-Q5v85zpEGKxGM0ZvLt3xQfjUbR7MrpqWYY6f8wDY8kVQJDCexP8ZI1bhoYcijed63O6tB-qHY";
    $serverKey = 'AAAA6ZFD_dg:APA91bHy37F0hs-hRV72DgudlJ05RU4A5WLZMwvDeRM5ILUBcwAI0gcoux99Eto0NWmQady_vtkPWtMlRKbfYD6AwaBj0pTbA_TEw9-motwIV01PA7NcrdclKS1J2ieDLxOxlKfFA2kj';
    $title = "Notification title";
    $body = "Hello I am from Your php server";
    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
	
	
?>