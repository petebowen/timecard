<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_periods', function (Blueprint $table) {
            $table->uuid('id');
            $table->timestamps();
            $table->text('user_id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->decimal('normal_hours', 3, 2)->default(0);
            $table->decimal('overtime_hours', 3, 2)->default(0);
            $table->decimal('normal_rate', 5, 2)->default(0);
            $table->decimal('overtime_rate', 5, 2)->default(0);
            $table->decimal('gross', 8, 2)->default(0);
            $table->decimal('tax', 8, 2)->default(0);
            $table->decimal('national_insurance', 8, 2)->default(0);
            $table->decimal('net', 8, 2)->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_periods');
    }
}
