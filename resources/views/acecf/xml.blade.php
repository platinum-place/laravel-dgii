<?= '<?xml version="1.0" encoding="utf-8"?>' ?>
<ACECF>
    <DetalleAprobacionComercial>
        <Version>1.0</Version>
        <RNCEmisor>{{ $RNCEmisor }}</RNCEmisor>
        <eNCF>{{ $eNCF }}</eNCF>
        <FechaEmision>{{ $FechaEmision }}</FechaEmision>
        <MontoTotal>{{ $MontoTotal }}</MontoTotal>
        <RNCComprador>{{ $RNCComprador }}</RNCComprador>
        <Estado>{{ $Estado }}</Estado>
        @isset($DetalleMotivoRechazo)
            <DetalleMotivoRechazo>{{ $DetalleMotivoRechazo }}</DetalleMotivoRechazo>
        @endisset
        <FechaHoraAprobacionComercial>{{ date('d-m-Y H:i:s') }}</FechaHoraAprobacionComercial>
    </DetalleAprobacionComercial>
</ACECF>
