REPÚBLICA DOMINICANA

Formato de Resumen Factura de Consumo
Electrónica <DOP250,000
(RFCE)

GERENCIA DE FACTURACIÓN

REPÚBLICA DOMINICANA

Versión 1.0

Enero 2020

1. Introducción

Los contribuyentes que emitan facturas de consumo electrónicas menores a DOP$250 mil mediante el Formato de e-CF, deberán enviar a Impuestos
Internos las ventas realizadas mediante este tipo de e-CF, en el formato XML que se establece en este documento.

En  relación  con  la  factura  de  consumo  electrónica  emitida  al  receptor,  deberá  cumplir  con  las  especificaciones  del  Formato  del  Comprobante  Fiscal
Electrónico; asimismo el emisor deberá disponer de un mecanismo electrónico para fines de consulta por parte de sus clientes.

2. Contenido del formato de Factura de Consumo Electrónica <DOP250,000 (envío a DGII)

Sección

Factura de
Consumo < 250mil
(32)

Encabezado

Firma Digital

1

1

Códigos de obligatoriedad:

1 - Dato obligatorio: el dato debe estar siempre en el documento, independientemente de las características de la transacción.
2 - Dato condicional: el dato no es obligatorio pero pasa a serlo en determinadas operaciones, si se cumple una determinada condición.
3- Opcional. El dato es opcional.

Pág. 2 de 12

1.1.  Detalle por sección

El contenido de cada sección contendrá el formato y el código de obligatoriedad. A continuación, se especifican:

  Largo Máximo: Tamaño máximo del campo. El largo indicado será el largo máximo.

  Tipo de Documento: Podrá ser alfa (ALFA), numérica (NUM) o alfanumérica (ALFANUM). En la información tipo numérica, los decimales se separan

con punto. No debe separarse los miles con otro tipo de carácter.

Pág. 3 de 12

A.  Encabezado

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

ÁREA
<Encabezado>

VERSIÓN

ÁREA
<IdDoc>

Tipo Comprobante Fiscal
Electrónico
<TipoeCF>

ENCABEZADO

Versión del formato utilizado.

3

ALFA

NUM

a) Valor: 1.0

IDENTIFICACIÓN DEL
DOCUMENTO

Indica si el documento es:
Código Tipo:
32: Factura de Consumo
Electrónica

2

NUM

a) Código Tipo:
32: Factura de Consumo Electrónica

e-NCF
<eNCF>

Secuencia autorizada por la
DGII.

13

ALFA

NUM

a) Número de secuencia autorizada
por DGII.

1

2

3

4

Tipo de Ingresos
<TipoIngresos>

Indica  el  tipo  de
ingreso
recibido,  según  clasificación
del  formato  de  envío  de
ventas de Bienes o Servicios.

2

NUM

Código Tipo:
01:  Ingresos  por  operaciones  (No
financieros).
02: Ingresos Financieros
03: Ingresos Extraordinarios
04: Ingresos por Arrendamientos
05:  Ingresos  por  Venta  de  Activo
Depreciable
06: Otros Ingresos

Pág. 4 de 12

Factura de
Consumo
Electrónica
(<250mil)

32

1

1

1

1

1

1

5

6

7

8

Tipo de Pago
<TipoPago>

Indica  el  tipo  de  pago  del
cliente.

1

NUM

Código Tipo:
1: Contado
2: Crédito
3: Gratuito

TABLA DE FORMAS DE PAGO1

Hasta 07 repeticiones.
Contiene los dos campos
siguientes.

Forma de Pago
<FormaPago>

Indica  el  método  en  que  se
pagará la factura.

2

NUM

Código Forma:
1: Efectivo
2: Cheque/Transferencia/
Depósito
3: Tarjeta de Débito/Crédito
4: Venta a Crédito
5: Bonos o Certificados de regalo
6: Permuta
7: Nota de crédito
8: Otras Formas de pago

Monto de Pago
<MontoPago>

FIN ÁREA

ÁREA
<Emisor>

RNC Emisor
<RNCEmisor>

