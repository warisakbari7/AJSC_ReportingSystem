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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->text('talkingpoints');
            $table->string('trainer');
            $table->string('affiliated_organization');
            $table->string('position');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->foreignId('province_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('address');
            $table->text('outcome');
            $table->foreignId('report_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('meetings');
    }
};
