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
            @isset($IdDoc['IndicadorEnvioDiferido'])
                <IndicadorEnvioDiferido>{{ $IdDoc['IndicadorEnvioDiferido'] }}</IndicadorEnvioDiferido>
            @endisset
            @isset($IdDoc['IndicadorMontoGravado'])
                <IndicadorMontoGravado>{{ $IdDoc['IndicadorMontoGravado'] }}</IndicadorMontoGravado>
            @endisset
            @isset($IdDoc['IndicadorServicioTodoIncluido'])
                <IndicadorServicioTodoIncluido>{{ $IdDoc['IndicadorServicioTodoIncluido'] }}</IndicadorServicioTodoIncluido>
            @endisset
            @isset($IdDoc['TipoIngresos'])
                <TipoIngresos>{{ $IdDoc['TipoIngresos'] }}</TipoIngresos>
            @endisset
            @isset($IdDoc['TipoPago'])
                <TipoPago>{{ $IdDoc['TipoPago'] }}</TipoPago>
            @endisset
            @isset($IdDoc['FechaLimitePago'])
                <FechaLimitePago>{{ $IdDoc['FechaLimitePago'] }}</FechaLimitePago>
            @endisset
            @isset($IdDoc['TerminoPago'])
                <TerminoPago>{{ $IdDoc['TerminoPago'] }}</TerminoPago>
            @endisset
            @if(!empty($IdDoc['TablaFormasPago']))
                <TablaFormasPago>
                    @foreach($IdDoc['TablaFormasPago'] as $FormaDePago)
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
            @isset($IdDoc['TipoCuentaPago'])
                <TipoCuentaPago>{{ $IdDoc['TipoCuentaPago'] }}</TipoCuentaPago>
            @endisset
            @isset($IdDoc['NumeroCuentaPago'])
                <NumeroCuentaPago>{{ $IdDoc['NumeroCuentaPago'] }}</NumeroCuentaPago>
            @endisset
            @isset($IdDoc['BancoPago'])
                <BancoPago>{{ $IdDoc['BancoPago'] }}</BancoPago>
            @endisset
            @isset($IdDoc['FechaDesde'])
                <FechaDesde>{{ $IdDoc['FechaDesde'] }}</FechaDesde>
            @endisset
            @isset($IdDoc['FechaHasta'])
                <FechaHasta>{{ $IdDoc['FechaHasta'] }}</FechaHasta>
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
                    @foreach($Emisor['TablaTelefonoEmisor'] as $TelefonoEmisor)
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
            @isset($Emisor['CodigoVendedor'])
                <CodigoVendedor>{{ $Emisor['CodigoVendedor'] }}</CodigoVendedor>
            @endisset
            @isset($Emisor['NumeroFacturaInterna'])
                <NumeroFacturaInterna>{{ $Emisor['NumeroFacturaInterna'] }}</NumeroFacturaInterna>
            @endisset
            @isset($Emisor['NumeroPedidoInterno'])
                <NumeroPedidoInterno>{{ $Emisor['NumeroPedidoInterno'] }}</NumeroPedidoInterno>
            @endisset
            @isset($Emisor['ZonaVenta'])
                <ZonaVenta>{{ $Emisor['ZonaVenta'] }}</ZonaVenta>
            @endisset
            @isset($Emisor['RutaVenta'])
                <RutaVenta>{{ $Emisor['RutaVenta'] }}</RutaVenta>
            @endisset
            @isset($Emisor['InformacionAdicionalEmisor'])
                <InformacionAdicionalEmisor>{{ $Emisor['InformacionAdicionalEmisor'] }}</InformacionAdicionalEmisor>
            @endisset
            @isset($Emisor['FechaEmision'])
                <FechaEmision>{{ $Emisor['FechaEmision'] }}</FechaEmision>
            @endisset
        </Emisor>
        <Comprador>
            @isset($Comprador['RNCComprador'])
                <RNCComprador>{{ $Comprador['RNCComprador'] }}</RNCComprador>
            @endisset
            @isset($Comprador['RazonSocialComprador'])
                <RazonSocialComprador>{{ $Comprador['RazonSocialComprador'] }}</RazonSocialComprador>
            @endisset
            @isset($Comprador['ContactoComprador'])
                <ContactoComprador>{{ $Comprador['ContactoComprador'] }}</ContactoComprador>
            @endisset
            @isset($Comprador['CorreoComprador'])
                <CorreoComprador>{{ $Comprador['CorreoComprador'] }}</CorreoComprador>
            @endisset
            @isset($Comprador['DireccionComprador'])
                <DireccionComprador>{{ $Comprador['DireccionComprador'] }}</DireccionComprador>
            @endisset
            @isset($Comprador['MunicipioComprador'])
                <MunicipioComprador>{{ $Comprador['MunicipioComprador'] }}</MunicipioComprador>
            @endisset
            @isset($Comprador['ProvinciaComprador'])
                <ProvinciaComprador>{{ $Comprador['ProvinciaComprador'] }}</ProvinciaComprador>
            @endisset
            @isset($Comprador['FechaEntrega'])
                <FechaEntrega>{{ $Comprador['FechaEntrega'] }}</FechaEntrega>
            @endisset
            @isset($Comprador['ContactoEntrega'])
                <ContactoEntrega>{{ $Comprador['ContactoEntrega'] }}</ContactoEntrega>
            @endisset
            @isset($Comprador['DireccionEntrega'])
                <DireccionEntrega>{{ $Comprador['DireccionEntrega'] }}</DireccionEntrega>
            @endisset
            @isset($Comprador['TelefonoAdicional'])
                <TelefonoAdicional>{{ $Comprador['TelefonoAdicional'] }}</TelefonoAdicional>
            @endisset
            @isset($Comprador['FechaOrdenCompra'])
                <FechaOrdenCompra>{{ $Comprador['FechaOrdenCompra'] }}</FechaOrdenCompra>
            @endisset
            @isset($Comprador['NumeroOrdenCompra'])
                <NumeroOrdenCompra>{{ $Comprador['NumeroOrdenCompra'] }}</NumeroOrdenCompra>
            @endisset
            @isset($Comprador['CodigoInternoComprador'])
                <CodigoInternoComprador>{{ $Comprador['CodigoInternoComprador'] }}</CodigoInternoComprador>
            @endisset
            @isset($Comprador['ResponsablePago'])
                <ResponsablePago>{{ $Comprador['ResponsablePago'] }}</ResponsablePago>
            @endisset
            @isset($Comprador['InformacionAdicionalComprador'])
                <InformacionAdicionalComprador>{{ $Comprador['InformacionAdicionalComprador'] }}</InformacionAdicionalComprador>
            @endisset
        </Comprador>
        @if(!empty($InformacionesAdicionales))
            <InformacionesAdicionales>
                @isset($InformacionesAdicionales['FechaEmbarque'])
                    <FechaEmbarque>{{ $InformacionesAdicionales['FechaEmbarque'] }}</FechaEmbarque>
                @endisset
                @isset($InformacionesAdicionales['NumeroEmbarque'])
                    <NumeroEmbarque>{{ $InformacionesAdicionales['NumeroEmbarque'] }}</NumeroEmbarque>
                @endisset
                @isset($InformacionesAdicionales['NumeroContenedor'])
                    <NumeroContenedor>{{ $InformacionesAdicionales['NumeroContenedor'] }}</NumeroContenedor>
                @endisset
                @isset($InformacionesAdicionales['NumeroReferencia'])
                    <NumeroReferencia>{{ $InformacionesAdicionales['NumeroReferencia'] }}</NumeroReferencia>
                @endisset
                @isset($InformacionesAdicionales['PesoBruto'])
                    <PesoBruto>{{ $InformacionesAdicionales['PesoBruto'] }}</PesoBruto>
                @endisset
                @isset($InformacionesAdicionales['PesoNeto'])
                    <PesoNeto>{{ $InformacionesAdicionales['PesoNeto'] }}</PesoNeto>
                @endisset
                @isset($InformacionesAdicionales['UnidadPesoBruto'])
                    <UnidadPesoBruto>{{ $InformacionesAdicionales['UnidadPesoBruto'] }}</UnidadPesoBruto>
                @endisset
                @isset($InformacionesAdicionales['UnidadPesoNeto'])
                    <UnidadPesoNeto>{{ $InformacionesAdicionales['UnidadPesoNeto'] }}</UnidadPesoNeto>
                @endisset
                @isset($InformacionesAdicionales['CantidadBulto'])
                    <CantidadBulto>{{ $InformacionesAdicionales['CantidadBulto'] }}</CantidadBulto>
                @endisset
                @isset($InformacionesAdicionales['UnidadBulto'])
                    <UnidadBulto>{{ $InformacionesAdicionales['UnidadBulto'] }}</UnidadBulto>
                @endisset
                @isset($InformacionesAdicionales['VolumenBulto'])
                    <VolumenBulto>{{ $InformacionesAdicionales['VolumenBulto'] }}</VolumenBulto>
                @endisset
                @isset($InformacionesAdicionales['UnidadVolumen'])
                    <UnidadVolumen>{{ $InformacionesAdicionales['UnidadVolumen'] }}</UnidadVolumen>
                @endisset
            </InformacionesAdicionales>
        @endif
        @if(!empty($Transporte))
            <Transporte>
                @isset($Transporte['Conductor'])
                    <Conductor>{{ $Transporte['Conductor'] }}</Conductor>
                @endisset
                @isset($Transporte['DocumentoTransporte'])
                    <DocumentoTransporte>{{ $Transporte['DocumentoTransporte'] }}</DocumentoTransporte>
                @endisset
                @isset($Transporte['Ficha'])
                    <Ficha>{{ $Transporte['Ficha'] }}</Ficha>
                @endisset
                @isset($Transporte['Placa'])
                    <Placa>{{ $Transporte['Placa'] }}</Placa>
                @endisset
                @isset($Transporte['RutaTransporte'])
                    <RutaTransporte>{{ $Transporte['RutaTransporte'] }}</RutaTransporte>
                @endisset
                @isset($Transporte['ZonaTransporte'])
                    <ZonaTransporte>{{ $Transporte['ZonaTransporte'] }}</ZonaTransporte>
                @endisset
                @isset($Transporte['NumeroAlbaran'])
                    <NumeroAlbaran>{{ $Transporte['NumeroAlbaran'] }}</NumeroAlbaran>
                @endisset
            </Transporte>
        @endif
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
            @isset($Totales['ITBIS1'])
                <ITBIS1>{{ $Totales['ITBIS1'] }}</ITBIS1>
            @endisset
            @isset($Totales['ITBIS2'])
                <ITBIS2>{{ $Totales['ITBIS2'] }}</ITBIS2>
            @endisset
            @isset($Totales['ITBIS3'])
                <ITBIS3>{{ $Totales['ITBIS3'] }}</ITBIS3>
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
                    @foreach($Totales['ImpuestosAdicionales'] as $ImpuestoAdicional)
                        <ImpuestoAdicional>
                            @isset($ImpuestoAdicional['TipoImpuesto'])
                                <TipoImpuesto>{{ $ImpuestoAdicional['TipoImpuesto'] }}</TipoImpuesto>
                            @endisset
                            @isset($ImpuestoAdicional['TasaImpuestoAdicional'])
                                <TasaImpuestoAdicional>{{ $ImpuestoAdicional['TasaImpuestoAdicional'] }}</TasaImpuestoAdicional>
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
            @isset($Totales['SaldoAnterior'])
                <SaldoAnterior>{{ $Totales['SaldoAnterior'] }}</SaldoAnterior>
            @endisset
            @isset($Totales['MontoAvancePago'])
                <MontoAvancePago>{{ $Totales['MontoAvancePago'] }}</MontoAvancePago>
            @endisset
            @isset($Totales['ValorPagar'])
                <ValorPagar>{{ $Totales['ValorPagar'] }}</ValorPagar>
            @endisset
            @isset($Totales['TotalITBISRetenido'])
                <TotalITBISRetenido>{{ $Totales['TotalITBISRetenido'] }}</TotalITBISRetenido>
            @endisset
            @isset($Totales['TotalISRRetencion'])
                <TotalISRRetencion>{{ $Totales['TotalISRRetencion'] }}</TotalISRRetencion>
            @endisset
            @isset($Totales['TotalITBISPercepcion'])
                <TotalITBISPercepcion>{{ $Totales['TotalITBISPercepcion'] }}</TotalITBISPercepcion>
            @endisset
            @isset($Totales['TotalISRPercepcion'])
                <TotalISRPercepcion>{{ $Totales['TotalISRPercepcion'] }}</TotalISRPercepcion>
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
                @isset($OtraMoneda['MontoGravadoTotalOtraMoneda'])
                    <MontoGravadoTotalOtraMoneda>{{ $OtraMoneda['MontoGravadoTotalOtraMoneda'] }}</MontoGravadoTotalOtraMoneda>
                @endisset
                @isset($OtraMoneda['MontoGravado1OtraMoneda'])
                    <MontoGravado1OtraMoneda>{{ $OtraMoneda['MontoGravado1OtraMoneda'] }}</MontoGravado1OtraMoneda>
                @endisset
                @isset($OtraMoneda['MontoGravado2OtraMoneda'])
                    <MontoGravado2OtraMoneda>{{ $OtraMoneda['MontoGravado2OtraMoneda'] }}</MontoGravado2OtraMoneda>
                @endisset
                @isset($OtraMoneda['MontoGravado3OtraMoneda'])
                    <MontoGravado3OtraMoneda>{{ $OtraMoneda['MontoGravado3OtraMoneda'] }}</MontoGravado3OtraMoneda>
                @endisset
                @isset($OtraMoneda['MontoExentoOtraMoneda'])
                    <MontoExentoOtraMoneda>{{ $OtraMoneda['MontoExentoOtraMoneda'] }}</MontoExentoOtraMoneda>
                @endisset
                @isset($OtraMoneda['TotalITBISOtraMoneda'])
                    <TotalITBISOtraMoneda>{{ $OtraMoneda['TotalITBISOtraMoneda'] }}</TotalITBISOtraMoneda>
                @endisset
                @isset($OtraMoneda['TotalITBIS1OtraMoneda'])
                    <TotalITBIS1OtraMoneda>{{ $OtraMoneda['TotalITBIS1OtraMoneda'] }}</TotalITBIS1OtraMoneda>
                @endisset
                @isset($OtraMoneda['TotalITBIS2OtraMoneda'])
                    <TotalITBIS2OtraMoneda>{{ $OtraMoneda['TotalITBIS2OtraMoneda'] }}</TotalITBIS2OtraMoneda>
                @endisset
                @isset($OtraMoneda['TotalITBIS3OtraMoneda'])
                    <TotalITBIS3OtraMoneda>{{ $OtraMoneda['TotalITBIS3OtraMoneda'] }}</TotalITBIS3OtraMoneda>
                @endisset
                @isset($OtraMoneda['MontoImpuestoAdicionalOtraMoneda'])
                    <MontoImpuestoAdicionalOtraMoneda>{{ $OtraMoneda['MontoImpuestoAdicionalOtraMoneda'] }}</MontoImpuestoAdicionalOtraMoneda>
                @endisset
                @if(!empty($OtraMoneda['ImpuestosAdicionalesOtraMoneda']))
                    <ImpuestosAdicionalesOtraMoneda>
                        @foreach($OtraMoneda['ImpuestosAdicionalesOtraMoneda'] as $ImpuestoAdicionalOtraMoneda)
                            <ImpuestoAdicionalOtraMoneda>
                                @isset($ImpuestoAdicionalOtraMoneda['TipoImpuestoOtraMoneda'])
                                    <TipoImpuestoOtraMoneda>{{ $ImpuestoAdicionalOtraMoneda['TipoImpuestoOtraMoneda'] }}</TipoImpuestoOtraMoneda>
                                @endisset
                                @isset($ImpuestoAdicionalOtraMoneda['TasaImpuestoAdicionalOtraMoneda'])
                                    <TasaImpuestoAdicionalOtraMoneda>{{ $ImpuestoAdicionalOtraMoneda['TasaImpuestoAdicionalOtraMoneda'] }}</TasaImpuestoAdicionalOtraMoneda>
                                @endisset
                                @isset($ImpuestoAdicionalOtraMoneda['MontoImpuestoSelectivoConsumoEspecificoOtraMoneda'])
                                    <MontoImpuestoSelectivoConsumoEspecificoOtraMoneda>{{ $ImpuestoAdicionalOtraMoneda['MontoImpuestoSelectivoConsumoEspecificoOtraMoneda'] }}</MontoImpuestoSelectivoConsumoEspecificoOtraMoneda>
                                @endisset
                                @isset($ImpuestoAdicionalOtraMoneda['MontoImpuestoSelectivoConsumoAdvaloremOtraMoneda'])
                                    <MontoImpuestoSelectivoConsumoAdvaloremOtraMoneda>{{ $ImpuestoAdicionalOtraMoneda['MontoImpuestoSelectivoConsumoAdvaloremOtraMoneda'] }}</MontoImpuestoSelectivoConsumoAdvaloremOtraMoneda>
                                @endisset
                                @isset($ImpuestoAdicionalOtraMoneda['OtrosImpuestosAdicionalesOtraMoneda'])
                                    <OtrosImpuestosAdicionalesOtraMoneda>{{ $ImpuestoAdicionalOtraMoneda['OtrosImpuestosAdicionalesOtraMoneda'] }}</OtrosImpuestosAdicionalesOtraMoneda>
                                @endisset
                            </ImpuestoAdicionalOtraMoneda>
                        @endforeach
                    </ImpuestosAdicionalesOtraMoneda>
                @endif
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
                                <TipoCodigo>{{ $CodigosItem['TipoCodigo'] }}</TipoCodigo>
                                <CodigoItem>{{ $CodigosItem['CodigoItem'] }}</CodigoItem>
                            </CodigosItem>
                        @endforeach
                    </TablaCodigosItem>
                @endif
                @isset($Item['IndicadorFacturacion'])
                    <IndicadorFacturacion>{{ $Item['IndicadorFacturacion'] }}</IndicadorFacturacion>
                @endisset
                @if(!empty($Item['Retencion']))
                    <Retencion>
                        @isset($Item['Retencion']['IndicadorAgenteRetencionoPercepcion'])
                            <IndicadorAgenteRetencionoPercepcion>{{ $Item['Retencion']['IndicadorAgenteRetencionoPercepcion'] }}</IndicadorAgenteRetencionoPercepcion>
                        @endisset
                        @isset($Item['Retencion']['MontoITBISRetenido'])
                            <MontoITBISRetenido>{{ $Item['Retencion']['MontoITBISRetenido'] }}</MontoITBISRetenido>
                        @endisset
                        @isset($Item['Retencion']['MontoISRRetenido'])
                            <MontoISRRetenido>{{ $Item['Retencion']['MontoISRRetenido'] }}</MontoISRRetenido>
                        @endisset
                    </Retencion>
                @endif
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
                @isset($Item['CantidadReferencia'])
                    <CantidadReferencia>{{ $Item['CantidadReferencia'] }}</CantidadReferencia>
                @endisset
                @isset($Item['UnidadReferencia'])
                    <UnidadReferencia>{{ $Item['UnidadReferencia'] }}</UnidadReferencia>
                @endisset
                @isset($Item['TablaSubcantidad'])
                    <TablaSubcantidad>
                        @foreach($Item['TablaSubcantidad'] as $SubcantidadItem)
                            <SubcantidadItem>
                                @isset($SubcantidadItem['Subcantidad'])
                                    <Subcantidad>{{ $SubcantidadItem['Subcantidad'] }}</Subcantidad>
                                @endisset
                                @isset($SubcantidadItem['CodigoSubcantidad'])
                                    <CodigoSubcantidad>{{ $SubcantidadItem['CodigoSubcantidad'] }}</CodigoSubcantidad>
                                @endisset
                            </SubcantidadItem>
                        @endforeach
                    </TablaSubcantidad>
                @endisset
                @isset($Item['GradosAlcohol'])
                    <GradosAlcohol>{{ $Item['GradosAlcohol'] }}</GradosAlcohol>
                @endisset
                @isset($Item['FechaElaboracion'])
                    <FechaElaboracion>{{ $Item['FechaElaboracion'] }}</FechaElaboracion>
                @endisset
                @isset($Item['FechaVencimientoItem'])
                    <FechaVencimientoItem>{{ $Item['FechaVencimientoItem'] }}</FechaVencimientoItem>
                @endisset
                @isset($Item['PrecioUnitarioReferencia'])
                    <PrecioUnitarioReferencia>{{ $Item['PrecioUnitarioReferencia'] }}</PrecioUnitarioReferencia>
                @endisset
                @isset($Item['PrecioUnitarioItem'])
                    <PrecioUnitarioItem>{{ $Item['PrecioUnitarioItem'] }}</PrecioUnitarioItem>
                @endisset
                @isset($Item['DescuentoMonto'])
                    <DescuentoMonto>{{ $Item['DescuentoMonto'] }}</DescuentoMonto>
                @endisset
                @if(!empty($Item['TablaSubDescuento']))
                    <TablaSubDescuento>
                        @foreach ($Item['TablaSubDescuento'] as $SubDescuento)
                            <SubDescuento>
                                <TipoSubDescuento>{{ $SubDescuento['TipoSubDescuento'] }}</TipoSubDescuento>
                                @isset($SubDescuento['SubDescuentoPorcentaje'])
                                    <SubDescuentoPorcentaje>{{ $SubDescuento['SubDescuentoPorcentaje'] }}</SubDescuentoPorcentaje>
                                @endisset
                                @isset($SubDescuento['MontoSubDescuento'])
                                    <MontoSubDescuento>{{ $SubDescuento['MontoSubDescuento'] }}</MontoSubDescuento>
                                @endisset
                            </SubDescuento>
                        @endforeach
                    </TablaSubDescuento>
                @endif
                @isset($Item['RecargoMonto'])
                    <RecargoMonto>{{ $Item['RecargoMonto'] }}</RecargoMonto>
                @endisset
                @if(!empty($Item['TablaSubRecargo']))
                    <TablaSubRecargo>
                        @foreach ($Item['TablaSubRecargo'] as $SubRecargo)
                            <SubRecargo>
                                <TipoSubRecargo>{{ $SubRecargo['TipoSubRecargo'] }}</TipoSubRecargo>
                                @isset($SubRecargo['SubRecargoPorcentaje'])
                                    <SubRecargoPorcentaje>{{ $SubRecargo['SubRecargoPorcentaje'] }}</SubRecargoPorcentaje>
                                @endisset
                                @isset($SubRecargo['MontoSubRecargo'])
                                    <MontoSubRecargo>{{ $SubRecargo['MontoSubRecargo'] }}</MontoSubRecargo>
                                @endisset
                            </SubRecargo>
                        @endforeach
                    </TablaSubRecargo>
                @endif
                @isset($Item['TablaImpuestoAdicional'])
                    <TablaImpuestoAdicional>
                        @foreach($Item['TablaImpuestoAdicional'] as $ImpuestoAdicional)
                            <ImpuestoAdicional>
                                @isset($ImpuestoAdicional['TipoImpuesto'])
                                    <TipoImpuesto>{{ $ImpuestoAdicional['TipoImpuesto'] }}</TipoImpuesto>
                                @endisset
                            </ImpuestoAdicional>
                        @endforeach
                    </TablaImpuestoAdicional>
                @endisset
                @if(!empty($Item['OtraMonedaDetalle']))
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
                @endif
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
                    @isset($Subtotal['NumeroSubTotal'])
                        <NumeroSubTotal>{{ $Subtotal['NumeroSubTotal'] }}</NumeroSubTotal>
                    @endisset
                    @isset($Subtotal['DescripcionSubtotal'])
                        <DescripcionSubtotal>{{ $Subtotal['DescripcionSubtotal'] }}</DescripcionSubtotal>
                    @endisset
                    @isset($Subtotal['Orden'])
                        <Orden>{{ $Subtotal['Orden'] }}</Orden>
                    @endisset
                    @isset($Subtotal['SubTotalMontoGravadoTotal'])
                        <SubTotalMontoGravadoTotal>{{ $Subtotal['SubTotalMontoGravadoTotal'] }}</SubTotalMontoGravadoTotal>
                    @endisset
                    @isset($Subtotal['SubTotalMontoGravadoI1'])
                        <SubTotalMontoGravadoI1>{{ $Subtotal['SubTotalMontoGravadoI1'] }}</SubTotalMontoGravadoI1>
                    @endisset
                    @isset($Subtotal['SubTotalMontoGravadoI2'])
                        <SubTotalMontoGravadoI2>{{ $Subtotal['SubTotalMontoGravadoI2'] }}</SubTotalMontoGravadoI2>
                    @endisset
                    @isset($Subtotal['SubTotalMontoGravadoI3'])
                        <SubTotalMontoGravadoI3>{{ $Subtotal['SubTotalMontoGravadoI3'] }}</SubTotalMontoGravadoI3>
                    @endisset
                    @isset($Subtotal['SubTotaITBIS'])
                        <SubTotaITBIS>{{ $Subtotal['SubTotaITBIS'] }}</SubTotaITBIS>
                    @endisset
                    @isset($Subtotal['SubTotaITBIS1'])
                        <SubTotaITBIS1>{{ $Subtotal['SubTotaITBIS1'] }}</SubTotaITBIS1>
                    @endisset
                    @isset($Subtotal['SubTotaITBIS2'])
                        <SubTotaITBIS2>{{ $Subtotal['SubTotaITBIS2'] }}</SubTotaITBIS2>
                    @endisset
                    @isset($Subtotal['SubTotaITBIS3'])
                        <SubTotaITBIS3>{{ $Subtotal['SubTotaITBIS3'] }}</SubTotaITBIS3>
                    @endisset
                    @isset($Subtotal['SubTotalImpuestoAdicional'])
                        <SubTotalImpuestoAdicional>{{ $Subtotal['SubTotalImpuestoAdicional'] }}</SubTotalImpuestoAdicional>
                    @endisset
                    @isset($Subtotal['SubTotalExento'])
                        <SubTotalExento>{{ $Subtotal['SubTotalExento'] }}</SubTotalExento>
                    @endisset
                    @isset($Subtotal['MontoSubTotal'])
                        <MontoSubTotal>{{ $Subtotal['MontoSubTotal'] }}</MontoSubTotal>
                    @endisset
                    @isset($Subtotal['Lineas'])
                        <Lineas>{{ $Subtotal['Lineas'] }}</Lineas>
                    @endisset
                </Subtotal>
            @endforeach
        </Subtotales>
    @endif
    @if(!empty($DescuentosORecargos))
        <DescuentosORecargos>
            @foreach ($DescuentosORecargos as $DescuentoORecargo)
                <DescuentoORecargo>
                    @isset($DescuentoORecargo['NumeroLinea'])
                        <NumeroLinea>{{ $DescuentoORecargo['NumeroLinea'] }}</NumeroLinea>
                    @endisset
                    @isset($DescuentoORecargo['TipoAjuste'])
                        <TipoAjuste>{{ $DescuentoORecargo['TipoAjuste'] }}</TipoAjuste>
                    @endisset
                    @isset($DescuentoORecargo['IndicadorNorma1007'])
                        <IndicadorNorma1007>{{ $DescuentoORecargo['IndicadorNorma1007'] }}</IndicadorNorma1007>
                    @endisset
                    @isset($DescuentoORecargo['DescripcionDescuentooRecargo'])
                        <DescripcionDescuentooRecargo>{{ $DescuentoORecargo['DescripcionDescuentooRecargo'] }}</DescripcionDescuentooRecargo>
                    @endisset
                    @isset($DescuentoORecargo['TipoValor'])
                        <TipoValor>{{ $DescuentoORecargo['TipoValor'] }}</TipoValor>
                    @endisset
                    @isset($DescuentoORecargo['ValorDescuentooRecargo'])
                        <ValorDescuentooRecargo>{{ $DescuentoORecargo['ValorDescuentooRecargo'] }}</ValorDescuentooRecargo>
                    @endisset
                    @isset($DescuentoORecargo['MontoDescuentooRecargo'])
                        <MontoDescuentooRecargo>{{ $DescuentoORecargo['MontoDescuentooRecargo'] }}</MontoDescuentooRecargo>
                    @endisset
                    @isset($DescuentoORecargo['MontoDescuentooRecargoOtraMoneda'])
                        <MontoDescuentooRecargoOtraMoneda>{{ $DescuentoORecargo['MontoDescuentooRecargoOtraMoneda'] }}</MontoDescuentooRecargoOtraMoneda>
                    @endisset
                    @isset($DescuentoORecargo['IndicadorFacturacionDescuentooRecargo'])
                        <IndicadorFacturacionDescuentooRecargo>{{ $DescuentoORecargo['IndicadorFacturacionDescuentooRecargo'] }}</IndicadorFacturacionDescuentooRecargo>
                    @endisset
                </DescuentoORecargo>
            @endforeach
        </DescuentosORecargos>
    @endif
    @if(!empty($Paginacion))
        <Paginacion>
            @foreach ($Paginacion as $Pagina)
                <Pagina>
                    @isset($Pagina['PaginaNo'])
                        <PaginaNo>{{ $Pagina['PaginaNo'] }}</PaginaNo>
                    @endisset
                    @isset($Pagina['NoLineaDesde'])
                        <NoLineaDesde>{{ $Pagina['NoLineaDesde'] }}</NoLineaDesde>
                    @endisset
                    @isset($Pagina['NoLineaHasta'])
                        <NoLineaHasta>{{ $Pagina['NoLineaHasta'] }}</NoLineaHasta>
                    @endisset
                    @isset($Pagina['SubtotalMontoGravadoPagina'])
                        <SubtotalMontoGravadoPagina>{{ $Pagina['SubtotalMontoGravadoPagina'] }}</SubtotalMontoGravadoPagina>
                    @endisset
                    @isset($Pagina['SubtotalMontoGravado1Pagina'])
                        <SubtotalMontoGravado1Pagina>{{ $Pagina['SubtotalMontoGravado1Pagina'] }}</SubtotalMontoGravado1Pagina>
                    @endisset
                    @isset($Pagina['SubtotalMontoGravado2Pagina'])
                        <SubtotalMontoGravado2Pagina>{{ $Pagina['SubtotalMontoGravado2Pagina'] }}</SubtotalMontoGravado2Pagina>
                    @endisset
                    @isset($Pagina['SubtotalMontoGravado3Pagina'])
                        <SubtotalMontoGravado3Pagina>{{ $Pagina['SubtotalMontoGravado3Pagina'] }}</SubtotalMontoGravado3Pagina>
                    @endisset
                    @isset($Pagina['SubtotalExentoPagina'])
                        <SubtotalExentoPagina>{{ $Pagina['SubtotalExentoPagina'] }}</SubtotalExentoPagina>
                    @endisset
                    @isset($Pagina['SubtotalItbisPagina'])
                        <SubtotalItbisPagina>{{ $Pagina['SubtotalItbisPagina'] }}</SubtotalItbisPagina>
                    @endisset
                    @isset($Pagina['SubtotalItbis1Pagina'])
                        <SubtotalItbis1Pagina>{{ $Pagina['SubtotalItbis1Pagina'] }}</SubtotalItbis1Pagina>
                    @endisset
                    @isset($Pagina['SubtotalItbis2Pagina'])
                        <SubtotalItbis2Pagina>{{ $Pagina['SubtotalItbis2Pagina'] }}</SubtotalItbis2Pagina>
                    @endisset
                    @isset($Pagina['SubtotalItbis3Pagina'])
                        <SubtotalItbis3Pagina>{{ $Pagina['SubtotalItbis3Pagina'] }}</SubtotalItbis3Pagina>
                    @endisset
                    @isset($Pagina['SubtotalImpuestoAdicionalPagina'])
                        <SubtotalImpuestoAdicionalPagina>{{ $Pagina['SubtotalImpuestoAdicionalPagina'] }}</SubtotalImpuestoAdicionalPagina>
                    @endisset
                    @isset($Pagina['SubtotalImpuestoAdicional'])
                        <SubtotalImpuestoAdicional>
                            @isset($Pagina['SubtotalImpuestoAdicional']['SubtotalImpuestoSelectivoConsumoEspecificoPagina'])
                                <SubtotalImpuestoSelectivoConsumoEspecificoPagina>{{ $Pagina['SubtotalImpuestoAdicional']['SubtotalImpuestoSelectivoConsumoEspecificoPagina'] }}</SubtotalImpuestoSelectivoConsumoEspecificoPagina>
                            @endisset
                            @isset($Pagina['SubtotalImpuestoAdicional']['SubtotalOtrosImpuesto'])
                                <SubtotalOtrosImpuesto>{{ $Pagina['SubtotalImpuestoAdicional']['SubtotalOtrosImpuesto'] }}</SubtotalOtrosImpuesto>
                            @endisset
                        </SubtotalImpuestoAdicional>
                    @endisset
                    @isset($Pagina['MontoSubtotalPagina'])
                        <MontoSubtotalPagina>{{ $Pagina['MontoSubtotalPagina'] }}</MontoSubtotalPagina>
                    @endisset
                    @isset($Pagina['SubtotalMontoNoFacturablePagina'])
                        <SubtotalMontoNoFacturablePagina>{{ $Pagina['SubtotalMontoNoFacturablePagina'] }}</SubtotalMontoNoFacturablePagina>
                    @endisset
                </Pagina>
            @endforeach
        </Paginacion>
    @endif
    @if(!empty($InformacionReferencia))
        <InformacionReferencia>
            @isset($InformacionReferencia['NCFModificado'])
                <NCFModificado>{{ $InformacionReferencia['NCFModificado'] }}</NCFModificado>
            @endisset
            @isset($InformacionReferencia['RNCOtroContribuyente'])
                <RNCOtroContribuyente>{{ $InformacionReferencia['RNCOtroContribuyente'] }}</RNCOtroContribuyente>
            @endisset
            @isset($InformacionReferencia['FechaNCFModificado'])
                <FechaNCFModificado>{{ $InformacionReferencia['FechaNCFModificado'] }}</FechaNCFModificado>
            @endisset
            @isset($InformacionReferencia['CodigoModificacion'])
                <CodigoModificacion>{{ $InformacionReferencia['CodigoModificacion'] }}</CodigoModificacion>
            @endisset
        </InformacionReferencia>
    @endif
    <FechaHoraFirma>{{ $FechaHoraFirma ?? date('d-m-Y H:i:s') }}</FechaHoraFirma>
</ECF>
