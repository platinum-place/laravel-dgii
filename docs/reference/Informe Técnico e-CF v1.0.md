Informe Técnico
Comprobante Fiscal
Electrónico

Gerencia de Facturación

Versión 1.0

Contenidos

 Gerencia de Facturación ........................................................................................... 1
Bitácora ............................................................................................................................... 4

Deﬁniciones .......................................................................................................................... 5

1. Introducción ...................................................................................................................... 7

2. Actores del Sistema ........................................................................................................... 7

3. Autenticidad del Emisor e Integridad de los e-CF ................................................................ 7

4. Comunicaciones y Web Service .......................................................................................... 8
4.1. Web Service – Autenticación ........................................................................................... 8
4.2. Web Service - Recepción e-CF ......................................................................................... 8
4.3. Web Service – Recepción RFCE ....................................................................................... 8
4.4. Web Service - Recepción de Aprobación Comercial........................................................ 8
4.5. Web Service - Consulta de Resultado de e-CF (emisores). .............................................. 9
4.6. Web Service - Consulta de Estado de e-CF (receptores). ................................................ 9
4.7. Web Service - Consulta de TrackID e-CF. ........................................................................ 9
4.8. Web Service - Consulta Directorio Facturadores ............................................................ 9
4.9. Web Service - Consulta Estatus Servicios ........................................................................ 9
4.10. Web Service - Anulación de e-NCF ................................................................................ 9
4.11. Web Service - Comunicación Emisor-Receptor ............................................................ 9

5. Consultas de e-CF ............................................................................................................ 10
5.1. Consulta en la página web de DGII ................................................................................ 10
5.2. Consultas en la Oficina Virtual (OFV) ............................................................................. 10
5.3. Consultas en la App Móvil ............................................................................................. 11

6. Comprobantes Fiscales Electrónicos (e-CF) ........................................................................ 12
6.1. Tipos de Comprobantes Fiscales Electrónicos (e-CF) .................................................... 12

7. Estructura,  Formato  y  Vencimiento  de  los  Números  Comprobantes Fiscales
Electrónicos (e-NCF) ............................................................................................................ 14

8. Modelo de Operación ...................................................................................................... 14

9. Factura de Consumo Electrónica menor a DOP$250 mil ..................................................... 16
9.1. Modelo de operación .................................................................................................... 16

10. Correcciones y Anulación de un e-CF ............................................................................... 17

11. Formato XML del e-CF .................................................................................................... 18
11.1. Contenido del e-CF ...................................................................................................... 18
11.1.1. Detalle por sección ................................................................................................... 20
11.1.2. Instrucciones de Formato para las Secciones18 ........................................................ 20

12. Regla de tolerancia. Cuadratura. .................................................................................... 21

13. Regla de Redondeo ........................................................................................................ 22

14. Impuesto Selectivo al Consumo (ISC) de Alcoholes y Cigarrillos. ....................................... 22

15. Otros impuestos adicionales ........................................................................................... 27

16. Tratamiento para e-CF con aplicación de la Norma General 07-07 ................................... 30

17. Tratamiento de los bonos o certificados de regalo en el marco de la facturación electrónica
conforme a la Norma General 03-08 ................................................................................... 31

18. Representación Impresa (RI) del e-CF .............................................................................. 31
18.1. Calidad de impresión................................................................................................... 31
18.2. Orden y Distribución de la Información en la Representación Impresa de un e-CF. . 31
18.2.2. Parte central ............................................................................................................. 33
18.2.3. Datos adicionales para incluirse en la RI .................................................................. 35

18.3. Modelos ilustrativos de Factura de Crédito Fiscal Electrónica ........................................ 38
18.3.1. Modelo ilustrativo con totales al final de la factura57 .............................................. 38

19. Operación en Contingencia ............................................................................................ 49

Bitácora

Actualizaciones al 16-03-2021

•

•

•

Fueron agregados en la sección 4. Comunicaciones y Web Service los servicios de Recepción RFCE,
Comunicación Emisor-Receptor, Consulta Estatus Servicios y Consulta de TrackId e-CF.

Se limitó el contenido de los diferentes servicios indicados en la sección 4. Comunicaciones y Web
Service, a una descripción funcional general y se incluyó la referencia de la descripción técnica para
ver más detalle de la estructura y funcionamiento de cada uno de los servicios.

Se actualiza el ejemplo de la URL que compone el nombre electrónico de una Factura de Consumo
Electrónica menor a DOP250 mil.

Actualizaciones al 17-08-2022

•

•

Se actualiza el ejemplo del cálculo del impuesto adicional para los códigos que se encuentra entre
023-035 y la unidad de medida es distinta de granel.

Se actualiza el ejemplo del cálculo del impuesto adicional para los códigos que se encuentra entre
036-039.

•  Actualización del tope máximo de la cantidad de líneas de los e-CF con un máximo de mil (1,000)

líneas.

•

Se excluye el término "Timbre Electrónico" en el documento de referencia.

Actualizaciones al 23-03-2026

•

Se  actualiza  el  Tratamiento  de  los  bonos  o  certificados  de  regalo  en  el  marco  de  la  facturación
electrónica conforme a la Norma General 03-08.

•

Se actualiza la Operación en Contingencia según Decreto 587-24.

Deﬁniciones

Aprobación  o  Rechazo  Comercial:  es  la  respuesta  que  emite  el  Receptor  Electrónico  sobre  un  e-CF
recibido  donde  informa,  tanto  al  emisor  electrónico  del  e-CF  como  a  la  DGII,  la  conformidad  o  no,
respectivamente, con el documento recibido, la cual es enviada a través del Servicio Web de Aprobación
Comercial, en el formato estándar XML deﬁnido.

Acuse  de  Recibo:  es  una  respuesta  automática  que  indica  que  el  e-CF  fue  recibido  por  el  receptor
electrónico; esta no implica una respuesta positiva o negativa respecto de la transacción comercial.

Certiﬁcado  Digital:  es  un  documento  digital  emitido  y  firmado  digitalmente  por  una  entidad  de
certificación,  que  identifica  inequívocamente  a  un  suscriptor  durante  el  período  de  vigencia del
certificado y que se constituye en prueba de que dicho suscriptor es fuente u originador del contenido
de un documento digital o mensaje de datos que incorpore su certificado asociado.

Contingencia:  es  el  estado  que  deﬁne  las  situaciones  excepcionales  que  podrían  impedir  el  curso
normal del ciclo de facturación electrónica y para el cual se encuentran deﬁnidas acciones específicas
que deben seguir los actores del modelo en cada situación.

Firma  Digital:  se  entenderá  como  un  valor  numérico  que  se  adhiere  a  un  mensaje  de  datos  y  que,
utilizando  un  procedimiento  matemático  conocido,  vinculado  a  la  clave  del  iniciador  y  al  texto  del
mensaje, permite determinar que este valor se ha obtenido exclusivamente con la clave del iniciador y
el texto del mensaje, y que el mensaje inicial no ha sido modificado después de efectuada la transmisión.

(Instituto  Dominicano  de

las
INDOTEL
telecomunicaciones y del comercio electrónico, documentos y ﬁrmas digitales, de conformidad con las
leyes No. 153-98 General de Telecomunicaciones y No. 126-02 de Comercio Electrónico, Documentos y
Firmas Digitales de la República Dominicana, respectivamente.

las  Telecomunicaciones):  órgano

regulador  de

Lenguaje  de  Marcas  Expansible  (XML):  es  un  lenguaje  estándar  que  estructura  el  intercambio  de
información entre diferentes plataformas, permitiendo la organización y el etiquetado de documentos.
Algunos de sus campos de aplicación son las bases de datos, los documentos de texto, las hojas de
cálculo y las páginas web.

Mensajes  de  Datos:  es  la  información  generada,  enviada,  recibida,  almacenada  o  comunicada  por
medios electrónicos, ópticos o similares, como pudieran ser, entre otros, el intercambio electrónico de
datos (EDI, por sus siglas en inglés), el correo electrónico, el telegrama, el télex o el telefax.

Número  de  Comprobante  Fiscal  Electrónico  (e-NCF):  secuencia  alfanumérica  que  identifica  un
comprobante ﬁscal electrónico otorgado por la Dirección General de Impuestos Internos (DGII).

Oficina  Virtual  (OFV):  es  un  espacio  telemático  donde
los  contribuyentes  pueden  ejecutar
procedimientos tributarios, con el fin de facilitar y reducir los costos del cumplimiento de estos. Está
ubicada dentro del portal de esta Dirección General y para su acceso es imprescindible cumplir con los
mecanismos de Autencación deﬁnidos por la DGII para el acceso.

Pág. 5 de 50

Prestadora de servicios de confianza: entidad de certificación conforme a lo establecido en la citada Ley
núm. 126-02 y en la normativa emitida por el INDOTEL.

Representación Impresa (RI) de e-CF: es la versión impresa en papel del formato XML de un e-CF, que
será  entregada  tanto  a  receptores  no  electrónicos  para  que  puedan  reportar  sus  transacciones  de
compras  ante  la  DGII,  sustentar  crédito  ﬁscal  y  conservar  dichos  documentos  según  lo  establece  la
legislación vigente, como a quienes lo requieran por vender bienes que incluyen transportación. A tales
ﬁnes, esta debe contener todos los campos establecidos como obligatorios por el Decreto núm. 254-06,
según las especificaciones de la Norma General núm. 06-2018.

Signatario o Firmante: contribuyente que actúa en nombre propio o persona que actúa por cuenta de
éste, y que habiendo obtenido previamente un certificado digital para uso tributario tiene la capacidad de
ﬁrmar un documento digital y de autenticarse ante la DGII para realizar operaciones relacionadas con
los e-CF.

Web  Service  (en  inglés):  es  una  tecnología  que  utiliza  un  conjunto  de  protocolos  y  estándares  que
sirven para intercambiar datos entre aplicaciones. Distintas aplicaciones de software desarrolladas en
lenguajes  de  programación  diferentes  y  ejecutadas  sobre  cualquier  plataforma  pueden  utilizar  los
servicios web para intercambiar datos en redes como Internet.

1.  Introducción

El presente documento tiene como propósito principal informar acerca de las particularidades que los
contribuyentes  deben  conocer,  conforme  se  vayan  incorporando  en  el  régimen  de  emisión  de
Comprobantes Fiscales Electrónicos (e-CF).

