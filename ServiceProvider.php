<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n;

use Core\Module\Provider;
use DI\DependencyException;
use DI\NotFoundException;
use Modules\Database\MigrationCollection;
use Modules\I18n\Db\Schema;
use Modules\I18n\Manager\I18nManager;
use Modules\I18n\Manager\I18nModel;
use Modules\View\PluginManager;
use Modules\View\ViewManager;

class ServiceProvider extends Provider {

    private string $router = "I18n\Router";

    /**
     * @var array|string[]
     */
    protected array $plugins = [
        'L' => '\Modules\I18n\Plugins\Translate',
        'getLanguage'=>'\Modules\I18n\Plugins\Language',
        'getLangInfo'=>'\Modules\I18n\Plugins\LangInfo'
    ];

    /**
     * @return void
     */
    public function init(): void {
        $container = $this->getContainer();
        if (!$container->has('I18n\Manager')) {
            $container->set('I18n\Manager', function (){
                $manager = new I18nManager($this);
                $manager->initEntity();
                return $manager;
            });
        }

        if (!$container->has('I18n\Model')){
            $container->set('I18n\Model', function () {
                return new I18nModel($this);
            });
        }


        if (!$container->has($this->router)){
            $container->set($this->router, function(){
                return new Router($this);
            });
        }
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function afterInit(): void {
        $container = $this->getContainer();

        if ($container->has('Modules\Database\ServiceProvider::Migration::Collection')) {
            /* @var $databaseMigration MigrationCollection  */
            $container->get('Modules\Database\ServiceProvider::Migration::Collection')->add(new Schema($this));
        }

        if ($container->has('ViewManager::View')){
            /** @var $viewer ViewManager */
            $viewer = $container->get('ViewManager::View');
            $plugins = function(){
                $pluginManager = new PluginManager();
                $pluginManager->addPlugins($this->plugins);
                return $pluginManager->getPlugins();
            };
            $viewer->setPlugins($plugins());
        }
    }

    /**
     * @return void
     */
    public function boot(): void {
        $container = $this->getContainer();
        $container->set('Modules\I18n\Controller\IndexController', function(){
            return new Controller\IndexController($this);
        });
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function register(): void {
        $container = $this->getContainer();
        if ($container->has($this->router)){
            $container->get($this->router)->init();
        }
    }


}
