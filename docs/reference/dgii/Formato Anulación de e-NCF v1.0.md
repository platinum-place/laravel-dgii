

Bitácora

Versión 1.0

Actualizaciones al 24-05-2022
Modificaciones no implican cambio de versión

•  Se elimina de la validación e) de la sección “Detalle de Anulación” lo siguiente: El e-NCF es mayor que el colocado en el campo

“Secuencia de e-NCF Desde" de cualquier formato de anulación remitido previamente.

Pág 2 de 9

1.  Introducción

El contribuyente podrá anular secuencias autorizadas de comprobantes fiscales electrónicos, si la factura emitida no ha
sido enviada a la DGII  ni al receptor o si la secuencia no ha sido utilizada, para lo cual deberá emitir un formato XML
de anulación de e-NCF descrito en el presente documento.

Si la factura fue enviada a la DGII y/o al receptor, el contribuyente anulará la secuencia emitiendo una Nota de
Crédito Electrónica, con las  especificaciones establecidas en el formato XML de e-CF.

2.  Contenido del archivo anulación de e-NCF

a)  Encabezado: esta sección contiene los datos de quién anula, la cantidad de secuencias anuladas y la fecha en que

se genera el archivo.

b)  Detalle de Anulación: en esta sección se informan las secuencias de e-NCF que serán anuladas.
c)  Firma Digital: que avala la integridad del archivo y autenticidad del emisor.

3.  Códigos de obligatoriedad

0 - No corresponde: significa que el dato no debe ir en el archivo.
1 - Dato obligatorio: el dato debe estar siempre en el archivo.

Secciones del Reporte

Obligatoriedad de la Sección

Encabezado

Detalle de Anulación

Firma Digital

1

1

1

A continuación, se describe el contenido de cada sección, las especificaciones de formato para cada campo y los
códigos de obligatoriedad para cada uno, que debe tener el archivo de anulación de secuencias.

Pág 3 de 9

4.  Formato Anulación de Secuencias de e-NCF

a)  Encabezado

No.

Nombre del Campo

Descripción

Tipo

Largo
Máx.

Validación

Obligatoriedad

1

2

3

4

ÁREA
<Encabezado>

Versión

ENCABEZADO

Versión del Formato
Anulación  de   e-NCF.

NUM

3

Valor: 1.0

RNC Emisor
<RncEmisor>

Corresponde  al  Número
de  Registro Nacional del
contribuyente  que  emite  la
factura electrónica.

NUM

9 u 11

Cantidad de e-NCF Anulados
<CantidadeNCFAnulados>

Sumatoria de la cantidad
de e-NCF que se está
reportando en  la  sección
Detalle,  de  este  formato.

NUM

10

a)  RNC  cumple  con

la
estructura de formato.
b)  RNC  está  autorizado
Facturador

como
Electrónico.

c)  RNC  tiene  secuencias
autorizadas  del  tipo
de  e-  NCF  que  está
anulando.

a)  Cantidad  de  e-NCF
Anulados=∑  cantidad
de  e-  NCF  anulados
por  tipo  de  e-NCF, de
la sección  Detalle.

Fecha y Hora Generación
Anulación de e-NCF

<FechaHoraAnulacioneNCF>

Fecha y hora en que se
generó  el archivo de
anulación de  secuencias
de e-NCF, en  formato
Formato dd-MM-AAAA
HH:mm:ss

ALFA
NUM

19

a)    Formato de fecha y
hora  cumple con
formato        dd-
MM-AAAA
HH:mm:ss

FIN ÁREA

ENCABEZADO

Pág 4 de 9

1

1

1

1

1

b)  Detalle de Anulación

Atendiendo al tipo de comprobante fiscal que se desee anular, la sección puede tener hasta 8 repeticiones.

No.

Campo

Descripción

Tipo  Largo

Máx.

Validación

 Obligatoriedad

ÁREA
<DetalleAnulacion>

ÁREA
<Anulacion>

1

Número de Línea
<NoLinea>

DETALLE ANULACIÓN

ANULACIÓN
Se p u e d e n  i n c l u i r    10
hasta  repeticiones.

Número de la línea o
secuencial.  Desde  1  hasta  10
repeticiones.

NUM

2

2

Tipo de e-CF
<TipoeCF>

Tipo Comprobante
Fiscal  Electrónico (e-CF)

NUM

2

1

1

1

1

a)    El tipo de e-CF es:

31: Factura de Crédito Fiscal
Electrónica
32: Factura de Consumo
Electrónica
33: Nota de Débito Electrónica
34: Nota de Crédito Electrónica
41: Compras Electrónico
43: Gastos Menores Electrónico
44: Regímenes Especiales
Electrónica
45: Gubernamental
Electrónico
46: Comprobante para
Exportaciones  Electrónico
47: Comprobante para
Pagos al Exterior
Electrónico

Tabla Rango de
Secuencias  Anuladas
de e-NCF

<TablaRangoSecuenciasAnul
adaseNCF>

Tabla que contiene un rango de las secuencias anuladas de manera consecutiva, de
acuerdo con el  tipo de e-CF.  Se pueden incluir hasta 10,000 repeticiones.