Es decir, que este Informe Técnico permitirá a tales contribuyentes obtener las directrices necesarias
para la correcta implementación y uso de los e-CF en la República Dominicana.

2.  Actores del Sistema

En  el  sistema  de  facturación  electrónica  de  la  República  Dominicana  se  identifican  los  siguientes
actores:

•  Dirección General de Impuestos Internos (DGII): como entidad facultada para la administración
y aplicación de los tributos conforme lo establecen los artículos 32, 34 y 35 del Código Tributario
de la República Dominicana (Ley 11-92).

•  Emisor electrónico: es todo aquel contribuyente autorizado por la DGII a emitir comprobantes

o

fiscales electrónicos.

•  Receptor electrónico: es todo contribuyente que recibe comprobantes fiscales electrónicos y
que se encuentra autorizado por la DGII para emitirlos, es decir, que todo receptor electrónico es
a su vez emisor electrónico.

3.  Autenticidad del Emisor e Integridad de los e-CF

La autenticidad del emisor electrónico y la integridad de los e-CF remitidos están dados por:

•  Uso de certificados digitales para ﬁrmar digital y para la Autencación en los servicios Web la

Autencación en la OFV por medio de usuario y clave de acceso vinculados.

El emisor electrónico es responsable absoluto de su ﬁrma digital, la cual garantiza que la transacción
se haga dentro de un entorno de seguridad y confianza entre las partes que interactúan.

Estándar de Certiﬁcado Digital

Para  la  emisión  de  e-CF  en  la  República  Dominicana,  todos  los  emisores  electrónicos  deberán
disponer  de  un  certificado  digital  para  procesos  tributarios1,  acreditado  por  una  prestadora  de
servicios  de  confianza,  emitido  digitalmente,  el  cual  será  utilizado  para  validar  la  identidad del
signatario que opera en nombre del contribuyente, delegar la ﬁrma, la autenticación de los servicios

1 en lo que se aplica la normativa de INDOTEL correspondiente a estos certificados, se podrán utilizar los certificados
d e   persona física acreditado por una prestadora de servicios de confianza.

Pág. 7 de 50

web y la ﬁrma digital de archivo XML, el cual deberá cumplir con los requisitos establecidos por el
INDOTEL y las normativas relacionadas.

4.  Comunicaciones y Web Service

El formato de  cada  documento  electrónico utilizado en las comunicaciones de los  diferentes webs
services,  está  basado  en  el  lenguaje  XML,  el  cual  sigue  un  estándar  deﬁnido  “schema  XML”  con
extensión  “.xsd”.  Estos  archivos  constan  de  un  formato  específico  con  nombres  de  tags  que
conforman dichos documentos electrónicos. Los tags raíz son:

La comunicación de los archivos XML se realizarán mediante Web Service REST, para lo cual la DGII
dispondrá de los siguientes:

4.1.  Web Service – Autenticación

Servicio responsable de validar la identidad del contribuyente mediante el uso de un certificado digital
sobre un archivo base y una vez validado entregarle un token que utilizará para el consumo de  los
restantes servicios de Facturación Electrónica.

4.2. Web Service - Recepción e-CF

A través de este servicio, el emisor electrónico envía el XML del e-CF a la DGII y, esta a su vez, lo recibe
y entrega de vuelta un TrackId, con el cual el emisor podrá consultar posteriormente el estado del
documento enviado.

4.3. Web Service – Recepción RFCE

Servicio  responsable  de  recibir  un  resumen  que  contiene  las  informaciones  principales  de  un  e-CF
correspondiente a una Factura de Consumo Electrónica con un monto inferior a los RD$250,000.00,
factura la cual no es enviada a DGII pero debe ser conservado en su totalidad por el contribuyente
para futuros procesos.

4.4. Web Service - Recepción de Aprobación Comercial

Este  servicio  es  utilizado  por  el  receptor  electrónico  para  enviar  a  la  DGII  el  XML  de  Aprobación  o
Rechazo Comercial ﬁrmado, donde notifica su conformidad con el e-CF recibido.

4.5. Web Service - Consulta de Resultado de e-CF (emisores).

Mediante  este  servicio,  el  emisor  electrónico  puede  consultar  el  estado  de  un  e-CF,  utilizando  el
TrackId entregado por la DGII a través del servicio de recepción e-CF.

4.6. Web Service - Consulta de Estado de e-CF (receptores).

Servicio  que  permite  responder  acerca  de  la validez  de  un e-CF,  siendo  necesario  para  realizar  la
consulta que el usuario autenticado se encuentre delegado para el emisor o para el receptor.

A  través  de  este  servicio  también  pueden  ser  consultados  los  e-CF  remitidos  por  el  servicio  de
recepción de resumen factura de consumo inferiores a los RD$250,000.00.

4.7.  Web Service - Consulta de TrackID e-CF.

Servicio responsable de retornar la colección de números de respuesta (TrackId) de un e-NCF que haya
sido recibido por DGII y los estados de estos. Para poder realizar la consulta satisfactoriamente,  se
requiere que el usuario autenticado se encuentre delegado para el emisor, de lo contrario, no podrá
obtener los datos.

4.8.  Web Service - Consulta Directorio Facturadores

Este servicio es responsable de retornar exclusivamente en el ambiente productivo un listado de los
contribuyentes electrónicos autorizados y las URL de sus servicios de recepción de e-CF, aprobación
comercial y autenticación (Opcional). En el caso de pre-certiﬁcación, este servicio tiene por proveer
unas URL de prueba que fueron habilitadas por DGII para simular ser otro contribuyente, permitiendo
de igual forma autenticarse, recibir comprobantes y/o aprobaciones comerciales.

4.9.  Web Service - Consulta Estatus Servicios

Servicio  responsable  de  proporcionar  el  estatus  y  disponibilidad  de  los  servicios  de  facturación
electrónica, como también las ventanas de mantenimientos de estos.

4.10.  Web Service - Anulación de e-NCF

Con este servicio y utilizando el XML de anulación de e-NCF, el emisor electrónico puede anular rangos
de secuencias no utilizadas o e-CF que hayan sido ﬁrmado, pero no enviados ni al receptor electrónico
ni a la DGII.

4.11.  Web Service - Comunicación Emisor-Receptor

Servicio exclusivamente disponible en el ambiente de pre-certiﬁcación y responsable de simular ser un
emisor y/o receptor ante un contribuyente y a partir de esto permitirle probar la operatividad que
tendría en el ambiente productivo de autenticación (Opcional), recepción y emisión de comprobantes,
acuses de recibo y aprobaciones comerciales.

Para mayor detalle de la estructura y funcionamiento de estos servicios en los diferentes ambientes acceder a
la documentación sobre e-CF, Descripción Técnica de Facturación Electrónica, sección Descripción de Servicios
Web.4

4  h hhps://dgii.gov.do/cicloContribuyente/facturacion/comprobatesFiscalesElectronicosE-CF/Paginas/
documentacionSobreE-CF.aspx

Pág. 9 de 50

5.  Consultas de e-CF

La validez y estado de un e-CF puede ser consultado a través de los distintos canales disponibles por
Impuestos Internos, los cuales se detallan a continuación:

5.1. Consulta en la página web de DGII

En esta consulta el receptor electrónico puede verificar el estado de un e-CF utilizando el RNC del emisor, el RNC
del receptor, el e-NCF del documento y Código de seguridad5 (si aplica). Esta consulta presentará los siguientes
mensajes de respuesta:

-  Número  de  Comprobante  Fiscal  ingresado  no  es  correcto  o  no  corresponde  a  este  RNC:
cuando existe un error en la secuencia del e-NCF o la misma no está autorizada para dicho
RNC.

-

e-CF no encontrado: cuando la secuencia del e-NCF está autorizada pero no se encuentra un
e-CF válido asociado a los datos proporcionados.

-  NCF válido: cuando la secuencia del e-NCF se encuentra autorizada para el RNC ingresado y
existe un e-CF asociado, se mostrará uno de los siguientes estados conforme corresponda,
siendo estos6:

o  Aceptado: indica que el e-CF recibido en la DGII es válido para ﬁnes tributarios.
o  Rechazado: indica que el e-CF recibido en la DGII, de parte del emisor, no es válido

para ﬁnes tributarios.

5.2. Consultas en la Oficina Virtual (OFV)

En la oficina virtual (OFV) se encuentra habilitado un menú correspondiente a Facturacion Electronica,
en  donde  los  contribuyentes  identificados  como  ‘Emisores  Electrónicos’  pueden  realizar  consultas
relacionadas a los Comprobantes Fiscales Electrónicos (e-CF), entre otras acciones, conforme se muestra
a continuación:

  Consulta  de  Anulaciones.  Esta  opción  permite  realizar

la  búsqueda  de  Números  de

Comprobantes Fiscales Electrónicos Anulados, por rangos de fecha.

  Consulta e-NCF Emitidos.  Esta opción permite realizar la búsqueda de Números de Comprobantes
 por e-NCF o por rango de fecha; la misma contiene los siguientes

Fiscales Electrónicos
filtros de búsqueda:

  e-NCF
  RNC Receptor
  Tipo e-NCF

5 corresponde a los primeros seis (6) dígitos del hash de ﬁrma, encontrados debajo del código QR en la representación
impresa del e-CF.
6 Los estados de los e-CF serán los mismos para ambos servicios de consulta, ya sea el de envío e-CF como en el de estado e-
CF.

Pág. 10 de 50

  Estado
  Aprobación Comercial
  Fecha Emisión

  Consulta  e-NCF  Recibidos.  Esta  opción  permite  que  el  contribuyente  (en  calidad  de  receptor
electrónico) pueda realizar la búsqueda de los Números de Comprobantes Fiscales Electrónicos
Recibidos,  colocando  el  RNC  del  tercero  que  generó  el  e-NCF  y  un  rango  de  fecha  que  desee
consultar; la misma contiene los siguientes filtros de búsqueda:

  RNC Emisor
  Tipo e-NCF
  Aprobación Comercial
  Fecha Emisión: Rango de fecha Desde-Hasta

  Consulta  Directorio  Electrónico.  Esta  opción  permite  al  contribuyente  visualizar  todos  los
