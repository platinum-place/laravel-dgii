Formato Comprobante
Fiscal Electrónico (e-CF)
Versión 1.0 | Octubre 2025

Bitácora

Versión 1.0

Actualizaciones al 09-10-2025
Modiﬁcaciones no implican cambio de versión.

1.

Se actualiza la tabla II. Codiﬁcación Monedas, para agregar el tipo de moneda “Peso Colombiano"

Actualizaciones al 17-09-2024
Modiﬁcaciones no implican cambio de versión.

1.
2.

Actualizaciones al 30-08-2022
Modiﬁcaciones no implican cambio de versión.

ana" y “Peso Mexicano"
ctárea", "Mililitro", "Miligramo", "Onzas" y "Onzas Troy".

         1. Se actualiza la tabla IV. Codiﬁcación Unidad de Medida, para agregar el  po de medida "Bandeja".
 Actualizaciones al 06-05-2022
Modiﬁcaciones no implican cambio de versión.

1.

Se actualiza la tabla IV. Codiﬁcación Unidad de Medida, para agregar los  pos de medidas "Gross Register Tonnage (Toneladas de Registro Bruto)", "Pie cuadrado",
"Pasajero", "Pulgadas" y "Parqueo Barcos en Muelle".

Actualizaciones al 19-11-2021
Modiﬁcaciones no implican cambio de versión.

1.

Se actualizan en el Área Comprador <Comprador> los códigos de obligatoriedad de 1 a 2, correspondiente a los  pos de e-CF Nota de Crédito Electrónica y Nota de
Débito Electrónica de la sección Encabezado.

Actualizaciones al 04-11-2021
Modiﬁcaciones no implican cambio de versión.

1.

Se actualiza la tabla IV. Codiﬁcación Unidad de Medida, para agregar el  po de medida "Quintal".

Actualizaciones al 29-06-2021:
Modiﬁcaciones no implican cambio de versión.

1.

Se actualiza la ‘Tabla III. Codiﬁcación Provincias y Municipios’, para separar por columnas los códigos de las Provincias y Municipios.

Actualizaciones al 10-11-2020:
Modiﬁcaciones no implican cambio de versión.

1.
2.
3.

Se actualizan los tags <Liquidacion> y <Mineria> de la sección Detalle de Bienes o Servicios, para eliminar acentos.
Se actualiza la descripción de los campos ‘Tabla de Distribución de Subrecargo’ y ‘Tipo Subrecargo’, de la sección Detalle de Bienes o Servicios.
Se actualiza el tag <DescripcionDescuentooRecargo> de la sección Descuentos o Recargos.

Actualizaciones al 28-07-2020
Modiﬁcaciones no implican cambio de versión.

Se modiﬁcan los campos <TotalITBISRetenido> y <TotalISRRetencion> de la sección Encabezado para que sean aceptados valores numéricos igual a cero (0).

Pág. 1 de 87

1.  Introducción

En este documento se describe el contenido de los Comprobantes Fiscales Electrónicos (e-CF), tanto las definiciones desde el punto de vista
tributario como desde el punto de vista comercial.

Desde  la  perspectiva  de  este  razonamiento,  este  documento  tiene  como  objetivo  ser  un  instrumento  adecuado  para  el  respaldo  de  la
transacción entre las partes, y abarcar la información que se requiere para el uso del régimen de Factura Electrónica en República Dominicana.

Esta información considera las especificaciones para la transacción necesaria entre el emisor y comprador.

A continuación, se describe el formato electrónico de los tipos de e-CF:

TIPO
31
32
33
34
41
43
44
45
46
47

TIPO DE COMPROBANTE

e-CF

Factura de Crédito Fiscal Electrónica
Factura de Consumo Electrónica
Nota de Débito Electrónica
Nota de Crédito Electrónica
Compras Electrónico
Gastos Menores Electrónico
Regímenes Especiales Electrónico
Gubernamental Electrónico
Comprobante de Exportaciones Electrónico
Comprobante para Pagos al Exterior Electrónico

Pág. 2 de 87

2.  Contenido del e-CF

De acuerdo con lo dispuesto en el Decreto No. 254-06 que establece el Reglamento para la Regulación de la Impresión, Emisión y Entrega de
Comprobantes Fiscales, la Dirección General de Impuestos Internos podrá autorizar comprobantes fiscales que reúnan los requisitos exigidos
por la Ley y el Reglamento. Sobre la base de esta disposición, se define el formato de los documentos electrónicos y la obligatoriedad de los
datos contenidos en ellos. Los documentos electrónicos tienen un formato único, en que la principal diferencia radica en la obligatoriedad o no
de algunos datos.

Todo e-CF que se emita debe contener una firma digital, la que permite autenticar su origen y certificar su integridad.

2.1.  Composición del e-CF

En el e-CF se distinguen las siguientes partes:

A.  Encabezado: Corresponde a la identificación del e-CF, donde contiene los datos del emisor, comprador y datos tributarios.

B.  Detalle de Bienes o Servicios: En esta sección se debe detallar una línea por cada ítem.

C.  Subtotales Informativos: Estos subtotales no aumentan ni disminuyen la base del impuesto, ni modifican los campos totalizadores;

solo son campos informativos.

D.  Descuentos o Recargos: Esta sección se utiliza para especificar descuentos o recargos globales que afectan al total del e-CF. No se

requiere especificar ítem por ítem.

E.  Paginación: En esta sección se indica la cantidad de páginas del e-CF en la Representación Impresa y cuales ítems estarán en cada

una. Esta deberá repetirse para el total de páginas especificadas.

F.

Información de Referencia: En esta sección se deben detallar los e-CF modificados por Nota de Crédito o Débito Electrónica y los e-
CF emitidos por motivo de reemplazo de un comprobante emitido en contingencia.

G.  Fecha y Hora de la firma digital.

H.  Firma Digital sobre toda la información anterior para garantizar la integridad del e-CF.

Pág. 3 de 87

La obligatoriedad de cada una de las partes de e-CF se especifica en el siguiente cuadro:

Sección

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regí.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

Contenido del e-CF

Encabezado
Detalle de Bienes o Servicios
Subtotales Informativos
Descuentos o Recargos1
Paginación
Información de Referencia
Fecha y Hora de la firma digital
Firma Digital

Códigos de Obligatoriedad:

31
1
1
3
2
2
2
1
1

32
1
1
3
2
2
2
1
1

33
1
1
3
2
2
1
1
1

34
1
1
3
2
2
1
1
1

41
1
1
3
2
2
2
1
1

43
1
1
3
2
2
2
1
1

44
1
1
3
2
2
2
1
1

45
1
1
3
2
2
2
1
1

46
1
1
3
2
2
2
1
1

47
1
1
3
2
2
2
1
1

0: No corresponde. Significa que el dato no debe ir en un determinado documento.

1: Dato obligatorio. El dato siempre debe estar en el documento, independiente de las características de la transacción.

2: Dato condicional. El dato no es obligatorio en todos los documentos, pero pasa a serlo en determinadas operaciones si se cumple una
determinada condición. Ejemplo: Si existen descuentos recargos que afectan el total del e-CF, se debe incluir la sección Descuentos o
Recargos, de lo contrario se descuadrará el monto total.

3: Opcional. El dato es opcional.

1 Sujeto a que exista un descuento o recargo global.

Pág. 4 de 87

2.2.  Detalle por sección
El contenido de cada sección contendrá el formato y sus códigos de obligatoriedad según el tipo de e-CF. A continuación, se especifican:

➢  Largo Máximo: Tamaño máximo del campo. El largo indicado será el largo máximo.

➢  Tipo de Documento: Podrá ser alfa (ALFA), numérica (NUM) o alfanumérica (ALFANUM). En la información tipo numérica, los decimales

se separan con punto. No debe separarse los miles con otro tipo de carácter.

➢  Columna I: Indica si el dato debe estar en la representación impresa (RI) del documento. Debajo de cada campo se incluye el nombre

del tag XML que tiene asociado. Ejemplo: <TipoeCF>.

En la columna ‘I’ se pueden tener los siguientes valores:

•  N: La impresión de este campo no es obligatoria.
•
•  P: El dato debe estar impreso en palabras. Por ejemplo: si el tipo de e-CF está codificado, en la representación impresa debe

I: Impresión del dato es obligatoria.

estar palabras (Factura Crédito Fiscal Electrónica, Nota de Crédito Electrónica, etc.).

Pág. 5 de 87

A.  ENCABEZADO

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota Créd.
Electr.

OBLIGATORIEDAD
Gastos
Menor.
Electr.

Compras
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

ÁREA
<Encabezado>

ENCABEZADO

1

VERSIÓN

Versión del formato utilizado.

3

ALFA
NUM

Valor: 1.0

N

ÁREA
<IdDoc>

IDENTIFICACIÓN DEL DOCUMENTO

31

1

1

1

32

1

1

1

33

1

1

1

34

1

1

1

41

1

1

1

43

1

1

1

44

1

1

1

45

1

1

1

46

1

1

1

47

1

1

1

2

3

4

Tipo Comprobante
Fiscal Electrónico
<TipoeCF>

Indica si el documento es:
Código Tipo:

31: Factura de Crédito Fiscal
Electrónica
32: Factura de Consumo Electrónica
33: Nota de Débito Electrónica
34: Nota de Crédito Electrónica
41: Compras Electrónico
43: Gastos Menores Electrónico
44: Regímenes Especiales Electrónica
45: Gubernamental Electrónico
46: Comprobante para
Exportaciones Electrónico
47: Comprobante para Pagos al
Exterior Electrónico

2

NUM

a)  De
la
acuerdo
codificación  del  campo  de
Descripción.

a

P

1

1

1

1

1

1

1

1

1

1

e-NCF
<eNCF>

Secuencia autorizada por la DGII.

13

ALFA
NUM

a)  Validar  con  No.  Secuencia
autorizada por DGII.

Fecha Vencimiento
<FechaVencimientoSecuenci
a>

Fecha de vencimiento de la secuencia
de e-NCF.

10

ALFA
NUM

Fecha válida:

  a) Formato

(dd-MM-AAAA)
b) Validar con fecha de
vencimiento de la
autorización de la secuencia.

I

I

1

1

1

0

1

1

1

0

1

1

1

1

1

1

1

1

1

1

1

1

 Pág. 6 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact. Créd.
Fiscal Electr.

Fact.
Cons.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

OBLIGATORIEDAD

31

32

33

34

41

43

44

45

46

47

5

Indicador Nota de Crédito
mayor a 30 días
<IndicadorNotaCredito>

6

Indicador Envío Diferido
<IndicadorEnvioDiferido>

Indicador Monto Gravado
<IndicadorMontoGravado>

7

Sólo para Notas de Crédito que no
tienen  derecho  a  rebajar  ITBIS.El
indicador tomará valor 1 si la fecha
es mayor a 30 días calendario de la
emisión del e-CF afectado.

tener  ventas  a

Identifica a los contribuyentes que
han  sido  previamente  autorizados
a
través  de
dispositivos  móviles  offline,  tales
como  ventas  con  Handheld,  entre
otros.

Condicional  a  que  se  encuentre
autorizado hacer envíos diferidos.

Indica si en la línea de detalle, el
monto  se  encuentra  con  ITBIS
incluido  (impuestos  adicionales
no  están  incluidos  en  el  precio
del item).
Condicional  a  que  el  bien  o
servicio sea gravado con ITBIS.

1

NUM

a) Valor 0 si fecha de emisión del
e-CF  afectado  es  ≤  30  días
calendario.
b) Valor 1 si fecha de emisión del
e-CF  afectado  es  >  30  días
calendario.

1

NUM

a)  Código  1:  Envío  diferido
autorizado.

Valida

contribuyente
b)
(RNC/Cédula)  está  autorizado  a
realizar envíos diferidos.

a)  Valor  0  si  los  montos  en  las
líneas  sección  B  “Detalle  de
Bienes  o  Servicios”  no  tienen
ITBIS incluido.

N

0

0

0

1

0

0

0

0

0

0

N

2

2

2

2

0

0

2

2

2

0

1

NUM

N

2

2

2

2

2

0

0

2

0

0

b)  Valor  1  si  los  montos  en  las
líneas  sección  B  “Detalle  de
Bienes
se
encuentran con ITBIS incluido.

Servicios”

o

8

Tipo de Ingresos
<TipoIngresos>

Indica  el  tipo  de  ingreso  recibido,
según clasificación del formato de
envío  de  ventas  de  Bienes  o
Servicios.

2

NUM

  a) Código Tipo:

01: Ingresos por operaciones (No
financieros).
02: Ingresos Financieros
03: Ingresos Extraordinarios
04: Ingresos por Arrendamientos
05: Ingresos por Venta de Activo
Depreciable
06: Otros Ingresos

N

1

1

1

1

0

0

1

1

1

0

Pág. 7 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

9

Tipo de Pago
<TipoPago>

Indica el tipo de pago del cliente.
Las  facturas  por  entrega  gratuita
(código  3),  no  son  válidas  para
crédito fiscal.

1

NUM

a) Código Tipo:
1: Contado
2: Crédito
3: Gratuito

10

Fecha Límite de Pago
<FechaLimitePago>

Solo  para
facturas  a  crédito.
Condicional a que el tipo de pago sea
a crédito.

10

ALFA
NUM

Fecha válida:
a) Formato
dd-MM-AAAA
b)  Fecha  límite  de  pago  debe  ser  ≥
Fecha de emisión.

OBLIGATORIEDAD

I

Fact.
Créd.
Fiscal
Electr.

31

N

1

Fact.
Cons.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

1

33

1

34

1

41

1

43

3

44

1

45

1

46

47

1

3

N

2

2

2

2

2

0

2

2

2

3

11

Término de Pago
<TerminoPago>

Indica el tiempo establecido para el
la  factura  y  se  debe
pago  de
especificar si  el mismo es en horas,
días, semanas, meses u otro.
Ejemplo:

1)  72 horas
2)  120 días
3)  1 semana
4)  3 meses

TABLA DE FORMAS DE
PAGO
<TablaFormasPago>2

Hasta 07 repeticiones.
Contiene los dos campos siguientes.

12

Forma de Pago
<FormaPago>

Indica el método en que se pagará la
factura.

2

NUM

15

ALFA
NUM

a) Sin Validación.

N

3

3

3

0

3

0

3

3

3

3

3

3

3

0

3

0

3

3

3

3

N

3

3

3

0

3

0

3

3

3

3

a) Código Forma:
1: Efectivo
2: Cheque/Transferencia/
Depósito
3: Tarjeta de Débito/Crédito
4: Venta a Crédito
5: Bonos o Certificados de regalo
6: Permuta
7: Nota de crédito
8: Otras Formas de pago

Si la forma de pago corresponde al tipo
5 el e-CF debe ser tipo 32.

2 Por definición del XML, para cada elemento debe existir un tag contenedor que agrupe los campos contenidos en una tabla. Ej: en el caso de la <TablaFormasPago> se agrupan dentro del tag <FormaDePago> por cada par <FormaPago>
y <MontoPago> especificado.

Pág. 8 de 87

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

OBLIGATORIEDAD

CAMPOS

Monto de Pago
<MontoPago>

FIN TABLA

Indica  el  monto  asociado  para  cada
forma  de  pago.  Condicional  a  que
exista una forma de pago.

18

NUM

a)  Valor  numérico  de  16
enteros,  2  decimales;  ≥  0
(Debe ser positivo)

N

31

2

13

14

15

16

17

Tipo Cuenta de Pago3
<TipoCuentaPago>

Cuenta de origen de la transferencia o
del cheque.

2

ALFA

Cuenta de Pago
<NumeroCuentaPago>

Número  de  la  cuenta  si  la  forma  de
pago  es  por  cheque  o  transferencia
bancaria.

Banco de Pago
<BancoPago>

Banco de la Cuenta.

Fecha desde
<FechaDesde>

Período de facturación para Servicios
Periódicos  Ej.  Energía  eléctrica,
telefónica, otros.
Fecha desde
(Fecha inicial del servicio facturado).

28

75

ALFA
NUM

ALFA
NUM

10

ALFA
NUM

18

Fecha hasta
<FechaHasta>

Período de facturación para Servicios
Periódicos. Fecha hasta
(Fecha final del servicio facturado).

10

ALFA
NUM

 Código Tipo:
 CT: Cta. Corriente
 AH: Ahorro
 OT: Otra

a) Sin validación

a) Sin validación

Fecha válida:
a) Formato
dd-MM-AAAA
b) Menor o igual que
“Fecha hasta”.
De  acuerdo  al  Formato
de
campo
del
descripción.
Fecha válida:
a) Formato
dd-MM-AAAA
b) Mayor o igual a “Fecha
desde”.
De  acuerdo  al  Formato
del
de
campo
Descripción.

32

2

3

3

3

33

2

3

3

3

34

0

0

0

0

41

2

3

3

3

43

0

0

0

0

44

2

3

3

3

45

2

3

3

3

46

2

3

3

3

47

3

3

3

3

N

3

N

N

3

3

N

3

3

3

3

0

0

3

3

3

3

N

3

3

3

3

0

0

3

3

3

3

3 En los casos donde exista más de una forma de pago cheque/transferencia/depósito sólo colocar un tipo cuenta de pago.

Pág. 9 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Indica el total de páginas en la que será
impreso el e-CF.

19

Total Páginas
<TotalPaginas>

Cuenta las veces que se repite el campo
Página No. de la sección Paginación.

3

NUM

FIN ÁREA
ÁREA
<Emisor>

Condicional a que exista paginación.

IDENTIFICACIÓN DEL DOCUMENTO

EMISOR

RNC Emisor
<RNCEmisor>

Corresponde al RNC del emisor.

9 u 11

NUM

a)  Valor  numérico  hasta  3
enteros, > 1 (Debe ser positivo).

b) Total de veces que se repite el
campo ‘Página No.’ de la sección
Paginación.

Validar en el Registro Nacional
de contribuyentes.
Se tiene que validar:
a) RNC cumpla con estructura
de formato.
b) RNC esté autorizado como
Facturador Electrónico.
c) RNC se encuentre en estatus
“Activo”.
d) RNC no posea marcas de
bloqueos.

I

Fact.
Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

OBLIGATORIEDAD

31

32

33

34

41

43

44

45

46

47

I

2

2

2

2

2

2

2

2

2

2

1

1

1

1

1

1

1

1

1

1

I

1

1

1

1

1

1

1

1

1

1

Nombre o Razón Social
Emisor

<RazonSocialEmisor>
Nombre Comercial
<NombreComercial>

Sucursal
<Sucursal>

Dirección de Emisor
<DireccionEmisor>

Nombre o Razón Social del emisor.

150

Nombre Comercial.

Indica nombre de la sucursal que emite
el  e-CF.  Corresponde  a  un  dato
administrado por el emisor.
Datos correspondientes a Domicilio de
operación del Emisor.

150

20

100

ALFA
NUM

ALFA
NUM

ALFA
NUM

ALFA
NUM

a) Sin validación

a) Sin validación

a) Sin validación

a) Sin validación

I

I

I

I

1

3

3

1

1

3

3

1

1

3

3

1

1

3

3

1

1

3

3

1

1

3

3

1

1

3

3

1

1

3

3

1

1

3

3

1

1

3

3

1

Pág. 10 de 87

20

21

22

23

24

DESCRIPCIÓN

Largo
Max

Tipo

Validación

CAMPOS

Municipio
<Municipio>

Provincia
<Provincia>

Dato  correspondiente  al  domicilio  de
operación del Emisor.

Dato  correspondiente  al  domicilio  de
operación del Emisor.

Tabla de Teléfono Emisor
<TablaTelefonoEmisor>

Se pueden incluir 3 repeticiones.

Teléfono Emisor
<TelefonoEmisor>

Dato  correspondiente  al  teléfono  de
contacto del emisor.

FIN TABLA

TELÉFONO EMISOR

Correo Electrónico Emisor
<CorreoEmisor>

Dato correspondiente al correo
electrónico del emisor.

WebSite
<WebSite>

Dato correspondiente a la página web
del emisor.

Actividad Económica Emisor
<ActividadEconomica>

Dato  correspondiente  a
la  actividad
económica  del  Emisor  (se  puede  incluir
sólo
la  actividad  económica  que
corresponde a la transacción).

Código del Vendedor
<CodigoVendedor>

Identificador del Vendedor.

Número Factura Interna
<NumeroFacturaInterna>

Corresponde  al  número  interno  de  la
factura.

Número pedido Interno
<NumeroPedidoInterno>

Corresponde  al  número  de  pedido
interno asignado a la factura.

6

6

12

80

50

100

60

20

NUM

NUM

a) Validar con código de la
Tabla III (Codificación
Provincias Y Municipios)
a) Validar con código de la
Tabla III (Codificación
Provincias Y Municipios

ALFA
NUM

Formato válido:
Estructura de teléfono
(xxx-xxx-xxxx)

Formato válido: Estructura de
correo electrónico
(xxxxx@xxx.xx)

a) Sin validación

a) Sin validación

a) Sin validación

a) Sin validación

ALFA
NUM

ALFA
NUM

ALFA
NUM

ALFA
NUM

ALFA
NUM

20

NUM

a) Sin validación

Zona de Venta
<ZonaVenta>

Corresponde  a  la  zona  de  venta  del
vendedor.

20

ALFA
NUM

a) Sin validación.

25

26

27

28

29

30

31

32

33

34

I

P

P

N

N

N

N

N

N

N

N

Fact.
Créd.
Fiscal
Electr.

31

3

3

3

3

3

3

3

3

3

3

3

Fact.
Consum.
Electr.

Nota Déb.
Electr.

32

3

3

3

3

3

3

3

3

3

3

3

33

3

3

3

3

3

3

3

3

3

3

3

OBLIGATORIEDAD

Nota
Créd.
Electr.

34

3

3

3

3

3

3

3

3

3

3

3

Compras
Electr.

41

3

3

3

3

3

3

