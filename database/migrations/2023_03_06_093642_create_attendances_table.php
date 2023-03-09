<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32);
            $table->bigInteger('phone')->nullable();
            $table->string('uid', 50);
            $table->string('email', 320)->nullable();
            $table->bigInteger('amount')->nullable();
            $table->dateTime('paid_date')->nullable();
            $table->boolean('mail_sent')->default(0);
            $table->boolean('attended')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->unique(['uid']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
