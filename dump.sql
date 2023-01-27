-- MariaDB dump 10.19  Distrib 10.9.4-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: recettes
-- ------------------------------------------------------
-- Server version	10.9.4-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `APPRECIATION`
--

DROP TABLE IF EXISTS `APPRECIATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `APPRECIATION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMMENT` text NOT NULL,
  `NOTE` int(11) NOT NULL,
  `DATE` date NOT NULL,
  `AUTHOR_ID` int(11) DEFAULT NULL,
  `RECIPE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `APPRECIATION_ibfk_2` (`RECIPE_ID`),
  KEY `APPRECIATION_ibfk_1` (`AUTHOR_ID`),
  CONSTRAINT `APPRECIATION_ibfk_1` FOREIGN KEY (`AUTHOR_ID`) REFERENCES `USER` (`ID`),
  CONSTRAINT `APPRECIATION_ibfk_2` FOREIGN KEY (`RECIPE_ID`) REFERENCES `RECIPE` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `APPRECIATION`
--

LOCK TABLES `APPRECIATION` WRITE;
/*!40000 ALTER TABLE `APPRECIATION` DISABLE KEYS */;
INSERT INTO `APPRECIATION` VALUES
(1,'j\'adore.',5,'2020-03-13',2,3),
(4,'Couchons ici !',3,'2015-03-04',8,4),
(6,'Sed pulvinar, lorem eu malesuada sollicitudin, lacus leo bibendum elit, in aliquam libero risus et purus. Nam turpis metus, varius eu sapien id, cursus facilisis dui.',4,'2021-06-24',3,6),
(7,'Sed efficitur neque in auctor ornare. Praesent finibus sit amet urna sed bibendum. Phasellus et ornare nibh. Mauris nibh felis, fermentum eu ligula quis, tincidunt tincidunt turpis.',3,'2020-08-04',3,1),
(8,'Nunc vel posuere ligula, eget dignissim purus. Maecenas elit est, condimentum accumsan ex ut, eleifend ornare quam. Fusce sit amet sem eget magna consequat hendrerit imperdiet ut dui. Proin ut feugiat orci, eget dictum odio.',2,'2016-01-23',2,2),
(9,'Morbi laoreet erat nec felis tincidunt consectetur. Duis sodales ex ullamcorper, vulputate eros in, imperdiet leo. ',1,'2022-11-02',2,3),
(10,'Aliquam euismod dictum tempus.',5,'2015-02-26',6,4),
(11,'Fusce sit amet ligula mauris.',3,'2023-09-05',4,2),
(12,'Proin at congue lacus. Sed nec gravida libero, et molestie neque. Praesent tempor tempus mauris non rutrum. Vivamus pharetra sollicitudin facilisis.',5,'2016-11-25',5,5),
(16,'Nam venenatis augue nulla, quis dictum purus porta ut.',3,'2019-03-25',5,3),
(17,'Phasellus efficitur ornare justo sed euismod. Phasellus pretium eros id sapien laoreet, eget facilisis lacus varius.',4,'2023-01-12',10,5),
(18,'Aliquam ullamcorper risus at eleifend ultrices.',4,'2019-03-30',4,6),
(19,'Quisque consectetur ipsum eros, at rhoncus diam viverra eu.',4,'2015-03-15',6,3),
(20,'Curabitur eu tempor urna.',2,'2020-09-21',3,1),
(25,'J\'aime les crepes',5,'2023-01-26',NULL,1),
(30,'wallah masterclass',5,'2023-01-26',14,16),
(31,'J\'aime bien ma recette, en sah 5/5',5,'2023-01-27',27,16),
(33,'en fait c\'est bien (s\'il vous plait laissez moi tranquille aaaaaaaaaaaa)',5,'2023-01-27',29,4);
/*!40000 ALTER TABLE `APPRECIATION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DIFFICULTY`
--

DROP TABLE IF EXISTS `DIFFICULTY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DIFFICULTY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DIFFICULTY`
--

LOCK TABLES `DIFFICULTY` WRITE;
/*!40000 ALTER TABLE `DIFFICULTY` DISABLE KEYS */;
INSERT INTO `DIFFICULTY` VALUES
(1,'Très facile'),
(2,'Facile'),
(3,'Moyen'),
(4,'Difficile'),
(5,'Très difficile');
/*!40000 ALTER TABLE `DIFFICULTY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INGREDIENT`
--

DROP TABLE IF EXISTS `INGREDIENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INGREDIENT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INGREDIENT`
--

LOCK TABLES `INGREDIENT` WRITE;
/*!40000 ALTER TABLE `INGREDIENT` DISABLE KEYS */;
INSERT INTO `INGREDIENT` VALUES
(1,'Pomme de terre'),
(2,'Gouse de vanille'),
(3,'Extraits de vanille'),
(4,'Sucre'),
(5,'Sucre roux'),
(6,'Farine'),
(7,'Lait'),
(8,'Levure chimique'),
(9,'Œuf'),
(10,'Chocolat blanc'),
(11,'Chocolat noir'),
(12,'Chocolat au lait'),
(13,'Crème fraiche'),
(14,'Beurre'),
(15,'Poivre'),
(16,'Sel'),
(17,'Eau'),
(18,'Sucre vanillé'),
(19,'Pomme'),
(20,'Poire'),
(21,'Orange'),
(22,'Clémentine'),
(23,'Mandarine'),
(24,'Huile'),
(25,'Vin blanc'),
(26,'Pain de mie'),
(27,'Crème'),
(28,'Muscade'),
(29,'Pâte Feuilletée'),
(30,'Amandes en poudre'),
(31,'Sucre fin'),
(32,'Fèves'),
(33,'Jaune d\'œuf'),
(34,'Chocolat'),
(35,'Sucre en poudre'),
(36,'Carottes'),
(37,'Fécule de maïs'),
(38,'Yaourt brassé'),
(39,'Noix'),
(40,'Farine bombée'),
(41,'Yaourt nature'),
(42,'Noix de coco'),
(43,'Farine de riz gluant'),
(44,'Graines de sésame'),
(45,'Poivre de sichuan'),
(46,'Étoile de badiane'),
(47,'Vermicelles de riz'),
(48,'Gingembre moulu'),
(49,'Poivre blanc'),
(50,'Blanc d\'œuf'),
(51,'Coriandre'),
(52,'Mascarpone'),
(53,'Biscuits à la cuillère'),
(54,'Café'),
(55,'Cacao'),
(56,'Cannelle'),
(57,'Citron'),
(58,'Miel'),
(59,'Aneth'),
(60,'Menthe'),
(61,'Riz'),
(62,'Brie'),
(63,'Fruits rouges'),
(64,'Rhum'),
(65,'Biscuit'),
(66,'Framboises'),
(67,'Confiture de framboise'),
(68,'Feuille de gélatine'),
(69,'Crème liquide'),
(70,'Beurre fondu'),
(71,'Toilettes'),
(72,'pq'),
(73,''),
(74,'sucre glace'),
(75,'oeuf'),
(76,'beure '),
(77,'jaune d\'oeuf'),
(78,'levure'),
(79,'beure fondu'),
(80,'crème fraîche entière'),
(81,'100g'),
(82,'zer'),
(83,'zaert'),
(84,'Yaourt'),
(85,'Huile de tournesol');
/*!40000 ALTER TABLE `INGREDIENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PARTICULARITY`
--

DROP TABLE IF EXISTS `PARTICULARITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARTICULARITY` (
  `ID` int(11) NOT NULL,
  `NAME` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARTICULARITY`
--

LOCK TABLES `PARTICULARITY` WRITE;
/*!40000 ALTER TABLE `PARTICULARITY` DISABLE KEYS */;
INSERT INTO `PARTICULARITY` VALUES
(1,'végétarien'),
(2,'végan'),
(3,'sans gluten'),
(4,'sans lactose');
/*!40000 ALTER TABLE `PARTICULARITY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RECIPE`
--

DROP TABLE IF EXISTS `RECIPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RECIPE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` text NOT NULL,
  `TIME` int(11) NOT NULL,
  `DESCR` text NOT NULL,
  `INSTRUCTIONS` text NOT NULL,
  `DIFFICULTY_ID` int(11) NOT NULL,
  `AUTHOR_ID` int(11) DEFAULT NULL,
  `IMG` mediumblob DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `RECIPE_ibfk_1` (`DIFFICULTY_ID`),
  KEY `RECIPE_ibfk_2` (`AUTHOR_ID`),
  CONSTRAINT `RECIPE_ibfk_1` FOREIGN KEY (`DIFFICULTY_ID`) REFERENCES `DIFFICULTY` (`ID`),
  CONSTRAINT `RECIPE_ibfk_2` FOREIGN KEY (`AUTHOR_ID`) REFERENCES `USER` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RECIPE`
--

LOCK TABLES `RECIPE` WRITE;
/*!40000 ALTER TABLE `RECIPE` DISABLE KEYS */;
INSERT INTO `RECIPE` VALUES
(1,'Pâte à crêpes',45,'Légère et délicate, la pâte à crêpe est idéale pour des crêpes fines et croustillantes. Avec sa texture est onctueuse et son goût subtil, c\'est un plat traditionnel français populaire chez tout le monde.','Mettre la farine dans une terrine et former un puits.\n\nY déposer les oeufs entiers, le sucre, l\'huile et le beurre.\n\nMélanger délicatement avec un fouet en ajoutant au fur et à mesure le lait. La pâte ainsi obtenue doit avoir une consistance d\'un liquide légèrement épais.\n\nParfumer de rhum.\n\nFaire chauffer une poêle antiadhésive et la huiler très légèrement à l\'aide d\'un papier Essuie-tout. Y verser une louche de pâte, la répartir dans la poêle puis attendre qu\'elle soit cuite d\'un côté avant de la retourner. Cuire ainsi toutes les crêpes à feu doux.',2,30,NULL),
(2,'Mousse au chocolat facile',30,'Très bon','Séparer les blancs des jaunes d\'oeufs.\n\nFaire ramollir le chocolat dans une casserole au bain-marie.\n\nHors du feu, incorporer les jaunes et le sucre.\n\nBattre les blancs en neige ferme.\n\nAjouter délicatement les blancs au mélange à l\'aide d\'une spatule.\n\nVerser dans une terrine ou des verrines.\n\nMettre au frais 2h minimum.\n\nDécorer de cacao ou de chocolat râpé\n\nDéguster',1,27,NULL),
(3,'Tiramisu au chocolat et aux fruits rouges',1680,'Un tiramisu facile','Cassez le chocolat en morceaux et faites-le fondre au micro-onde ou au bain-marie.\n\nSéparez les blancs des jaunes et montez les blancs en neige bien fermes.\n\nBattre les jaunes d\'oeufs et le sucre jusqu\'à ce que le mélange blanchisse. Ajoutez le mascarpone et mélangez bien.\n\nAjoutez le chocolat fondu à la préparation et mélangez.\n\nA l\'aide d\'une spatule, ajoutez les blancs d\'oeufs délicatement.\n\nTrempez les biscuits à la cuillère dans le café avant d\'en tapisser le fond du plat.\n\nRecouvrir d\'une couche de crème au mascarpone et chocolat puis de fruits rouges. Répétez l\'opération en alternant couche de biscuits et couche de crème en terminant par cette dernière. 8. Réservez au frais minimum 5h.',2,27,NULL),
(4,'Pomme d\'amour',15,'Recette de pommes d\'amour pour pâtissier un peu expérimentés','Faire un caramel dans une casserole, pendant ce temps peler des pommes.Enfoncer un grand pic en bois dans le centre de chaque pomme, quand le caramel est roux -en faisant très vite- rouler chaque pomme dans celui-ci.',3,27,NULL),
(5,'Bavarois framboise chocolat blanc',420,'Frais, fondant, facile et surtout sans cuisson, c\'est LE dessert qui fera un effet \"woooaw\" assuré auprès de vos invités !','La base biscuit :Écrasez les biscuits en fine poudre (à l\'aide d\'un hachoir par exemple.); Ajoutez 80g de beurre fondu et mélangez bien.\n\nDans le fond de votre moule ou de votre cercle, placez une feuille de papier sulfurisé. Versez-y le mélange de biscuit, et étalez le afin de faire une couche uniforme et bien compacte. Mettez au frais.\n\nLa mousse bavaroise chocolat blanc :Mettez 2 feuilles de gélatine à tremper dans de l\'eau froide. Mélangez les jaunes d\'œuf avec 40g de sucre. Ajoutez ensuite 20cl de lait et mélangez bien.\n\nMettez sur feu doux et mélangez avec une cuillère en bois constamment. (Il s\'agit d\'une crème anglaise). Mélangez ainsi jusqu\'à ce que la crème épaississe légèrement (le doigt doit laisser une trace sur la cuillère). Cela peut prendre un peu de temps (10-15 min).Sortez la crème du feu, et ajoutez-y la gélatine imbibée bien essorée. Mélangez bien, puis ajoutez t le chocolat blanc en morceaux. Mélangez jusqu\'à ce qu\'il soit bien incorporé, et laissez refroidir à température ambiante une vingtaine de minutes.\n\nMontez ensuite votre crème bien froide en crème fouettée, en la battant rapidement au fouet électrique. Ajoutez la à la crème au chocolat blanc, en mélangeant délicatement.\n\nVersez ce mélange sur la base de biscuit dans le moule. Mettez au frais pour minimum 3 heures.\n\nLa mousse framboise :Mettez le reste des feuilles de gélatine à tremper dans de l\'eau froide. Dans une casserole, mettez 400g de framboises et le reste du sucre et mélangez. Laissez à feu moyen en mélangeant de temps en temps pendant environ 5 minutes.\n\nFiltrez le contenu de la casserole afin d\'enlever les pépins et la pulpe. Ajoutez les feuilles de gélatine dans le coulis encore chaud et mélangez bien.\n\nMontez 40cl de crème froide en chantilly. Ajoutez le coulis de framboise tiède. Arrêter le fouet et mélangez délicatement à la spatule pour bien mélanger la crème et le coulis de façon homogène.\n\nVersez la mousse ainsi obtenue dans le moule sur la mousse de chocolat blanc, et lissez au maximum le dessus. Mettez à nouveau au frais pour 3 heures.\n\nLa décoration : Faites chauffer la confiture 1 minutes au micro-ondes. Filtrez ensuite la confiture afin d\'enlever les peaux et pépins.Versez ensuite la confiture sur la mousse de framboise, et tournez le moule afin de bien répartir la préparation. S\'il y a des irrégularités, vous pourrez les cacher avec la décoration. Mettez ensuite au frais 45 minutes.\n\nDisposez des framboises fraîches sur le pourtour du gâteau.\n\nVous pouvez également placer des feuilles de menthe entre les framboises pour donner un visuel plein de fraîcheur.\n\nEt voilà, votre bavarois à la framboise et au chocolat blanc est prêt !',4,27,NULL),
(6,'Lorem ipsum dolor sit amet',50,' consectetur adipiscing elit. Donec eget suscipit nulla. Integer condimentum mattis commodo. Nullam egestas condimentum vehicula. Morbi a varius mauris.','Suspendisse rutrum leo eu eros suscipit, eget tempus tellus sodales.\n\nCras metus neque, sodales id luctus commodo, laoreet a sapien. Nullam rhoncus congue ex id fringilla. Pellentesque ullamcorper tortor eget vehicula molestie. Donec id nunc leo. Quisque bibendum est non mauris porta, non luctus sem egestas. Ut aliquam nulla a turpis ultrices, vel hendrerit sem maximus.',1,9,NULL),
(16,'Mille feuilles',55,'Mille feuilles, la meilleure création de l\'humanité.','Abaisser la pâte feuilletée sur environ 3 mm. Tailler des rectangles de taille égale. La piquer à la fourchette pour qu\'elle ne gonfle pas puis la mettre au four sur 6, soit 180°C.\n\nPendant ce temps, préparer la crème pâtissière : Mettre le lait à bouillir.\n\nPendant ce temps, mélanger dans un saladier l\'oeuf, le sucre, le sucre vanillé et la farine.\n\nLorsque le lait est à ébullition, le verser immédiatement dans le saladier.\n\nRemettre à cuire dans la casserole pendant quelques minutes afin que le liquide prenne la consistance d\'une crème.\n\nEtaler la crème pâtissière sur une première couche de pâte, puis faire de même avec une seconde. Les assembler.\n\nAttendre que le gâteau soit froid pour étaler au pinceau le glacage, fait avec beaucoup de sucre glace mélangé à un peu d\'eau. Réaliser un dessin avec le reste du glacage, mélangé à un carreau de chocolat fondu.\n\nC\'est prêt !',2,27,NULL),
(17,'Eclair au chocolat',90,'Un classique de la patisserie','Pour la pâte à choux:\n\nPréchauffer le four à 210°C (Thermostat 7).\n\nMélanger sel, sucre, beurre et eau dans une casserole, et faire bouillir.\n\nIntégrer la farine, et remuer jusqu\'à l\'obtention d\'une pâte compacte. La travailler jusqu\'à ce qu\'elle soit suffisamment ferme\n\nIntégrer 4 oeufs, un à un en veillant à bien mélanger entre chaque oeuf.\n\nTravailler la pâte afin de la rendre ferme.\n\nSur un plaque allant au four préalablement huilée, répartir à l\'aide de la poche à douille une dizaine de boudins de pâte de 15 cm de long environ.\n\nBadigeonner avec le jaune d\'œuf pour que la pâte soit dorée à la cuisson .\n\nFaire cuire 25 min à four chaud et laisser reposer 10 min, four éteint, pour éviter que les choux ou les éclairs ne dégonflent.\n\nPour la crème:\n\nFaire fondre 60 g de chocolat cassé en morceaux dans le lait, à feu doux .\n\nDans un bol, fouetter oeuf, jaune et sucre jusqu\'à ce que le mélange soit mousseux.\n\nAjouter la farine et verser dans le lait chocolaté.\n\nFaire épaissir sans cesser de remuer.\n\nHors du feu, intégrer 20 g de beurre. Laisser refroidir.\n\nGarnir de cette crème les éclairs coupés en 2 dans le sens de la longueur et faire fondre au bain-marie le reste du chocolat et du beurre.\n\nNapper le dessus des éclairs. Laisser durcir le glaçage avant de déguster.',3,27,NULL),
(18,'Forêt Noire',75,'A se perdre dans la saveur ;p','Mélanger oeufs, sucre au fouet sur un bain-marie (pas trop chaud).\n\nAjouter farine tamisée, levure et le beurre\n\nAjouter le chocolat fondu (sur un bain-marie à 30, 35°C).\n\nFaire cuire dans deux moules (diamètre 20 ou 24) à 175°C pendant 30 minutes (chaleur conventionnelle).\n\nLes copeaux sont réalisés par étalement en fine couche du chocolat fondu sur une plaque de marbre. Choisir le moment, ni trop froid, ni trop chaud pour les former.\n\nLes gâteaux refroidis, les couper en deux, les imbiber du jus de cerise additionné de kirsch\n\nMonter la crème en chantilly avec 100g de sucre glace.\n\nFormer le gâteau première couche chantilly avec des morceaux de cerises deuxième couche une réduction du jus de cerise avec un apport de sucre pour faire un caramel pas trop dur et dernière couche de chantilly avec des morceaux de cerises.\n\nEnduire le gâteau de chantilly et disposer les copeaux de chocolat.\n\nPour un gâteau de 28 cm de diamètre multiplier les proportions par 1,5.',3,27,NULL),
(19,'Gâteau simple',25,'Un gâteau simple mais efficace','Préchauffez le four th.6 (180°C). Battez les œufs entiers avec le sucre en poudre dans un grand saladier jusqu’à ce que le mélange blanchisse et soit bien homogène. Ajoutez alors la farine, le sel et la levure chimique puis mélangez de nouveau afin de bien intégrer ces nouveaux ingrédients à la préparation.\n\nDélayez la préparation en versant progressivement le lait puis l’huile neutre, tout en continuant de mélanger. Remuez jusqu\'à obtenir une pâte bien lisse.\n\nBeurrez un moule à cake et versez-y la pâte. Vous pouvez également utiliser un moule en silicone sans y ajouter de matière grasse.\n\nEnfournez et faites cuire le gâteau simple pendant environ 45 min. Vérifiez la cuisson du gâteau avec la pointe d’un couteau. Elle doit ressortir propre et sèche à la fin de la cuisson.\n\nÀ la sortie du four, démoulez le gâteau sur un plat de service. Dégustez tiède de préférence, nappé d’un peu de crème anglaise, ou accompagné de quelques cuillerées de confiture ou de pâte à tartiner.',1,29,NULL),
(23,'Gâteau au yaourt',50,'Un gâteau aussi simple que délicieux et pour les mesures vous n\'aurez besoin que d\'un pot de yaourt !','Préchauffer le four à 180°\n\nMettre dans une cuve de robot ou un saladier les ingrédients suivants :\n\nVerser le pot de yaourt\n\nVerser 3 pots de farine\n\nVerser 2 pots de sucre et le sachet de sucre vanillé\n\nVerser 75% de la quantité pot en huile de tournesol\n\nCasser et verser les oeufs un par un\n\nMettre le sachet de levure chimique\n\nBattre la préparation au robot ou au fouet manuel (non conseillé), jusqu\'à obtenir un mélange épais et homogène)\n\nBeurrer puis fariner votre moule\n\nVerser votre préparation dans le moule\n\nEnfourner 35 minutes à 180°\n\nPour vérifier la bonne cuisson de votre gâteau, plantez un couteau en son centre, si le couteau est propre, votre gâteau est parfaitement cuit !',1,30,NULL);
/*!40000 ALTER TABLE `RECIPE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RECIPE_INGREDIENT`
--

DROP TABLE IF EXISTS `RECIPE_INGREDIENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RECIPE_INGREDIENT` (
  `RECIPE_ID` int(11) NOT NULL,
  `INGREDIENT_ID` int(11) NOT NULL,
  `QUANTITY` text NOT NULL,
  PRIMARY KEY (`RECIPE_ID`,`INGREDIENT_ID`),
  KEY `RECIPE_INGREDIENT_ibfk_2` (`INGREDIENT_ID`),
  CONSTRAINT `RECIPE_INGREDIENT_ibfk_1` FOREIGN KEY (`RECIPE_ID`) REFERENCES `RECIPE` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `RECIPE_INGREDIENT_ibfk_2` FOREIGN KEY (`INGREDIENT_ID`) REFERENCES `INGREDIENT` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RECIPE_INGREDIENT`
--

LOCK TABLES `RECIPE_INGREDIENT` WRITE;
/*!40000 ALTER TABLE `RECIPE_INGREDIENT` DISABLE KEYS */;
INSERT INTO `RECIPE_INGREDIENT` VALUES
(1,4,'3 cuillère à soupe'),
(1,6,'300g'),
(1,7,'60cl'),
(1,9,'3'),
(1,24,'2 cuillère à soupe'),
(2,9,'3'),
(2,11,'100g'),
(2,18,'1 sachet'),
(3,9,'5'),
(3,11,'100g'),
(3,35,'5 cuillère à soupe'),
(3,52,'250g'),
(3,53,'30'),
(3,54,'1 bol'),
(3,63,'250g'),
(4,4,'70g'),
(4,17,'10cl'),
(4,19,'2'),
(5,1,'500g'),
(5,4,'140g'),
(5,7,'20cl'),
(5,10,'170g'),
(5,14,'80g'),
(5,33,'3'),
(5,65,'200g'),
(5,66,'400g'),
(5,67,'370g'),
(5,68,'6'),
(5,69,'60cl'),
(6,2,'2'),
(6,6,'400g'),
(6,24,'3 cuillère à soupe'),
(6,29,'1'),
(6,66,'18'),
(16,4,'25g'),
(16,7,'1/4 L'),
(16,34,'1/2'),
(16,74,' '),
(16,75,'1'),
(17,4,'4 c.à.s'),
(17,6,'200 G'),
(17,7,'30 cL'),
(17,11,'210 G'),
(17,16,'1 pincée'),
(17,17,'25 cL'),
(17,24,' '),
(17,75,'5'),
(17,76,'125 G'),
(17,77,'3'),
(18,4,'180 G'),
(18,6,'120 G '),
(18,34,'100 G'),
(18,75,'4'),
(18,78,'1 sachet'),
(18,79,'160 G'),
(18,80,'40 cL'),
(18,81,'copeaux de chocolat'),
(19,6,'160g'),
(19,7,'15cl'),
(19,8,'1 sachet'),
(19,16,'1 pincée'),
(19,24,'50g'),
(19,35,'150g'),
(19,75,'2'),
(23,4,'2 pots'),
(23,6,'3 pots'),
(23,8,'1 sachet (~10g)'),
(23,18,'1 sachet (~7,5g)'),
(23,75,'2 gros oeufs ou 3 petits'),
(23,84,'1 pot'),
(23,85,'75% d\'un pot');
/*!40000 ALTER TABLE `RECIPE_INGREDIENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RECIPE_PARTICULARITY`
--

DROP TABLE IF EXISTS `RECIPE_PARTICULARITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RECIPE_PARTICULARITY` (
  `RECIPE_ID` int(11) NOT NULL,
  `PARTICULARITY_ID` int(11) NOT NULL,
  PRIMARY KEY (`RECIPE_ID`,`PARTICULARITY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RECIPE_PARTICULARITY`
--

LOCK TABLES `RECIPE_PARTICULARITY` WRITE;
/*!40000 ALTER TABLE `RECIPE_PARTICULARITY` DISABLE KEYS */;
INSERT INTO `RECIPE_PARTICULARITY` VALUES
(1,1),
(1,3),
(2,1),
(2,3),
(2,4),
(4,1),
(4,2),
(4,3),
(4,4),
(17,1),
(23,1);
/*!40000 ALTER TABLE `RECIPE_PARTICULARITY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USER`
--

DROP TABLE IF EXISTS `USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` text NOT NULL,
  `USERNAME` text NOT NULL,
  `PASS_HASH` text NOT NULL,
  `LAST_SEEN` datetime NOT NULL,
  `FIRST_SEEN` datetime NOT NULL,
  `ADMIN` tinyint(1) NOT NULL DEFAULT 0,
  `DISABLED` tinyint(1) NOT NULL DEFAULT 0,
  `PROFILE_PIC` mediumblob DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USER`
--

LOCK TABLES `USER` WRITE;
/*!40000 ALTER TABLE `USER` DISABLE KEYS */;
INSERT INTO `USER` VALUES
(1,'nah','Augustin','REDACTED','2023-01-12 00:00:00','2015-06-06 00:00:00',0,0,NULL),
(2,'nah','Sushi','REDACTED','2023-01-02 00:00:00','2023-01-01 00:00:00',0,0,NULL),
(3,'nah','Cornichons>all','REDACTED','2023-01-12 00:00:00','2021-06-06 00:00:00',0,0,NULL),
(4,'nah','Benois','REDACTED','2020-08-29 00:00:00','2019-05-15 00:00:00',0,1,NULL),
(5,'nah','Dino','REDACTED','2022-12-25 00:00:00','2022-04-13 00:00:00',0,1,NULL),
(6,'nah','Rh','REDACTED','2019-07-07 00:00:00','2016-10-06 00:00:00',0,1,NULL),
(7,'nah','Paul','REDACTED','2021-07-29 00:00:00','2018-08-24 00:00:00',0,0,NULL),
(8,'nah','ThoTho','REDACTED','2021-05-12 00:00:00','2017-08-14 00:00:00',0,0,NULL),
(9,'nah','Thomas','REDACTED','2021-07-30 00:00:00','2019-10-12 00:00:00',0,0,NULL),
(10,'nah','Z','REDACTED','2016-03-13 00:00:00','2015-05-17 00:00:00',0,0,NULL),
(12,'a@gmail.com','testAccount','$2y$10$EIJt3xi5/YtiLsTAi7RLrOi7SlS7geo43cFJFPYsB1i2zax9PzO4.','2023-01-27 09:20:54','2015-05-17 00:00:00',1,0,NULL),
(14,'hey@kap.fr','kap','$2y$10$O96URuhoFNFj2v2My7ML1OOMjTXGpbMKYbOdeEXO8vl7uUs0rSvYe','2023-01-27 09:21:17','2015-05-17 00:00:00',1,0,NULL),
(26,'test@gmail.com','test','REDACTED','2023-01-26 19:09:22','2023-01-26 19:06:42',0,0,NULL),
(27,'hey@djalim.fr','Neotaku67','$2y$10$yYfHySvSPZeLgq7QB10xpuqzT68X75YsXcP2xGUotVsHqr3.GAx9e','2023-01-27 09:12:58','2023-01-26 19:10:56',1,0,NULL),
(28,'b@b.fr','b','REDACTED','2023-01-27 07:33:35','2023-01-27 07:33:35',0,0,NULL),
(29,'hey@zol.fr','Zol','REDACTED','2023-01-27 09:17:52','2023-01-27 07:34:03',0,0,NULL),
(30,'nico@nico.fr','nico','REDACTED','2023-01-27 09:15:49','2023-01-27 09:15:49',1,0,NULL);
/*!40000 ALTER TABLE `USER` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-27 10:51:27