facturadores electrónicos con sus respectivas URL, para ﬁnes de tener comunicación entre ellos.

Esta  consulta,  además  de  mostrar  el  listado  general  de  emisores  electrónicos  autorizados,
permite al contribuyente realizar ﬁltros por RNC o por Razón Social del emisor electrónico que
desee consultar.

  Mantenimiento Directorio FE. Esta opción permite al contribuyente agregar o modificar las URL
en donde puede recibir las respuestas de Recepción, de Aprobación y de Autenticación (opcional).
Esta  última  es  opcional,  ya  que  solo  sería  utilizada  en  caso  de  que  el  emisor  requiera  que  el
receptor se autentique para poder darle acceso a sus URL.

Acontinuacion se presentan los nombres de los campo a completar en esta opcion:

  URL Recepción e-CF
  URL Aprobación Comercial
  URL Autenticación Opcional

5.3. Consultas en la App Móvil

En esta aplicación puede ser verificada la validez de un e-CF de dos maneras:

  Consulta de NCF: esta opción permite verificar o consultar un e-

 emisor,

serie del e-NCF y parte secuencial del e-NCF.7

  Validación  de  Documentos:  esta  opción  permite  la  lectura  de  códigos  QR.  En  el  caso  del
código QR correspondiente a un e-CF, la consulta se realiza a partir de los datos que posee ele
dicho e-CF.

7 también permite la consulta de comprobantes fiscales no electrónicos.

Pág. 11 de 50

Los estados resultantes en ambas consultas son:

o  Aceptado: indica que el e-CF recibido en la DGII es válido para ﬁnes tributarios.
o  Rechazado: indica que el e-CF no fue recibido en la DGII, por lo que no es válido para

ﬁnes tributarios.

No encontrado: indica que el e-CF no se encuentra recibido en la DGII.

6.  Comprobantes Fiscales Electrónicos (e-CF)

6.1.  Tipos de Comprobantes Fiscales Electrónicos (e-CF)

El Comprobante Fiscal Electrónico (e-CF) tiene igual validez y efectos legales que el comprobante fiscal
no electrónico, sin embargo, difieren de estos en que son emitidos electrónicamente, mantienen un
formato  estándar  (XML)  y  están  firmados  electrónicamente,  lo  que  ofrece  una  mayor  seguridad  e
integridad al documento.

Asimismo,  los  tipos  de  comprobantes  fiscales  electrónicos  mantienen  las  características  generales
establecidas en el Decreto 254-06, Norma 06-18 y Norma 05-2019, por lo que, son equivalentes a cada
tipo  de  comprobante  fiscal  no  electrónico;  se  distinguen  por  estar  nombrados  con  el  término
“electrónico” y estar codificados de forma distinta. Los tipos de e-CF son:

Tipo
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

e-CF

Factura de Crédito Fiscal Electrónica

Factura de Consumo Electrónica

Nota de Débito Electrónica

Nota de Crédito Electrónica

Comprobante Electrónico de Compras

Comprobante Electrónico para Gastos Menores

Comprobante Electrónico para Regímenes Especiales

Comprobante Electrónico Gubernamental

Comprobante Electrónico para Exportaciones

Comprobante Electrónico para Pagos al Exterior

Factura de Crédito Fiscal Electrónica: Aquellos comprobantes fiscales electrónicos que registran las
transacciones comerciales de compra y venta de bienes y/o servicios, y permiten al receptor o usuario
que lo solicite, sustentar gastos y costos o crédito fiscal para efecto tributario.

Factura  de  Consumo  Electrónica  8:  Aquellos  comprobantes  fiscales  electrónicos  que  acreditan  la
transferencia de bienes, la entrega en uso o la prestación de servicios a consumidores finales.

Nota de Débito Electrónica: Aquellos comprobantes electrónicos que emiten vendedores de bienes
y/o prestadores de servicios para recuperar costos y gastos, tales como intereses por mora, fletes u
otros, incurridos por el vendedor con posterioridad a la emisión de comprobantes fiscales.

Nota  de  Crédito  Electrónica:  Aquellos  comprobantes  electrónicos  que  emiten  los  vendedores  de
bienes  y/o  prestadores  de  servicios  por  modificaciones  posteriores  en  las  condiciones  de  venta

Pág. 12 de 50

originalmente  pactadas,  es  decir,  para  anular  operaciones,  efectuar  devoluciones,  conceder
descuentos y bonificaciones, subsanar errores o casos similares.

Comprobante Electrónico de Compras: Aquellos comprobantes fiscales electrónicos emitidos por las
personas  físicas  y  jurídicas  cuando  adquieran  bienes  o  servicios  de  personas  no  registradas  como
contribuyentes.

Comprobante Electrónico para Gastos Menores: Aquellos comprobantes electrónicos emitidos por
las personas físicas o jurídicas para sustentar pagos realizados por su personal, sean éstos efectuados
en territorio dominicano o en el extranjero y en ocasión a las actividades relacionadas al trabajo, tales
como: consumibles, pasajes y transporte público, tarifas de estacionamiento y peajes.

Comprobante Electrónico para Regímenes Especiales: Aquellos comprobantes fiscales electrónicos
utilizados para facturar las transferencias de bienes o prestación de servicios exentos del ITBIS y/o ISC
a  las  personas  físicas  o  jurídicas  acogidas  a  regímenes  especiales  de  tributación  mediante  leyes
especiales, contratos o convenios debidamente ratificados por el Congreso Nacional.

Comprobante  Electrónico  Gubernamental:  Aquellos  comprobantes  fiscales  electrónicos  utilizados
para  facturar  la  venta  de  bienes  o  la  prestación  de  servicios  al  Gobierno  Central,  Instituciones
Descentralizadas  y  Autónomas,
la  Seguridad  Social  y  cualquier  entidad
gubernamental que no realice una actividad comercial.

Instituciones  de

Comprobante Electrónico para Exportaciones: Aquellos comprobantes fiscales electrónicos utilizados
para reportar ventas de bienes fuera del territorio nacional utilizados por los exportadores nacionales,
empresas de zonas francas y Zonas Francas Comerciales.

Comprobante  Electrónico  para  Pagos  al  Exterior:  Aquellos  comprobantes  fiscales  electrónicos
emitidos por concepto de pago de rentas gravadas de fuente dominicana a personas físicas o jurídicas
no  residentes  fiscales  obligadas  a  realizar  la  retención  total  del  Impuesto  sobre  la  Renta,  de
conformidad a los artículos 297 y 305 del Código Tributario.

8 durante el piloto, solo se utilizará este tipo de comprobante en operaciones de facturación masiva o  por lote (no retail)
después de que se prueben los demás tipos de comprobantes.

Pág. 13 de 50

7.  Estructura,  Formato  y  Vencimiento  de  los  Números  Comprobantes

Fiscales Electrónicos (e-NCF)

La secuencia del comprobante fiscal electrónico dispone de una estructura de trece (13) posiciones
alfanuméricas.

La letra E corresponde a la serie del e-CF, los dos dígitos siguientes identifican el tipo de e-CF y los
últimos diez corresponden al secuencial. Dicha secuencia estará vigente desde la fecha de autorización
hasta el 31 de diciembre del año siguiente y no podrá ser usada posterior a su vencimiento.

8.  Modelo de Operación

Los  e-CF  son  emitidos  de  forma  unitaria,  en  un  formato  estándar  XML  especificado  por  la  DGII y
transmitidos mediante una plataforma de servicio web, requiriendo el uso de certificado digital.

Figura I. Modelo Emisor-Receptor Electrónicos

1-4

Pasos obligatorios

5-6

Pasos opcionales

Pág. 14 de 50

El modelo funciona de la siguiente manera:

1)  El emisor electrónico envía el e-CF a la DGII al momento de la emisión del documento.

2)  La DGII responde entregando un TrackID, que el emisor del e-CF puede utilizar para

consultar el estado del documento, a través del servicio web habilitado para estos fines9.

3)  Luego el emisor electrónico envía el e-CF al receptor electrónico.

4)  El receptor electrónico debe acusar recibo del e-CF al emisor electrónico.

5)  El  receptor  electrónico  podrá  dar  respuesta  de  su  conformidad,  al  emisor  electrónico,

mediante la Aprobación o Rechazo Comercial10.

6)  En caso de que el receptor envíe la Aprobación o Rechazo Comercial al emisor, notificará de

su repuesta a DGII.

El e-CF será validado por la DGII, entregando al emisor mediante el web service de envío de e-CF uno
de los siguientes estados: “e-CF aceptado”, “e-CF aceptado condicional”, “e-CF rechazado” o “e-CF en
proceso”11.

Figura II. Modelo Emisor Electrónico - Receptor No Electrónico

9 Web Service de Consulta de Resultado de e-CF.
10 Solo se recibirán aprobaciones comerciales de e-CF previamente aceptadas por la DGII.
11 Ver descripción de los estados en la sección 4 para el Web Service de Consulta de Envío e-CF.

1-3

Pasos obligatorios

Pág. 15 de 50

Cuando el emisor es electrónico pero el receptor no lo es - ver figura II-, el modelo funciona de la
siguiente manera:

1)  El emisor envía el e-CF a la DGII, al momento de la emisión del documento.

2)  La  DGII  responde  entregando  un  TrackID,  que  el  emisor  del  e-CF  puede  utilizar  para
consultar el estado del documento, a través del servicio web habilitado para estos fines.

3)  Luego, el emisor electrónico entrega una representación impresa (RI) del e-CF al receptor

no electrónico.

El receptor deberá consultar la validez del documento en la consulta disponible en la página web de
la DGII y proceder a reportar la compra en el Formato de Envío de Costos y Gastos (Formato 606), de
conformidad con lo establecido en la Norma General Núm. 07-18 sobre Remisión de Informaciones y
modificaciones que le sucedan.

9. Factura de Consumo Electrónica menor a DOP$250 mil

9.1. Modelo de operación

Para la emisión de la factura de consumo electrónica menor a DOP$250 mil se deberá cumplir con las
especificaciones del Formato del Comprobante Fiscal Electrónico (e-CF)12.

Figura III. Modelo emisión Factura de Consumo Electrónica menor a DOP$250 mil.

Pág. 16 de 50

El modelo funciona de la siguiente manera:

