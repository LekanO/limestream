<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('user_id');
            $table->integer('comment_id');
            $table->string('title');
            $table->text('src');
	        $table->string('type');
            $table->timestamps();
        });
    }

      /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      	Schema::drop('videos');
    }
}
