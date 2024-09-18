<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n\Controller;

use Core\Module\Controller;
use Modules\I18n\I18nTrait;
use DI\DependencyException;
use DI\NotFoundException;
use Slim\Http\ServerRequest as Request;
use Slim\Http\Response;

class IndexController extends Controller {

    use I18nTrait;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function registerFunctions(): void {
        $this->getI18nRouter()->getMapBuilder($this);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function change(Request $request, Response $response): Response {
        $referer = filter_input(INPUT_SERVER, 'HTTP_REFERER');
        $lang = $request->getAttribute('lang');
        $this->getSession()->set('lang', $lang);
        if (is_null($referer)) {
            $referer = $_SERVER['HTTP_REFERER'];
        }
        return $response->withRedirect($referer);
    }
}