1)  Una vez emitida la factura de consumo electrónica menor a DOP$250 mil, el emisor deberá
guardar en su base de datos dicha factura y remitir a Impuestos Internos un resumen de la
factura de consumo electrónica13, el cual debe cumplir con el formato de resumen establecido.

2)  Impuestos Internos retorna la respuesta de la validación del formato de resumen de consumo

electrónica remitido, con uno de los siguientes estados:

• Aceptado: indica que el formato de resumen de factura de consumo electrónica cumple con

las especificaciones establecidas, por lo que es recibido por la DGII.

• Rechazado:  significa  que  el  formato  de  resumen  de  factura  de  consumo  electrónica  no
cumple con las especificaciones establecidas, lo que implica que el archivo no es recibido por
la DGII.  Ante este estado, el  emisor deberá corregir y remitir nuevamente el resumen  de
factura de consumo electrónica a Impuestos Internos.

• Aceptado  Condicional:  con  esta  repuesta  la  DGII  indica  que  el  formato  de  resumen  de
factura  de  consumo  electrónica  es  aceptado,  sin  embargo  existe  irregularidad  que  no
amerita el rechazo, pero debe ser observada y corregida para futuras remisiones.

3)  Posteriormente, entrega al receptor no electrónico una Representación Impresa de la factura

de consumo electrónica menor a DOP$250 mil.

El  emisor  deberá  almacenar  y  conservar  en  forma  electrónica  la  factura  de  consumo  emitida  al
receptor no electrónico, por un período de diez (10) años14, adicional, deberá poner a disposición de
este para fines de consulta.

10. Correcciones y Anulación de un e-CF

Las correcciones de un e-CF serán realizadas únicamente mediante el uso de notas de crédito o débito
electrónicas, según corresponda. Si la nota de crédito electrónica es emitida con posterioridad a los
treinta  (30)  días,  contados  a  partir  del  nacimiento  de  la  obligación  tributaria,  las  devoluciones  de
bienes gravados con el ITBIS podrán conllevar únicamente la restitución del precio pagado, sin incluir
la devolución del ITBIS, tal como lo establecen los Arts. 8 y 28 del Reglamento 293-11.

En los casos en que la factura haya sido emitida (firmada digitalmente) y aún no haya sido enviada a
la  DGII  o  al  receptor,  el  e-CF  puede  ser  anulado  mediante  el  Web  Service  de  Anulación  de  e-NCF
utilizando el formato XML de Anulación de e-NCF (ANECF)15. También pueden ser anulados a través
de este servicio, aquellos documentos el electrónicos que aún no han sido firmados, con la finalidad
de anular secuencias no usadas.

12 ver Formato de Comprobante Fiscal Electrónico.
13 las especificaciones que debe contener el resumen de la factura de consumo electrónica están establecidas en el documento ‘Formato
de Resumen de Factura Electrónica menores a DOP$250 mil’.

Pág. 17 de 50

Si el e-CF es rechazado por el receptor en la Aprobación Comercial, el emisor electrónico deberá anular
la factura enviando una nota de crédito tanto a Impuestos Internos como el receptor, indicando el
motivo de la anulación. En tanto, que si el e-CF es aprobado por el receptor en la Aprobación Comercial
pero  rechazado  por  la  DGII,  el  e-CF  no  se  considerará  válido  (ni  tampoco  lo  será  la  Aprobación
Comercial, la  cual también  será  rechazada) y el emisor deberá realizar un nuevo e-CF y sustituir  el
entregado al receptor.

11. Formato XML del e-CF

11.1.  Contenido del e-CF

El e-CF debe contener las especificaciones establecidas en el siguiente recuadro16:

Requisito

Obligatorio

e-CF

Todos

Sección

Descripción

A. Encabezado

a

la
Corresponde
identificación del e-CF, donde
están contenidos los datos del
receptor  y  datos
emisor,
sección
tributarios.
contiene
áreas
Identificación del Documento,
 Receptor,
Emisor,
Informaciones
Adicionales,
Transporte,  Totales  y  Otra
Moneda.

La
las

B. Detalle de bienes o
Servicios

Corresponde al detalle de los
bienes o servicios.

Obligatorio

Todos

C. Subtotales
Informativos

D. Descuentos o
Recargos

al
Los

subtotal
Corresponde
informativo.
campos
contenidos en esta sección no
campos
los
modifican
totalizadores,  ni  aumentan  o
disminuyen
la  base  del
impuesto.

Esta  sección  se  utiliza  para
especificar
o
recargos globales que afectan
al total del e-CF.

descuentos

Opcional

Todos

Condicional

Todos

Pág. 18 de 50

E. Paginación

En  esta  sección  se  indica  la
cantidad  de  páginas  del  e-CF
en la Representación Impresa
y cuales ítems estarán en cada
una.

Opcional

Todos

F. Información de
Referencia

En  esta  sección  se  deben
detallar los e-CF modificados o
reemplazados con e-CF.

Obligatorio y
condicional.

H. Fecha y Hora de la
firma digital.

Indica  la  fecha  y  hora  de  la
firma digital.

Obligatorio

Obligatorio solo
para Notas de
Crédito y Débito
Electrónica
cuando modifica
un documento en
papel o uno
electrónico. Es
condicional para
el resto de los e-
CF, cuando se
trate de una
sustitución de un
NCF por un e-CF
(casos de
contingencia).

Todos

I. Firma Digital

Corresponde a la firma digital
información
sobre  toda
la
contenida  en
las  secciones
anteriores,  para  garantizar  la
integridad del e-CF.

Obligatorio

Todos

14 según lo establecido en el Artículo 50, literal h del Código Tributario (Ley 11-92).
15 los detalles del Formato de Anulación de Secuencias de e-NCF están incluidos en el Anexo
16 El detalle se encuentra en el documento ‘Formato de e-CF’.

Pág. 19 de 50

11.1.1. Detalle por sección

El contenido de cada sección contendrá el formato y sus códigos de obligatoriedad según el
tipo de e-CF17, siendo estos los siguientes:

•  0: No corresponde. Significa que el dato no debe ir en un determinado documento.

•  1: Dato obligatorio. El dato siempre debe estar en el documento, independiente de

las características de la transacción.

•  2: Dato condicional. El dato no es obligatorio en todos los documentos, pero puede

serlo en determinadas operaciones si se cumple una determinada condición.
Ejemplo: Si existen descuentos recargos que afectan el total del e-CF, se debe incluir
la sección Descuentos o Recargos, de lo contrario se descuadrará el monto total.

•  3: Opcional. El dato es opcional.

11.1.2. Instrucciones de Formato para las Secciones18

•

Los valores de montos deben ser completados en pesos dominicanos (DOP), excepto
los campos correspondientes a otra moneda.

•  En los datos tipo numérico, los decimales se separan con punto.

•  En los datos tipo numérico, no se separan los miles.

•  En la información ‘ALFANUM’, los siguientes caracteres no deben emplearse dentro del
XML,  ya  que  tienen  un  significado  por  sí  solos  y  deberán  ser  remplazados  por
definiciones estándar especificadas a continuación para dichos caracteres:

Nombre

Carácter

Referencia Decimal  Referencia Hexadecimal

quot
amp
apos
It
gt

“ ”
&
‘
<
>

&#34;
&#38;
&#39;
&#60;
&#62;

&#x22;
&#x26;
&#x27;
&#x3C;
&#x3E;

17 incluidos en el ‘Formato de e-CF’.
18 instrucciones aplican para el resto de los formatos XML.

Pág. 20 de 50

12. Regla de tolerancia. Cuadratura.

Dado  que  en  toda  transacción  comercial  es  necesario  procurar  que  concuerden  los  valores  de  lo
facturado y lo pagado, para fines del formato XML del e-CF, se ha definido como cuadratura, la acción
o efecto que procura que coincidan los valores en los balances totales.

En este sentido, para facilitar el cuadre de dichos balances en el formato XML, se admite como regla
de tolerancia para cada línea de la sección Detalle de Bienes o Servicios, una diferencia de ± 1 unidad
del valor del precio por la cantidad de ítems en cada línea de esta sección. A su vez, se define una
tolerancia global sobre el monto total del e-CF, que será equivalente al total de líneas de la sección de
Detalle de Bienes o Servicios.

Esto implica que, tanto los montos por la línea de la sección de Detalle, como los contemplados en el
Encabezado, deberán coincidir o aproximarse a los resultados sujetos a la regla de tolerancia indicada.
Si la diferencia de los montos supera la tolerancia, el e-CF será aceptado condicional.

Ejemplos:

1) Tolerancia línea por la línea de la sección Detalle de Bienes o Servicios.

  Sección de Detalle e-CF

Línea

Cantidad

Unidad
de
Medida

Nombre ítem

Precio

Monto ítem
según emisor
e-CF
(Cant. *
Precio)

Monto ítem
según formato
e-CF

Dif. por
línea
según e-
CF

1

2

3

5.50

10.25

2.00

Caj

Caj

Caj

Lápiz

Cuaderno

Borrador

100.33

555.44

333.25

552.80

5694.00

667.50

551.82

5693.26

666.50

0.99

0.74

1.00

La diferencia se encuentra dentro de la tolerancia aceptada por la línea de detalle.

  Sección de Encabezado e-CF

Monto total según cálculo
emisor e-CF

Monto total según
formato e-CF

Dif. global según
Formato e-CF

Monto Total (3 líneas de ítem según
la sección de Detalle)

6914.30

6911.58

2.72

La diferencia se encuentra dentro de la tolerancia global aceptada para el e-CF.

Pág. 21 de 50

13. Regla de Redondeo

La regla del redondeo es la base para establecer las reglas de tolerancia en la cuadratura, pues esta
establece que los campos de valores numéricos permitan hasta dos (2) cifras de dígitos decimales19,
las cuales podrán ser redondeadas de la siguiente manera:

El tercer decimal debe redondear al segundo decimal, dejando así fijo las cifras con dos decimales.
Cuando el valor numérico del tercer decimal sea menor que 5, se debe mantener el valor del segundo
decimal, mientras que, si es igual o mayor a 5, se debe incrementar el segundo decimal en una unidad.

-

-

Ejemplo 1: Tercer
decimal < 5.

Ejemplo 2: Tercer
decimal >= 5.

-

