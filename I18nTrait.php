<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n;

use Core\Traits\App;
use DI\DependencyException;
use DI\NotFoundException;
use Modules\I18n\Manager\I18nManager;
use Modules\I18n\Manager\I18nModel;

trait I18nTrait {

    use App;

    /**
     * @return I18nManager|string|null
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getI18nManager(): I18nManager|string|null {
        return $this->getContainer()->get('I18n\Manager');
    }

    /**
     * @return I18nModel|string|null
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getI18nModel(): I18nModel|string|null {
        return $this->getContainer()->get('I18n\Model');
    }

    /**
     * @return Router|null
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getI18nRouter(): ?Router {
        return $this->getContainer()->get('I18n\Router');
    }
}
