<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->string('type')->default('info')->after('ip');
            $table->json('details')->nullable()->after('type');
            $table->string('url')->nullable()->after('details');
            $table->string('method')->nullable()->after('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->dropColumn(['type', 'details', 'url', 'method']);
        });
    }
};









