<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("source");
            $table->unsignedBigInteger("owner");
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->unsignedBigInteger("created_by");

            $table->foreign('owner')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('candidates');
    }
};
