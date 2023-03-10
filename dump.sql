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
(1,'Tr??s facile'),
(2,'Facile'),
(3,'Moyen'),
(4,'Difficile'),
(5,'Tr??s difficile');
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
(9,'??uf'),
(10,'Chocolat blanc'),
(11,'Chocolat noir'),
(12,'Chocolat au lait'),
(13,'Cr??me fraiche'),
(14,'Beurre'),
(15,'Poivre'),
(16,'Sel'),
(17,'Eau'),
(18,'Sucre vanill??'),
(19,'Pomme'),
(20,'Poire'),
(21,'Orange'),
(22,'Cl??mentine'),
(23,'Mandarine'),
(24,'Huile'),
(25,'Vin blanc'),
(26,'Pain de mie'),
(27,'Cr??me'),
(28,'Muscade'),
(29,'P??te Feuillet??e'),
(30,'Amandes en poudre'),
(31,'Sucre fin'),
(32,'F??ves'),
(33,'Jaune d\'??uf'),
(34,'Chocolat'),
(35,'Sucre en poudre'),
(36,'Carottes'),
(37,'F??cule de ma??s'),
(38,'Yaourt brass??'),
(39,'Noix'),
(40,'Farine bomb??e'),
(41,'Yaourt nature'),
(42,'Noix de coco'),
(43,'Farine de riz gluant'),
(44,'Graines de s??same'),
(45,'Poivre de sichuan'),
(46,'??toile de badiane'),
(47,'Vermicelles de riz'),
(48,'Gingembre moulu'),
(49,'Poivre blanc'),
(50,'Blanc d\'??uf'),
(51,'Coriandre'),
(52,'Mascarpone'),
(53,'Biscuits ?? la cuill??re'),
(54,'Caf??'),
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
(68,'Feuille de g??latine'),
(69,'Cr??me liquide'),
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
(80,'cr??me fra??che enti??re'),
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
(1,'v??g??tarien'),
(2,'v??gan'),
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
(1,'P??te ?? cr??pes',45,'L??g??re et d??licate, la p??te ?? cr??pe est id??ale pour des cr??pes fines et croustillantes. Avec sa texture est onctueuse et son go??t subtil, c\'est un plat traditionnel fran??ais populaire chez tout le monde.','Mettre la farine dans une terrine et former un puits.\n\nY d??poser les oeufs entiers, le sucre, l\'huile et le beurre.\n\nM??langer d??licatement avec un fouet en ajoutant au fur et ?? mesure le lait. La p??te ainsi obtenue doit avoir une consistance d\'un liquide l??g??rement ??pais.\n\nParfumer de rhum.\n\nFaire chauffer une po??le antiadh??sive et la huiler tr??s l??g??rement ?? l\'aide d\'un papier Essuie-tout. Y verser une louche de p??te, la r??partir dans la po??le puis attendre qu\'elle soit cuite d\'un c??t?? avant de la retourner. Cuire ainsi toutes les cr??pes ?? feu doux.',2,30,NULL),
(2,'Mousse au chocolat facile',30,'Tr??s bon','S??parer les blancs des jaunes d\'oeufs.\n\nFaire ramollir le chocolat dans une casserole au bain-marie.\n\nHors du feu, incorporer les jaunes et le sucre.\n\nBattre les blancs en neige ferme.\n\nAjouter d??licatement les blancs au m??lange ?? l\'aide d\'une spatule.\n\nVerser dans une terrine ou des verrines.\n\nMettre au frais 2h minimum.\n\nD??corer de cacao ou de chocolat r??p??\n\nD??guster',1,27,NULL),
(3,'Tiramisu au chocolat et aux fruits rouges',1680,'Un tiramisu facile','Cassez le chocolat en morceaux et faites-le fondre au micro-onde ou au bain-marie.\n\nS??parez les blancs des jaunes et montez les blancs en neige bien fermes.\n\nBattre les jaunes d\'oeufs et le sucre jusqu\'?? ce que le m??lange blanchisse. Ajoutez le mascarpone et m??langez bien.\n\nAjoutez le chocolat fondu ?? la pr??paration et m??langez.\n\nA l\'aide d\'une spatule, ajoutez les blancs d\'oeufs d??licatement.\n\nTrempez les biscuits ?? la cuill??re dans le caf?? avant d\'en tapisser le fond du plat.\n\nRecouvrir d\'une couche de cr??me au mascarpone et chocolat puis de fruits rouges. R??p??tez l\'op??ration en alternant couche de biscuits et couche de cr??me en terminant par cette derni??re. 8. R??servez au frais minimum 5h.',2,27,NULL),
(4,'Pomme d\'amour',15,'Recette de pommes d\'amour pour p??tissier un peu exp??riment??s','Faire un caramel dans une casserole, pendant ce temps peler des pommes.Enfoncer un grand pic en bois dans le centre de chaque pomme, quand le caramel est roux -en faisant tr??s vite- rouler chaque pomme dans celui-ci.',3,27,NULL),
(5,'Bavarois framboise chocolat blanc',420,'Frais, fondant, facile et surtout sans cuisson, c\'est LE dessert qui fera un effet \"woooaw\" assur?? aupr??s de vos invit??s !','La base biscuit :??crasez les biscuits en fine poudre (?? l\'aide d\'un hachoir par exemple.); Ajoutez 80g de beurre fondu et m??langez bien.\n\nDans le fond de votre moule ou de votre cercle, placez une feuille de papier sulfuris??. Versez-y le m??lange de biscuit, et ??talez le afin de faire une couche uniforme et bien compacte. Mettez au frais.\n\nLa mousse bavaroise chocolat blanc :Mettez 2 feuilles de g??latine ?? tremper dans de l\'eau froide. M??langez les jaunes d\'??uf avec 40g de sucre. Ajoutez ensuite 20cl de lait et m??langez bien.\n\nMettez sur feu doux et m??langez avec une cuill??re en bois constamment. (Il s\'agit d\'une cr??me anglaise). M??langez ainsi jusqu\'?? ce que la cr??me ??paississe l??g??rement (le doigt doit laisser une trace sur la cuill??re). Cela peut prendre un peu de temps (10-15 min).Sortez la cr??me du feu, et ajoutez-y la g??latine imbib??e bien essor??e. M??langez bien, puis ajoutez t le chocolat blanc en morceaux. M??langez jusqu\'?? ce qu\'il soit bien incorpor??, et laissez refroidir ?? temp??rature ambiante une vingtaine de minutes.\n\nMontez ensuite votre cr??me bien froide en cr??me fouett??e, en la battant rapidement au fouet ??lectrique. Ajoutez la ?? la cr??me au chocolat blanc, en m??langeant d??licatement.\n\nVersez ce m??lange sur la base de biscuit dans le moule. Mettez au frais pour minimum 3 heures.\n\nLa mousse framboise :Mettez le reste des feuilles de g??latine ?? tremper dans de l\'eau froide. Dans une casserole, mettez 400g de framboises et le reste du sucre et m??langez. Laissez ?? feu moyen en m??langeant de temps en temps pendant environ 5 minutes.\n\nFiltrez le contenu de la casserole afin d\'enlever les p??pins et la pulpe. Ajoutez les feuilles de g??latine dans le coulis encore chaud et m??langez bien.\n\nMontez 40cl de cr??me froide en chantilly. Ajoutez le coulis de framboise ti??de. Arr??ter le fouet et m??langez d??licatement ?? la spatule pour bien m??langer la cr??me et le coulis de fa??on homog??ne.\n\nVersez la mousse ainsi obtenue dans le moule sur la mousse de chocolat blanc, et lissez au maximum le dessus. Mettez ?? nouveau au frais pour 3 heures.\n\nLa d??coration : Faites chauffer la confiture 1 minutes au micro-ondes. Filtrez ensuite la confiture afin d\'enlever les peaux et p??pins.Versez ensuite la confiture sur la mousse de framboise, et tournez le moule afin de bien r??partir la pr??paration. S\'il y a des irr??gularit??s, vous pourrez les cacher avec la d??coration. Mettez ensuite au frais 45 minutes.\n\nDisposez des framboises fra??ches sur le pourtour du g??teau.\n\nVous pouvez ??galement placer des feuilles de menthe entre les framboises pour donner un visuel plein de fra??cheur.\n\nEt voil??, votre bavarois ?? la framboise et au chocolat blanc est pr??t !',4,27,NULL),
(6,'Lorem ipsum dolor sit amet',50,' consectetur adipiscing elit. Donec eget suscipit nulla. Integer condimentum mattis commodo. Nullam egestas condimentum vehicula. Morbi a varius mauris.','Suspendisse rutrum leo eu eros suscipit, eget tempus tellus sodales.\n\nCras metus neque, sodales id luctus commodo, laoreet a sapien. Nullam rhoncus congue ex id fringilla. Pellentesque ullamcorper tortor eget vehicula molestie. Donec id nunc leo. Quisque bibendum est non mauris porta, non luctus sem egestas. Ut aliquam nulla a turpis ultrices, vel hendrerit sem maximus.',1,9,NULL),
(16,'Mille feuilles',55,'Mille feuilles, la meilleure cr??ation de l\'humanit??.','Abaisser la p??te feuillet??e sur environ 3 mm. Tailler des rectangles de taille ??gale. La piquer ?? la fourchette pour qu\'elle ne gonfle pas puis la mettre au four sur 6, soit 180??C.\n\nPendant ce temps, pr??parer la cr??me p??tissi??re : Mettre le lait ?? bouillir.\n\nPendant ce temps, m??langer dans un saladier l\'oeuf, le sucre, le sucre vanill?? et la farine.\n\nLorsque le lait est ?? ??bullition, le verser imm??diatement dans le saladier.\n\nRemettre ?? cuire dans la casserole pendant quelques minutes afin que le liquide prenne la consistance d\'une cr??me.\n\nEtaler la cr??me p??tissi??re sur une premi??re couche de p??te, puis faire de m??me avec une seconde. Les assembler.\n\nAttendre que le g??teau soit froid pour ??taler au pinceau le glacage, fait avec beaucoup de sucre glace m??lang?? ?? un peu d\'eau. R??aliser un dessin avec le reste du glacage, m??lang?? ?? un carreau de chocolat fondu.\n\nC\'est pr??t !',2,27,NULL),
(17,'Eclair au chocolat',90,'Un classique de la patisserie','Pour la p??te ?? choux:\n\nPr??chauffer le four ?? 210??C (Thermostat 7).\n\nM??langer sel, sucre, beurre et eau dans une casserole, et faire bouillir.\n\nInt??grer la farine, et remuer jusqu\'?? l\'obtention d\'une p??te compacte. La travailler jusqu\'?? ce qu\'elle soit suffisamment ferme\n\nInt??grer 4 oeufs, un ?? un en veillant ?? bien m??langer entre chaque oeuf.\n\nTravailler la p??te afin de la rendre ferme.\n\nSur un plaque allant au four pr??alablement huil??e, r??partir ?? l\'aide de la poche ?? douille une dizaine de boudins de p??te de 15 cm de long environ.\n\nBadigeonner avec le jaune d\'??uf pour que la p??te soit dor??e ?? la cuisson .\n\nFaire cuire 25 min ?? four chaud et laisser reposer 10 min, four ??teint, pour ??viter que les choux ou les ??clairs ne d??gonflent.\n\nPour la cr??me:\n\nFaire fondre 60 g de chocolat cass?? en morceaux dans le lait, ?? feu doux .\n\nDans un bol, fouetter oeuf, jaune et sucre jusqu\'?? ce que le m??lange soit mousseux.\n\nAjouter la farine et verser dans le lait chocolat??.\n\nFaire ??paissir sans cesser de remuer.\n\nHors du feu, int??grer 20 g de beurre. Laisser refroidir.\n\nGarnir de cette cr??me les ??clairs coup??s en 2 dans le sens de la longueur et faire fondre au bain-marie le reste du chocolat et du beurre.\n\nNapper le dessus des ??clairs. Laisser durcir le gla??age avant de d??guster.',3,27,NULL),
(18,'For??t Noire',75,'A se perdre dans la saveur ;p','M??langer oeufs, sucre au fouet sur un bain-marie (pas trop chaud).\n\nAjouter farine tamis??e, levure et le beurre\n\nAjouter le chocolat fondu (sur un bain-marie ?? 30, 35??C).\n\nFaire cuire dans deux moules (diam??tre 20 ou 24) ?? 175??C pendant 30 minutes (chaleur conventionnelle).\n\nLes copeaux sont r??alis??s par ??talement en fine couche du chocolat fondu sur une plaque de marbre. Choisir le moment, ni trop froid, ni trop chaud pour les former.\n\nLes g??teaux refroidis, les couper en deux, les imbiber du jus de cerise additionn?? de kirsch\n\nMonter la cr??me en chantilly avec 100g de sucre glace.\n\nFormer le g??teau premi??re couche chantilly avec des morceaux de cerises deuxi??me couche une r??duction du jus de cerise avec un apport de sucre pour faire un caramel pas trop dur et derni??re couche de chantilly avec des morceaux de cerises.\n\nEnduire le g??teau de chantilly et disposer les copeaux de chocolat.\n\nPour un g??teau de 28 cm de diam??tre multiplier les proportions par 1,5.',3,27,NULL),
(19,'G??teau simple',25,'Un g??teau simple mais efficace','Pr??chauffez le four th.6 (180??C). Battez les ??ufs entiers avec le sucre en poudre dans un grand saladier jusqu????? ce que le m??lange blanchisse et soit bien homog??ne. Ajoutez alors la farine, le sel et la levure chimique puis m??langez de nouveau afin de bien int??grer ces nouveaux ingr??dients ?? la pr??paration.\n\nD??layez la pr??paration en versant progressivement le lait puis l???huile neutre, tout en continuant de m??langer. Remuez jusqu\'?? obtenir une p??te bien lisse.\n\nBeurrez un moule ?? cake et versez-y la p??te. Vous pouvez ??galement utiliser un moule en silicone sans y ajouter de mati??re grasse.\n\nEnfournez et faites cuire le g??teau simple pendant environ 45 min. V??rifiez la cuisson du g??teau avec la pointe d???un couteau. Elle doit ressortir propre et s??che ?? la fin de la cuisson.\n\n?? la sortie du four, d??moulez le g??teau sur un plat de service. D??gustez ti??de de pr??f??rence, napp?? d???un peu de cr??me anglaise, ou accompagn?? de quelques cuiller??es de confiture ou de p??te ?? tartiner.',1,29,NULL),
(23,'G??teau au yaourt',50,'Un g??teau aussi simple que d??licieux et pour les mesures vous n\'aurez besoin que d\'un pot de yaourt !','Pr??chauffer le four ?? 180??\n\nMettre dans une cuve de robot ou un saladier les ingr??dients suivants :\n\nVerser le pot de yaourt\n\nVerser 3 pots de farine\n\nVerser 2 pots de sucre et le sachet de sucre vanill??\n\nVerser 75% de la quantit?? pot en huile de tournesol\n\nCasser et verser les oeufs un par un\n\nMettre le sachet de levure chimique\n\nBattre la pr??paration au robot ou au fouet manuel (non conseill??), jusqu\'?? obtenir un m??lange ??pais et homog??ne)\n\nBeurrer puis fariner votre moule\n\nVerser votre pr??paration dans le moule\n\nEnfourner 35 minutes ?? 180??\n\nPour v??rifier la bonne cuisson de votre g??teau, plantez un couteau en son centre, si le couteau est propre, votre g??teau est parfaitement cuit !',1,30,NULL);
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
(1,4,'3 cuill??re ?? soupe'),
(1,6,'300g'),
(1,7,'60cl'),
(1,9,'3'),
(1,24,'2 cuill??re ?? soupe'),
(2,9,'3'),
(2,11,'100g'),
(2,18,'1 sachet'),
(3,9,'5'),
(3,11,'100g'),
(3,35,'5 cuill??re ?? soupe'),
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
(6,24,'3 cuill??re ?? soupe'),
(6,29,'1'),
(6,66,'18'),
(16,4,'25g'),
(16,7,'1/4 L'),
(16,34,'1/2'),
(16,74,' '),
(16,75,'1'),
(17,4,'4 c.??.s'),
(17,6,'200 G'),
(17,7,'30 cL'),
(17,11,'210 G'),
(17,16,'1 pinc??e'),
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
(19,16,'1 pinc??e'),
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
