<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->bigInteger('parent_1')->nullable();
            $table->bigInteger('parent_2')->nullable();
            $table->bigInteger('parent_3')->nullable();
            $table->bigInteger('parent_4')->nullable();
            $table->bigInteger('parent_5')->nullable();
            $table->bigInteger('parent_6')->nullable();
            $table->bigInteger('parent_7')->nullable();
            $table->bigInteger('parent_8')->nullable();
            $table->bigInteger('referral_id')->nullable();
            $table->string('name')->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status');
            $table->string('active_status');
            $table->string('profile_image');
            $table->string('referral_code');
            $table->string('role_status'); //admin, approved, unapproved
            $table->string('suspend_status'); //suspend, unsuspend
            $table->bigInteger('package_id')->nullable()->unsigned();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade')->onUpdate('cascade');
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
