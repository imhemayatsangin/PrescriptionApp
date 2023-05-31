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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('patient');
            $table->unsignedInteger('age')->nullable();
            $table->enum('sex', ['Male', 'Female', 'Other']);
            $table->date('prescription_date');
            $table->string('diabetone')->nullable();
            $table->string('diabettwo')->nullable();
            $table->string('low_bp')->nullable();
            $table->string('high_bp')->nullable();
            $table->string('urine_output')->nullable();
            $table->string('respiratory')->nullable();
            $table->string('heart_rate')->nullable();
            $table->longText('comment')->nullable();
            $table->longText('instruction')->nullable();
            $table->decimal('temperature', $precision = 8, $scale = 2)->nullable();
            $table->decimal('bmi', $precision = 8, $scale = 2)->nullable();
            $table->decimal('height', $precision = 8, $scale = 2)->nullable();
            $table->decimal('weight', $precision = 8, $scale = 2)->nullable();
            $table->string('clinical_record', 300)->nullable()->nullable();
            $table->foreignId('user_id')->index()->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
};
