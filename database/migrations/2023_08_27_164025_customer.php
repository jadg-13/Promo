<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('customers', function(Blueprint $table){
            $table->id();
            $table->string('email')->unique();
            $table->string('code_mail');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('rol');
            $table->timestamps();
        });

        //Insertar el registro administrador

        //$codigoVerificacion = 
        
        DB::table('customers')->insert([
            'email' => 'jadg1308@gmail.com',
            'code_mail' => mt_rand(100000, 999999),
            'email_verified_at'=>now(),
            'rol' =>'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('customers');
    }
};
