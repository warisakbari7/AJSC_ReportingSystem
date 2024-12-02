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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('affiliated_organization');
            $table->string('position');
            $table->foreignId('province_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('remarks');
            $table->foreignId('meeting_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('participants');
    }
};