Indica el monto asociado para
cada forma de pago.

Condicional  a  que  exista  una
forma de pago.

18

NUM

a) Valor numérico de 16 enteros, 2
decimales; ≥ 0 (Debe ser positivo)

 IDENTIFICACIÓN DEL DOCUMENTO

EMISOR

Corresponde al RNC del emisor.

9 u 11

NUM

Validar  en  el  Registro  Nacional  de
contribuyentes.
Se tiene que validar:
a) RNC cumpla con estructura de

1

3

3

2

1

1

1 Por definición del XML, para cada elemento debe existir un tag contenedor que agrupe los campos contenidos en una tabla. Ejemplo: en el caso de la <TablaFormasPago>
se agrupan dentro del tag <FormaDePago> por cada par <FormaPago> y <MontoPago> especificado.

Pág. 5 de 12

formato.
b) RNC esté autorizado como
Facturador Electrónico.
c) RNC se encuentre en estatus
“Activo”.
d) RNC no posea marcas de bloqueos.

9

Nombre o Razón Social Emisor
<RazonSocialEmisor>

Nombre  o  Razón  Social  del
emisor.

150

ALFA
 NUM

a) Sin validación

10

11

12

13

Fecha Emisión
<FechaEmision>

FIN ÁREA
ÁREA
<Comprador>

RNC Comprador
<RNCComprador>

Fecha de emisión del e-CF.

10

ALFA
NUM

Fecha válida:
a) Formato
dd-MM-AAAA
b) Validar fecha de inicio como
facturador electrónico.

EMISOR

COMPRADOR

Corresponde
comprador.

al  RNC

del

9 u 11

NUM

a) Sin validación

Identificador Extranjero
<IdentificadorExtranjero>2

Nombre o Razón Social
<RazonSocialComprador>
FIN ÁREA
ÁREA
<Totales>

cuando

Corresponde  al  número  de
identificación
el
comprador  es  extranjero  y  no
tiene  RNC/Cédula.  Condicional
a  que  el  comprador
sea
extranjero. 3
Nombre  o  Razón  Social  del
comprador.
COMPRADOR

TOTALES

20

ALFA
NUM

a) Sin validación

150

ALFA
NUM

a) Sin validación

3 Si es completado el campo ‘Identificador Extranjero’, el campo ‘RNC Comprador’ debe ir en blanco.

Pág. 6 de 12

1

1

3

3

2

3

1

Total de la suma de valores de
monto
a
diferentes tasas.

gravado

ITBIS

14

Monto Gravado Total4
<MontoGravadoTotal>

15

Monto Gravado ITBIS Tasa 1
<MontoGravadoI1>

16

Monto Gravado ITBIS
Tasa 2
<MontoGravadoI2>

17

Monto Gravado ITBIS Tasa 3
<MontoGravadoI3>

Condicional  a  que  exista
Monto  gravado1,  y/o  Monto
gravado  2  y/o  Monto  gravado
3.

Corresponde  al  total  de  los
ITBIS  al  18%,
montos  de
asignados  en
la  factura  de
consumo electrónica.

Condicional a que en la línea de
ítem
detalle  exista  algún
gravado al 18%.

Corresponde  al  total  de  los
ITBIS  al  16%,
montos  de
asignados  en
la  factura  de
consumo electrónica.

Condicional a que en la línea de
detalle  exista  algún
ítem
gravado al 16%.

Corresponde  al  total  de  los
montos de ITBIS a tasa cero (0),
la  factura  de
asignados  en

a)  Valor  numérico  de  16  enteros,  2
decimales; ≥ 0 (No puede ser negativo).

18

NUM

b) Valor de la suma del Monto Gravado
ITBIS  Tasa  1  +  Monto  Gravado  ITBIS
Tasa 2 + Monto Gravado ITBIS Tasa 3.

18

NUM

a)  Valor  numérico  de  16  enteros,  2
decimales; ≥ 0 (No puede ser negativo).

18

NUM

a)  Valor  numérico  de  16  enteros,  2
decimales; ≥ 0 (No puede ser negativo).

