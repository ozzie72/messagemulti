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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade')->default(1);
            $table->string('name');
            $table->string('last_name', 50)->nullable();
            $table->string('username', 50)->unique()->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 128);
            $table->timestamp('last_session')->nullable();
            $table->string('ip_connect')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('type')->default(3); // 1 => TotalTexto Admin - 2 => Cliente Admin - 3 => Cliente User
            $table->char('user_status',1)->default('P'); // A => Activo - B => Bloqueado - P => Pendiente
            $table->char('client_status',1)->default('A'); // A => Activo - I => Inactivo
            $table->timestamp('password_change')->nullable(); // Fecha del Ultimo Cambio
            $table->timestamp('failed_date')->nullable(); // Fecha del Ultimo Intento
            $table->integer('failed_count')->nullable(); // Cantidad Intentos
            $table->boolean('confirmed')->default(0);
            $table->integer('confirmation_code')->nullable();
            $table->timestamp('password_expires_at')->nullable(); // Nuevo campo para la fecha de expiración de la contraseña
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('divition_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
