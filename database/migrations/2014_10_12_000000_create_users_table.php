<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->uuid('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('admin')->default(0);
            $table->string('utr', 100);
            $table->string('tax_code', 20);
            $table->decimal('normal_rate', 5, 2)->default(0);
            $table->decimal('overtime_rate', 5, 2)->default(0);
            $table->decimal('contracted_hours', 5, 2)->default(0);
            $table->decimal('total_hours', 11, 2)->default(0);
            $table->decimal('total_pay', 11, 2)->default(0);

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
