<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_ename');
            $table->string('emp_mname');
            $table->string('emp_fname');
            $table->date('emp_datebirth');
            $table->string('emp_race');
            $table->string('emp_religion');
            $table->string('emp_nationality');
            $table->string('emp_vacancy');
            $table->string('emp_passportno');
            $table->string('emp_driverlicense');

            $table->foreignId('nrcs_id')->constrained('nrcs')->cascadeOnDelete();
            $table->foreignId('nrcs_n')->constrained('nrcs')->cascadeOnDelete();

            $table->string('emp_naing');
            $table->string('emp_number');

            $table->string('emp_gender');
            $table->string('emp_blood');
            $table->string('emp_martial');
            $table->string('emp_hphone');
            $table->string('emp_Mphone');
            $table->string('emp_space');
            $table->string('emp_folder');

            // $table->string('emp_education');
            // $table->date('emp_frome');
            // $table->date('emp_toe');
            // $table->string('emp_school');

            // $table->string('emp_job');
            // $table->string('emp_companyn');
            // $table->date('emp_fromec');
            // $table->date('emp_toc');
            // $table->string('emp_contactc');
            // $table->string('emp_addressc');

            $table->string('emp_folder2');

            $table->string('emp_refname');
            $table->string('emp_refjob');
            $table->string('emp_refemail');
            $table->string('emp_refphone');

            $table->string('emp_familymname');
            $table->string('emp_familymrs');
            $table->date('emp_familydateofbirth');
            $table->string('emp_familyoc');
            $table->string('emp_familycontact');
            $table->string('emp_familyaddress');

            $table->string('emp_temp');

            // $table->string('emp_country');
            // $table->string('emp_state');
            // $table->string('emp_township');
            // $table->string('emp_street');


            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

