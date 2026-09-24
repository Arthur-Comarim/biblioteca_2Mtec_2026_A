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
        Schema::create('_c_l_i_e_n_t_e_s', function (Blueprint $table) {
            $table->id("CLICODIGO");
            $table->string("CLINOME", 150);
            $table->string("CLICPF", 15) -> unique();
            $table->string("CLITELEFONE")-> nullable();
            $table->string("CLITEMAIL")-> nullable();
            $table->date("CLIDTNASC");
            $table->date("CLIDTCAD");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_c_l_i_e_n_t_e_s');
    }
};
