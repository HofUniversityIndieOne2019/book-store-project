#
# Table structure for table 'tx_bookstoreapp_domain_model_book'
#
CREATE TABLE tx_bookstoreapp_domain_model_book (

	isbn varchar(255) DEFAULT '' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	blurb text,
	description text,
	price double(11,2) DEFAULT '0.00' NOT NULL,
	publication_date date DEFAULT NULL,
	pages int(11) DEFAULT '0' NOT NULL,
	images int(11) unsigned DEFAULT '0' NOT NULL,
	topics text NOT NULL,
	authors text NOT NULL,
	publisher int(11) unsigned DEFAULT '0'

);

#
# Table structure for table 'tx_bookstoreapp_domain_model_topic'
#
CREATE TABLE tx_bookstoreapp_domain_model_topic (

	name varchar(255) DEFAULT '' NOT NULL,
	description text

);

#
# Table structure for table 'tx_bookstoreapp_domain_model_author'
#
CREATE TABLE tx_bookstoreapp_domain_model_author (

	name varchar(255) DEFAULT '' NOT NULL,
	date_of_birth date DEFAULT NULL,
	biography text

);

#
# Table structure for table 'tx_bookstoreapp_domain_model_publisher'
#
CREATE TABLE tx_bookstoreapp_domain_model_publisher (

	name varchar(255) DEFAULT '' NOT NULL,
	description text,
	country int(11) unsigned DEFAULT '0'

);

#
# Table structure for table 'tx_bookstoreapp_domain_model_country'
#
CREATE TABLE tx_bookstoreapp_domain_model_country (

	name varchar(255) DEFAULT '' NOT NULL

);
