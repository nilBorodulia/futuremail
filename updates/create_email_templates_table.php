<?php namespace NilBorodulya\Futuremail\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEmailTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('nilborodulya_futuremail_email_templates', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('caption');
            $table->string('ident');
            $table->longText('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilborodulya_futuremail_email_templates');
    }
}
