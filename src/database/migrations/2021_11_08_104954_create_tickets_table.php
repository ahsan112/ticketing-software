<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('ticket_type_id')->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('owner_id')->nullable()->references('id')->on('users');
            $table->foreignId('status_id')->nullable()->references('id')->on('ticket_statuses');
            $table->foreignId('priority_id')->nullable()->references('id')->on('ticket_priorities');
            $table->boolean('accepted')->nullable();
            $table->date('target_date')->nullable();
            $table->boolean('completed')->nullable();
            $table->date('completed_at')->nullable();
            $table->foreignId('created_by_id')->references('id')->on('users');
            $table->foreignId('updated_by_id')->references('id')->on('users');
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
        Schema::dropIfExists('tickets');
    }
}