750.5212≈ 750.52

-

750.5276  750.53

14. Impuesto Selectivo al Consumo (ISC) de Alcoholes y Cigarrillos.

Para  el cálculo  del  Impuesto  Selectivo  al  Consumo  (ISC)  de  Ítems,  que  correspondan  a  alcoholes  y
cigarrillos, se deberá colocar en la sección de Detalle de Bienes y Servicio el código, atendiendo al tipo
de  impuesto  adicional  especificado  en  la  tabla  de  Codificación  Tipos  de  Impuestos  Adicionales
(incluido en el Formato de e-CF) y posterior proceder a realizar el cálculo según las especificaciones
del área totales de la sección Encabezado.

Ejemplo:

Facturación

CANTIDAD

CÓDIGO INTERNO

DESCRIPCIÓN

PRECIO

PVP

1 Caja

B000783

RON 16/700 ML

1063.97

80.00

⇒  ISC Alcoholes (Tasa específico)

Para el  cálculo del impuesto selectivo al consumo específico para los alcoholes, se debe tomar en
cuenta los siguientes campos del formato de e-CF:

<MontoImpuestoSelectivoEspecifico>
<CantidadReferencia> x <Subcantidad> x <CantidadItem>

=

<TasaImpuestoAdicional>

x

<GradosAlcohol>

x

19 Se exceptúan de esta regla los campos ‘Precio Unitario Ítem’ y ‘Precio Unitario Ítem Otra Moneda’ de la sección Detalle de
Bienes o Servicios, donde se permiten cifras con hasta cuatro (4) dígitos decimales, incluyendo el campo ‘Tipo de Cambio’ de
la  sección  Encabezado  (como  lo  establece  el  Banco  Central)  y  el  campo  ‘Subcantidad’  de  la  sección  Detalle  de  Bienes  o
Servicios, donde se permiten cifras con hasta tres (3) dígitos decimales.

Pág. 22 de 50

Ejemplo:

Campos de la sección Detalle de Bienes o Servicios:

TasaImpuestoAdicional = 617.93

GradosAlcohol = 4.30 %

CantidadReferencia = 16

Subcantidad = 0.65

<CantidadItem> = 1

Monto Impuesto Selectivo Específico = 617.93 x 4.30% x 16 x 0.65 x 1 = 276.3420

⇒  ISC Alcoholes (Tasa Ad-Valorem)

Para el cálculo del impuesto selectivo al consumo Ad-Valorem para los alcoholes se debe tomar en
cuenta los siguientes:

Si el código del impuesto se encuentra entre 023-035, se debe verificar la unidad de medida del ítem,
si es a granel (código 18), el cálculo del Impuesto Selectivo Ad-Valorem se realiza incrementando en
un treinta por ciento (30%) el precio unitario del ítem (equivalente al precio de lista) por la cantidad
ítem por la tasa del impuesto correspondiente, es decir:
<MontoImpuestoSelectivoAdValorem>  =  (<PrecioUnitarioItem>  x  (1  +  30%)  x  tasa  impuesto
AdValorem) x Cantidad Ítem.

Ejemplo:

<CantidadItem>= 2

<PrecioUnitarioItem>= 10163.97

<UnidadMedida>= 18 (Granel)

<MontoImpuestoSelectivoAdValorem> = (10163.97 x 1.30 x 0.10) x 2 = 2,642.63

Si el código del impuesto se encuentra entre 023-035 y la unidad de medida es distinta de granel, entonces se
debe realizar los siguientes cálculos:

MontoImpuestoSelectivoAdvalorem  =  {(<PrecioUnitarioReferencia>  /  (1  +
ITBIS  tasa  1))  –
(MontoImpuestoSelectivoEspecifico/(<CantidadItem> x  <CantidadReferencia>)) /  (1+  tasa  impuesto
adicional  especificado)}  x  <CantidadItem>  x  <CantidadReferencia>  x  tasa  impuesto  adicional
especificado.21

20 esta operación se debe realizar por cada ítem que contenga códigos 006 al 018.

21  esta operación se debe realizar por cada ítem que contenga códigos 023 al 035 y la unidad de medida sea distinta a la de
granel.

Pág. 23 de 50

Primero:  se  debe  excluir  el  ITBIS  al  precio  unitario  de  referencia,  dividiendo  el  precio  unitario  de
referencia entre (1+ la tasa del ITBIS tasa1).

Ejemplo:

([(80/1.18)] = 67.8022

Segundo:  se  le  debe  restar  al  precio  unitario  referencia  sin  ITBIS  (resultado  anterior),  el  Impuesto
Selectivo Específico Unitario23:

Cálculo Impuesto Selectivo Especifico Unitario = [(276.34/ (16 x 1)]=17.27

El resultado será igual a 67.80 - 17.27 = 50.5324

Tercero:  se  divide  el  precio  unitario  de  referencia  sin  ITBIS  e  ISC  específico  entre  (1  +  la  tasa  del
Impuesto Selectivo Ad-Valorem), que corresponda al código ítem especificado en el formato de e-CF.

Ejemplo:

50.53 / (1.10) = 45.9425

Cuarto:  al  precio  sin  impuestos  se  le  debe  calcular  el  ISC  Ad-Valorem  multiplicándolo  por  la  tasa
correspondiente al ISC Ad-Valorem.

Ejemplo:

45.94 x 0.10 = 4.5926

Quinto: una vez se tiene el valor del ISC Ad-Valorem por unidad, se debe calcular para el total de ítems
correspondientes en la factura; a este resultado se le multiplica el ISC Ad-Valorem por unidad, por la
cantidad referencia y la cantidad de ítems.

Ejemplo:

Monto Impuesto Selectivo al Consumo Ad-Valorem = 4.59 x 16 x 1= 73.4927

22 corresponde al precio unitario referencia sin ITBIS.
23 para el cálculo del Impuesto Selectivo Especifico Unitario se debe dividir el Monto Impuesto Selectivo Específico entre el

resultado de multiplicar la cantidad de referencia y la cantidad de ítem.

24 resultado correspondiente al precio unitario referencia sin ITBIS y sin ISC específico.
25 corresponde al precio unitario de referencia sin ITBIS, sin ISC especifico y sin ISC Ad-Valorem, es decir, sin ningún tipo de

impuesto.

26 ISC Ad-Valorem por unidad (para el precio unitario de referencia).
27 total ISC Ad-Valorem definido en el área de totales.

Pág. 24 de 50

⇒  ISC Cigarrillo (Tasa específico)

Para el cálculo del impuesto selectivo al consumo específico para los cigarrillos, se debe tomar en
cuenta los siguientes campos:

Se debe calcular multiplicando la cantidad Ítem por la cantidad de referencia, por la tasa del impuesto
adicional indicado.

Ejemplo:

Facturación

CANTIDAD

CÓDIGO INTERNO

DESCRIPCIÓN

PRECIO

PVP

1 paquete

XLO1254

MALBORO 20/10

1450.00

200.00

Campos de la sección Detalle de Bienes o Servicios

<MontoImpuestoSelectivoConsumoEspecifico>
<TasaImpuestoAdicional>

=  <CantidadItem>  x  <CantidadReferencia>  x

1 x 20 x 25.86 = 517.20 (Esto es el Monto Impuesto Selectivo Específico).28

⇒  ISC Cigarrillo (Tasa Ad-Valorem)

Para  el  cálculo  del  impuesto  selectivo  al  consumo  Ad-Valorem  para  cigarrillos,  se  debe  tomar  en
cuenta lo siguiente:

Si  el código  del impuesto se  encuentra  entre  036-039,  entonces se  deben  realizar  los  siguientes
cálculos:
MontoImpuestoSelectivoAdValorem  =  {(<  PrecioUnitarioReferencia>  /  (1  +  ITBIS  tasa  1))
– (<TasaImpuestoAdicional>) / (1+ tasa impuesto adicional especificado)} x  <CantidadItem> x
<CantidadReferencia> x tasa impuesto adicional especificado.29

Primero:  se  debe  excluir  el  ITBIS  al  precio  unitario  de  referencia,  dividiendo  el  precio  unitario  de
referencia entre (1 + la tasa del ITBIS tasa1).

Ejemplo:

[(200/1.18)]= 169.4930

Segundo:  se  le  debe  restar  al  precio  unitario  referencia  sin  ITBIS  (resultado  anterior),  la  tasa
del Impuesto Selectivo Específico.

28 esta operación se debe realizar por cada ítem que contenga códigos 019 al 022.
29 esta operación se debe realizar por cada ítem que contenga códigos 036 al 039.
30 corresponde al precio unitario referencia sin ITBIS.

Pág. 25 de 50

Ejemplo:

169.49 - 25.86= 143.6331

Tercero:  se  divide  el  precio unitario  referencia  sin ITBIS e ISC específico, entre  (1  + la tasa del
Impuesto Selectivo Ad-Valorem) que corresponda al código ítem especificado en el formato de e-
CF.

Ejemplo:

143.63 / (1.20) = 119.6932

Cuarto: el precio sin impuestos se le debe calcular el ISC Ad-Valorem multiplicándolo por la tasa
correspondiente al ISC Ad-Valorem.

Ejemplo:

119.69 x 0.20 = 23.9433

Quinto: una vez se tiene el valor del ISC Ad-Valorem por unidad, se debe calcular para el total de
ítems correspondientes en la factura; para eso se multiplica el ISC Ad-Valorem por unidad por la
cantidad referencia y la cantidad de ítems.

Ejemplo:

Monto Impuesto Selectivo al Consumo Ad-Valorem = 23.94 x 20 x 1 = 478.77

⇒  Otra Moneda

Para el cálculo en Otra moneda se deberá realizar primero el cálculo en DOP, y luego referenciar al
tipo de cambio del código Otra Moneda.

<MontoImpuestoSelectivoConsumoEspecificoOtraMoneda>=
<MontoImpuestoSelectivoConsumoEspecifico>/<TasaImpuestoAdicionalOtraMoneda.

<MontoImpuestoSelectivoConsumoAdvaloremOtraMoneda>=
<MontoImpuestoSelectivoConsumoAdavalorem>/<TasaImpuestoAdicionalOtraMoneda.

31 este es el precio unitario referencia sin ITBIS e ISC específico incluidos.
32 corresponde al precio unitario de referencia sin ITBIS, sin ISC especifico y sin ISC Ad-Valorem, es decir, sin ningún tipo de
impuesto.
33 ISC Ad-Valorem por unidad (para el precio unitario referencia).

Pág. 26 de 50

15. Otros impuestos adicionales

los

Para  calcular
las
Telecomunicaciones  (CDT),  Servicios  Seguros  en  general,  Servicios  de  Telecomunicaciones  y
Expedición de la primera placa)34, se multiplican los siguientes campos para cada caso:

impuestos  adicionales:  Propina  Legal,  Contribución  al  Desarrollo  de

 Si  el

campo  <IndicadorMontoGravado>

es

igual  a  0,  entonces  <MontoItem>

x

<TasaImpuestoAdicional> para el código correspondiente al código del impuesto adicional.

Ejemplo:

CDT

<IndicadorMontoGravado>=  0

<MontoItem>=500

<TasaImpuestoAdicional>=  2%

<OtrosImpuestosAdicionales>= 500 x 0.02= 10.00

 Si  el  campo  <IndicadorMontoGravado>  es  igual  a  1,  entonces  <OtrosImpuestosAdicionales>  =

<MontoItem>/ (1+ ITBIS tasa 1) x tasa correspondiente al código de impuesto adicional.

Ejemplo:

CDT

<IndicadorMontoGravado> = 1

<MontoItem> = 500

<TasaImpuestoAdicional> = 2%

<OtrosImpuestosAdicionales>= (500/1.18) x 0.02 = 8.47

En el caso de los impuestos adicionales Contribución al Desarrollo de las Telecomunicaciones (CDT)
y Servicios Telecomunicaciones:

Si el campo <IndicadorNorma1007>35 de la sección Descuentos o Recargos es igual a 1, se debe dividir
la suma de los valores del monto ítem con indicador de facturación=1, entre (1 + tasa ITBIS tasa 1 +
tasa del código de impuesto adicional 002 + tasa del código de impuesto adicional 004), para luego
multiplicar este resultado por la tasa correspondiente al código de impuesto adicional.

34 estos tipos de impuestos adicionales no forman parte de la base imponible del ITBIS.
35 el campo ‘Indicador Norma 10-07’ es completado cuando el descuento que se aplica es según lo establecido a la Norma
General 10-07.

Pág. 27 de 50

Ejemplo:

CDT

<IndicadorMontoGravado>=  1

<MontoItem>=500

<TasaImpuestoAdicional>=  2%

<IndicadorNorma1007>= 1

<OtrosImpuestosAdicionales>= (500/1 + 0.18 + 0.02 + 0.10) x 0.02= 7.69

 Si existe descuento global se debe multiplicar el porcentaje del monto ítem por línea36 por el Monto
Descuento (global), esto dará como resultado el monto de descuento aplicable para cada línea de
detalle.

Ejemplo:

<IndicadorMontoGravado>=  0

<MontoDescuento>=100

Sección de Detalle de Bienes y Servicios

Cálculo a)

