<?php

return [
    'message/add' => ['App\Controller\MessageController', 'addMessage'],
    'message/page/([0-9]+)/sort/([a-z-_]+)' => ['App\Controller\MessageController', 'showMessage'],
    '' => ['App\Controller\MessageController', 'index']
];