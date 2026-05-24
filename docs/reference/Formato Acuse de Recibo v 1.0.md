Formato Acuse de Recibo

 (ARECF)

GERENCIA DE FACTURACIÓN

REPÚBLICA DOMINICANA

Versión 1.0

Bitácora de actualizaciones

Versión 1.0

1.  Se actualiza la etiqueta del área ‘DETALLE ACUSE DE RECIBO’.

Pág. 2 de 6

1.  Introducción

El acuse de recibo es la respuesta que el receptor deberá enviar al emisor como constancia de recepción del Comprobante
Fiscal Electrónico; el mismo no implica aceptación ni rechazo del e-CF, sólo indica si fue o no recibido.

Al  momento  de  recibir  la  factura,  el  receptor  está  obligado  a  confirmar  al  emisor  la  recepción  del  documento  con  una
respuesta de recepción1, previo a la aprobación comercial.

El presente documento describe el contenido que debe tener el formato XML del acuse de recibo, incluyendo los mensajes
que serán utilizados por los receptores electrónicos.

2.  Contenido del Formato XML del Acuse de Recibo

a)  Detalle del Acuse de Recibo: especifica el contenido de la respuesta que el receptor debe enviar al emisor.
b)  Firma Digital: que avala la integridad de la respuesta y autenticidad del remitente.

3.  Códigos de Obligatoriedad

1 - Dato obligatorio: el dato debe estar siempre en el archivo.
2 - Dato condicional: el dato no es obligatorio pero pasa a serlo en determinados casos, si se cumple una cierta condición.

1 El Acuse de Recibo confirma que el documento corresponde a una factura electrónica y ha sido recibida.

Pág. 3 de 6

Secciones del Archivo

Obligatoriedad de la Sección

Detalle Acuse de Recibo

Firma Digital

1

1

A  continuación,  se  describe el  contenido de  cada  sección, las especificaciones de  formato para cada  campo  y  el  código de
obligatoriedad de cada uno. Los nombres y características son similares al formato de e-CF.

Pág. 4 de 6

A. Detalle de Acuse de Recibo

No.

Campo

Descripción

Tipo

Largo
Máx.

Validación

Obligatoriedad

ÁREA
<DetalleAcusedeRecibo>

1  Versión

DETALLE ACUSE DE RECIBO

Versión del formato de Acuse de
Recibo.

NUM

3

Valor: 1.0

2

3

4

5

6

7

RNC del Emisor
<RNCEmisor>

Número del Registro Nacional del
contribuyente que emite el e-CF.

NUM  9 u 11

RNC/Cédula  cumple  con
estructura de formato.

la

RNC del Comprador

<RNCComprador>

Número del Registro Nacional del
contribuyente que emite el Acuse
de Recibo del e-CF.

NUM  9 u 11

RNC/Cédula  cumple  con
estructura de formato.

la

e-NCF

<eNCF>

Estado

<Estado>

Número Comprobante Fiscal
Electrónico (e-NCF)

ALFA
NUM

13

e-NCF  cumple  con  la  estructura
de formato.

Código  de  respuesta  del  Acuse
de Recibo.

NUM

1

0: e-CF Recibido
1: e-CF No Recibido

Código Motivo No Recibido

<CodigoMotivoNoRecibido>

Fecha y Hora Generación
Acuse de Recibo

<FechaHoraAcuseRecibo>

Código  numérico  que  indica  el
motivo de rechazo del e-CF.

Condicional a que el Estado tenga
valor 1.

NUM

1

Código motivo de No Recibido
1: Error de especificación.
2: Error de Firma Digital.
3: Envío duplicado
4: RNC Comprador no
corresponde

Fecha y hora en formato
dd-MM-AAAA HH:mm:ss

ALFA
NUM

Fecha  y  hora  cumplen  con  el
formato indicado.

19

FIN ÁREA

DETALLE ACUSE DE RECIBO

Pág. 5 de 6

1

1

1

1

1

1

2

1

B.  Firma Digital

No.

Campos

Descripción

Tipo

Largo
Máx.

Validación

Obligatoriedad

1

ÁREA
<Signature>

Firma Digital

FIN ÁREA

SIGNATURE

Firma digital sobre el archivo de
Acuse de Recibo
SIGNATURE

1

1

Pág. 6 de 6

