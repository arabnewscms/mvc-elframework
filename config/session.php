<?php 
return [
    'session_save_path'=>base_path('storage/sessions'),
    'expiration_timeout'=> 86400,

    'encryption_mode'=>'AES-128-CBC',
    'encryption_key'=>'phpanonymous',
];