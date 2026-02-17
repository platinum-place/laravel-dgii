<?= '<?xml version="1.0" encoding="utf-8"?>' ?>
<ANECF>
    <Encabezado>
        <Version>1.0</Version>
        <RncEmisor>{{ $RncEmisor }}</RncEmisor>
        <CantidadeNCFAnulados>{{ $CantidadeNCFAnulados }}</CantidadeNCFAnulados>
        <FechaHoraAnulacioneNCF>{{ date('d-m-Y H:i:s') }}</FechaHoraAnulacioneNCF>
    </Encabezado>
    <DetalleAnulacion>
        @foreach($DetalleAnulacion as $key => $Anulacion)
            <Anulacion>
                <NoLinea>{{ $Anulacion['NoLinea'] }}</NoLinea>
                <TipoeCF>{{ $Anulacion['TipoeCF'] }}</TipoeCF>
                <TablaRangoSecuenciasAnuladaseNCF>
                    @foreach($Anulacion['TablaRangoSecuenciasAnuladaseNCF'] as $Secuencias)
                        <Secuencias>
                            <SecuenciaeNCFDesde>{{ $Secuencias['SecuenciaeNCFDesde'] }}</SecuenciaeNCFDesde>
                            <SecuenciaeNCFHasta>{{ $Secuencias['SecuenciaeNCFHasta'] }}</SecuenciaeNCFHasta>
                        </Secuencias>
                    @endforeach
                </TablaRangoSecuenciasAnuladaseNCF>
                <CantidadeNCFAnulados>{{ $Anulacion['CantidadeNCFAnulados'] }}</CantidadeNCFAnulados>
            </Anulacion>
        @endforeach
    </DetalleAnulacion>
</ANECF>
