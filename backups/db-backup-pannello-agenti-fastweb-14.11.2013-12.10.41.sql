DROP TABLE IF EXISTS `agencies`;

CREATE TABLE `agencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agency` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


LOCK TABLES `agencies` WRITE;

INSERT INTO agencies VALUES('1','DWMP');

INSERT INTO agencies VALUES('2','LT');

INSERT INTO agencies VALUES('3','Personale');

UNLOCK TABLES;


DROP TABLE IF EXISTS `agents`;

CREATE TABLE `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_agente` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


LOCK TABLES `agents` WRITE;

INSERT INTO agents VALUES('1','Bedendo');

INSERT INTO agents VALUES('2','Bertucci');

INSERT INTO agents VALUES('3','Furbatto');

INSERT INTO agents VALUES('4','Iaculano');

INSERT INTO agents VALUES('5','Pala');

INSERT INTO agents VALUES('6','Perino');

INSERT INTO agents VALUES('7','Perra');

UNLOCK TABLES;


DROP TABLE IF EXISTS `missions`;

CREATE TABLE `missions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agenzia` int(11) NOT NULL,
  `ragione_sociale` varchar(200) NOT NULL,
  `agente` int(11) DEFAULT NULL,
  `indirizzo` varchar(45) DEFAULT NULL,
  `comune` varchar(45) DEFAULT NULL,
  `provincia` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `referente` varchar(45) DEFAULT NULL,
  `ruolo` varchar(45) DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `esito1` varchar(45) DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `esito2` varchar(45) DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `esito3` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;


LOCK TABLES `missions` WRITE;

