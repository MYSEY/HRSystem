<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('date_of_birth')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('identity_type')->nullable();
            $table->string('identity_number')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('house_no')->nullable();
            $table->string('street_no')->nullable();
            $table->string('phone')->nullable();
            $table->longText('profile')->nullable();
            $table->string('position')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('address')->nullable();
            $table->string('password');
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
