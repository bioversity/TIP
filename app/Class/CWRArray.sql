INSERT INTO `cropwildrelative`
  (`NICODE`, `NIENUMB`, `INSTCODE`, `GENUS`, `SPECIES`, `SUBTAUTHOR`, `TAXREF`, `CROPNAME`, `LRRECDATE`, `LRNUMB`, `LRNAME`, `LRSLATDD`, `FLONGDMS`, `FLONGDD`, `LRSEPSGCODE`, `LRSGPS`, `LRSRADIALED`, `LRSELEVATION`, `FARMERID`, `FARMERYB`, `FARMHT`, `EXSECURE`, `EXDUPL`, `Population_identifier`, `Accession_specimen_number`, `Collecting_number`, `Collecting_source`, `Type_specimen_language_of_common_taxon_name`, `Conservation_actions_in_place`, `Conservation_priority`, `Conservation_country_code`, `IUCN_red_list_category`, `Country_assessment`, `Year_of_red_list_assessment`, `Endangerment_status_according_to_national_criteria`, `Country_code`, `Taxon_status`, `Biological_status`, `Populatuion_area`, `Total_number_of_individuals_in_the_population`, `Site_location`, `Decimal_latitude`, `Decimal_longitude`, `Maximum_uncertainty_estimate`, `Elevation`)
VALUES
  ('GBR',  '',  'GBR102',  'Avena',   'barbata',   '',  '',  '',  '2012-10-10',  'A1',  'wild oat',  '52,486243',  '',  '-1,890401',  '',  '10',  '',  '142',  '',  '',   '',  '',  '',  '1RT',  '2301', '23',  '10',  'ENG', '0',  '1',  'GBR',  'CR',  'GBR',  '2000',  'GBR', '10',  '',  'wild',  '20',  '15',   'Birmingham','52,486243',  '-1,890401',  '22,34', '142'),
  ('PRT',  '',  'PRT005',  'Beta',    'patula',    '',  '',  '',  '2012-10-10',  'A2',  '',         '32,5442',    '',  '-16,513127', '',  '10',  '',  '',     '',  '-1', '',  '',  '',  '2MS',  '4102', '4',   '10',  'PRT', '0',  '2',  'PRT',  'CR',  'PRT',  '2011',  '10',  'PRT', '10','wild',  '233', '2,500','Ilheo',     '32,54420',   '-16,513127', '171,97','-1'),
  ('FIN',  '',  'FIN001',  'Brassica','macrocarpa','',  '',  '',  '2010-10-10',  'A2',  '',         '60,173816',  '',  '24,926746',  '',  '10',  '',  '21' ,  '',  '',   '',  '',  '',  '3AC',  '512',  '72',  '10',  '0',   '0',  '3',  'FIN',  'END', 'FIN',  '2012',  'FIN', '10',  '',  'wild',  '50',  '6',    'helsinki',  '60,173816',  '24,926746',  '',      '21'),
  ('ITA',  '',  'ITA136',  'Medicago','lupulina',  '',  '',  '',  '2000-10-10',  'A2',  '',         '43,110717',  '',  '12,390828',  '',  '10',  '',  '406',  '',  '',   '',  '',  '',  '4SD',  '312',  '13',  '10',  '0',   '0',  '4',  'ITA',  'END', 'ITA',  '2010',  '10',  'ITA', '10','wild',  '420', '88',   'Perugia',   '43,110717',  '12,390828',  '17,73', '406');


ALTER TABLE `cropwildrelative` ADD `NICODE` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `NIENUMB` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `INSTCODE` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `GENUS` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `SPECIES` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `SUBTAUTHOR` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `TAXREF` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `CROPNAME` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `LRRECDATE` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `LRNUMB` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `LRNAME` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `LRSLATDD` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `FLONGDMS` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `FLONGDD` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `LRSEPSGCODE` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `LRSGPS` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `LRSRADIALED` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `LRSELEVATION` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `FARMERID` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `FARMERYB` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `FARMHT` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `EXSECURE` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `EXDUPL` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Population_identifier` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Accession_specimen_number` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Collecting_number` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Collecting_source` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Type_specimen_language_of_common_taxon_name` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Conservation_actions_in_place` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Conservation_priority` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Conservation_country_code` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `IUCN_red_list_category` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Country_assessment` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Year_of_red_list_assessment` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Endangerment_status_according_to_national_criteria` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Country_code` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Taxon_status` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Biological_status` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Populatuion_area` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Total_number_of_individuals_in_the_population` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Site_location` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Decimal_latitude` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Decimal_longitude` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Maximum_uncertainty_estimate` VARCHAR(255);
ALTER TABLE `cropwildrelative` ADD `Elevation` VARCHAR(255);