INSERT INTO missions VALUES('1','1','AGENZIA TRIS','4','Viale Giardini','Modena','MO',NULL,NULL,NULL,'2013-09-29 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('2','2','HIC ADV','7','via emilia san pietro, 21','Reggio Emilia','RE',NULL,NULL,NULL,'2013-09-29 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('3','2','TECNO 3 ','4','Via Dei Marmorari','Spilamberto','MO',NULL,NULL,NULL,'2013-10-02 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('4','2','COSMONT','7','Via Sacco e Vanzetti, 9','Bibbiano','RE',NULL,NULL,NULL,'2013-10-02 00:00:00','1','2013-11-14 00:00:00','5',NULL,NULL,NULL);

INSERT INTO missions VALUES('5','2','INVOGUE SRL','5','Via Newton, 10','Piove di sacco','PD',NULL,NULL,NULL,'2013-10-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('6','1','SERVIZI IMMOBILIARI NUOVA MILLENIUM','1','Via Gardesana 67/A','Bussolengo','VR','457153121','Sig. Alvise Girelli','TITOLARE','2013-10-07 00:00:00','3',NULL,NULL,NULL,NULL,'1');

INSERT INTO missions VALUES('7','2','CUSINATO GIOVANNI ','5','Via Monte Pelmo, 8','San Martino di Lupari','PD',NULL,NULL,NULL,'2013-10-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('8','2','MEETING SPA ','5','Corso Argentina, 5','Padova','PD',NULL,NULL,NULL,'2013-10-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('9','1','ALZARI','3','Via Raffaele Ruggiero','Napoli','NA',NULL,NULL,NULL,'2013-10-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('10','2','PEMA GROUP','5','Via luigi einaudi,11/13','Piazzola sul Brenta','PD',NULL,NULL,NULL,'2013-10-08 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('11','1','COSMO','3','Piazza Matteotti','Napoli','NA',NULL,NULL,NULL,'2013-10-08 00:00:00','3',NULL,NULL,NULL,NULL,'1');

INSERT INTO missions VALUES('12','2','LENDER SPA','5','Corso Stati Uniti 23/B','Padova','PD',NULL,NULL,NULL,'2013-10-09 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('13','1','EDILTECO SPA','4','Via dell\'Industria','San Felice Sul Panaro','MO',NULL,NULL,NULL,'2013-10-09 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('14','1','CARILE','3','Via Santa Lucia 15','Napoli','NA',NULL,NULL,NULL,'2013-10-09 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('15','2','NUOVA GRAFICE','7',NULL,NULL,'RE',NULL,NULL,NULL,'2013-10-09 00:00:00','1','2013-11-14 00:00:00','5',NULL,NULL,NULL);

INSERT INTO missions VALUES('16','2','EUROBODY','4','Via Tacito','Modena','MO',NULL,NULL,NULL,'2013-10-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('17','2','ELETTTRIC 80','7','Via Guglielmo Marconi','Viano','RE',NULL,NULL,NULL,'2013-10-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('18','2','ITAL-PLASTICK SRL ','5','Viale dell\'Artigianato','Cittadella','PD',NULL,NULL,NULL,'2013-10-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('19','2','VETTORE ANTONIO ','5','Via Torino, 12','Padova','PD',NULL,NULL,NULL,'2013-10-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('20','1','DE SIMO','3',NULL,'Napoli','NA',NULL,NULL,NULL,'2013-10-14 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('21','2','STEEL FORM','4','Via Sandro Cabassi, 42','Modena','MO',NULL,NULL,NULL,'2013-10-22 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('22','2','ZAPI','7','Via Parma, 59','Poviglio','RE',NULL,NULL,NULL,'2013-10-22 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('23','2','MISTRAL SRL','5','Strada del Santo, 110','Cadoneghe','PD',NULL,NULL,NULL,'2013-10-23 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('24','2','SEC SERVIZI S.CONS.P.A','5','Via Transalgardo, 1','Padova','PD',NULL,NULL,NULL,'2013-10-23 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('25','2','TOLOMIO S.R.','5','Via Pelosa, 138','Camposampiero ','PD',NULL,NULL,NULL,'2013-10-24 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('26','2','PROMO MEDIA','5','Via Turazza Domenico 28','Padova','PD',NULL,NULL,NULL,'2013-10-26 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('27','2','BERTELE REMO','7','Via 25 Aprile ','Gualtieri','RE',NULL,NULL,NULL,'2013-10-26 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('28','2','GASTONE CRM','7','Via delle Basse, 1','Collicchio','PR',NULL,NULL,NULL,'2013-10-28 00:00:00','3',NULL,NULL,NULL,NULL,'1');

INSERT INTO missions VALUES('29','1','ARA SPA','6','Via giuseppe di vittorio 15A','San pancrazio parmense','Pr','521670411','Sebastiano Sorba','Resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('30','1','Autofficina reica','3','via francesco galeota 13','napoli','na','815932761','mario','tit','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('31','2','bedigital','5','via beltrami gino 15/a','verona','vr','458352440','giovanni','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('32','2','Biemme ','5','Via Marconi 77','Saletto ','pd','429841385','Giuglietti','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('33','2','COSBEN SRL','4','VIA CARRATE N. 1/D','SOLARA DI BOMPORTO','mo','59801056','simone','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('34','2','EUROCONTROL SYSTEMS SRL','5','Via Mancalacqua, 20','FRAZ. LUGAGNANO - SONA','vr','458680444','picchi','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('35','1','Experior','6','via vittorio veneto 10','fornovo di taro','pr','5252202','Adorni','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('36','1','full service','1','via primo maggio 88','bevilacqua','vr','44295243','alessandro','tit','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('37','1','Kemin nutrisurance','1','via dell\'industria 1','veronella','vr','442482711','fusco','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('38','1','la compagnia dei viaggi','1','via fiume 5','legnago','vr','442602059','ilaria','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('39','2','LUNDBECK PHARMACEUTICALS S.P.A.','5','Strada Quarta','Padova','pd','498699311','Carletti','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('40','2','piletti','2','via provinciale 11','sissa','pr','521879375','carlo','resp','2013-11-04 00:00:00','2',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('41','2','plastica ognibene','7','via sanbiagio 5','correggio','re','522693724','mchela','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('42','2','TECNIDEA CIDUE S.R.L','5','Via Apollo XI 12','San Giovanni Lupatoto ','vr','458750250','michele','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('43','2','TECNORD SRL ','4','VIA FERNANDO MALAVOLTI N. 36 ','modena','mo','59254895','giacomo','resp','2013-11-04 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('44','2','acuq chiara srl','7','via fratelli cervi 10','reggio emilai','re','338780950','diego','resp','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('45','1','camvo','1','via dell\'aviere 27','bovolone','vr','456902289','sig serena ','Resp','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('46','2','carma','1','via canove centagnano','san martino  buon albergo','vr','45994848','calgari','tit','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('47','1','casardi','4','via largoaldo moro 1','modena','mo','59239856','casardi francesco','Tit','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('48','1','Costruzioni Rossi','6','via della rodella 36','lesignano de bagni','pr','521350264','Marina','Resp','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('49','2','DEMETRA SRL ','4','Via Malpighi 16','castelfranco emilia','mo','59920659','francesco','resp','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('50','2','EURO METAL S.R.L','5','Via Dell\' Artigianato 9 ','Busiago','pd','499630397','giuseppe','resp','2013-11-05 00:00:00','2',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('51','1','fontanelli mario','1','via aldo moro 26','opeano','vr','456970611','Fontanelli ','Tit','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('52','1','fostudio 5 ','6','via cheguevara 10','luzzara','re','522977021','Martelli','Tit','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('53','1','imal','4','via rosalba carriera 63','modena','mo','59465500','Zoboli','resp','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('54','1','Isola infissi','1','via camagre 26','isola della scala','vr','456630924','marco','tit','2013-11-05 00:00:00','2',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('55','2','LA. Ce CO SRL','4','Via Perossaro 264','san felice sul panaro','mo','535671110','carlo','resp','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('56','2','landi renzo','2','via nobel 2','cortegge','re','5229433','mario','resp','2013-11-05 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('57','2','Litostampa  la rapuda','7','via garibaldi ','casalgrande','re','522846167','claudio','tit','2013-11-05 00:00:00','3',NULL,NULL,NULL,NULL,'1');

INSERT INTO missions VALUES('58','1','Manni rappresentanze','4','viale Gramsci 284','modena','mo','59451572','Crisitna','Resp','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('59','2','NUOVA RIO SPA','4','VIA CHIAVICA MARI N. 33','possidonio','mo','53539016','zanasi','tit','2020-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('60','1','supemrcato di perdi','6','strada del parma 70','montechiarugolo','pr','521686242','Mirca','Tit','2013-11-05 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('61','1','Autostile','2','radici nord 96','castellarano','re','536859481','massari','tit','2013-11-06 00:00:00','5',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('62','1','BONAZZI ELETTROMECCANICA ELETTROPOMPE AUTOCLAVI S.n.c.','7','Via F. Cavatorti 54','campegine','re','522677125','sig. bonazzi','TITOLARE','2013-11-06 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('63','1','carignani','3','traversa fossitelli snc','napoli','na','815591368','Bruna','tit','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('64','1','ceramiche ita','2','via 25 aprile 12','salvaterra casalgrande','re','522621353','franca','resp','2013-11-06 00:00:00','5',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('65','1','Contec','1','viale del lavoro 33','san martino buon albergo','vr','45990109','Ilaria','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('66','1','delcom','4','via antonio araldi 44 ','modena','mo','0593649 61','Paccioni ','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('67','2','europeltro','5','via dell\'artigianato 26','due carrare','pd','499125100','caltarossa','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('68','2','Gabrielli srl','5','via maiorana 19','cadoneghe','pd','49887357','zantonio','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('69','2','Italchero','4','via p lumumba 2','modena','mo','5925500711','claudio','tit','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('70','1','marcopolo immobiliare','4','via caruso 35','vignola','mo','59764717','Lorenzo','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('71','2','moder frigo ','4','via antonio labriola 29','modena','mo','59330390','mazzanti','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('72','2','natuica','5','via nomentana 192','noventa  padovana','pd','498935992','moreno','tit','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('73','2','protostamp','7','via cisa 144/b','brascello','re','522680608','elisa','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('74','1','ricerca metodi','3','via galileo ferraris','napoli','na','815539383','ing granato','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('75','1','Serigrafia veneta','1','via san zeno 5','negrar','vr','457501847','Paola','resp','2013-11-06 00:00:00','3',NULL,NULL,NULL,NULL,'1');

INSERT INTO missions VALUES('76','1','Sugestione Viaggi','1','via calabria 3/a','verona','vr','458905258','Puja','Tit','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('77','2','Tecoma','5','via irpinia 7','villa tora saonara','pd','49644933','tatiana','tit','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('78','1','total service','4','via vasco de gama 28','carpi','mo','59643255','Loredana','tit','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('79','2','ver air','1','via ticino 5','sangiovanni lupatotto','vr','458751227','tigli','resp','2013-11-06 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('80','2','AGAPTOUR VIAGGI E CROCIERE DIREZIONE S.r.l.','4','Viale Caduti 1','Sassuolo','MO','536882900','Sig. Filippo Saponaro','RESPONSABILE','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('81','2','Carnevali Auto ','4','VIA VIGNOLESE 1144','MODENA ','mo','59448911','Carnevali Angelo','Tit','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('82','2','CMA BACCEGA SRL','5','Via Della Prefabbricazione 7','Fontaniva (PD)','pd','499420033','Sig. Serena','Tit','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('83','1','COBALTO SRL','1','Via Sei Fontane, 7','Castelnuovo del Garda','VR','457570019','Sig. Damiano','TITOLARE','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('84','1','DOARDO AGOSTINO','1','Via Crocioni, 46','Bussolengo','VR','456766266','Sig. Doardo Agostino','TITOLARE','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('85','1','LEBERCO PACKAGING SPA','1','Località Crocioni, 43','Bussolengo','VR','456766458','Sig. Davide','Referente','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('86','2','Marangoni Pneumatici','7','via del garda 6','Rovereto','tn','464301111','Paolo Daniele','Referente','2013-11-07 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('87','2','RE TEODORICO VIAGGI SRL','1','VIA PALLONE N. 16','VERONA','vr','45596944','sig. Enrico','Tit','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('88','2','SEGMADESIGN PROJECT S.r.l.','2','Via Sardegna 3','Reggio nell\'Emilia','RE','522330440','Sig. Chiari','SOCIO/A','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('89','2','SVILUPPO AMBIENTE E SICUREZZA S.a.s.','2','Via Fattori 1/H','scandiano','re','522851024','elena','resp','2013-11-07 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('90','2','A&M PRODUCTION SRL','7','VIA CARNOT LAZARE NICOLAS N. 1 ','Reggio emilia','re','522533911','Sig. Vincenzo','RESPONSABILE','2013-11-08 00:00:00','5',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('91','1','BAGNI VASCO RICAMBI ELETTRICI PER AUTOVEICOLI ','4','Via San Faustino 155/O','modena','mo','59358989','lorenzo panaro','resp','2013-11-08 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('92','2','Ceramiche opera','4','Via martinella 74','maranello','mo','536934811','Sig, Melotti','RESPONSABILE','2013-11-08 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('93','1','CONDOMETT S.r.l.','2','Località Coduro 3/A','Fidenza','pr','52481048','marco le besagn','ti','2013-11-08 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('94','1','LANCIA OFFICINA AUTORIZZATA LANCIA E AUTOBIANCHI VESCOVI RENATO ','7','Strada Argini Parma 98','parma','pr','521250786','vescovi','resp','2013-11-08 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('95','2','Mesa elettronica','7','Via Puccini','San Martino in Rio','RE','522698933','Sig. Poli Livio','TITOLARE','2013-11-08 00:00:00','2',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('96','2','PEDRETTI ARCH PAOLA ','2','Via San Giovanni 16','Piacenza','PC','523010056','Arch. Paola Pedretti','RESPONSABILE','2013-11-08 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('97','1','SALGAROLO GINO E C S A S S.a.s.','1','Via Sorte 64/A','San Bonifacio (VR)','vr','456103427','salgarolo','tit','2013-11-08 00:00:00','3',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('98','2','AUXIND SRL','2','VIA MARIA MONTESSORI N. 25','REGGIO EMILIA','RE','522520312','Sig. Salani','Titolare','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('99','2','B E C S.r.l.','7','Via Volta Alessandro 57','Casalgrande','RE','522840651','Sig. Berselli','TITOLARE','2013-11-11 00:00:00','5',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('100','1','COMPAGNIA ITALIANA METANO S.r.l.','2','Via Statale 62/12','guastalla','RE','522824613','romeo','TITOLARE','2013-11-11 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('101','1','EM AUTO S.n.c.','1','Via Molino di Sopra 34/A','nogara','VR','44289904','eris','RESPONSABILE','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('102','2','FILA SPA','5','Via Garibaldi Giuseppe 32','San Martino Di Lupari ','PD','499467300','Sig.Merlo','Titolare','2013-11-11 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('103','2','GRASSELLI ING CARLO Coop.','2','Via Martiri di Cervarolo 30','Reggio nell\'Emilia','RE','522551131','Sig. Grasselli Francesco','FIGLIO/A TITOLARE','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('104','2','INDUSTRIA CASEARIA DI PIEVEPELAGO SRL','4','VIA ISOLA LUNGA N. 4','PIEVEPELAGO','MO','53671860','sig. Nizzi Maurizio','TITOLARE','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('105','1','M.CO DE FONZO E CO S.r.l.','3','Via Agostino Depretis 88','Napoli','NA','815512915','Marco De Fonzo','TITOLARE','2013-11-11 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('106','2','NUOVA UME VENETO SRL','5','Via Pioga','Campodarsego ','PD','495564166','Sig.Mendetto','Titolare','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('107','2','POLI GROUP SRL','1','VIA DEL LAVORO N. 18','VILLAFRANCA DI VERONA ','VR','457302489','Marzo Manlio','TITOLARE','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('108','2','PRAMPOLINI STEFANO ','4','Largo Garibaldi 12','Modena','MO','59217934','Sig.ra Elena','RESPONSABILE','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('109','2','RITONNARO COSTRUZIONI SRL','1','VIA CAMPALTO N. 47','S MARTINO BUON ALBERGO ','VR','458781896','Nunzio Ritonnaro','TITOLARE','2013-11-11 00:00:00','2',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('110','1','RONDANINI ADRIANO ','2','Via Ca\' Bellani 10','scandiano','RE','522982465','nicoletta','RESPONSABILE','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('111','2','SELF SERVICE SPA','1','VIA ANTONIO PACINOTTI N. 28/30','VERONA ','VR','458205896','Umberto','RESPONSABILE','2013-11-11 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('112','1','STUDIO GAINO ','1','Via Mazzini 15','vigasio','VR',NULL,'alessandro','RESPONSABILE','2013-11-11 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('113','2','TECNO AUTO ','7','Via Contarella 26','Scandiano','RE','522856368','Sig. Guidelli','RESPONSABILE','2013-11-11 00:00:00','2',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('114','2','ZACCARIA COSTRUZIONI SRL','4','VIA PONTICELLO N. 154','MONTESE ','MO','59970009','sig.Giusi','RESPONSABILE','2013-11-11 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('115','1','AUTOCARROZZERIA F LLI GALLELLA DI GALLELLA GIUSEPPE E C S.n.c.','7','Via A. Volta 5','Bagnolo in Piano','RE','522952224','Sig. Giuseppe','RESPONSABILE','2013-11-12 00:00:00','2',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('116','1','AUTOFFICINA A R ALETTA ALFREDO OFFICINA MECCANICA S.n.c.','3','Via Emilio Scaglione 47','Napoli','NA','815853041','Sig, Romeo','TITOLARE','2013-11-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('117','1','COMER S.p.A.','2','Località San Tomaso Via Storchi 8','Bagnolo in Piano','RE','522955041','orlando','RESPONSABILE','2013-11-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('118','1','FLORICULTURA CAIUMI GINO S.a.s.','7','Via Carlo Teggi 5','Reggio nell\'Emilia','RE','522381989','Sig. Caiumi Andrea','TITOLARE','2013-11-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('119','1','ISALBERTI ALESSANDRO ','1','Stradone Porta Palio 54','Verona','VR','458031392','Avv. Isalberti Alessandro','TITOLARE','2013-11-12 00:00:00','5',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('120','2','CSC ITALIA SRL','5','VIA SAN CRISPINO','PADOVA','PD','496983111','SIG. FILIPPI (CED)/SIG.RA FRANCESCA','RESPONSABILE','2013-11-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('121','2','FASOLI GIOIELLI SRL','1','VICOLO GIDINO N. 1','SOMMACAMPAGNA','VR','458960544','SIG.RA ALESSANDRA','RESPONSABILE','2013-11-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('122','2','OFFICINA MECCANICA BENEVENTI SNC','2','VIA DELL\'INDUSTRIA N. 3','SCANDIANO','RE','522857418','SIG.RA ROMINA','RESPONSABILE','2013-11-12 00:00:00','5',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('123','2','FLAVIKER PISA CERAMICA SPA','4','STRADA STATALE 569 PER VIGNOLA','CASTELVETRO DI MODENA','MO','599752011','SIG. COLOMBINI CORRADO','RESPONSABILE','2013-11-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('124','2','PROSCIUTTIFICIO GIUSTI','4','VIA D\'AZEGLIO N. 158','FRAZ.RACCAMALATINA - GUIGLIA','MO','59795907','SIG. LORENZO/SIG.RA GIULIA','RESPONSABILE','2013-11-12 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('125','2','LABITECH SRL','7','VIA LODOVICO BORSARI N. 5/A','PARMA','PR','5211913411','VINCENZO MARRONE','RESP.TECNICO','2013-11-12 00:00:00','5',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('126','1','AUTOFFICINA PIRONATO MANUELE ','1','Via Roveggia 51/B','Verona','VR','458204832','Sig. Pironato Manuele','TITOLARE','2013-11-13 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('127','1','CORBELLINI FAUSTA S.r.l.','2','Via Ferdinando di Borbone 125','Piacenza','PC','523504742','Sig. Corbellini','TITOLARE','2013-11-13 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('128','1','F LLI SALA CARROZZERIA SALA E ANDREONI CARROZZIERI ','2','Via Rodolfo Boselli 78','Piacenza','PC','523593985','Sig.ra Claudia','RESPONSABILE','2013-11-13 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('129','2','HIT SRL','7','Via tosi 6','reggio emilia','RE','596229975','soncini',NULL,'2013-11-13 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('130','1','UDAF CONSULT S.r.l.','7','Via Radici Sud 10','Castellarano','RE','536825170','Sig. Benasti','RESPONSABILE','2013-11-13 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('131','1','GLOBAL S.r.l.','7','Via Dei Mille 6/C','Reggio nell\'Emilia','RE','522434963','Sig. Wagner Ivan','TITOLARE','2013-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('132','1','I E M S.r.l.','1','Via Luigi Galvani 22/C','Verona','VR','45563003','Sig.ra Ambra','TITOLARE','2013-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('133','1','M G S TECNOIMPIANTI S.r.l.','1','Via Staffali 11/B','Villafranca di Verona','VR','458600924','Sig. Segala Eros','TITOLARE','2013-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('134','1','AFFINT S.r.l.','1','Località Porton 30','Rivoli Veronese','VR','456200771','Sig. Bonetti','RESPONSABILE','2013-11-15 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('135','1','EDEMPG AGENZIA DI COMUNICAZIONE E MARKETING STRATEGICO S.r.l.','7','Borgo Trinita 19','Parma','PR','521239063','Sg.Ra Zanichelli Chiara','RESPONSABILE','2013-11-18 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('136','1','AUTOFFICINA PLANET 4X4 OFFROAD ','7','Via Nazionale 39','Collecchio','PR','521809076','Sig. Gardoni Samuel','TITOLARE','2013-11-18 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('137','1','ASSOCIAZIONE PUBBLICA ASSISTENZA UFFICIO ','7','Via Parco Mazzini G. 11','Salsomaggiore Terme','PR','524572408','Sig. Richelli','RESPONSABILE','2013-11-19 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('138','2','TEA ENERGY SRL','1','VIA CHIODA N. 177','VERONA','VR','45503743','SIG.RA LUCIA',NULL,'2013-11-13 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('139','2','TRANSALDI SRL','1','VIA SOMMACAMPAGNA N. 63','VERONA','VR','458622092','GIORGIO','RESPONSABILE','2013-11-13 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('140','2','MELEGATTI SPA','1','VIA MONTE CAREGA N. 23','VERONA','VR','458951444','DIEGO ROCCO','RESPONSABILE','2013-11-13 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('141','2','FRANCO FABBRI SRL','5','VIA POLO MARCO','CAMPODARSEGO','PD','495566000','SIG. FABBRI','TITOLARE','2013-11-13 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('142','2','CORVALLIS SPA','5','VIA GIOVANNI SAVELLI','PADOVA','PD','498434511','SIG. DEL LAZZER','TITOLARE','2013-11-13 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('143','2','GRUPPO MECA SRL','7','VIA ZANI 10/A','BORETO ','RE','522964155','ROBERTO MANOTTI','TITOLARE','2013-11-13 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('144','2','FUTUR GLASS SRL','4','VIA DI VITTORIO N. 12/S','CAMPOGALLIANO','MO','59527047','SIG. GRAZIANO','SOCIO','2013-11-13 00:00:00','4',NULL,NULL,NULL,NULL,'2');

INSERT INTO missions VALUES('145','2','YPSILON SRL','4','VIA DEI BARROCCIAI N. 31/A','CARPI','MO','59647911','SIG.RA DANIELA',NULL,'2013-11-13 00:00:00','5',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('146','2','LE PLEADI','4','VIA O. RESPIGHI N. 276','MODENA','MO','59283310','SIG. MASCELLANI','PROPRIETARIO','2013-11-13 00:00:00','1',NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('147','2','LOCAGOLD SRL','1','VIA TOLOMEO N. 2','VERONA','VR','458250391','DORIANA','RESPONSABILE','2013-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('148','2','SEGALA SRL ','1','VIA FALCONA N. 8 ','VERONA','VR','458920250','SEGALA LUCIANO',NULL,'2013-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('149','2','ZEMI SNC','5','VIA ENRICO MATTEI N. 7','DUE CARRARE ','PD','499125137','MARA',NULL,'2013-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('150','2','SERCOM SRL','5','VIA VENETO N. 12','DUE CARRARE ','PD','495290553','NICOLETTA RENIER','RESPONSABILE','2013-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('151','2','POLISISTEM SAS','7','VIA VAL D\'ENZA NORD N. 197','CANOSSA ','RE','522872172','DANIELE CASTAGNETTI',NULL,'2013-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('152','2','NUOVA RIO SPA','4','VIA CHIAVICA MARI N. 33','SAN POSSIDONIO','MO','053539016','NICOLETTA RENIER','REFERENTE','2020-11-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO missions VALUES('153','1','SALETTI ELITECNICA','1','LARGO CALDERA, 9','VERONA','VR','0458031750','MARCO DE PIZZOL','TITOLARE','2013-10-28 00:00:00','3',NULL,NULL,NULL,NULL,'1');

UNLOCK TABLES;


DROP TABLE IF EXISTS `outcomes`;

CREATE TABLE `outcomes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outcome` varchar(45) NOT NULL,
  `keywords` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


LOCK TABLES `outcomes` WRITE;

INSERT INTO outcomes VALUES('1','trattativa',NULL);

INSERT INTO outcomes VALUES('2','assente','non c\'era');

INSERT INTO outcomes VALUES('3','chiuso',NULL);

INSERT INTO outcomes VALUES('4','ko',NULL);

INSERT INTO outcomes VALUES('5','spostato','rimandato');

UNLOCK TABLES;


DROP TABLE IF EXISTS `states`;

CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


LOCK TABLES `states` WRITE;

INSERT INTO states VALUES('1','Chiusa');

INSERT INTO states VALUES('2','KO');

UNLOCK TABLES;


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


LOCK TABLES `users` WRITE;

INSERT INTO users VALUES('1','pinkynrg','dir2004caz','Francesco','Meli');

INSERT INTO users VALUES('2','doriano','rozzi@55','Doriano','Rozzi');

INSERT INTO users VALUES('3','maru','juventus31','Marusca','Razzoli');

UNLOCK TABLES;


