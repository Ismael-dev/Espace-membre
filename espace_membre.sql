
--
-- Base de données :  `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(60) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_creation` text NOT NULL,
  `date_connexion` text,
  `nbr_connexion` int(60) unsigned NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