Cálculo b)

No.
Línea

Cantidad
ítem

Indicador
facturación

Descripción
ítem

Precio
unitario
ítem

Código
Impuesto
Adicional

Monto
ítem

1

2

3

Total

1

1

1

18%

18%

18%

XXXXXXX

XXXXXXX

XXXXXXX

200.00

300.00
130.00

002

002

200.00

300.00

130.00
630.00

Porcentaje
del monto
ítem respecto
al
monto total

31.75%

47.62%

20.63%

Monto
descuento
aplicable

31.75

47.62

20.63

Primero, se debe dividir el valor colocado en el Monto ítem de cada línea de la sección de Detalles de
Bienes o Servicios entre la sumatoria de los montos ítems37:

a)  Línea 1: 200/630 x 100 = 31.75%

Línea 2: 300/630 x 100 = 47.62%

Línea 3: 130/630 x 100 = 20.63%

b)  31.75% x 100 (descuento global) = 31.75 (Monto descuento aplicable línea 1)

47.62% x 100 (descuento global) = 47.62 (Monto descuento aplicable línea 2)

20.63% x 100 (descuento global) = 20.63 (Monto descuento aplicable línea 3)

Posteriormente,  se  debe  tomar  la  sumatoria  de  los montos  ítems  asignados  al  código  y  restar  los
montos de descuentos aplicables al código indicado, para luego multiplicar este resultado por la tasa

36 resultado de dividir el valor colocado en el campo ‘Monto Ítem’ de cada línea de la sección de Detalle de Bienes o
Servicios entre la sumatoria de los montos ítems.
37 esta operación se debe realizar para cada ítem.

Pág. 28 de 50

del código de impuesto adicional, es decir: (∑montos ítems - ∑montos descuentos aplicable) x Tasa
Código del Impuesto Adicional.

Ejemplo:

<OtrosImpuestosAdicionales> = 500.00 – 79.37 x 0.02 = 8.41

 Si el campo ‘Indicador Norma 10-07’38 de la sección Descuentos o Recargos es completado, el monto

de descuento correspondiente no se deberá considerar.

Ejemplo:

<IndicadorMontoGravado>=  1

<MontoItem>=500

<MontoDescuento>=100

<IndicadorNorma1007>= 1

<OtrosImpuestosAdicionales> = (500/1 + 0.18 + 0.02 + 0.10) x 0.02= 7.6939

 Si existe recargo global se debe multiplicar el  porcentaje del monto ítem por línea  por el Monto
Recargo (global), esto dará como resultado el monto de recargo aplicable para cada línea de detalle.

Ejemplo:

<IndicadorMontoGravado>=  0

<MontoRecargo>=100

Sección de Detalle de Bienes y Servicios

No.
Línea

Cantidad
ítem

Indicador
facturación

Descripción
ítem

Precio
unitario
ítem

Código
Impuesto
Adicional

Monto
ítem

Cálculo a)

Cálculo b)

Porcentaje del
monto ítem
respecto al
monto total

Monto
recargo
aplicable

1

2

3

Total

1

1

1

18%

18%

18%

XXXXXXX

XXXXXXX

XXXXXXX

200.00

300.00
130.00

002

002

200.00

300.00

130.00
630.00

31.75%

47.62%

20.63%

31.75

47.62

20.63

Primero, se debe dividir el valor colocado en el Monto ítem de cada línea de la sección de Detalles de
Bienes o Servicios entre la sumatoria de los montos ítems40:

a)  Línea 1: 200/630 x 100 = 31.75%

Línea 2: 300/630 x 100 = 47.62%

38 si es completado el campo Indicador Norma 10-07 en la sección de descuentos o recargos, el Indicador Monto Gravado
siempre deberá ser igual a 1.
39 no aplica el descuento cuando el Indicador Norma 10-07 está completado.
40 esta operación se debe realizar por cada ítem que contenga códigos 001.

Pág. 29 de 50

Línea 3: 130/630 x 100 = 20.63%

b)  31.75% x 100 (descuento global) = 31.75 (Monto recargo aplicable línea 1)

47.62% x 100 (descuento global) = 47.62 (Monto recargo aplicable línea 2)

20.63% x 100 (descuento global) = 20.63 (Monto recargo aplicable línea 3)

 Posteriormente, se debe tomar la sumatoria de los montos ítems asignados a los códigos y sumar los
montos de recargos aplicables al código indicado, para luego multiplicar este resultado por la tasa
del código  de  impuesto  adicional, es  decir: (∑montos ítems  + ∑montos recargos aplicable) x Tasa
Código del Impuesto Adicional.

Ejemplo:

<OtrosImpuestosAdicionales> = 500.00 + 79.37 x 0.02 = 11.59

16. Tratamiento para e-CF con aplicación de la Norma General 07-07

Para la elaboración de  un e-CF que  registre operaciones  en donde  corresponda la aplicación de  la
Norma General No. 07-07, se deben tomar en cuenta las siguientes especificaciones:

⇒  La operación debe dividirse en dos ítems:

a)  Un ítem correspondiente a la parte exenta (90% del valor).
b)  El otro ítem para la parte gravada (10% del valor).

Ejemplo:

<IndicadorMontoGravado>=  0

Monto Ítem= 300,000.00

90% del Monto Ítem = 300,000.00 x 90% = 270,000.00

10% del Monto Ítem = 300,000.00 x 10% = 30,000.00

Sección de Detalle de Bienes y Servicios

No.
Línea

Cantidad
ítem

1

2

Total

1

1

Indicador
facturación
E

18%

Descripción ítem

Precio
unitario ítem

Monto ítem

ITBIS

Total

XXXXXXX

XXXXXXX

270000.00

270000.00

-  270000.00

30000.00

30000.00

5400.00

35400.00

300000.00

5400.00  305400.00

Pág. 30 de 50

17. Tratamiento de los bonos o certificados de regalo en el marco de la

facturación electrónica conforme a la Norma General 03-08

Para  la  elaboración  de  un  e-CF  que  registre  bonos  o  certificados  de  regalo,  en  el  marco  de  la
Facturación Electrónica conforme a la Norma General 03-08, se deben tomar en cuenta las siguientes
especificaciones:

1.  Al momento de la emisión o venta del bono o certificado de regalo, el comprobante fiscal
electrónico  deberá  generarse  utilizando  el  indicador  de  facturación  “No  facturable”,  en
atención a que esta operación no corresponde a la transferencia de bienes ni a la prestación
de servicios en ese instante.

2.  A efectos de asegurar la correcta identificación y trazabilidad de la operación, en el detalle
del  comprobante  (ítem)  se  deberá  consignar  una  descripción  que  permita  reconocer  la
naturaleza de la transacción, tales como: “Bono de regalo” o “Certificado de regalo”.

3.  Posteriormente, al momento de la redención del bono o certificado de regalo, se deberá
emitir  el  comprobante  fiscal  electrónico  correspondiente  a  la  operación  efectivamente
realizada (tipo E32), registrando los bienes o servicios suministrados, así como los impuestos
aplicables conforme a la normativa vigente.

En este mismo documento, el bono o certificado de regalo deberá reflejarse como medio de pago, ya
sea de forma total o parcial, según corresponda.

18. Representación Impresa (RI) del e-CF

