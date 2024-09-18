<?php

/**
 * @author Sergey Tevs
 * @email sergey@tevs.org
 */

namespace Modules\I18n\Db;

use DI\DependencyException;
use DI\NotFoundException;
use Illuminate\Database\Schema\Blueprint;
use Modules\Database\Migration;

class Schema extends Migration {

    /**
     * @return void
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function create(): void {
        if (!$this->schema()->hasTable('language')) {
            $this->schema()->create('language', function(Blueprint $table){
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('title');
                $table->string('code');
                $table->string('iso_code');
                $table->integer('active')->default(0);
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
            });
        }

        if (!$this->schema()->hasTable('translate')) {
            $this->schema()->create('translate', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('code');
                $table->text('key');
                $table->text('value');
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
            });
        }
    }

    /**
     * @return void
     */
    public function update(): void {}

    /**
     * @return void
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function delete(): void {
        if ($this->schema()->hasTable('language')) {
            $this->schema()->drop('language');
        }

        if ($this->schema()->hasTable('translate')) {
            $this->schema()->drop('translate');
        }
    }

}
