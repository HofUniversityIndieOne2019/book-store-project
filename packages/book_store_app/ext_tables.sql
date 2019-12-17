#
# Table structure for table 'tx_bookstoreapp_domain_model_book'
#
CREATE TABLE tx_bookstoreapp_domain_model_book (

	isbn varchar(255) DEFAULT '' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	slug varchar(2048),
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
	slug varchar(2048),
	description text

);

#
# Table structure for table 'tx_bookstoreapp_domain_model_author'
#
CREATE TABLE tx_bookstoreapp_domain_model_author (

	name varchar(255) DEFAULT '' NOT NULL,
	slug varchar(2048),
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

#
# Table structure for table 'tx_bookstoreapp_domain_model_customer'
#
CREATE TABLE tx_bookstoreapp_domain_model_customer (

	customer_id varchar(255) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	user int(11) unsigned DEFAULT '0',
	addresses int(11) unsigned DEFAULT '0' NOT NULL

);

#
# Table structure for table 'tx_bookstoreapp_domain_model_wishlist'
#
CREATE TABLE tx_bookstoreapp_domain_model_wishlist (

	books text NOT NULL

);

#
# Table structure for table 'tx_bookstoreapp_domain_model_address'
#
CREATE TABLE tx_bookstoreapp_domain_model_address (

	customer int(11) unsigned DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	street varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL

);
