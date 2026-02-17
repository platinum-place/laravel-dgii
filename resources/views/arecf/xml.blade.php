<?= '<?xml version="1.0" encoding="utf-8"?>' ?>
<ARECF>
    <DetalleAcusedeRecibo>
        <Version>1.0</Version>
        <RNCEmisor>{{ $RNCEmisor }}</RNCEmisor>
        <RNCComprador>{{ $RNCComprador }}</RNCComprador>
        <eNCF>{{ $eNCF }}</eNCF>
        <Estado>{{ $Estado }}</Estado>
        @isset($CodigoMotivoNoRecibido)
            <CodigoMotivoNoRecibido>{{ $CodigoMotivoNoRecibido }}</CodigoMotivoNoRecibido>
        @endisset
        <FechaHoraAcuseRecibo>{{ date('d-m-Y H:i:s') }}</FechaHoraAcuseRecibo>
    </DetalleAcusedeRecibo>
</ARECF>
