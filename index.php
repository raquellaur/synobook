<?php

require_once __DIR__ . '/src/design/templates/layouts/header.phtml';

ini_set('display_errors', true);

require __DIR__ . '/vendor/autoload.php';

\App\System\Bootloader::getInstance()->run();

require_once __DIR__ . '/src/design/templates/layouts/footer.phtml';
