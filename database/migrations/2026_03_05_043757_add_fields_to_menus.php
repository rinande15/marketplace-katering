<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {

            if (!Schema::hasColumn('menus', 'photo')) {
                $table->string('photo')->nullable();
            }

            if (!Schema::hasColumn('menus', 'description')) {
                $table->text('description')->nullable();
            }

            if (!Schema::hasColumn('menus', 'stock')) {
                $table->integer('stock')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            //
        });
    }
};
