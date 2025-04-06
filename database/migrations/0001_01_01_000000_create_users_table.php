<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//use Spatie\Permission\Models\Role; // Importar el modelo Role /////////////////////////

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id'); // Cambiado a bigIncrements
            $table->string('name', 50)->unique();
            $table->string('ip', 15);
            $table->string('port', 6);
            $table->string('server_user', 50)->nullable();
            $table->string('server_pass', 50)->nullable();
            $table->string('image');
            $table->tinyInteger('status')->nullable()->default(1);
            $table->foreignId('divition_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->timestamps();
        });






        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // 04-04-2025
            $table->string('name');
            $table->string('last_name', 50); //05-04-2025
            $table->string('username', 50)->unique(); //05-04-2025
            $table->string('phone', 12); //05-04-2025
            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 128);
            $table->timestamp('last_session')->nullable();
            $table->string('ip_connect');
            $table->boolean('is_admin')->default(0);
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('type'); // 1 => TotalTexto Admin - 2 => Cliente Admin - 3 => Cliente User
            $table->char('user_status',1); // A => Activo - B => Bloqueado - P => Pendiente
            $table->char('client_status',1); // A => Activo - I => Inactivo
            $table->timestamp('password_change'); // Fecha del Ultimo Cambio
            $table->timestamp('failed_date')->nullable(); // Fecha del Ultimo Intento
            $table->integer('failed_count')->nullable(); // Cantidad Intentos
            $table->string('remember_token');
            $table->boolean('confirmed')->default(0);
            $table->integer('confirmation_code')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });





        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('last_name', 50);
            $table->string('username', 50)->unique();
            $table->string('phone', 12);
            $table->string('email', 100)->unique();
            $table->string('password', 128);
            $table->integer('type'); // 1 => TotalTexto Admin - 2 => Cliente Admin - 3 => Cliente User
            $table->char('user_status',1); // A => Activo - B => Bloqueado - P => Pendiente
            $table->timestamps();

        });












        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->foreignId('divition_id')->constrained();
            $table->timestamps();
        });

        Schema::create('divitions', function (Blueprint $table) { 
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

/*
        // Asignar roles
        $adminRole = Role::findByName('admin'); // Obtener el rol 'admin'
        $usuarioAdmin->assignRole($adminRole); // Asignar el rol al usuario

        $adminTotaltextoRole = Role::findByName('admin-totaltexto'); // Obtener el rol 'admin-totaltexto'
        $usuarioAdminTotaltexto->assignRole($adminTotaltextoRole); // Asignar el rol al usuario

        $superAdminRole = Role::findByName('superadmin'); // Obtener el rol 'superadmin'
        $usuarioSuperadmin->assignRole($superAdminRole); // Asignar el rol al usuario   
        */     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