3

0

3

3

0

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

43

3

3

3

3

3

3

3

0

3

3

0

44

3

3

3

3

3

3

3

3

3

3

3

45

3

3

3

3

3

3

3

3

3

3

3

46

3

3

3

3

3

3

3

3

3

3

3

Pagos
Exterior
Electr.

47

3

3

3

3

3

3

3

0

3

3

0

Pág. 11 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

35

36

Ruta de Venta
<RutaVenta>
Información adicional Emisor
<InformacionAdicionalEmisor>

Corresponde a la ruta de venta del
vendedor.

20

Otra información relativa al Emisor.

250

ALFA
NUM
ALFA
NUM

a) Sin validación

a) Sin validación

37

Fecha Emisión
<FechaEmision>

Fecha de emisión del e-CF.

10

ALFA
NUM

FIN ÁREA
ÁREA
<Comprador>

EMISOR

COMPRADOR

Fecha válida:
a) Formato
dd-MM-AAAA
b) Validar fecha de inicio como
facturador electrónico.

a)  Validar estructura.

OBLIGATORIEDAD

I

N

N

Fact.
Créd.
Fiscal
Electr.

31

3

3

Fact.
Consum.
Electr.

Nota Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

3

3

33

3

3

34

3

3

41

0

3

43

0

3

44

3

3

45

3

3

46

3

3

47

0

3

I

1

1

1

1

1

1

1

1

1

1

1

1

2

2

1

0

1

1

1

3

38

RNC Comprador
<RNCComprador>

Corresponde al RNC del comprador.

Condicional a que el monto total del e-
CF tipo 32 sea igual o superiores a DOP$
250M.4

En  caso  de  que  el  e-CF  sea  tipo  46,  el
campo  es  condicional  a  que  la  Zona
y
Franca  Comercial
Puertos) realice transferencia de bienes
a  Residentes  y  el  campo  ‘Identificador
Extranjero’ esté vacío.

(Aeropuertos

b)  Si  el  e-CF  es  tipo  32  y  el
monto
≥
total
DOP$250,000.00
debe
identificar RNC Comprador.

se

es

9 u 11

NUM

c)  Si  el  e-CF  tipo  33  y  tipo  34
modifica  un  e-CF  tipo  32  con
monto total ≥ DOP$250,000.00
se  debe
identificar  el  RNC
Comprador.

d)  Si  el  e-CF  es  tipo  32  y  el
comprador  es  extranjero,  este
campo  puede  ir  en  blanco  y
campo
completar
Identificador Extranjero.

el

I

1

2

2

2

1

0

25

1

26

0

4 Si el monto total de la factura de consumo electrónica es menor a DOP$250 mil, el campo ‘RNC Comprador’ sera completado de manera opcional.
5 Condicional a que el comprador tenga RNC/Cédula. Si el comprador es extranjero (diplomático), el campo ‘RNC Comprador’ debe ir en blanco y completar el campo ‘Identificador Extranjero’.
6 Según lo establecido en el Art. 10 de la Norma General 05-19, en caso de que las Zonas Francas Comerciales (Aeropuertos y Puertos) realicen transferencias de bienes a Residentes, se deberá completar el campo ‘RNC Comprador’.

Pág. 12 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

39

Identificador Extranjero
<IdentificadorExtranjero>7

de
al
Corresponde
identificación  cuando  el  comprador
es extranjero y no tiene RNC/Cédula.

número

Condicional  a  que  el  e-CF  es  tipo
32>DOP$250,000.00  (aplica  también
para  las  notas  de  crédito/débito  que
hagan referencia a ese tipo de e-CF), y
el campo RNC Comprador esté vacío.

En caso de que el  e-CF sea tipo  46, el
campo  es  condicional  a  que  la  Zona
(Aeropuertos  y
Franca  Comercial
transferencia  de
Puertos)
bienes  a  No  Residentes  y  el  campo
‘RNC Comprador’ esté vacío.

realice

20

ALFA
NUM

es

a)  El  e-CF  de
consumo
>
electrónica
DOP$250,000.00
(aplica
también  para  las  notas  de
crédito/débito  que  hagan
referencia a ese tipo de e-CF).

b)  El  campo  RNC  Comprador
está en blanco.

40

Nombre o Razón Social
Comprador
<RazonSocialComprador>

Nombre o Razón Social del comprador.

En caso de que el  e-CF sea tipo  46, el
campo  es  condicional  a  que  exista  el
campo
o
‘RNC
‘Identificador Extranjero’.

Comprador’

150

ALFA
NUM

a)  Si  el  e-CF  es  tipo  32  y  el
≥
monto
total
se  debe
DOP$250,000.00
indicar  el  nombre  o  razón
social comprador.

es

b) Si el e-CF tipo 33 y tipo 34
modifica  un  e-CF  tipo  32  con
≥
monto
DOP$250,000.00,
se  debe
indicar nombre o razón social
comprador.

total

I

Fact.
Créd.
Fiscal
Electr.

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

I

0

2

2

2

0

0

28

0

29

3

I

1

2

2

2

1

0

1

1

1

3

7 Este campo se completa si el e-CF es una factura de consumo electrónica > DOP$250,000 y el comprador no posee RNC/Cédula por ser extranjero. Lo mismo con las notas de crédito/débito electrónicas que afecten e-CF tipo 32 por valor
> DOP$250,000. Cuando exista Identidicador Extranjero se omitirá el campo RNC Comprador.
8 Condicional a que el comprador sea extranjero (diplomático). Si el campo ‘Identificador Extranjero’ es completado, el campo RNC comprador no deberá ser completado.
9 Según lo establecido en el Art. 10 de la Norma General 05-19, en caso de que las Zonas Francas Comerciales (Aeropuertos y Puertos) realicen transferencias de bienes a No Residentes, se deberá completar el campo ‘Identificador
Extranjero’.

Pág. 13 de 87

41

42

43

44

45

46

47

48

49

50

51

52

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Contacto Comprador
<ContactoComprador>

Nombre  y  teléfono  de  contacto  del
comprador.

Correo Comprador
<CorreoComprador>

correspondiente

Dato
electrónico del comprador.

al

correo

Dirección Comprador
<DireccionComprador>

Dirección del comprador.

Municipio Comprador
<MunicipioComprador>

Dato  correspondiente  a  dirección  de
comprador.

Provincia Comprador
<ProvinciaComprador>

Dato  correspondiente  a  dirección  de
comprador.

80

80

100

6

6

ALFA
NUM

ALFA
NUM

ALFA
NUM

NUM

NUM

a) Sin validación

Formato válido: Estructura de
correo electrónico.
(xxxxx@xxx.xx)

a) Sin validación

III

a)  Validar  con  código  de  la
Tabla
(Codificación
Provincias y Municipios)
a)  Validar  con  código  de  la
(Codificación
Tabla
Provincias y Municipios)

III

País Comprador
<PaisComprador>

Dato correspondiente al país hacia el cual
se realiza la facturación.

60

ALFA

a) Sin validación.

Corresponde a la fecha de entrega del ítem.

10

ALFA
NUM

a) Fecha válida:
Formato (dd-MM-AAAA)

Fecha Entrega
<FechaEntrega>

Contacto de Entrega
<ContactoEntrega>

Dirección de Entrega
<DireccionEntrega>

Dato  de  contacto  donde  será  realizada  la
entrega  o  envio  del
ítem  (distinto  al
comprador).
Corresponde  a  la  dirección  o  destino  del
contacto de entrega.

Telefóno
<TelefonoAdicional>

Dato  del  teléfono  correspondiente  al
contacto de entrega.

Fecha Orden de Compra
<FechaOrdenCompra>

Corresponde a la fecha de la orden de
compra.

Número de Orden de Compra
<NumeroOrdenCompra>

Corresponde  al  número  de  orden  de
compra.

100

100

12

10

20

ALFA
NUM

ALFA
NUM

ALFA
NUM

ALFA
NUM

ALFA
NUM

a) Sin validación

a) Sin validación

a)Formato válido:
Estructura de teléfono
 (xxx-xxx-xxxx)
a)Fecha válida:
  Formato (dd-MM-AAAA)

a) Sin Validación

Pág. 14 de 87

OBLIGATORIEDAD

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

3

3

3

3

3

0

3

3

3

3

3

3

32

3

3

3

3

3

0

3

3

3

3

3

3

33

3

34

3

41

3

43

0

44

3

45

3

46

3

47

0

3

3

3

3

0

3

3

3

3

3

3

3

3

3

3

0

3

3

3

3

3

3

3

3

3

3

0

0

0

0

0

0

0

0

0

0

0

0

0

0

0

0

0

0

3

3

3

3

0

3

3

3

3

3

3

3

3

3

3

0

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

0

0

0

0

0

0

0

0

0

0

0

I

N

N

N

N

N

P

N

N

N

N

N

N

CAMPOS

DESCRIPCIÓN

Tipo

Largo
Max

Validación

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota Déb.
Electr.

Nota
Créd.
Electr.

OBLIGATORIEDAD
Gastos
Menor.
Electr.

Compras
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

Código Interno del
Comprador

<CodigoInternoComprador>
Responsable de pago
<ResponsablePago>
Información Adicional
Comprador
<Informacionadicionalcomprad
or>
FIN ÁREA
ÁREA
<InformacionesAdicionales>
Fecha Embarque
<FechaEmbarque>
Número de Embarque
<NumeroEmbarque>
Número de Contenedor
<NumeroContenedor >
Número de Referencia
<NumeroReferencia>
Nombre Puerto Embarque
<NombrePuertoEmbarque>

Condiciones de Entrega
<CondicionesEntrega>

53

54

55

56

57

58

59

60

61

62

63

Para identificación interna del
comprador, por ejemplo, código del
cliente, número de medidor, etc.
Corresponde a la identificación del
que realiza el pago del documento.

20

ALFA
NUM

a) Sin validación

20

ALFA

a) Sin validación

Otra información relativa al
comprador.

150

ALFA
NUM

a) Sin validación

COMPRADOR

INFORMACIONES ADICIONALES

10

25

100

20

40

ALFA
NUM
ALFA
NUM
ALFA
NUM

NUM

ALFA
NUM

a)Fecha válida:
Formato (dd-MM-AAAA)
a) Sin validación

a) Sin validación

a) Sin validación

a) Sin validación

a

la

del

fecha

Corresponde
embarque.
Dato  correspondiente  al  número  de
embarque.
Dato  correspondiente  al  número  de
contenedor.
Dato  correspondiente  al  número  de
referencia.
Nombre del puerto de embarque de
la mercancía.
Se refiere a los términos comerciales
fijados  por  el  comprador  y  el
vendedor referente a las condicones
de  entrega  de  las  mercancías  y/o
productos.

31

3

3

3

3

3

3

3

3

0

N

N

N

N

N

N

N

N

3

ALFA

a) Sin validación

N

0

Total FOB
<TotalFob>

Seguro
<Seguro>

Se indica si es CIF, FOB, etc.
Corresponde a la suma del valor FOB
de todas las mercancías.
Corresponde  al  monto  total  de  la
prima que figura en el documento de
embarque  o  el  documento  que
certifica el valor de la prima asignada
por la compañía aseguradora.

18

NUM

a) Valor numérico de 16
enteros, 2 decimales; > 0

N

0

18

NUM

a) Valor numérico de 16
enteros, 2 decimales; > 0

N

0

Pág. 15 de 87

32

3

3

3

3

3

3

3

3

0

0

0

0

33

3

3

3

3

3

3

3

3

0

0

0

0

34

3

3

3

3

3

3

3

3

0

0

0

0

41

3

3

3

0

0

0

0

0

0

0

0

0

43

0

0

0

0

0

0

0

0

0

0

0

0

44

3

3

3

3

3

3

3

3

0

0

0

0

45

3

3

3

3

3

3

3

3

0

0

0

0

46

3

3

3

3

3

3

3

3

3

3

3

3

47

0

0

0

0

0

0

0

0

0

0

0

0

64

65

66

67

68

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Flete
<Flete>

Otros Gastos
<OtrosGastos>

Corresponde al importe pagado por el
traslado  de  la  mercancía  de  puertos
dominicanos al extranjero.

Importe  sobre  gastos  por  otros
servicios,  hasta  el  transporte  de  las
mercancías en la aduana de destino.

18

NUM

a) Valor numérico de 16 enteros, 2
decimales; > 0

18

NUM

a) Valor numérico de 16 enteros, 2
decimales; > 0

Total CIF
<TotalCif>

Corresponde  al  valor  FOB,  Flete,
Seguro y otros gastos.

18

NUM

a) Valor numérico de 16 enteros, 2
decimales; > 0

I

N

N

N

Fact.
Créd.
Fiscal
Electr.

31

0

0

0

Régimen Aduanero
<RegimenAduanero>

Nombre Puerto Salida
<NombrePuertoSalida>

69

Nombre Puerto Desembarque
<NombrePuertoDesembarque>

70

71

72

73

74

Peso Bruto
<PesoBruto>

Peso Neto
<PesoNeto>

Unidad Peso Bruto
<UnidadPesoBruto>

Unidad Peso Neto
<UnidadPesoNeto>

Cantidad de Bultos
<CantidadBulto>

Corresponde  al  régimen  aduanero  al
que se acoge la mercancía exportada,
según  se  encuentra  tipificada  en  la
DGA10.

35

ALFA

a) Sin validación

N

0

Nombre  del  puerto  de  donde  sale  la
mercancía,  distinto  al  puerto  de
embarque.
Nombre  del  puerto  de  destino  de  la
mercancía.

40

40

ALFA
NUM

ALFA
NUM

a) Sin validación

a) Sin validación

Corresponde  al  peso  bruto  del
contenedor.

18

NUM

Corresponde  a  peso  neto  del
contenedor.

18

NUM

a) Valor numérico de 16 enteros, 2
decimales;  >  0  (No  puede  ser
negativo)
a) Valor numérico de 16 enteros, 2
decimales;  >  0  (No  puede  ser
negativo)

Corresponde  a  la  unidad  de  medida
en la que se encuentra el peso bruto
de la mercancía.
Corresponde  a  la  unidad  de  medida
en la que se encuentra el peso neto de
la mercancía.
Corresponde  a  la  cantidad  de  bultos
que ampara el documento.

2

2

NUM

NUM

a)  Validar
IV
(Codificación de Unidad de medida)

la  Tabla

con

IV
a)  Validar
(Codificación de Unidad de medida)

la  Tabla

con

18

NUM

a) Valor numérico de 16 enteros, 2
decimales; > 0

N

N

N

N

N

N

N

0

0

3

3

3

3

3

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

32

0

0

0

0

0

0

3

3

3

3

3

33

0

0

0

0

0

0

3

3

3

3

3

34

0

0

0

0

0

0

3

3

3

3

3

41

0

0

0

0

0

0

0

0

0

0

0

43

0

0

0

0

0

0

0

0

0

0

0

44

0

0

0

0

0

0

3

3

3

3

3

45

0

0

0

0

0

0

3

3

3

3

3

46

3

3

3

3

3

3

3

3

3

3

3

Pagos
Exterior
Electr.

47

0

0

0

0

0

0

0

0

0

0

0

10 Dirección General de Aduanas.

Pág. 16 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Unidad Bultos
<UnidadBulto>
Volumen
<VolumenBulto>

Unidad Volumen
<UnidadVolumen>

Corresponde  a  la  unidad  de  medida
en la que se encuentra los bultos.
Corresponde  al  volumen  de
bultos.
Corresponde  a  la  unidad  de  medida
en la que se encuentra el volumen de
los bultos.

los

FIN ÁREA

INFORMACIONES ADICIONALES

ÁREA
<Transporte>

TRANSPORTE

2

NUM

18

NUM

2

NUM

Vía Transporte
<ViaTransporte>

Se  especifica  si  el  transporte  es  vía
marítima, terrestre o aérea.

2

NUM

con

la  Tabla

a)  Validar
IV
(Codificación de Unidad de medida)
a) Valor numérico de 16 enteros, 2
decimales; > 0

a)  Validar
IV
(Codificación de Unidad de medida)

la  Tabla

con

Se tiene que validar:
01: Terrestre
02: Marítimo
03: Aérea

I

N

N

N

Fact.
Créd.
Fiscal
Electr.

31

3

3

3

3

N

0

País Origen
<PaisOrigen>

Corresponde  al  país  de  origen  de  la
mercancía.

60

ALFA

 a) Sin validación

N

0

Dirección Destino
<DireccionDestino>

País Destino
<PaisDestino>

la

Corresponde a la dirección de destino
donde sera realizado el envío del ítem
(distinto
del
a
comprador).
Corresponde  al  país  destino  donde
ítem
sera  realizado  el  envío  del
(distinto a país del comprador).

dirección

100

ALFA
NUM

a) Sin validación

N

0

60

ALFA

 a) Sin validación

N

0

RNC o Identificación
Compañía Transportista
<RNCIdentificacionCompani
aTransportista>
Nombre Compañía
Transportista
<NombreCompaniaTranspor
tista>
Número de Viaje
<NumeroViaje>

Corresponde  al  dato  de  RNC  o  de
Identificación  de  la  compañía  que
realiza el transporte.

Corresponde  al  dato  del  nombre  o
razón  social  de
la  compañía  que
realiza el transporte.

Corresponde al número de viaje o el
número del vuelo.

20

150

20

ALFA
NUM

ALFA
NUM

ALFA
NUM

a) Sin validación

N

0

a) Sin validación

N

0

a) Sin validación

N

0

Pág. 17 de 87

75

76

77

78

79

80

81

82

83

84

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

3

3

3

3

0

0

0

0

0

0

0

33

3

3

3

3

0

0

0

0

0

0

0

34

3

3

3

3

0

0

0

0

0

0

0

41

0

0

0

0

0

0

0

0

0

0

0

43

0

0

0

0

0

0

0

0

0

0

0

44

3

3

3

3

0

0

0

0

0

0

0

45

3

3

3

3

0

0

0

0

0

0

0

46

3

3

3

3

3

3

3

3

3

3

3

47

0

0

0

0

0

0

0

3

0

0

0

85

86

87

88

89

90

91

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Conductor
<Conductor>

Corresponde al código o nombre
del conductor.

20

ALFA
NUM

a) Sin validación

Documento
<DocumentoTransporte>

Corresponde al documento de
transporte del conductor.

20

NUM

a) Sin validación

Ficha
<Ficha>

Placa
<Placa>

Corresponde  a
transporte.

la  ficha  del

Corresponde  al  número  de
del
del
placa
transporte.

vehículo

Ruta de Transporte
<RutaTransporte>

Corresponde
establecida de transporte.

la

a

ruta

Zona de Tranporte
<ZonaTransporte>

Corresponde  a
transporte.

la  zona  de

Número Albarán
<NumeroAlbaran>

Corresponde  al  número  de
albarán de entrega.

FIN ÁREA
ÁREA
<Totales>

TRANSPORTE

TOTALES

10

7

20

20

20

ALFA
NUM

ALFA
NUM

ALFA
NUM

ALFA
NUM

ALFA
NUM

a) Sin validación

a) Sin validación

a) Sin validación

a) Sin validación

a) Sin validación

92

Monto Gravado Total11
<MontoGravadoTotal>

ITBIS

gravado

Total  de  la  suma  de  valores  de
monto
a
diferentes tasas.
Condicional a que exista Monto
gravado1, y/o Monto gravado 2
y/o Monto gravado 3.

18

NUM

a)  Valor  numérico  de  16  enteros,  2
decimales;  ≥  0
(No  puede  ser
negativo).
b) Valor numérico de la sumatoria del
total  Monto  gravado  ITBIS  Tasa1  +
Monto gravado ITBIS Tasa 2 + Monto
gravado ITBIS Tasa3.

I

2

11 En los campos donde existan valores numéricos de 16 enteros y 2 decimales, se debe aplicar la regla de redondeos.

Pág. 18 de 87

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota Déb.
Electr.

Nota
Créd.
Electr.

OBLIGATORIEDAD
Gastos
Menor.
Electr.

Compras
Electr.

N

N

N

N

N

N

N

31

3

3

3

3

3

3

3

1

32

3

3

3

3

3

3

3

1

2

33

3

3

3

3

3

3

3

34

3

3

3

3

3

3

3

1

1

2

2

41

0

0

0

0

0

0

0

1

2

43

0

0

0

0

0

0

0

1

0

Regím.
Espec.
Electr.

44

3

3

3

3

3

3

3

1

0

Guber.
Electr.

Export.
Electr.

45

3

3

3

3

3

3

3

1

2

46

3

3

3

3

3

3

3

1

2

Pagos
Exterior
Electr.

47

0

0

0

0

0

0

0

1

0

Total  de  la  suma  de  valores  de
Ítems  gravados  asignados  a
ITBIS  tasa  1  (tasa  18%),  menos
descuentos  más  recargos. 12
Condicional a que en la línea de
ítem
detalle
gravado a tasa ITBIS1.

exista

algún

a)  Valor  numérico  de  16  enteros,  2
decimales;  ≥  0
(No  puede  ser
negativo).
b)  Suma  de  valores  del  monto  ítem
con  indicador  de  facturación=1 13 ,
menos descuentos más recargos.

c)  Si  el  indicador  monto  gravado  es
=1, se debe dividir la suma de valores
del  monto  ítem  con  indicador  de
facturación=1,  entre  (1+tasa  ITBIS
tasa  1),  menos  descuentos  más
recargos.

18

NUM

N

2

2

2

2

2

0

0

2

0

0

d) Si el campo ‘Indicador de la norma
10-07’ es completado, se debe dividir
la suma de valores del monto ítem con
indicador  de
facturación=1,  entre
(1+tasa ITBIS tasa 1+tasas de códigos
de  impuestos  adicionales  002  y  004,
asignados
existe
descuento,  el  monto  de  descuento
correspondiente  no se deberá rebajar
del monto gravado ITBIS tasa 1.

ítem).

al

Si

