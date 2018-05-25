-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2018 at 03:47 PM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.2.5-1+0~20180505045740.21+stretch~1.gbpca2fa6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datecreate` datetime NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `idcategory` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `name`, `tagline`, `detail`, `url`, `image`, `datecreate`, `dateupdate`, `idcategory`, `iduser`) VALUES
(1, 'Symfony', 'Framework PHP', 'Symfony est un ensemble de composants PHP réutilisables et un framework PHP pour créer des applications web, des API, des microservices et des services web.', 'https://symfony.com/', 'https://symfony.com/images/v5/pictos/home-main-illu.svg', '2018-05-22 12:00:00', NULL, 2, NULL),
(2, 'Youtube', 'Plateforme de vidéo en ligne', 'YouTube est un site web d’hébergement de vidéos et un média social sur lequel les utilisateurs peuvent envoyer, évaluer, regarder, commenter et partager des vidéos. Il a été créé en février 2005 par Steve Chen, Chad Hurley et Jawed Karim, trois anciens employés de PayPal et racheté par Google en octobre 2006 pour la somme de 1,65 milliard de dollars9. Le service est situé à San Bruno, en Californie.', 'https://www.youtube.com/', 'https://cdn.earlytorise.com/wp-content/uploads/2017/06/youtube-logo-full-color.png', '2018-05-22 12:00:00', NULL, 2, NULL),
(3, 'Santé Nature Innovation', 'Actualité de la santé naturelle', 'L’aventure Santé Nature Innovation\r\nDe nombreuses personnes souffrent de douleurs ou de maladies chroniques, face auxquelles elles se sentent complètement démunies. Il y a pourtant de grandes chances qu’une solution naturelle et validée par la recherche scientifique existe quelque part dans le monde.\r\n\r\nDe même, il existe de nombreuses manières d’améliorer votre quotidien grâce à quelques bons réflexes et des habitudes saines qui pourront vous apporter, en plus d’un confort immédiat pour vous et vos proches, de nombreuses années de vie en bonne santé.\r\n\r\nPourtant les médias grand public se font rarement l’écho des avancées prodigieuses des médecines naturelles, également appelées « médecines alternatives et complémentaires ». Pas un jour ne passe sans que la science ne vienne valider des traitements naturels de pointe. On trouve aussi de nouvelles vertus aux coutumes oubliées et certains remèdes de « grand-mères » sont redécouverts par les plus grands chercheurs.\r\n\r\nCes informations essentielles seraient sans doute davantage diffusées si elles ne gênaient pas des intérêts puissants et bien organisés. Mais nous croyons qu’il n’y a pas de fatalité.\r\n\r\nC’est pour tous ceux qui ont soif de savoir que Santé Nature Innovation existe.\r\nSanté Nature Innovation est une ligne directe de la recherche scientifique en santé naturelle vers toutes les personnes de bonne volonté qui souhaitent prendre leur santé en main, pratiquement et facilement.\r\n\r\nSon fonctionnement est simple : vous recevez deux à trois lettres d’information par semaine sur la santé naturelle. Elles traitent des grandes maladies comme des petits maux du quotidien, de nutrition, alimentation, habitudes de vie, traitements naturels, réactions aux actualités de santé, avancées de la recherche scientifique… la liste n’est pas exhaustive.\r\n\r\nAvec plus de 800.000 lecteurs réguliers, elle est la lettre sur la santé naturelle la plus lue dans le monde francophone. En plus des nombreuses informations précieuses que vous y lirez, La Lettre Santé Nature Innovation.', 'https://www.santenatureinnovation.com/', 'https://www.santenatureinnovation.com/wp-content/themes/santenatureinnovation/img/logo.png', '2018-05-22 12:00:00', NULL, 2, NULL),
(4, 'OpenClassrooms', 'Plateforme de cours en ligne', 'OpenClassrooms est une école en ligne. Chaque visiteur peut à la fois être un lecteur ou un rédacteur. Les cours peuvent être réalisés aussi bien par des membres, par l\'équipe du site, ou éventuellement par des professeurs d\'universités ou de grandes écoles partenaires. Initialement orientée autour de la programmation informatique, la plate-forme couvre depuis 2013 des thématiques plus larges tels que le marketing, l\'entrepreneuriat et les sciences.', 'https://openclassrooms.com', 'https://upload.wikimedia.org/wikipedia/fr/0/0d/Logo_OpenClassrooms.png', '2018-05-22 12:00:00', NULL, 2, NULL),
(5, 'JeuxVideo.com', 'Site web consacré aux jeux-video', 'Jeuxvideo.com, également stylisé JeuxVideo.com, est un site web français spécialisé dans le jeu vidéo depuis 1997. Il est construit comme un outil d\'information à destination des joueurs par une équipe de rédacteurs et propose notamment des actualités, des dossiers, des tests de jeux vidéo ou des présentations par vidéo. Les rédacteurs se déplacent sur les grands événements mondiaux, comme l\'E3, le Tokyo Game Show, la Gamescom2, la Paris Games Week ou l\'IDEF afin de rencontrer les équipes de développement et suivre les jeux tout au long de leur cycle de vie, du développement jusqu\'à la commercialisation.', 'http://www.jeuxvideo.com/', 'https://upload.wikimedia.org/wikipedia/commons/3/39/Jeuxvideocom.png', '2018-05-22 12:00:00', NULL, 2, NULL),
(6, 'Spotify', 'Plateforme d\'écoute de musique en ligne', 'Spotify est un service suédois de streaming musical sous la forme d\'un logiciel propriétaire et d\'un site web2. Spotify permet une écoute quasi instantanée de fichiers musicaux3. Le catalogue peut être parcouru par artiste ou par album, et également grâce à une fonctionnalité de liste de lecture personnalisée. Une fonction d\'écoute hors connexion est disponible pour les abonnés Premium.\r\n\r\nUn lien est fourni sur certains morceaux du catalogue pour permettre à l\'utilisateur d\'acheter directement le titre via un site marchand partenaire4. Le programme/service, dans sa version gratuite, est uniquement disponible dans une partie de l\'Europe occidentale pendant la version bêta, mais l\'inscription est possible dans presque tous les pays.', 'https://www.spotify.com/fr/', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/26/Spotify_logo_with_text.svg/559px-Spotify_logo_with_text.svg.png', '2018-05-22 12:00:00', NULL, 2, NULL),
(7, 'Fnac.com', 'Site du magasin culturel La Fnac', 'La Fnac (appelée à l\'origine « Fédération nationale d\'achats », puis « Fédération nationale d\'achats des cadres ») est une chaîne de magasins française spécialisée dans la distribution de produits culturels (musique, littérature, cinéma, jeu vidéo) et électroniques (Hi-fi, informatique, télévision), à destination du grand public, dont la gamme s\'est élargie en 2012 au petit électroménager, déjà présent à la création de l\'enseigne et abandonné dans les années 1970. En 2010, ils vendirent Fnac Éveil et jeux et se séparèrent de la filière dédiée aux jeux et jouets pour enfants.', 'https://www.fnac.com', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Fnac_Logo.svg/130px-Fnac_Logo.svg.png', '2018-05-22 12:00:00', NULL, 2, NULL),
(8, 'ZDNet', 'Tout savoir sur les nouvelles technologies', 'ZDNet est un réseau de sites web spécialisés dans les nouvelles de technologie. Détenu par CBS Interactive (filiale de CBS Corporation), il a été fondé le 1er avril 19911 par Ziff Davis. En 2011, le réseau diffuse des nouvelles dans plusieurs langues, dont le français, l\'anglais, l\'allemand et le japonais.', 'http://www.zdnet.fr/', 'https://upload.wikimedia.org/wikipedia/fr/2/20/Logo_ZDNet.PNG', '2018-05-22 12:00:00', NULL, 2, NULL),
(9, 'Marmiton', 'Site de recette de cuisine', 'Marmiton est le premier site de cuisine en France avec 12,8 millions de visiteurs uniques en France1 qui recense plus de 66 000 recettes de cuisine. Les membres du site, sur lequel l\'inscription est gratuite, peuvent apporter des commentaires concernant les recettes du site et proposer leurs propres recettes.', 'http://www.marmiton.org/', 'https://upload.wikimedia.org/wikipedia/fr/3/31/Logo-marmiton-2.gif', '2018-05-22 12:00:00', NULL, 2, NULL),
(10, 'Qwant', 'Moteur de recherche', 'Qwant est un moteur de recherche français, créé le 16 février 2013, puis lancé en version définitive le 4 juillet 2013. Il annonce ne pas tracer ses utilisateurs ni vendre leurs données personnelles afin de garantir leur vie privée et se veut neutre dans l\'affichage des résultats.', 'https://www.qwant.com/', 'https://upload.wikimedia.org/wikipedia/fr/thumb/4/46/Qwant_Logo.svg/339px-Qwant_Logo.svg.png', '2018-05-22 12:00:00', NULL, 2, NULL),
(11, 'Musikhaus Thomann', 'Site d\'achat de matériel et instruments de musique', 'Musikhaus Thomann est une entreprise familiale allemande spécialisée dans la vente et la fabrication d\'instruments de musique ainsi que de matériel et d\'accessoires. Elle fut fondée en 1954 à Treppendorf (petit village appartenant aujourd\'hui à la commune de Burgebrach, en Haute-Franconie) par Hans Thomann senior.', 'https://www.thomann.de/fr/', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Thomann_Unternehmen_logo.svg/280px-Thomann_Unternehmen_logo.svg.png', '2018-05-22 12:00:00', NULL, 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
