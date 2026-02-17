<?= '<?xml version="1.0" encoding="utf-8"?>' ?>
<ECF>
    <Encabezado>
        <Version>1.0</Version>
        <IdDoc>
            @isset($IdDoc['TipoeCF'])
                <TipoeCF>{{ $IdDoc['TipoeCF'] }}</TipoeCF>
            @endisset
                @if(isset($IdDoc['eNCF']) or isset($IdDoc['ENCF']))
                    <eNCF>{{ $IdDoc['eNCF'] ?? $IdDoc['ENCF'] }}</eNCF>
                @endif
            @isset($IdDoc['FechaVencimientoSecuencia'])
                <FechaVencimientoSecuencia>{{ $IdDoc['FechaVencimientoSecuencia'] }}</FechaVencimientoSecuencia>
            @endisset
            @isset($IdDoc['TipoPago'])
                <TipoPago>{{ $IdDoc['TipoPago'] }}</TipoPago>
            @endisset
            @isset($IdDoc['TotalPaginas'])
                <TotalPaginas>{{ $IdDoc['TotalPaginas'] }}</TotalPaginas>
            @endisset
        </IdDoc>
        <Emisor>
            @isset($Emisor['RNCEmisor'])
                <RNCEmisor>{{ $Emisor['RNCEmisor'] }}</RNCEmisor>
            @endisset
            @isset($Emisor['RazonSocialEmisor'])
                <RazonSocialEmisor>{{ $Emisor['RazonSocialEmisor'] }}</RazonSocialEmisor>
            @endisset
            @isset($Emisor['NombreComercial'])
                <NombreComercial>{{ $Emisor['NombreComercial'] }}</NombreComercial>
            @endisset
            @isset($Emisor['Sucursal'])
                <Sucursal>{{ $Emisor['Sucursal'] }}</Sucursal>
            @endisset
            @isset($Emisor['DireccionEmisor'])
                <DireccionEmisor>{{ $Emisor['DireccionEmisor'] }}</DireccionEmisor>
            @endisset
            @isset($Emisor['Municipio'])
                <Municipio>{{ $Emisor['Municipio'] }}</Municipio>
            @endisset
            @isset($Emisor['Provincia'])
                <Provincia>{{ $Emisor['Provincia'] }}</Provincia>
            @endisset
            @if(!empty($Emisor['TablaTelefonoEmisor']))
                <TablaTelefonoEmisor>
                    @foreach ($Emisor['TablaTelefonoEmisor'] as $TelefonoEmisor)
                        <TelefonoEmisor>{{ $TelefonoEmisor['TelefonoEmisor'] }}</TelefonoEmisor>
                    @endforeach
                </TablaTelefonoEmisor>
            @endif
            @isset($Emisor['CorreoEmisor'])
                <CorreoEmisor>{{ $Emisor['CorreoEmisor'] }}</CorreoEmisor>
            @endisset
            @isset($Emisor['WebSite'])
                <WebSite>{{ $Emisor['WebSite'] }}</WebSite>
            @endisset
            @isset($Emisor['ActividadEconomica'])
                <ActividadEconomica>{{ $Emisor['ActividadEconomica'] }}</ActividadEconomica>
            @endisset
            @isset($Emisor['NumeroFacturaInterna'])
                <NumeroFacturaInterna>{{ $Emisor['NumeroFacturaInterna'] }}</NumeroFacturaInterna>
            @endisset
            @isset($Emisor['NumeroPedidoInterno'])
                <NumeroPedidoInterno>{{ $Emisor['NumeroPedidoInterno'] }}</NumeroPedidoInterno>
            @endisset
            @isset($Emisor['InformacionAdicionalEmisor'])
                <InformacionAdicionalEmisor>{{ $Emisor['InformacionAdicionalEmisor'] }}</InformacionAdicionalEmisor>
            @endisset
            @isset($Emisor['FechaEmision'])
                <FechaEmision>{{ $Emisor['FechaEmision'] }}</FechaEmision>
            @endisset
        </Emisor>
        <Totales>
            @isset($Totales['MontoExento'])
                <MontoExento>{{ $Totales['MontoExento'] }}</MontoExento>
            @endisset
            @isset($Totales['MontoTotal'])
                <MontoTotal>{{ $Totales['MontoTotal'] }}</MontoTotal>
            @endisset
            @isset($Totales['MontoPeriodo'])
                <MontoPeriodo>{{ $Totales['MontoPeriodo'] }}</MontoPeriodo>
            @endisset
            @isset($Totales['SaldoAnterior'])
                <SaldoAnterior>{{ $Totales['SaldoAnterior'] }}</SaldoAnterior>
            @endisset
            @isset($Totales['MontoAvancePago'])
                <MontoAvancePago>{{ $Totales['MontoAvancePago'] }}</MontoAvancePago>
            @endisset
            @isset($Totales['ValorPagar'])
                <ValorPagar>{{ $Totales['ValorPagar'] }}</ValorPagar>
            @endisset
        </Totales>
        @if(!empty($OtraMoneda))
            <OtraMoneda>
                @isset($OtraMoneda['TipoMoneda'])
                    <TipoMoneda>{{ $OtraMoneda['TipoMoneda'] }}</TipoMoneda>
                @endisset
                @isset($OtraMoneda['TipoCambio'])
                    <TipoCambio>{{ $OtraMoneda['TipoCambio'] }}</TipoCambio>
                @endisset
                @isset($OtraMoneda['MontoExentoOtraMoneda'])
                    <MontoExentoOtraMoneda>{{ $OtraMoneda['MontoExentoOtraMoneda'] }}</MontoExentoOtraMoneda>
                @endisset
                @isset($OtraMoneda['MontoTotalOtraMoneda'])
                    <MontoTotalOtraMoneda>{{ $OtraMoneda['MontoTotalOtraMoneda'] }}</MontoTotalOtraMoneda>
                @endisset
            </OtraMoneda>
        @endif
    </Encabezado>
    <DetallesItems>
        @foreach ($DetallesItems as $Item)
            <Item>
                @isset($Item['NumeroLinea'])
                    <NumeroLinea>{{ $Item['NumeroLinea'] }}</NumeroLinea>
                @endisset
                @if(!empty($Item['TablaCodigosItem']))
                    <TablaCodigosItem>
                        @foreach ($Item['TablaCodigosItem'] as $CodigosItem)
                            <CodigosItem>
                                @isset($CodigosItem['TipoCodigo'])
                                    <TipoCodigo>{{ $CodigosItem['TipoCodigo'] }}</TipoCodigo>
                                @endisset
                                @isset($CodigosItem['CodigoItem'])
                                    <CodigoItem>{{ $CodigosItem['CodigoItem'] }}</CodigoItem>
                                @endisset
                            </CodigosItem>
                        @endforeach
                    </TablaCodigosItem>
                @endif
                @isset($Item['IndicadorFacturacion'])
                    <IndicadorFacturacion>{{ $Item['IndicadorFacturacion'] }}</IndicadorFacturacion>
                @endisset
                @isset($Item['NombreItem'])
                    <NombreItem>{{ $Item['NombreItem'] }}</NombreItem>
                @endisset
                @isset($Item['IndicadorBienoServicio'])
                    <IndicadorBienoServicio>{{ $Item['IndicadorBienoServicio'] }}</IndicadorBienoServicio>
                @endisset
                @isset($Item['DescripcionItem'])
                    <DescripcionItem>{{ $Item['DescripcionItem'] }}</DescripcionItem>
                @endisset
                @isset($Item['CantidadItem'])
                    <CantidadItem>{{ $Item['CantidadItem'] }}</CantidadItem>
                @endisset
                @isset($Item['UnidadMedida'])
                    <UnidadMedida>{{ $Item['UnidadMedida'] }}</UnidadMedida>
                @endisset
                @isset($Item['PrecioUnitarioItem'])
                    <PrecioUnitarioItem>{{ $Item['PrecioUnitarioItem'] }}</PrecioUnitarioItem>
                @endisset
                @isset($Item['OtraMonedaDetalle'])
                    <OtraMonedaDetalle>
                        @isset($Item['OtraMonedaDetalle']['PrecioOtraMoneda'])
                            <PrecioOtraMoneda>{{ $Item['OtraMonedaDetalle']['PrecioOtraMoneda'] }}</PrecioOtraMoneda>
                        @endisset
                        @isset($Item['OtraMonedaDetalle']['DescuentoOtraMoneda'])
                            <DescuentoOtraMoneda>{{ $Item['OtraMonedaDetalle']['DescuentoOtraMoneda'] }}</DescuentoOtraMoneda>
                        @endisset
                        @isset($Item['OtraMonedaDetalle']['RecargoOtraMoneda'])
                            <RecargoOtraMoneda>{{ $Item['OtraMonedaDetalle']['RecargoOtraMoneda'] }}</RecargoOtraMoneda>
                        @endisset
                        @isset($Item['OtraMonedaDetalle']['MontoItemOtraMoneda'])
                            <MontoItemOtraMoneda>{{ $Item['OtraMonedaDetalle']['MontoItemOtraMoneda'] }}</MontoItemOtraMoneda>
                        @endisset
                    </OtraMonedaDetalle>
                @endisset
                @isset($Item['MontoItem'])
                    <MontoItem>{{ $Item['MontoItem'] }}</MontoItem>
                @endisset
            </Item>
        @endforeach
    </DetallesItems>
    @if(!empty($Subtotales))
        <Subtotales>
            @foreach ($Subtotales as $Subtotal)
                <Subtotal>
                    @if (!empty($Subtotal['NumeroSubTotal']))
                        <NumeroSubTotal>{{ $Subtotal['NumeroSubTotal'] }}</NumeroSubTotal>
                    @endif
                    @if (!empty($Subtotal['DescripcionSubtotal']))
                        <DescripcionSubtotal>{{ $Subtotal['DescripcionSubtotal'] }}</DescripcionSubtotal>
                    @endif
                    @if (!empty($Subtotal['Orden']))
                        <Orden>{{ $Subtotal['Orden'] }}</Orden>
                    @endif
                    @if (!empty($Subtotal['SubTotalExento']))
                        <SubTotalExento>{{ $Subtotal['SubTotalExento'] }}</SubTotalExento>
                    @endif
                    @if (!empty($Subtotal['MontoSubTotal']))
                        <MontoSubTotal>{{ $Subtotal['MontoSubTotal'] }}</MontoSubTotal>
                    @endif
                    @if (!empty($Subtotal['Lineas']))
                        <Lineas>{{ $Subtotal['Lineas'] }}</Lineas>
                    @endif
                </Subtotal>
            @endforeach
        </Subtotales>
    @endif
    @if(!empty($Paginacion))
        <Paginacion>
            @foreach ($Paginacion as $Pagina)
                <Pagina>
                    @if (isset($Pagina['PaginaNo']))
                        <PaginaNo>{{ $Pagina['PaginaNo'] }}</PaginaNo>
                    @endif
                    @if (isset($Pagina['NoLineaDesde']))
                        <NoLineaDesde>{{ $Pagina['NoLineaDesde'] }}</NoLineaDesde>
                    @endif
                    @if (isset($Pagina['NoLineaHasta']))
                        <NoLineaHasta>{{ $Pagina['NoLineaHasta'] }}</NoLineaHasta>
                    @endif
                    @if (isset($Pagina['SubtotalExentoPagina']))
                        <SubtotalExentoPagina>{{ $Pagina['SubtotalExentoPagina'] }}</SubtotalExentoPagina>
                    @endif
                    @if (isset($Pagina['MontoSubtotalPagina']))
                        <MontoSubtotalPagina>{{ $Pagina['MontoSubtotalPagina'] }}</MontoSubtotalPagina>
                    @endif
                </Pagina>
            @endforeach
        </Paginacion>
    @endif
    @if (!empty($InformacionReferencia))
        <InformacionReferencia>
            @if (isset($InformacionReferencia['NCFModificado']))
                <NCFModificado>{{ $InformacionReferencia['NCFModificado'] }}</NCFModificado>
            @endif
            @if (isset($InformacionReferencia['RNCOtroContribuyente']))
                <RNCOtroContribuyente>{{ $InformacionReferencia['RNCOtroContribuyente'] }}</RNCOtroContribuyente>
            @endif
            @if (isset($InformacionReferencia['FechaNCFModificado']))
                <FechaNCFModificado>{{ $InformacionReferencia['FechaNCFModificado'] }}</FechaNCFModificado>
            @endif
            @if (isset($InformacionReferencia['CodigoModificacion']))
                <CodigoModificacion>{{ $InformacionReferencia['CodigoModificacion'] }}</CodigoModificacion>
            @endif
        </InformacionReferencia>
    @endif
    <FechaHoraFirma>{{ $FechaHoraFirma ?? date('d-m-Y H:i:s') }}</FechaHoraFirma>
</ECF>
