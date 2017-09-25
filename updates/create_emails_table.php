<?php namespace NilBorodulya\Futuremail\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('nilborodulya_futuremail_emails', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('subject');
            $table->string('sendTo');
            $table->longText('body');
            $table->dateTime('date_send');
            $table->dateTime('cdate');
            $table->string('template');
            $table->unsignedTinyInteger('is_send');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilborodulya_futuremail_emails');
    }
}
