<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n\Plugins;

use DI\DependencyException;
use DI\NotFoundException;
use Modules\View\AbstractPlugin;

class Language extends AbstractPlugin {

    /**
     * @return array
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function process(): array {
        if (!$this->getSession()->has('lang')){
            $this->getSession()->set('lang', $this->getConfig('lang')['default']);
        }
        $data = [];
        $lang_liste = $this->getI18nManager()->getLanguageEntity()::select('code', 'title', 'name')->where('active', '=', 1)->get();

        foreach($lang_liste as $lang){
            if ($lang->code === $this->getSession()->get('lang')) {
                $data['active'] = $lang;
            }
            $data['list'][]=$lang;
        }
        return $data;
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function getSession(){
        return $this->getContainer()->get('Session\Manager');
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function getConfig($key){
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
