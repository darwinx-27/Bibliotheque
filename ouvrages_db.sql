-- <!-- /****************************************************************
-- * Projet
-- : Gestion de la biliothèque
-- * Code PHP : index.php
-- ****************************************************************
-- * Auteur 1 : KAMGA MUKAM CHARLES CYRILLE
-- <charles.kamga@facsciences-uy1.cm>
-- * Auteur 2 : KENGNE TSHIENEGHOM THERESE VIANNEY
-- <therese.kengne@facsciences-uy1.cm>
-- * Auteur 3 : KEMADJOU NGONGANG MAHEVA NOEL
-- <maheva.kemadjou@facsciences-uy1.cm>
-- * ...
-- ****************************************************************
-- * Date de création
-- : 04-07-2025 (04 Juillet 2025)
-- * Dernière modification : 05-07-2025 (05 Juillet 2025)
-- ****************************************************************
-- * Description
-- ce script repreente le formulaire qui collecte les données qui seront envoyés à supprimer.php.
-- ****************************************************************
-- * Historique des modifications
-- * 04-07-2025 : Création du fichier index.php pour la page
-- *
-- ***************************************************************/ -->

CREATE DATABASE IF NOT EXISTS ict108;
USE ict108;

CREATE TABLE IF NOT EXISTS ouvrage (
    isbn VARCHAR(20) PRIMARY KEY,
    titre VARCHAR(255),
    auteur VARCHAR(255),
    editeur VARCHAR(255),
    annee INT,
    description TEXT,
    couverture VARCHAR(255)
);
INSERT INTO ouvrage VALUES('9780000000001', 'L\'enfant noir', 'Camara Laye', 'Plon', 1953, 'Roman autobiographique d\'un jeune Guinéen.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000002', 'Une si longue lettre', 'Mariama Bâ', 'Nouvelles éditions africaines', 1979, 'Lettre d\'une femme à une amie après un veuvage.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000003', 'Le devoir de violence', 'Yambo Ouologuem', 'Seuil', 1968, 'Roman historique sur l\'Afrique précoloniale.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000004', 'Le vieux nègre et la médaille', 'Ferdinand Oyono', 'Présence africaine', 1956, 'Critique du colonialisme à travers le regard d’un vieil homme.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000005', 'L\'aventure ambiguë', 'Cheikh Hamidou Kane', 'Julliard', 1961, 'Conflit entre tradition africaine et modernité occidentale.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000006', 'L\'État honteux', 'Achille Mbembe', 'La Découverte', 1999, 'Essai sur la politique postcoloniale en Afrique.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000007', 'Allah n\'est pas obligé', 'Ahmadou Kourouma', 'Seuil', 2000, 'Un enfant-soldat raconte son parcours dans les guerres africaines.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000008', 'Verre cassé', 'Alain Mabanckou', 'Seuil', 2005, 'Chroniques d’un bar populaire au Congo.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000009', 'Le monde s\'effondre', 'Chinua Achebe', 'Actes Sud', 1958, 'Roman sur la colonisation au Nigeria.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000010', 'Moi, Tituba sorcière', 'Maryse Condé', 'Mercure de France', 1986, 'Vie romancée de la sorcière de Salem.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000011', 'Les soleils des indépendances', 'Ahmadou Kourouma', 'Seuil', 1968, 'Satire des régimes africains postindépendance.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000012', 'Cahier d’un retour au pays natal', 'Aimé Césaire', 'Présence africaine', 1939, 'Poème sur la condition noire et le colonialisme.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000013', 'Texaco', 'Patrick Chamoiseau', 'Gallimard', 1992, 'Saga d’un quartier de Martinique racontée par ses habitants.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000014', 'Rue des boutiques obscures', 'Patrick Modiano', 'Gallimard', 1978, 'Roman sur l\'identité et la mémoire (franco-africain par influence).', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000015', 'Les bouts de bois de Dieu', 'Sembène Ousmane', 'Présence africaine', 1960, 'Grève des cheminots au Sénégal sous la colonisation.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000016', 'Femmes au bain', 'Gabriel Mwéné Okoundji', 'L\'Harmattan', 2006, 'Poèmes sur l’Afrique et les femmes.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000017', 'La vie et demie', 'Sony Labou Tansi', 'Seuil', 1979, 'Roman surréaliste sur la dictature.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000018', 'Nouvelles du pays', 'Jean-Marie Adiaffi', 'NEA', 1981, 'Nouvelles engagées de Côte d’Ivoire.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000019', 'La grève des Bàttu', 'Aminata Sow Fall', 'NEA', 1979, 'Satire sur la mendicité au Sénégal.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000020', 'La chanson de Hannah', 'Jean-Noël Pancrazi', 'Gallimard', 1999, 'Roman sur la mémoire coloniale algérienne.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000021', 'L\'impasse', 'Monique Ilboudo', 'Éditions le Figuier', 1996, 'Roman burkinabé sur la sexualité et la société.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000022', 'L\'œil du cyclone', 'Patrick Nguema Ndong', 'Gabon Éditions', 1991, 'Roman d’initiation mystique et fantastique.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000023', 'Le terroriste noir', 'Tierno Monénembo', 'Seuil', 2012, 'Histoire vraie d’un tirailleur africain pendant la Seconde Guerre.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000024', 'Petals of Blood', 'Ngugi wa Thiong\'o', 'Heinemann', 1977, 'Critique du néocolonialisme au Kenya.', 'default.jpg');
INSERT INTO ouvrage VALUES('9780000000025', 'Shadow of Imana', 'Veronique Tadjo', 'Heinemann', 2000, 'Survivance et mémoire du génocide rwandais.', 'default.jpg');
