<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n\Plugins;

use DI\DependencyException;
use DI\NotFoundException;
use Modules\View\AbstractPlugin;

class LangInfo extends AbstractPlugin {

    /**
     * @return mixed
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function process(): mixed {
        if (!$this->getSession()->has('lang')){
            $this->getSession()->set('lang', $this->getConfig('lang')['default']);
        }
        return $this->getI18nManager()->getLanguageEntity()::where([
            ['code', '=', $this->getSession()->get('lang')],
            ['active', '=', 1]
        ])->first();
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function getSession(){
        return $this->getContainer()->get('Session\Manager');
    }

    /**
     * @param string $key
     * @return mixed
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function getConfig(string $key): mixed {
        return $this->getContainer()->get('config')->getSetting($key);
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function getI18nManager(){
        return $this->getContainer()->get('I18n\Manager');
    }
    
}
