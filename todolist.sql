-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 28 Avril 2015 à 09:30
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `todolist`
--

-- --------------------------------------------------------

--
-- Structure de la table `checkeds`
--

CREATE TABLE IF NOT EXISTS `checkeds` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `checkeds`
--

INSERT INTO `checkeds` (`id`, `user_id`, `task_id`, `quantity`, `created`) VALUES
(1, 6, 2, 1, '2015-04-14 00:00:00'),
(2, 8, 1, 1, '2015-04-14 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
`id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `frequency` varchar(256) NOT NULL,
  `expirationDate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `lists`
--

INSERT INTO `lists` (`id`, `name`, `description`, `frequency`, `expirationDate`, `created`, `updated`) VALUES
(1, 'test', 'fj', 'once', '2015-04-18 00:00:00', '2015-04-14 00:00:00', '2015-04-14 05:28:45'),
(16, 'Liste1', '', '1', '2019-12-01 00:00:00', '2015-04-28 09:11:19', '2015-04-28 09:11:19'),
(17, 'Liste2', '', '7', '0000-00-00 00:00:00', '2015-04-28 09:11:55', '2015-04-28 09:11:55'),
(18, 'coucou Damin', '', '30', '0000-00-00 00:00:00', '2015-04-28 09:12:58', '2015-04-28 09:12:58'),
(19, 'uiiuyiuyiuyiuyuiyiuy', '', '30', '0000-00-00 00:00:00', '2015-04-28 09:13:23', '2015-04-28 09:13:23'),
(20, '454545', '', '0', '0000-00-00 00:00:00', '2015-04-28 09:14:43', '2015-04-28 09:14:43'),
(21, '3333', '', '1', '0000-00-00 00:00:00', '2015-04-28 09:16:28', '2015-04-28 09:16:28'),
(22, '111', '', '0', '0000-00-00 00:00:00', '2015-04-28 09:19:00', '2015-04-28 09:19:00'),
(23, 'zrg', '', '0', '2015-10-12 00:00:00', '2015-04-28 09:24:21', '2015-04-28 09:24:21');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to_do_id` int(11) NOT NULL,
  `right_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `to_do_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
`id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `social_profiles`
--

CREATE TABLE IF NOT EXISTS `social_profiles` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `social_network_name` varchar(64) DEFAULT NULL,
  `social_network_id` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `display_name` varchar(128) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `link` varchar(512) NOT NULL,
  `picture` varchar(512) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `social_profiles`
--

INSERT INTO `social_profiles` (`id`, `user_id`, `social_network_name`, `social_network_id`, `email`, `display_name`, `first_name`, `last_name`, `link`, `picture`, `created`, `modified`, `status`) VALUES
(3, 7, 'Facebook', '1426940877617113', 'umutbg54@gmail.com', 'Um Lebg', 'Um', 'Lebg', 'https://www.facebook.com/app_scoped_user_id/1426940877617113/', 'https://graph.facebook.com/1426940877617113/picture?width=150&height=150', '2015-03-30 11:51:03', '2015-03-30 11:51:03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
`id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `to_do_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `quantity`, `created`, `updated`, `to_do_id`) VALUES
(1, 'cvdqsGDFF', 1, '2015-04-14 00:00:00', '2015-04-14 00:00:00', 1),
(2, 'kkkkkkkk', 3, '2015-04-14 00:00:00', '2015-04-14 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `age` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `age`, `created`, `modified`, `status`) VALUES
(2, 'umut', 'azertyuiop', 'um@um.fr', 0, '2015-03-30 22:41:03', '2015-03-30 22:41:03', 1),
(6, 'azerty', '511bec230d638d660e2f3839fb00417775f2d47c', '1223@123.fr', 18, '2015-03-30 23:29:11', '2015-03-30 23:29:11', 1),
(7, 'Um_Lebg', 'f16e0dad305c1ea974c4827bf35f099b8de84c00', 'umutbg54@gmail.com', 0, '2015-03-30 11:45:33', '2015-03-30 11:45:33', 1),
(8, 'nico', 'ab90f8ed40e3e23ab72ed288fdbee63ea4b2896a', 'nico@nico.fr', 13, '2015-04-14 14:10:54', '2015-04-14 14:10:54', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `checkeds`
--
ALTER TABLE `checkeds`
 ADD PRIMARY KEY (`id`), ADD KEY `task_id` (`task_id`), ADD KEY `checkeds_ibfk_1` (`user_id`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lists`
--
ALTER TABLE `lists`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id`), ADD KEY `to_do_id` (`to_do_id`), ADD KEY `members_ibfk_1` (`user_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`to_do_id`), ADD KEY `to_do_id` (`to_do_id`);

--
-- Index pour la table `rights`
--
ALTER TABLE `rights`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `social_profiles`
--
ALTER TABLE `social_profiles`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
 ADD PRIMARY KEY (`id`), ADD KEY `to_do_id` (`to_do_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `checkeds`
--
ALTER TABLE `checkeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lists`
--
ALTER TABLE `lists`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rights`
--
ALTER TABLE `rights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `social_profiles`
--
ALTER TABLE `social_profiles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `checkeds`
--
ALTER TABLE `checkeds`
ADD CONSTRAINT `checkeds_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `checkeds_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Contraintes pour la table `members`
--
ALTER TABLE `members`
ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `members_ibfk_2` FOREIGN KEY (`to_do_id`) REFERENCES `lists` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_do_id`) REFERENCES `lists` (`id`);

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`to_do_id`) REFERENCES `lists` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
