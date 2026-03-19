<?php

namespace App\Http\Controllers;

use App\Models\Ordenes;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
  //
  // En TuControladorIzipay.php

  public function testIzipayWebhook()
  {
    // 1. Datos simulados (puedes cambiar el orderId aquí para probar diferentes órdenes)
    $data = [
      "kr-hash-key" => "password",
      "kr-hash-algorithm" => "sha256_hmac",
      "kr-answer" => json_encode([
        "orderStatus" => "PAID",
        "orderDetails" => [
          "orderId" => "2924764789" // Asegúrate que este ID exista en tu DB
        ],
        "transactions" => [
          ["uuid" => "test-uuid-12345"]
        ]
      ]),
      "kr-hash" => "hash_simulado",
      "kr-src" => "EMBEDDED_FORM"
    ];

    // 2. Creamos el Request
    $request = new \Illuminate\Http\Request($data);

    // 3. Llamamos al método real de tu controlador
    return $this->handleIzipayNotification($request);
  }

  public function handleIzipayNotification(Request $request)
  {
    // 1. Obtener la data cruda
    $data = $request->all();

    // 2. IMPORTANTE: 'kr-answer' viene como un STRING JSON, hay que convertirlo a array
    $krAnswer = json_decode($request->input('kr-answer'), true);

    if (!$krAnswer) {
      Log::error('Izipay: No se pudo decodificar kr-answer');
      return response()->json(['error' => 'Invalid JSON'], 400);
    }

    // 3. Verificar Seguridad
    if ($this->isSignatureValid($data)) {

      // 4. Extraer el Estatus y el Order ID
      $status = $krAnswer['orderStatus'] ?? '';
      // El Order ID está dentro de orderDetails
      $orderId = $krAnswer['orderDetails']['orderId'] ?? null;

      Log::info("Izipay: Procesando Pedido #{$orderId} con estado: {$status}");

      if ($status === 'PAID' && $orderId) {
        // 5. Lógica para marcar como pagado en tu DB
        // Asumiendo que tu modelo se llama Order
        $order = Ordenes::where('codigo_orden', $orderId)->first();


        if ($order) {
          // Evitamos procesar dos veces si ya está pagada
          if ($order->status_id !== 3) {
            $order->update([
              'status_id' => 3,
              'payment_date' => now(),
              'transaction_id' => $krAnswer['transactions'][0]['uuid'] ?? null
            ]);

            // Aquí podrías disparar el evento de enviar correo de confirmación
            // event(new OrderPaid($order));
            $usuario = UserDetails::where('id', $order->usuario_id)->first();
            $data = [
              'email' => $usuario->email
            ];
            $indexcotrnoller = new IndexController();
            $indexcotrnoller->envioCorreoCompra($usuario, $usuario);
          }
        } else {
          Log::warning("Izipay: Pedido {$orderId} no encontrado en la base de datos.");
        }
      }

      return response()->json(['status' => 'success'], 200);
    }

    return response()->json(['status' => 'invalid signature'], 400);
  }

  private function isSignatureValid($data)
  {
    // Aquí implementas la lógica de verificación de Izipay
    // Generalmente comparas el hash recibido con el calculado
    return true;
  }
}
