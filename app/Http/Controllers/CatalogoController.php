<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
  //
  public function facebookFeed()
  {
    $products = Products::select([
      DB::raw('DISTINCT products.*')
    ])
      ->with(['categoria', 'images', 'combinations'])

      ->leftJoin('categories', 'categories.id', 'products.categoria_id')
      ->leftJoin('attribute_product_values', 'attribute_product_values.product_id', 'products.id')
      ->leftJoin('combinaciones', 'combinaciones.product_id', 'products.id')
      ->where('products.status', 1)
      ->where('categories.visible', 1)
      ->get();
    $items = [];

    foreach ($products as $product) {

      $items[] = $this->mapToFeedItem($product);
    }

    return response()->view('feeds.facebook', ['items' => $items])
      ->header('Content-Type', 'application/xml');
  }

  /**
   * Función auxiliar para formatear el objeto del feed
   */
  private function mapToFeedItem($product)
  {
    $caratula = collect($product->images)->firstWhere('caratula', 1);
    $pathImagen = ($caratula && $caratula->name_imagen)
      ? $caratula->name_imagen
      : 'images/img/noimagen.jpg';

    // Tomamos la primera especificación de forma segura


    // Limpieza de precios (casteo a float)
    $precioFinal = ((float)$product->descuento > 0)
      ? (float)$product->descuento
      : (float)$product->precio;

    return (object)[
      'id'          => $product->id,
      'title'       => $product->producto,
      'description' => strip_tags($product->description), // strip_tags por si viene con HTML
      'link'        => url("/producto/{$product->id}"),
      'image_link'  => asset($pathImagen),
      'price'       => number_format($precioFinal, 2, '.', '') . ' PEN',
      'brand'       => 'Doomine',
      'availability' => 'in stock',
      'condition'   => 'new'
    ];
  }
}