Total  de  la  suma  de  valores  de
Ítems  gravados  asignados  a
ITBIS  tasa  2(tasa  16%),  menos
descuentos más recargos.

18

NUM

Condicional a que en la línea de
ítem
detalle
gravado a tasa ITBIS2.

exista

algún

a)  Valor  numérico  de  16  enteros,  2
decimales;  ≥  0
(No  puede  ser
negativo).

b)  Suma  de  valores  del  monto  ítem
con
facturación=2,
menos descuentos más recargos.

indicador  de

c) Si el indicador monto gravado=1, se
debe dividir el resultado por (1+ ITBIS
tasa 2).

N

2

2

2

2

2

0

0

2

0

0

93

Monto Gravado ITBIS Tasa 1
<MontoGravadoI1>

94

Monto Gravado ITBIS
Tasa 2
<MontoGravadoI2>

12 Se refiere al descuento o recargo global (Sección Descuentos o Recargos). Si el campo ‘Indicador Norma 10-07’ de la sección de Descuentos o Recargos es completado, dicho descuento no se deberá rebajar del monto gravado ITBIS Tasa
1 (18%).
13 El campo ‘Inidicador de Facturación’ se encuentra en la sección de Detalle de Bienes o Servicios.

Pág. 19 de 87

I

Fact.
Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Gub.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

OBLIGATORIEDAD

31

32

33

34

41

43

44

45

46

47

N

2

2

2

2

2

0

0

2

2

0

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

a)  Valor  numérico  de  16  enteros,  2
decimales≥ 0 (No puede ser negativo).

18

NUM

b)  Suma  de  valores  del  monto  ítem  con
facturación=3,  menos
de
indicador
descuentos más recargos.

a)  Valor  numérico  de  16  enteros,  2
decimales. ≥ 0 (No puede ser negativo).

95

Monto Gravado ITBIS
Tasa 3
<MontoGravadoI3>

96

97

98

Monto Exento
<MontoExento>

ITBIS Tasa 1
<ITBIS1>

ITBIS Tasa 2
<ITBIS2>

Total  de  la  suma  de  valores  de  Ítems
gravados asignados a ITBIS tasa 3 (tasa
0%), menos descuentos más recargos.

Condicional a que en la línea de detalle
exista algún ítem gravado a tasa ITBIS3.

Total  de  la  suma  de  valores  de  ítems
exentos,  menos  descuentos  más
recargos.

Condicional a que en la línea de detalle
exista algún ítem exento.

Tasa de ITBIS 1 (18%).
Condicional a que en la línea de detalle
exista ítem gravado a tasa 1.

Tasa  de  ITBIS  2  (16%).  Condicional  a
que en la línea de detalle exista ítem
gravado a tasa 2.

18

NUM

b)  Suma  de  valores  del  monto  ítem  con
indicador
facturación=4,  menos
de
descuentos más recargos.

I

2

2

NUM

a) 2 enteros en porcentaje Ej.: 18%
b) Existe ítem con indicador de facturación=1

N15

2

2

NUM

a) 2 enteros en porcentaje Ej.: 16%.
b) Existe ítem con indicador de facturación=2.

N

2

2

2

2

2

214

2

2

0

2

2

2

2

2

2

2

2

2

0

0

0

2

0

0

0

2

0

0

14 Los montos sustentados en Comprobantes de Gastos Menores Electrónicos, no podrán ser utilizados como adelanto del ITBIS.
15 La impresión puede ser parte del título del campo.

Pág. 20 de 87

CAMPOS

ITBIS Tasa 3
<ITBIS3>

Total ITBIS
<TotalITBIS>

99

100

101

Total ITBIS Tasa 1
<TotalITBIS1>

102

103

Total ITBIS Tasa 2
<TotalITBIS2>

Total ITBIS Tasa3
<TotalITBIS3>

Monto del Impuesto
Adicional
<MontoImpuestoAdicional>

104

Tasa de ITBIS 3 (0%).
Condicional a que en la línea de detalle
exista ítem gravado a tasa 3.

Total  de  la  suma  de  valores  de  ITBIS  a
diferentes  tasas.  Condicional  a  que
exista Total ITBIS Tasa 1, y/o Total ITBIS
Tasa 2 y/o Total ITBIS Tasa 3.

Valor numérico igual a Monto Gravado
ITBIS  Tasa1  por
ITBIS  1.
Condicional  a  que  exista  Monto
Gravado tasa 1 y tasa ITBIS 1.

la  Tasa

Si  existen
impuestos  selectivos  al
consumo  que  formen  parte  de  la  base
imponible del ITBIS, estos se sumaran al
monto  gravado  antes  de  multiplicarlo
por la tasa de ITBIS.

Valor numérico igual a Monto Gravado
ITBIS Tasa2*tasa ITBIS 2.
Condicional  a  que  exista  Monto
Gravado tasa 2 y tasa ITBIS 2.

Valor  numérico  igual  a  Monto  gravado
ITBIS Tasa3*tasa ITBIS 3.
Condicional a que exista Monto Gravado
tasa 3 y tasa ITBIS 3.

Selectivo

los  campos  Monto
Sumatoria  de
Impuesto
Consumo
Específico,  Monto  Impuesto  Selectivo
Ad  Valorem  y  Monto  Otros  Impuestos
Adicionales.

al

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact.
Créd.
Fiscal
Electr.

31

2

NUM  a) 1 entero en porcentaje Ej.: 0%.

b)
Existe
facturación=3.

ítem

con

indicador

de

N

2

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Gub.
Electr.

Export.
Electr.

32

2

33

2

34

2

41

2

43

0

44

0

45

2

46

2

Pagos
Exterior
Electr.

47

0

18

NUM

18

NUM

18

NUM

a)  Valor  numérico  de  16  enteros,  2
decimales; ≥ 0 (No puede ser negativo).
b) Suma de Total ITBIS Tasa 1 + Total ITBIS
Tasa 2 + Total ITBIS Tasa 3.

a)  Valor  numérico  de  16  enteros,  dos
decimales; ≥ 0 (No puede ser negativo).
b) Total ITBIS Tasa1= Monto Gravado ITBIS
tasa1 *ITBIS tasa .

Solo forman parte de la base imponible del
ITBIS  los  impuestos  selectivos  al  consumo
códigos  desde  006  hasta  039
con
correspondientes a la Tabla de Codificación
de Tipos de Impuestos Adicionales.

a)  Valor  numérico  de  16  enteros,  dos
decimales; ≥ 0 (No puede ser negativo).

b)  Total  ITBIS  Tasa2=  Monto  Gravado  ITBIS
tasa2*ITBIS tasa 2.

18

NUM

a)Valor  numérico  de  16  enteros,  dos
decimales; ≥ 0 (No puede ser negativo).

a) Valor  numérico  de  16  enteros,  dos
decimales; >0 (debe ser positivo).

18

NUM

b) Monto del Impuesto Adicional=  Monto
Impuesto Selectivo al Consumo Específico+
  Monto  Impuesto  Selectivo  Ad  Valorem+
Monto Otros Impuestos Adicionales.

I

2

2

2

2

2

0

0

2

2

0

N

2

2

2

2

2

0

0

2

0

0

N

2

2

2

2

2

0

0

2

0

0

N

2

2

2

2

2

0

0

2

2

0

I

2

2

2

2

0

0

216

2

0

0

16 Es condicional a que exista impuesto adicional con código desde 001 hasta 005 de la Tabla I  (Codificación Tipos de Impuestos Adicionales), es decir Otros Impuestos Adicionales.

Pág. 21 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Tabla de
Impuestos Adicionales
<ImpuestosAdicionales>17

Se  pueden  incluir  20  repeticiones  de
pares  código  –  valor.  Incluye  los  cinco
campos siguientes:

a)  Condicional  a  que  exista  otros(s)
impuesto(s) en la línea de detalle distinto(s) al
ITBIS.

I

Fact.
Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Gub.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

OBLIGATORIEDAD

31

2

32

2

33

2

34

2

41

0

43

0

44

218

45

2

46

0

47

0

105

Código de Impuesto
Adicional
<TipoImpuesto>

Dato  correspondiente  al  Código  del
impuesto  adicional  de  acuerdo  con  la
Tabla I (Codificación Tipos de Impuestos
Adicionales).

3

NUM

a)  Validar  con  Tabla  I  (Codificación  Tipos  de
Impuestos Adicionales).

N

2

2

2

2

0

0

219

2

0

0

106

Tasa de Impuesto Adicional
<TasaImpuestoAdicional>

Dato  correspondiente  a
Impuesto Adicional.
Se debe indicar la tasa de Impuesto. 20

la  Tasa  del

5

NUM

107

Monto Impuesto Selectivo
al Consumo Específico22
<MontoImpuestoSelectivoCons
umoEspecifico>

Valor del impuesto selectivo al consumo
(ISC)  específico  asociado  al  código  de
impuesto  adicional.  Condicional  a  que
exista código del 006 al 02223.
El  cálculo  del  monto  del  ISC  específico
dependerá de la tasa correspondiente al
la  Tabla
impuesto  en
código  del
I
Impuestos
Tipos  de
(Codificación
Adicionales).

18

NUM

a) Validar  con  Tabla  I  (Codificación  Tipos  de
Impuestos Adicionales).

b) Si  la  tasa  corresponde  a  los  códigos  entre
006 hasta 022 de la Tabla I (Codificación Tipos
de Impuestos Adicionales), se debe validar que
coincide  con  la  tasa  vigente  en  el  período  al
que corresponda la fecha de emisión del e-CF
(campo fecha emision).
a) Valor  numérico  de  16  enteros,  dos
decimales; >0 (debe ser positivo).

b) Si el código del impuesto se encuentra entre
006  hasta  018  se  debe  verificar  la  unidad  de
medida del ítem, si es a granel (código 18) no
se  deberá  calcular  el  Impuesto  Selectivo  al
Consumo Específico.

c) Para los ítems con códigos 006 al 018 de la
‘Tabla  I  (Codificación  Tipos  de  Impuestos

N21

2

2

2

2

0

0

2

2

0

0

N

2

2

 2

2

0

0

0

2

0

0

17 Ver nota 2.
18 Ver nota 16.
19 Aplica solo para códigos de la Tabla de Codificación Tipos de Impuestos Adicionales desde 001 hasta 005.
20 En el caso del Impuesto Selectivo al Consumo Específico la tasa varía trimestralmente por ajustes de inflación, por lo que para este impuesto, el dato de este campo debe coincidir con la tasa válida en el período al que corresponda la
fecha de emisión del e-CF.
21 La tasa puede ser parte del título del campo impreso.
22 Este campo será completado cuando se refiera a la facturación de bienes cuya transferencia, a nivel de productor o fabricante, está gravada con Impuesto Selectivo al Consumo (aplica para los campos de Específico y Advalorem).
23 Si en la factura existen códigos de Impuesto Adicional entre 006 al 039, se deberá siempre realizar el cálculo del campo Monto ISC Específico, exceptuando cuando la unidad de medida del ítem es a granel (código 18 de la tabla de
Codificación Unidad de Medida). Si existen estos códigos y el campo no viene, se rechaza la factura.

Pág. 22 de 87

Adicionales)  y  unidad  de  medida  distinta  de
granel,  se  debe  multiplicar  la  cantidad  de
referencia  por  los  grados  de  alcohol,  por  la
tasa  del  impuesto  indicada  en  la  tabla  para
dicho código, por la subcantidad y cantidad.

la  cantidad  por

d)  Para  los  códigos  del  019  al  022,  se  debe
calcular  multiplicando
la
cantidad  de  referencia,  por
la  tasa  del
impuesto adicional indicado.
a) Valor  numérico  de  16  enteros,  dos
decimales; >0 (debe ser positivo).

b) Si el código del impuesto se encuentra entre
023  hasta  035  se  debe  verificar  la  unidad  de
medida del ítem, si es a granel (código 18) se
deberá  calcular  el  Impuesto  Selectivo  Ad
Valorem  incrementando  en  un  treinta  por
ciento  (30%)  el  precio  unitario  del
ítem
(equivalente al precio de lista) por la cantidad
ítem
impuesto
tasa
la
correspondiente.

por

del

N

2

2

 2

2

0

0

0

2

0

0

18

NUM

c) Para  los  ítems  con    código  entre  023-035
(ISC  Ad  valorem) 25 ,  y  unidad  de  medida
distinta  de  granel,    se  debe  dividir  el  precio
unitario de referencia entre (1+tasa ITBIS tasa
1).  Este  resultado  se  debe  restar  del  ISC
Especifico Unitario26 y este último resultado se
debe  dividir  entre  (1+tasa  del
impuesto
adicional  especificado),  esto  dará  como
resultado la base imponible del impuesto. Esta
base  (ISC  Ad  Valorem  unitario)  se  deberá
multiplicar por la cantidad, por la cantidad de
referencia  y  por
impuesto
correspondiente.

la  tasa  del

d)  Cuando el código del impuesto adicional sea

Monto Impuesto Selectivo
al Consumo
 Ad Valorem
<MontoImpuestoSelectivoCons
umoAdvalorem>

108

Valor del impuesto selectivo al consumo
(ISC)  ad  valorem  asociado  al  código  de
impuesto  adicional.  Condicional  a  que
exista código del 023 al 03924.

El cálculo del monto del ISC       ad valorem
dependerá de la tasa correspondiente al
impuesto  en
código  del
I
(Codificación
Impuestos
de
Adicionales).

la  Tabla

Tipos

24 Si en la factura existen códigos de Impuesto Adicional entre 023 al 039, se deberá siempre realizar el cálculo del campo Monto ISC Específico, exceptuando el ítem con unidad de medida 18. Si existen estos códigos y el campo no viene,
se rechaza la factura. Si la unidad de medida corresponde al código 18, se deberá calcular el Impuesto Selectivo al Consumo Ad Valorem incrementando en un treinta por ciento (30%) el precio unitario del ítem (equivalente al precio de
lista).
25 Si el código del impuesto se encuentra entre 023 al 035 se deberá realizar primero el cálculo del Monto ISC Específico para luego realizar el del Monto ISC Ad Valorem, exceptuando cuando la unidad de medida del ítem es a granel
(código 18 de la tabla de Codificación Unidad de Medida).
26 El ISC Especifico Unitario es igual al resultado del Monto ISC específico entre el resultado de la cantidad de ítem multiplicado por la cantidad de referencia.

Pág. 23 de 87

entre 036-039 según la ‘Tabla de Codificación
Impuestos  Adicionales’  se  debe
Tipos  de
calcular  el
impuesto  dividiendo  el  precio
unitario de referencia entre (1+tasa ITBIS tasa
1). Este resultado se debe restar la tasa del ISC
Específico y el resultado se debe dividir entre
(1+tasa  del  impuesto  adicional  especificado);
esto  dará  como  resultado  la  base  imponible
para  el  ISC  Ad  Valorem.  Esta  base  se  debe
multiplicar por la cantidad, por la cantidad de
referencia  y  por
impuesto
la
correspondiente.

tasa  del

por

a)  Valor  numérico  de  16  enteros,  dos
decimales; >0 (debe ser positivo).
b)    Si  el  código  del  impuesto  se  encuentra
entre  001  al  005,  se  deben  multiplicar  los
montos  ítems  por  la  tasa  correspondiente  al
código de impuesto adicional.
c)  Para  los  códigos  001,  002,  003  y  004,  si  el
indicador monto gravado=1, se debe dividir el
monto  de  ítem  entre  (1+  ITBIS  tasa  1),  y  el
la
resultado  multiplicar
tasa
impuesto
correspondiente  al  código  de
adicional.
d)  Para  los  códigos  002  y  004,  si  el  campo
‘Indicador  Norma  10-07’ 27  de
la  sección
Descuentos  o  Recargos  es  completado,  se
debe dividir la suma de los valores del monto
ítem  con  indicador  de  facturación=1,  entre
(1+tasa  ITBIS  tasa  1+  tasa  del  código  de
impuesto  adicional  002  +  tasa  del  código  de
004),
luego
impuesto
la
multiplicar  este
tasa
resultado  por
correspondiente  al  código  de
impuesto
adicional.
e)  Si  existe  descuento  global  se  debe
multiplicar  el  porcentaje  del  monto  ítem  por
línea28 por el Monto Descuento (global), esto
dará  como  resultado  el  monto  de  descuento
aplicable para cada línea de detalle.

adicional

para

Valor del impuesto adicional asociado al
adicional.
código
Condicional a que exista código del 001
al 005.

impuesto

de

 109

Monto Otros Impuestos
Adicionales
<OtrosImpuestosAdicionales>

El  cálculo  del  monto  del
impuesto
tasa
adicional  dependerá  de
la
correspondiente al código del impuesto
en  la  Tabla  I  (Codificación  Tipos  de
Impuestos Adicionales).

18

NUM

N N

2

2

 2

2

0

0

229

2

0

0

27 El campo ‘Indicador norma 10-07’ está incluido en la sección de Descuentos o Recargos.
28 Resultado de dividir el valor colocado en el campo ‘Monto Ítem’ de cada línea de la sección de Detalle de Bienes o Servicios entre la sumatoria de los montos ítems.
29 Ver nota 16.

Pág. 24 de 87

o

Recargos

Descuentos

indicado,  para

Si  el  código  del  impuesto  se  encuentra  entre
001,  002,  003  y  004,  se  debe  tomar  la
sumatoria  de  los  montos  ítems  asignados  al
código  y  restar  los  montos  de  descuentos
luego
aplicables  al  código
multiplicar  este  resultado  por  la  tasa  del
código  de  impuesto  adicional,  es  decir:  ( ∑
ítems- ∑ montos  descuentos
montos
aplicable)  *Tasa  Código  del
Impuesto
Adicional.
Si  el  campo  ‘Indicador  Norma  10-07’  de  la
sección
es
completado,
el  monto  de  descuento
correspondiente no se deberá considerar.
f) Si existe recargo global se debe multiplicar el
porcentaje  del  monto  ítem  por  línea28  por  el
Monto  Recargo  (global),  esto  dará  como
resultado el monto de recargo aplicable para
cada línea de detalle.
Si  el  código  del  impuesto  se  encuentra  entre
001, 002 y 004, se debe tomar la sumatoria de
los  montos  ítems  asignados  a  los  códigos  y
sumar  los  montos  de  recargos  aplicables  al
código  indicado,  para  luego  multiplicar  este
resultado  por  la  tasa  del  código  de  impuesto
adicional,  es  decir:  ( ∑ montos  ítems+ ∑
montos  recargos  aplicable)  *Tasa  Código  del
Impuesto Adicional.

FIN TABLA

IMPUESTOS ADICIONALES

110

Monto Total
<MontoTotal>

Monto  Gravado  Total  +  Monto  exento
+Total
Impuesto
adicional.

ITBIS  +  Monto  del

18

NUM

a)  Valor  numérico  de  16  enteros,  dos
decimales; ≥ 0 (No puede ser negativo)
b) Valor numérico de acuerdo con el total de la
sumatoria del campo de Descripción.
c)Si  es  completada  la  sección  Paginación,  el
monto total debe ser igual a la sumatoria del
Página’
‘Monto
campo
correspondiente a la sección.

Subtotal

d) Si se emite un e-CF tipo 34, el monto total
deberá ser menor o igual al monto total del e-
CF modificado.30

I

1

1

1

1

1

1

1

1

1

1

30 Si un e-CF es afectado por varias notas de crédito electrónicas, la sumatoria de los montos de las notas de crédito deberá ser menor o igual al monto total del e-CF que se afecta.

Pág. 25 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Total de la suma de montos de
bienes
con
Indicador de facturación=0.

servicios

o

111

Monto no Facturable
<MontoNoFacturable>

Condicional a que en la línea de
detalle  exista  algún  ítem  con
indicador  facturación  igual  a
cero (0).

18

NUM

a)  Valor  numérico  de  16  enteros,  dos
decimales. (Puede ser negativo)

b) Valor numérico de acuerdo con el total
sumatoria  monto  ítem  con  indicador  de
facturación=0.

Monto Período
<MontoPeriodo>

Total  de  la  suma  de  Monto
Total y Monto no Facturable.

18

NUM

a)  Valor  numérico  de  16  enteros,  dos
decimales. (Puede ser negativo)

b)  Monto  período=  Monto  Total+Monto
No Facturable.

Saldo Anterior
<SaldoAnterior>

Monto Avance de pago
<MontoAvancePago>

fines  de

Saldo Anterior. Se incluye sólo
con
ilustrar  con
claridad el cobro.
Pago parcial por adelantado de
la factura que se emite.

18

NUM

18

NUM

Valor  numérico  de  16  enteros,  dos
decimales. (Puede ser negativo).

112

113

114

115

Valor a pagar
<ValorPagar>

Valor cobrado.

18

NUM

a) Valor  numérico  de  16  enteros,  dos
decimales. >0 (No puede ser negativo)
a)Valor  numérico  de  16  enteros,  dos
decimales. (Puede ser negativo o cero)
b)Valor  a  pagar=  Monto  total-Monto
Avance  de  pago  ±  Saldo  Anterior  (±
atendiendo  si  el  valor  es  positivo  o
negativo).
c) Si el campo ‘Indicador Norma 10-07’ de
la  sección  Descuento  o  Recargo  es
completado, entonces:
Valor  a  pagar=  Monto  total-Monto
descuento 31-  Monto  Avance  de  pago  ±
Saldo Anterior (± atendiendo si el valor es
positivo o negativo).

I

Fact.
Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

OBLIGATORIEDAD

31

32

33

34

41

43

44

45

46

47

N

2

2

2

2

0

0

2

2

2

0

N

N

N

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

3

N

3

3

3

3

3

3

3

3

3

3

31 Si en la sección de Descuento o Recargo existe mas de una línea de descuento, se deberá colocar la sumatoria de los descuentos que tiene completado el ‘Indicador Norma 10-07’.

Pág. 26 de 87

OBLIGATORIEDAD

