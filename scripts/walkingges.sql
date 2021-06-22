--
-- Base de datos: WalkingGes
--

-- LOCAL
CREATE DATABASE IF NOT EXISTS WalkingGes CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE WalkingGes;

/*
-- HEROKU
-- CREATE DATABASE IF NOT EXISTS heroku_7f2cb8c976f52c8 CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE heroku_7f2cb8c976f52c8;
*/
-- --------------------------------------------------------

--
-- Estructura de tabla Usuarios
--

DROP TABLE IF EXISTS Usuarios;
CREATE TABLE IF NOT EXISTS Usuarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  Nombre BLOB NOT NULL,
  Usuario BLOB NOT NULL,
  Password VARCHAR(40) NOT NULL,
  Genero SET('h', 'm') NOT NULL,
  FechaNacimiento DATE NOT NULL,
  Email BLOB NOT NULL,
  Admin SET('S', 'N') NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Datos tabla Usuarios
--

INSERT INTO Usuarios	(id, Nombre, Usuario, Password, Genero, FechaNacimiento, Email, Admin) VALUES
						(1, AES_ENCRYPT('Fernando Urbón Domínguez', 'walkingges'), AES_ENCRYPT('fernando', 'walkingges'), SHA('1234'), 'h', '1995-07-10', AES_ENCRYPT('fernando.1995@hotmail.com', 'walkingges'), 'S'),
						(2, AES_ENCRYPT('Juan González Pérez', 'walkingges'), AES_ENCRYPT('juan', 'walkingges'), SHA('1234'), 'h', '1980-03-27', AES_ENCRYPT('juan@hotmail.com', 'walkingges'), 'N'),
						(3, AES_ENCRYPT('Patricia Vázquez Gómez', 'walkingges'), AES_ENCRYPT('patricia', 'walkingges'), SHA('1234'), 'm', '1990-04-04', AES_ENCRYPT('patricia@hotmail.com', 'walkingges'), 'N'),
						(4, AES_ENCRYPT('Laura Rodríguez López', 'walkingges'), AES_ENCRYPT('laura', 'walkingges'), SHA('1234'), 'm', '1965-04-04', AES_ENCRYPT('laura@hotmail.com', 'walkingges'), 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla Rutas
--

DROP TABLE IF EXISTS Rutas;
CREATE TABLE IF NOT EXISTS Rutas (
  id int(11) NOT NULL AUTO_INCREMENT,
  Usuario int(11) NOT NULL,
  Nombre VARCHAR(150) NOT NULL,
  URL VARCHAR(300) NOT NULL,
  PRIMARY KEY (id)
--  FOREIGN KEY (Usuario) REFERENCES Usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Datos tabla Rutas
--

INSERT INTO Rutas	(id, Usuario, Nombre, URL) VALUES
						(1, '1', 'Ruta por Valladolid', 'files/rutas/1.gpx'),
						(2, '2', 'Valladolid. Villa de Prado - Mucientes - Fuensaldaña - Villa de Prado', 'files/rutas/2.gpx'),
						(3, '1', 'De Valladolid hasta Peñalba de Duero', 'files/rutas/3.gpx'),
						(4, '3', 'Los cortados de Cabezón de Pisuerga y San Martín de Valvení', 'files/rutas/4.gpx'),
						(5, '4', 'Canal de Castilla hasta bodegas Frutos Villar', 'files/rutas/5.gpx'),
						(6, '3', 'Ruta de los humedales, pozos y atalayas del Monte El Viejo. Palencia', 'files/rutas/6.gpx'),
						(7, '4', 'De Salamanca a Alba de Tormes por la vía del tren', 'files/rutas/7.gpx'),
						(8, '2', 'Ruta Lazarillo por el Río Tormes. Salamanca', 'files/rutas/8.gpx');

-- --------------------------------------------------------

--
-- Estructura de tabla Publicaciones
--

DROP TABLE IF EXISTS Publicaciones;
CREATE TABLE IF NOT EXISTS Publicaciones (
  id int(11) NOT NULL AUTO_INCREMENT,
  Usuario int(11) NOT NULL,
  Fecha DATETIME NOT NULL,
  Titulo VARCHAR(150) NOT NULL,
  Descripcion TEXT NOT NULL,
  Ruta int(11) NOT NULL,
  Estado SET('Publicada', 'Pendiente', 'Rechazada') NOT NULL,
  PRIMARY KEY (id)
--  FOREIGN KEY (Usuario) REFERENCES Usuarios(id)
--  FOREIGN KEY (Ruta) REFERENCES Rutas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Datos tabla Publicaciones
--

INSERT INTO Publicaciones	(id, Usuario, Fecha, Titulo, Descripcion, Ruta, Estado) VALUES
							(1, 1, '2021-06-17 18:15:23', 'Paseo por Valladolid', 'Partimos de la Plaza Zorrilla junto a la Academia de Caballería para dirigir nuestros pasos al centro cívico de la misma como es la Plaza Mayor. 
Tras detenernos un rato en la misma vamos a otro importante punto formado por la Catedral, Universidad e Iglesia de Santa María de la Antigua. Cambiamos de estilo para visitar el Teatro Calderón desde donde nos dirigimos hacia la Plaza de San Pablo donde se encuentra el Palacio Pimentel, el convento de San Pablo y San Gregorio estando no muy lejos el Colegio de San Gregorio y el Palacio Real. 
Una vez visitada esta zona nos acercamos a la Plaza del Viejo Coso para acercarnos un poco más tarde al Río Pisuerga desde donde volvemos a la plaza Mayor donde finalizamos tomando unas buenas tapas y vinos.', '1', 'Publicada'),
							(2, 2, '2021-06-15 12:13:15', 'Valladolid. Villa de Prado - Mucientes - Fuensaldaña - Villa de Prado', 'El recorrido empieza en Valladolid, en el barrio Villa de Prado. Tomamos dirección al Canal de Castilla donde lo tomamos a la salida de Valladolid. Seguimos durante unos 5 kilómetros a la par del Canal. En el Km. 7,8 de nuestra ruta vemos un puente que cruza al otro lado del Canal. Por error seguimos el Canal por la otra vertiente, pero rápido nos damos cuenta del error y volvemos hacia atrás para salir definitivamente del Canal y llegar a la autovía A-62 a la altura del kilómetro 118. Vamos a la par de la autovía en dirección Burgos hasta tomar un paso elevado con dirección a Cigales. Tomamos esta carretera local hasta pasar las Bodegas La Legua, donde nos desviamos en diagonal por un camino. Tras enlazar unos caminos llegamos a Mucientes tras realizar una pequeña subida. 
Tras pasar Mucientes tenemos una subida tendida de unos 4 kilómetros que tras coronarla tenemos una plácida bajada hasta Fuensaldaña, donde podemos ver su Castillo. 
Al salir de Fuensaldaña el camino va picando para arriba hasta llegar a una recta donde podemos observar una pronunciada subida al final. Esta subida está repleta de cantos, por lo tanto algún pequeño susto nos podremos llevar. Una vez arriba llaneamos unos 2 kilómetros hasta llegar a la altura de la autovía A-60, a la que no llegamos ya que nos desviamos doblemente a la izquierda para empezar una divertida bajada hasta entrar en Valladolid, cruzando antes de su entrada la A-62 de nuevo por un paso inferior. 
A la entrada de Valladolid llegamos a la carretera de Fuensaldaña, la cual tomamos en el recorrido de ida. Desde aquí vamos por las grandes avenidas hasta llegar al barrio de Villa de Prado de nuevo. ', '2', 'Publicada'),
							(3, 1, '2021-06-16 00:15:27', 'De Valladolid hasta Peñalba de Duero', 'Quedé con un amigo en Pajarillos para desde ahí tirar hacia el páramo y la zona de la ribera del Duero. Después de subir a buen ritmo el alto del Águila, continuamos bastante rápidos por el páramo para acabar descenciendo hasta alcanzar la zona de las Mamblas. Cogimos parte del Canal del Duero en dirección este hasta ver cómo el Canal sobrevuela el Duero haciendo uso de una estructura metálica. Ya ha llegado el otoño y se ve en las hojas amarillentas de los chopos.
Desde ahí tiramos paralelos al Duero, por el camino de los aragoneses, siguiendo la ladera con el meandro del río amenazando.
Por esa zona hay una ruta algo señalizada que acaba dando a un pequeño pueblo llamado Peñalba de Duero. Ahí nos dimos la vuelta porque el Sol bajaba muy rápido.
El regreso lo hicimos por el Canal del Duero a buena velocidad hasta llegar al cruce con la carretera Soria. Ahí abandonamos el Canal del Duero y seguimos paralelos a la carretera.
Poco antes de llegar a la altura del polígono de la Mora giramos a la derecha para coger la cañada leonesa y hacer una última subida al páramo.
Está oscureciendo y la luna llena nos espera allá arriba.
Seguimos por el páramo asomándonos al valle del Esgueva y acabamos descendiendo por la zona del Alto del Águila, ya de noche y con la luz de minero encendida.
Se nos ha pasado un poco la hora pero ha merecido la pena.', '3', 'Publicada'),
							(4, 3, '2021-06-20 23:11:00', 'Los cortados de Cabezón de Pisuerga y San Martín de Valvení', 'La ruta descrita a continuación consiste en un agradable paseo por la vega del río Pisuerga y las cuestas y páramos que la bordean.
En Cabezón de Pisuerga (710 m), tiro por el paseo que se dirige hacia las bodegas situadas al suroeste del cerro Altamira.
Cojo luego la pista que se encamina al páramo de Valdecastro, pero la abandono enseguida para seguir por un sendero (760 m, 0,4 km) que sale a la izquierda y asciende entre pinos a la cima de Altamira (838 m, 0,8 km). En esta atalaya, donde se erigió un castillo en el siglo X, conviene detenerse para recrearse con las vistas de Cabezón, el valle del Pisuerga y los montes Torozos.
Bajo al collado (808 m, 0,9 km) que separa Altamira del páramo de Valdecastro, donde enlazo con una ruta señalizada, la de los Cortados de Cabezón.
Subo a Valdecastro (850 m, 1,1 km) y, dejando a la derecha amplias tierras cultivadas, prosigo llaneando por la senda que corre al borde de las cuestas ganadas por el pinar. Más abajo, uno de los meandros del serpenteante el río Pisuerga enmarca el monasterio cisterciense de Santa María de Palazuelos.
Siguiendo el sendero señalizado, dejo atrás un promontorio (855 m, 2,6 km), bajo a otro collado (813 m, 2,7 km) y asciendo a la Peña (857 m, 2,9 km), cerro, pese a su nombre, similar a los anteriores, es decir, un montículo de margas y arcillas coronado por calizas terciarias.
En el collado siguiente (832 m, 3,2 km) se encuentra el cortado más espectacular de la zona de Cabezón, con una caída vertical de más de 60 metros, y separado de las orillas del Pisuerga, que se encuentran a un cuarto de kilómetro de distancia a vuelo de pájaro, por un desnivel de 140 metros.
Aquí abandono el camino señalizado (que transformado en pista desciende hacia el Pisuerga), y sigo por la pista que sube al páramo de Bárcena.
Al poco de coronar la somera cuesta, salgo de la pista para coger un senderillo (850 m, 3,6 km) poco marcado que avanza por el borde del páramo hasta la parte superior de la Cuesta Alta (850 m, 5,2 km), desde donde desciendo a los cortados de San Martín de Valvení (770 m, 5,5 km).
Estas espléndidas y coloreadas formaciones geológicas se extienden a lo largo de algo menos de medio kilómetro cortadas a pico sobre el Pisuerga, que fluye 80 metros más abajo.
En el extremo noreste de los cortados (740 m, 6 km), la pendiente, más suave, me permite bajar a la orilla del río (700 m, 6,2 km).
Desde aquí, a la sombra de los imponentes cortados, por un sendero algo precario (sobre todo en su tramo final), pongo rumbo al suroeste, con la compañía, demasiado cercana quizás, del Pisuerga.
Tras un corto llaneo, me separo del río subiendo por terreno empinado y algo incómodo hasta dar con el camino (730 m, 6,8 km), a ratos pista, a ratos sendero, que, por la base de los cortados de Cabezón, me devuelve al punto de partida.', '4', 'Publicada'),
							(5, 4, '2021-06-21 10:20:05', 'Canal de Castilla hasta bodegas Frutos Villar', 'Iniciamos nuestra ruta en la Dársena del Canal de Castilla de Valladolid, en dirección Dueñas, calle Canal, por los caminos de sirga que discurren anexos al Ramal Sur del Canal de Castilla.
Enseguida cruzamos el puente del barrio de La Victoria, que cruza el canal, a su margen derecha, por donde seguiremos. La vuelta la realizaremos por el otro lado, siempre dejando el canal a la izquierda.
Vamos dejando atrás el Jardín Botánico de Puente Jardín. Enseguida pasamos por debajo de la autovía VA-20 y de la antigua A-62, en las inmediaciones de una zona industrial.
Ya en las afueras, nos encontramos con la Esclusa 42, que conserva las antiguas muestras metálicas que permitían el cierre y llenado del vaso de la esclusa. Bonito lugar.
La ruta se ve obligada a pasar por el carril bici que enlaza Pucela con el barrio de La Overuela, como única opción para salvar el Barranco del Berrocal. El Pisuerga dibuja un profundo y vistoso meandro. El canal supera este accidente geográfico por medio de un acueducto, mientras que nuestra ruta hace lo propio por un puente estrecho con circulación en un solo sentido.
Pasando el viaducto se retoma el camino de sirga que nos lleva a la Esclusa 41, situada ya a las afueras de la capital, junto a la finca Zamadueñas, sede de la Dirección General de Desarrollo Rural y del Instituto Tecnológico Agrario.
Continuamos desde Zamadueñas hasta el próximo puente, situado a la altura de las bodegas Frutos Villar, donde cruzaremos y daremos la vuelta por el otro lado del Canal de Castilla.
Pasamos de nuevo la Esclusa 41 y llagados al arroyo del Barrocal, la antigua autovía A-62 se ha comido el camino de sirga y pasamos por un pequeño sendero a pocos centímetros del agua del canal.
En las inmediaciones de la Esclusa 42 nos encontramos con un centro de la Confederación Hidrográfica del Duero, que hay que bordear también por un sendero estrecho pagado a la autovía.
Pasamos por antigua viviendas de trabajadores, clausuradas a cal y canto, y enseguida volvemos a cruzar debajo de la A-62 y de la VA-20 para alcanzar la calle Parva de la Ría, y llegar de nuevo a la calle Canal junto a la Dársena, inicio de nuestra ruta.', '5', 'Pendiente'),
							(6, 3, '2021-06-18 16:29:10', 'Ruta de los humedales, pozos y atalayas del Monte El Viejo. Palencia', 'Recorrido en lazo por el Monte El Viejo, Palencia, que nos permitirá conocer información muy interesante sobre el entorno natural y patrimonial que alberga el monte y que servirá de complemento ideal para realizar una ruta guiada o autoguiada.

Recomendamos la realización de la misma. durante la primavera y otoño que son las estaciones en donde se puede apreciar su mayor esplendor.

El inicio de la ruta se realiza desde el aparcamiento del Restaurante "El Refugio" situado a 6.5 km desde el Puente Mayor en Palencia. Recorreremos los equipamientos municipales del entorno: merendero y piscina municipal, pasaremos por la Casa Forestal donde se ubican las oficinas de la guardería a cargo del cuidado del monte. Desde allí nos desviaremos momentáneamente a nuestra izquierda para acercarnos hasta el Parque de Valdellano a visitar la reserva de ciervos que allí se encuentra. Desde allí retrocedemos de nuevo hasta la Casa Forestal para coger camino paralelo por el margen izquierdo de la carretera PP-9001 y que llega hasta la Casa Grande, pero que nosotros nos desviaremos mucho antes para seguir otras opciones que tenemos contempladas en esta ruta. Por tanto seguimos por el camino indicado hasta cruzar delante de la entrada al C.A.M.P. Ntra. Sra. de la Calle, seguidamente continuaremos por el mismo camino un poco más hasta llegar a las inmediaciones del Pozo del Pañuelo, Atalaya y una fuente de agua potable. Desde allí abandonamos senda para coger otro camino que nos conduce hasta El Arenal dónde se encuentra el humedal temporal más importante del monte: la Charca El Cigarral.

Desde allí se cruzan varios caminos que nos vienen o van hacia la Casa Pequeña, a Villamuriel de Cerrato por el Valle del Cigarral o hacia la Casa Grande. Nosotros en este ocasión hemos elegido coger el camino que nos lleva hacia la Casa Grande, pasando previamente por delante de la zona llamada Carropluma o Cantera de agua, otro interesante humedal temporal que se forma en el entorno durante la época de lluvias. Desde allí nos acercaremos hasta el Pozo de Vallejuelos y posteriormente llegaremos hasta la Casa Grande.

Para volver tomaremos uno de los caminos interiores que nos llevaría de nuevo hasta la zona del Arenal, pero al llegar a un cruce de cuatro caminos donde el terreno se encuentra ampliamente deforestado, tomaremos el camino de la izquierda que nos llevará hasta el Pozo de Mauricio no sin antes pasar por delante por, quizás, la encina más vieja que se encuentra en el Monte El Viejo: la atalaya "Bonita".

Una vez alcanzado el Pozo de Mauricio, entroncamos con la senda que sigue paralela a la carretera PP-9001 que lleva hasta la Casa Grande. Tomaremos en el desvío esa senda a nuestra derecha dirigiéndonos de nuevo hacia la Casa Forestal y desde allí nos dirigiremos nuevamente hacia las piscina municipal, merendero y finalmente alcanzar el aparcamiento del Restaurante "El Refugio" donde ponemos fin a este recorrido.', '6', 'Publicada'),
							(7, 4, '2021-06-19 09:38:15', 'De Salamanca a Alba de Tormes por la vía del tren', 'De Salamanca a Alba de Tormes por la desmantelada vía del ferrocarril Ruta de la Plata.

Ruta larga y aburrida para un caminante. Trayectos rectilíneos avanzando por llanuras de secano, lejos de pueblos escondidos al abrigo de los tesos, entre los que destacan los Arapiles pelados y secos, con aires de las guerras napoleónicas.

La antigua vía del tren se esconde en profundas trincheras areniscas cuando empiezan los encinares.

Una interminable recta cuesta arriba abre el camino otra vez a las tierras de cereales, con Terradillos a la vista y el torreón de Alba a lo lejos. Son tres kilómetros que no se acaban nunca con los ciclistas de frente regresando a Salamanca.

Al abandonar la vía hay que caminar por el asfalto reciente, sin apenas arcén, para entrar en Alba por el puente sobre el Tormes.

A la orilla del río aún queda alguna casa de comidas en la que se pueden reponer fuerzas con una sopa de fideos y algún guiso reconfortante.

El autobús nos devuelve a Salamanca en poco rato.', '7', 'Publicada'),
							(8, 2, '2021-06-17 15:47:20', 'Ruta Lazarillo por el Río Tormes. Salamanca', 'Hoy tocaba una de nuestras rutas preferidas... La Ruta Lazarillo por el Tormes en Salamanca capital. En esta ocasión la comenzamos en el Puente Romano dirección a la isla del Soto de Santa Marta, desde allí cruzamos a la Aldehuela para Seguir Rio abajo por el paseo Fluvial y después de pasar el puente romano seguimos por un camino que va por debajo de los Hospitales hasta una pasarela que cruza hacia Tejares y desde allí seguimos por la orilla del río hacia Salas bajas para acabar la ruta en el Puente Romano.', '8', 'Publicada');

-- --------------------------------------------------------

--
-- Estructura de tabla Fotos
--

DROP TABLE IF EXISTS Fotos;
CREATE TABLE IF NOT EXISTS Fotos (
  id int(11) NOT NULL AUTO_INCREMENT,
  Publicacion int(11) NOT NULL,
  URL varchar(300) NOT NULL,
  PRIMARY KEY (id)
--  FOREIGN KEY (Publicacion) REFERENCES Publicaciones(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Datos tabla Fotos
--

INSERT INTO Fotos	(id, Publicacion, URL) VALUES
						(1, '1', 'files/fotos_publicaciones/1_0.jpg'),
						(2, '1', 'files/fotos_publicaciones/1_1.jpg'),
						(3, '1', 'files/fotos_publicaciones/1_2.jpg'),
						(4, '1', 'files/fotos_publicaciones/1_3.jpg'),
						(5, '1', 'files/fotos_publicaciones/1_4.jpg'),
						(6, '1', 'files/fotos_publicaciones/1_5.jpg'),
						(7, '1', 'files/fotos_publicaciones/1_6.jpg'),
						(8, '1', 'files/fotos_publicaciones/1_7.jpg'),
						(9, '1', 'files/fotos_publicaciones/1_8.jpg'),
						(10, '1', 'files/fotos_publicaciones/1_9.jpg'),
						(11, '1', 'files/fotos_publicaciones/1_10.jpg'),
						(12, '1', 'files/fotos_publicaciones/1_11.jpg'),
						(13, '1', 'files/fotos_publicaciones/1_12.jpg'),
						(14, '1', 'files/fotos_publicaciones/1_13.jpg'),
						(15, '1', 'files/fotos_publicaciones/1_14.jpg'),
						(16, '1', 'files/fotos_publicaciones/1_15.jpg'),
						(17, '1', 'files/fotos_publicaciones/1_16.jpg'),
						(18, '1', 'files/fotos_publicaciones/1_17.jpg'),
						(19, '2', 'files/fotos_publicaciones/2_0.jpg'),
						(20, '2', 'files/fotos_publicaciones/2_1.jpg'),
						(21, '2', 'files/fotos_publicaciones/2_2.jpg'),
						(22, '2', 'files/fotos_publicaciones/2_3.jpg'),
						(23, '3', 'files/fotos_publicaciones/3_0.jpg'),
						(24, '3', 'files/fotos_publicaciones/3_1.jpg'),
						(25, '3', 'files/fotos_publicaciones/3_2.jpg'),
						(26, '3', 'files/fotos_publicaciones/3_3.jpg'),
						(27, '3', 'files/fotos_publicaciones/3_4.jpg'),
						(28, '3', 'files/fotos_publicaciones/3_5.jpg'),
						(29, '3', 'files/fotos_publicaciones/3_6.jpg'),
						(30, '4', 'files/fotos_publicaciones/4_0.jpg'),
						(31, '4', 'files/fotos_publicaciones/4_1.jpg'),
						(32, '4', 'files/fotos_publicaciones/4_2.jpg'),
						(33, '4', 'files/fotos_publicaciones/4_3.jpg'),
						(34, '4', 'files/fotos_publicaciones/4_4.jpg'),
						(35, '4', 'files/fotos_publicaciones/4_5.jpg'),
						(36, '4', 'files/fotos_publicaciones/4_6.jpg'),
						(37, '4', 'files/fotos_publicaciones/4_7.jpg'),
						(38, '4', 'files/fotos_publicaciones/4_8.jpg'),
						(39, '4', 'files/fotos_publicaciones/4_9.jpg'),
						(40, '4', 'files/fotos_publicaciones/4_10.jpg'),
						(41, '4', 'files/fotos_publicaciones/4_11.jpg'),
						(42, '4', 'files/fotos_publicaciones/4_12.jpg'),
						(43, '4', 'files/fotos_publicaciones/4_13.jpg'),
						(44, '4', 'files/fotos_publicaciones/4_14.jpg'),
						(45, '5', 'files/fotos_publicaciones/5_0.jpg'),
						(46, '5', 'files/fotos_publicaciones/5_1.jpg'),
						(47, '5', 'files/fotos_publicaciones/5_2.jpg'),
						(48, '5', 'files/fotos_publicaciones/5_3.jpg'),
						(49, '5', 'files/fotos_publicaciones/5_4.jpg'),
						(50, '5', 'files/fotos_publicaciones/5_5.jpg'),
						(51, '5', 'files/fotos_publicaciones/5_6.jpg'),
						(52, '5', 'files/fotos_publicaciones/5_7.jpg'),
						(53, '5', 'files/fotos_publicaciones/5_8.jpg'),
						(54, '5', 'files/fotos_publicaciones/5_9.jpg'),
						(55, '5', 'files/fotos_publicaciones/5_10.jpg'),
						(56, '5', 'files/fotos_publicaciones/5_11.jpg'),
						(57, '5', 'files/fotos_publicaciones/5_12.jpg'),
						(58, '5', 'files/fotos_publicaciones/5_13.jpg'),
						(59, '6', 'files/fotos_publicaciones/6_0.jpg'),
						(60, '6', 'files/fotos_publicaciones/6_1.jpg'),
						(61, '6', 'files/fotos_publicaciones/6_2.jpg'),
						(62, '6', 'files/fotos_publicaciones/6_3.jpg'),
						(63, '6', 'files/fotos_publicaciones/6_4.jpg'),
						(64, '6', 'files/fotos_publicaciones/6_5.jpg'),
						(65, '6', 'files/fotos_publicaciones/6_6.jpg'),
						(66, '6', 'files/fotos_publicaciones/6_7.jpg'),
						(67, '6', 'files/fotos_publicaciones/6_8.jpg'),
						(68, '6', 'files/fotos_publicaciones/6_9.jpg'),
						(69, '6', 'files/fotos_publicaciones/6_10.jpg'),
						(70, '6', 'files/fotos_publicaciones/6_11.jpg'),
						(71, '6', 'files/fotos_publicaciones/6_12.jpg'),
						(72, '7', 'files/fotos_publicaciones/7_0.jpg'),
						(73, '7', 'files/fotos_publicaciones/7_1.jpg'),
						(74, '7', 'files/fotos_publicaciones/7_2.jpg'),
						(75, '7', 'files/fotos_publicaciones/7_3.jpg'),
						(76, '7', 'files/fotos_publicaciones/7_4.jpg'),
						(77, '7', 'files/fotos_publicaciones/7_5.jpg'),
						(78, '7', 'files/fotos_publicaciones/7_6.jpg'),
						(79, '7', 'files/fotos_publicaciones/7_7.jpg'),
						(80, '7', 'files/fotos_publicaciones/7_8.jpg'),
						(81, '8', 'files/fotos_publicaciones/8_0.jpg'),
						(82, '8', 'files/fotos_publicaciones/8_1.jpg'),
						(83, '8', 'files/fotos_publicaciones/8_2.jpg'),
						(84, '8', 'files/fotos_publicaciones/8_3.jpg'),
						(85, '8', 'files/fotos_publicaciones/8_4.jpg'),
						(86, '8', 'files/fotos_publicaciones/8_5.jpg'),
						(87, '8', 'files/fotos_publicaciones/8_6.jpg'),
						(88, '8', 'files/fotos_publicaciones/8_7.jpg'),
						(89, '8', 'files/fotos_publicaciones/8_8.jpg'),
						(90, '8', 'files/fotos_publicaciones/8_9.jpg');
						
-- --------------------------------------------------------

--
-- Estructura de tabla Amigos
--

DROP TABLE IF EXISTS Amigos;
CREATE TABLE IF NOT EXISTS Amigos (
  id int(11) NOT NULL AUTO_INCREMENT,
  Usuario1 int(11) NOT NULL,
  Usuario2 int(11) NOT NULL,
  Estado SET('Aceptado', 'Pendiente') NOT NULL,
  Fecha DATETIME NOT NULL,
  PRIMARY KEY (id)
--  FOREIGN KEY (Usuario1) REFERENCES Usuarios(id)
--  FOREIGN KEY (Usuario2) REFERENCES Usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Datos tabla Amigos
--

INSERT INTO Amigos	(id, Usuario1, Usuario2, Estado, Fecha) VALUES
						(1, '2', '1', 'Pendiente', '2021-06-07 12:16:21'),
						(2, '1', '3', 'Aceptado', '2021-05-18 18:43:34'),
						(3, '1', '4', 'Aceptado', '2021-06-04 20:17:12'),
						(4, '2', '3', 'Aceptado', '2021-06-09 18:43:34');

-- --------------------------------------------------------

--
-- Estructura de tabla Privacidad
--

DROP TABLE IF EXISTS Privacidad;
CREATE TABLE IF NOT EXISTS Privacidad (
  id int(11) NOT NULL AUTO_INCREMENT,
  Usuario int(11) NOT NULL,
  Publicaciones SET('SoloAmigos', 'Todos') NOT NULL,
  Amigos SET('SoloAmigos', 'Todos') NOT NULL,
  Email SET('Nadie', 'SoloAmigos', 'Todos') NOT NULL,
  FechaNacimiento SET('Nadie', 'SoloAmigos', 'Todos') NOT NULL,
  AñoNacimiento SET('S', 'N') NOT NULL,
  Genero SET('Nadie', 'SoloAmigos', 'Todos') NOT NULL,
  PRIMARY KEY (id)
--  FOREIGN KEY (Usuario) REFERENCES Usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Datos tabla Usuarios
--

INSERT INTO Privacidad	(id, Usuario, Publicaciones, Amigos, Email, FechaNacimiento, AñoNacimiento, Genero) VALUES
						(1, '1', 'SoloAmigos', 'Todos', 'SoloAmigos', 'Todos', 'S', 'Todos'),
						(2, '2', 'SoloAmigos', 'Todos', 'SoloAmigos', 'Todos', 'S', 'Todos'),
						(3, '3', 'SoloAmigos', 'Todos', 'SoloAmigos', 'Todos', 'S', 'Todos'),
						(4, '4', 'SoloAmigos', 'Todos', 'SoloAmigos', 'Todos', 'S', 'Todos');