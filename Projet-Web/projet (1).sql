-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 13 mars 2024 à 01:07
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `AjoutDate`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `AjoutDate` (IN `nom_i` VARCHAR(100), IN `new_date` DATE)   BEGIN 
UPDATE idees
SET  date_i= new_date
WHERE nom_i = nom_i;

END$$

DROP PROCEDURE IF EXISTS `AjouterIdee`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `AjouterIdee` (IN `nom_i` VARCHAR(50), IN `description_i` VARCHAR(500), IN `image_i` VARCHAR(100), IN `mail_i` VARCHAR(100))   BEGIN
    INSERT INTO idees (nom_i, description_i,image_i,mail_i)
    VALUES (nom_i, description_i,image_i,mail_i);
END$$

DROP PROCEDURE IF EXISTS `AjoutUtilisateur`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `AjoutUtilisateur` (IN `mail` VARCHAR(50), IN `nom_u` VARCHAR(100), IN `prenom_u` VARCHAR(100), IN `password` VARCHAR(8), IN `localisation` VARCHAR(50), IN `statut` VARCHAR(50))   BEGIN
    INSERT INTO utilisateurs (mail,nom_u, prenom_u,password,localisation,statut)
    VALUES (mail,nom_u, prenom_u,password,localisation,statut);
END$$

DROP PROCEDURE IF EXISTS `Inscription`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `Inscription` (IN `nom_inscrit` VARCHAR(50), IN `mail` VARCHAR(100), IN `nom_manifestation` VARCHAR(100))   BEGIN
    INSERT INTO inscrit (mail,nom_inscrit,nom_manifestation)
    VALUES (mail,nom_inscrit,nom_manifestation);
END$$

DROP PROCEDURE IF EXISTS `modificationevenementpasse`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `modificationevenementpasse` (IN `nom` VARCHAR(100), IN `new_image` VARCHAR(100))   BEGIN 
UPDATE evenements
SET    image_e = new_image

WHERE nom = nom_e;

END$$

DROP PROCEDURE IF EXISTS `ModificationIdee`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `ModificationIdee` (IN `nom_i` VARCHAR(100), IN `new_description` VARCHAR(500), IN `new_image` VARCHAR(50))   BEGIN 
UPDATE idees
SET  description_i = new_description, image_i = new_image

WHERE nom_i = nom_i;

END$$

DROP PROCEDURE IF EXISTS `PostEvenement`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `PostEvenement` (IN `nom_e` VARCHAR(50), IN `description_e` VARCHAR(500), IN `image_e` VARCHAR(500), IN `date_e` DATE, IN `prix_e` INT)   BEGIN
 INSERT INTO evenements (nom_e,description_e,image_e,date_e,prix_e )
 VALUES (nom_e,description_e,image_e,date_e,prix_e );
END$$

DROP PROCEDURE IF EXISTS `RecupereIdee`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `RecupereIdee` ()   BEGIN
    SELECT * FROM idees;
END$$

DROP PROCEDURE IF EXISTS `Recupereinscrits`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `Recupereinscrits` ()   BEGIN
SELECT * FROM inscrit ;
END$$

DROP PROCEDURE IF EXISTS `recupredate`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `recupredate` (IN `eventName` VARCHAR(100), OUT `eventDate` DATE)   BEGIN
    SELECT date_e INTO eventDate
    FROM evenements
    WHERE nom_e = eventName;
END$$

DROP PROCEDURE IF EXISTS `suppresionevenementpasse`$$
CREATE DEFINER=`triplek`@`localhost` PROCEDURE `suppresionevenementpasse` (IN `new_nom` VARCHAR(100), IN `new_commentaire` VARCHAR(100))   UPDATE evenements
SET commentaires_e = NULL
WHERE new_nom = nom_e
AND new_commentaire = commentaires_e$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `nom_a` varchar(50) NOT NULL,
  `description_a` varchar(500) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `prix` int NOT NULL,
  `nbreCommandes` int DEFAULT NULL,
  PRIMARY KEY (`nom_a`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `nom_e` varchar(50) NOT NULL,
  `description_e` varchar(500) NOT NULL,
  `image_e` varchar(500) DEFAULT NULL,
  `date_e` date NOT NULL,
  `commentaires_e` varchar(500) DEFAULT NULL,
  `likes_e` int DEFAULT NULL,
  `prix_e` int DEFAULT NULL,
  PRIMARY KEY (`nom_e`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`nom_e`, `description_e`, `image_e`, `date_e`, `commentaires_e`, `likes_e`, `prix_e`) VALUES
('sante', '\"Rejoignez-nous pour une journée de conférences fascinantes sur l\'Intelligence Artificielle (IA) et ses implications dans divers domaines, tels que la santé, les transports, l\'éducation et bien d\'autres. Des experts renommés partageront leurs connaissances et leurs perspectives sur les dernières avancées et les défis à venir dans le domaine de l\'IA. Que vous soyez un professionnel de la technologie, un chercheur, un étudiant ou simplement curieux de découvrir les nouvelles tendances de l\'IA, cet', 'p.jpg', '2024-04-01', 'rien', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `idees`
--

DROP TABLE IF EXISTS `idees`;
CREATE TABLE IF NOT EXISTS `idees` (
  `nom_i` varchar(50) NOT NULL,
  `description_i` varchar(500) NOT NULL,
  `likes_i` int DEFAULT NULL,
  `image_i` varchar(100) DEFAULT NULL,
  `date_i` date DEFAULT NULL,
  `mail_i` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nom_i`),
  KEY `mail_i` (`mail_i`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `idees`
--

INSERT INTO `idees` (`nom_i`, `description_i`, `likes_i`, `image_i`, `date_i`, `mail_i`) VALUES
('maff', 'rien pour ', NULL, 'Be.jpg', NULL, 'triplek');

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

DROP TABLE IF EXISTS `inscrit`;
CREATE TABLE IF NOT EXISTS `inscrit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) NOT NULL,
  `nom_inscrit` varchar(100) DEFAULT NULL,
  `nom_manifestation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mail` (`mail`),
  KEY `nom_manifestation` (`nom_manifestation`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) NOT NULL,
  `nom_a` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `mail` varchar(50) NOT NULL,
  `nom_u` varchar(100) NOT NULL,
  `prenom_u` varchar(100) NOT NULL,
  `password` char(8) NOT NULL,
  `localisation` varchar(50) NOT NULL,
  `statut` varchar(50) NOT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`mail`, `nom_u`, `prenom_u`, `password`, `localisation`, `statut`) VALUES
('tyron', 'fotso', 'francky', 'K3m@j0uK', 'yaounde', 'etudiant'),
('triplek', 'kemajou', 'kerry Kate', 'K3m@j0uK', 'yaounde', 'etudiant'),
('kerry', 'ryan', 'topi', 'K3m@j0uK', 'yaounde', 'etudiant');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