Fact.
Créd.
Fiscal
Electr.

31

2

I

N

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

0

33

34

41

2

2

2

43

0

44

0

45

0

46

47

0

0

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

18

NUM

a) Valor numérico de 16 enteros, dos
decimales, ≥0 (No puede ser negativo)

b)  Campo Monto ITBIS Retenido de
la sección Detalle de B. o S.

a) Valor numérico de 16 enteros, dos
decimales, ≥0 (No puede ser negativo)

116

Total Monto ITBIS Retenido
<TotalITBISRetenido>

Total Monto Retención Renta
<TotalISRRetencion>

117

Monto del ITBIS correspondiente a la
retención  que  será  realizada  por  el
comprador. Condicional a que en la
línea de detalle exista retención.

Monto del Impuesto Sobre la Renta
correspondiente  a
retención
realizada de la prestación o locación
de servicios. Condicional a que en la
línea de detalle exista retención.

la

118

Total Monto ITBIS Percibido32
<TotalITBISPercepcion>

119

Total Monto Percepción Renta
<TotalISRPercepcion>

el

del

que

ITBIS

Monto
contribuyente cobra
a
terceros  como  adelanto  del
impuesto que éste  percibirá en  sus
operaciones. Condicional a que en la
línea de detalle exista percepción.

Monto del Impuesto Sobre la Renta
que  el  contribuyente  cobra  a
del
terceros
impuesto que éste  percibirá en  sus
operaciones. Condicional a que en la
línea de detalle exista percepción.

adelanto

como

18

NUM

N

2

0

2

2

2

0

0

0

0

2

b)Monto  Retención  Renta  de
sección Detalle de B. o S.

la

18

NUM

a)Valor  numérico  de  16  enteros,  dos
decimales, >0 (No puede ser negativo)

N

2

0

2

2

2

0

0

0

0

0

18

NUM

a) Valor numérico de 16 enteros, dos
decimales; >0 (No puede ser negativo)

N

2

0

2

2

2

0

0

0

0

0

FIN ÁREA
ÁREA
<OtraMoneda>

TOTALES ENCABEZADO

OTRA MONEDA ENCABEZADO

Condicional a que la facturación sea en
Otra Moneda.

2

2

2

2

2

2

2

2

2

2

32 Régimen de percepción no está vigente.

Pág. 27 de 87

CAMPOS

DESCRIPCIÓN

Tipo

Largo
Max

Validación

OBLIGATORIEDAD

I

Fact.
Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

120

Código Otra moneda
<TipoMoneda>

Moneda  alternativa  en  que  se
expresan  los  Montos.  Condicional  a
que  la  facturación  sea  realizada  en
moneda extranjera.33
Este  campo  debe  tener  uno  de  los
valores
‘Tabla
Codificación  Monedas’.  Por  ejemplo:
“USD” o “EUR”, etc.

indicados  en

la

a)  Validar  con  la  Tabla  II
(Codificación Monedas).

3

ALFA

N

2

2

2

2

2

2

2

2

2

2

121

Tipo de Cambio
<TipoCambio>

Factor de conversión utilizado.
Condicional  a  que  existan  datos  en
código otra moneda.

7

NUM

a)  Valor  numérico  de  3
enteros  y  4  decimales;  >  0.
(Debe ser positivo)

122

Monto gravado total Otra
Moneda
<MontoGravadoTotalOtraMoneda>

Total  de  la  suma  de  valores  de
Monto gravado ITBIS Otra Moneda
a diferentes tasas.

Condicional  a  que  exista  datos  en
código  otra  moneda  y  Monto
gravado  ITBIS  en  otra  moneda  a
distintas tasas (18%, 16% y 0%).

18

NUM

a)  Valor  numérico  de  16
enteros, 2 decimales; ≥ 0 (No
puede ser negativo)
la
b)  Valor  numérico  de
sumatoria  del  total  Monto
gravado
ITBIS  Tasa1  Otra
Moneda  +  Monto  gravado
ITBIS  Tasa  2  Otra  Moneda
+Monto gravado ITBIS Tasa3
Otra Moneda.

N

2

2

2

2

2

2

2

2

2

2

N34

2

2

2

2

2

0

0

2

2

0

33 La condición está sujeta a la especificación del contribuyente, es decir, si éste indica que la facturación es realizada en otra moneda.
34 La impresión de los campos en otra moneda es condicional a que existan transacciones en otras monedas. Si existen transacciones en otras monedas, dichos campos pueden ser impresos en la RI sin ser necesario incluir los de moneda
local, debido a que ambas informaciones se encuentran en el formato XML de e-CF. Aplicable a los campos en moneda extranjera.

Pág. 28 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

OBLIGATORIEDAD

123

Monto gravado ITBIS Tasa 1
Otra Moneda
<MontoGravado1OtraMoneda>

124

Monto gravado ITBIS Tasa 2 Otra
Moneda
<MontoGravado2OtraMoneda>

Total  de  la  suma  de  valores  de
Ítems  gravados  asignados  a
ITBIS  tasa  1  (tasa  18%),  menos
descuentos  en  Otra  Moneda
más
Otra
Moneda35.
(Asignados  a  ítem  gravados  en
Otra Moneda).

recargos

en

Condicional  a  que  exista  datos
en código otra moneda y el ítem
de
contenga
facturación igual a 1.

indicador

Total  de  la  suma  de  valores  de
Ítems  gravados  asignados  a
ITBIS  tasa  2  en  Otra  Moneda
(tasa  16%),  menos  descuentos
en  Otra  Moneda  más  recargos
en  Otra  Moneda.  (Asignados  a
ítem
en  Otra
Moneda).

gravados

Condicional  a  que  exista  datos
en código otra moneda y el ítem
contenga
de
facturación igual a 2.

indicador

18

NUM

18

NUM

a)  Valor  numérico  de  16
enteros, 2 decimales; ≥ 0 (No
puede ser negativo).

b)  Suma  de  valores  del
monto ítem con indicador de
facturación=1,
menos
descuentos  en  Otra  Moneda
más
en  Otra
Moneda.

recargos

indicador  monto
c)  Si  el
gravado=1, se debe dividir el
resultado  por  (1+tasa  ITBIS
tasa 1)
a)  Valor  numérico  de  16
enteros, 2 decimales; ≥ 0 (No
puede ser negativo).

con

b) Suma de valores del monto
ítem
indicador  de
menos
facturación=2,
descuentos  en  Otra  Moneda
más
en  Otra
Moneda.

recargos

N

2

2

2

2

2

0

0

2

0

0

N

2

2

2

2

2

0

0

2

0

0

35 Se refiere al descuento y recargo global (Sección Descuentos o Recargos).

Pág. 29 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

OBLIGATORIEDAD

I

Fact.
Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

125

Monto gravado ITBIS Tasa 3
Otra Moneda
<MontoGravado3OtraMoneda>

126

Monto exento en Otra
Moneda
<MontoExentoOtraMoneda>

127

Total ITBIS en Otra Moneda
<TotalITBISOtraMoneda>

Total de la suma de valores de Ítems
gravados asignados a ITBIS tasa 3 en
Otra  Moneda  (tasa  0%),  menos
descuentos  en  Otra  Moneda  más
recargos
en  Otra  Moneda.
(Asignados a ítem gravados en Otra
Moneda).

Condicional  a  que  exista  datos  en
código  otra  moneda  y  el
ítem
contenga  indicador  de  facturación
igual a 3.

Total de la suma de valores de ítems
exentos, menos  descuentos  en  Otra
Moneda  más  recargos  en  Otra
Moneda (asignados a ítems exentos).

Condicional  a  que  exista  datos  en
código  otra  moneda  y  el
ítem
contenga  indicador  de  facturación
igual a 4.

Total de la suma de valores de ITBIS
en Otra Moneda a diferentes tasas.
Condicional a que exista Total ITBIS
Tasa  1  en  Otra  Moneda,  y/o  Total
ITBIS  Tasa  2  en  Otra  Moneda  y/o
Total ITBIS Tasa 3 en Otra Moneda.

18

NUM

18

NUM

a)  Valor  numérico  de  16
enteros, 2 decimales; ≥ 0 (No
puede ser negativo).

b)  Suma  de  valores  del
monto ítem con indicador de
menos
facturación=3,
descuentos en Otra Moneda
más
en  Otra
Moneda.

recargos

a)  Valor  numérico  de  16
enteros, 2 decimales; ≥ 0 (No
puede ser negativo).

con

 Suma  de  valores  del  monto
indicador  de
ítem
facturación=4,
menos
descuentos  en  Otra  Moneda
más
en  Otra
Moneda.
a)
Valor  numérico  de
16  enteros,  2  decimales;  ≥  0
(No puede ser negativo).

recargos

N

2

2

2

2

2

0

0

2

2

0

N

2

2

2

2

2

236

2

2

0

2

18

NUM

b) Suma de Total ITBIS Tasa 1
en Otra Moneda + Total ITBIS
Tasa  2  en  Otra  Moneda  +
Total  ITBIS  Tasa  3  en  Otra
Moneda.

N

2

2

2

2

2

0

0

2

2

0

36 Los montos sustentados en Comprobantes de Gastos Menores Electrónicos, no podrán ser utilizados como adelanto del ITBIS.

Pág. 30 de 87

CAMPOS

DESCRIPCIÓN

Tipo

Largo
Max

Validación

128

Total ITBIS Tasa 1 en Otra
Moneda
<TotalITBIS1OtraMoneda>

Valor  numérico  igual  a  Monto  Gravado
ITBIS en Otra Moneda Tasa1*tasa ITBIS 1.
Condicional  a  que  exista  Monto  gravado
ITBIS Tasa 1 Otra Moneda.

Condicional  a  que  exista  Monto  Gravado
tasa 1 en Otra Moneda.

18

NUM

129

Total ITBIS Tasa 2 en otra
moneda
<TotalITBIS2OtraMoneda>

Valor  numérico  igual  a  Monto  Gravado
ITBIS en Otra Moneda Tasa2*tasa ITBIS 2.

Condicional  a  que  exista  Monto  gravado
ITBIS Tasa 2 Otra Moneda.

18

NUM

130

Total ITBIS Tasa 3 en otra
moneda
<TotalITBIS3OtraMoneda>

Monto del Impuesto
Adicional en Otra
Moneda38
<MontoImpuestoAdicionalOt
raMoneda>

131

Valor  numérico  igual  a  Monto  Gravado
ITBIS en Otra Moneda Tasa3*tasa ITBIS 3.

Condicional  a  que  exista  Monto  gravado
ITBIS Tasa 3 Otra Moneda.
Sumatoria de los campos Monto Impuesto
Selectivo  al  Consumo  Específico  en  Otra
Moneda,  Monto  Impuesto  Selectivo  Ad
Valorem en Otra Moneda y Monto Otros
Impuestos Adicionales en Otra Moneda.

Condicional a que exista datos en código
otra moneda y exista al menos unos de los
campos  de  Monto  Impuesto  Selectivo  al
Consumo  Específico  en  Otra  Moneda,
Monto Impuesto Selectivo Ad Valorem en
Otra Moneda y/o Monto Otros Impuestos
Adicionales en Otra Moneda.

18

NUM

18

NUM

a)  Valor numérico de 16 enteros,
dos  decimales≥  0  (No  puede  ser
negativo).

 Total ITBIS Tasa1 en Otra
Moneda= Monto Gravado ITBIS
tasa1 Otra Moneda*ITBIS tasa
1.37
a)  Valor numérico de 16 enteros,
dos  decimales;  ≥0  (No  puede  ser
negativo).

Total ITBIS Tasa 2 en Otra
Moneda= Monto Gravado ITBIS
tasa2 Otra Moneda*ITBIS tasa 2.
a) Valor numérico de 16 enteros,
dos decimales; ≥ 0 (No puede ser
negativo).

a) Valor numérico de 16 enteros,
dos  decimales;  >0  (debe  ser
positivo).

b) Monto del Impuesto Adicional
en Otra Moneda=  Monto
Impuesto Selectivo al Consumo
Específico en Otra Moneda + 
Monto Impuesto Selectivo Ad
Valorem en Otra Moneda +
Monto Otros Impuestos
Adicionales en Otra Moneda.

OBLIGATORIEDAD

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

N

2

2

2

2

2

0

0

2

0

0

N

2

2

2

2

2

0

0

2

0

0

N

2

2

2

2

2

0

0

2

2

0

N

2

2

2

2

0

0

239

2

0

0

37 Cuando existan impuestos adicionales que formen parte de la base imponible del ITBIS, estos se deberán sumar al monto gravado ITBIS tasa 1 en Otra Moneda antes de multiplicarlo por la tasa ITBIS 1 (18%).
38 Para el cálculo de Monto del Impuesto Adicional en otra Moneda, se debe realizar primero los cálculos correspondientes en DOP($) y luego referenciar a la tasa de tipo de cambio del código Otra Moneda seleccionado.
39 Ver nota 16.

Pág. 31 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Tabla de
Impuestos Adicionales en Otra
moneda:

<ImpuestosAdicionalesOtraMoneda>
40

132

Código de Impuesto adicional en
Otra Moneda
<TipoImpuestoOtraMoneda>

133

Tasa de Impuesto adicional en
Otra Moneda
<TasaImpuestoAdicionalOtraMoneda
>

134

Monto Impuesto Selectivo al
Consumo Específico en Otra
Moneda
<MontoImpuestoSelectivoConsumoE
specificoOtraMoneda>

Se  pueden  incluir  20  repeticiones
de pares código – valor. Incluye los
cinco campos siguientes:

Dato correspondiente al Código del
impuesto adicional de acuerdo con
la  ‘Tabla  de  Codificación  Tipos  de
Impuestos Adicionales’.41

Dato correspondiente a la Tasa del
Impuesto Adicional. Se debe indicar
la tasa de Impuesto.

Valor del campo Monto Impuesto
Selectivo  al  Consumo  Específico
referenciado al tipo de cambio del
código Otra Moneda especificado.
Condicional a que exista código de
impuesto adicional del 006 al 022,
este completado el campo código
otra  moneda  y  el  campo  Monto
Impuesto Selectivo Específico.44

I

Fact.
Créd.
Fiscal
Electr.

31

2

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

2

2

2

33

34

41

2

2

0

2

2

2

2

0

0

43

0

0

0

44

2

242

2

45

2

2

2

46

47

0

0

0

0

0

0

Condicional  a  que  exista  otros(s)
impuesto(s)  en  la  línea  de  detalle
este
ITBIS
distinto(s)
completado el campo

al

y

3

NUM

a) Validar con Tabla I (Codificación
Tipos de Impuestos Adicionales)

N

2

5

NUM

a) Validar con Tabla I (Codificación
Tipos de Impuestos Adicionales)

N 43

2

18

NUM

a)  Valor  numérico  de  16  enteros,
dos  decimales;  >0
(debe  ser
positivo).

b)  Valor  del
campo  Monto
Impuesto  Selectivo  al  Consumo
Específico  dividiendo  por  la  tasa
especificada  en  el  campo  Tipo  de
Cambio.

N

2

2

 2

2

0

0

0

2

0

0

40 Ver nota 2.
41 Ver nota 38.
42 Ver nota 16.
43 La tasa puede ser parte del título del campo impreso.
44 El campo Monto de Impuesto Selectivo Específico correspondiente al área de Totales de la sección Encabezado.

Pág. 32 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

OBLIGATORIEDAD

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

135

Monto Impuesto Selectivo al
Consumo Ad Valorem en Otra
Moneda
<MontoImpuestoSelectivoConsumo
AdvaloremOtraMoneda>

136

Monto Otros Impuestos
Adicionales en Otra Moneda
<OtrosImpuestosAdicionalesOtraMo
neda>

FIN TABLA

137  Monto Total en Otra Moneda

<MontoTotalOtraMoneda>

del

campo  Monto

Valor
Impuesto
al  Consumo  Ad
Selectivo
Valorem referenciado al tipo de
cambio del código Otra Moneda
especificado.
Condicional a que exista código
de impuesto adicional del 023 al
039,  este completado el campo
código otra moneda y el campo
Monto  Impuesto  Selectivo  Ad
Valorem.45
Valor  del  Monto
Impuesto
Adicionales referenciado al tipo
de  cambio  del  código  Otra
Moneda especificado.
Condicional a que exista código
de impuesto adicional del 001 al
005,  este completado el campo
código otra moneda y el campo
Impuestos
Monto
Adicionales.46
IMPUESTOS ADICIONALES
Monto  gravado  total  en  Otra
Moneda  +  Monto  exento  en
Otra  Moneda+  Total  ITBIS  en
Otra  Moneda+  Monto  del
Impuesto  Adicional  en  Otra
Moneda.

Otros

Condicional  a  que  exista  al
menos  un  monto  en  otra
moneda.

18

NUM

18

NUM

a) Valor numérico de 16 enteros,
dos  decimales;  >0  (debe  ser
positivo).

a) Valor  del
campo  Monto
Impuesto  Selectivo  Ad  Valorem
dividiendo
tasa
por
especificada en el campo Tipo de
Cambio.

la

b) Valor numérico de 16 enteros,
dos  decimales;  >0  (debe  ser
positivo).

c)  Valor  del  campo  Monto  Otros
Impuesto  Adicional  dividiendo
por  la  tasa  especificada  en  el
campo Tipo de Cambio.

18

NUM

a)  Valor numérico de 16 enteros,
dos decimales; ≥ 0 (no puede ser
negativo).

 b) Valor numérico de acuerdo con
el  total  sumatoria  del  campo  de
Descripción.

N

2

2

 2

2

0

0

0

2

0

0

N

2

2

 2

2

0

0

247

2

0

0

N

2

2

2

2

2

2

2

2

2

2

45 El campo Monto de Impuesto Selectivo AdValorem correspondiente al área de Totales de la sección Encabezado.
46 El campo Monto Otros Impuestos Adicionales correspondiente al área de Totales de la sección Encabezado.
47 Ver nota 16.

Pág. 33 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

FIN ÁREA

OTRA MONEDA ENCABEZADO

FIN ÁREA

ENCABEZADO

OBLIGATORIEDAD

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

Pág. 34 de 87

B.  DETALLE DE BIENES O SERVICIOS

Corresponde a la información de un ítem. Debe ir al menos una línea de detalle, se puede incluir la cantidad  páginas que incluyan todos los ítems, respetando la normativa.

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

ÁREA
<DetallesItem>
ÁREA
<Item>

DETALLES ÍTEM

ÍTEM
Se pueden incluir hasta 100
repeticiones.

1

N° de Línea o N° Secuencial
<NumeroLinea>

Línea que numera el ítem.  Desde 1 a
100 repeticiones.48

5

NUM

a) Número secuencial de la
línea.

Tabla de Códigos de Ítem
<TablaCodigosItem>

2

3

Tipo Código
<TipoCodigo>

Código del Ítem
<CodigoItem>

Se  pueden  incluir  5  repeticiones  de
pares  código  –  valor.  Incluye  los  dos
campos siguientes:
Tipo  de  codificación  utilizada  para  el
ítem
Standard:  EAN,  PLU,  DUN  o  Interna
(Hasta 5 tipos de códigos)

Código del ítem de acuerdo a tipo de
codificación
campo
anterior.
(Hasta 5 códigos)

indicada  en

FIN TABLA

CÓDIGOS ÍTEM

14

35

ALFA
NUM

ALFA
NUM

a)Sin validación.

a)Sin validación.

N

3

I

Fact.
Créd.
Fiscal
Electr.

31

1

1

1

3

3

N

N

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

1

1

1

3

3

3

33

1

1

1

3

3

3

34

1

1

1

3

3

3

41

1

1

1

3

3

3

43

1

1

1

3

3

3

44

1

1

1

3

3

3

45

1

1

1

3

3

46

1

1

1

3

3

47

1

1

1

3

3

3

3

3

48 Para la factura de consumo electrónica mayor o igual a DOP$250 mil se tendrá un máximo de mil (1,000) líneas. En caso de que la factura de consumo electrónica sea menor a DOP$250 mil se tendrá un máximo
de diez mil (10,000) líneas.

Pág. 35 de 87

4

Indicador de Facturación
<IndicadorFacturacion>

ÁREA
<Retencion>

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

OBLIGATORIEDAD
Gastos
Menor.
Electr.

Compras
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

Indica si el ítem es exento, si es gravado, o
No facturable., Indicará las distintas tasas:

0: No Facturable
ITBIS 1: ítem gravado a ITBIS tasa1 (18%).
ITBIS 2: ítem gravado a ITBIS tasa2 (16%).
ITBIS 3: ítem gravado a ITBIS tasa3 (0%).
E: Exento

1

NUM

a)Indicar si es valor
0: No Facturable
1: ITBIS 1 (18%)
2: ITBIS 2 (16%)
3: ITBIS 3 (0%)
4: Exento (E)

P49

1

1

1

1

1

150

1

1

151

1

RETENCIÓN

Condicional a que exista retención.

2

5

Indicador Agente de
Retención o
Percepción52
<IndicadorAgenteRete
ncionoPercepcion>

Para  Agentes  de  Retención  o  Percepción.
Indica  para  cada  transacción  si  es  agente
retenedor  del  producto  que  está
vendiendo o el servicio. Condicional a que
exista retención.

a)Codificación:

1

NUM

1: “R”
2: “P”

N

2

0

0

2

2

2

2

1

1

0

0

0

0

0

0

0

0

1

1

6

Monto ITBIS Retenido
<MontoITBISRetenido>

7

Monto Retención Renta
<MontoISRRetenido>

Monto  del  ITBIS  correspondiente  a
la
retención  que  será  realizado  por  el
comprador.  Condicional  a  que  exista
retención.53
Monto  del
la  Renta
Impuesto  Sobre
correspondiente a la retención realizada de
la prestación o locación de servicios.

El e-CF  tipo 41 es condicional a que exista
retención  y  el  ‘Indicador  Bien  o  Servicio’
sea igual a 2.

18

NUM

