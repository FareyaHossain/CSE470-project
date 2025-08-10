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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('posts')->onDelete('cascade');
            $table->string('performance_metric');  // e.g. "Task Completion", "Punctuality"
            $table->integer('score'); // e.g. 1 to 10
            $table->text('comments')->nullable();
            $table->date('date'); 
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
        Schema::dropIfExists('performances');
    }
};
