<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSenderIbanToTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction', function (Blueprint $table) {
            $table->foreign('receiver_iban')->reference('iban')->on('ewallet')->onDelete('cascade');
            $table->foreign('sender_iban')->reference('iban')->on('ewallet')->onDelete('cascade');
            $table->dropColumn('sender_name');
            $table->dropColumn('receiver_name');

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction', function (Blueprint $table) {
            $table->string('receiver_name');
            $table->string('sender_name');
            //
        });
    }
}
