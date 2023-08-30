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
        Schema::create('code_promos', function(Blueprint $table){
            $table->id();
            $table->string('code')->unique();
            $table->boolean('asset')->default(true);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
        DB::table('code_promos')->insert([
            'code' => '123',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('code_promos')->insert([
            'code' => '456',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('code_promos')->insert([
            'code' => '789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('code_promos')->insert([
            'code' => '147',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('code_promos')->insert([
            'code' => '258',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('code_promos')->insert([
            'code' => '369',
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
        Schema::dropIfExists('codespromo');
    }
};
