Formato Aprobación Comercial
(ACECF)

GERENCIA DE FACTURACIÓN

REPÚBLICA DOMINICANA

Versión 1.0

Enero 2020

1.  Introducción

La  aprobación  o  rechazo  comercial  es  la  respuesta  que  el  comprador  deberá  enviar  al  emisor  como  constancia  de  su
conformidad con la transacción realizada. Al momento de recibir la factura, el comprador (receptor) está obligado a confirmar
al emisor la recepción del documento con una respuesta de recepción1 y de manera opcional podrá remitir la aprobación o
rechazo comercial, de la cual deberá expedir una copia a la DGII.2

El  presente  documento  describe  el  contenido  que  debe  tener  el  formato  XML  de  la  aprobación  comercial,  incluyendo  los
mensajes que serán utilizados por los receptores electrónicos.

2.  Contenido del Formato XML de Aprobación Comercial

a)  Detalle de Aprobación Comercial: especifica el contenido de la respuesta que el receptor debe enviar al emisor y remitir

copia a la DGII.

b)  Firma Digital: que avala la integridad de la respuesta y autenticidad del remitente.

3.  Códigos de Obligatoriedad

1 - Dato obligatorio: el dato debe estar siempre en el archivo.
2 - Dato condicional: el dato no es obligatorio pero pasa a serlo en determinados casos, si se cumple una cierta condición.
3 - Dato opcional: el dato es opcional.

1 El Acuse de Recibo notifica la recepción de la factura electrónica, es decir, si la misma es recibida o no.
2 La DGII recibirá aprobación o rechazo comercial de e-CF previamente aceptadas por la DGII.

Pág. 2 de 6

Secciones del Archivo

Obligatoriedad de la Sección

Detalle Aprobación Comercial

Firma Digital

1

1

A continuación, se describe el contenido de cada sección, las especificaciones de formato para cada campo y los códigos de
obligatoriedad para cada uno. Los nombres y características son similares al formato de e-CF.

Pág. 3 de 6

4.   Detalle de Aprobación Comercial

No.

Campo

Descripción

Tipo

Largo
Máx.

Validación

Obligatoriedad

ÁREA

DETALLE APROBACION COMERCIAL

<DetalleAprobacionCome
rcial>
1  Versión

2  RNC del Emisor
<RNCEmisor>

Versión del formato de Aprobación
Comercial.
Número  del  Registro  Nacional  del
contribuyente que emite el e-CF.

NUM

3

Valor: 1.0

NUM 9  9 u 11

a)  RNC

cumple
estructura de formato.

con

la

3  e-NCF
<eNCF>

Número
Electrónico (e-NCF).

Comprobante

Fiscal

ALFA
NUM

13

a)  e-NCF  cumple  con

la

estructura de formato.

b)  RNC debe coincidir con el
RNC del emisor del e-CF.

4

Fecha Emisión

<FechaEmision>

Fecha de emisión del e-CF.

ALFA
NUM

10

b)   e-NCF  debe  coincidir  con
el e-NCF del e-CF remitido
por el emisor electrónico.
fecha  cumple
con  estructura  dd-MM-
AAAA.

a)  Formato

b)  Fecha  de  emisión  debe
coincidir en la aprobación
comercial  y  en  el  e-CF
remitido  por  el  emisor
electrónico.

Pág. 4 de 6

1

1

1

1

1

Validación

Obligatoriedad

No.

Campo

Descripción

5  Monto Total

<MontoTotal>

Valor indicado en el campo Monto
Total del e-CF.

Tipo

Largo
Máx.

NUM

18

6

RNC del Comprador

<RNCComprador>

Número  del  Registro  Nacional  del
contribuyente
la
emite
Aprobación Comercial del e-CF.

que

NUM

9 u 11

7

Estado

<Estado>

Código  numérico  que
indica  el
estado de la Aprobación Comercial.

NUM

1

8  Detalle  Motivo

del

Rechazo

Se  indica  el  motivo  de  rechazo  de
manera detallada.

250

ALFA

NUM

<DetalleMotivoRechazo>

a)  Monto Total debe coincidir
con  el  valor  del  campo
Monto  Total  del  e-CF
emitido.

a)  RNC

con
cumple
estructura de formato.

la

b)  RNC debe coincidir con RNC
del comprador del e-CF.

Código numérico del estado de
la Aprobación Comercial
1: e-CF Aceptado
2: e-CF Rechazado
Sin validación

Condicional a que el campo Estado
sea código 2.

Fecha y hora en formato              dd-
MM-AAAA HH:mm:ss

Fecha y hora cumplen con el
formato indicado

ALFA
NUM

19

9

Fecha
Hora
y
Generación  Aprobación
Comercial

<FechaHoraAprobacion
Comercial>

FIN ÁREA

DETALLE APROBACION COMERCIAL

Pág. 5 de 6

1

1

1

2

1

5.  Firma Digital

No.

Campo

Descripción

Tipo

Largo
Máx.

Validación

Obligatoriedad

ÁREA
<Signature>

1

Firma Digital

FIN ÁREA

SIGNATURE

Firma digital sobre el archivo de
Aprobación Comercial
SIGNATURE

1

1

Pág. 6 de 6