18

NUM

a)  Valor  numérico  de  16  enteros,  2
decimales≥ 0 (No puede ser negativo).

2

2

2

2

4 En los campos donde existan valores numéricos de 16 enteros y 2 decimales, se debe aplicar la regla de redondeos según el Informe Técnico de e-CF.

Pág. 7 de 12

consumo electrónica.
Condicional a que en la línea de
detalle  exista  algún
ítem
gravado a tasa 0.

Corresponde  al  total  de  los
montos exentos, asignados en
consumo
factura
la
electrónica.

de

Condicional a que en la línea de
ítem
detalle  exista  algún
exento.

Corresponde  a
la  sumatoria
total de los montos de ITBIS (en
sus diferentes tasas), asignados
en
factura  de  consumo
electrónica emitida.

la

a
el
que
Condicional
indique  que
contribuyente
existe  montos  de
ITBIS  al
menos a una de las tasas (1, 2
y/o 3).

Corresponde  al  total  de
montos  de
asignados  en
consumo electrónica.

los
ITBIS  al  18%,
la  factura  de

Condicional a que en la línea de
detalle  exista  algún
ítem
gravado al 18%.

18

Monto Exento
<MontoExento>

19

Total ITBIS
<TotalITBIS>

20

Total ITBIS Tasa 1
<TotalITBIS1>

18

NUM

a)  Valor  numérico  de  16  enteros,  2
decimales≥ 0 (No puede ser negativo).

a)  Valor  numérico  de  16  enteros,  2
decimales;  ≥  0
(No  puede  ser
negativo).

18

NUM

b)  Valor  de  la  suma  del  Total  ITBIS
Tasa1 + Total ITBIS Tasa 2 + Total ITBIS
Tasa3.

18

NUM

a) Valor numérico de 16 enteros, dos
decimales; ≥ 0 (No puede ser
negativo).

2

2

2

Pág. 8 de 12

21

Total ITBIS Tasa 2
<TotalITBIS2>

22

Total ITBIS Tasa3
<TotalITBIS3>

Monto del Impuesto Adicional
<MontoImpuestoAdicional>

23

Tabla de
Impuestos Adicionales

Corresponde  al  total  de
montos  de
asignados  en
consumo electrónica.

los
ITBIS  al  16%,
la  factura  de

Condicional a que en la línea de
detalle  exista  algún
ítem
gravado al 16%

Corresponde  al  total  de
los
montos de ITBIS tasa cero (0%),
la  factura  de
asignados  en
consumo electrónica.

Condicional a que en la línea de
ítem
exista
detalle
gravado a tasa 0.

algún

Corresponde  a  la  suma  de  los
Impuesto
campos  Monto
Selectivo al Consumo Específico
y  Ad  Valorem  y  Monto  Otros
Adicionales,
Impuestos
asignados  en
la  factura  de
consumo electrónica.

Condicional a que exista Monto
Impuesto Selectivo al Consumo.

a  que

Condicional
exista
la
impuestos  adicionales  en
factura de consumo electrónica.

18

NUM

a)  Valor  numérico  de  16  enteros,  dos
decimales; ≥ 0 (No puede ser negativo).

18

NUM

a)  Valor  numérico  de  16  enteros,  dos
decimales; ≥ 0 (No puede ser negativo).

a) Valor  numérico  de  16  enteros,  dos
decimales; >0 (debe ser positivo).

18

NUM

b) Valor de la suma del Monto Impuesto
Selectivo  al  Consumo  Específico+
Monto
Ad
Valorem+  Monto  Otros
Impuestos
Adicionales.

Impuesto

Selectivo

2

2

2

2

Pág. 9 de 12

<ImpuestosAdicionales>5

24

Código de Impuesto Adicional
<TipoImpuesto>

incluir

pueden

20
Se
repeticiones  de  pares  código  –
valor.  Incluye  los  cinco  campos
siguientes:

con

Tabla

