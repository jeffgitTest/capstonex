DROP TABLE admin;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO admin VALUES("1","admin","5f4dcc3b5aa765d61d8327deb882cf99","admin");
INSERT INTO admin VALUES("2","admin2","81dc9bdb52d04dc20036dbd8313ed055","admin");
INSERT INTO admin VALUES("3","accounting","81dc9bdb52d04dc20036dbd8313ed055","accountant");



DROP TABLE author;

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO author VALUES("1","3","RR Rowling");



DROP TABLE author_bid;

CREATE TABLE `author_bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `co_author` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `projected_price` varchar(255) NOT NULL,
  `status` varchar(19) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

INSERT INTO author_bid VALUES("39","53","111","111","","6","111","1111","1","2017-03-21 01:20:46");



DROP TABLE bids;

CREATE TABLE `bids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

INSERT INTO bids VALUES("53","author","0","2017-03-21 01:20:46");
INSERT INTO bids VALUES("54","supplier","0","2017-03-21 01:22:53");
INSERT INTO bids VALUES("55","supplier","0","2017-03-27 00:29:25");



DROP TABLE brand;

CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO brand VALUES("2"," J. Gonzales, Â R. Nocon","24");
INSERT INTO brand VALUES("3","Rodibelle F. Leona, Â RodellaÂ F. Salas, Â Henry T","25");
INSERT INTO brand VALUES("4","Joanna Lynn L. Mercado","26");
INSERT INTO brand VALUES("5","Erika S. Farshid Mehr,  Frederic D. Yulo","25");



DROP TABLE cacel_order;

CREATE TABLE `cacel_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(50) NOT NULL,
  `payer_email` varchar(50) NOT NULL,
  `now` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO cacel_order VALUES("1","053621837E670284T","capstoneTest@gmail.com","2017-03-10");



DROP TABLE category;

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(40) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO category VALUES("23","Match");
INSERT INTO category VALUES("24","Math");
INSERT INTO category VALUES("25","Computer");
INSERT INTO category VALUES("26","Marketing");
INSERT INTO category VALUES("27","asdasdas");



DROP TABLE cod_details;

CREATE TABLE `cod_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO cod_details VALUES("1","6","Mandaluyong","NCR","Mandaluyong","2305","09067224095","2017-03-24 11:32:03");



DROP TABLE contract;

CREATE TABLE `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `validity` varchar(10) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO contract VALUES("13","53","6","author","03/31/2017","0","2017-03-21 01:21:32");
INSERT INTO contract VALUES("14","54","3","supplier","03/31/2017","0","2017-03-21 01:23:24");
INSERT INTO contract VALUES("15","55","6","supplier","03/31/2017","1","2017-03-27 00:47:21");
INSERT INTO contract VALUES("16","55","6","supplier","03/31/2017","1","2017-03-27 00:48:47");



DROP TABLE critical_level;

CREATE TABLE `critical_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `crit_level` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO critical_level VALUES("1","9","200","bs","2017-03-18 02:09:24");
INSERT INTO critical_level VALUES("2","10","150","nbs","2017-03-18 02:09:24");
INSERT INTO critical_level VALUES("3","11","100","","2017-03-28 16:54:21");
INSERT INTO critical_level VALUES("4","12","200","","2017-03-28 16:54:35");
INSERT INTO critical_level VALUES("5","13","150","","2017-03-28 16:54:41");
INSERT INTO critical_level VALUES("6","14","300","","2017-03-28 16:54:50");



DROP TABLE expenses;

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO expenses VALUES("1","Kuryente","1000","2017-03-08 16:21:46");
INSERT INTO expenses VALUES("2","Tubig","500","2017-03-08 16:21:46");
INSERT INTO expenses VALUES("3","Internet","999","2017-03-08 16:21:46");
INSERT INTO expenses VALUES("4","Rent","3000","2017-03-08 16:21:46");
INSERT INTO expenses VALUES("5","Gastos","500","2017-03-08 17:20:18");



DROP TABLE inbox;

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO inbox VALUES("1","Russell James","sample subject","rje.mindo@gmail.com","sample message","2017-02-15");



DROP TABLE inventory;

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `pname` varchar(35) NOT NULL,
  `lessted_value` int(11) NOT NULL,
  `current_stock` int(11) NOT NULL,
  `previous stock` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE outbox;

CREATE TABLE `outbox` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `message` longtext NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE payment_option;

