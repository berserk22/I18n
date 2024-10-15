<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n\Plugins;

use DI\DependencyException;
use DI\NotFoundException;
use Modules\I18n\I18nTrait;
use Modules\View\AbstractPlugin;

class Translate extends AbstractPlugin {

    use I18nTrait;

    /**
     * @param string|null $str
     * @param string $params
     * @return string|null
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function process(string|null $str, string &$params=''): string|null {
        if (!empty($str)) {
            return $this->getI18nModel()->translate($str, $params);
        }
        return $str;
    }

}
