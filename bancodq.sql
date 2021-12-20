
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bancodq`
--
drop database if exists bancodq;
create database bancodq;
use bancodq;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE IF NOT EXISTS `equipamento` (
  `equipamentoid` int(11) NOT NULL AUTO_INCREMENT,
  `registro` int(11) NOT NULL,
  `proprietario` varchar(60) NOT NULL,
  `plaquetavel` char(1) NOT NULL,
  `descricao` text NOT NULL,
  `ano` year(4) NOT NULL,
  `localid` int(11) DEFAULT NULL,
  PRIMARY KEY (`equipamentoid`),
  KEY `fk_local` (`localid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `localid` int(11) NOT NULL AUTO_INCREMENT,
  `predio` varchar(50) NOT NULL,
  `sala` varchar(50) NOT NULL,
  `especificacao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`localid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuarioid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) DEFAULT NULL,
  `senha` char(60) DEFAULT NULL,
  PRIMARY KEY (`usuarioid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuarioid`, `email`, `senha`) VALUES
(1, 'ficechin@hotmail.com', '$2a$08$c6Bgs2jLM8o3zA4wja0gUuIM1FklFcoVM337fNB02kNjQxYVgIpEq');
/* senha felipe10 */

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD CONSTRAINT `equipamento_ibfk_1` FOREIGN KEY (`localid`) REFERENCES `local` (`localid`),
  ADD CONSTRAINT `fk_local` FOREIGN KEY (`localid`) REFERENCES `local` (`localid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
