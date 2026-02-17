<?= '<?xml version="1.0" encoding="utf-8"?>' ?>
<ECF>
    <Encabezado>
        <Version>1.0</Version>
        <IdDoc>
            @if (isset($IdDoc['TipoeCF']))
                <TipoeCF>{{ $IdDoc['TipoeCF'] }}</TipoeCF>
            @endif
                @if(isset($IdDoc['eNCF']) or isset($IdDoc['ENCF']))
                    <eNCF>{{ $IdDoc['eNCF'] ?? $IdDoc['ENCF'] }}</eNCF>
                @endif
            @if (isset($IdDoc['FechaVencimientoSecuencia']))
                <FechaVencimientoSecuencia>{{ $IdDoc['FechaVencimientoSecuencia'] }}</FechaVencimientoSecuencia>
            @endif
            @if (isset($IdDoc['TipoPago']))
                <TipoPago>{{ $IdDoc['TipoPago'] }}</TipoPago>
            @endif
            @if (isset($IdDoc['FechaLimitePago']))
                <FechaLimitePago>{{ $IdDoc['FechaLimitePago'] }}</FechaLimitePago>
            @endif
            @if (isset($IdDoc['TerminoPago']))
                <TerminoPago>{{ $IdDoc['TerminoPago'] }}</TerminoPago>
            @endif
            @if (!empty($IdDoc['TablaFormasPago']))
                <TablaFormasPago>
                    @foreach ($IdDoc['TablaFormasPago'] as $FormaDePago)
                        <FormaDePago>
                            @if (isset($FormaDePago['FormaPago']))
                                <FormaPago>{{ $FormaDePago['FormaPago'] }}</FormaPago>
                            @endif
                            @if (isset($FormaDePago['MontoPago']))
                                <MontoPago>{{ $FormaDePago['MontoPago'] }}</MontoPago>
                            @endif
                        </FormaDePago>
                    @endforeach
                </TablaFormasPago>
            @endif
            @if (isset($IdDoc['TipoCuentaPago']))
                <TipoCuentaPago>{{ $IdDoc['TipoCuentaPago'] }}</TipoCuentaPago>
            @endif
            @if (isset($IdDoc['NumeroCuentaPago']))
                <NumeroCuentaPago>{{ $IdDoc['NumeroCuentaPago'] }}</NumeroCuentaPago>
            @endif
            @if (isset($IdDoc['BancoPago']))
                <BancoPago>{{ $IdDoc['BancoPago'] }}</BancoPago>
            @endif
            @if (isset($IdDoc['FechaDesde']))
                <FechaDesde>{{ $IdDoc['FechaDesde'] }}</FechaDesde>
            @endif
            @if (isset($IdDoc['FechaHasta']))
                <FechaHasta>{{ $IdDoc['FechaHasta'] }}</FechaHasta>
            @endif
            @if (isset($IdDoc['TotalPaginas']))
                <TotalPaginas>{{ $IdDoc['TotalPaginas'] }}</TotalPaginas>
            @endif
        </IdDoc>
        <Emisor>
            @if (isset($Emisor['RNCEmisor']))
                <RNCEmisor>{{ $Emisor['RNCEmisor'] }}</RNCEmisor>
            @endif
            @if (isset($Emisor['RazonSocialEmisor']))
                <RazonSocialEmisor>{{ $Emisor['RazonSocialEmisor'] }}</RazonSocialEmisor>
            @endif
            @if (isset($Emisor['NombreComercial']))
                <NombreComercial>{{ $Emisor['NombreComercial'] }}</NombreComercial>
            @endif
            @if (isset($Emisor['Sucursal']))
                <Sucursal>{{ $Emisor['Sucursal'] }}</Sucursal>
            @endif
            @if (isset($Emisor['DireccionEmisor']))
                <DireccionEmisor>{{ $Emisor['DireccionEmisor'] }}</DireccionEmisor>
            @endif
            @if (isset($Emisor['Municipio']))
                <Municipio>{{ $Emisor['Municipio'] }}</Municipio>
            @endif
            @if (isset($Emisor['Provincia']))
                <Provincia>{{ $Emisor['Provincia'] }}</Provincia>
            @endif
            @if (!empty($Emisor['TablaTelefonoEmisor']))
                <TablaTelefonoEmisor>
                    @foreach ($Emisor['TablaTelefonoEmisor'] as $TelefonoEmisor)
                        <TelefonoEmisor>{{ $TelefonoEmisor['TelefonoEmisor'] }}</TelefonoEmisor>
                    @endforeach
                </TablaTelefonoEmisor>
            @endif
            @if (isset($Emisor['CorreoEmisor']))
                <CorreoEmisor>{{ $Emisor['CorreoEmisor'] }}</CorreoEmisor>
            @endif
            @if (isset($Emisor['WebSite']))
                <WebSite>{{ $Emisor['WebSite'] }}</WebSite>
            @endif
            @if (isset($Emisor['ActividadEconomica']))
                <ActividadEconomica>{{ $Emisor['ActividadEconomica'] }}</ActividadEconomica>
            @endif
            @if (isset($Emisor['NumeroFacturaInterna']))
                <NumeroFacturaInterna>{{ $Emisor['NumeroFacturaInterna'] }}</NumeroFacturaInterna>
            @endif
            @if (isset($Emisor['NumeroPedidoInterno']))
                <NumeroPedidoInterno>{{ $Emisor['NumeroPedidoInterno'] }}</NumeroPedidoInterno>
            @endif
            @if (isset($Emisor['InformacionAdicionalEmisor']))
                <InformacionAdicionalEmisor>{{ $Emisor['InformacionAdicionalEmisor'] }}</InformacionAdicionalEmisor>
            @endif
            @if (isset($Emisor['FechaEmision']))
                <FechaEmision>{{ $Emisor['FechaEmision'] }}</FechaEmision>
            @endif
        </Emisor>
        @if (!empty($Comprador))
            <Comprador>
                @if (isset($Comprador['IdentificadorExtranjero']))
                    <IdentificadorExtranjero>{{ $Comprador['IdentificadorExtranjero'] }}</IdentificadorExtranjero>
                @endif
                @if (isset($Comprador['RazonSocialComprador']))
                    <RazonSocialComprador>{{ $Comprador['RazonSocialComprador'] }}</RazonSocialComprador>
                @endif
            </Comprador>
        @endif
        @if (!empty($Transporte))
            <Transporte>
                @if (isset($Transporte['PaisDestino']))
                    <PaisDestino>{{ $Transporte['PaisDestino'] }}</PaisDestino>
                @endif
            </Transporte>
        @endif
        <Totales>
            @if (isset($Totales['MontoExento']))
                <MontoExento>{{ $Totales['MontoExento'] }}</MontoExento>
            @endif
            @if (isset($Totales['MontoTotal']))
                <MontoTotal>{{ $Totales['MontoTotal'] }}</MontoTotal>
            @endif
            @if (isset($Totales['MontoPeriodo']))
                <MontoPeriodo>{{ $Totales['MontoPeriodo'] }}</MontoPeriodo>
            @endif
            @if (isset($Totales['SaldoAnterior']))
                <SaldoAnterior>{{ $Totales['SaldoAnterior'] }}</SaldoAnterior>
            @endif
            @if (isset($Totales['MontoAvancePago']))
                <MontoAvancePago>{{ $Totales['MontoAvancePago'] }}</MontoAvancePago>
            @endif
            @if (isset($Totales['ValorPagar']))
                <ValorPagar>{{ $Totales['ValorPagar'] }}</ValorPagar>
            @endif
            @if (isset($Totales['TotalISRRetencion']))
                <TotalISRRetencion>{{ $Totales['TotalISRRetencion'] }}</TotalISRRetencion>
            @endif
        </Totales>
        @if (!empty($OtraMoneda))
            <OtraMoneda>
                @if (isset($OtraMoneda['TipoMoneda']))
                    <TipoMoneda>{{ $OtraMoneda['TipoMoneda'] }}</TipoMoneda>
                @endif
                @if (isset($OtraMoneda['TipoCambio']))
                    <TipoCambio>{{ $OtraMoneda['TipoCambio'] }}</TipoCambio>
                @endif
                @if (isset($OtraMoneda['MontoExentoOtraMoneda']))
                    <MontoExentoOtraMoneda>{{ $OtraMoneda['MontoExentoOtraMoneda'] }}</MontoExentoOtraMoneda>
                @endif
                @if (isset($OtraMoneda['MontoTotalOtraMoneda']))
                    <MontoTotalOtraMoneda>{{ $OtraMoneda['MontoTotalOtraMoneda'] }}</MontoTotalOtraMoneda>
                @endif
            </OtraMoneda>
        @endif
    </Encabezado>
    <DetallesItems>
        @foreach ($DetallesItems as $Item)
            <Item>
                @if (isset($Item['NumeroLinea']))
                    <NumeroLinea>{{ $Item['NumeroLinea'] }}</NumeroLinea>
                @endif
                @if (!empty($Item['TablaCodigosItem']))
                    <TablaCodigosItem>
                        @foreach ($Item['TablaCodigosItem'] as $CodigosItem)
                            <CodigosItem>
                                @if (isset($CodigosItem['TipoCodigo']))
                                    <TipoCodigo>{{ $CodigosItem['TipoCodigo'] }}</TipoCodigo>
                                @endif
                                @if (isset($CodigosItem['CodigoItem']))
                                    <CodigoItem>{{ $CodigosItem['CodigoItem'] }}</CodigoItem>
                                @endif
                            </CodigosItem>
                        @endforeach
                    </TablaCodigosItem>
                @endif
                @if (isset($Item['IndicadorFacturacion']))
                    <IndicadorFacturacion>{{ $Item['IndicadorFacturacion'] }}</IndicadorFacturacion>
                @endif
                @if (!empty($Item['Retencion']))
                    <Retencion>
                        @if (isset($Item['Retencion']['IndicadorAgenteRetencionoPercepcion']))
                            <IndicadorAgenteRetencionoPercepcion>{{ $Item['Retencion']['IndicadorAgenteRetencionoPercepcion'] }}</IndicadorAgenteRetencionoPercepcion>
                        @endif
                        @if (isset($Item['Retencion']['MontoISRRetenido']))
                            <MontoISRRetenido>{{ $Item['Retencion']['MontoISRRetenido'] }}</MontoISRRetenido>
                        @endif
                    </Retencion>
                @endif
                @if (isset($Item['NombreItem']))
                    <NombreItem>{{ $Item['NombreItem'] }}</NombreItem>
                @endif
                @if (isset($Item['IndicadorBienoServicio']))
                    <IndicadorBienoServicio>{{ $Item['IndicadorBienoServicio'] }}</IndicadorBienoServicio>
                @endif
                @if (isset($Item['DescripcionItem']))
                    <DescripcionItem>{{ $Item['DescripcionItem'] }}</DescripcionItem>
                @endif
                @if (isset($Item['CantidadItem']))
                    <CantidadItem>{{ $Item['CantidadItem'] }}</CantidadItem>
                @endif
                @if (isset($Item['UnidadMedida']))
                    <UnidadMedida>{{ $Item['UnidadMedida'] }}</UnidadMedida>
                @endif
                @if (isset($Item['PrecioUnitarioItem']))
                    <PrecioUnitarioItem>{{ $Item['PrecioUnitarioItem'] }}</PrecioUnitarioItem>
                @endif
                @if (!empty($Item['OtraMonedaDetalle']))
                    <OtraMonedaDetalle>
                        @if (isset($Item['OtraMonedaDetalle']['PrecioOtraMoneda']))
                            <PrecioOtraMoneda>{{ $Item['OtraMonedaDetalle']['PrecioOtraMoneda'] }}</PrecioOtraMoneda>
                        @endif
                        @if (isset($Item['OtraMonedaDetalle']['DescuentoOtraMoneda']))
                            <DescuentoOtraMoneda>{{ $Item['OtraMonedaDetalle']['DescuentoOtraMoneda'] }}</DescuentoOtraMoneda>
                        @endif
                        @if (isset($Item['OtraMonedaDetalle']['RecargoOtraMoneda']))
                            <RecargoOtraMoneda>{{ $Item['OtraMonedaDetalle']['RecargoOtraMoneda'] }}</RecargoOtraMoneda>
                        @endif
                        @if (isset($Item['OtraMonedaDetalle']['MontoItemOtraMoneda']))
                            <MontoItemOtraMoneda>{{ $Item['OtraMonedaDetalle']['MontoItemOtraMoneda'] }}</MontoItemOtraMoneda>
                        @endif
                    </OtraMonedaDetalle>
                @endif
                @if (isset($Item['MontoItem']))
                    <MontoItem>{{ $Item['MontoItem'] }}</MontoItem>
                @endif
            </Item>
        @endforeach
    </DetallesItems>
    @if (!empty($Subtotales))
        <Subtotales>
            @foreach ($Subtotales as $Subtotal)
                <Subtotal>
                    @if (isset($Subtotal['NumeroSubTotal']))
                        <NumeroSubTotal>{{ $Subtotal['NumeroSubTotal'] }}</NumeroSubTotal>
                    @endif
                    @if (isset($Subtotal['DescripcionSubtotal']))
                        <DescripcionSubtotal>{{ $Subtotal['DescripcionSubtotal'] }}</DescripcionSubtotal>
                    @endif
                    @if (isset($Subtotal['Orden']))
                        <Orden>{{ $Subtotal['Orden'] }}</Orden>
                    @endif
                    @if (isset($Subtotal['SubTotalExento']))
                        <SubTotalExento>{{ $Subtotal['SubTotalExento'] }}</SubTotalExento>
                    @endif
                    @if (isset($Subtotal['MontoSubTotal']))
                        <MontoSubTotal>{{ $Subtotal['MontoSubTotal'] }}</MontoSubTotal>
                    @endif
                    @if (isset($Subtotal['Lineas']))
                        <Lineas>{{ $Subtotal['Lineas'] }}</Lineas>
                    @endif
                </Subtotal>
            @endforeach
        </Subtotales>
    @endif
    @if (!empty($Paginacion))
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
