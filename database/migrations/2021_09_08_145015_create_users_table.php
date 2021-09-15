<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')
                  ->unique()
                  ->comment("Deixaremos o UUID aqui para refatorar");
            $table->string('name')
                  ->comment("Nome do usuário")
                  ->default('Nome');
            $table->string('email')
                  ->nullable()
                  ->comment("Dados do contatinho");
            $table->string('password', 60);
            $table->timestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