Existen  especificaciones  mínimas,  con  carácter  de  obligatoriedad,  que  deben  presentarse  en  una
Representación Impresa (RI) de e-CF, así como un orden y lugar específico donde debe ser colocadas
las informaciones relativas al tipo de comprobante fiscal a la que corresponda. Cabe destacar, que si
la RI corresponde a un e-CF que no ha sido recibido por la DGII o se encuentre en estado de rechazado,
la misma no podrá ser usada para fines de sustentar crédito fiscal.

Las informaciones de un e-CF, deben estar contenidas dentro de la RI a imprimir y con un máximo  de
mil  líneas  (1,000)  a  ser  incluidas  en  la  sección  de  Detalle  de  Bienes  o  Servicios,  exceptuando  las
Facturas de Consumo Electrónicas menor a DOP$250 mil, las cuales tienen un tope de máximo de
diez mil (10,000) líneas.

La Representación Impresa (RI) podrá imprimirse en varias páginas en caso de ser requerido, siempre
que cumpla con las especificaciones que se indican respecto a la paginación, tanto en el Formato de
e-CF como en el presente documento.

18.1. Calidad de impresión

La calidad de impresión de una Representación Impresa deberá ser tal que asegure la legibilidad del
documento  por  un  tiempo  de  al  menos  diez  (10)  años,  conforme  lo  establecido  en  el  literal  f)  del
Artículo 44 de la Ley 11-92 Código Tributario.

18.2. Orden y Distribución de la Información en la Representación Impresa de un e-CF.

Pág. 31 de 50

18.2.1. Encabezado41

Corresponde a la identificación del e-CF, donde contiene los datos del emisor, comprador42 y datos
tributarios.

A.  En la parte superior del encabezado, lado derecho del documento, deben estar

contenidas las siguientes informaciones:

•  Tipo  de  Comprobante  Fiscal  Electrónico:  Para  todos  los  comprobantes  fiscales
electrónicos,  se  debe  colocar  en  palabras  la  denominación  del  tipo  de  e-CF,  según
corresponda y de acuerdo con la clasificación establecida para estos fines.

Por ejemplo, para Facturas de Crédito Fiscal Electrónica se visualizaría de la siguiente manera:

•  e-NCF: debe colocar la secuencia autorizada por la DGII del número de comprobante

fiscal electrónico (e-NCF), según corresponda.

•  Fecha  Vencimiento43:  debe  colocar  la  fecha  de  vencimiento  de  la  secuencia

autorizada e-NCF.

•  e-NCF  Modificado  (aplica  para  Notas  de  Débito  y  Crédito44):  debe  colocar  la

secuencia autorizada del documento original (e-CF) sujeto a modificación.

•  Código  de  Modificación  (aplica  para  Notas  de  Débito  y  Crédito):  debe  colocar  en
palabras  la  descripción  del  código  utilizado,  según  sea  su  finalidad,  conforme  el
recuadro siguiente:

41 en caso de existir paginación, esta sección debe repetirse en cada página.
42 en el caso de la factura de consumo electrónico cuando el monto total sea menor a DOP$250 mil el RNC Comprador será
completado de manera opcional.

Pág. 32 de 50

Código de
Modificación
1
2
3
4

Descripción del Código

Anula el NCF modificado
Corrige Texto del Comprobante Fiscal modificado
Corrige montos del NCF modificado
Reemplazo NCF emitido en contingencia

B.  En la parte superior del encabezado, lado izquierdo del documento, deben estar

contenidas las siguientes informaciones del emisor:

•  Nombre Comercial (si lo hubiera).

•  Nombre o Razón Social45.

•  Sucursal (si aplica).

•  Número de Registro Nacional de Contribuyente (RNC).

•  Dirección.

•  Municipio.

•  Provincia.

•  Fecha de Emisión.

C.  En  la  parte  inferior  del  encabezado,  lado  izquierdo,  el  documento  debe  contener

los datos del cliente o destinatario:

•  Nombre  o  Razón  Social  Cliente,  como  consta  en  el  Registro  Nacional  de

Contribuyentes.

•  Número de Registro Nacional de Contribuyente (si aplica).

18.2.2. Parte central

En  la  parte  central,  el  documento  debe  contener  los  datos  indicados  a  continuación,  conforme  el
artículo 8 del Decreto no. 254-06, la Norma General 06-18 y según el bien o servicio transado.

43  aplica  para  los  comprobantes  con  valor  fiscal  indicados  en  el  presente  documento,  excepto  para  nota  de  crédito
electrónica y factura de consumo electrónica.
44 este NCF modificado puede ser con estructura de serie “B” con once (11) dígitos, de serie “E” con trece (13) dígitos y de
serie “A” y “P” con diecinueve (19) dígitos.

Pág. 33 de 50

Datos del bien o servicio transferido, valor de la transacción y datos de impuestos:

•

•

Cantidad.

Indicador de Facturación46 del Formato de e-CF. Sólo se deberá colocar el valor “E”, a la
izquierda de la descripción de cada bien o servicio en caso de ser exento,  conforme  el
citado artículo 8.

•  Descripción: hace referencia al campo ‘Nombre del Ítem’.

•  Unidad de Medida (si aplica): debe ser indicada en palabras.

•  Grados Alcohol en % (si aplica).

•

•

•

•

•

PVP (si aplica)47: es el ‘Precio de Venta al por Menor’. Corresponde al valor colocado en
el campo ‘Precio Unitario de Referencia’.

Precio: hace referencia al campo ‘Precio Unitario del Ítem’.

ISC Específico (si aplica): debe colocar el monto correspondiente de ISC Específico de
cada bien o servicio.

ISC  Ad-Valorem  (si  aplica):  debe  colocar  el  monto  de  ISC  Ad-Valorem
correspondiente a cada Ítem.

ITBIS (si aplica): en esta columna se debe colocar el monto correspondiente al  ITBIS de
cada bien o servicio.

•  Descuento (si aplica)48: hace referencia al valor colocado por línea en el campo

‘Monto Descuento’ del Formato de e-CF.

•

•

Recargo  (si  aplica):  hace  referencia  al  valor  colocado  por  línea  en  el  campo  ‘Monto
Recargo’ del Formato de e-CF.

Valor: hace referencia al valor colocado en el campo  ‘Monto Ítem’.

•  Monto de la transacción sin incluir los impuestos que afectan la operación y otros cargos si los

hubiere:

o  Subtotal Gravado (si aplica): corresponde a la sumatoria de los valores colocados
en  los  campos  ‘Monto  Gravado  ITBIS  Tasa  1’,  ‘Monto  Gravado  ITBIS  Tasa  2’  y
‘Monto Gravado ITBIS Tasa 3’ del Formato de e-CF, según aplique.

o  Subtotal Exento (si aplica)49: corresponde al valor colocado en el campo ‘Monto

Exento’.

45 Como consta en el Registro Nacional de Contribuyentes (RNC).
46 El nombre de este campo no estará en la RI, sino que sólo se debe colocar el valor del indicador cuando aplique.

47 Aplica sólo para productores de alcohol.

Pág. 34 de 50

•

•

•

•

•

Total ISC (si aplica): corresponde a la sumatoria de los impuestos selectivos al consumo.
Hace  referencia  al  campo  ‘Monto  del  Impuesto  Adicional’  cuando  este  se  encuentra
compuesto por ISC Específico e ISC Advalorem.

Total ITBIS (si aplica): corresponde a la sumatoria de los valores colocados en los campos
‘Total ITBIS Tasa 1’, ‘Total ITBIS Tasa 2’ y ‘Total ITBIS Tasa 3’ del Formato de e-CF, según
aplique.

CDT  (si  aplica):  corresponde  al  Impuesto  a  la  Contribución  al  Desarrollo  de  las
Telecomunicaciones. Hace referencia al monto impuesto adicional cuando este posea el
código del impuesto.

Propina  legal  (si  aplica):  corresponde  a  la  Propina  Legal.  Hace  referencia  al  monto
impuesto adicional cuando este posea el código del impuesto.

Total: hace referencia al valor del campo ‘Monto Total’ del Formato de e-CF.

•  Descripción de Descuento o Recargo (si aplica)50.

•  Descuento  o  Recargo  en  %  (si  aplica):  hace  referencia  al  valor  en  porcentaje  del

descuento o recargo, cuando este es global.

•  Monto  de  Descuento  o  Recargo  (si  aplica):  hace  referencia  al  monto  del

descuento o recargo aplicable.

En el caso de que el e-CF sea emitido en otra moneda y se requiera realizar una RI en el tipo de moneda
extranjera utilizado, entonces se deberá adicionar a los nombres de los campos de valores en moneda,
el  código  de  la  moneda  extranjera,  de  acuerdo  con  la  ‘Tabla  Codificación  Monedas’  indicada  en  el
Formato de e-CF51.

18.2.3. Datos adicionales para incluirse en la RI

La representación impresa debe contener adicionalmente, los datos indicados a continuación:

Informaciones de consulta de un e-CF52:

•  Código  QR  (en  inglés  “Quick  Response”,  “respuesta  rápida”):  deberá  colocarse  en  el  lado
inferior izquierdo53 del e-CF, conservar una distancia mínima de dos (2) centímetros desde
el borde de la hoja hasta el lugar donde inicia el código QR y tener un tamaño mínimo de 22
x 22 mm, con un margen de 3mm en los lados de este.

 El código QR en su composición deberá contener los siguientes parámetros54:

•  RncEmisor
•  ENCF
•  RncComprador
•  FechaEmision (dd-MM-aaaa)

Pág. 35 de 50

•  MontoTotal
•  FechaFirma (dd-MM-aaaa HH:mm:ss)
•  CodigoSeguridad:  corresponde  a  los  primeros  seis  (6)  dígitos  del  hash

generado en el SignatureValue de la ﬁrma digital del e-CF.

•

•

Código de Seguridad: Debe ser indicado en palabras los primeros seis (6) dígitos del hash
del SignatureValue de la ﬁrma, debajo del código QR.

Fecha de Firma Digital: Debe colocar la fecha y hora de la ﬁrma digital en formato dd-
MM-aaaa HH:mm: ss.

Ejemplo:

https://ecf.dgii.gov.do/ecf/ConsultaTimbre?RncEmisor=XXXXXXXXXXX&RncComp
rador=X XXXXXXXXXX&ENCF=XXXXXXXXXXXXX&FechaEmision=dd-
MMyyyy&MontoTotal=XXXX.XX&FechaFirma=dd-
MMyyyy%20HH:mm:ss&CodigoSeguridad=XXXXXX

