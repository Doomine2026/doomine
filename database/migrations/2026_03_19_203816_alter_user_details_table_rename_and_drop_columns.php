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
        Schema::table('user_details', function (Blueprint $class) {
            // 1. Renombrar columna
            // Nota: Si usas una versión de Laravel antigua (< 9.x), 
            // podrías necesitar instalar la librería 'doctrine/dbal'
            $class->renameColumn('departamento_id', 'addres_user_id');

            // 2. Eliminar columnas
            $class->dropColumn(['provincia_id', 'distrito_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $class) {
            // Revertir los cambios en caso de error
            $class->renameColumn('addres_user_id', 'departamento_id');
            $class->unsignedBigInteger('provincia_id')->nullable();
            $class->unsignedBigInteger('distrito_id')->nullable();
        });
    }
};
