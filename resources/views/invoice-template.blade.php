<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoice->getSequenceNumber() }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td {
            padding: 10px;
            vertical-align: middle;
        }

        .spacer-row {
            height: 50px;
        }

        .left {
            text-align: left;
            font-size: 24px;
            font-weight: bold;
        }

        .right {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        .right .sub {
            font-size: 12px;
            font-weight: normal;
            margin-top: 0;
        }

        .left .sub {
            font-size: 12px;
            font-weight: normal;
            display: block;
            margin-top: 5px;
        }

        .address {
            font-size: 10px;
            font-weight: normal;
            display: block;
            margin-top: 5px;
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .divider {
            border-bottom: 1px solid #000;
            margin-top: 20px;
            width: 100%;
        }

        .client-info {
            font-size: 12px;
            padding-top: 10px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 8px;
        }

        .items-table th {
            background-color: #f8f9fa;
            padding: 3px;
            text-align: left;
            border: 1px solid #000;
        }

        .items-table td {
            padding: 3px;
            border: 1px solid #000;
        }

        .company-title {
            font-size: 20px;
            font-weight: bold;
            text-align: left;
            padding-bottom: 12px;
        }

        .info-left, .info-right {
            width: 50%;
            vertical-align: top;
        }

        .info-left {
            text-align: left;
        }

        .info-right {
            text-align: right;
        }

        .main-text {
            font-size: 14px;
            display: block;
            margin-bottom: 4px;
        }

        .sub {
            font-size: 11px;
            display: block;
            margin-bottom: 4px;
        }

        .address {
            font-size: 10px;
            display: block;
            margin-top: 10px;
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .client-info {
            font-size: 11px;
            padding-top: 10px;
        }

        .client-info b {
            font-weight: bold;
        }

    </style>
</head>
<body>

<table class="table">
    <tr>
        <td colspan="2" class="company-title">
            @if ($logoBase64)
                <img src="data:image/jpeg;base64,{{ $logoBase64 }}"
                     alt="Logo"
                     style="width: 170px; height:auto;">
            @else
                {{ $invoice->getSenderCorporateName() }}
            @endif
        </td>
    </tr>
    <tr>
        <td class="info-left">
            <span class="sub">{{ $invoice->getSenderCorporateName() }}</span>
            <span class="sub"><b>RNC:</b> {{ $invoice->getSenderIdentification() }}</span>
            <span class="sub"><b>Fecha de Emisión:</b> {{ date('d-m-Y', strtotime($invoice->getReleaseDate())) }}</span>
            <span class="address"><b>Dirección:</b> {{ $invoice->getSenderAddress() }}</span>
        </td>
        <td class="info-right">
            <span class="main-text">
                {{ match((int) $invoice->getInvoiceType()) {
                    31 => 'Factura de Crédito Fiscal Electrónica',
                    32 => 'Factura de Consumo Electrónica',
                    33 => 'Nota de Débito Electrónica',
                    34 => 'Nota de Crédito Electrónica',
                    41 => 'Comprobante de Compras Electrónico',
                    43 => 'Comprobante de Gastos Menores Electrónico',
                    44 => 'Comprobante de Regímenes Especiales Electrónico',
                    45 => 'Comprobante Gubernamental Electrónico',
                    46 => 'Comprobante para Exportaciones Electrónico',
                    47 => 'Comprobante para Pagos al Exterior Electrónico',
                    default => 'Comprobante Fiscal Electrónico',
                } }}
            </span>
            <span class="sub"><b>e-NCF:</b> {{ $invoice->getSequenceNumber() }}</span>
            <span
                class="sub"><b>Fecha Vencimiento:</b> {{ date('d-m-Y', strtotime($invoice->getSequenceDueDate())) }}</span>

            @if($invoice->getModifiedSequenceNumber())
                <span class="sub"><b>e-NCF Modificado:</b> {{ $invoice->getModifiedSequenceNumber() }}</span>
            @endif
            @if($invoice->getModificationCode())
                <span class="sub">
                    <b>
                        {{ $invoice->getModificationCode() }}
                    </b>
                </span>
            @endif
        </td>
    </tr>
</table>

@if($invoice->getBuyerIdentification())
    <div class="divider"></div>
    <table class="table">
        <tr>
            <td class="client-info">
                <b>Razón Social Cliente:</b> {{ $invoice->getBuyerCorporateName() }} <br>
                <b>RNC:</b> {{ $invoice->getBuyerIdentification() }}
            </td>
        </tr>
    </table>
@endif

<div class="divider"></div>

<table class="items-table">
    <thead>
    <tr>
        <th style="text-align: center;">Cantidad</th>
        <th style="text-align: center;">Descripción</th>
        <th style="text-align: center;">Precio</th>
        <th style="text-align: center; background-color: #e0e0e0;"><strong>Valor</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoice->getLines() as $line)
        <tr>
            <td>{{ $line['CantidadItem'] }}</td>
            <td>{{ $line['NombreItem'] }}</td>
            <td style="text-align: right;">{{ number_format($line['PrecioUnitarioItem'], 2) }}</td>
            <td style="text-align: right; background-color: #e0e0e0;">{{ number_format($line['MontoItem'], 2) }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3" style="text-align: left;"><b>Subtotal Gravado</b></td>
        <td style="text-align: right; background-color: #e0e0e0;">{{ number_format($invoice->getTotalAmountTaxed(), 2) }}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: left;"><b>Subtotal ITBIS</b></td>
        <td style="text-align: right; background-color: #e0e0e0;">{{ number_format($invoice->getTotalTaxes(), 2) }}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: left;"><b>Subtotal Exento</b></td>
        <td style="text-align: right; background-color: #e0e0e0;">{{ number_format($invoice->getTotalExempt(), 2) }}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: left;"><b>Total</b></td>
        <td style="text-align: right; background-color: #e0e0e0;">{{ number_format($invoice->getTotalAmount(), 2) }}</td>
    </tr>
    </tbody>
</table>

<div class="divider"></div>


<table width="100%" style="margin-top: 20px;">
    @if($invoice->getObservations())
        <tr>
            <td style="width: 50%; vertical-align: top; text-align: right;">
                <p style="font-size: 12px;">
                    <b>Observaciones</b><br>
                    {{ $invoice->getObservations() }}
                </p>
            </td>
        </tr>
    @endif

    <tr>
        <td style="width: 50%; vertical-align: top; text-align: left;">
            <div style="text-align: left; margin-top: 20px;">
                <img
                    src="data:image/png;base64,{{ $qr }}"
                    style="width:120px;height:120px"
                    alt="QR Code"
                >

                <p style="font-size: 12px; margin-top: 5px;">
                    <b>Código de Seguridad:</b> {{ $invoice->getSecurityCode() }}
                </p>

                @if($invoice->getSignatureDate())
                    <p style="font-size: 12px; margin-top: 5px;">
                        <b>Fecha de Firma Digital:</b>
                        {{  date('d-m-Y H:i:s', strtotime($invoice->getSignatureDate()))}}
                    </p>
                @endif
            </div>
        </td>
    </tr>
</table>

</body>
</html>
