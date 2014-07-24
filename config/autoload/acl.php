<?php

// 0 = ADMIN
// 1 = GUEST
// 2 = MEMBER

return array(
    'book' => array(
        'all' => array('admin', 'user'),
        'index' => array('guest'),
    ),
    'author' => array(
        'all' => array('admin', 'member')
    ),
    'login' => array(
        'all' => array('admin', 'guest', 'user')
    ),
    'home' => array(
        'all' => array('admin', 'guest', 'user')
    ),
    'user' => array(
        'all' => array('admin')
    ),
    'logout' => array(
        'all' => array('admin', 'user')
    ),

    

   /*'febook' => array(
        'all' => array('admin', 'guest', 'member'),
        'index' => array('guest'),
    ),*/
);