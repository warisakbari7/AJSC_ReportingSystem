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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('video')->nullable();
            $table->string('audio')->nullable();
            $table->string('file')->nullable();
            $table->text('q_first');
            $table->text('q_second');
            $table->text('q_third');
            $table->text('q_fourth');
            $table->text('q_fifth');
            $table->boolean('is_submited')->default(false);
            $table->boolean('is_viewed')->default(false);
            $table->boolean('allow_edit')->default(false);
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
        Schema::dropIfExists('reports');
    }
};
