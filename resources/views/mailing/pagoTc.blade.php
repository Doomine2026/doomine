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
          <div id="productos-lista">
            <table style="width: 100%; border-collapse: collapse; font">
              <thead>
                <tr>
                  <th style="padding: 8px"></th>
                  <th style="padding: 8px"></th>
                  <th style="padding: 8px"></th>
                  <th style="padding: 8px"></th>
                </tr>
              </thead>
              <tbody style="font-size: 14px">
                @foreach ($orders->DetalleOrden as $item)
                  <tr>
                    <td style="padding: 8px; text-align: center">

                    </td>
                    <td style="padding: 8px">
                      {{ $item->producto->producto ?? '' }}
                    </td>
                    <td style="padding: 8px">
                      {{ $item->precio }} x {{ $item->cantidad }}
                    </td>
                    <td style="padding: 8px">
                      {{ $item->precio * $item->cantidad }}
                    </td>
                  </tr>
                @endforeach
                <tr>
                  <td style="padding: 8px"></td>
                  <td style="padding: 8px"></td>
                  <td style="padding: 8px; text-align: left">
                    Subtotal:
                  </td>
                  <td style="padding: 8px">
                    {{ $orders->monto }}
                  </td>
                </tr>
                <tr>
                  <td style="padding: 8px"></td>
                  <td style="padding: 8px"></td>
                  <td style="padding: 8px; text-align: left">
                    Envío:
                  </td>
                  <td style="padding: 8px">
                    {{ $orders->precio_envio }}
                  </td>
                </tr>
                <tr>
                  <td style="padding: 8px"></td>
                  <td style="padding: 8px"></td>
                  <td style="padding: 8px; text-align: left">
                    Total:
                  </td>
                  <td style="padding: 8px">
                    {{ $orders->monto + $orders->precio_envio }}
                  </td>
                </tr>
              </tbody>
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