Dato correspondiente al Código
impuesto  adicional  de
del
la
acuerdo
I
de
Tipos
(Codificación
Impuestos  Adicionales)  del
formato  de  comprobante  fiscal
electrónico (e-CF), asignada a la
factura de consumo electrónica.

3

NUM

a) Validar con Tabla I (Codificación
Tipos de Impuestos Adicionales)6

25

Monto Impuesto Selectivo al
Consumo Específico
<MontoImpuestoSelectivoCons
umoEspecifico>

26

Monto Impuesto Selectivo al
Consumo
 Ad Valorem
<MontoImpuestoSelectivoCons
umoAdvalorem>

Valor  del  impuesto  selectivo  al
específico
(ISC)
consumo
asociado al código de impuesto
adicional.

el
que
a
Condicional
indique  que
contribuyente
impuesto  selectivo  al
existe
la
consumo  específico,  en
factura de consumo electrónica
emitida.
Valor  del  impuesto  selectivo  al
(ISC)  Ad-Valorem
consumo
asociado al código de impuesto
adicional.

18

NUM

a) Valor numérico de 16 enteros, dos
decimales; >0 (debe ser positivo).

18

NUM

a) Valor numérico de 16 enteros, dos
decimales; >0 (debe ser positivo).

5 Ver nota 2.
6 De acuerdo con la Tabla de ‘Codificación Tipos de Impuestos Adicionales’, incluida en el documento del Formato de e-CF.

Pág. 10 de 12

2

2

2

el
que
a
Condicional
contribuyente
indique  que
existe  impuesto  selectivo  Ad-
valorem,  en
factura  de
la
consumo electrónica emitida.

Valor  de  Otros
Impuestos
Adicionales  asociado  al  código
de impuesto adicional.

a
el
que
Condicional
indique  que
contribuyente
impuestos
existe
adicionales,  en  la  factura  de
consumo electrónica emitida.

otros

27

Monto Otros Impuestos
Adicionales
<OtrosImpuestosAdicionales>

FIN TABLA

IMPUESTOS ADICIONALES

28

Monto Total
<MontoTotal>

29

Monto no Facturable
<MontoNoFacturable>

Valor de la suma de los campos
Monto Gravado Total + Monto
exento  +Total  ITBIS  +  Monto
adicional,
del
asignados  a
factura  de
consumo electrónica.

Impuesto
la

Corresponde al total del monto
no  facturable,  asignados  en  la
factura de consumo electrónica.

a
el
que
Condicional
contribuyente
indique  que
existe monto no facturable, en
la
consumo
factura
electrónica emitida.

de

18

NUM

a) Valor numérico de 16 enteros, dos
decimales; >0 (debe ser positivo).

18

NUM

a) Valor numérico de 16 enteros, dos
decimales; ≥ 0 (No puede ser
negativo)

b) Valor de la suma del Monto Gravado
Total  +  Monto  Exento  +Total  ITBIS  +
Monto del Impuesto Adicional.

18

NUM

a)  Valor  numérico  de  16  enteros,  dos
decimales. (Puede ser negativo)

2

1

2

Pág. 11 de 12

30

Monto Período
<MontoPeriodo>

Corresponde al total del monto
periodo, asignados en la factura
de consumo electrónica.

18

NUM

a)  Valor  numérico  de  16  enteros,  dos
decimales. (Puede ser negativo)

Monto

b)
período=
Total+Monto No Facturable.

Monto

FIN ÁREA

31

Código Seguridad Factura de
Consumo DOP$<250 M
<CodigoSeguridadeCF>

TOTALES
Corresponde  a  los  6  primeros
caracteres del Hash de la firma
digital  correspondiente  a
la
factura de consumo electrónica
emitida, menor a DOP$250 M.

FIN ÁREA

ENCABEZADO

6

ALFA
NUM

a) Sin validación

3

1

B. FIRMA DIGITAL

CAMPOS

ÁREA
<Signature>

1

Firma Digital

FIN ÁREA

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Obligatoriedad

SIGNATURE

Firma  digital
documento.
SIGNATURE

sobre

todo  el

1

1

Pág. 12 de 12