a)  Valor  numérico  de  16  enteros,
dos decimales, ≥0.

N

2

0

2

2

2

0

0

0

0

0

18

NUM

a)  Valor  numérico  de  16  enteros,
dos decimales, ≥0.
b) El e-CF  tipo 41 es condicional a
que exista retención y el ‘Indicador
Bien o Servicio’ sea igual a 2.

N

2

0

2

2

2

0

0

0

0

1

49 Se indicará en la representación impresa solo cuando el ítem sea exento.
50 El valor del indicador de facturación para los tipos de e-CF 43, 44 y 47 debe ser igual a 4 (Exento).
51 El valor del indicador de facturación para el tipo de e-CF 46 debe ser igual a 3 (ITBIS tasa cero).
52 Régimen de percepción no está vigente.
53 Si el campo ‘Indicador de Facturación’ es igual a 4 (exento) y el ‘Indicador de Retención o Percepción’ es igual a 1 (R) se deberá completar el campo ‘Monto ITBIS Retenido’ con valor cero (0).

Pág. 36 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

FIN ÁREA
Nombre del Ítem
<NombreItem>

RETENCIÓN

Nombre del producto o servicio.

80

Indicador Bien o Servicio
<IndicadorBienoServicio>

Identifica si el ítem corresponde a Bien
o Servicio.

Descripción Adicional del ítem.

ALFA
NUM

a) Sin validación.

a) Indicar si es Valor:

1

NUM

1: Bien
2:  Servicio

1000

ALFA
NUM

a)Sin validación

8

9

10

11

12

Descripción Adicional
<DescripcionItem>

Cantidad
<CantidadItem>

Unidad de Medida Ítem
<UnidadMedida>

Cantidad del ítem55

18

NUM

Indica  la  unidad  de  medida  que  está
expresada la cantidad.

2

NUM

a)  Valor  numérico  de  16
enteros,  2  decimales;  >0  (No
puede ser negativo).
a)  Validar  con  la  Tabla  de
Codificación  de  Unidad  de
medida.

I

Fact. Créd.
Fiscal Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

OBLIGATORIEDAD
Gastos
Menor.
Electr.

Compras
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

I

N

N

I

P

1

1

3

1

3

1

1

3

1

3

1

1

3

1

3

1

1

3

1

3

1

1

3

1

3

1

1

3

1

3

1

1

3

1

3

1

1

3

1

3

1

1

3

1

3

47

1

154

3

1

3

13

Cantidad de Referencia
<CantidadReferencia>

14

Unidad de Referencia
<UnidadReferencia>

Cantidad para la unidad de medida de
referencia (no se usa para el cálculo del
Monto Ítem).

Condicional a que el ítem esté gravado
con  códigos  de  impuestos  adicionales
la  Tabla  de
entre  006-022  en
Codificación
Impuestos
de
Adicional. 56

Tipo

la  unidad  de  medida  de

Indica
referencia.

Condicional  a  que  esté  completado  el
campo Cantidad de referencia.

18

NUM

a)  Valor  numérico  de  16
enteros,  2  decimales;  ≥0  (No
puede ser negativo).

N

2

2

2

2

0

0

0

2

0

0

2

NUM

a)  Validar  con
la  Tabla  IV
(Codificación  de  Unidad  de
medida).

N

2

2

2

2

0

0

0

2

0

0

54 Cuando se emita un Comprobante de Pagos a Exterior Electrónico, deberá ser completado el campo Bien o Servicio con valor 2.
55 Para facturación de servicios no es obligatorio imprimir.
56 En el caso de productos de alcohol, bebidas alcohólicas y cigarrillos, se debe indicar la cantidad de la presentación por unidad que contiene la cantidad del ítem. Para los productos del tabaco y cigarrillos, se debe indicar la cantidad de
cajetillas que contiene el empaque. Este campo será completado cuando se refiera a la facturación de bienes cuya transferencia, a nivel de productor o fabricante, está gravada con Impuesto Selectivo al Consumo (Códigos desde 006 hasta
039 de la Tabla I).

Pág 37 de 87

CAMPOS

DESCRIPCIÓN

Tipo

Largo
Max

Validación

Fact. Créd.
Fiscal
Electr.

I

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

OBLIGATORIEDAD

31

32

33

34

41

Gastos
Menor.
Electr.

43

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

44

45

46

47

Tabla de
Distribución de
Subcantidad
<TablaSubcantidad>57

15

Subcantidad
<Subcantidad>

Código subcantidad
<CodigoSubcantidad>

16

Se  deberá  incluir  esta  tabla  para
fines  del  cálculo  de  los  impuestos
selectivos  al  consumo  a  productos
derivados  de  alcohol  y  cervezas  y
productos del tabaco y cigarrillos.

Condicional  a  que  exista  código
desde 006 hasta 039 según la ‘Tabla
de Codificación Tipos de Impuestos
Adicionales’.

Se pueden incluir 5 repeticiones de
pares cantidad – código. Incluye los
dos campos siguientes:
Cantidad  de  unidades  de  referencia
que tiene la unidad del ítem.
Condicional  a  que  el
ítem  esté
gravado  con  códigos  de  impuestos
adicionales desde  006 hasta 022 en
la  Tabla  de  Codificación  Tipo  de
Impuestos Adicional. 58
Indica  la  unidad  de  medida  de  la
subcantidad.

FIN TABLA

SUBCANTIDAD

N

2

2

2

2

0

0

0

2

0

0

19

NUM

a) Valor numérico de 16 enteros,
3  decimales;  ≥0  (No  puede  ser
negativo).

2

NUM

a)  Validar  con
IV
(Codificación  de  Unidad  de
medida).

la  Tabla

N

2

2

2

2

0

0

0

2

0

0

N

2

2

2

2

0

0

0

2

0

0

57 Ver nota 2.
58 En el caso de productos de alcohol y bebidas alcohólicas, en este campo se debe indicar la cantidad de alcohol absoluto (volumen por unidad) expresada en litros. Para los productos del tabaco y cigarrillos, se debe indicar la cantidad
de unidades que contiene la cajetilla de cigarrillo o tabaco. Este campo será completado cuando se refiera a la facturación de bienes cuya transferencia, a nivel de productor o fabricante, está gravada con Impuesto Selectivo al Consumo
(Códigos 006-022).

Pág. 38 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

OBLIGATORIEDAD

I

Fact.
Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

31

32

33

34

41

Gastos
Menor.
Electr.

43

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

44

45

46

47

17

Grados Alcohol en %
<GradosAlcohol>59

18

Precio Unitario de Referencia
<PrecioUnitarioReferencia>60

Corresponde  al  porcentaje  de  alcohol
en  el  volumen  de  concentración  total
alcohólica por unidad de producto.
Condicional a que el ítem esté gravado
con  códigos  de  impuestos  adicionales
la  Tabla  de
006  hasta  018  en
Codificación
Impuestos
Adicional (bebidas alcohólicas).
Precio  unitario  para
la  unidad  de
medida de referencia (no se usa para el
cálculo del monto Total).

Tipo

de

Condicional a que el ítem esté gravado
con  códigos  de  impuestos  adicionales
desde  023  hasta  039  en  la  Tabla  de
Codificación
Impuestos
Adicional.

Tipo

de

5

NUM

a)  Valor  numérico  de  3
enteros  y  2  decimales;  >0.
(Debe ser positivo)

I

2

2

2

2

0

0

0

2

0

0

18

NUM

a)  Valor  numérico  de  16
enteros,  2  decimales.  >0  (No
puede ser negativo)

I

2

2

2

2

0

0

0

2

0

0

19

Fecha Elaboración
<FechaElaboracion>

Dato  correspondiente  a  la  fecha  de
elaboración del ítem.

10

ALFA
NUM

a)Fecha válida
Formato: (dd-MM-AAAA)

N

3

3

3

3

3

0

3

3

3

0

59 Este campo será completado cuando se refiera a la facturación de bienes cuya transferencia, a nivel de productor o fabricante, está gravada con Impuesto Selectivo al Consumo (Códigos 006-018 Tabla I).
60 En el caso de el ítem esté gravado con códigos de impuestos adicionales entre 023-039 (de la Tabla de Codificación Tipo de Impuestos Adicional), se deberá colocar en el campo Precio Unitario de referencia, el precio de venta al por
menor (PVP) empleado como base imponible para el cálculo del ISC Ad Valorem.

Pág. 39 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

20

Fecha Vencimiento
<FechaVencimientoItem>

Dato  correspondiente  a
vencimiento del ítem.

la  fecha  de

10

ALFA
NUM

a)Fecha válida
Formato: (dd-MM-AAAA)

ÁREA
<Mineria>

MINERÍA.
Condicional  a  que  exista  facturación
relacionado al sector minería.

21

22

23

24

25

Peso Neto Kilogramo
<PesoNetoKilogramo>

Indica  el  peso  neto  en  kilogramo  del
mineral.61

19

NUM

a)  Valor  numérico  de  16  enteros,  3
decimales; ≥0 (No puede ser negativo).

Peso Neto
<PesoNetoMineria>

Tipo Afiliación
<TipoAfiliacion>

Indica el peso neto del mineral.62

19

NUM

Indica si el destinatario es o no afiliada.63

1

NUM

Liquidación
<Liquidacion>

Indica  si  la  liquidación  del  mineral  es
provisional o final.64

1

NUM

a)  Valor  numérico  de  16  enteros,  3
decimales; ≥0 (No puede ser negativo).
a) Indica si es valor:
  1: Afiliada
2: No afiliada
a) Indica si es valor:
 1: Provisional
 2: Final

FIN ÁREA

MINERÍA

Precio Unitario del
Ítem65
<PrecioUnitarioItem>

Dato  correspondiente  al  precio  unitario
del ítem.

20

NUM

 a)Valor numérico de 16 enteros, 4
decimales; ≥0 (No puede ser negativo).

OBLIGATORIEDAD

I

N

N

N

N

N

Fact.
Créd.
Fiscal
Electr.

31

3

0

0

0

0

0

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

3

2

2

2

2

2

33

3

2

2

2

2

2

34

3

2

2

2

2

2

41

3

0

0

0

0

0

43

0

0

0

0

0

0

44

3

0

0

0

0

0

45

3

0

0

0

0

0

46

3

2

2

2

2

2

47

0

0

0

0

0

0

I

1

1

1

1

1

1

1

1

1

1

61 Es condicional a que exista facturacion de minerales (oro, plata, etc).
62 Ver nota 61.
63 Ver nota 61.
64 Ver nota 61.
65 En el caso de ventas de productos de alcohol, bebidas alcohólicas y cerveza, a nivel de productor, fabricante o importador, en este campo se deberá indicar el precio de lista del ítem. En el caso de ítems gravados con impuesto selectivo
a los servicios de seguros en general, el precio corresponde a la prima del seguro.

Pág. 40 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

18

NUM

a) Valor numérico de 16 enteros, 2
decimales;  ≥0
(No  puede  ser
negativo).
b)Monto Subdescuento

26

Monto Descuento
<DescuentoMonto>

Tabla de
Distribución de
Subdescuento
<TablaSubDescuento>66

27

Tipo de Subdescuento
<TipoSubDescuento>

28

Subdescuento en %
<SubDescuentoPorcentaj
e>

ítem.  Se  pueden

los  subdescuentos
Totaliza
todos
otorgados  al
ítem  en  montos.
Condicional  a  que  exista  Monto
Subdescuento.
Condicional a que exista descuento en
el
incluir  12
repeticiones.  Incluye  los  tres  campos
siguientes:
Indica  si  el  Subdescuento  está  en
monto
(%).
Condicional a que exista descuento en
el ítem.
Valor del Subdescuento en porcentaje
%.  Condicional  a  que  exista  tipo
Subdescuento en porcentaje (%).

porcentaje

($)

o

1

5

Correspondiente
descuento expresado en monto.

valor

al

del

29

Monto Subdescuento
<MontoSubDescuento>

Si va el subdescuento en %, deberá ir el
monto del subdescuento.

18

NUM

FIN TABLA

SUBDESCUENTO

ALFA  a) "$" o "%"

N

2

NUM

N

2

a)  Valor numérico.
3  enteros  y  2  decimales;  >0  (No
puede ser negativo)
a)  Valor numérico de 16 enteros, 2
decimales.  ≥0
(No  puede  ser
negativo).
b)  Si  va  el  subdescuento  en  %,  el
valor  del  subdescuento  en  monto
deberá  ser  igual  al  precio  unitario
de  ítem  por  el  subdescuento  en
porcentaje,  por
la  cantidad  de
ítems.

Fact.
Créd.
Fiscal
Electr.

31

2

I

I

N

2

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

2

2

2

2

33

2

2

2

2

34

2

2

2

2

41

2

2

2

2

43

0

0

0

0

44

2

2

2

2

45

2

2

2

2

46

2

2

2

2

47

0

0

0

0

N

2

2

2

2

2

0

2

2

2

0

66 Ver nota 2.

Pág. 41 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

30

Monto Recargo
<RecargoMonto>

Tabla de
Distribución de
Subrecargo
<TablaSubRecargo>67

Tipo Subrecargo
<TipoSubRecargo>

Subrecargo en %
<SubRecargoPorcentaje
>

31

32

33

Monto Subrecargo
<MontoSubRecargo>

los

todos

Subrecargos
Totaliza
ítem  en  montos.
otorgados  al
Condicional  a  que  exista  Monto
Subrecargo.

Se

incluir

Condicional a que exista recargo en el
12
pueden
ítem.
repeticiones  de  pares  Tipo  –  Valor.
Incluye los tres campos siguientes:
Indica si el Subrecargo está en $ o %.
Condicional a que exista recargo en el
ítem.
Valor del Subrecargo en porcentaje %.
Condicional  a  que  exista
tipo
Subrecargo en porcentaje (%).

a)    Valor  numérico  de  16  enteros,  2
decimales; ≥0 (No puede ser negativo).

18

NUM

b) Monto Subrecargo.

1

5

ALFA  "$" o "%"

a)Valor  numérico,  3  enteros  y  2
decimales; >0 (No puede ser negativo)

NUM

Correspondiente al valor del Subrecargo
expresado en monto. Condicional a que
exista subrecargo.

Si va  el  subrecargo en %, deberá ir el
monto del subrecargo.

18

NUM

(No  puede

a)    Valor  numérico  de  16  enteros,
decimales;  ≥0
ser
negativo).
b) Si va el subrecargo en %, el valor del
subrecargo en monto deberá ser igual
al precio unitario del ítem por el valor
del  subrecargo  en  porcentaje,  por  la
cantidad de ítems.

FIN TABLA
Tabla de Códigos de
Impuestos Adicionales
<TablaImpuestoAdicion
al>68

SUBRECARGO

Se  pueden  incluir  2  repeticiones  de
códigos de impuesto.

67 Ver nota 2.
68 Ver nota 2.
69 Ver nota 16.

OBLIGATORIEDAD

I

Fact.
Créd.
Fiscal
Electr.

31

I

2

N

2

N

N

2

2

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

2

2

2

2

33

2

2

2

2

34

2

2

2

2

41

2

2

2

2

43

0

0

0

0

44

2

2

2

2

45

2

2

2

2

46

2

2

2

2

47

0

0

0

0

N

2

2

2

2

2

0

2

2

2

0

2

2

2

2

0

0

269

2

0

0

Pág. 42 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

OBLIGATORIEDAD

Fact.
Créd.
Fiscal
Electr.

I

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

3

NUM

Código  válido  respecto  a  la
Tabla  I  (Codificación  Tipos  de
Impuestos Adicionales).

N

2

2

2

2

0

0

271

2

0

0

Código de Impuesto
Adicional

34

<TipoImpuesto>

FIN TABLA
ÁREA
<OtraMonedaDetalle>

Dato  correspondiente  al  Código  del
impuesto adicional de acuerdo a la Tabla
de  Codificación  Tipos  de
Impuestos
Adicionales (Tabla I). Condicional a que el
ítem  este  gravado
Impuesto
Adicional.70

con

IMPUESTOS ADICIONALES

OTRA MONEDA DETALLE.
Indicar precios en monedas alternativas.
72

35

36

37

38

Precio unitario en otra
moneda
<PrecioOtraMoneda>

Dato correspondiente al precio Unitario
del Ítem en otra moneda. Condicional a
que el ítem sea en Otra Moneda.

20

NUM

a)  Valor  numérico  de  16
enteros,  4  decimales.  ≥0  (No
puede ser negativo).

N73

2

Descuento en Otra
Moneda
<DescuentoOtraMoneda>

Corresponde  al  valor  de  descuento
otorgado en Otra Moneda.

18

NUM

Recargo en Otra Moneda
<RecargoOtraMoneda>

Corresponde  el  valor  de
otorgado en Otra Moneda.

recargo

18

NUM

Monto Ítem Otra Moneda

<MontoItemOtraMoneda>

(Precio  Unitario  en  otra  moneda  *
Cantidad) – Descuento en otra moneda
+ Recargo en otra moneda.
Condicional  a  que  el  Precio  del  ítem  y
Descuentos  o  Recargo  (si  existen)  sean
en Otra Moneda.

18

NUM

a)  Valor  numérico  de  16
enteros,  2  decimales.  ≥0  (No
puede ser negativo).
a)  Valor  numérico  de  16
enteros,  2  decimales.  ≥0  (No
puede ser negativo).
a)
  Valor  numérico  de  16
enteros,  2  decimales.  ≥0  (No
puede ser negativo).
b) Valor numérico de acuerdo
al campo de Descripción.

N

3

N

3

N

2

2

2

2

3

3

2

2

2

3

3

2

2

3

3

2

2

2

2

3

3

2

2

2

3

3

2

2

3

3

2

2

2

2

3

3

2

2

2

3

3

2

2

2

3

3

2

70 La condición está sujeta a la especificación del contribuyente, es decir, si en su facturación existe ítem gravado con impuesto adicional.
71 Ver nota 16.
72 La condición está sujeta a la especificación del contribuyente, es decir, si este indica que existen ítems en otra moneda, se deberán completar los demás campos de la tabla.
73 La impresión de los campos en otra moneda es condicional a que existan transacciones en otras monedas. Si existen transacciones en otras monedas, dichos campos pueden ser impresos en la RI sin ser necesario incluir los de moneda
local, debido a que ambas informaciones se encuentran en el formato XML de e-CF.

Pág. 43 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

FIN ÁREA

OTRA MONEDA DETALLE

OBLIGATORIEDAD

Fact.
Créd.
Fiscal
Electr.

I

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

31

32

33

34

41

43

44

45

46

47

39

Monto Ítem
(Valor por la línea de
detalle)
<MontoItem>

(Precio Unitario del ítem * Cantidad) –
Monto Descuento + Monto Recargo

18

NUM

FIN ÁREA

FIN ÁREA

ÍTEM

DETALLES ÍTEM

a)    Valor  numérico  de  16
enteros, 2 decimales; ≥ 0 (No
puede ser negativo).
b)  Valor  numérico,  de
acuerdo con descripción.
c)Debe  ser  cero  cuando:  es
una  Nota  de  Crédito  para
fines  de
corrección  de
texto.74
Cuando  es  cero  puede  no
imprimirse  o  imprimirse  un
texto  explicativo  (sin  valor,
sin costo, etc.)

I

1

1

1

1

1

1

1

1

1

1

74 Aplica cuando la emisión de la nota de crédito, tiene valor 2 en el campo ‘Codigo Modificación’ de la sección Información de Referencia.

Pág. 44 de 87

C.  SUBTOTALES INFORMATIVOS

Pueden ser de 0 hasta 20 líneas. Estos subtotales no aumentan o disminuyen la base del impuesto, ni modifican los campos totalizadores, sólo son campos informativos. Estos subtotales tienen
una descripción que especifica el concepto. Por ejemplo, un subtotal aplicado a un determinado grupo de ítems.  En la representación impresa, estos subtotalizadores pueden intercalarse entre
las líneas de detalle, o indicarse en forma agrupada en una sección aparte, dependiendo de la facturación.

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

ÁREA
<Subtotales>

ÁREA
<Subtotal>

Número Subtotal
<NumeroSubTotal>

Descripción
< DescripcionSubtotal>

Orden
<Orden>

Subtotal Monto Gravado ITBIS
Total
<SubTotalMontoGravadoTotal>

Subtotal Monto Gravado ITBIS
Tasa 1
<SubTotalMontoGravadoI1>

Subtotal Monto Gravado ITBIS
Tasa 2
<SubTotalMontoGravadoI2>

1

2

3

4

5

6

SUBTOTALES

SUBTOTAL
Se pueden incluir hasta 20
repeticiones.

Número de Subtotal

2

NUM

a)  Número  secuencial  de
acuerdo
de
subtotales

número

al

Título del Subtotal

40

ALFA  a) Sin validación.

Ubicación para Impresión.
De  uso  para  el  contribuyente
como  ayuda  para  indicar  cómo
imprimirá Subtotales.
Valor  de
la  sumatoria  del
Subtotal  Monto  Gravado  ITBIS
Tasa 1, ITBIS Tasa 2 e ITBIS Tasa
3; en DOP$ u otra moneda.
Valor  del  monto  gravado  del
Subtotal  asignados  a  ítem  con
ITBIS  tasa  1(18%);  en  DOP$  u
otra moneda.
Valor  del  monto  gravado  del
Subtotal  asignados  a  ítem  con
ITBIS  tasa  2  (16%);  en  DOP$  u
otra moneda.

2

NUM

a) Sin validación.

18

NUM

a)  Valor  numérico  de  16
enteros, 2 decimales; ≥0

18

NUM

a)  Valor  numérico  de  16
enteros, 2 decimales; ≥0

18

NUM

a)  Valor  numérico  de  16
enteros, 2 decimales; ≥0

I

Fact.
Créd.
Fiscal
Electr.

31

3

3

3

3

3

N

N

N

N

3

N

3

3

N

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

32

3

3

3

3

3

3

3

3

33

3

