-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-02-2019 a las 22:00:18
-- Versión del servidor: 10.0.36-MariaDB-0ubuntu0.16.04.1
-- Versión de PHP: 7.2.13-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `orlenmar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'llave primaria',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre de la categoría ',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descripción de la categoría  ',
  `config` text COLLATE utf8mb4_unicode_ci COMMENT 'configuraciones para saber los intervalos de edades a las que pertenece, aquí se se guarda un objeto JSON ',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png' COMMENT 'Imagen de la categoría ',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación ',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de actualización  '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='categorías ';

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `config`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Niños', 'Sumérgete en el maravilloso mundo de la Biblia donde aprenderás y conocerás de los diferentes personajes Bíblicos, esta categoría esta comprendida entre las edades de cuatro (4) a diez (10) años', '{"start":"0","end":"10"}', 'default.png', '2019-02-13 05:20:56', '2019-02-13 05:20:56'),
(2, 'Pre Juveniles', 'esta categoría esta comprendida entre las edades de once (11) a quince (15) años', '{"start":"11","end":"15"}', 'default.png', '2019-02-13 05:20:56', '2019-02-13 05:20:56'),
(3, 'Juveniles', 'esta categoría esta comprendía entre las edades de dieciséis (16) a veinte (20) años', '{"start":"16","end":"..."}', 'default.png', '2019-02-13 05:20:56', '2019-02-13 05:20:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `histories`
--

CREATE TABLE `histories` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'llave primaria',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'llave foránea del usuario que creo la historia ',
  `category_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'llave foránea de la categoría a la cual pertenece la historia ',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'titulo de la historia',
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'subtitulo de la historia',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descripción  de la historia',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'contenido de la historia',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png' COMMENT 'imagen de la historia',
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'vídeo de la historia ',
  `status` enum('active','deactivated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'estado de la historia para ocultar y publicar dicha historia',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='historias bíblicas ';

--
-- Volcado de datos para la tabla `histories`
--

INSERT INTO `histories` (`id`, `user_id`, `category_id`, `title`, `sub_title`, `description`, `content`, `image`, `video`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Noé', 'Noé y el Gran Diluvio', 'Fascinante historia sobre la construcción de un arca y el pacto de Dios con el mundo', 'Fascinante historia sobre la construcción de un arca y el pacto de Dios con el mundo', 'images/histories/10-06-2018_20-06-12.jpeg', 'videos/histories/node.mp4', 'active', '2019-02-13 05:21:11', '2019-02-13 05:21:11'),
(2, 1, 1, 'Abraham', 'Dios prueba el amor de Abraham', 'Un hombre escogido por Dios, lleno de fe y amor.', 'Un hombre escogido por Dios, lleno de fe y amor.', 'images/histories/10-06-2018_20-06-43.jpeg', 'videos/histories/abraham.mp4', 'active', '2019-02-13 05:21:13', '2019-02-13 05:21:13'),
(3, 1, 1, 'Sansón', 'Sansón el hombre fuerte de Dios', 'Un hombre increíblemente fuerte, que pasará por una dura prueba, para demostrar su obediencia', 'Un hombre increíblemente fuerte, que pasará por una dura prueba, para demostrar su obediencia', 'images/histories/10-06-2018_20-06-32.jpeg', 'videos/histories/sanson.mp4', 'active', '2019-02-13 05:21:13', '2019-02-13 05:21:13'),
(4, 1, 2, 'Noé', 'Noé y el Gran Diluvio', 'fascinante historia sobre la construcción de un arca y el pacto de Dios con el mundo', '<!DOCTYPE html>\n                            <html>\n                            <head>\n                            </head>\n                            <body>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center"><span style="color: #0070c0;"><span style="font-family: Courgette, serif;"><span style="font-size: x-large;"><span lang="es-ES"><strong>No&eacute; y el Gran Diluvio</strong></span></span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center">&nbsp;</p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">No&eacute; era un hombre que adoraba a Dios.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">La dem&aacute;s gente lo odiaba y desobedec&iacute;a, un d&iacute;a Dios dijo algo sorprendente </span></span></span><span style="color: #0070c0;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;Voy a destruir este mundo perverso&rdquo;</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES"> y le dijo a No&eacute; &ldquo;Solamente tu familia ser&aacute; salvada&rdquo;, le advirti&oacute; que un gran diluvio iba a venir que cubrir&iacute;a la tierra.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="color: #0070c0;">&ldquo;<span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Haz un arca de madera, un barco muy, muy grande como para tu familia y muchos animales&rdquo;</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES"> le orden&oacute; a No&eacute;.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Dios le dio instrucciones exactas de c&oacute;mo construirlo y No&eacute; se apresur&oacute; a trabajar.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">La gente se burlaba mientras No&eacute; explicaba porque estaba construyendo un arca, construy&oacute; y habl&oacute; a la gente acerca de Dios pero nadie le escuch&oacute;.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">No&eacute; crey&oacute; en Dios aunque aun no llegaba la lluvia; De pronto el arca estuvo lista para llenar con provisiones, y Dios orden&oacute; a los animales de todas las especies macho y hembra como p&aacute;jaros grandes y peque&ntilde;os, bestias chiquitas y altas y todas se dirigieron hacia el arca.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">La gente se burlaba mientras ve&iacute;an entrar los animales, ellos no dejaban de pecar contra Dios, al final todos los animales estaban dentro del arca y Dios dijo </span></span></span><span style="color: #0070c0;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;Sube al arca t&uacute; y tu familia&rdquo;,</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES"> No&eacute; su esposa, sus tres hijos y las esposas de ellos entraron al arca, luego Dios cerr&oacute; la puerta. Despu&eacute;s vino la lluvia, un chaparr&oacute;n enorme el cu&aacute;l mojo toda la tierra por cuarenta d&iacute;as y cuarenta noches, el agua inund&oacute; ciudades, pueblos y monta&ntilde;as estaban bajo agua, todo lo que respiraba aire estaba muerto, mientras que el agua sub&iacute;a el arca flotaba.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Luego de cinco meses de inundaci&oacute;n Dios mando un viento secador, lentamente el arca fue a parar al alto de las monta&ntilde;as de Ararat. No&eacute; se qued&oacute; dentro cuarenta d&iacute;as m&aacute;s mientras el agua iba bajando. No&eacute; mando un cuervo y una paloma por la ventana, para ver si encontraban un lugar seco en donde descansar, la paloma volvi&oacute; a No&eacute;. Una semana m&aacute;s tarde No&eacute; prob&oacute; de nuevo. La paloma volvi&oacute; con una hoja de olivo en el pico. A la semana siguiente No&eacute; env&iacute;o nuevamente a la paloma supo que la tierra estaba seca porque la paloma no volvi&oacute;. </span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Dios le dijo a No&eacute; que era tiempo de irse del arca, junto con su familia descargaron a los animales, &iexcl;Cu&aacute;n agradecido se habr&iacute;a sentido No&eacute;!, que construy&oacute; un altar y ador&oacute; a Dios quien le hab&iacute;a salvado a &eacute;l y a su familia del terrible diluvio. Dios le prometi&oacute; a No&eacute; nunca m&aacute;s mandar&iacute;a un diluvio para juzgar el pecado humano.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Dios le dio un gran recuerdo que fue el arco&iacute;ris era la se&ntilde;al de su promesa.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">No&eacute; y su familia encontraron nuevas tierras donde vivir. Con el paso del tiempo, sus descendientes repoblaron la tierra entera. Todas las naciones del mundo vinieron de No&eacute; y sus hijos.</span></span></span></p>\n                            </body>\n                            </html>', 'images/histories/10-06-2018_21-06-30.jpeg', '', 'active', '2019-02-13 05:21:14', '2019-02-13 05:21:14'),
(5, 1, 2, 'Abraham', 'Dios prueba el amor de Abraham', 'un hombre escogido por Dios, lleno de fe y amor.', '<!DOCTYPE html>\n                            <html>\n                            <head>\n                            </head>\n                            <body>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center"><span style="color: #ff0000;"><span style="font-family: Courgette, serif;"><span style="font-size: x-large;"><span lang="es-ES"><strong>Dios prueba el amor de Abraham</strong></span></span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center">&nbsp;</p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Una noche Dios le dio a Abraham una orden extra&ntilde;a, era una prueba para ver si Abraham amaba a su hijo Isaac m&aacute;s que a Dios </span></span></span><span style="color: #ff0000;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;lleva a tu hijo Isaac y ofr&eacute;cele como un sacrificio&rdquo;</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES"> le orden&oacute; Dios. Esto era dif&iacute;cil para Abraham, &eacute;l amaba mucho a su hijo. Pero Abraham hab&iacute;a aprendido a confiar en Dios a&uacute;n cuando no entend&iacute;a. </span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">El pr&oacute;ximo d&iacute;a a la ma&ntilde;ana sali&oacute; para ir a la monta&ntilde;a de sacrificio con Isaac y dos sirvientes, antes de salir, Abraham cort&oacute; pedazos de madera para hacer un fuego para el sacrificio. Abraham planeaba obedecer a Dios, tres d&iacute;as m&aacute;s tarde se acercaron a la monta&ntilde;a. </span></span></span><span style="color: #ff0000;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;Qu&eacute;dense ac&aacute;&rdquo;</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES"> Abraham les dijo a sus sirvientes. </span></span></span><span style="color: #ff0000;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;Nosotros iremos y adoraremos y volveremos a ustedes&rdquo;.</span></span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Isaac cargo la madera, Abraham llev&oacute; el fuego y un cuchillo, Isaac pregunt&oacute; &iquest;Adonde est&aacute; el cordero para el sacrificio?, &ldquo;</span></span></span><span style="color: #ff0000;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Dios se proveer&aacute; de Cordero&rdquo;</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES"> respondi&oacute; Abraham, los dos vinieron al lugar exacto escogido por Dios.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">All&iacute;, Abraham construy&oacute; un altar y puso la madera para quemar el sacrificio ante Dios. Abraham at&oacute; a Isaac a su hijo amado sobre el altar y cuando se dispon&iacute;a al sacrificio de su hijo, aunque su coraz&oacute;n se part&iacute;a, pero Abraham sab&iacute;a que ten&iacute;a que obedecer a Dios. </span></span></span><span style="color: #ff0000;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;ALTO&rdquo; </span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">grit&oacute; el &Aacute;ngel de Dios </span></span></span><span style="color: #ff0000;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;Ahora sabe Dios que le temes, no has desobedecido&rdquo; </span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">y</span></span></span> <span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">viendo un cordero en los arbustos, el &aacute;ngel le dijo que le sacrificara en lugar de Isaac y mientras que Abraham e Isaac adoraban a Dios el &aacute;ngel de Dios le habl&oacute; a Abraham </span></span></span><span style="color: #ff0000;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;En tu descendencia ser&aacute;n todas las naciones bendecidas porque tu obedeciste&rdquo;.</span></span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Alg&uacute;n d&iacute;a cientos de a&ntilde;os despu&eacute;s Jes&uacute;s ser&iacute;a nacido a trav&eacute;s de los descendientes de Abraham.</span></span></span></p>\n                            </body>\n                            </html>', 'images/histories/10-06-2018_21-06-18.jpeg', '', 'active', '2019-02-13 05:21:14', '2019-02-13 05:21:14'),
(6, 1, 2, 'Sansón', 'Sansón el hombre fuerte de Dios', 'un hombre increíblemente fuerte, que pasará por una dura prueba, para demostrar su obediencia', '<!DOCTYPE html>\n                            <html>\n                            <head>\n                            </head>\n                            <body>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center"><span style="color: #9bbb59;"><span style="font-family: Courgette, serif;"><span style="font-size: x-large;"><span lang="es-ES"><strong>Sans&oacute;n el hombre fuerte de Dios</strong></span></span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center">&nbsp;</p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Hace muchos a&ntilde;os, en Israel, vivi&oacute; un hombre llamado Manoa, el y su esposa no ten&iacute;an hijos. Un d&iacute;a un &aacute;ngel de Dios apareci&oacute; a la esposa de Manoa </span></span></span><span style="color: #9bbb59;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;Tendr&aacute;s un beb&eacute; muy especial&rdquo; </span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">le dijo el &aacute;ngel y cuando ella le cont&oacute; a su esposo el oro diciendo </span></span></span><span style="color: #9bbb59;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">&ldquo;Ah Se&ntilde;or m&iacute;o&hellip; que aquel var&oacute;n de Dios que enviaste, vuelva ahora a venir a nosotros y nos ense&ntilde;e lo que tenemos que hacer con el ni&ntilde;o que ha de nacer&rdquo;</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">. El &aacute;ngel dijo a Manoa que el ni&ntilde;o </span></span></span><span style="color: #9bbb59;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">nunca deb&iacute;a</span></span></span></span> <span style="color: #9bbb59;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">cortarse el cabello, nunca beber licor, ni comer ciertas comidas</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES"> porque Dios hab&iacute;a escogido este ni&ntilde;o para ser un juez que gobernar&iacute;a a Israel.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">El pueblo de Dios necesitaba ayuda pues sus enemigos, los filisteos, maltrataban a los israelitas y este ni&ntilde;o ser&iacute;a el hombre m&aacute;s fuerte del mundo y los defender&iacute;a. Con el tiempo la mujer dio a luz un var&oacute;n, y le puso por nombre </span></span></span><span style="color: #9bbb59;"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Sans&oacute;n</span></span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">, el ni&ntilde;o creci&oacute; y Dios lo bendijo, y el Esp&iacute;ritu empez&oacute; a manifestarse en &eacute;l. </span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Sans&oacute;n llego a ser muy fuerte un d&iacute;a pele&oacute; con un le&oacute;n sin tener ninguna arma en su mano y le mat&oacute;. Otro d&iacute;a atrapo trescientos zorros, y les at&oacute; a sus colas y les prendi&oacute; fuego, dej&aacute;ndolos libres para que corrieran por los campos de los filisteos. Sans&oacute;n se dejo atrapar, lo ataron y lo entregaron para ser matado por los filisteos, pero el Esp&iacute;ritu de Dios vino sobre Sans&oacute;n y le liber&oacute; y con una quijada de un asno muerto mato a mil enemigos. Una noche los filisteos le atraparon en una ciudad y cerraron con llave los portones de la ciudad, pero Sans&oacute;n sali&oacute; derrumbando los portones; los filisteos no sab&iacute;an como detener a Sans&oacute;n porque era muy fuerte, as&iacute; que planearon que una mujer llamada Dalila le enamorara y le contara el secreto de su fuerza, pero Sans&oacute;n le fallo a Dios, se embriag&oacute; y comparti&oacute; el secreto de su fuerza con Dalila, y ella llamo a los filisteos para que le cortaran el cabello mientras dorm&iacute;a. Los filisteos atacaron a Sans&oacute;n que no se pudo defender ya que le hab&iacute;an cortado el cabello y perdido su fuerza, le sacaron sus ojos y le esclavizaron. </span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: large;"><span lang="es-ES">Al pasar los a&ntilde;os, un d&iacute;a los filisteos hicieron una fiesta y alabaron a sus dioses por entregar en sus manos a Sans&oacute;n, mandaron a llamar a Sans&oacute;n para burlarse de el, y al ni&ntilde;o que lo guiaba Sans&oacute;n le pidi&oacute; que le colocara sus manos en las columnas del templo, y como a Sans&oacute;n le hab&iacute;a vuelto a crecer su cabello, or&oacute; a Dios para que le regresara su fuerza, y empujo las columnas y todo el templo cay&oacute; en ruina, matando a filisteos y a &eacute;l con ellos.</span></span></span></p>\n                            </body>\n                            </html>', 'images/histories/10-06-2018_21-06-46.jpeg', '', 'active', '2019-02-13 05:21:15', '2019-02-13 05:21:15'),
(7, 1, 3, 'Abraham', 'Abraham e Isaac', 'Un hombre escogido por Dios, lleno de fe y amor.', '<!DOCTYPE html>\n                            <html>\n                            <head>\n                            </head>\n                            <body>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center"><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: x-large;">Abraham e Isaac</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%;" align="center">&nbsp;</p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Aconteci&oacute; despu&eacute;s de estas cosas, que prob&oacute; Dios a Abraham, y le dijo: </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Abraham.</span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: medium;"> Y &eacute;l respondi&oacute;: </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Heme aqu&iacute;</span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: medium;">.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y dijo: </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Toma ahora tu hijo, tu &uacute;nico, Isaac, a quien amas, y vete a tierra de Moriah, y ofr&eacute;celo all&iacute; en holocausto sobre uno de los montes que yo te dir&eacute;.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify">&nbsp;<span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y Abraham se levant&oacute; muy de ma&ntilde;ana, y enalbard&oacute; su asno, y tom&oacute; consigo dos siervos suyos, y a Isaac su hijo; y cort&oacute; le&ntilde;a para el holocausto, y se levant&oacute;, y fue al lugar que Dios le dijo.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Al tercer d&iacute;a alz&oacute; Abraham sus ojos, y vio el lugar de lejos.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Entonces dijo Abraham a sus siervos: Esperad aqu&iacute; con el asno, y yo y el muchacho iremos hasta all&iacute; y </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">adoraremos, y volveremos a vosotros.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y tom&oacute; Abraham la le&ntilde;a del holocausto, y la puso sobre Isaac su hijo, y &eacute;l tom&oacute; en su mano el fuego y el cuchillo; y fueron ambos juntos.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Entonces habl&oacute; Isaac a Abraham su padre, y dijo: Padre m&iacute;o. Y &eacute;l respondi&oacute;: Heme aqu&iacute;, mi hijo. Y &eacute;l dijo: He aqu&iacute; el fuego y la le&ntilde;a; mas </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">&iquest;d&oacute;nde est&aacute; el cordero para el holocausto?</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y respondi&oacute; Abraham: </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Dios se proveer&aacute; de cordero para el holocausto</span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: medium;">, hijo m&iacute;o. E iban juntos.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y cuando llegaron al lugar que Dios le hab&iacute;a dicho, edific&oacute; all&iacute; Abraham un altar, y compuso la le&ntilde;a, y at&oacute; a Isaac su hijo, y lo puso en el altar&nbsp;sobre la le&ntilde;a.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y extendi&oacute; Abraham su mano y tom&oacute; el cuchillo para degollar a su hijo.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Entonces el &aacute;ngel de Jehov&aacute; le dio voces desde el cielo, y dijo: </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Abraham, Abraham.</span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: medium;"> Y &eacute;l respondi&oacute;: </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Heme aqu&iacute;.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y dijo: </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">No extiendas tu mano sobre el muchacho, ni le hagas nada; porque ya conozco que temes a Dios, por cuanto no me rehusaste tu hijo, tu &uacute;nico.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Entonces alz&oacute; Abraham sus ojos y mir&oacute;, y he aqu&iacute; a sus espaldas un carnero trabado en un zarzal por sus cuernos; y fue Abraham y tom&oacute; el carnero, y lo ofreci&oacute; en holocausto en lugar de su hijo.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y llam&oacute; Abraham el nombre de aquel lugar, </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Jehov&aacute; proveer&aacute;</span></span></span><span style="font-family: Courgette, serif;"><span style="font-size: medium;">.&nbsp;Por tanto se dice hoy: En el monte de Jehov&aacute; ser&aacute; provisto.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y llam&oacute; el &aacute;ngel de Jehov&aacute; a Abraham por segunda vez desde el cielo,</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y dijo: </span></span><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Por m&iacute; mismo he jurado, dice Jehov&aacute;, que por cuanto has hecho esto, y no me has rehusado tu hijo, tu &uacute;nico hijo;</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">De cierto te bendecir&eacute;, y multiplicar&eacute;&nbsp;tu descendencia como las estrellas del cielo y como la arena que est&aacute; a la orilla del mar;&nbsp;y tu descendencia poseer&aacute; las puertas de sus enemigos.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="color: #00b050;"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">En tu simiente ser&aacute;n benditas todas las naciones de la tierra,&nbsp;por cuanto obedeciste a mi voz.</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;"><span style="font-size: medium;">Y volvi&oacute; Abraham a sus siervos, y se levantaron y se fueron juntos a Beerseba; y habit&oacute; Abraham en Beerseba.</span></span></p>\n                            </body>\n                            </html>', 'images/histories/11-06-2018_20-06-20.jpeg', '', 'active', '2019-02-13 05:21:15', '2019-02-13 05:21:15'),
(8, 1, 3, 'Sansón', 'Sansón y su Fuerza', 'un hombre increíblemente fuerte, que pasará por una dura prueba, para demostrar su obediencia', '<!DOCTYPE html>\n                            <html>\n                            <head>\n                            </head>\n                            <body>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center"><span style="color: #943634;"><span style="font-family: Courgette, serif;"><span style="font-size: x-large;">Sans&oacute;n y su Fuerza</span></span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: center;" align="center">&nbsp;</p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Los hijos de Israel volvieron a hacer lo malo ante los ojos de Jehov&aacute;; y Jehov&aacute; los entreg&oacute; en mano de los filisteos por cuarenta a&ntilde;os.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y hab&iacute;a un hombre de Zora, de la tribu de Dan, el cual se llamaba Manoa; y su mujer era est&eacute;ril, y nunca hab&iacute;a tenido hijos. A esta mujer apareci&oacute; el &aacute;ngel de Jehov&aacute;, y le dijo: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">He aqu&iacute; que t&uacute; eres est&eacute;ril, y nunca has tenido hijos; pero concebir&aacute;s y dar&aacute;s a luz un hijo.</span></span><span style="font-family: Courgette, serif;"> Ahora, pues, no bebas vino ni sidra, ni comas cosa inmunda. </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Pues he aqu&iacute; que concebir&aacute;s y dar&aacute;s a luz un hijo; y navaja no pasar&aacute; sobre su cabeza, porque el ni&ntilde;o ser&aacute; nazareo&nbsp;a Dios desde su nacimiento, y &eacute;l comenzar&aacute; a salvar a Israel de mano de los filisteos.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y la mujer vino y se lo cont&oacute; a su marido, diciendo: Un var&oacute;n de Dios vino a m&iacute;, cuyo aspecto era como el aspecto de un &aacute;ngel de Dios, temible en gran manera; y no le pregunt&eacute; de d&oacute;nde ni qui&eacute;n era, ni tampoco &eacute;l me dijo su nombre. Y me dijo: He aqu&iacute; que t&uacute; concebir&aacute;s, y dar&aacute;s a luz un hijo; por tanto, ahora no bebas vino, ni sidra, ni comas cosa inmunda, porque este ni&ntilde;o ser&aacute; nazareo a Dios desde su nacimiento hasta el d&iacute;a de su muerte.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Entonces or&oacute; Manoa a Jehov&aacute;, y dijo: Ah, Se&ntilde;or m&iacute;o, yo te ruego que aquel var&oacute;n de Dios que enviaste, vuelva ahora a venir a nosotros, y nos ense&ntilde;e lo que hayamos de hacer con el ni&ntilde;o que ha de nacer. Y Dios oy&oacute; la voz de Manoa; y el &aacute;ngel de Dios volvi&oacute; otra vez a la mujer, estando ella en el campo; mas su marido Manoa no estaba con ella. Y la mujer corri&oacute; prontamente a avisarle a su marido, dici&eacute;ndole: Mira que se me ha aparecido aquel var&oacute;n que vino a m&iacute; el otro d&iacute;a.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y se levant&oacute; Manoa, y sigui&oacute; a su mujer; y vino al var&oacute;n y le dijo: &iquest;Eres t&uacute; aquel var&oacute;n que habl&oacute; a la mujer? Y &eacute;l dijo: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Yo soy. </span></span><span style="font-family: Courgette, serif;">Entonces Manoa dijo: Cuando tus palabras se cumplan, &iquest;c&oacute;mo debe ser la manera de vivir del ni&ntilde;o, y qu&eacute; debemos hacer con &eacute;l?</span> <span style="font-family: Courgette, serif;">Y el &aacute;ngel de Jehov&aacute; respondi&oacute; a Manoa: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">La mujer se guardar&aacute; de todas las cosas que yo le dije. No tomar&aacute; nada que proceda de la vid; no beber&aacute; vino ni sidra, y no comer&aacute; cosa inmunda; guardar&aacute; todo lo que le mand&eacute;.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y la mujer dio a luz un hijo, y le puso por nombre </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Sans&oacute;n.</span></span><span style="font-family: Courgette, serif;"> Y el ni&ntilde;o creci&oacute;, y Jehov&aacute; lo bendijo. </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Y el Esp&iacute;ritu de Jehov&aacute; comenz&oacute; a manifestarse en &eacute;l </span></span><span style="font-family: Courgette, serif;">en los campamentos de Dan, entre Zora y Estaol.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">En una ocasi&oacute;n Sans&oacute;n mat&oacute; a mil enemigos con la </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">quijada de un asno</span></span><span style="font-family: Courgette, serif;"> y en otra derrib&oacute; </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">los portones de una ciudad </span></span><span style="font-family: Courgette, serif;">ya que lo hab&iacute;an atrapado y de esta manera escap&oacute;, todo esto era gracias a la fuerza que el ten&iacute;a ya que el Esp&iacute;ritu de Dios estaba sobre el.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Despu&eacute;s de esto aconteci&oacute; que se enamor&oacute; de una mujer en el valle de Sorec, la cual se llamaba </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Dalila.</span></span><span style="font-family: Courgette, serif;"> Y vinieron a ella los pr&iacute;ncipes de los filisteos, y le dijeron: Eng&aacute;&ntilde;ale e inf&oacute;rmate en qu&eacute; consiste su gran fuerza, y c&oacute;mo lo podr&iacute;amos vencer, para que lo atemos y lo dominemos; y cada uno de nosotros te dar&aacute; mil cien siclos de plata.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y Dalila dijo a Sans&oacute;n: Yo te ruego que me declares en qu&eacute; consiste tu gran fuerza, y c&oacute;mo podr&aacute;s ser atado para ser dominado. Y le respondi&oacute; Sans&oacute;n: Si me ataren con siete mimbres verdes que a&uacute;n no est&eacute;n enjutos, entonces me debilitar&eacute; y ser&eacute; como cualquiera de los hombres. Y los pr&iacute;ncipes de los filisteos le trajeron siete mimbres verdes que a&uacute;n no estaban enjutos, y ella le at&oacute; con ellos. Y ella ten&iacute;a hombres en acecho en el aposento. Entonces ella le dijo: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">&iexcl;Sans&oacute;n, los filisteos contra ti!</span></span><span style="font-family: Courgette, serif;"> Y &eacute;l rompi&oacute; los mimbres, como se rompe una cuerda de estopa cuando toca el fuego; y no se supo el secreto de su fuerza.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Entonces Dalila dijo a Sans&oacute;n: He aqu&iacute; t&uacute; me has enga&ntilde;ado, y me has dicho mentiras; desc&uacute;breme, pues, ahora, te ruego, c&oacute;mo podr&aacute;s ser atado. Y &eacute;l le dijo: Si me ataren fuertemente con cuerdas nuevas que no se hayan usado, yo me debilitar&eacute;, y ser&eacute; como cualquiera de los hombres. Y Dalila tom&oacute; cuerdas nuevas, y le at&oacute; con ellas, y le dijo: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">&iexcl;Sans&oacute;n, los filisteos sobre ti! </span></span><span style="font-family: Courgette, serif;">Y los esp&iacute;as estaban en el aposento. M&aacute;s &eacute;l las rompi&oacute; de sus brazos como un hilo. Y Dalila dijo a Sans&oacute;n: Hasta ahora me enga&ntilde;as, y tratas conmigo con mentiras. Desc&uacute;breme, pues, ahora, c&oacute;mo podr&aacute;s ser atado. El entonces le dijo: Si tejieres siete guedejas de mi cabeza con la tela y las asegurares con la estaca. Y ella las asegur&oacute; con la estaca, y le dijo: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">&iexcl;Sans&oacute;n, los filisteos sobre ti!</span></span><span style="font-family: Courgette, serif;"> Mas despertando &eacute;l de su sue&ntilde;o, arranc&oacute; la estaca del telar con la tela.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y ella le dijo: &iquest;C&oacute;mo dices: Yo te amo, cuando tu coraz&oacute;n no est&aacute; conmigo? Ya me has enga&ntilde;ado tres veces, y no me has descubierto a&uacute;n en qu&eacute; consiste tu gran fuerza.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y aconteci&oacute; que, presion&aacute;ndole ella cada d&iacute;a con sus palabras e importun&aacute;ndole, su alma fue reducida a mortal angustia.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Le descubri&oacute;, pues, todo su coraz&oacute;n, y le dijo: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Nunca a mi cabeza lleg&oacute; navaja; porque soy nazareo de Dios desde el vientre de mi madre. Si fuere rapado, mi fuerza se apartar&aacute; de m&iacute;, y me debilitar&eacute; y ser&eacute; como todos los hombres.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Viendo Dalila que &eacute;l le hab&iacute;a descubierto todo su coraz&oacute;n, envi&oacute; a llamar a los principales de los filisteos, diciendo: Venid esta vez, porque &eacute;l me ha descubierto todo su coraz&oacute;n. Y los principales de los filisteos vinieron a ella, trayendo en su mano el dinero. Y ella hizo que &eacute;l se durmiese sobre sus rodillas, y llam&oacute; a un hombre, quien le rap&oacute; las siete guedejas de su cabeza; y ella comenz&oacute; a afligirlo, pues su fuerza se apart&oacute; de &eacute;l. Y le dijo: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">&iexcl;Sans&oacute;n, los filisteos sobre ti!</span></span><span style="font-family: Courgette, serif;"> Y luego que despert&oacute; &eacute;l de su sue&ntilde;o, se dijo: Esta vez saldr&eacute; como las otras y me escapar&eacute;. </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Pero &eacute;l no sab&iacute;a que Jehov&aacute; ya se hab&iacute;a apartado de &eacute;l.</span></span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Mas los filisteos le echaron mano, y le sacaron los ojos, y le llevaron a Gaza; y le ataron con cadenas para que moliese en la c&aacute;rcel.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y el cabello de su cabeza comenz&oacute; a crecer, despu&eacute;s que fue rapado.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Entonces los principales de los filisteos se juntaron para ofrecer sacrificio a Dag&oacute;n su dios y para alegrarse; y dijeron: Nuestro dios entreg&oacute; en nuestras manos a Sans&oacute;n nuestro enemigo. Y vi&eacute;ndolo el pueblo, alabaron a su dios, diciendo: Nuestro dios entreg&oacute; en nuestras manos a nuestro enemigo, y al destruidor de nuestra tierra, el cual hab&iacute;a dado muerte a muchos de nosotros. Y aconteci&oacute; que cuando sintieron alegr&iacute;a en su coraz&oacute;n, dijeron: Llamad a Sans&oacute;n, para que nos divierta. Y llamaron a Sans&oacute;n de la c&aacute;rcel, y sirvi&oacute; de juguete delante de ellos; y lo pusieron entre las columnas.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Entonces Sans&oacute;n dijo al joven que le guiaba de la mano: Ac&eacute;rcame, y hazme palpar las columnas sobre las que descansa la casa, para que me apoye sobre ellas.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y la casa estaba llena de hombres y mujeres, y todos los principales de los filisteos estaban all&iacute;; y en el piso alto hab&iacute;a como tres mil hombres y mujeres, que estaban mirando el escarnio de Sans&oacute;n.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Entonces clam&oacute; Sans&oacute;n a Jehov&aacute;, y dijo: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Se&ntilde;or Jehov&aacute;, acu&eacute;rdate ahora de m&iacute;, y fortal&eacute;ceme, te ruego, solamente esta vez, oh Dios, para que de una vez tome venganza de los filisteos por mis dos ojos. </span></span><span style="font-family: Courgette, serif;">Asi&oacute; luego Sans&oacute;n las dos columnas de en medio, sobre las que descansaba la casa, y ech&oacute; todo su peso sobre ellas, su mano derecha sobre una y su mano izquierda sobre la otra.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y dijo Sans&oacute;n: </span><span style="color: #943634;"><span style="font-family: Courgette, serif;">Muera yo con los filisteos.</span></span><span style="font-family: Courgette, serif;"> Entonces se inclin&oacute; con toda su fuerza, y cay&oacute; la casa sobre los principales, y sobre todo el pueblo que estaba en ella. Y los que mat&oacute; al morir fueron muchos m&aacute;s que los que hab&iacute;a matado durante su vida.</span></p>\n                            <p class="western" lang="es-VE" style="margin-bottom: 0.35cm; line-height: 115%; text-align: justify;" align="justify"><span style="font-family: Courgette, serif;">Y descendieron sus hermanos y toda la casa de su padre, y le tomaron, y le llevaron, y le sepultaron entre Zora y Estaol, en el sepulcro de su padre Manoa. Y &eacute;l juzg&oacute; a Israel veinte a&ntilde;os.</span></p>\n                            </body>\n                            </html>', 'images/histories/11-06-2018_20-06-23.jpeg', '', 'active', '2019-02-13 05:21:16', '2019-02-13 05:21:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `letter_soups`
--

CREATE TABLE `letter_soups` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'llave primaria',
  `history_id` int(10) UNSIGNED NOT NULL COMMENT 'llave foránea de la historia a la cual pertenece',
  `words` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'palabras de la sopa de letra, aquí se guarda un objeto JSON',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='sopa de letras';

--
-- Volcado de datos para la tabla `letter_soups`
--

INSERT INTO `letter_soups` (`id`, `history_id`, `words`, `created_at`, `updated_at`) VALUES
(1, 1, '[{"word":"NOE","id":1528782759442},{"word":"ARCA","id":1528782791175},{"word":"AGUA","id":1528782799168},{"word":"LLUVIA","id":1528782800295},{"word":"MACHO","id":1528782800767},{"word":"HEMBRA","id":1528782801160},{"word":"DIAS","id":1528782801552},{"word":"PALOMA","id":1528782801912}]', '2019-02-13 05:21:11', '2019-02-13 05:21:11'),
(2, 2, '[{"word":"AMOR","id":1528782624400},{"word":"HIJO","id":1528782671617},{"word":"ALTO","id":1528782681889},{"word":"ISAAC","id":1528782689280},{"word":"\\u00c1NGEL","id":1528782694256},{"word":"ORDEN","id":1528782698280},{"word":"PRUEBA","id":1528782701002},{"word":"ALTAR","id":1528782705729},{"word":"ABRAHAM","id":1528782708264},{"word":"TEMOR","id":1528782715192}]', '2019-02-13 05:21:13', '2019-02-13 05:21:13'),
(3, 3, '[{"word":"BEBE","id":1528782233656},{"word":"JUEZ","id":1528782267482},{"word":"ASNO","id":1528782279354},{"word":"MANOA","id":1528782287234},{"word":"ISRAEL","id":1528782295842},{"word":"FUERTE","id":1528782308410},{"word":"CORTAR","id":1528782317441},{"word":"QUIJADA","id":1528782323257}]', '2019-02-13 05:21:14', '2019-02-13 05:21:14'),
(4, 4, '[{"word":"NOE","id":1528782759442},{"word":"ARCA","id":1528782791175},{"word":"AGUA","id":1528782799168},{"word":"LLUVIA","id":1528782800295},{"word":"MACHO","id":1528782800767},{"word":"HEMBRA","id":1528782801160},{"word":"DIAS","id":1528782801552},{"word":"PALOMA","id":1528782801912},{"word":"ARCOIRIS","id":1528782827185},{"word":"ANIMALES","id":1528782827544}]', '2019-02-13 05:21:14', '2019-02-13 05:21:14'),
(5, 5, '[{"word":"AMOR","id":1528782624400},{"word":"HIJO","id":1528782671617},{"word":"ALTO","id":1528782681889},{"word":"ISAAC","id":1528782689280},{"word":"\\u00c1NGEL","id":1528782694256},{"word":"ORDEN","id":1528782698280},{"word":"PRUEBA","id":1528782701002},{"word":"ALTAR","id":1528782705729},{"word":"ABRAHAM","id":1528782708264},{"word":"TEMOR","id":1528782715192},{"word":"AMADO","id":1528782715408},{"word":"CONFIAR","id":1528782724641}]', '2019-02-13 05:21:15', '2019-02-13 05:21:15'),
(6, 6, '[{"word":"BEBE","id":1528782233656},{"word":"JUEZ","id":1528782267482},{"word":"ASNO","id":1528782279354},{"word":"MANOA","id":1528782287234},{"word":"ISRAEL","id":1528782295842},{"word":"FUERTE","id":1528782308410},{"word":"CORTAR","id":1528782317441},{"word":"QUIJADA","id":1528782323257},{"word":"DALILA","id":1528782367386},{"word":"SECRETO","id":1528782376953}]', '2019-02-13 05:21:15', '2019-02-13 05:21:15'),
(7, 7, '[{"word":"AMOR","id":1528782624400},{"word":"HIJO","id":1528782671617},{"word":"ALTO","id":1528782681889},{"word":"ISAAC","id":1528782689280},{"word":"\\u00c1NGEL","id":1528782694256},{"word":"ORDEN","id":1528782698280},{"word":"PRUEBA","id":1528782701002},{"word":"ALTAR","id":1528782705729},{"word":"ABRAHAM","id":1528782708264},{"word":"TEMOR","id":1528782715192},{"word":"AMADO","id":1528782715408},{"word":"CONFIAR","id":1528782724641},{"word":"CUCHILLO","id":1528782736240},{"word":"ADORAR","id":1528782742056},{"word":"PROVEE","id":1528782742496},{"word":"OBEDECER","id":1528782742872}]', '2019-02-13 05:21:16', '2019-02-13 05:21:16'),
(8, 8, '[{"word":"BEBE","id":1528782233656},{"word":"JUEZ","id":1528782267482},{"word":"ASNO","id":1528782279354},{"word":"MANOA","id":1528782287234},{"word":"ISRAEL","id":1528782295842},{"word":"FUERTE","id":1528782308410},{"word":"CORTAR","id":1528782317441},{"word":"QUIJADA","id":1528782323257},{"word":"DALILA","id":1528782367386},{"word":"SECRETO","id":1528782376953},{"word":"ESPIRITU","id":1528782385753},{"word":"CRECER","id":1528782392409},{"word":"OJOS","id":1528782398737},{"word":"NI\\u00d1O","id":1528782405626},{"word":"CABELLO","id":1528782412481}]', '2019-02-13 05:21:16', '2019-02-13 05:21:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memories`
--

CREATE TABLE `memories` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'llave primaria',
  `history_id` int(10) UNSIGNED NOT NULL COMMENT 'llave foránea de la historia a la cual pertenece',
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'imagen de la memoria',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='memorias';

--
-- Volcado de datos para la tabla `memories`
--

INSERT INTO `memories` (`id`, `history_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/memories/noe/1e5bd080-6e60-11e8-b892-2593a06b90d8.png', '2019-02-13 05:21:11', '2019-02-13 05:21:11'),
(2, 1, 'images/memories/noe/2beec9d0-6e60-11e8-b8a2-516b1f8bea62.png', '2019-02-13 05:21:11', '2019-02-13 05:21:11'),
(3, 1, 'images/memories/noe/3358c310-6e60-11e8-bb80-ddeb86cc137f.png', '2019-02-13 05:21:11', '2019-02-13 05:21:11'),
(4, 1, 'images/memories/noe/3c22dcc0-6e60-11e8-8ee9-017d87f4e60d.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(5, 1, 'images/memories/noe/44c8a3f0-6e60-11e8-af37-ed1bfe1ec5b8.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(6, 1, 'images/memories/noe/4d499ab0-6e60-11e8-8d4e-2de92e638a0b.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(7, 1, 'images/memories/noe/555d5570-6e60-11e8-a305-19becf7e83b6.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(8, 1, 'images/memories/noe/5efaab00-6e60-11e8-88de-9d2ae7d922b2.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(9, 1, 'images/memories/noe/67b9be70-6e60-11e8-9fb6-9fa5658b4889.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(10, 1, 'images/memories/noe/739e5ba0-6e60-11e8-b896-ff273f8cfb34.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(11, 1, 'images/memories/noe/8102f290-6e60-11e8-8e72-59fe71339ec0.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(12, 1, 'images/memories/noe/8ff7acd0-6e60-11e8-9668-db5fa1266313.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(13, 1, 'images/memories/noe/99034800-6e60-11e8-8cbd-ad995ff34bec.png', '2019-02-13 05:21:12', '2019-02-13 05:21:12'),
(14, 1, 'images/memories/noe/a2dc9b10-6e60-11e8-903c-952bc6393f66.png', '2019-02-13 05:21:13', '2019-02-13 05:21:13'),
(15, 1, 'images/memories/noe/ad1614b0-6e60-11e8-8a75-1b7d199e190c.png', '2019-02-13 05:21:13', '2019-02-13 05:21:13'),
(16, 1, 'images/memories/noe/baa987a0-6e60-11e8-afcf-af258cb3b6e0.png', '2019-02-13 05:21:13', '2019-02-13 05:21:13'),
(17, 1, 'images/memories/noe/c367e870-6e60-11e8-bb7d-9778da9080a6.png', '2019-02-13 05:21:13', '2019-02-13 05:21:13'),
(18, 1, 'images/memories/noe/cc0908e0-6e60-11e8-b2d5-b32bf7c458b0.png', '2019-02-13 05:21:13', '2019-02-13 05:21:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='esta tabla la crea laravel para gestionar las migraciones de la BD';

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_01_12_123041_create_categories_table', 1),
(15, '2019_01_12_123129_create_histories_table', 1),
(16, '2019_01_12_123213_create_tests_table', 1),
(17, '2019_01_12_123245_create_letter_soups_table', 1),
(18, '2019_01_12_123333_create_memories_table', 1),
(19, '2019_01_12_123358_create_puzzles_table', 1),
(20, '2019_01_12_194805_create_points_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'correo para la recuperación ',
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'token único "lista de caracteres alfanuméricos" que se envía por correo para la recuperación de contraseña ',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='esta es la tabla por defecto que laravel usa para la recuperación  de contraseñas ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `points`
--

CREATE TABLE `points` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'llave primaria',
  `point` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'puntos obtenidos ',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'llave foránea del usuario que gano los puntos',
  `test_id` int(10) UNSIGNED NOT NULL COMMENT 'llave foránea del test realizado',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='puntos acumulados por los usuarios ';

--
-- Volcado de datos para la tabla `points`
--

INSERT INTO `points` (`id`, `point`, `user_id`, `test_id`, `created_at`, `updated_at`) VALUES
(1, '100', 5, 1, '2019-02-13 05:21:16', '2019-02-13 05:21:16'),
(2, '100', 8, 1, '2019-02-13 05:21:16', '2019-02-13 05:21:16'),
(3, '100', 7, 1, '2019-02-13 05:21:16', '2019-02-13 05:21:16'),
(4, '60', 4, 1, '2019-02-13 05:21:16', '2019-02-13 05:21:16'),
(5, '100', 7, 1, '2019-02-13 05:21:16', '2019-02-13 05:21:16'),
(6, '60', 9, 1, '2019-02-13 05:21:16', '2019-02-13 05:21:16'),
(7, '100', 9, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17'),
(8, '100', 7, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17'),
(9, '80', 8, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17'),
(10, '80', 7, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17'),
(11, '60', 7, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17'),
(12, '100', 5, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17'),
(13, '60', 7, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17'),
(14, '20', 7, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17'),
(15, '60', 5, 1, '2019-02-13 05:21:17', '2019-02-13 05:21:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puzzles`
--

CREATE TABLE `puzzles` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'llave primaria',
  `history_id` int(10) UNSIGNED NOT NULL COMMENT 'llave foránea de la historia a la cual pertenece',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'imagen del rompecabezas',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='rompecabezas ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tests`
--

CREATE TABLE `tests` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'llave primaria',
  `history_id` int(10) UNSIGNED NOT NULL COMMENT 'llave foránea de la historia a la cual pertenece',
  `questions` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'pregunta del test, aquí se guarda un objeto JSON ',
  `second_question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '25' COMMENT 'segundos para contestar la pregunta',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='tests';

--
-- Volcado de datos para la tabla `tests`
--

INSERT INTO `tests` (`id`, `history_id`, `questions`, `second_question`, `created_at`, `updated_at`) VALUES
(1, 4, '[{"id":null,"_id":"15486822081717Iare","question":"Pregunta 1","options":[{"op":"Opci\\u00f3n","check":false,"_id":1548682208171},{"op":"Opci\\u00f3n","check":false,"_id":1548682208172},{"op":"Opci\\u00f3n","check":false,"_id":1548682208172},{"op":"BN","check":true,"_id":1548682208172}]},{"id":null,"_id":"154868220817390LmG","question":"Pregunta 2","options":[{"op":"Opci\\u00f3n","check":false,"_id":1548682208173},{"op":"Opci\\u00f3n","check":false,"_id":1548682208173},{"op":"Opci\\u00f3n","check":false,"_id":1548682208173},{"op":"BN","check":true,"_id":1548682208173}]},{"id":null,"_id":"1548682208173p9s8W","question":"Pregunta 3","options":[{"op":"Opci\\u00f3n","check":false,"_id":1548682208173},{"op":"Opci\\u00f3n","check":false,"_id":1548682208173},{"op":"Opci\\u00f3n","check":false,"_id":1548682208173},{"op":"BN","check":true,"_id":1548682208173}]},{"id":null,"_id":"1548682208174ck1M7","question":"Pregunta 4","options":[{"op":"Opci\\u00f3n","check":false,"_id":1548682208174},{"op":"Opci\\u00f3n","check":false,"_id":1548682208174},{"op":"Opci\\u00f3n","check":false,"_id":1548682208174},{"op":"BN","check":true,"_id":1548682208174}]},{"id":null,"_id":"1548682208174M4r6t","question":"Pregunta 5","options":[{"op":"Opci\\u00f3n","check":false,"_id":1548682208174},{"op":"Opci\\u00f3n","check":false,"_id":1548682208174},{"op":"Opci\\u00f3n","check":false,"_id":1548682208174},{"op":"BN","check":true,"_id":1548682208174}]}]', '25', '2019-02-13 05:21:14', '2019-02-13 05:21:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'llave primaria',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre de usuario',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'correo del usuario',
  `email_verified_at` timestamp NULL DEFAULT NULL COMMENT 'fecha de la verificación de la cuenta, "este campo lo implementa laravel por defecto para la verificación de cuenta"  ',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'contraseña de acceso del usuario ',
  `rol` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user' COMMENT 'rol de usuario',
  `status` enum('active','deactivated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'estatus del usuario',
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png' COMMENT 'avatar del usuario',
  `birthdate` date DEFAULT NULL COMMENT 'fecha de nacimiento para determinar a que categoría pertenece ',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'este es el campo para la recuperación de contraseña que usa laravel por defecto',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de creación',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='usuarios';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rol`, `status`, `avatar`, `birthdate`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$ylEE0NHE7lU2t6nu.7bxuO7RNeOMWg7sUf9hjV24ej4oME2mIXch2', 'admin', 'active', 'avatar.png', '1996-05-17', NULL, '2019-02-13 05:20:56', '2019-02-13 05:20:56'),
(2, 'orlenmar', 'orlenmar@gmail.com', NULL, '$2y$10$ZfZbycx6exIkuTfiLE3bquZx1bX8oO99cFP9WqQhHf9WdnPonrM/G', 'user', 'active', 'avatar.png', '1996-05-17', NULL, '2019-02-13 05:20:56', '2019-02-13 05:20:56'),
(3, 'juvenil', 'juvenil@gmail.com', NULL, '$2y$10$0FbGf74RB38HBDLJJpJLjuDw58hjDQG84fVLxAmDqhlm91MO4FQMi', 'user', 'active', 'avatar.png', '2004-05-17', NULL, '2019-02-13 05:20:56', '2019-02-13 05:20:56'),
(4, 'Edison Considine PhD', 'heaney.darren@example.com', NULL, '$2y$10$bQHmVxfGKFkzGY.g1Sf1R.jzBUTMq4HSYOvfwBoJvbtdtNdfktMAa', 'user', 'active', 'avatar.png', '2005-11-20', NULL, '2019-02-13 05:20:56', '2019-02-13 05:20:56'),
(5, 'Jarrett Harber', 'ellie.oberbrunner@example.com', NULL, '$2y$10$8IsiG0fyNfpjsb1NoO309.W0UKsdXKlfxPUZNK.Mddp9ATqZle25u', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:20:57', '2019-02-13 05:20:57'),
(6, 'Dr. Ryder Deckow', 'dana55@example.org', NULL, '$2y$10$7OTqn3v8uJNDsh8AwQICHuWpzTdIL8qPUBfrutCGl61l3BD0WnZ32', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:20:57', '2019-02-13 05:20:57'),
(7, 'Maxime Cole', 'myriam.murazik@example.org', NULL, '$2y$10$yEJdSPZPXmD7RAjbYzDEY.1eJEI0fMdc8Tv5BC/igdEbTPGxEE7Wy', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:20:57', '2019-02-13 05:20:57'),
(8, 'Juvenal Upton', 'jaren.okeefe@example.org', NULL, '$2y$10$5rEiZMCzHRLE14Sz5hCyRO8l7NfgwIWOKgcVIS4h75NEbxKg/L.r6', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:20:57', '2019-02-13 05:20:57'),
(9, 'Harley Kling II', 'schulist.zelda@example.com', NULL, '$2y$10$2WPIxdKVB9vxFbt..E420.Qn42w5MIkM/KoFw9Sue4uyV.pttr/BS', 'user', 'active', 'avatar.png', '2005-11-20', NULL, '2019-02-13 05:20:57', '2019-02-13 05:20:57'),
(10, 'Brenda Williamson', 'uledner@example.org', NULL, '$2y$10$FR7y2p83VjbPenyWIzdiZ.Bw4Pf9.ATqXb7xZBHhHGSzbt.BAB5U6', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:20:57', '2019-02-13 05:20:57'),
(11, 'Mr. Jimmie Dicki', 'consuelo.leannon@example.net', NULL, '$2y$10$DaVdWYlUmQETdXsqN.ID7OKdyBu1T583uMXprcba/ZajD/Twn.w0a', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:20:58', '2019-02-13 05:20:58'),
(12, 'Camden Renner', 'erdman.tiana@example.net', NULL, '$2y$10$FQJ9o4AjzsObhMn5oU9mpuUK3b7TsGSkwYnSP.l0xgQ37qXNPrKB2', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:20:58', '2019-02-13 05:20:58'),
(13, 'Peter Bruen DDS', 'upredovic@example.org', NULL, '$2y$10$k9HkrzDKEp.Mbq4ekCKsAOkynyWV3CTxbzMNvfwJyDLo7JxvEpgjC', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:20:58', '2019-02-13 05:20:58'),
(14, 'Reyes Dicki', 'elizabeth42@example.com', NULL, '$2y$10$D.sx/jqd3EAN0kG5QBizhua7Skdsza.gOi2kbquwtZmKLQQe3FRhC', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:20:58', '2019-02-13 05:20:58'),
(15, 'Cristal Brekke DVM', 'gianni.johnson@example.net', NULL, '$2y$10$DJvsHBw47f1OqBMfIMG9buTXPsZ8IFrpBsZMVKlikqvuV.zYJofHC', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:20:58', '2019-02-13 05:20:58'),
(16, 'Dr. Lloyd Klein Sr.', 'lockman.lee@example.org', NULL, '$2y$10$TWj1DBsYKpRUKuQWlZwFHe.of2wHQx70i1LnA/qNXj3AugG/6uhpG', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:20:58', '2019-02-13 05:20:58'),
(17, 'Jeramy Walker', 'gerald08@example.org', NULL, '$2y$10$Ar/B3ZsWVP6cc8uLgf6c9uqkJMSP1K/29DpvCDvZygM3lhb6nPIbO', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:20:59', '2019-02-13 05:20:59'),
(18, 'Lucius Ullrich', 'althea.west@example.net', NULL, '$2y$10$qGTMj.6NTSFT1.z3z0Xq5e9il8nYVIj.sNRIJHvZldL3tl4zdlBJS', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:20:59', '2019-02-13 05:20:59'),
(19, 'Miss Clarissa Jerde', 'malvina.beahan@example.org', NULL, '$2y$10$kHThqZxUVGZYIUcKiMuRmeTJ/kbaYBdSoQB3GmyRMqzHlfXKjKfmm', 'user', 'active', 'avatar.png', '2005-11-20', NULL, '2019-02-13 05:20:59', '2019-02-13 05:20:59'),
(20, 'Mrs. Lenna Denesik PhD', 'kailey.nienow@example.org', NULL, '$2y$10$VjWruuheUy6ey1f3IPFtgedN53WYFRYT2iz2vpuJr24BhZsAJbkYm', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:20:59', '2019-02-13 05:20:59'),
(21, 'Hulda Armstrong Jr.', 'tyreek.blanda@example.org', NULL, '$2y$10$jwrvgzCwsGH934LqZBIMvebZRRC3sVFThjPzK8V7Ed8pzziP7v1mu', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:20:59', '2019-02-13 05:20:59'),
(22, 'Merlin Steuber', 'layne75@example.net', NULL, '$2y$10$UkhvtKd3OvKQdzTLsLJvq.8GFn9jTq0tmMK52JSY8fLOvOv5Y3j4q', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:20:59', '2019-02-13 05:20:59'),
(23, 'Elise Pollich', 'zulauf.isobel@example.net', NULL, '$2y$10$IV8lWH/qE2SeYab13vEOiuPk7DtjZElyNiVmieE9UalJxQNn1m9Vi', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:21:00', '2019-02-13 05:21:00'),
(24, 'Mr. Brando Howe', 'rubie.upton@example.net', NULL, '$2y$10$kTGWoVuwSJGW6BceSuNUeO9O8tqJMowdmpjxb0LcfThshp2mZEqV6', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:21:00', '2019-02-13 05:21:00'),
(25, 'Adolph Braun', 'wilderman.eveline@example.org', NULL, '$2y$10$Foz2r3LzxfiBolkAO1oaUuKeeFQc6tvBUzLeNxL/gSsimmZVv8YPi', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:00', '2019-02-13 05:21:00'),
(26, 'Nyasia O\'Connell', 'octavia.donnelly@example.org', NULL, '$2y$10$vOjBfJyV7S55kYD.ma0a7.0RDBj2w85Vji5jnNe8da2JKZigIYUeW', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:00', '2019-02-13 05:21:00'),
(27, 'Viva Okuneva', 'aiden62@example.net', NULL, '$2y$10$SbjemYussK8NBX90Vq0R7.MuLHzDbJ1huQpJFYA5YEjIrv0v9xtqO', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:00', '2019-02-13 05:21:00'),
(28, 'Winfield McCullough', 'bfay@example.com', NULL, '$2y$10$FcJTOUgZMxNezl9yGwdm7eiTAB9ng4czZk5JeRdsPQyEVyDc4qf1G', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:21:01', '2019-02-13 05:21:01'),
(29, 'Mrs. Leanna Doyle', 'kallie95@example.com', NULL, '$2y$10$C04Q74cZY6taXjL3mz.VbexkvlGCNMPbmXr5xDia6137tj/.iyhru', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:01', '2019-02-13 05:21:01'),
(30, 'Berniece Abernathy III', 'emily63@example.com', NULL, '$2y$10$1CdPQTE/XOhoUL1rhB2CmuG6FUSeOAf.WoffSh0cTHu4WyK0jRDjC', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:21:01', '2019-02-13 05:21:01'),
(31, 'Josiane Kunde', 'vcartwright@example.net', NULL, '$2y$10$JDxE8FmekORfj15lxiETZ.Dfo4aiQ7VW.iHmOtAVwgXQZvI.0c0oC', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:21:01', '2019-02-13 05:21:01'),
(32, 'Kenton Runte II', 'kasandra.gutmann@example.com', NULL, '$2y$10$C7X.PjYKXawNZE2e/qCECuCEN3hGAQTdgNKWSKsvWJmyWDSXjMKOK', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:01', '2019-02-13 05:21:01'),
(33, 'Katelin Abernathy', 'braulio29@example.org', NULL, '$2y$10$3E4BcXfFAvoMEV4hFNFj7e.SV4ShtfFJzUkHroye5OHdsOTxNYKgK', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:01', '2019-02-13 05:21:01'),
(34, 'Hilton Nicolas', 'uhettinger@example.org', NULL, '$2y$10$YXjDIpSYMs.0bR85kKMBKufz4iOQoNEQuQC3zWqhDgkWZKGPm6WZi', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:01', '2019-02-13 05:21:01'),
(35, 'Josephine Oberbrunner', 'snicolas@example.com', NULL, '$2y$10$9cni2VWPIpBgf5t7U7eiC.MaEn693HlZlny9.8aIyX8v/lPyCa4Ki', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:21:02', '2019-02-13 05:21:02'),
(36, 'Monserrat Kreiger', 'hahn.korey@example.com', NULL, '$2y$10$OHLDT53CahEcQxZkZutd1OVTgdyjcIbfLObDOnt6gE3GPi0T9xLTK', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:02', '2019-02-13 05:21:02'),
(37, 'Anika Witting DVM', 'jokon@example.org', NULL, '$2y$10$vu9flScnBYw80ZxCbH.PCue1a0usvEmu.TLPLH0WDVg3kHUieOZX2', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:02', '2019-02-13 05:21:02'),
(38, 'Darius McCullough', 'roberts.winnifred@example.org', NULL, '$2y$10$RKyWIe9HYwjmzWPTXHaWVOjqDSd9ZzPZAEEbo/lS0ZP4bPcZtorw2', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:02', '2019-02-13 05:21:02'),
(39, 'Haleigh Wilkinson', 'stehr.nickolas@example.net', NULL, '$2y$10$dx93kpxfuked.200gwAJCevNM4yLMgmdWlJ2nS92pIZhGcpv13A/a', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:02', '2019-02-13 05:21:02'),
(40, 'Easter Kuhic', 'marvin.assunta@example.net', NULL, '$2y$10$XElqY5AyiPONWTLpufvnI.ZknCq6aZnGgrH6PErzSq1aK1QNNbyoW', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:02', '2019-02-13 05:21:02'),
(41, 'Elta Casper', 'gloria.skiles@example.net', NULL, '$2y$10$0TwohQ4LSbZ0bu.vKd5Jr.BJ1dpKYYmvaXkXNqyZ88F.qIgBnDWuK', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:03', '2019-02-13 05:21:03'),
(42, 'Fannie Osinski DDS', 'darby72@example.org', NULL, '$2y$10$5TLBgz7QXW4jxZu.ARV7D.lZO6P.495uoBnUlPuj..Zyk4A0dkz3m', 'user', 'active', 'avatar.png', '2005-11-20', NULL, '2019-02-13 05:21:03', '2019-02-13 05:21:03'),
(43, 'Yasmin Runolfsson I', 'buster.brakus@example.com', NULL, '$2y$10$5azy9cJ7COEAQoVAMTzd4OspoTx6CygDI.QBSFYCB394/KykwjKRG', 'user', 'active', 'avatar.png', '2010-01-02', NULL, '2019-02-13 05:21:03', '2019-02-13 05:21:03'),
(44, 'Edwina Wolff', 'deon.kuphal@example.org', NULL, '$2y$10$NfD/dS5wLh.6JkG4Y1s/1.sXwsknIT3cfwu.N5ZwMWxFiwu.dn/HC', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:03', '2019-02-13 05:21:03'),
(45, 'Cortez Crona', 'lexus.effertz@example.org', NULL, '$2y$10$ycHRR70RrOz46AYrspoG0uYmpePqPfYhvpCkHlf2peV679YMXzpCy', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:03', '2019-02-13 05:21:03'),
(46, 'Marlon Friesen', 'veum.oscar@example.com', NULL, '$2y$10$.MpiulOlKpD12xXK3t9qO.He8H1Zsef2FzlR/xs5n2QHipsQHsAL.', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:04', '2019-02-13 05:21:04'),
(47, 'Crystel Bernhard', 'schmeler.alex@example.com', NULL, '$2y$10$Lc7IVFwZPBfglgTZlHciAuevL.ZjpzB3NithFWfrMopGePAavnPJa', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:21:04', '2019-02-13 05:21:04'),
(48, 'Kari Spencer', 'rickie.wilderman@example.net', NULL, '$2y$10$73te99FuKFcdwhtSZ6p09uZkz6/rIDQenLvfNZ3iNsD/kiy1uPAcm', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:21:04', '2019-02-13 05:21:04'),
(49, 'Dr. Augustus Padberg I', 'barney05@example.org', NULL, '$2y$10$PnSE4TMoxp26kzYEQfOCLuJBR6srqJ77bBZGAp276v4FI2MWAzEj2', 'user', 'active', 'avatar.png', '2005-11-20', NULL, '2019-02-13 05:21:04', '2019-02-13 05:21:04'),
(50, 'Ressie Hermiston', 'rylee32@example.org', NULL, '$2y$10$pg5AtUZ6cMTxEa.kCzjRbehsN3HGjSfvjwhBZPqez2icKJZceUgJa', 'user', 'active', 'avatar.png', '2010-01-02', NULL, '2019-02-13 05:21:04', '2019-02-13 05:21:04'),
(51, 'Elijah Koch', 'karlie73@example.com', NULL, '$2y$10$W6RBHs2MDrnc1vdFZv0MQOCEF.ASej7SpSP83.HreGYPllGpComi2', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:05', '2019-02-13 05:21:05'),
(52, 'Leanne Streich', 'eileen07@example.org', NULL, '$2y$10$4xDunEVldIpgYo7r32jb4OrUwyZ2MFPQNOhWDWJuWy8a43Y6A5KZK', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:05', '2019-02-13 05:21:05'),
(53, 'Catharine Osinski', 'jgottlieb@example.com', NULL, '$2y$10$Dmf6sE6aWMjSBzffhkYiaeIu4AgSWcp6KNruRvV08cETaUHdf/yLW', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:05', '2019-02-13 05:21:05'),
(54, 'Monroe Prosacco', 'fsmith@example.net', NULL, '$2y$10$2dG2K3q.RuVeMLF1c5dKN.4JFhfkPqUGgNaGRcWwmNxYsxEVeFv0O', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:05', '2019-02-13 05:21:05'),
(55, 'Margarett Nicolas', 'eric.bartell@example.org', NULL, '$2y$10$GdidZnn3mvOdyVFg8XzLLeavmJxhgDADJuwXCSDWdtgVH4H.PevoS', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:21:05', '2019-02-13 05:21:05'),
(56, 'Tressa Ferry', 'bdavis@example.org', NULL, '$2y$10$F0Bx0lCrvApCfXj6yssOae3Q/cNbwZ.r4zfntP.hWFoaM.omK5YAq', 'user', 'active', 'avatar.png', '2005-11-20', NULL, '2019-02-13 05:21:06', '2019-02-13 05:21:06'),
(57, 'Mrs. Maye Kirlin', 'wcartwright@example.org', NULL, '$2y$10$luaEEnYkU6HYIgAED6C6Z.MriGwo5lVYGlvgI9fM8QCx3J01n.Tsq', 'user', 'active', 'avatar.png', '2005-11-20', NULL, '2019-02-13 05:21:06', '2019-02-13 05:21:06'),
(58, 'Godfrey Leannon', 'kgreen@example.com', NULL, '$2y$10$rNseMzDRaDKzj1dTB/6MU.2slDnAgMKvCuxxYVyEv6k6pvJoXO0Eu', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:06', '2019-02-13 05:21:06'),
(59, 'Mr. Lawson Becker', 'ogleason@example.org', NULL, '$2y$10$bGjt4vUpuM67gJMW9dO.Ku3HIgrgwpvgF/NEXnCmYFURciDFbKHZW', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:06', '2019-02-13 05:21:06'),
(60, 'Laurie King', 'ollie.deckow@example.org', NULL, '$2y$10$6apTjz2oA/717mqQN8lW8.nzQgyRnLRy.MyZS3kqz/QlFiNfOKNCC', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:07', '2019-02-13 05:21:07'),
(61, 'Maddison Smitham', 'leon.hill@example.org', NULL, '$2y$10$jebEXnuYc8BaAjQElMp2VeHmyLAlOZN6o5Sj9aoTpcFdvYKySy0Jq', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:07', '2019-02-13 05:21:07'),
(62, 'Dameon Trantow', 'hosea.haley@example.com', NULL, '$2y$10$2yf/JpziRTfh6eEQVEqEueDm3OzwY3I4GJas85QM9itnZGp8G3Q6m', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:07', '2019-02-13 05:21:07'),
(63, 'Keyshawn Jones', 'fwuckert@example.net', NULL, '$2y$10$I81H8.LuPl9SsydpFrZeIOYDn8aywnAcQ3Rwh6hIZDdi7ukXSRu6S', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:07', '2019-02-13 05:21:07'),
(64, 'Palma Runolfsdottir', 'paige16@example.com', NULL, '$2y$10$FNeCVuMa2RkQiVJNcpll2.CU0JVHvzPB7pa9wJSDiKTKvuQgaDrVm', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:21:07', '2019-02-13 05:21:07'),
(65, 'Ron Reynolds II', 'chloe.gutkowski@example.net', NULL, '$2y$10$4Sxc2HQwKcYykEB6eJz.SevKho7TNre44iCQL3kmZ3a49BKA0IIY6', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:08', '2019-02-13 05:21:08'),
(66, 'Tressa Conn', 'reinger.savanna@example.org', NULL, '$2y$10$G7sFplPxWptUDLdU5TWDXu6cOfQsCt6QRWKk77kC4.c.NNFnUQbfy', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:08', '2019-02-13 05:21:08'),
(67, 'Imelda Aufderhar', 'evie.mraz@example.net', NULL, '$2y$10$64Oi1Xj4.TLQw49d1qagzugqbAlWOb2DWnWSKQpemdfHQt19Jgcky', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:08', '2019-02-13 05:21:08'),
(68, 'Magdalena Weimann', 'bria.bode@example.org', NULL, '$2y$10$QCdHsPn4ZpBWVs6UEHRW5umbf7p1ruAfILuWvuZxS7qQsM2BS8Xim', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:08', '2019-02-13 05:21:08'),
(69, 'Mertie Abernathy', 'klebsack@example.net', NULL, '$2y$10$r6UKdQWzq0TnQRkcsAqc0ulpzQ.lbDMJRGj3aLzh9F4pVIZV7oHH2', 'user', 'active', 'avatar.png', '2010-01-02', NULL, '2019-02-13 05:21:08', '2019-02-13 05:21:08'),
(70, 'Velva Conn', 'alison.fahey@example.com', NULL, '$2y$10$kJGbCgXurL/EPO0uu7QyPujRQxffZiAk02vGfHILCt37MgpcUo4bW', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:21:08', '2019-02-13 05:21:08'),
(71, 'Arely Schuster', 'eldred18@example.com', NULL, '$2y$10$WIOb0kYdIIXVBpLoFx9AQeUe12C/c0hEL4HmTCtEAedu2xylPxW/i', 'user', 'active', 'avatar.png', '1996-09-20', NULL, '2019-02-13 05:21:09', '2019-02-13 05:21:09'),
(72, 'Tiffany Lueilwitz', 'connie.carter@example.net', NULL, '$2y$10$CSIBVmpmRpbk.mBlN3WJ.Oda65VL74auncONT.feNlPnrCUuchJJ6', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:09', '2019-02-13 05:21:09'),
(73, 'Hanna Dooley', 'pbrown@example.org', NULL, '$2y$10$eLH/0DYad98W.5ZgV5uxR.RSK3ghsWMwwB/4p27OyGHcx2Qm30GAO', 'user', 'active', 'avatar.png', '2010-01-02', NULL, '2019-02-13 05:21:09', '2019-02-13 05:21:09'),
(74, 'Ryley Shanahan', 'oreichert@example.net', NULL, '$2y$10$ug8kNuU2GGpyLfAm7woOYe.3xdtzvAvsk1e51eB0HbU.vTPett9pK', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:09', '2019-02-13 05:21:09'),
(75, 'Prof. Adolph Wunsch DDS', 'lebsack.gunnar@example.net', NULL, '$2y$10$6NggNh7DlaeCvwtzX2Q/1eU1VNlQbXKIH2kmpbD4sS2WoZhm3JlIq', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:21:09', '2019-02-13 05:21:09'),
(76, 'Dr. Isabella Beier DVM', 'stanford.johns@example.org', NULL, '$2y$10$96HhTNLBzgL0kJYtYslR/Ot9tvxCB0InWQnh5Y0/qc7qDwY5UwzFG', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:09', '2019-02-13 05:21:09'),
(77, 'Leonora Schaefer I', 'luis.franecki@example.com', NULL, '$2y$10$XH.paTBMHjgtZMo9RDQwvuc6E6o4u5FLRkJeV6fibrp1pof6OE8nS', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:21:10', '2019-02-13 05:21:10'),
(78, 'Niko Little', 'cecil26@example.net', NULL, '$2y$10$3yTQcdBEGU2./7riWHxr3.wEI5lATJtYynvuc/wyopfm5RJE0dpda', 'user', 'active', 'avatar.png', '2005-11-20', NULL, '2019-02-13 05:21:10', '2019-02-13 05:21:10'),
(79, 'Yasmine Rippin', 'hansen.marisa@example.org', NULL, '$2y$10$spQg8by5/sL2cMOhyCqHVeYVUvaN2mac6PmxwcFT9Vdkdkb19jhSO', 'user', 'active', 'avatar.png', '2007-12-31', NULL, '2019-02-13 05:21:10', '2019-02-13 05:21:10'),
(80, 'Gilbert Hilpert', 'felipa06@example.com', NULL, '$2y$10$X3anzOJ7PKC6M76ORxH9lu9IpxfmMlSvFrJKC4GqaG9b6BqBimcUm', 'user', 'active', 'avatar.png', '2008-01-01', NULL, '2019-02-13 05:21:10', '2019-02-13 05:21:10'),
(81, 'Miss Aaliyah Skiles PhD', 'bernhard.fernando@example.org', NULL, '$2y$10$fVbNSd4NvJjrqCPwiGOCZOom5eljrH8W6EYN9BKYb9hGTiLaJVZ9q', 'user', 'active', 'avatar.png', '2006-12-01', NULL, '2019-02-13 05:21:10', '2019-02-13 05:21:10'),
(82, 'Gilda Lind', 'presley.tillman@example.org', NULL, '$2y$10$DW5jC9tdKJTgfANHsCApDecvmPp2OIcOjwKFVGLF880dchw.g37KS', 'user', 'active', 'avatar.png', '1991-09-01', NULL, '2019-02-13 05:21:10', '2019-02-13 05:21:10'),
(83, 'Dr. Shemar Gibson IV', 'burdette65@example.org', NULL, '$2y$10$DwIIf0NxUOFndoiAghZqweioF1KE7.rIV2.X6SRCPeXxSGaIzUrg.', 'user', 'active', 'avatar.png', '2000-11-10', NULL, '2019-02-13 05:21:11', '2019-02-13 05:21:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histories_user_id_foreign` (`user_id`),
  ADD KEY `histories_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `letter_soups`
--
ALTER TABLE `letter_soups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `letter_soups_history_id_foreign` (`history_id`);

--
-- Indices de la tabla `memories`
--
ALTER TABLE `memories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memories_history_id_foreign` (`history_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `points_user_id_foreign` (`user_id`),
  ADD KEY `points_test_id_foreign` (`test_id`);

--
-- Indices de la tabla `puzzles`
--
ALTER TABLE `puzzles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `puzzles_history_id_foreign` (`history_id`);

--
-- Indices de la tabla `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tests_history_id_foreign` (`history_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'llave primaria', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'llave primaria', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `letter_soups`
--
ALTER TABLE `letter_soups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'llave primaria', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `memories`
--
ALTER TABLE `memories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'llave primaria', AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `points`
--
ALTER TABLE `points`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'llave primaria', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `puzzles`
--
ALTER TABLE `puzzles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'llave primaria';
--
-- AUTO_INCREMENT de la tabla `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'llave primaria', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'llave primaria', AUTO_INCREMENT=84;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `letter_soups`
--
ALTER TABLE `letter_soups`
  ADD CONSTRAINT `letter_soups_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `histories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `memories`
--
ALTER TABLE `memories`
  ADD CONSTRAINT `memories_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `histories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `puzzles`
--
ALTER TABLE `puzzles`
  ADD CONSTRAINT `puzzles_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `histories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `histories` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