Informaciones de consulta para la Factura de Consumo Electrónica menor a DOP$250 mil55:

En el caso del código QR para una factura de consumo electrónica menor a DOP$250
mil, en su composición, deberá contener los siguientes parámetros:

•  RncEmisor
•  ENCF
•  MontoTotal
•  CodigoSeguridad: corresponde a los primeros seis (6) dígitos del hash generado

en el SignatureValue de la ﬁrma digital del e-CF.

Ejemplo:

https://fc.dgii.gov.do/eCF/ConsultaTimbreFC?RncEmisor=XXXXXXXXXXX&ENCF=
XXXXXXXXXXXXX&MontoTotal=XXXX.XX&CodigoSeguridad=XXXXXX

•

•

Código de Seguridad. Debe ser indicado en palabras, debajo del código QR, los primeros
seis (6) dígitos del hash del SignatureValue de la factura de consumo electrónica menor
a DOP$250 mil.
Fecha  de  Firma  Digital.  Debe  colocar  la  fecha  y  hora  de  la  ﬁrma  digital  en  formato
dd-MM-aaaa HH:mm: ss de la factura de consumo electrónica menor a DOP$250 mil.

48 el descuento podrá presentarse con valor negativo.
49 el nombre de este campo sólo estará en la RI, en los casos que aplique.
50 Este se indica cuando existen descuentos o recargos aplicados de manera global.

51 La impresión en la RI de los campos en otra moneda es condicional a que existan transacciones en otras monedas. Dichos campos pueden
ser impresos en la RI sin ser necesario incluir los de moneda local, debido a que ambas informaciones se encuentran en el formato XML
de e-CF.

Pág. 36 de 50

Informaciones concernientes a paginación de un e-CF56:

•  Página No. (si aplica): corresponde a la numeración de la página que contiene los datos del e-
CF al realizar una RI, siempre y cuando sea mayor a una página. Este  debe  estar  en  orden
secuencial, iniciando desde el número 1.

•  Subtotal Gravado Página (si aplica): corresponde a la sumatoria de los valores colocados en
los  campos  ‘Subtotal  Monto  gravado  ITBIS  Tasa1’,  ‘Subtotal  Monto  gravado  ITBIS  Tasa2’ y
‘Subtotal Monto gravado ITBIS Tasa3’ de las líneas pertenecientes a la página que se indica.

•  Subtotal Exento Página (si aplica): corresponde al total de la sumatoria de los valores de ítems

exentos colocados en las líneas pertenecientes a la página que se indica.

•  Subtotal Impuesto Selectivo al Consumo Página (si aplica): corresponde al valor del Impuesto
Selectivo al Consumo Específico y Ad Valorem, pertenecientes a los ítems indicados en las
líneas de la página que se indica.

•  Subtotal Otros Impuestos Adicionales Página (si aplica): corresponde al valor del impuesto
adicional  (exceptuando  el  impuesto  selectivo  al  consumo  específico  y  Ad  Valorem),
pertenecientes a los ítems indicados en las líneas de la página que se indica.

•  Monto total Página (si aplica): corresponde a la sumatoria de los campos ‘Subtotal Monto
Gravado Total Página’, ‘Subtotal Exento Página’, ‘Subtotal ITBIS Página’ y ‘Subtotal Impuesto
Adicional Página’, pertenecientes a los ítems indicados en las líneas de la página que se indica.

•  Subtotal ITBIS Página (si aplica): corresponde a la sumatoria de los valores colocados en los
campos ‘Subtotal ITBIS Tasa 1’, ‘Subtotal ITBIS Tasa 2’ y ‘Subtotal ITBIS Tasa 3’ de las líneas
pertenecientes a la página que se indica.

•  Subtotal  Impuesto  Adicional  Página  (si  aplica):  corresponde  a  la  sumatoria  de  los  valores
colocados  en  los  campos  ‘Subtotal  Impuesto  Selectivo  al  Consumo’  y  ‘Subtotal  Otros
Impuestos Adicionales’ de las líneas pertenecientes a la página que se indica.

52 En caso de existir paginación, estas informaciones deben repetirse en cada página del e-CF.

53 Excepto para dispositivos Handheld, en los cuales podrá ser también en el lado inferior central de la parte final del e-CF.

54 Se exceptúan de estos parámetros las facturas de consumo menor a DOPS$250 mil.
55 El receptor no electrónico podrá consultar mediante el código del QR de la RI de la factura de consumo electrónica menor a DOP$250 mil, la validez de la
secuencia que le fue emitida, a través de los canales disponibles por la DGII para los ﬁnes.
56 en la RI sólo se utilizará la sección de paginación en caso de que aplique, cuando exista más de una página; la misma debe ser indicada en todas las
páginas, excepto en la página ﬁnal que contiene los valores totales del e-CF completo con los campos correspondientes a estos (ver modelo ilustrativo 4.1.7.
del presente documento).

Pág. 37 de 50

18.3.  Modelos ilustrativos de Factura de Crédito Fiscal Electrónica

18.3.1. Modelo ilustrativo con totales al final de la factura57

57  El monto del campo ‘Valor’ del detalle de bienes o servicios, no incluye impuestos (precio x cantidad).

Pág. 38 de 50

18.3.2. Modelo ilustrativo incluyendo el ITBIS en el campo ‘Valor’

del detalle de bienes o servicios

Pág. 39 de 50

18.3.3. Modelo ilustrativo incluyendo el ITBIS en el campo ‘Valor’

y totales en la parte del detalle de bienes o servicios

Pág. 40 de 50

18.3.4. Modelo ilustrativo de un e-FCF realizado a través de Papel Continuo

Pág. 41 de 50

18.3.5. Modelo ilustrativo de e-FCF para Impuesto Selectivo al Consumo

Pág. 42 de 50

18.3.6. Modelo ilustrativo de la Nota de Crédito Electrónica

Pág. 43 de 50

18.3.7. Modelo ilustrativo incluyendo Paginación (e-CF con dos páginas)

Página 1:

Pág. 44 de 50

Página 2:

Pág. 45 de 50

18.3.8. Modelo ilustrativo de la Factura de Consumo Electrónica con monto

total igual o mayor a DOP$ 250 mil

Pág. 46 de 50

18.3.9. Modelo ilustrativo de la Factura de Consumo Electrónica con monto

total menor a DOP$ 250 mil

Pág. 47 de 50

18.3.10. Modelo ilustrativo de la Factura de Consumo Electrónica con monto

menor a DOP$250 mil, realizado a través de Papel Continuo

Pág. 48 de 50

19. Operación en Contingencia

De conformidad con lo establecido en los artículos 40 al 43 del reglamento aplicable, se considera que un
emisor electrónico se encuentra en estado de contingencia cuando se presentan situaciones que impiden
la  emisión  y/o  el  envío  de  los  Comprobantes  Fiscales  Electrónicos  (e-CF)  a  la  Dirección  General  de
Impuestos Internos (DGII).

1. Contingencia por falta de conectividad

Se configura cuando el emisor electrónico dispone de la capacidad para generar los e-CF, pero no puede
remitirlos a  la  DGII  para  su  validación  en  tiempo  real,  debido  a  interrupciones  o  intermitencias  en  los
servicios de conectividad.

En estos casos, el emisor deberá:

  Generar los e-CF en modalidad offline.
  Remitirlos a la DGII una vez restablecida la conexión, en un plazo máximo de setenta y dos (72)

horas.

Para la entrega de bienes o prestación de servicios, será obligatorio emitir la representación impresa del
e-CF, incorporando la leyenda: “e-CF emitido en modalidad de contingencia”. Dicho comprobante podrá
ser validado fiscalmente una vez transcurrido el plazo indicado.

2. Cuando no sea posible la emisión del e-CF

Esta situación se presenta cuando el emisor electrónico no cuenta con la capacidad técnica para generar
e-CF.

En tales casos, el contribuyente deberá:

  Utilizar secuencias autorizadas de Comprobantes Fiscales No Electrónicos.

Este tipo de contingencia no podrá exceder un período máximo de quince (15) días calendario. Asimismo,
la DGII establecerá los mecanismos correspondientes para la notificación del estado de contingencia.

3. Regularización posterior a la contingencia

Una vez superada la contingencia por imposibilidad de emisión de e-CF, el contribuyente deberá, en un
plazo máximo de treinta (30) días calendario:

  Generar  y  remitir  a  la  DGII  los  e-CF  correspondientes  a  las  operaciones  realizadas  durante  el

período de contingencia.

  Referenciar

los  comprobantes  no  electrónicos  previamente  emitidos,  conforme  a

las

especificaciones técnicas establecidas por la DGII.

Estos  e-CF  serán  enviados  exclusivamente  a  la  DGII  para  fines  de  validación,  mientras  que  el  receptor

Pág. 49 de 50

podrá utilizar los comprobantes no electrónicos para sustentar costos, gastos y crédito fiscal.

Es responsabilidad del contribuyente notificar a la DGII el restablecimiento de los servicios que permitan
la emisión regular de e-CF.

4. Validez de los comprobantes en contingencia

Únicamente serán válidos para fines fiscales aquellos comprobantes no electrónicos emitidos durante un
estado  de  contingencia  debidamente  notificado  a  la  DGII,  conforme  a  los  canales  y  disposiciones
establecidas.

5. Contingencia de la DGII

Cuando los sistemas de la DGII no se encuentren disponibles, el emisor electrónico deberá:

  Almacenar los e-CF generados.
  Remitirlos una vez restablecida la comunicación con la DGII.

En caso de que esta situación se extienda por más de quince (15) días hábiles, se habilitará en la Oficina
Virtual  (OFV)  del  contribuyente  la  opción  de  envío  de  reportes  (ventas,  compras,  gastos,  costos,
retenciones, entre otros), permitiendo la operación temporal mediante comprobantes no electrónicos.

Pág. 50 de 50

dgii.gov.do

(809) 689-3444 desde cualquier parte del país.

informacion@dgii.gov.do

IMPUESTOS  INTERNOS
Marzo 2026

Publicación informativa sin validez legal

@DGIIRD

