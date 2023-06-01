<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Src\Shared\Domain\ValueObject\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $roles = collect(Role::cases())->map(fn ($role) => $role->value)->toArray();

        Schema::create('users', function (Blueprint $table) use ($roles) {

            $table->id();
            $table->string('username');
            $table->string('password');
            $table->timestamp("last_login");
            $table->boolean("is_active");
            $table->enum("role", $roles);
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
};