1

Pág 5 de 9

No.

Campo

Descripción

Tipo

Largo
Máx.

Validación

Obligatoriedad

3

Secuencia de e-NCF
Desde
<SecuenciaeNCFDesde>

Fiscal

Se  refiere  al  Número  de
Comprobante
Electrónico (e-NCF) con el
secuencial que inicia el
rango  de secuencias que
será  anulado.

ALFA
NUM

13

a)  El e-NCF cumple con la estructura de
formato  de número de comprobante
Ej.:
fiscal
E310000000001.

posiciones)1.

(13

b)  El  primer  carácter  del  e-NCF  (Serie)

está  comprendido entre E-Z2

c)  El tipo de e-CF de la secuencia debe
indicado  en  el

corresponder  al
campo ‘Tipo de  e-CF’.

d)  Se  debe  colocar  la  secuencia  inicial
del  rango  que será anulado. Ej.: Si el
rango  de  secuencias  que  será
anulado  es  desde  E310000000001
hasta
se
E310000000005,
completará el campo  ‘Secuencia  de
e-NCF  Desde’
con
E310000000001.

e-NCF

el

1

e)  El  e-NCF  es  menor  o  igual  que  la
“Secuencia  de  e-NCF  Hasta”  y  es
mayor a cero (>0).

1  La  estructura  del  número  de  comprobante  fiscal  electrónico  (e-NCF)  está  compuesta  por  una  serie  o  letra  entre  E-Z  (exceptuando  la  letra  P),  el  tipo  de
comprobante  fiscal  especificado  con  2  dígitos,  seguidos  del  secuencial  de  10  dígitos  con  valor  numérico,  los  cuales  indican  la  cantidad  de  comprobantes
utilizados.
2 Se exceptúa la letra P.

Pág 6 de 9

No.

Campo

Descripción

Tipo  Largo
Máx.

Validación

Obligatoriedad

4

Secuencia de e-NCF Hasta
<SecuenciaeNCFHasta>

Se  refiere  al  Número  de
Comprobante Fiscal
Electrónico (e-NCF) con el
secuencial  que  finaliza  el
rango de secuencias que
será  anulado.

ALFA
NUM

a)  El e-NCF cumple con la estructura

de formato  de número  de
comprobante fiscal  (13
posiciones)3. Ej.: E310000000001.

13

b)  El  e-NCF  tiene  la  misma  serie  y

1

tipo  de  comprobante  fiscal  que  el
colocado  en  el  campo “Secuencia
de e-NCF Desde”.

c)  El  e-NCF  es  mayor  o  igual  que  el
colocado en el  campo  “Secuencia  de
e-NCF  Desde”  y  es  mayor  a  cero
(>0).

FIN TABLA RANGO SECUENCIAS

5

Cantidad de e-NCF
Anulados
<CantidadeNCFAnulados>

FIN ÁREA

FIN ÁREA

Cantidad de secuencias de
e-NCF que se está
anulando.

En  este  campo  se  deberá
sumar  las secuencias
colocados en la tabla de
rangos  de  secuencias
anuladas de e-NCF.
ANULACIÓN

DETALLE ANULACIÓN

NUM

10

a)  ∑ cantidad de e-NCF anulados por

tipo de
 e-CF.

1

3  La  estructura  del  número  de  comprobante  fiscal  electrónico  (e-NCF)  está  compuesta  por  una  serie  o  letra  entre  E-Z  (exceptuando  la  letra  P,  el  tipo  de
comprobante fiscal especificado con 2 dígitos, seguidos del secuencial de 10 dígitos con valor numérico, los cuales indican la cantidad de comprobantes utilizados.

Pág 7 de 9

c)  Firma Digital

No.

Campos

Descripción

Tipo

Largo
Máx.

Validación

Obligatoriedad

ÁREA
<Signature>

SIGNATURE

1

Firma Digital

Firma digital sobre el
archivo de  Anulación de
e-NCF.

FIN ÁREA

SIGNATURE

1

1

Pág 8 de 9

Anexo I.

Ejemplo del formato de anulación de secuencias de e-NCF en las secciones Encabezado y sección Detalle de
Anulación.

A.  Encabezado

1
2
3
4

Versión
RNC Emisor
Cantidad de e-NCF Anulados
Fecha y Hora de la Firma Digital del Archivo de Anulación

1.00
  123456789
84
01-01-2019 08:50:15

B.  Detalle de Anulación

  1
  2

  3
  4
  3
  4
  5
  1

  2

  3
  4
  5

Número de Línea
Tipo de e-CF

Tabla Rango de Secuencias Anuladas
Secuencia de e-NCF Desde
Secuencia de e-NCF Hasta
Secuencia de e-NCF Desde
\
Secuencia de e-NCF Hasta
Cantidad de e-NCF Anulados
Número de Línea

Tipo de e-CF
Tabla Rango de Secuencias Anuladas
Secuencia de e-NCF Desde
Secuencia de e-NCF Hasta
Cantidad de e-NCF Anulados

Pág 9 de 9

1
31

E310000000001
E310000000001
E310000000005
E310000000050
47
2
44

E440000000010
E440000000046
37