3

3

3

3

34

3

3

3

3

3

3

3

3

3

3

3

41

3

3

3

3

3

3

3

3

43

3

3

3

3

3

0

0

0

44

3

3

3

3

3

0

0

0

45

3

3

3

3

3

3

3

3

46

3

3

3

3

3

3

0

0

47

3

3

3

3

3

0

0

0

Pág. 45 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Subtotal Monto Gravado ITBIS Tasa 3

<SubTotalMontoGravadoI3>

Subtotal ITBIS
<SubTotaITBIS>

Valor  del  monto  gravado  del
Subtotal asignados a ítem con ITBIS
tasa  3  (0%);  en  DOP$  u  otra
moneda.
Valor  de  la  sumatoria  del  Subtotal
ITBIS Tasa 1, subtotal ITBIS Tasa 2 y
Subtotal  ITBIS  Tasa  3;  en  DOP$  u
otra moneda.

18

NUM

a) Valor numérico de 16 enteros,
2 decimales; ≥0

18

NUM

a) Valor numérico de 16 enteros,
2 decimales; ≥0

Subtotal ITBIS Tasa 1
<SubTotaITBIS1>

Valor  del  total  de  ITBIS  tasa  1  del
Subtotal; en DOP$ u otra moneda.

18

NUM

a) Valor numérico de 16 enteros,
2 decimales; ≥0

Subtotal ITBIS Tasa 2
<SubTotaITBIS2>

Valor  del  total  de  ITBIS  tasa  2  del
Subtotal; en DOP$ u otra moneda.

18

NUM

a) Valor numérico de 16 enteros,
2 decimales; ≥0

Subtotal ITBIS Tasa 3
<SubTotaITBIS3>

Valor  del  total  de  ITBIS  tasa  3  del
Subtotal; en DOP$ u otra moneda.

18

NUM

a) Valor numérico de 16 enteros,
2 decimales; ≥0

Fact.
Créd.
Fiscal
Electr.

31

3

3

3

3

3

I

N

N

N

N

N

Subtotal Impuestos adicionales
<SubTotalImpuestoAdicional>

Valor  de  los  Impuestos  adicionales
del Subtotal. Aplica en subtotales en
DOP$ u otra moneda.

18

NUM

a) Valor numérico de 16 enteros,
2 decimales; >0

N

3

Subtotal Exento
<SubTotalExento>

Valor Exento del Subtotal. Aplica en
subtotales en DOP$ u otra moneda.

18

NUM

a) Valor numérico de 16 enteros,
2 decimales; ≥0

N

3

OBLIGATORIEDAD

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

32

3

3

3

3

3

3

3

33

3

34

3

3

3

3

3

3

3

3

3

3

3

3

3

41

3

3

3

3

3

3

3

43

0

0

0

0

0

0

3

44

0

0

0

0

0

3

3

Guber.
Electr.

Export.
Electr.

45

46

3

3

3

3

3

3

3

3

0

0

3

0

3

0

Pagos
Exterior
Electr.

47

0

0

0

0

0

0

3

Monto del Subtotal
<MontoSubTotal>

la

línea  de  subtotal.
Valor  de
la  sumatoria  de
Corresponde  a
ITBIS
Subtotal  Monto  Gravado
Total,  Subtotal
ITBIS,  Subtotal
Impuestos adicionales y/o   Subtotal
Exento.  Aplica  en  subtotales  en
DOP$ u otra moneda.

18

NUM

a) Valor numérico de 16 enteros,
2 decimales; ≥0

N

3

3

3

3

3

3

3

3

3

3

7

8

9

10

11

12

13

14

Pág. 46 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

OBLIGATORIEDAD
Gastos
Menor.
Electr.

Compras
Electr.

15

Líneas
<Lineas>

FIN ÁREA
FIN ÁREA

Indica  la  cantidad  de  líneas  que
se subtotaliza.

2

NUM

 a)  De  acuerdo  a  descripción  del
campo.

N

31

3

32

3

33

3

34

3

41

3

43

3

SUBTOTAL
SUBTOTALES

Regím.
Espec.
Electr.

44

3

Guber.
Electr.

Export.
Electr.

45

3

46

3

Pagos
Exterior
Electr.

47

3

Pág. 47 de 87

D.  DESCUENTOS O RECARGOS

Pueden ser de 0 hasta 20 líneas. Estos aumentan o disminuyen la base del impuesto. Estos descuentos o recargos tienen una descripción que especifica el concepto. Por ejemplo un descuento
aplicado a un determinado tipo de ítems o un descuento por pago al contado que afecta a todos los ítems.
En caso de que se apliquen descuentos o recargos globales:

a)  Si en la sección Detalle de Bienes o Servicios contiene ítems con distintos códigos de impuesto, el campo “tipo de valor” del descuento debe ser porcentaje (%).
b)  Si en la sección Detalle de Bienes o Servicios contiene ítems gravados a diferentes tasas y exentos (“Indicador de Facturación” = 1, 2, 3 o 4), se pueden dar los siguientes casos:

1.  Si el descuento afecta sólo a los ítems exentos se debe indicar un 4 en el “Indicador de Facturación”.
2.  Si el descuento afecta sólo a los ítems gravados el “Indicador de Facturación” debe estar en 1, 2 o 3, según la tasa que aplique.
3.  Si el descuento afecta a todos (“Indicador de Facturación” códigos 1, 2, 3, 4), deberá haber tantas líneas como conceptos existan.

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact. Créd.
Fiscal
Electr.

Fact.
Consum.
Electr.

Nota
Déb.
Electr.

Nota
Créd.
Electr.

Compras
Electr.

Gastos
Menor.
Electr.

Regím.
Espec.
Electr.

Guber.
Electr.

Export.
Electr.

Pagos
Exterior
Electr.

OBLIGATORIEDAD

ÁREA
<DescuentosORecargos>
ÁREA
<DescuentoORecargo>

N° de Línea o N° Secuencial
<NumeroLinea>

1

Tipo de Ajuste
<TipoAjuste>

DESCUENTOS O RECARGOS

DESCUENTO O RECARGO.
Se pueden incluir hasta 20 repeticiones.

Número de descuento o recargo. De 1 a
20 repeticiones. Condicional a que exista
Descuento o Recargo global.75

D(descuento) o R(recargo).
Condicional a que se aplique descuento
global o recargo global.

31

2

2

2

NUM

a)Número  secuencial  de
línea.

la

N

2

1

ALFA

D o R

N

2

Indicador Norma 10-07
<IndicadorNorma1007>

Indica  si  el  descuento  que  se  aplica    es
según lo establecido en la norma 10-07.

1

NUM

a)Valor  1
si  corresponde
aplicar  el  descuento  según  lo
establecido  en  la  norma  10-
07.

N

3

Descripción de Descuento
o Recargo
<DescripcionDescuentooRec
argo>

Especificación de descuento o recargo.

45

ALFA

a)Sin Validación

I

3

75 La condición está sujeta a la especificación del contribuyente, a que exista descuento o recargo global en la facturación.

Pág. 48 de 87

2

3

4

32

2

2

2

2

3

3

33

2

2

34

2

2

2

2

2

3

2

3

3

3

41

2

2

2

2

0

3

43

0

0

0

0

0

0

44

2

2

2

2

0

3

45

2

2

2

2

3

3

46

2

2

2

2

0

3

47

0

0

0

0

0

0

5

6

7

8

9

Tipo de valor
<TipoValor>

Descuento o Recargo en %
<ValorDescuentooRecargo>

Indica  si  existe  descuento  o  recargo
aplicado  en  Porcentaje  o  Monto.
Condicional  a  que  exista  descuento  o
recargo global.

Valor  del  Descuento  o  Recargo  en
porcentaje.
que
Condicional
descuento o recargo global sea en %.

a

1

ALFA

“%” o “$”

5

NUM

Monto de Descuento o
Recargo
<MontoDescuentooRecargo>

Valor  del  descuento  o  recargo.  Si  se
refiere al tipo de valor $ se debe indicar
el monto.

18

NUM

Valor en otra moneda. Aplica en montos
de descuento o recargo global.

18

NUM

Monto en otra moneda de
Descuento o Recargo
<MontoDescuentooRecargoOt
raMoneda>

Indicador de facturación
de Descuento o Recargo
<IndicadorFacturacionDescuen
tooRecargo>

Indica si el descuento o recargo afecta a
ítems:

ITBIS 1: ítem gravado a ITBIS tasa1 (18%).
ITBIS 2: ítem gravado a ITBIS tasa2 (16%).
ITBIS 3: ítem gravado a ITBIS3 tasa3 (0%).
E: Exento.

 Condicional  a  que  exista  descuento  o
recargo global.

I

I

I

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

0

0

0

2

2

2

2

2

2

2

2

2

0

0

0

N

3

3

3

3

3

0

3

3

3

0

a) Valor numérico; 3 enteros y
2 decimales; >0 (No puede ser
negativo).
a)  Valor  numérico  de  16
enteros, 2 decimales; ≥0.

b) Si va el descuento o recargo
en  %,  debe
ir  el  monto
correspondiente.
a)  Valor  numérico  de  16
enteros, 2 decimales; ≥0.

b)   Si  va  el  descuento  o
recargo en %, debe ir el monto
correspondiente.

a) Indicar si es valor:

1

NUM

1: ITBIS 1 (18%)
2: ITBIS 2 (16%)
3: ITBIS 3 (0%)
4: Exento (E)

N

2

2

2

2

276

0

2

2

2

0

FIN ÁREA

FIN ÁREA

DESCUENTO O RECARGO

DESCUENTOS O RECARGOS

76 Ver nota 45.

Pág. 49 de 87

E.  PAGINACIÓN

En esta sección se indica la cantidad de páginas del e-CF en la Representación Impresa y cuales ítems estarán en cada una77. Esta deberá repetirse para el total de páginas especificadas.

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

OBLIGATORIEDAD

I

Fact.  Créd.
Fiscal Electr.
31

Fact.
Consum.
Electr.
32

Nota
Déb.
Electr.
33

Nota
Créd.
Electr.
34

Compras
Electr.
41

Gastos
Menor.
Electr.
43

Regím.
Espec.
Electr.
44

Guber.
Electr.
45

Export.
Electr.
46

Pagos
Exterior
Electr.
47

ÁREA
<Paginacion>

ÁREA
<Pagina>

1

Página No.
<PaginaNo>

PAGINACIÓN

PÁGINA
Deberá  repetirse  para  el  total  de
páginas especificadas.

Indica la numeración de la página que
contiene los datos del e-CF al realizar
una representación impresa, siempre
y cuando sea mayor a una página.

2

2

a) Debe estar entre 1 y 100.

3

NUM

b)  El  número  indicado  de  página  debe
estar en orden secuencial.

I

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

2

No. Línea Desde
<NoLineaDesde>

3

No. Línea Hasta
<NoLineaHasta>

Indica el no. de la línea de detalle del
primer ítem que contiene la página.

Condicional a que sea completado el
campo Página No.

Indica el no. de la línea de detalle del
último  ítem  que  será  incluido  en  la
página.

Condicional a que sea completado el
campo No. Línea Desde.

3

NUM

3

NUM

a)  Número  de  línea  que  corresponde  al
primer ítem que será incluido en la página.
b) Valor numérico hasta 3 enteros.
c) El valor indicado debe ser menor o igual
al colocado en el campo ‘No. Línea Hasta’
y debe ser mayor a cero (>0).

a)  Número  de  línea  que  corresponde  al
último ítem que será incluido en la página.
b) Valor numérico hasta 3 enteros.
c)El valor indicado debe ser mayor o igual
al colocado en el campo ‘No.  Línea Desde’
y debe ser mayor a cero (>0).

N

2

2

2

2

2

2

2

2

2

2

N

2

2

2

2

2

2

2

2

2

2

77 La sección paginación es condicional a que el e-CF contenga más de una página.

Pág. 50 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

OBLIGATORIEDAD

Fact.
  Créd.
Fiscal
Electr.
31

Fact.
Consum.
Electr.
32

Nota
Déb. Electr.
33

Nota
Créd.
Electr.
34

Compras
Electr.
41

Gastos
Menor.
Electr.
43

Regím.
Espec.
Electr.
44

Guber.
Electr.
45

Export.
Electr.

Pagos
Exterior
Electr.

46

47

4

Subtotal Monto Gravado
Total Página
<SubtotalMontoGravadoPagi
na>

Total de la suma de valores de monto
gravado  ITBIS  a  diferentes  tasas,  de
las líneas correspondientes a la página
que se indica.

Condicional  a  que  exista  Subtotal
Monto gravado1, y/o Subtotal Monto
gravado  2  y/o  Subtotal  Monto
gravado 3 Página.

5

Subtotal Monto Gravado
Tasa 1 Página
<SubtotalMontoGravado1Pa
gina>

6

Subtotal Monto Gravado
Tasa 2 Página
<SubtotalMontoGravado2Pa
gina>

18%),

Total de la suma de valores de Ítems
gravados  asignados  a  ITBIS  tasa  1
(tasa
líneas
de
correspondientes a la página que se
indica,  menos  descuentos  más
recargos.78

las

Condicional a que la página contenga
algún ítem gravado a tasa ITBIS 1.

16%),

Total de la suma de valores de Ítems
gravados  asignados  a  ITBIS  tasa  2
(tasa
líneas
de
correspondientes a la página que se
indica,  menos  descuentos  más
recargos.

las

Condicional a que la página contenga
algún ítem gravado a tasa ITBIS 2.

18

NUM

18

NUM

18

NUM

a)  Valor  numérico  de  16  enteros,  2
decimales;  ≥  0
(No  puede  ser
negativo).
b) El valor indicado debe ser igual a
la  sumatoria  del  Subtotal  Monto
ITBIS  Tasa1  +  Subtotal
gravado
Monto  gravado
ITBIS  Tasa2  +
Subtotal Monto gravado ITBIS Tasa3
de la página indicada.

a)  Valor  numérico  de  16  enteros,  2
(No  puede  ser
decimales;  ≥  0
negativo).

indicador  de

b) Suma de valores del monto ítem
con
facturación=1,
menos descuentos más recargos, de
las  líneas  de  ítems  incluidos  en  la
página.

a)  Valor  numérico  de  16  enteros,  2
decimales;  ≥  0
(No  puede  ser
negativo).

indicador  de

b) Suma de valores del monto ítem
con
facturación=2,
menos descuentos más recargos, de
las  líneas  de  ítems  incluidos  en  la
página.

I

2

2

2

2

2

0

0

2

2

0

N

2

2

2

2

2

0

0

2

0

0

N

2

2

2

2

2

0

0

2

0

0

78 Se refiere al descuento o recargo global (Sección Descuentos o Recargos).

Pág. 51 de 87

OBLIGATORIEDAD

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact.
Créd.
Fiscal
Electr.
31

Fact.
Consum.
Electr.
32

Nota
Déb.
Electr.
33

Nota
Créd.
Electr.
34

Compras
Electr.
41

Gastos
Menor.
Electr.
43

Regím.
Espec.
Electr.
44

Guber.
Electr.
45

Export.
Electr.

Pagos
Exterior
Electr.

46

47

7

Subtotal Monto Gravado
Tasa 3 Página
<SubtotalMontoGravado3Pagin
a>

8

Subtotal Exento Página
<SubtotalExentoPagina>

Total  de  la  suma  de  valores  de
Ítems  gravados  asignados  a  ITBIS
tasa  3  (tasa  0),  de
líneas
correspondientes  a  la  página  que
se  indica,  menos  descuentos  más
recargos.

las

Condicional  a  que
la  página
contenga  algún  ítem  gravado  a
tasa ITBIS 3.

Total  de
la  suma  de  valores
correspondientes  a  ítems  exentos
indicados en el no. de línea ‘Desde’
‘Hasta’, de la página.

Condicional  a  que  en  la  página
contenga algún ítem exento.

18

NUM

18

NUM

Total  de  la  suma  de  valores  de
Subtotal ITBIS 1, Subtotal ITBIS 2 y
Subtotal  ITBIS  3,  a  las  diferentes
tasas,
líneas
correspondientes a la página que se
indica.

las

de

9

Subtotal ITBIS Página
<SubtotalItbisPagina>

N

2

2

2

2

2

0

0

2

2

0

I

2

2

2

2

2

2

2

2

0

2

 a) Valor numérico de 16 enteros, 2
decimales;  ≥  0
(No  puede  ser
negativo).

indicador  de

b) Suma de valores del monto ítem
con
facturación=3,
menos descuentos más recargos, de
las  líneas  de  ítems  incluidos  en  la
página.

a)  Valor  numérico  de  16  enteros,  2
decimales.  ≥  0
(No  puede  ser
negativo).

indicador  de

b) Suma de valores del monto ítem
con
facturación=4,
menos descuentos más recargos, de
las  líneas  de  ítems  incluidos  en  la
página.

a)  Valor  numérico  de  16  enteros,  2
decimales;  ≥  0
(No  puede  ser
negativo).

18

NUM

I

2

2

2

2

2

0

0

2

2

0

Condicional  a  que  exista  Subtotal
ITBIS 1, Subtotal ITBIS 2 y Subtotal
ITBIS 3 Página.

b)  Suma  de  Subtotal  ITBIS  Tasa  1
Página + Subtotal ITBIS Tasa 2 Página
+ Subtotal ITBIS Tasa 3 Página.

Pág. 52 de 87

OBLIGATORIEDAD

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact.
Créd.
Fiscal
Electr.
31

Fact.
Consum.
Electr.
32

Nota
Déb.
 Electr.
33

Nota Créd.
Electr.
34

Compras
Electr.
41

Gastos
Menor.
Electr.
43

Regím.
Espec.
Electr.
44

Guber.
Electr.
45

Export.
Electr.
46

Pagos
Exterior
Electr.
47

10

Subtotal ITBIS 1 Página
<SubtotalItbis1Pagina>

igual  al  subtotal
Valor  numérico
monto gravado 1 por la tasa ITBIS 1,
de la línea indicada en la página.

Condicional  a  que  exista  Subtotal
Monto Gravado tasa 1.

18

NUM

11

Subtotal ITBIS 2 Página
<SubtotalItbis2Pagina>

12

Subtotal ITBIS 3 Página
<SubtotalItbis3Pagina>

Valor  numérico
igual  al  subtotal
monto gravado 2 por la tasa ITBIS 2,
de la línea indicada en la página.

Condicional  a  que  exista  Subtotal
Monto Gravado tasa 2.

igual  al  subtotal
Valor  numérico
monto gravado 3 por la tasa ITBIS 3,
de la línea indicada en la página.

Condicional  a  que  exista  Subtotal
Monto Gravado tasa 3.

18

NUM

a)  Valor  numérico  de  16  enteros,
dos  decimales;  ≥  0  (No  puede  ser
negativo).
b)  Subtotal  ITBIS  Tasa1=  Monto
Gravado ITBIS tasa1 * ITBIS tasa 1,
de las líneas de ítems incluidos en
la página.

Solo  forman  parte  de
la  base
imponible  del  ITBIS  los  impuestos
selectivos al consumo con códigos
desde 006 hasta 039 de la Tabla de
Codificación de Tipos de Impuestos
Adicionales.

a)  Valor  numérico  de  16  enteros,
dos  decimales;  ≥  0  (No  puede  ser
negativo).
b)  Subtotal  ITBIS  Tasa2=  Monto
Gravado ITBIS tasa2 * ITBIS tasa 2,
de las líneas de ítems incluidos en
la página.

N

2

2

2

2

2

0

0

2

0

0

N

2

2

2

2

2

0

0

2

0

0

18

NUM

 a)  Valor  numérico  de  16  enteros,
dos  decimales;  ≥  0  (No  puede  ser
negativo).

N

2

2

2

2

2

0

0

2

2

0

Pág. 53 de 87

OBLIGATORIEDAD

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

Fact.
 Créd.
Fiscal
Electr.
31

Fact.
Consum.
Electr.
32

Nota
Déb.
Electr.
33

Nota
Créd.
Electr.
34

Compras
Electr.
41

Gastos
Menor.
Electr.
43

Regím.
Espec.
Electr.
44

Guber.
Electr.
45

Export.
Electr.
46

Pagos
Exterior
Electr.
47

13

Subtotal Impuesto Adicional
Página
<SubtotalImpuestoAdicionalPagina>

Sumatoria  de  los  campos  del  área
Subtotal Impuesto Adicional.

Condicional  a  que  se  complete
campos  del  área  Subtotal  Impuesto
Adicional.

18

NUM

ÁREA
<SubtotalImpuestoAdicional>

 SUBTOTAL IMPUESTO ADICIONAL

a) Valor numérico de 16 enteros,
dos  decimales;  >0  (debe  ser
positivo).

b) Subtotal Impuesto Adicional=
Subtotal  Impuesto  Selectivo  al
Consumo  +  Subtotal  Otros
Impuestos Adicionales.

Condicional a que exista otros(s)
impuesto(s) en la línea de detalle
de la página, distinto(s) al ITBIS.

I

2

2

2

2

0

0

2

2

0

0

2

2

2

2

0

0

2

2

0

0

14

Subtotal Impuesto Selectivo al
Consumo Página
<SubtotalImpuestoSelectivoConsum
oEspecificoPagina>

15

Subtotal Otros Impuestos
Adicionales Página
<SubtotalOtrosImpuesto>

Valor  del
impuesto  selectivo  al
consumo  específico  y  Ad  Valorem,
correspondientes  a
ítems  del
campo ‘No. de línea desde’ a ‘No. de
línea hasta’, indicados en la página.

los

Condicional a que los ítems del campo
‘No.  de  línea  desde’  a  ‘No.  de  línea
hasta’,
con
Impuestos al Consumo Específico y Ad
Valorem.

gravados

existan

del

impuesto

Valor
adicional
(exceptuando el impuesto selectivo al
consumo  específico  y  Ad  Valorem),
correspondientes  a
ítems  del
campo ‘No. de línea desde’ a ‘No. de
línea hasta’, indicados en la página.

