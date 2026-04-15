<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Confirmación de Orden - DOOMINE</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #ffffff;
      font-family: "Helvetica", Arial, sans-serif;
    }

    .wrapper {
      width: 100%;
      table-layout: fixed;
      background-color: #ffffff;
      padding-bottom: 40px;
    }

    .main {
      background-color: #ffffff;
      margin: 0 auto;
      width: 100%;
      max-width: 600px;
      border-spacing: 0;
      color: #000000;
    }

    .header {
      padding: 40px 0;
      text-align: center;
      letter-spacing: 5px;
      font-weight: bold;
      font-size: 24px;
      border-bottom: 1px solid #eeeeee;
    }

    .content {
      padding: 40px 20px;
      text-align: center;
    }

    .h1 {
      font-size: 28px;
      font-weight: 900;
      text-transform: uppercase;
      margin-bottom: 20px;
      letter-spacing: 2px;
    }

    .text {
      font-size: 16px;
      line-height: 1.6;
      color: #333333;
      margin-bottom: 30px;
    }

    .button-container {
      padding: 20px 0;
    }

    .button {
      background-color: #000000;
      color: #ffffff !important;
      padding: 18px 30px;
      text-decoration: none;
      font-size: 14px;
      font-weight: bold;
      text-transform: uppercase;
      display: inline-block;
    }

    .footer {
      padding: 40px 20px;
      text-align: center;
      font-size: 12px;
      color: #999999;
      border-top: 1px solid #eeeeee;
    }

    @media screen and (max-width: 600px) {
      .h1 {
        font-size: 22px;
      }
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <table class="main">
      <tr>
        <img src="{{ $domain }}/images/img/logo3x.png" alt="Logotipo doomine" style="max-width: 150px" />
      </tr>
      <tr>
        <td class="content">
          <h1 class="h1">Orden Confirmada</h1>
          <p class="text">
            Hola <strong>{{ $nombre }}</strong>,<br />Tu selección
            ha sido procesada. Estamos preparando tu envío para
            que llegue a tu destino lo antes posible.
          </p>
          <div style="margin-bottom: 20px;">
            <span
              style="background-color: #f3f4f6; color: #374151; padding: 4px 12px; border-radius: 12px; font-family: sans-serif; font-size: 12px; font-weight: 600;">
              PEDIDO #{{ $orders->codigo_orden ?? '' }}
            </span>
          </div>

          <div
            style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; font-family: 'Segoe UI', Helvetica, Arial, sans-serif; color: #1f2937;">

            <h2
              style="font-size: 18px; font-weight: 700; margin: 0 0 16px 0; border-bottom: 2px solid #3b82f6; display: inline-block; padding-bottom: 4px;">
              Información del Cliente
            </h2>

            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
              <tr>
                <td style="padding-bottom: 12px;">
                  <p
                    style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                    Nombre Completo</p>
                  <p style="margin: 4px 0 0 0; font-size: 15px; font-weight: 500;">
                    {{ $orders->usuarioPedido->name ?? ($orders->usuarioPedido->nombre ?? '') }}
                    {{ $orders->usuarioPedido->lastname ?? ($orders->usuarioPedido->apellidos ?? '') }}
                  </p>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 12px;">
                  <p
                    style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                    Dirección de Entrega</p>
                  <p style="margin: 4px 0 0 0; font-size: 14px; line-height: 1.5;">
                    {{ $direccion->dir_av_calle ?? '' }} {{ $direccion->dir_numero ?? '' }}<br>
                    <span style="color: #4b5563;">{{ $direccion->dir_bloq_lote ?? '' }}</span>
                  </p>
                </td>
              </tr>
              <tr>
                <td>
                  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                      <td width="50%" style="padding-bottom: 12px;">
                        <p
                          style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                          DNI / Documento</p>
                        <p style="margin: 4px 0 0 0; font-size: 14px;">{{ $orders->usuarioPedido->dni ?? 'N/A' }}</p>
                      </td>
                      <td width="50%" style="padding-bottom: 12px;">
                        <p
                          style="margin: 0; font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                          Teléfono</p>
                        <p style="margin: 4px 0 0 0; font-size: 14px;">{{ $orders->usuarioPedido->phone ?? '' }}</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="padding-top: 8px; border-top: 1px dashed #e5e7eb;">
                  <p style="margin: 8px 0 0 0; font-size: 14px; color: #3b82f6;">
                    <strong>Email:</strong> {{ $orders->usuarioPedido->email ?? '' }}
                  </p>
                </td>
              </tr>
            </table>
          </div>
          <div id="productos-lista">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
              style="margin-top: 20px; font-family: 'Segoe UI', Helvetica, Arial, sans-serif; border-collapse: collapse;">
              <thead>
                <tr>
                  <th colspan="2"
                    style="text-align: left; padding: 12px 8px; border-bottom: 2px solid #e5e7eb; color: #6b7280; font-size: 12px; text-transform: uppercase;">
                    Producto</th>
                  <th
                    style="text-align: center; padding: 12px 8px; border-bottom: 2px solid #e5e7eb; color: #6b7280; font-size: 12px; text-transform: uppercase;">
                    Cant.</th>
                  <th
                    style="text-align: right; padding: 12px 8px; border-bottom: 2px solid #e5e7eb; color: #6b7280; font-size: 12px; text-transform: uppercase;">
                    Total</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($orders->DetalleOrden as $item)
                  <tr>


                    <td style="padding: 16px 8px; border-bottom: 1px solid #f3f4f6;">
                      <p style="margin: 0; font-size: 14px; font-weight: 600; color: #1f2937;">
                        {{ $item->producto->producto ?? 'Producto' }}
                      </p>
                      <p style="margin: 4px 0 0 0; font-size: 12px; color: #6b7280;">
                        @if ($item->color)
                          <span style="background: #f3f4f6; padding: 2px 6px; border-radius: 4px;">Color:
                            {{ $item->color->valor }}</span>
                        @endif
                        @if ($item->talla)
                          <span
                            style="background: #f3f4f6; padding: 2px 6px; border-radius: 4px; margin-left: 4px;">Talla:
                            {{ $item->talla->valor }}</span>
                        @endif
                      </p>
                    </td>

                    <td
                      style="padding: 16px 8px; border-bottom: 1px solid #f3f4f6; text-align: center; font-size: 14px; color: #4b5563;">
                      {{ $item->cantidad }}
                      <div style="font-size: 11px; color: #9ca3af;">S/ {{ number_format($item->precio, 2) }} c/u</div>
                    </td>

                    <td
                      style="padding: 16px 8px; border-bottom: 1px solid #f3f4f6; text-align: right; font-size: 14px; font-weight: 600; color: #1f2937;">
                      S/ {{ $item->precio * $item->cantidad }}
                    </td>
                  </tr>
                @endforeach
              </tbody>

              <tfoot>
                <tr>
                  <td colspan="2"></td>
                  <td style="padding: 20px 8px 8px 8px; text-align: right; font-size: 14px; color: #6b7280;">Subtotal
                  </td>
                  <td style="padding: 20px 8px 8px 8px; text-align: right; font-size: 14px; color: #1f2937;">S/
                    {{ number_format($orders->monto, 2) }}</td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td style="padding: 8px; text-align: right; font-size: 14px; color: #6b7280;">Envío</td>
                  <td style="padding: 8px; text-align: right; font-size: 14px; color: #1f2937;">S/
                    {{ number_format($orders->precio_envio, 2) }}</td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td style="padding: 12px 8px; text-align: right; font-size: 16px; font-weight: 700; color: #111827;">
                    Total</td>
                  <td style="padding: 12px 8px; text-align: right; font-size: 18px; font-weight: 700; color: #3b82f6;">
                    S/ {{ number_format($orders->monto, 2) }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </td>
      </tr>
      <tr>
        <td class="footer">
          © 2026 DOOMINE. LIMA, PERÚ.<br />
          Estás recibiendo este correo por tu actividad en
          {{ $domain }}
        </td>
      </tr>
    </table>
  </div>
</body>

</html>
