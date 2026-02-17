<?= '<?xml version="1.0" encoding="utf-8"?>' ?>
<RFCE>
    <Encabezado>
        <Version>1.0</Version>
        <IdDoc>
            @isset($IdDoc['TipoeCF'])
                <TipoeCF>{{ $IdDoc['TipoeCF'] }}</TipoeCF>
            @endisset
                @if(isset($IdDoc['eNCF']) or isset($IdDoc['ENCF']))
                    <eNCF>{{ $IdDoc['eNCF'] ?? $IdDoc['ENCF'] }}</eNCF>
                @endif
            @isset($IdDoc['TipoIngresos'])
                <TipoIngresos>{{ $IdDoc['TipoIngresos'] }}</TipoIngresos>
            @endisset
            @isset($IdDoc['TipoPago'])
                <TipoPago>{{ $IdDoc['TipoPago'] }}</TipoPago>
            @endisset
            @if(!empty($IdDoc['TablaFormasPago']))
                <TablaFormasPago>
                    @foreach ($IdDoc['TablaFormasPago'] as $FormaDePago)
                        <FormaDePago>
                            @isset($FormaDePago['FormaPago'])
                                <FormaPago>{{ $FormaDePago['FormaPago'] }}</FormaPago>
                            @endisset
                            @isset($FormaDePago['MontoPago'])
                                <MontoPago>{{ $FormaDePago['MontoPago'] }}</MontoPago>
                            @endisset
                        </FormaDePago>
                    @endforeach
                </TablaFormasPago>
            @endif
        </IdDoc>
        <Emisor>
            @isset($Emisor['RNCEmisor'])
                <RNCEmisor>{{ $Emisor['RNCEmisor'] }}</RNCEmisor>
            @endisset
            @isset($Emisor['RazonSocialEmisor'])
                <RazonSocialEmisor>{{ $Emisor['RazonSocialEmisor'] }}</RazonSocialEmisor>
            @endisset
            @isset($Emisor['FechaEmision'])
                <FechaEmision>{{ $Emisor['FechaEmision'] }}</FechaEmision>
            @endisset
        </Emisor>
        @isset($Comprador)
            <Comprador>
                @isset($Comprador['RNCComprador'])
                    <RNCComprador>{{ $Comprador['RNCComprador'] }}</RNCComprador>
                @endisset
                @isset($Comprador['IdentificadorExtranjero'])
                    <IdentificadorExtranjero>{{ $Comprador['IdentificadorExtranjero'] }}</IdentificadorExtranjero>
                @endisset
                @isset($Comprador['RazonSocialComprador'])
                    <RazonSocialComprador>{{ $Comprador['RazonSocialComprador'] }}</RazonSocialComprador>
                @endisset
            </Comprador>
        @endisset
        <Totales>
            @isset($Totales['MontoGravadoTotal'])
                <MontoGravadoTotal>{{ $Totales['MontoGravadoTotal'] }}</MontoGravadoTotal>
            @endisset
            @isset($Totales['MontoGravadoI1'])
                <MontoGravadoI1>{{ $Totales['MontoGravadoI1'] }}</MontoGravadoI1>
            @endisset
            @isset($Totales['MontoGravadoI2'])
                <MontoGravadoI2>{{ $Totales['MontoGravadoI2'] }}</MontoGravadoI2>
            @endisset
            @isset($Totales['MontoGravadoI3'])
                <MontoGravadoI3>{{ $Totales['MontoGravadoI3'] }}</MontoGravadoI3>
            @endisset
            @isset($Totales['MontoExento'])
                <MontoExento>{{ $Totales['MontoExento'] }}</MontoExento>
            @endisset
            @isset($Totales['TotalITBIS'])
                <TotalITBIS>{{ $Totales['TotalITBIS'] }}</TotalITBIS>
            @endisset
            @isset($Totales['TotalITBIS1'])
                <TotalITBIS1>{{ $Totales['TotalITBIS1'] }}</TotalITBIS1>
            @endisset
            @isset($Totales['TotalITBIS2'])
                <TotalITBIS2>{{ $Totales['TotalITBIS2'] }}</TotalITBIS2>
            @endisset
            @isset($Totales['TotalITBIS3'])
                <TotalITBIS3>{{ $Totales['TotalITBIS3'] }}</TotalITBIS3>
            @endisset
            @isset($Totales['MontoImpuestoAdicional'])
                <MontoImpuestoAdicional>{{ $Totales['MontoImpuestoAdicional'] }}</MontoImpuestoAdicional>
            @endisset
            @if(!empty($Totales['ImpuestosAdicionales']))
                <ImpuestosAdicionales>
                    @foreach ($Totales['ImpuestosAdicionales'] as $ImpuestoAdicional)
                        <ImpuestoAdicional>
                            @isset($ImpuestoAdicional['TipoImpuesto'])
                                <TipoImpuesto>{{ $ImpuestoAdicional['TipoImpuesto'] }}</TipoImpuesto>
                            @endisset
                            @isset($ImpuestoAdicional['MontoImpuestoSelectivoConsumoEspecifico'])
                                <MontoImpuestoSelectivoConsumoEspecifico>{{ $ImpuestoAdicional['MontoImpuestoSelectivoConsumoEspecifico'] }}</MontoImpuestoSelectivoConsumoEspecifico>
                            @endisset
                            @isset($ImpuestoAdicional['MontoImpuestoSelectivoConsumoAdvalorem'])
                                <MontoImpuestoSelectivoConsumoAdvalorem>{{ $ImpuestoAdicional['MontoImpuestoSelectivoConsumoAdvalorem'] }}</MontoImpuestoSelectivoConsumoAdvalorem>
                            @endisset
                            @isset($ImpuestoAdicional['OtrosImpuestosAdicionales'])
                                <OtrosImpuestosAdicionales>{{ $ImpuestoAdicional['OtrosImpuestosAdicionales'] }}</OtrosImpuestosAdicionales>
                            @endisset
                        </ImpuestoAdicional>
                    @endforeach
                </ImpuestosAdicionales>
            @endif
            @isset($Totales['MontoTotal'])
                <MontoTotal>{{ $Totales['MontoTotal'] }}</MontoTotal>
            @endisset
            @isset($Totales['MontoNoFacturable'])
                <MontoNoFacturable>{{ $Totales['MontoNoFacturable'] }}</MontoNoFacturable>
            @endisset
            @isset($Totales['MontoPeriodo'])
                <MontoPeriodo>{{ $Totales['MontoPeriodo'] }}</MontoPeriodo>
            @endisset
        </Totales>
        <CodigoSeguridadeCF>{{ $CodigoSeguridadeCF }}</CodigoSeguridadeCF>
    </Encabezado>
</RFCE>
