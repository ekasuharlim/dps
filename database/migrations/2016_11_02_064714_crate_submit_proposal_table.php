<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateSubmitProposalTable extends Migration
{
    public function up()
    {
        Schema::create('submit_proposal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origanisation_name',200);
			$table->string('contact_title',10);
			$table->string('contact_name',200);
			$table->string('contact_email',100);
			$table->string('theme',300);
			$table->string('file_name',100);			
			$table->string('ip_addr',50);						
            $table->timestamps();
        });
	}

    public function down()
    {
		Schema::drop("submit_proposal");		
    }
}
