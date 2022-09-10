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
        Schema::create('employee_salery_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('emloyee_id') -> comment('employee_id=user_id');
            $table->integer('previous_salery') -> nullable();
            $table->integer('present_salery') -> nullable();
            $table->integer('increment_salery') -> nullable();
            $table->date('effected_salery') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_salery_logs');
    }
};
