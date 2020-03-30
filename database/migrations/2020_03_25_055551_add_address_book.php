<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addressbooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('user_id');

            $table->string('name', 500)->nullable();
            $table->string('addressBookId', 100);
            $table->timestamps();

            $table->index('addressBookId');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('addressbook_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('addressbook_id',);

            $table->string('uri', 2096);
            $table->string('username', 1024);
            $table->string('password', 2048);
            $table->string('capabilities', 1024);
            $table->string('syncToken', 1024)->nullable();
            $table->string('localSyncToken', 1024)->nullable();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('addressbook_id')->references('id')->on('addressbooks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addressbook_subscriptions');
        Schema::dropIfExists('addressbooks');
    }
}
