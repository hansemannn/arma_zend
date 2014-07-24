<?php

// 0 = ADMIN
// 1 = GUEST
// 2 = MEMBER

return array(
    'book' => array(
        'all' => array('admin', 'member'),
        'index' => array('guest'),
    ),
    'author' => array(
        'all' => array('admin', 'member')
    ),
    'login' => array(
        'all' => array('admin', 'guest', 'member')
    ),
    'home' => array(
        'all' => array('admin', 'guest', 'member')
    ),
    'user' => array(
        'all' => array('admin')
    ),
    'logout' => array(
        'all' => array('admin', 'member')
    ),



   /*'febook' => array(
        'all' => array('admin', 'guest', 'member'),
        'index' => array('guest'),
    ),*/
);
