<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n\Manager;

use Core\Traits\App;
use DI\DependencyException;
use DI\NotFoundException;
use Modules\I18n\Db\Models\Language;
use Modules\I18n\Db\Models\Translate;

class I18nManager {

    use App;

    /**
     * @var string
     */
    private string $language = "I18n\Language";

    /**
     * @var string
     */
    private string $translate = "I18n\Translate";

    /**
     * @return $this
     */
    public function initEntity(): static {
        if (!$this->getContainer()->has($this->language)){
            $this->getContainer()->set($this->language, function(){
                return 'Modules\I18n\Db\Models\Language';
            });
        }

        if (!$this->getContainer()->has($this->translate)){
            $this->getContainer()->set($this->translate, function(){
                return 'Modules\I18n\Db\Models\Translate';
            });
        }
        return $this;
    }

    /**
     * @return Language|mixed
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getLanguageEntity(): mixed {
        return $this->getContainer()->get($this->language);
    }

    /**
     * @return Translate|mixed
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getTranslateEntity(): mixed {
        return $this->getContainer()->get($this->translate);
    }

}
