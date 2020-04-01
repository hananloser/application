<?php

function check_already_login()
{
    $ci = &get_instance(); //mendaptkan instansiasi data/objek
    $user_session = $ci->session->userdata('userid'); //cek bila ada session tercetak
    if ($user_session) {
        redirect('dashboard');
    }
}
function check_not_login()
{
    $ci = &get_instance(); //mendaptkan instansiasi data/objek
    $user_session = $ci->session->userdata('userid'); //cek bila ada session tercetak
    if (!$user_session) {
        redirect('auth/login');
    }
}



