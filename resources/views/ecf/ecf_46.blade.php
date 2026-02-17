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
            @if (isset($IdDoc['IndicadorEnvioDiferido']))
                <IndicadorEnvioDiferido>{{ $IdDoc['IndicadorEnvioDiferido'] }}</IndicadorEnvioDiferido>
            @endif
            @if (isset($IdDoc['TipoIngresos']))
                <TipoIngresos>{{ $IdDoc['TipoIngresos'] }}</TipoIngresos>
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
            @if (isset($Emisor['CodigoVendedor']))
                <CodigoVendedor>{{ $Emisor['CodigoVendedor'] }}</CodigoVendedor>
            @endif
            @if (isset($Emisor['NumeroFacturaInterna']))
                <NumeroFacturaInterna>{{ $Emisor['NumeroFacturaInterna'] }}</NumeroFacturaInterna>
            @endif
            @if (isset($Emisor['NumeroPedidoInterno']))
                <NumeroPedidoInterno>{{ $Emisor['NumeroPedidoInterno'] }}</NumeroPedidoInterno>
            @endif
            @if (isset($Emisor['ZonaVenta']))
                <ZonaVenta>{{ $Emisor['ZonaVenta'] }}</ZonaVenta>
            @endif
            @if (isset($Emisor['RutaVenta']))
                <RutaVenta>{{ $Emisor['RutaVenta'] }}</RutaVenta>
            @endif
            @if (isset($Emisor['InformacionAdicionalEmisor']))
                <InformacionAdicionalEmisor>{{ $Emisor['InformacionAdicionalEmisor'] }}</InformacionAdicionalEmisor>
            @endif
            @if (isset($Emisor['FechaEmision']))
                <FechaEmision>{{ $Emisor['FechaEmision'] }}</FechaEmision>
            @endif
        </Emisor>
        <Comprador>
            @if (isset($Comprador['RNCComprador']))
                <RNCComprador>{{ $Comprador['RNCComprador'] }}</RNCComprador>
            @endif
            @if (isset($Comprador['IdentificadorExtranjero']))
                <IdentificadorExtranjero>{{ $Comprador['IdentificadorExtranjero'] }}</IdentificadorExtranjero>
            @endif
            @if (isset($Comprador['RazonSocialComprador']))
                <RazonSocialComprador>{{ $Comprador['RazonSocialComprador'] }}</RazonSocialComprador>
            @endif
            @if (isset($Comprador['ContactoComprador']))
                <ContactoComprador>{{ $Comprador['ContactoComprador'] }}</ContactoComprador>
            @endif
            @if (isset($Comprador['CorreoComprador']))
                <CorreoComprador>{{ $Comprador['CorreoComprador'] }}</CorreoComprador>
            @endif
            @if (isset($Comprador['DireccionComprador']))
                <DireccionComprador>{{ $Comprador['DireccionComprador'] }}</DireccionComprador>
            @endif
            @if (isset($Comprador['MunicipioComprador']))
                <MunicipioComprador>{{ $Comprador['MunicipioComprador'] }}</MunicipioComprador>
            @endif
            @if (isset($Comprador['ProvinciaComprador']))
                <ProvinciaComprador>{{ $Comprador['ProvinciaComprador'] }}</ProvinciaComprador>
            @endif
            @if (isset($Comprador['PaisComprador']))
                <PaisComprador>{{ $Comprador['PaisComprador'] }}</PaisComprador>
            @endif
            @if (isset($Comprador['FechaEntrega']))
                <FechaEntrega>{{ $Comprador['FechaEntrega'] }}</FechaEntrega>
            @endif
            @if (isset($Comprador['ContactoEntrega']))
                <ContactoEntrega>{{ $Comprador['ContactoEntrega'] }}</ContactoEntrega>
            @endif
            @if (isset($Comprador['DireccionEntrega']))
                <DireccionEntrega>{{ $Comprador['DireccionEntrega'] }}</DireccionEntrega>
            @endif
            @if (isset($Comprador['TelefonoAdicional']))
                <TelefonoAdicional>{{ $Comprador['TelefonoAdicional'] }}</TelefonoAdicional>
            @endif
            @if (isset($Comprador['FechaOrdenCompra']))
                <FechaOrdenCompra>{{ $Comprador['FechaOrdenCompra'] }}</FechaOrdenCompra>
            @endif
            @if (isset($Comprador['NumeroOrdenCompra']))
                <NumeroOrdenCompra>{{ $Comprador['NumeroOrdenCompra'] }}</NumeroOrdenCompra>
            @endif
            @if (isset($Comprador['CodigoInternoComprador']))
                <CodigoInternoComprador>{{ $Comprador['CodigoInternoComprador'] }}</CodigoInternoComprador>
            @endif
            @if (isset($Comprador['ResponsablePago']))
                <ResponsablePago>{{ $Comprador['ResponsablePago'] }}</ResponsablePago>
            @endif
            @if (isset($Comprador['InformacionAdicionalComprador']))
                <InformacionAdicionalComprador>{{ $Comprador['InformacionAdicionalComprador'] }}</InformacionAdicionalComprador>
            @endif
        </Comprador>
        @if (!empty($InformacionesAdicionales))
            <InformacionesAdicionales>
                @if (isset($InformacionesAdicionales['FechaEmbarque']))
                    <FechaEmbarque>{{ $InformacionesAdicionales['FechaEmbarque'] }}</FechaEmbarque>
                @endif
                @if (isset($InformacionesAdicionales['NumeroEmbarque']))
                    <NumeroEmbarque>{{ $InformacionesAdicionales['NumeroEmbarque'] }}</NumeroEmbarque>
                @endif
                @if (isset($InformacionesAdicionales['NumeroContenedor']))
                    <NumeroContenedor>{{ $InformacionesAdicionales['NumeroContenedor'] }}</NumeroContenedor>
                @endif
                @if (isset($InformacionesAdicionales['NumeroReferencia']))
                    <NumeroReferencia>{{ $InformacionesAdicionales['NumeroReferencia'] }}</NumeroReferencia>
                @endif
                @if (isset($InformacionesAdicionales['NombrePuertoEmbarque']))
                    <NombrePuertoEmbarque>{{ $InformacionesAdicionales['NombrePuertoEmbarque'] }}</NombrePuertoEmbarque>
                @endif
                @if (isset($InformacionesAdicionales['CondicionesEntrega']))
                    <CondicionesEntrega>{{ $InformacionesAdicionales['CondicionesEntrega'] }}</CondicionesEntrega>
                @endif
                @if (isset($InformacionesAdicionales['TotalFob']))
                    <TotalFob>{{ $InformacionesAdicionales['TotalFob'] }}</TotalFob>
                @endif
                @if (isset($InformacionesAdicionales['Seguro']))
                    <Seguro>{{ $InformacionesAdicionales['Seguro'] }}</Seguro>
                @endif
                @if (isset($InformacionesAdicionales['Flete']))
                    <Flete>{{ $InformacionesAdicionales['Flete'] }}</Flete>
                @endif
                @if (isset($InformacionesAdicionales['OtrosGastos']))
                    <OtrosGastos>{{ $InformacionesAdicionales['OtrosGastos'] }}</OtrosGastos>
                @endif
                @if (isset($InformacionesAdicionales['TotalCif']))
                    <TotalCif>{{ $InformacionesAdicionales['TotalCif'] }}</TotalCif>
                @endif
                @if (isset($InformacionesAdicionales['RegimenAduanero']))
                    <RegimenAduanero>{{ $InformacionesAdicionales['RegimenAduanero'] }}</RegimenAduanero>
                @endif
                @if (isset($InformacionesAdicionales['NombrePuertoSalida']))
                    <NombrePuertoSalida>{{ $InformacionesAdicionales['NombrePuertoSalida'] }}</NombrePuertoSalida>
                @endif
                @if (isset($InformacionesAdicionales['NombrePuertoDesembarque']))
                    <NombrePuertoDesembarque>{{ $InformacionesAdicionales['NombrePuertoDesembarque'] }}</NombrePuertoDesembarque>
                @endif
                @if (isset($InformacionesAdicionales['PesoBruto']))
                    <PesoBruto>{{ $InformacionesAdicionales['PesoBruto'] }}</PesoBruto>
                @endif
                @if (isset($InformacionesAdicionales['PesoNeto']))
                    <PesoNeto>{{ $InformacionesAdicionales['PesoNeto'] }}</PesoNeto>
                @endif
                @if (isset($InformacionesAdicionales['UnidadPesoBruto']))
                    <UnidadPesoBruto>{{ $InformacionesAdicionales['UnidadPesoBruto'] }}</UnidadPesoBruto>
                @endif
                @if (isset($InformacionesAdicionales['UnidadPesoNeto']))
                    <UnidadPesoNeto>{{ $InformacionesAdicionales['UnidadPesoNeto'] }}</UnidadPesoNeto>
                @endif
                @if (isset($InformacionesAdicionales['CantidadBulto']))
                    <CantidadBulto>{{ $InformacionesAdicionales['CantidadBulto'] }}</CantidadBulto>
                @endif
                @if (isset($InformacionesAdicionales['UnidadBulto']))
                    <UnidadBulto>{{ $InformacionesAdicionales['UnidadBulto'] }}</UnidadBulto>
                @endif
                @if (isset($InformacionesAdicionales['VolumenBulto']))
                    <VolumenBulto>{{ $InformacionesAdicionales['VolumenBulto'] }}</VolumenBulto>
                @endif
                @if (isset($InformacionesAdicionales['UnidadVolumen']))
                    <UnidadVolumen>{{ $InformacionesAdicionales['UnidadVolumen'] }}</UnidadVolumen>
                @endif
            </InformacionesAdicionales>
        @endif
        @if (!empty($Transporte))
            <Transporte>
                @if (isset($Transporte['ViaTransporte']))
                    <ViaTransporte>{{ $Transporte['ViaTransporte'] }}</ViaTransporte>
                @endif
                @if (isset($Transporte['PaisOrigen']))
                    <PaisOrigen>{{ $Transporte['PaisOrigen'] }}</PaisOrigen>
                @endif
                @if (isset($Transporte['DireccionDestino']))
                    <DireccionDestino>{{ $Transporte['DireccionDestino'] }}</DireccionDestino>
                @endif
                @if (isset($Transporte['PaisDestino']))
                    <PaisDestino>{{ $Transporte['PaisDestino'] }}</PaisDestino>
                @endif
                @if (isset($Transporte['RNCIdentificacionCompaniaTransportista']))
                    <RNCIdentificacionCompaniaTransportista>{{ $Transporte['RNCIdentificacionCompaniaTransportista'] }}</RNCIdentificacionCompaniaTransportista>
                @endif
                @if (isset($Transporte['NombreCompaniaTransportista']))
                    <NombreCompaniaTransportista>{{ $Transporte['NombreCompaniaTransportista'] }}</NombreCompaniaTransportista>
                @endif
                @if (isset($Transporte['NumeroViaje']))
                    <NumeroViaje>{{ $Transporte['NumeroViaje'] }}</NumeroViaje>
                @endif
                @if (isset($Transporte['Conductor']))
                    <Conductor>{{ $Transporte['Conductor'] }}</Conductor>
                @endif
                @if (isset($Transporte['DocumentoTransporte']))
                    <DocumentoTransporte>{{ $Transporte['DocumentoTransporte'] }}</DocumentoTransporte>
                @endif
                @if (isset($Transporte['Ficha']))
                    <Ficha>{{ $Transporte['Ficha'] }}</Ficha>
                @endif
                @if (isset($Transporte['Placa']))
                    <Placa>{{ $Transporte['Placa'] }}</Placa>
                @endif
                @if (isset($Transporte['RutaTransporte']))
                    <RutaTransporte>{{ $Transporte['RutaTransporte'] }}</RutaTransporte>
                @endif
                @if (isset($Transporte['ZonaTransporte']))
                    <ZonaTransporte>{{ $Transporte['ZonaTransporte'] }}</ZonaTransporte>
                @endif
                @if (isset($Transporte['NumeroAlbaran']))
                    <NumeroAlbaran>{{ $Transporte['NumeroAlbaran'] }}</NumeroAlbaran>
                @endif
            </Transporte>
        @endif
        <Totales>
            @if (isset($Totales['MontoGravadoTotal']))
                <MontoGravadoTotal>{{ $Totales['MontoGravadoTotal'] }}</MontoGravadoTotal>
            @endif
            @if (isset($Totales['MontoGravadoI3']))
                <MontoGravadoI3>{{ $Totales['MontoGravadoI3'] }}</MontoGravadoI3>
            @endif
            @if (isset($Totales['ITBIS3']))
                <ITBIS3>{{ $Totales['ITBIS3'] }}</ITBIS3>
            @endif
            @if (isset($Totales['TotalITBIS']))
                <TotalITBIS>{{ $Totales['TotalITBIS'] }}</TotalITBIS>
            @endif
            @if (isset($Totales['TotalITBIS3']))
                <TotalITBIS3>{{ $Totales['TotalITBIS3'] }}</TotalITBIS3>
            @endif
            @if (isset($Totales['MontoTotal']))
                <MontoTotal>{{ $Totales['MontoTotal'] }}</MontoTotal>
            @endif
            @if (isset($Totales['MontoNoFacturable']))
                <MontoNoFacturable>{{ $Totales['MontoNoFacturable'] }}</MontoNoFacturable>
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
        </Totales>
        @if (!empty($OtraMoneda))
            <OtraMoneda>
                @if (isset($OtraMoneda['TipoMoneda']))
                    <TipoMoneda>{{ $OtraMoneda['TipoMoneda'] }}</TipoMoneda>
                @endif
                @if (isset($OtraMoneda['TipoCambio']))
                    <TipoCambio>{{ $OtraMoneda['TipoCambio'] }}</TipoCambio>
                @endif
                @if (isset($OtraMoneda['MontoGravadoTotalOtraMoneda']))
                    <MontoGravadoTotalOtraMoneda>{{ $OtraMoneda['MontoGravadoTotalOtraMoneda'] }}</MontoGravadoTotalOtraMoneda>
                @endif
                @if (isset($OtraMoneda['MontoGravado3OtraMoneda']))
                    <MontoGravado3OtraMoneda>{{ $OtraMoneda['MontoGravado3OtraMoneda'] }}</MontoGravado3OtraMoneda>
                @endif
                @if (isset($OtraMoneda['TotalITBISOtraMoneda']))
                    <TotalITBISOtraMoneda>{{ $OtraMoneda['TotalITBISOtraMoneda'] }}</TotalITBISOtraMoneda>
                @endif
                @if (isset($OtraMoneda['TotalITBIS3OtraMoneda']))
                    <TotalITBIS3OtraMoneda>{{ $OtraMoneda['TotalITBIS3OtraMoneda'] }}</TotalITBIS3OtraMoneda>
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
                @if (isset($Item['FechaElaboracion']))
                    <FechaElaboracion>{{ $Item['FechaElaboracion'] }}</FechaElaboracion>
                @endif
                @if (isset($Item['FechaVencimientoItem']))
                    <FechaVencimientoItem>{{ $Item['FechaVencimientoItem'] }}</FechaVencimientoItem>
                @endif
                @if (!empty($Item['Mineria']))
                    <Mineria>
                        @if (isset($Item['Mineria']['PesoNetoKilogramo']))
                            <PesoNetoKilogramo>{{ $Item['Mineria']['PesoNetoKilogramo'] }}</PesoNetoKilogramo>
                        @endif
                        @if (isset($Item['Mineria']['PesoNetoMineria']))
                            <PesoNetoMineria>{{ $Item['Mineria']['PesoNetoMineria'] }}</PesoNetoMineria>
                        @endif
                        @if (isset($Item['Mineria']['TipoAfiliacion']))
                            <TipoAfiliacion>{{ $Item['Mineria']['TipoAfiliacion'] }}</TipoAfiliacion>
                        @endif
                        @if (isset($Item['Mineria']['Liquidacion']))
                            <Liquidacion>{{ $Item['Mineria']['Liquidacion'] }}</Liquidacion>
                        @endif
                    </Mineria>
                @endif
                @if (isset($Item['PrecioUnitarioItem']))
                    <PrecioUnitarioItem>{{ $Item['PrecioUnitarioItem'] }}</PrecioUnitarioItem>
                @endif
                @if (isset($Item['DescuentoMonto']))
                    <DescuentoMonto>{{ $Item['DescuentoMonto'] }}</DescuentoMonto>
                @endif
                @if (!empty($Item['TablaSubDescuento']))
                    <TablaSubDescuento>
                        @foreach ($Item['TablaSubDescuento'] as $SubDescuento)
                            <SubDescuento>
                                @if (isset($SubDescuento['TipoSubDescuento']))
                                    <TipoSubDescuento>{{ $SubDescuento['TipoSubDescuento'] }}</TipoSubDescuento>
                                @endif
                                @if (isset($SubDescuento['SubDescuentoPorcentaje']))
                                    <SubDescuentoPorcentaje>{{ $SubDescuento['SubDescuentoPorcentaje'] }}</SubDescuentoPorcentaje>
                                @endif
                                @if (isset($SubDescuento['MontoSubDescuento']))
                                    <MontoSubDescuento>{{ $SubDescuento['MontoSubDescuento'] }}</MontoSubDescuento>
                                @endif
                            </SubDescuento>
                        @endforeach
                    </TablaSubDescuento>
                @endif
                @if (isset($Item['RecargoMonto']))
                    <RecargoMonto>{{ $Item['RecargoMonto'] }}</RecargoMonto>
                @endif
                @if (!empty($Item['TablaSubRecargo']))
                    <TablaSubRecargo>
                        @foreach ($Item['TablaSubRecargo'] as $SubRecargo)
                            <SubRecargo>
                                @if (isset($SubRecargo['TipoSubRecargo']))
                                    <TipoSubRecargo>{{ $SubRecargo['TipoSubRecargo'] }}</TipoSubRecargo>
                                @endif
                                @if (isset($SubRecargo['SubRecargoPorcentaje']))
                                    <SubRecargoPorcentaje>{{ $SubRecargo['SubRecargoPorcentaje'] }}</SubRecargoPorcentaje>
                                @endif
                                @if (isset($SubRecargo['MontoSubRecargo']))
                                    <MontoSubRecargo>{{ $SubRecargo['MontoSubRecargo'] }}</MontoSubRecargo>
                                @endif
                            </SubRecargo>
                        @endforeach
                    </TablaSubRecargo>
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
                    @if (isset($Subtotal['SubTotalMontoGravadoTotal']))
                        <SubTotalMontoGravadoTotal>{{ $Subtotal['SubTotalMontoGravadoTotal'] }}</SubTotalMontoGravadoTotal>
                    @endif
                    @if (isset($Subtotal['SubTotalMontoGravadoI3']))
                        <SubTotalMontoGravadoI3>{{ $Subtotal['SubTotalMontoGravadoI3'] }}</SubTotalMontoGravadoI3>
                    @endif
                    @if (isset($Subtotal['SubTotaITBIS']))
                        <SubTotaITBIS>{{ $Subtotal['SubTotaITBIS'] }}</SubTotaITBIS>
                    @endif
                    @if (isset($Subtotal['SubTotaITBIS3']))
                        <SubTotaITBIS3>{{ $Subtotal['SubTotaITBIS3'] }}</SubTotaITBIS3>
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
    @if (!empty($DescuentosORecargos))
        <DescuentosORecargos>
            @foreach ($DescuentosORecargos as $DescuentoORecargo)
                <DescuentoORecargo>
                    @if (isset($DescuentoORecargo['NumeroLinea']))
                        <NumeroLinea>{{ $DescuentoORecargo['NumeroLinea'] }}</NumeroLinea>
                    @endif
                    @if (isset($DescuentoORecargo['TipoAjuste']))
                        <TipoAjuste>{{ $DescuentoORecargo['TipoAjuste'] }}</TipoAjuste>
                    @endif
                    @if (isset($DescuentoORecargo['DescripcionDescuentooRecargo']))
                        <DescripcionDescuentooRecargo>{{ $DescuentoORecargo['DescripcionDescuentooRecargo'] }}</DescripcionDescuentooRecargo>
                    @endif
                    @if (isset($DescuentoORecargo['TipoValor']))
                        <TipoValor>{{ $DescuentoORecargo['TipoValor'] }}</TipoValor>
                    @endif
                    @if (isset($DescuentoORecargo['ValorDescuentooRecargo']))
                        <ValorDescuentooRecargo>{{ $DescuentoORecargo['ValorDescuentooRecargo'] }}</ValorDescuentooRecargo>
                    @endif
                    @if (isset($DescuentoORecargo['MontoDescuentooRecargo']))
                        <MontoDescuentooRecargo>{{ $DescuentoORecargo['MontoDescuentooRecargo'] }}</MontoDescuentooRecargo>
                    @endif
                    @if (isset($DescuentoORecargo['MontoDescuentooRecargoOtraMoneda']))
                        <MontoDescuentooRecargoOtraMoneda>{{ $DescuentoORecargo['MontoDescuentooRecargoOtraMoneda'] }}</MontoDescuentooRecargoOtraMoneda>
                    @endif
                    @if (isset($DescuentoORecargo['IndicadorFacturacionDescuentooRecargo']))
                        <IndicadorFacturacionDescuentooRecargo>{{ $DescuentoORecargo['IndicadorFacturacionDescuentooRecargo'] }}</IndicadorFacturacionDescuentooRecargo>
                    @endif
                </DescuentoORecargo>
            @endforeach
        </DescuentosORecargos>
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
                    @if (isset($Pagina['SubtotalMontoGravadoPagina']))
                        <SubtotalMontoGravadoPagina>{{ $Pagina['SubtotalMontoGravadoPagina'] }}</SubtotalMontoGravadoPagina>
                    @endif
                    @if (isset($Pagina['SubtotalMontoGravado3Pagina']))
                        <SubtotalMontoGravado3Pagina>{{ $Pagina['SubtotalMontoGravado3Pagina'] }}</SubtotalMontoGravado3Pagina>
                    @endif
                    @if (isset($Pagina['SubtotalItbisPagina']))
                        <SubtotalItbisPagina>{{ $Pagina['SubtotalItbisPagina'] }}</SubtotalItbisPagina>
                    @endif
                    @if (isset($Pagina['SubtotalItbis3Pagina']))
                        <SubtotalItbis3Pagina>{{ $Pagina['SubtotalItbis3Pagina'] }}</SubtotalItbis3Pagina>
                    @endif
                    @if (isset($Pagina['MontoSubtotalPagina']))
                        <MontoSubtotalPagina>{{ $Pagina['MontoSubtotalPagina'] }}</MontoSubtotalPagina>
                    @endif
                    @if (isset($Pagina['SubtotalMontoNoFacturablePagina']))
                        <SubtotalMontoNoFacturablePagina>{{ $Pagina['SubtotalMontoNoFacturablePagina'] }}</SubtotalMontoNoFacturablePagina>
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