los

Condicional a que los ítems del campo
‘No.  de  línea  desde’  a  ‘No.  de  línea
hasta’,  existan  gravados  con  Otros
Impuestos Adicionales.

a) Valor numérico de 16 enteros,
dos  decimales;  >0  (debe  ser
positivo).

18

NUM

N

2

2

2

2

0

0

0

2

0

0

18

NUM

a) Valor numérico de 16 enteros,
dos  decimales;  >0  (debe  ser
positivo

N

2

2

2

2

0

0

2

2

0

0

Pág. 54 de 87

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

I

OBLIGATORIEDAD

Fact.
Créd.
 Fiscal
Electr.
31

Fact.
Consum.
Electr.
32

Nota
Déb.
Electr.
33

Nota
Créd.
Electr.
34

Compras
Electr.
41

Gastos
Menor.
Electr.
43

Regím.
Espec.
Electr.
44

Guber.
Electr.
45

Export.
Electr.
46

Pagos
Exterior
Electr.
47

FIN ÁREA

16

Monto Subtotal Página
<MontoSubtotalPagina>

17

Subtotal Monto No
Facturable Página
<SubtotalMontoNoFacturablePa
gina>

SUBTOTAL IMPUESTO ADICIONAL
Sumatoria  de  los  campos  Subtotal
Monto  Gravado  Total  Pagina,
Subtotal  Exento  Pagina,  Subtotal
ITBIS Pagina y
Subtotal
Pagina.

Impuesto

Adicional

Condicional  a  que  se  complete  el
campo Página No.

todos

los  valores
Suma  de
correspondientes  a
ítems  no
facturables,  que  estén  indicados
en el no. de línea ‘Desde’ ‘Hasta’,
de la página.

Condicional a que la página incluya
ítems no facturables.

18

NUM

a)  Valor  numérico  de  16
enteros,  dos  decimales;  ≥  0
(No puede ser negativo).

18

NUM

I

2

2

2

2

2

2

2

2

2

2

b) Valor numérico de acuerdo
con el total de la sumatoria del
campo de Descripción.

a)  Valor  numérico  de  16
enteros,  2  decimales.  ≥  0
(Debe ser positivo).

con

b) Suma de valores del monto
de
ítem
facturación=0,
menos
descuentos más recargos.

indicador

N

2

2

2

2

0

0

2

2

2

0

FIN ÁREA
FIN ÁREA

PAGINA
PAGINACIÓN

Pág. 55 de 87

F.  INFORMACIÓN DE REFERENCIA

Corresponde a la sección donde se indica la información del comprobante fiscal electrónico modificado por la nota de crédito o débito electrónica emitida o reemplazado por el e-CF emitido. Se
puede incluir hasta 1 línea.

CAMPOS

DESCRIPCIÓN

Largo
Max

Tipo

Validación

ÁREA
<InformacionReferencia>

INFORMACIÓN DE REFERENCIA.

OBLIGATORIEDAD

I

Fact. Créd.
Fiscal
Electr.
31

Fact.
Consum.
Electr.
32

Nota Déb.
Electr.
33

Nota
Créd.
Electr.
34

Compras
Electr.
41

Gastos
Menor.
Electr.
43

Regím.
Espec.
Electr.
44

Guber.
Electr.
45

Export.
Electr.
46

Pagos
Exterior
Electr.
47

2

2

1

1

2

2

2

2

2

2

Es  el  número  del  comprobante  fiscal
que  será  afectado  o  remplazado  por
una secuencia electrónica.

1

Número de Comprobante
Fiscal modificado79
<NCFModificado>

Tanto  el  comprobante  afectado  o
la  secuencia
reemplazado,  como
electrónica, deben estar emitidos por
el mismo RNC/Cédula.

11 o 13 o
19

ALFA
NUM

Condicional a que la emisión del e-CF
corresponda  a  un  reemplazo  de
Comprobante  Fiscal  no  electrónico
emitido en contingencia.

Aplica cuando el RNC del que emite el
e-CF no coincide con el comprobante
fiscal modificado (debido a que el RNC
se  encuentre  dado  de  baja  por
disolución,  fusión  o  escisión).  En  ese
caso,  se  debe  validar  que  el  campo
“RNC  otro
contribuyente”  esté
completado correctamente.

2

RNC Otro contribuyente
<RNCOtroContribuyente>

comprobante
haya

a)  Validar  que  el  número
fiscal
de
modificado
sido
remitido previamente a la
DGII. Este puede ser tanto
secuencia
electrónica
como en papel.

de

b) Si la emisión del e-CF es
de
por
Código
4:
Modificación
un
Reemplazo
comprobante
no
electrónico  emitido  en
contingencia,
se  debe
validar que el tipo del NCF
modificado
el
equivalente al tipo de e-CF
que se está emitiendo.

sea

I

2

2

1

1

2

2

2

2

2

2

9 u 11

NUM

Validar estructura.

N

2

2

2

2

2

2

2

2

2

2

79 El número de comprobante fiscal modificado puede ser tanto electrónico como de secuencia en papel. La secuencia en papel puede ser modificada por una secuencia con inicio de letra A y B, es decir con la estructura A010010010100000001 y
B0100000001.

Pág. 56 de 87

Condicional  a  que  el  comprobante
modificado  no  coincida  con  el  RNC
Emisor del e-CF (debido a que el RNC
se  encuentre  dado  de  baja  (por
disolución, fusión o escisión).

Fecha  del  número  de  comprobante
fiscal modificado. Condicional a que la
emisión  del  e-CF  corresponda  a  un
reemplazo de Comprobante Fiscal no
electrónico emitido en contingencia.

Código utilizado para indicar si el e-CF
del comprobante fiscal modificado es
con la finalidad de:
a) Anulación total
b) Corrección montos
c) Corrección Texto
d) Reemplazo  NCF
contingencia
e) Referenciar  Factura  de  Consumo
Electrónica.

emitido

en

a),  b)  y  c)  solo  aplican  para  Nota  de
Crédito o Débito Electrónica.

Condicional  a  que  el  código  de
modificación sea igual a 4.

Campo  para  describir
los  datos
modificados  o  la  razón  de  la  emisión
la  Nota  de  Crédito  o  Débito
de
Electrónica.
Ejemplo: “error en precio”.

3

Fecha NCF Modificado
<FechaNCFModificado>

4

Código de Modificación
<CodigoModificacion>

5

Razón Modificación
<RazonModificacion>

10

ALFA
NUM

Validar
a) Formato: (dd-MM-
AAAA).
b) Fecha de emisión del
comprobante fiscal.

a) Código tipo80:

N

2

2

1

1

2

2

2

2

2

2

1

NUM

el

NCF

1:
Anula
modificado
2:  Corrige  Texto  del
Comprobante
Fiscal
modificado
3: Corrige montos del NCF
modificado
Reemplazo
4:
emitido en contingencia
5:  Referencia
Consumo Electrónica.81

Factura

NCF

P

2

2

1

1

2

2

2

2

2

2

90

ALFA

a) Sin validación

N

0

0

3

3

0

0

0

0

0

0

FIN ÁREA

INFORMACIÓN DE REFERENCIA

80 Códigos de modificación 1, 2 y 3 aplican solo cuando se trate de la emisión de una nota de crédito o débito electrónica, según corresponda.
81 Aplica solo para la emisión de Factura de Crédito Fiscal.

Pág. 57 de 87

G. FECHA Y HORA DE LA FIRMA DIGITAL

CAMPOS

DESCRIPCIÓN

Largo Max

1

Fecha y hora de la firma digital del e-CF
< FechaHoraFirma>

 Fecha y hora en formato dd-MM-AAAA HH:mm:ss; Zona horaria
GMT -4

19

Tipo

ALFA
NUM

Validación

a)  Fecha  y  hora  válida  en  formato  indicado,  dd-
MM-AAAA HH:mm:ss, respectivamente.
b) Valida que fecha y hora firma del e-CF=< fecha
y hora actual.

H.  FIRMA DIGITAL

CAMPOS

ÁREA
<Signature>

1

Firma Digital

DESCRIPCIÓN

Largo
Max

Tipo

Validación

Obligatoriedad

SIGNATURE

sobre

Firma  digital
todo  el  documento.
(Encabezado,  Detalle,  Descuentos  -  Recargos,
Paginación,  Información  de  Referencia,  Fecha  y
Hora de Firma del e-CF).

1

1

FIN ÁREA

SIGNATURE

Pág. 58 de 87

TABLAS

Pág. 59 de 87

TABLA I. CODIFICACIÓN TIPOS DE IMPUESTOS ADICIONALES

Tipo Impuesto
(Abreviatura)
Propina Legal

CDT

ISC

ISC Específico82

CÓDIGO

Tipo Impuesto

Propina Legal

Contribución al Desarrollo de
las Telecomunicaciones

Impuesto Selectivo al
Consumo
Impuesto sobre el Primer
Registro de Vehículos
(Primera Placa)

Impuesto Selectivo al
Consumo (Tasa Específico)

001

002

003
004

005

006
007
008
009
010
011
012
013
014
015
016
017
018
019
020
021
022

Descripción

Propina Legal

Contribución al Desarrollo de las Telecomunicaciones
Ley 153-98 Art. 45

Servicios Seguros en general
Servicios de Telecomunicaciones

Expedición de la primera placa

Cerveza
Vinos de uva
Vermut y demás vinos de uvas frescas
Demás bebidas fermentadas
Alcohol Etílico sin desnaturalizar (Mayor o igual a 80%)
Alcohol Etílico sin desnaturalizar (inferior a 80%)
Aguardientes de uva
Whisky
Ron y demás aguardientes de caña
Gin y Ginebra
Vodka
Licores
Los demás (Bebidas y Alcoholes)
Cigarrillos que contengan tabaco cajetilla 20 unidades
Los demás Cigarrillos que contengan 20 unidades
Cigarrillos que contengan 10 unidades
Los demás Cigarrillos que contengan 10 unidades

Tasa

10%

2%

16%
10%

17%

632.58
632.58
632.58
632.58
632.58
632.58
632.58
632.58
632.58
632.58
632.58
632.58
632.58
53.51
53.51
26.75
26.75

82 Los montos específicos para los productos del alcohol y del tabaco son ajustados trimestralmente de acuerdo con el índice de inflación publicado por el Banco Central.

Pág. 60 de 87

Tasa

10%
10%
10%
10%
10%
10%

10%
10%
10%
10%

10%
10%
10%
20%

20%
20%
20%

Tipo Impuesto

Tipo Impuesto
(Abreviatura)

Descripción

023
024
025
026
027
028

029
030
031
032

033
034
035
036

037
038
039

Impuesto Selectivo al
Consumo
(Tasa AdValorem)

ISC AdValorem

Cerveza
Vinos de uva
Vermut y demás vinos de uvas frescas
Demás bebidas fermentadas
Alcohol Etílico sin desnaturalizar (Mayor o igual a 80%)
Alcohol Etílico sin desnaturalizar (inferior a 80%)

Aguardientes de uva
Whisky
Ron y demás aguardientes de caña
Gin y Ginebra

Vodka
Licores
Los demás (Bebidas y Alcoholes)
Cigarrillos que contengan tabaco cajetilla 20 unidades

Los demás Cigarrillos que contengan 20 unidades
Cigarrillos que contengan 10 unidades
Los demás Cigarrillos que contengan 10 unidades

Pág. 61 de 87

TABLA II. CODIFICACIÓN MONEDAS

Código
ISO
BRL

CAD

CHF

CHY

XDR

DKK

EUR

GBP

JPY

NOK

SCP

SEK

USD

VEF

HTG

MXN

COP

Moneda

REAL BRASILENO

DOLAR CANADIENSE

FRANCO SUIZO

YUAN CHINO
DERECHO ESPECIAL DE GIRO83
CORONA DANESA

EURO

LIBRA ESTERLINA

YEN JAPONES

CORONA NORUEGA

LIBRA ESCOCESA

CORONA SUECA

DOLAR ESTADOUNIDENSE

BOLIVAR FUERTE VENEZOLANO

GURDA HAITIANA

PESO MEXICANO

PESO COLOMBIANO

83 El Derecho Especial de Giro (DEG) no es una moneda, corresponde a la unidad de cuenta del FMI.

Pág. 62 de 87

TABLA III. CODIFICACIÓN PROVINCIAS Y MUNICIPIOS84

CÓDIGO
PROVINCIA

010000

CÓDIGO
MUNICIPIO

020000

010100

010101

020000

020100

020101

020102

020103

020104

020105

020106

020107

020108

020109

020200

020201

020202

020300

020301

020302

020303

DESCRIPCIÓN

DISTRITO NACIONAL

MUNICIPIO SANTO DOMINGO DE GUZMÁN

SANTO DOMINGO DE GUZMÁN (D. M.).

PROVINCIA AZUA

MUNICIPIO AZUA

AZUA (D. M.).

BARRO ARRIBA (D. M.).

LAS BARÍAS-LA ESTANCIA (D. M.).

LOS JOVILLOS (D. M.).

PUERTO VIEJO (D. M.).

BARRERAS (D. M.).

DOÑA EMMA BALAGUER VIUDA VALLEJO
(D. M.).

CLAVELLINA (D. M.).

LAS LOMAS (D. M.).

MUNICIPIO LAS CHARCAS

LAS CHARCAS (D. M.).

PALMAR DE OCOA (D. M.).

MUNICIPIO LAS YAYAS DE VIAJAMA

LAS YAYAS DE VIAJAMA (D. M.).

VILLARPANDO (D. M.).

HATO NUEVO CORTÉS (D. M.).

Fuente: Oficina Nacional de Estadística (ONE), Departamento de Cartografía. División de Límites y Linderos.
Actualizada al 30 de junio del 2014

84 Listado de Códigos de Provincias, Municipios y Distritos Municipales (D.M.). Fuente: Oficina Nacional de Estadística (ONE), Departamento de Cartografía. División de Límites y Linderos.

Pág. 63 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

020400

020401

020402

020403

020404

020405

020500

020501

020600

020601

020602

020603

020604

020700

020701

020702

020800

020801

020802

020803

020804

020900

020901

021000

021001

030000

DESCRIPCIÓN

MUNICIPIO PADRE LAS CASAS

PADRE LAS CASAS (D. M.).

LAS LAGUNAS (D. M.).

LA SIEMBRA (D. M.).

MONTE BONITO (D. M.).

LOS FRÍOS (D. M.).

MUNICIPIO PERALTA

PERALTA (D. M.).

MUNICIPIO SABANA YEGUA

SABANA YEGUA (D. M.).

PROYECTO 4 (D. M.).

GANADERO (D. M.).

PROYECTO 2-C (D. M.).

MUNICIPIO PUEBLO VIEJO

PUEBLO VIEJO (D. M.).

EL ROSARIO (D. M.).

MUNICIPIO TÁBARA ARRIBA

TÁBARA ARRIBA (D. M.).

TÁBARA ABAJO (D. M.).

AMIAMA GÓMEZ (D. M.).

LOS TOROS (D. M.).

MUNICIPIO GUAYABAL

GUAYABAL (D. M.).

MUNICIPIO ESTEBANÍA

ESTEBANÍA (D. M.).

PROVINCIA BAHORUCO

Fuente: Oficina Nacional de Estadística (ONE), Departamento de Cartografía. División de Límites y Linderos.
Actualizada al 30 de junio del 2014

Pág. 64 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

030001

030101

030102

030200

030201

030202

030300

030301

030302

030303

030304

030305

030306

030307

030400

030401

030500

030501

030502

040100

040101

040102

040103

040104

040200

040201

040300

MUNICIPIO NEIBA

NEIBA (D. M.).

EL PALMAR  (D. M.).

MUNICIPIO GALVÁN

GALVÁN (D. M.).

EL SALADO (D. M.).

MUNICIPIO TAMAYO

TAMAYO (D. M.).

UVILLA (D. M.).

SANTANA (D. M.).

MONSERRATE (MONTSERRAT) (D. M.).

CABEZA DE TORO (D. M.).

MENA (D. M.).

SANTA BÁRBARA EL 6 (D. M.).

MUNICIPIO VILLA JARAGUA

VILLA JARAGUA (D. M.).

MUNICIPIO LOS RÍOS

LOS RÍOS (D. M.).

LAS CLAVELLINAS (D. M.).

PROVINCIA BARAHONA

MUNICIPIO BARAHONA

BARAHONA (D. M.).

EL CACHÓN (D. M.).

LA GUÁZARA (D. M.).

VILLA CENTRAL (D. M.).

MUNICIPIO CABRAL

CABRAL (D. M.).

MUNICIPIO ENRIQUILLO

040000

Pág. 65 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

040301

040302

040400

040401

040402

040500

040501

040502

040503

040504

040600

040601

040700

040701

040702

040800

040801

040802

040900

040901

041000

041001

041100

041101

041102

050000

DESCRIPCIÓN

ENRIQUILLO (D. M.).

ARROYO DULCE (D. M.).

MUNICIPIO PARAÍSO

PARAÍSO (D. M.).

LOS PATOS (D. M.).

MUNICIPIO VICENTE NOBLE

VICENTE NOBLE (D. M.).

CANOA (D. M.).

QUITA CORAZA (D. M.).

FONDO NEGRO (D. M.).

MUNICIPIO EL PEÑÓN

EL PEÑÓN (D. M.).

MUNICIPIO LA CIÉNAGA

LA CIÉNAGA (D. M.).

BAHORUCO (D. M.).

MUNICIPIO FUNDACIÓN

FUNDACIÓN (D. M.).

PESCADERÍA (D. M.).

MUNICIPIO LAS SALINAS

LAS SALINAS (D. M.).

MUNICIPIO POLO

POLO (D. M.).

MUNICIPIO JAQUIMEYES

JAQUIMEYES (D. M.).

PALO ALTO (D. M.).

PROVINCIA DAJABÓN

050100

MUNICIPIO DAJABÓN

Fuente: Oficina Nacional de Estadística (ONE), Departamento de Cartografía. División de Límites y Linderos.
Actualizada al 30 de junio del 2014

Pág. 66 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

060000

050101

050102

050200

050201

050202

050203

050300

050301

050400

050401

050500

050501

050502

060100

060101

060102

060103

060104

060105

060200

060201

060202

060203

060300

060301

060400

060401

DESCRIPCIÓN

DAJABÓN (D. M.).

CAÑONGO (D. M.).

MUNICIPIO LOMA DE CABRERA

LOMA DE CABRERA (D. M.).

CAPOTILLO (D. M.).

SANTIAGO DE LA CRUZ (D. M.).

MUNICIPIO PARTIDO

PARTIDO (D. M.).

MUNICIPIO RESTAURACIÓN

RESTAURACIÓN (D. M.).

MUNICIPIO EL PINO

EL PINO (D. M.).

MANUEL BUENO (D. M.).

PROVINCIA DUARTE

MUNICIPIO SAN FRANCISCO DE MACORÍS

SAN FRANCISCO DE MACORÍS (D. M.).

LA PEÑA (D. M.).

CENOVÍ (D. M.).

JAYA (D. M.).

PRESIDENTE DON ANTONIO GUZMÁN
FERNÁNDEZ (D. M.).

MUNICIPIO ARENOSO

ARENOSO (D. M.).

LAS COLES (D. M.).

EL AGUACATE (D. M.).

MUNICIPIO CASTILLO

CASTILLO (D. M.).

MUNICIPIO PIMENTEL

PIMENTEL (D. M.).

Pág. 67 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

070000

060500

060501

060502

060503

060504

060505

060600

060601

060700

060701

060702

070100

070101

070102

070103

070200

070201

070202

070203

070300

070301

070302

070400

070401

070402

070500

070501

MUNICIPIO VILLA RIVA

VILLA RIVA (D. M.).

AGUA SANTA DEL YUNA  (D. M.).

CRISTO REY DE GUARAGUAO (D. M.).

LAS TARANAS (D. M.).

BARRAQUITO (D. M.).

MUNICIPIO LAS GUÁRANAS

LAS GUÁRANAS (D. M.).

MUNICIPIO EUGENIO MARÍA DE HOSTOS

EUGENIO MARÍA DE HOSTOS (D. M.).

SABANA GRANDE (D. M.).

PROVINCIA ELÍAS PIÑA

MUNICIPIO COMENDADOR

COMENDADOR (D. M.).

SABANA LARGA (D. M.).

GUAYABO  (D. M.).

MUNICIPIO BÁNICA

BÁNICA (D. M.).

SABANA CRUZ (D. M.).

SABANA HIGÜERO (D. M.).

MUNICIPIO EL LLANO

EL LLANO (D. M.).

GUANITO (D. M.).

MUNICIPIO HONDO VALLE

HONDO VALLE (D. M.).

RANCHO DE LA GUARDIA (D. M.).

MUNICIPIO PEDRO SANTANA

PEDRO SANTANA (D. M.).

Pág. 68 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

080000

090000

070502

070600

070601

080100

080101

080102

080103

080104

080200

080201

080202

080203

090100

090101

090102

090103

090104

090105

090106

090107

090108

090109

090200

090201

090300

090301

DESCRIPCIÓN

RÍO LIMPIO (D. M.).

MUNICIPIO JUAN SANTIAGO

JUAN SANTIAGO (D. M.).

PROVINCIA EL SEIBO

MUNICIPIO EL SEIBO

EL SEIBO (D. M.).

PEDRO SÁNCHEZ (D. M.).

SAN FRANCISCO-VICENTILLO (D. M.).

SANTA LUCÍA (D. M.).

MUNICIPIO MICHES

MICHES (D. M.).

EL CEDRO (D. M.).

LA GINA (D. M.).

PROVINCIA ESPAILLAT

MUNICIPIO MOCA

MOCA (D. M.).

JOSÉ CONTRERAS (D. M.).

SAN VÍCTOR (D. M.).

JUAN LÓPEZ (D. M.).

