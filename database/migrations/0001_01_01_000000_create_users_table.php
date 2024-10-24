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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profile_image', 200)->nullable();
            $table->text('hash_password')->nullable();
            $table->string('mobile_number', 15)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('code')->nullable();
            $table->integer('role_id');
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // Seed the initial data (optional, typically done via seeders)
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'profile_image' => '1695208414.jpg',
            'hash_password' => NULL,
            'mobile_number' => '6767676767',
            'email_verified_at' => NULL,
            'code' => 12324,
            'role_id' => 1,
            'password' => '$2y$12$6YETIW7MIjZcsyG62SevF.XajB4sYghDP1SwHuzzGmAhkoqj7BIkK',
            'remember_token' => '',
            'status' => 1,
            'created_at' => NULL,
            'updated_at' => '2024-06-14 00:32:39',
            'deleted_at' => NULL
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

