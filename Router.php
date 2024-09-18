<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n;

use DI\DependencyException;
use DI\NotFoundException;
use Modules\I18n\Controller\IndexController;

class Router extends \Core\Module\Router {

    use I18nTrait;

    /**
     * @var string
     */
    public string $routerType = "lang";

    /**
     * @var string
     */
    public string $router = "/lang";

    /**
     * @var array|string[][]
     */
    public array $mapForUriBuilder = [
        'change' => [
            'callback' => 'change',
            'pattern' =>'/change/{lang:[a-z]+}',
            'method' => ['GET']
        ]
    ];

    public string $controller = IndexController::class;
}