CREATE TABLE `payment_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(255) NOT NULL,
  `merchant` varchar(255) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO payment_option VALUES("1","https://www.sandbox.paypal.com/cgi-bin/webscr","fritzlicda1-facilitator-1@gmail.com","http://mutyaph.com/","1");



DROP TABLE product_history;

CREATE TABLE `product_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `qty_added` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO product_history VALUES("1","13","100","2017-03-10");
INSERT INTO product_history VALUES("2","13","20","2017-03-15");
INSERT INTO product_history VALUES("3","13","-5","2017-03-15");
INSERT INTO product_history VALUES("4","13","-20","2017-03-15");



DROP TABLE products;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(16) NOT NULL,
  `details` text NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(16) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `timestamp` varchar(10) NOT NULL,
  `date_added` date NOT NULL,
  `ext` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO products VALUES("9","1","Essential Statistics","550","There are so many books about statistics out there written both by local and foreign authors. So why come up with yet another one? This book makes use of the same format adopted for an earlier, similar book in Algebra found useful by many students and teachers. It utilizes step-by-step procedures, includes lots of exercises, and worksheets, offers opportunities for student reflection and real-world connections, highlights the use of technology-based tools, requires student projects, presents chapter highlights, and provides students preparatory materials for major examinations.. It also has materials on integrating student portfolios and learning papers into the course.","100","24"," J. Gonzales, Â R. Nocon","active","2017-02-11","2017-02-11","png");
INSERT INTO products VALUES("10","1","Practical Approach to Information Communication Technology (ICT)","123","SAMPLE DESCRIPTION","113","25","Erika S. Farshid Mehr,  Frederic D. Yulo","active","2017-02-15","2017-02-15","png");
INSERT INTO products VALUES("11","6","Basic Marketing","50","The marketing world today is very much different from it was years ago. Today, market enterprises use modem communication technologies such as email, fax machines, Internet. World Wide Web in their marketing transactions to help making them cross boundaries with ease_ With globalization and applications of quantitative tools in marketing as the trend, modern marketing managers, marketing instructors and students have to equip themselves with modem know- how of the basic principles of marketing for them to meet the challenges in this rapid changing world of marketing.","223","23"," J. Gonzales, Â R. Nocon","unactive","2017-02-15","2017-02-15","png");
INSERT INTO products VALUES("12","6","2222","2222","","50","","","unactive","","0000-00-00","png");
INSERT INTO products VALUES("13","6","1111","1111","","50","","","unactive","","0000-00-00","png");
INSERT INTO products VALUES("14","6","111","1111","","50","","","unactive","","0000-00-00","png");



DROP TABLE requests;

CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_type` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `reason` text NOT NULL,
  `product` varchar(30) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO requests VALUES("1","supplier","mendozalaxus@gmail.com","0","09067224096","Wala lang!","Wala lang!","accepted");
INSERT INTO requests VALUES("2","supplier","roxelrollmendoza@gmail.com","Roxel Roll Mendoza","09067224096","wala lang ulit!","Papel de liha","accepted");
INSERT INTO requests VALUES("3","author","natsumendoza@gmail.com","natsu","09078463744","asdasdasdsad","","accepted");
INSERT INTO requests VALUES("4","author","sdasd","aadasdas","21312312312","asdasdasd","","pending");
INSERT INTO requests VALUES("5","author","sdasd","aadasdas","21312312312","asdasdasd","","pending");
INSERT INTO requests VALUES("6","author","mendozalaxus@gmail.com","roro","123456778","reason 3","","pending");



DROP TABLE security_qa;

CREATE TABLE `security_qa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO security_qa VALUES("4","23","What is your mother\'s maiden name?","orog","2017-03-24 13:31:34");
INSERT INTO security_qa VALUES("5","24","What was your favorite place to visit as a child?","dsdad","2017-03-28 17:40:45");
INSERT INTO security_qa VALUES("6","25","What high school did you attend?","asdasda","2017-03-28 17:43:32");
INSERT INTO security_qa VALUES("7","26","In what city were you born?","dasdasd","2017-03-28 17:47:26");
INSERT INTO security_qa VALUES("8","27","Who is your favorite actor, musician, or artist?","asdasd","2017-03-28 17:49:36");
INSERT INTO security_qa VALUES("9","28","What is the first and last name of your first boyfriend or girlfriend?","orog","2017-03-28 17:53:51");



