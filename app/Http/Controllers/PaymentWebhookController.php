<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    //
    public function handleIzipayNotification(Request $request)
    {
        // 1. Obtener los datos enviados
        $data = $request->all();

        // 2. Log de depuración (opcional)
        Log::info('Izipay Webhook recibido:', $data);

        // 3. Verificar el Hash (Seguridad)
        // Debes comparar el campo kr-hash con un hash generado localmente 
        // usando tu 'Clave Hash' del panel de Izipay.

        if ($this->isSignatureValid($data)) {
            $status = $data['kr-answer']['orderStatus'] ?? '';

            if ($status === 'PAID') {
                // Lógica para marcar pedido como pagado
                // Actualizar ROI/ROAS dashboard si es necesario
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
