<?php

// 0 = ADMIN
// 1 = GUEST
// 2 = MEMBER

return array(
    'book' => array(
        'all' => array(0, 2),
        'index' => array(1),
    ),
    'author' => array(
        'all' => array(0, 2)
    ),
    'login' => array(
        'all' => array(0, 1, 2)
    ),
    'home' => array(
        'all' => array(0, 1, 2)
    ),
    'user' => array(
        'all' => array(0)
    ),
    

   /*'febook' => array(
        'all' => array('admin', 'guest', 'member'),
        'index' => array('guest'),
    ),*/
);