DROP TABLE supplier;

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `product` varchar(40) NOT NULL,
  `contract` varchar(10) NOT NULL,
  `valid_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO supplier VALUES("1","0","Wala lang!","valid","2017-04-30 13:23:10");
INSERT INTO supplier VALUES("2","Roxel Roll Mendoza","Papel de liha","valid","2017-07-31 13:23:10");
INSERT INTO supplier VALUES("3","Roxel","papel","invalid","2017-03-14 17:45:44");



DROP TABLE supplier_bid;

CREATE TABLE `supplier_bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_bid` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO supplier_bid VALUES("15","54","3","222","222","222","1","2017-03-21 01:22:54");
INSERT INTO supplier_bid VALUES("16","55","6","Martilyo","dasd","600","1","2017-03-27 00:29:25");



DROP TABLE supplies;

CREATE TABLE `supplies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO supplies VALUES("3","54","15","222","222","222","1","2017-03-21 01:23:25");
INSERT INTO supplies VALUES("4","55","16","Martilyo","dasd","600","1","2017-03-27 00:47:21");
INSERT INTO supplies VALUES("5","55","16","Martilyo","dasd","600","1","2017-03-27 00:48:48");



DROP TABLE transactions;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id_array` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `month` varchar(4) NOT NULL,
  `day` varchar(4) NOT NULL,
  `year` varchar(4) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mc_gross` varchar(255) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `payer_status` varchar(255) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_state` varchar(255) NOT NULL,
  `address_zip` varchar(255) NOT NULL,
  `address_country` varchar(255) NOT NULL,
  `address_status` varchar(255) NOT NULL,
  `notify_version` varchar(255) NOT NULL,
  `verify_sign` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `mc_currency` varchar(255) NOT NULL,
  `mc_fee` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO transactions VALUES("3","3","10","capstoneTest@gmail.com","test","account","03","08","2017","2017-03-08 02:23:04","123.00","","capstoneTest-facilitator@gmail.com","instant","Pending","cart","VERIFIED","001","San Jose","CA","50002","US","","UNVERSIONED","AFcWxV21C7fd0v3bYYYRCpSSRl31AYdzMHdxcQ0MoBjUi6eo5yguAf-v","TUZBW7N55UVH2","PHP","123.00","62N38974UP192673H","1");
INSERT INTO transactions VALUES("4","3","10","capstoneTest@gmail.com","test","account","03","08","2017","2017-03-10 11:31:02","2460.00","","capstoneTest-facilitator@gmail.com","instant","Cancelled","cart","VERIFIED","001","San Jose","CA","50002","US","","UNVERSIONED","AFcWxV21C7fd0v3bYYYRCpSSRl31AZlJVDgbTHTA5oO7m1Ef8rCKIWkG","TUZBW7N55UVH2","PHP","123.00","9TJ22836RR194715C","20");
INSERT INTO transactions VALUES("6","3","9","capstoneTest@gmail.com","test","account","03","09","2017","2017-03-10 11:34:28","1100.00","","capstoneTest-facilitator@gmail.com","instant","Cancelled","cart","VERIFIED","001","San Jose","CA","50002","US","","UNVERSIONED","AiPC9BjkCyDFQXbSkoZcgqH3hpacAa7r78Sn4-tqV5l1GoHXpw9X0XSk","TUZBW7N55UVH2","PHP","550.00","053621837E670284T","2");
INSERT INTO transactions VALUES("11","6","10","mendozalaxus@yahoo.com","RR","Mendoza","","","","2017-03-24 11:32:03","123","","","cod","Pending","","","","","","","","","","","","PHP","123","1773052396","1");
INSERT INTO transactions VALUES("12","6","10","mendozalaxus@yahoo.com","RR","Mendoza","","","","2017-03-24 11:46:55","123","","","cod","Pending","","","","","","","","","","","","PHP","123","1112809937","1");
INSERT INTO transactions VALUES("13","6","9","mendozalaxus@yahoo.com","RR","Mendoza","","","","2017-03-24 12:13:17","550","","","cod","Completed","","","","","","","","","","","","PHP","550","2002881133","1");
INSERT INTO transactions VALUES("14","6","10","mendozalaxus@yahoo.com","RR","Mendoza","","","","2017-03-27 01:19:30","123","","","cod","Pending","","","","","","","","","","","","PHP","123","1184942234","1");
INSERT INTO transactions VALUES("15","6","10","mendozalaxus@yahoo.com","RR","Mendoza","","","","2017-03-27 01:20:04","123","","","cod","Pending","","","","","","","","","","","","PHP","123","1640458798","1");
INSERT INTO transactions VALUES("16","24","10","capstoneTest@gmail.com","test","account","03","28","2017","2017-03-28 08:38:21","123.00","","capstoneTest-facilitator@gmail.com","instant","Pending","cart","VERIFIED","001","San Jose","CA","50002","US","","UNVERSIONED","AFcWxV21C7fd0v3bYYYRCpSSRl31APrFq9H.GA-x-dJQfPvFvg7SuEG1","TUZBW7N55UVH2","PHP","123.00","6PN21286FK754025H","1");
INSERT INTO transactions VALUES("17","24","10","capstoneTest@gmail.com","test","account","03","28","2017","2017-03-28 08:47:24","123.00","","capstoneTest-facilitator@gmail.com","instant","Pending","cart","VERIFIED","001","San Jose","CA","50002","US","","UNVERSIONED","An5ns1Kso7MWUdW4ErQKJJJ4qi4-AEXI85qjMQniaxeF2KW1wT1q6NTe","TUZBW7N55UVH2","PHP","123.00","4B822268RV484673K","1");



DROP TABLE uploaded_bid_file;

CREATE TABLE `uploaded_bid_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

