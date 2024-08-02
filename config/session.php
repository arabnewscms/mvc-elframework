<?php
return [
    'session_save_path'=>base_path('storage/sessions'),
    'expiration_timeout'=> 999999999,

    'encryption_mode'=>config('app.cipher'),
    'encryption_key'=>config('app.key'),
    
    'session_driver'=>'file', // file|database 
    'session_prefix'=>'Elframework',
];