LAS LAGUNAS (D. M.).

CANCA LA REYNA  (D. M.).

EL HIGÜERITO (D. M.).

MONTE DE LA JAGUA (D. M.).

LA ORTEGA (D. M.).

MUNICIPIO CAYETANO GERMOSÉN

CAYETANO GERMOSÉN (D. M.).

MUNICIPIO GASPAR HERNÁNDEZ

GASPAR HERNÁNDEZ (D. M.).

Pág. 69 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

090302

090303

090304

090400

090401

100100

100101

100102

100103

100200

100201

100202

100300

100301

100400

100401

100402

100500

100501

100502

100600

100601

100602

110100

110101

110102

100000

110000

DESCRIPCIÓN

JOBA ARRIBA (D. M.).

VERAGUA (D. M.).

VILLA MAGANTE (D. M.).

MUNICIPIO JAMAO AL NORTE

JAMAO AL NORTE (D. M.).

PROVINCIA INDEPENDENCIA

MUNICIPIO JIMANÍ

JIMANÍ (D. M.).

EL LIMÓN (D. M.).

BOCA DE CACHÓN (D. M.).

MUNICIPIO DUVERGÉ

DUVERGÉ (D. M.).

VENGAN A VER (D. M.).

MUNICIPIO LA DESCUBIERTA

LA DESCUBIERTA (D. M.).

MUNICIPIO POSTRER RÍO

POSTRER RÍO (D. M.).

GUAYABAL (D. M.).

MUNICIPIO CRISTÓBAL

CRISTÓBAL (D. M.).

BATEY 8 (D. M.).

MUNICIPIO MELLA

MELLA (D. M.).

LA COLONIA (D. M.).

PROVINCIA LA ALTAGRACIA

MUNICIPIO HIGÜEY

HIGÜEY (D. M.).

LAS LAGUNAS DE NISIBÓN (D. M.).

Pág. 70 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

110103

LA OTRA BANDA (D. M.).

120000

130000

110104

110200

110201

110202

110203

120100

120101

120102

120200

120201

120300

120301

120302

130100

130101

130102

130103

130104

130105

130200

130201

130202

130203

130300

130301

VERÓN PUNTA CANA (D. M.) (Incluye
Bávaro)

MUNICIPIO SAN RAFAEL DEL YUMA

SAN RAFAEL DEL YUMA (D. M.).

BOCA DE YUMA (D. M.).

BAYAHÍBE (D. M.).

PROVINCIA LA ROMANA

MUNICIPIO LA ROMANA

LA ROMANA (D. M.).

CALETA (D. M.).

MUNICIPIO GUAYMATE

GUAYMATE (D. M.).

MUNICIPIO VILLA HERMOSA

VILLA HERMOSA (D. M.).

CUMAYASA (D. M.).

PROVINCIA LA VEGA

MUNICIPIO LA VEGA

LA VEGA (D. M.).

RÍO VERDE ARRIBA (D. M.).

EL RANCHITO (D. M.).

TAVERAS (D. M.).

DON JUAN RODRÍGUEZ (D.M.)

MUNICIPIO CONSTANZA

CONSTANZA (D. M.).

TIREO (D. M.).

LA SABINA (D. M.).

MUNICIPIO JARABACOA

JARABACOA (D. M.).

Pág. 71 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

140000

150000

130302

130303

130400

130401

130402

140100

140101

140102

140103

140104

140200

140201

140202

140203

140300

140301

140302

140400

140401

150100

150101

150200

150201

150202

150300

150301

BUENA VISTA (D. M.).

MANABAO (D. M.).

MUNICIPIO JIMA ABAJO

JIMA ABAJO (D. M.).

RINCÓN (D. M.).

PROVINCIA MARÍA TRINIDAD SÁNCHEZ

MUNICIPIO NAGUA

NAGUA (D. M.).

SAN JOSÉ DE MATANZAS (D. M.).

LAS GORDAS (D. M.).

ARROYO AL MEDIO (D. M.).

MUNICIPIO CABRERA

CABRERA (D. M.).

ARROYO SALADO (D. M.).

LA ENTRADA (D. M.).

MUNICIPIO EL FACTOR

EL FACTOR (D. M.).

EL POZO (D. M.).

MUNICIPIO RÍO SAN JUAN

RÍO SAN JUAN (D. M.).

PROVINCIA MONTE CRISTI

MUNICIPIO MONTE CRISTI

MONTE CRISTI (D. M.).

MUNICIPIO CASTAÑUELAS

CASTAÑUELAS (D. M.).

PALO VERDE (D. M.).

MUNICIPIO GUAYUBÍN

GUAYUBÍN (D. M.).

Pág. 72 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

160000

170000

150302

150303

150304

150400

150401

150500

150501

150502

150600

150601

160100

160101

160102

160200

160201

160202

170100

170101

170102

170103

170104

170105

170106

170107

170108

170109

VILLA ELISA (D. M.).

HATILLO PALMA (D. M.).

CANA CHAPETÓN (D. M.).

MUNICIPIO LAS MATAS DE SANTA CRUZ

LAS MATAS DE SANTA CRUZ (D. M.).

MUNICIPIO PEPILLO SALCEDO

PEPILLO SALCEDO (MANZANILLO)

SANTA MARÍA (D. M.)

MUNICIPIO VILLA VÁSQUEZ

VILLA VÁSQUEZ

PROVINCIA PEDERNALES

MUNICIPIO PEDERNALES

PEDERNALES

JOSÉ FRANCISCO PEÑA GÓMEZ (D. M.).

MUNICIPIO OVIEDO

OVIEDO

JUANCHO (D. M.).

PROVINCIA PERAVIA

MUNICIPIO BANÍ

BANÍ (D. M.).

MATANZAS (D. M.).

VILLA FUNDACIÓN (D. M.).

SABANA BUEY (D. M.).

PAYA (D. M.).

VILLA SOMBRERO (D. M.).

EL CARRETÓN (D. M.).

CATALINA (D. M.).

EL LIMONAL (D. M.).

Pág. 73 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

180000

170110

170200

170201

170202

170203

170300

170301

180100

180101

180102

180103

180200

180201

180202

180300

180301

180400

180401

180500

180501

180502

180600

180601

180602

180603

180604

LAS BARÍAS (D. M.).

MUNICIPIO NIZAO

NIZAO

PIZARRETE (D. M.).

SANTANA (D. M.).

MATANZAS

MATANZAS

PROVINCIA PUERTO PLATA

MUNICIPIO PUERTO PLATA

PUERTO PLATA (D. M.).

YÁSICA ARRIBA (D. M.).

MAIMÓN (D. M.).

MUNICIPIO ALTAMIRA

ALTAMIRA

RÍO GRANDE (D. M.).

MUNICIPIO GUANANICO

GUANANICO

MUNICIPIO IMBERT

IMBERT

MUNICIPIO LOS HIDALGOS

LOS HIDALGOS

NAVAS (D. M.).

MUNICIPIO LUPERÓN

LUPERÓN

LA ISABELA (D. M.).

BELLOSO (D. M.).

EL ESTRECHO DE LUPERÓN OMAR BROSS
(D. M.).

180700

MUNICIPIO SOSÚA

Pág. 74 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

180701

180702

180703

180800

180801

180802

180803

180804

180900

180901

190100

190101

190102

190200

190201

190202

190300

190301

200100

200101

200102

200103

200104

200200

200201

200300

190000

200000

DESCRIPCIÓN

SOSÚA

CABARETE (D. M.).

SABANETA DE YÁSICA (D. M.).

MUNICIPIO VILLA ISABELA

VILLA ISABELA

ESTERO HONDO (D. M.).

LA JAIBA (D. M.).

GUALETE (D. M.).

MUNICIPIO VILLA MONTELLANO

VILLA MONTELLANO

PROVINCIA HERMANAS MIRABAL

MUNICIPIO SALCEDO

SALCEDO

JAMAO AFUERA (D. M.).

MUNICIPIO TENARES

TENARES

BLANCO (D. M.).

MUNICIPIO VILLA TAPIA

VILLA TAPIA

PROVINCIA SAMANÁ

MUNICIPIO SAMANÁ

SAMANÁ

EL LIMÓN  (D. M.).

ARROYO BARRIL (D. M.).

LAS GALERAS (D. M.).

MUNICIPIO SÁNCHEZ

SÁNCHEZ (D. M.).

MUNICIPIO LAS TERRENAS

Pág. 75 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

200301

LAS TERRENAS

210000

220000

210100

210101

210102

210103

210200

210201

210300

210301

210302

210303

210400

210401

210402

210500

210501

210502

210503

210504

210600

210601

210602

210700

210701

210800

210801

PROVINCIA SAN CRISTÓBAL

MUNICIPIO SAN CRISTÓBAL

SAN CRISTÓBAL (D. M.).

HATO DAMAS (D. M.).

HATILLO (D. M.).

MUNICIPIO SABANA GRANDE DE
PALENQUE

SABANA GRANDE DE PALENQUE (D. M.).

MUNICIPIO BAJOS DE HAINA

BAJOS DE HAINA

EL CARRIL (D. M.).

QUITA SUEÑO (D. M.).

MUNICIPIO CAMBITA GARABITOS

CAMBITA GARABITOS

CAMBITA EL PUEBLECITO (D. M.).

MUNICIPIO VILLA ALTAGRACIA

VILLA ALTAGRACIA

SAN JOSÉ DEL PUERTO (D. M.).

MEDINA (D. M.).

LA CUCHILLA (D. M.).

MUNICIPIO YAGUATE

YAGUATE (D. M.).

DOÑA ANA (D. M.)

MUNICIPIO SAN GREGORIO DE NIGUA

SAN GREGORIO DE NIGUA

MUNICIPIO LOS CACAOS

LOS CACAOS (D. M.).

PROVINCIA SAN JUAN

Pág. 76 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

220100

220101

220102

220103

220104

220105

220106

220107

220108

220109

220110

220111

220200

220201

220202

220203

220300

220301

220302

220303

220400

220401

220402

220500

220501

220502

220503

220600

MUNICIPIO SAN JUAN

SAN JUAN

PEDRO CORTO (D. M.).

SABANETA (D. M.).

SABANA ALTA (D. M.).

EL ROSARIO (D. M.).

HATO DEL PADRE (D. M.).

GUANITO (D. M.).

LA JAGUA (D. M.).

LAS MAGUANAS-HATO NUEVO (D. M.).

LAS CHARCAS DE MARÍA NOVA (D. M.).

LAS ZANJAS (D. M.)

MUNICIPIO BOHECHÍO

BOHECHÍO

ARROYO CANO (D. M.).

YAQUE (D. M.).

MUNICIPIO EL CERCADO

EL CERCADO

DERRUMBADERO (D. M.)

BATISTA (D. M.)

MUNICIPIO JUAN DE HERRERA

JUAN DE HERRERA

JÍNOVA (D. M.).

MUNICIPIO LAS MATAS DE FARFÁN

LAS MATAS DE FARFÁN

MATAYAYA (D. M.).

CARRERA DE YEGUAS (D. M.).

MUNICIPIO VALLEJUELO

Pág. 77 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

230000

240000

220601

220602

230100

230101

230200

230201

230202

230203

230300

230301

230400

230401

230500

230501

230600

230601

240100

240101

240102

240103

240104

240105

240106

240200

240201

240202

VALLEJUELO

JORJILLO (D. M.).

PROVINCIA SAN PEDRO DE MACORÍS

MUNICIPIO SAN PEDRO DE MACORÍS

SAN PEDRO DE MACORÍS

MUNICIPIO LOS LLANOS

LOS LLANOS

EL PUERTO (D. M.).

GAUTIER (D. M.).

MUNICIPIO RAMÓN SANTANA

RAMÓN SANTANA

MUNICIPIO CONSUELO

CONSUELO

MUNICIPIO QUISQUEYA

QUISQUEYA

MUNICIPIO GUAYACANES

GUAYACANES

PROVINCIA SÁNCHEZ RAMÍREZ

MUNICIPIO COTUÍ

COTUÍ

QUITA SUEÑO (D. M.).

CABALLERO (D. M.).

COMEDERO ARRIBA (D. M.).

PLATANAL  (D. M.).

ZAMBRANA ABAJO

MUNICIPIO CEVICOS

CEVICOS

LA CUEVA (D. M.).

Pág. 78 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

250000

240300

240301

240400

240401

240402

240403

240404

250100

250101

250102

250104

250105

250106

250107

250200

250201

250300

250301

250302

250303

250400

250401

250402

250500

250501

250502

250503

MUNICIPIO FANTINO

FANTINO

MUNICIPIO LA MATA

LA MATA

LA BIJA (D. M.).

ANGELINA (D. M.).

HERNANDO ALONZO (D. M.).

PROVINCIA SANTIAGO

MUNICIPIO SANTIAGO

SANTIAGO

PEDRO GARCÍA (D. M.).

BAITOA (D. M.).

LA CANELA (D. M.).

SAN FRANCISCO DE JACAGUA (D. M.).

HATO DEL YAQUE (D. M.).

MUNICIPIO BISONÓ

VILLA BISONÓ (NAVARRETE) (D. M.).

MUNICIPIO JÁNICO

JÁNICO

JUNCALITO (D. M.).

EL CAIMITO (D. M.).

MUNICIPIO LICEY AL MEDIO

LICEY AL MEDIO

LAS PALOMAS (D. M.).

MUNICIPIO SAN JOSÉ DE LAS MATAS

SAN JOSÉ DE LAS MATAS

EL RUBIO (D. M.).

LA CUESTA (D. M.).

Pág. 79 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

250504

250600

250601

250602

250700

250701

250702

250703

250800

250801

250802

250803

250900

250901

251000

251001

260100

260101

260200

260201

260300

260301

270100

270101

270102

270103

260000

270000

DESCRIPCIÓN

LAS PLACETAS (D. M.).

MUNICIPIO TAMBORIL

TAMBORIL

CANCA LA PIEDRA (D. M.).

MUNICIPIO VILLA GONZÁLEZ

VILLA GONZÁLEZ

PALMAR ARRIBA (D. M.).

EL LIMÓN (D. M.).

MUNICIPIO PUÑAL

PUÑAL

GUAYABAL (D. M.).

CANABACOA (D. M.).

MUNICIPIO SABANA IGLESIA

SABANA IGLESIA

BAITOA

BAITOA

PROVINCIA SANTIAGO RODRÍGUEZ

MUNICIPIO SAN IGNACIO DE SABANETA

SAN IGNACIO DE SABANETA (D. M.).

MUNICIPIO VILLA LOS ALMÁCIGOS

VILLA LOS ALMÁCIGOS (D. M.).

MUNICIPIO MONCIÓN

MONCIÓN (D. M.).

PROVINCIA VALVERDE

MUNICIPIO MAO

MAO (D. M.).

AMINA (D. M.).

JAIBÓN (PUEBLO NUEVO) (D. M.).

Pág. 80 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

280000

270104

270200

270201

270202

270203

270204

270205

270300

270301

270302

270303

270304

280100

280101

280102

280103

280104

280105

280106

280200

280201

280300

280301

280302

280303

DESCRIPCIÓN

GUATAPANAL (D. M.).

MUNICIPIO ESPERANZA

ESPERANZA

MAIZAL (D. M.).

JICOMÉ (D. M.).

BOCA DE MAO (D. M.).

PARADERO (D. M.).

MUNICIPIO LAGUNA SALADA

LAGUNA SALADA (D. M.).

JAIBÓN (D. M.).

LA CAYA (D. M.).

CRUCE DE GUAYACANES (D. M.).

PROVINCIA MONSEÑOR NOUEL

MUNICIPIO BONAO

BONAO (D. M.).

SABANA DEL PUERTO (D. M.).

JUMA BEJUCAL (D. M.).

ARROYO  TORO - MASIPEDRO (D. M.).

JAYACO (D. M.).

LA SALVIA - LOS QUEMADOS (D. M.).

MUNICIPIO MAIMÓN

MAIMÓN (D. M.).

MUNICIPIO PIEDRA BLANCA

PIEDRA BLANCA (D. M.).

VILLA DE SONADOR (D. M.).

JUAN ADRIÁN (D. M.).

290000

PROVINCIA MONTE PLATA

290100

MUNICIPIO MONTE PLATA

Pág. 81 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

290101

290102

290103

290104

290200

290201

290300

290301

290302

290303

290400

290402

290403

290500

290501

300100

300101

300102

300103

300104

300200

300201

300202

300300

300301

MONTE PLATA (D. M.).

DON JUAN (D. M.).

CHIRINO (D. M.).

BOYÁ (D. M.).

MUNICIPIO BAYAGUANA

BAYAGUANA (D. M.).

MUNICIPIO SABANA GRANDE DE BOYÁ

SABANA GRANDE DE BOYÁ (D. M.).

GONZALO (D. M.).

MAJAGUAL (D. M.).

MUNICIPIO YAMASÁ

LOS BOTADOS (D. M.).

MAMÁ TINGÓ (D. M.).

MUNICIPIO PERALVILLO

PERALVILLO (D. M.).

PROVINCIA HATO MAYOR

MUNICIPIO HATO MAYOR

HATO MAYOR (D. M.).

YERBA BUENA (D. M.).

MATA PALACIO (D. M.).

GUAYABO DULCE (D. M.).

MUNICIPIO SABANA DE LA MAR

SABANA DE LA MAR (D. M.).

ELUPINA CORDERO DE LAS CAÑITAS (D.
M.).

MUNICIPIO EL VALLE

EL VALLE (D. M.).

300000

310000

PROVINCIA SAN JOSÉ DE OCOA

310100

MUNICIPIO SAN JOSÉ DE OCOA

Pág. 82 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

320000

310101

310102

310103

310104

310105

310200

310201

310300

310301

320100

320101

320102

320200

320201

320300

320301

320302

320400

320401

320402

320500

320501

320502

320600

320601

320602

320603

DESCRIPCIÓN

SAN JOSÉ DE OCOA (D. M.).

LA CIÉNAGA (D. M.).

NIZAO - LAS AUYAMAS (D. M.).

EL PINAR (D. M.).

EL NARANJAL (D. M.).

MUNICIPIO SABANA LARGA

SABANA LARGA (D. M.).

MUNICIPIO RANCHO ARRIBA

RANCHO ARRIBA (D. M.).

PROVINCIA SANTO DOMINGO

MUNICIPIO SANTO DOMINGO ESTE

SANTO DOMINGO ESTE (D. M.).

SAN LUIS (D. M.).

MUNICIPIO SANTO DOMINGO OESTE

SANTO DOMINGO OESTE (D. M.).

MUNICIPIO SANTO DOMINGO NORTE

SANTO DOMINGO NORTE (D. M.).

LA VICTORIA (D. M.).

MUNICIPIO BOCA CHICA

BOCA CHICA (D. M.).

LA CALETA (D. M.).

MUNICIPIO SAN ANTONIO DE GUERRA

SAN ANTONIO DE GUERRA (D. M.).

HATO VIEJO (D. M.).

MUNICIPIO LOS ALCARRIZOS

LOS ALCARRIZOS (D. M.).

PALMAREJO-VILLA LINDA (D. M.).

PANTOJA (D. M.).

Pág. 83 de 87

CÓDIGO
PROVINCIA

CÓDIGO
MUNICIPIO

DESCRIPCIÓN

320700

320701

320702

320703

MUNICIPIO PEDRO BRAND

PEDRO BRAND (D. M.).

LA GUÁYIGA (D. M.).

LA CUABA (D. M.).

Fuente: Oficina Nacional de Estadística (ONE), Departamento de Cartografía. División de Límites y Linderos.
Actualizada al 30 de junio del 2014

Pág. 84 de 87

TABLA IV. CODIFICACIÓN UNIDAD DE MEDIDA

Código

1

2

3

4

5

6

7

8

9

10

11

12

13

14

15

16

17

18

19

20

21

22

23
24
25

26

27

28

Abrev.

BARR

BOL

BOT

BULTO

BOTELLA
CAJ

CAJETILLA

CM

CIL

CONJ

CONT

DÍA

DOC

FARD

GL

GRAD

GR

GRAN

HOR

HUAC

KG

kWh
LB
LITRO
LOT

M

M2

M3

Medida

Barril

Bolsa

Bote

Bultos

Botella
Caja/Cajón

Cajetilla

Centímetro

Cilindro

Conjunto

Contenedor

Día

Docena

Fardo

Galones

Grado

Gramo

Granel

Hora

Huacal

Kilogramo

Kilovatio Hora
Libra
Litro
Lote

Metro

Metro Cuadrado

Metro Cúbico

Pág. 85 de 87

Código

Abrev.

Medida

29

30

31

32

33

34

35

36

37

38

39

40

41

42

43

44

45

46

47

48

49

50

51

52

53

54

55

56
57

MMBTU

MIN
PAQ

PAR

PIE

PZA

ROL

SOBR

SEG

TANQUE
TONE

TUB

YD
YD2

UND

EA

MILLAR

SAC

LAT

DIS

BID

RAC

Q

GRT

P2

PAX

PULG

STAY
BDJ

Millones de Unidades
Térmicas
Minuto
Paquete

Par

Pie

Pieza

Rollo

Sobre

Segundo

Tanque
Tonelada

Tubo

Yarda

Yarda cuadrada

Unidad

Elemento

Millar

Saco

Lata

Display

Bidón

Ración

Quintal
Gross Register Tonnage
(Toneladas de registro bruto)
Pie cuadrado

Pasajero

Pulgadas

Parqueo barcos en muelle
Bandeja

Pág. 86 de 87

Código
58
59

60

61

62

Abrev.

HA
ML

MG
OZ
OZT

Medida

Hectárea
Mililitro

Miligramo

Onzas

Onzas Troy

Pág. 87 de 87

IMPUESTOS INTERNOS
Octubre 2025

@DGIIRD

(809) 689-3444 desde cualquier parte del país.informacion@dgii.gov.dodgii.gov.doPublicación informativa sin validez legal