INSERT INTO uploaded_bid_file VALUES("34","46","6","Practical Exam.pdf","pdf","0","2017-03-20 14:52:53");
INSERT INTO uploaded_bid_file VALUES("35","47","6","10266.pdf","pdf","0","2017-03-19 20:20:05");
INSERT INTO uploaded_bid_file VALUES("36","48","6","26995711901-539067804-ticket.pdf","pdf","1","2017-03-20 11:33:20");
INSERT INTO uploaded_bid_file VALUES("37","53","6","10266.pdf","pdf","0","2017-03-21 01:20:46");



DROP TABLE uploaded_contract_file;

CREATE TABLE `uploaded_contract_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO uploaded_contract_file VALUES("10","53"," CPA1015ra_Mla_e.pdf","pdf","2017-03-21 01:21:32");
INSERT INTO uploaded_contract_file VALUES("11","54"," How_to_Clean_Install_CM13.pdf","pdf","2017-03-21 01:23:25");
INSERT INTO uploaded_contract_file VALUES("14","53","53-author-contract.pdf","pdf","2017-03-24 02:04:16");
INSERT INTO uploaded_contract_file VALUES("18","54","54-supplier-contract.pdf","pdf","2017-03-24 02:18:43");
INSERT INTO uploaded_contract_file VALUES("19","0","-author-contract.pdf","","2017-03-24 10:14:17");
INSERT INTO uploaded_contract_file VALUES("20","0","-author-contract.pdf","","2017-03-24 10:14:54");
INSERT INTO uploaded_contract_file VALUES("21","0","-author-contract.pdf","","2017-03-24 10:15:09");



DROP TABLE uploaded_contract_template_file;

CREATE TABLE `uploaded_contract_template_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL,
  `ext` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO uploaded_contract_template_file VALUES("7","author-contract.pdf","author","pdf");
INSERT INTO uploaded_contract_template_file VALUES("8","supplier-contract.pdf","supplier","pdf");



DROP TABLE uploaded_supp_bid_file;

CREATE TABLE `uploaded_supp_bid_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO uploaded_supp_bid_file VALUES("15","54","3","Practical Exam.pdf","pdf","0","2017-03-21 01:22:54");
INSERT INTO uploaded_supp_bid_file VALUES("16","55","6","contracttemplate-author-contract.pdf","pdf","0","2017-03-27 00:29:25");



DROP TABLE user_type;

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO user_type VALUES("1","client");
INSERT INTO user_type VALUES("2","author");
INSERT INTO user_type VALUES("3","supplier");
INSERT INTO user_type VALUES("4","admin");



DROP TABLE user_uploads;

CREATE TABLE `user_uploads` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` text,
  `user_id_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usn` varchar(50) NOT NULL,
  `fname` varchar(120) NOT NULL,
  `lname` varchar(120) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(60) NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(128) NOT NULL,
  `activate` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `date` date NOT NULL,
  `block` int(11) NOT NULL,
  `pic` int(11) NOT NULL,
  `ext` varchar(5) NOT NULL,
  `admin` int(11) NOT NULL,
  `user_type` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("28","rr","Roxel","Mendoza","2017-03-31","Mandaluyong","2147483647","mendozalaxus@gmail.com","81dc9bdb52d04dc20036dbd8313ed055","0","24856228","2017-03-28","0","0","","0","1");



