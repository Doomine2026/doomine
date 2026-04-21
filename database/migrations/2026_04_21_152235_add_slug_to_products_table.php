<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Primero la creamos sin el unique() para que no falle
            $table->string('slug')->nullable()->after('producto');
        });

        // Paso 2: Generar los slugs para los registros existentes
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update(['slug' => Str::slug($product->producto) . '-' . $product->id]);
            // Concatenamos el ID para asegurar que sean únicos de verdad
        }

        // Paso 3: Ahora sí, aplicamos el UNIQUE y quitamos el nullable
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('slug');
        });
    }
};
