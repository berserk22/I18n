<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n\Manager;

use DI\DependencyException;
use DI\NotFoundException;
use Modules\I18n\I18nTrait;

class I18nModel {

    use I18nTrait;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getSession(){
        return $this->getContainer()->get('Session\Manager');
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function translate(string $str, ...$params): string {
        if (!$this->getSession()->has('lang')) {
            $lang = "de";
        }
        else {
            $lang = $this->getSession()->get('lang');
        }
        $translate = $this->getI18nManager()->getTranslateEntity()::where([
            ['code', '=', $lang],
            ['key', '=', $str]
        ])->first();
        if ($translate!==null){
            $str = $translate->value;
        }
        if (!empty($params)){
            $str = sprintf($str, $params);
        }
        return $str;
    }
}
