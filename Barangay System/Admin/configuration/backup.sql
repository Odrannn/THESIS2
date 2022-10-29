DROP TABLE address_fields;

CREATE TABLE `address_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purok` varchar(100) NOT NULL,
  `sitio` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `subdivision` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4;

INSERT INTO address_fields VALUES("59","purok 1","sitio 1","Grove","Magnolia Estate");
INSERT INTO address_fields VALUES("60","purok 2","sitio 2","KalyePogi","Beverly Woods");
INSERT INTO address_fields VALUES("62","Purok 3","sitio 3","LRC","Brittany Oaks");
INSERT INTO address_fields VALUES("64","","","Oroqueta","Sycamore Village");
INSERT INTO address_fields VALUES("65","","","Telecom","");



DROP TABLE admin_notification;

CREATE TABLE `admin_notification` (
  `notification_ID` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(50) NOT NULL,
  `type_ID` int(11) DEFAULT NULL,
  `message` varchar(50) NOT NULL,
  `source_ID` int(11) DEFAULT NULL,
  `date_time` varchar(20) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`notification_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO admin_notification VALUES("1","Request Document","7","requested a document.","9","22-10-09 02:31:04","1");
INSERT INTO admin_notification VALUES("2","Request Document","8","requested a document.","9","22-10-09 02:33:04","1");
INSERT INTO admin_notification VALUES("3","Request Document","9","requested a document.","29","22-10-09 05:04:39","1");
INSERT INTO admin_notification VALUES("4","Request Document","10","requested a document.","29","22-10-09 05:21:50","1");
INSERT INTO admin_notification VALUES("5","Request Document","14","requested a document.","9","22-10-10 04:01:19","1");
INSERT INTO admin_notification VALUES("6","File Complaint","14","filed a complaint.","9","22-10-10 04:02:19","1");
INSERT INTO admin_notification VALUES("7","Send Suggestion","13","sent a suggestion.","9","22-10-10 04:10:47","1");
INSERT INTO admin_notification VALUES("8","File Complaint","14","filed a complaint.","9","22-10-10 04:11:04","1");
INSERT INTO admin_notification VALUES("9","File Blotter","6","filed a blotter.","11","22-10-10 04:16:13","1");
INSERT INTO admin_notification VALUES("10","File Blotter","7","filed a blotter.","11","22-10-10 04:17:57","1");
INSERT INTO admin_notification VALUES("11","Request Document","11","requested a document.","11","22-10-10 04:24:15","1");
INSERT INTO admin_notification VALUES("12","Request Document","12","requested a document.","11","22-10-10 05:27:56","1");
INSERT INTO admin_notification VALUES("13","File Complaint","15","filed a complaint.","9","22-10-11 02:38:02","1");
INSERT INTO admin_notification VALUES("14","File Blotter","8","filed a blotter.","10","22-10-11 06:53:35","1");
INSERT INTO admin_notification VALUES("15","Request Document","13","requested a document.","10","22-10-11 07:21:12","1");
INSERT INTO admin_notification VALUES("16","Request Document","14","requested a document.","11","22-10-12 04:28:04","1");



DROP TABLE announcement;

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `descrip` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO announcement VALUES("11","assembly","IMG-62f909accac4e9.62604401.jpg","hvgvkuyvubbnlb");
INSERT INTO announcement VALUES("12","bakuna","IMG-62f909ca28c652.09208881.jpg","gf cfjc jvckvlbkbnbydfdfugvboihgniogoi7hyo87tngyyybyibyibuyhbuihiuhuihuihuihiygyigy");
INSERT INTO announcement VALUES("13","sayaw","IMG-62f909eb6b3343.71586801.jpg","hnoi gg86g6g67g87huiohbuygvytfrtdredrfkygl");



DROP TABLE bgy_info;

CREATE TABLE `bgy_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `color_theme` varchar(10) NOT NULL,
  `logo_url` text NOT NULL,
  `bgy_name` text NOT NULL,
  `vision` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `background_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO bgy_info VALUES("1","#008a87","IMG-633d8bdbebdac5.77070216.png","310","We envision the Barangay Pico to be more progressive, loving and peaceful place to live in where people and residents enjoy harmonious way of life, business, at work and at home, and most especially for a more directed and progressive Barangay Governance.","We commit to perform better duties and responsibilities to carry out the plans and objectives of the barangay thru voluntary and excellent performance, most especially in the delivery of the basic needs such as improved roads and environment, water system, health care, education, housing and agricultural farming needs of the farmers and residents of the barangay.","Manila ","IMG-6310b1e4de2736.84526520.png");



DROP TABLE blotter_table;

CREATE TABLE `blotter_table` (
  `blotter_ID` int(11) NOT NULL AUTO_INCREMENT,
  `official_ID` int(11) DEFAULT NULL,
  `complainant_ID` int(11) NOT NULL,
  `complainee_ID` int(11) NOT NULL,
  `complainee_name` varchar(100) NOT NULL,
  `blotter_date` date NOT NULL,
  `blotter_time` time NOT NULL,
  `blotter_accusation` varchar(50) NOT NULL,
  `blotter_details` varchar(100) NOT NULL,
  `settlement_schedule` date NOT NULL,
  `settlement_time` time DEFAULT NULL,
  `result_of_settlement` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`blotter_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO blotter_table VALUES("2","5","9","8","Bernard Kabiling Mazo","2022-10-01","23:38:00","Handsome problem","Ampogi ni Bernard Mazo","0000-00-00","00:00:00","asd","unsettled");
INSERT INTO blotter_table VALUES("3","","9","0","Kyrie Irving","2022-10-13","23:42:00","Stafa","Inistafa yung pusta namin sa basketball","0000-00-00","00:00:00","","unscheduled");
INSERT INTO blotter_table VALUES("4","5","9","0","Lebron James","2022-09-28","23:42:00","Play and Run","hindi nag bayad ng pang schedule","2022-10-19","12:52:00","asdas","settled");
INSERT INTO blotter_table VALUES("5","5","9","10","Charles Wilcent Ilustre Urbano","0000-00-00","13:02:00","Nanuntok","nanuntok ng limang tao","2022-10-12","08:37:00","","scheduled");
INSERT INTO blotter_table VALUES("6","","11","38","Bernard Kabilin Mazo","2022-10-05","22:17:00","igop","asdasdasdas","0000-00-00","","","unscheduled");
INSERT INTO blotter_table VALUES("7","5","11","10","Charles Wilcent Ilustre Urbano","2022-09-29","22:19:00","sobrang pogi","asdsadasd","2022-10-15","10:00:00","","scheduled");
INSERT INTO blotter_table VALUES("8","","10","29","john daniel san juan policarpio","2022-10-06","00:54:00","nanapak","sinapak ako sa kanto","0000-00-00","","","unscheduled");



DROP TABLE case_option;

CREATE TABLE `case_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_nature` varchar(50) NOT NULL,
  `suggestion_nature` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO case_option VALUES("1","Dirty Barangay","Barangay Improvement");
INSERT INTO case_option VALUES("2","Gossip Mongers","Education");
INSERT INTO case_option VALUES("3","Drugs","Sports");
INSERT INTO case_option VALUES("4","Noise","Health");
INSERT INTO case_option VALUES("5","","");



DROP TABLE complaint_table;

CREATE TABLE `complaint_table` (
  `complaint_ID` int(11) NOT NULL AUTO_INCREMENT,
  `official_ID` int(11) DEFAULT NULL,
  `sender_ID` int(11) NOT NULL,
  `complaint_nature` varchar(20) NOT NULL,
  `comp_desc` varchar(100) NOT NULL,
  `complaint_date` date NOT NULL,
  `img_proof` varchar(50) NOT NULL,
  `complaint_status` varchar(20) NOT NULL,
  PRIMARY KEY (`complaint_ID`),
  KEY `INCHARGE` (`official_ID`),
  KEY `SENDER` (`sender_ID`),
  CONSTRAINT `INCHARGE` FOREIGN KEY (`official_ID`) REFERENCES `tblofficial` (`official_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SENDER` FOREIGN KEY (`sender_ID`) REFERENCES `resident_table` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO complaint_table VALUES("1","5","9","Dirty Barangay","sad","2022-09-26","IMG-6331aa2bdf2245.84869776.png","solved");
INSERT INTO complaint_table VALUES("2","5","9","Drugs","drugs drugs drugs drugs drugs","2022-09-26","IMG-6331aa8ac786d0.08725937.png","solved");
INSERT INTO complaint_table VALUES("3","5","9","Gossip Mongers","Wilcent urbano ang ngalan","2022-09-27","IMG-6332ec0067dd74.43852234.png","solved");
INSERT INTO complaint_table VALUES("4","5","9","Noise","Noisy Karaoke","2022-09-27","IMG-6332ece1b2b828.26135177.png","solved");
INSERT INTO complaint_table VALUES("7","5","9","Drugs","sdfdsf","2022-09-27","IMG-6333053e5fcb96.27694649.png","solved");
INSERT INTO complaint_table VALUES("9","6","9","Gossip Mongers","tsismosa","2022-09-28","","solved");
INSERT INTO complaint_table VALUES("10","6","9","Other","SUGALAN SA KANTO","2022-09-28","","solved");
INSERT INTO complaint_table VALUES("11","","9","Other","illegal parking","2022-09-28","","pending");
INSERT INTO complaint_table VALUES("12","","9","Other","sugalan","2022-10-17","IMG-633453d006e131.68377680.jpg","pending");
INSERT INTO complaint_table VALUES("13","5","9","Other","illegal parking","2022-10-17","IMG-633453de511e23.56622787.jpg","solved");
INSERT INTO complaint_table VALUES("14","5","9","Dirty Barangay","street 1 is very dirty","2022-10-17","IMG-63346d10292875.87716455.jpg","solved");
INSERT INTO complaint_table VALUES("15","5","9","Dirty Barangay","asdasdas","2022-10-18","IMG-634563a9e852f8.39870037.jpg","solved");



DROP TABLE document_request;

CREATE TABLE `document_request` (
  `request_ID` int(11) NOT NULL AUTO_INCREMENT,
  `official_ID` int(11) DEFAULT NULL,
  `resident_ID` int(11) NOT NULL,
  `document_ID` int(11) DEFAULT NULL,
  `purpose` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `request_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`request_ID`),
  KEY `NAME` (`document_ID`),
  CONSTRAINT `NAME` FOREIGN KEY (`document_ID`) REFERENCES `document_type` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO document_request VALUES("1","","7","1","school requirement","1","payment.jpg","2022-09-22","pending");
INSERT INTO document_request VALUES("3","","9","1","adasd","12","RCPT-633afecac5b085.95733661.jpg","2022-10-03","pending");
INSERT INTO document_request VALUES("4","","9","2","asd","1","RCPT-633afee90462b9.73775231.jpg","2022-10-03","pending");
INSERT INTO document_request VALUES("5","5","11","2","business","1","RCPT-633d9a114cf799.84391831.jpg","2022-10-05","ready");
INSERT INTO document_request VALUES("6","5","11","3","school","1","RCPT-633da47ab3f616.59006446.jpg","2022-10-05","ready");
INSERT INTO document_request VALUES("7","","9","2","Business","1","RCPT-6342bf2cd197e4.93863445.jpg","2022-10-09","pending");
INSERT INTO document_request VALUES("8","","9","3","School Requirement","1","RCPT-6342bf801995f8.50901645.jpg","2022-10-09","pending");
INSERT INTO document_request VALUES("9","","29","2","business","1","RCPT-6342e30774d612.08680000.jpg","2022-10-09","pending");
INSERT INTO document_request VALUES("10","","29","1","School Purposes","2","RCPT-6342e70e7d8920.44333261.jpg","2022-10-09","pending");
INSERT INTO document_request VALUES("11","5","11","1","asdasdas","1","RCPT-63442b0f908dc0.42865164.jpg","2022-10-10","ready");
INSERT INTO document_request VALUES("12","5","11","1","sadasd","1","RCPT-634439fca71343.47009202.jpg","2022-10-10","ready");
INSERT INTO document_request VALUES("13","","10","1","sadasd","1","RCPT-6345a60822dfe1.60325593.jpg","2022-10-11","pending");
INSERT INTO document_request VALUES("14","5","11","1","21312312","1","RCPT-6346cef3ee8d77.36395853.jpg","2022-10-12","ready");



DROP TABLE document_type;

CREATE TABLE `document_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `availability` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO document_type VALUES("1","Barangay Clearance","100.00","yes");
INSERT INTO document_type VALUES("2","Certificate of Indigency","75.00","yes");
INSERT INTO document_type VALUES("3","Certificate of Residency","80.00","yes");



DROP TABLE healthcare_availability;

CREATE TABLE `healthcare_availability` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO healthcare_availability VALUES("1","10:00:00","19:00:00");



DROP TABLE healthcare_logs;

CREATE TABLE `healthcare_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reason` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO healthcare_logs VALUES("2","8","Bernard Kabiling Mazo","2022-09-19","15:51:01","pogi");
INSERT INTO healthcare_logs VALUES("3","9","Christian Philip Diff Orsolino","2022-09-19","15:52:12","allergy");
INSERT INTO healthcare_logs VALUES("4","0","","2022-09-19","16:19:02","nothing");
INSERT INTO healthcare_logs VALUES("5","0","","2022-09-19","16:21:05","asdas");
INSERT INTO healthcare_logs VALUES("6","0","","2022-09-19","16:25:41","ads");
INSERT INTO healthcare_logs VALUES("7","0","Denver Mazo","2022-09-19","16:29:04","nothing");
INSERT INTO healthcare_logs VALUES("8","0","10","2022-09-19","16:29:17","Varsity");
INSERT INTO healthcare_logs VALUES("9","0","10","2022-09-19","16:29:55","varsity");
INSERT INTO healthcare_logs VALUES("10","10","Charles Wilcent Ilustre Urbano","2022-09-19","16:40:47","Varsity");
INSERT INTO healthcare_logs VALUES("11","0","Charles","2022-09-19","16:41:23","12121");
INSERT INTO healthcare_logs VALUES("12","38","Bernard Kabilin Mazo","2022-10-10","18:38:40","stomach ache 1");



DROP TABLE modules_available;

CREATE TABLE `modules_available` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modules` varchar(100) NOT NULL,
  `availability` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO modules_available VALUES("1","Case Management","yes");
INSERT INTO modules_available VALUES("2","Resident Management","yes");
INSERT INTO modules_available VALUES("3","Healthcare Center","yes");
INSERT INTO modules_available VALUES("4","Request Verification","yes");
INSERT INTO modules_available VALUES("5","Official Management","yes");
INSERT INTO modules_available VALUES("6","User Management","yes");



DROP TABLE registration;

CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthplace` varchar(100) NOT NULL,
  `civilstatus` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `unitnumber` int(11) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `sitio` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `subdivision` varchar(100) NOT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `educational` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `disability` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `img_path` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

INSERT INTO registration VALUES("7","Lenz Janielle","Lim","Gerongco","","female","Laguna","Single","2002-09-15","1004","Purok 3","sitio 2","TELECOM","tinagan","09123456789","lenzgerongco@yahoo.com","Roman Catholic","Flight attendant","College","Filipino","none","accepted","IMG-631219de1abde9.41773945.jpg");
INSERT INTO registration VALUES("8","Bernard","Kabiling","Mazo","","male","Manila","Single","2001-03-27","1759","purok 1","sitio 1","TELECOM","tinagan","09616064483","nard_mazo@gmail.com","Roman Catholic","Programmer","College","Filipino","none","accepted","IMG-63121afc4c1067.08242643.jpg");
INSERT INTO registration VALUES("9","Christian Philip","Diff","Orsolino","","male","Manila","Single","2000-12-11","1000","purok 1","sitio 2","TELECOM","tinagan","09283523142","chris.orsolino@gmail.com","Roman Catholic","Dancer","College","Filipino","none","accepted","IMG-6315e248db3a50.51752994.jpg");
INSERT INTO registration VALUES("10","Charles Wilcent","Ilustre","Urbano","","male","Manila","Single","2000-12-02","4598","purok 2","sitio 3","TELECOM","sevilla street","09264561231","wilson.urbano@gmail.con","Roman Catholic","Axie player","College","Filipino","none","accepted","IMG-6315e7787044d0.53015656.jpg");
INSERT INTO registration VALUES("11","Jehan","","Hadji Said","","male","Manila","Single","2000-06-12","12312","purok 2","sitio 2","kalyepogi","parking","09108418705","jehan.said@gmail.com","Islam","Web developer","College","Filipino","none","accepted","IMG-6316093cd6aa57.65981626.jpg");
INSERT INTO registration VALUES("15","john daniel","san juan","policarpio","","male","mindoro","Married","2002-09-28","1004","purok 2","sitio 3","LRC","sevilla street","09789789788","juan.delecaruz123","Roman Catholic","Web developer","Less Than Highschool","russian","pogi","accepted","IMG-6322a81c7d8017.79649686.jpg");
INSERT INTO registration VALUES("16","john daniel","san juan","policarpio","","male","mindoro","Widowed","2022-09-20","1004","1","sitio 1","kalyepogi","tinagan","09123123123","juan.delecaruz123","Jehovah\'\'s Witnesses","programmer","Bachelor\'\'s Degree","Filipino","pogi","accepted","IMG-6322a861ded505.42428598.jpg");
INSERT INTO registration VALUES("19","Denver ","Kabiling","Mazo","","male","Pampanga","Single","1999-01-12","1759","purok 1","sitio 1","KalyePogi","Magnolia Estate","09475044087","denver.mazo@gmail.com","Roman Catholic","Cook","College","Filipino","None","accepted","IMG-6336cfb21effb4.96116588.png");
INSERT INTO registration VALUES("21","Bernard","Kabiling","Mazo","JR","male","Pampanga","Single","2002-06-04","1759","","","","","0929829390","nard.mazo@gmail.com","Roman Catholic","none","Less Than Highschool","Filipino","none","accepted","IMG-6336ee77a48797.16008983.jpg");
INSERT INTO registration VALUES("22","Bernard","Kabiling","Mazo","none","male","Mindoro","Married","1997-09-21","1759","","","","","09283523149","bernard.mazo04@gmail.com","Roman Catholic","Machine Operator","College","Filipino","none","accepted","IMG-6336f40df0ce87.00659602.jpg");
INSERT INTO registration VALUES("23","Bernandito","Malacas","Mazo","","male","Mindoro","Married","1999-09-07","1759","","","","","09283523144","bernandito.mazo@gmail.com","Roman Catholic","Machine Operator","College","Filipino","none","accepted","IMG-6336f65190f495.32852079.jpg");
INSERT INTO registration VALUES("24","Bernardo","Kabiling","Mazo","","male","Manila","Single","2001-10-12","1759","purok 1","sitio 1","Grove","Magnolia Estate","096160644831","nard_mazo@gmail.com1","Roman Catholic","none","Less Than Highschool","Filipino","none","accepted","IMG-633ee85b00dd85.83556750.jpg");



DROP TABLE resident_table;

CREATE TABLE `resident_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `household_ID` int(11) DEFAULT NULL,
  `unitnumber` int(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `sitio` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `subdivision` varchar(50) NOT NULL,
  `contactnumber` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `disability` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `test` (`user_id`),
  KEY `HOUSE` (`household_ID`),
  CONSTRAINT `HOUSE` FOREIGN KEY (`household_ID`) REFERENCES `tblhousehold` (`household_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `test` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

INSERT INTO resident_table VALUES("7","7","Lenz Janielle","Lim","Gerongco","","female","Laguna","Single","2002-09-15","","1004","Purok 3","sitio 2","TELECOM","tinagan","09123456789","lenzgerongco@yahoo.com","Roman Catholic","Flight attendant","College","Filipino","none","active");
INSERT INTO resident_table VALUES("8","8","Bernard","Kabiling","Mazo","","male","Manila","Single","2001-03-27","","1759","purok 1","sitio 1","TELECOM","tinagan","09616064483","nard_mazo@gmail.com","Roman Catholic","Programmer","College","Filipino","none","active");
INSERT INTO resident_table VALUES("9","9","Christian Philip","Diff","Orsolino","","male","Manila","Single","2000-12-11","3","1000","purok 1","sitio 2","TELECOM","tinagan","09283523142","chris.orsolino@gmail.com","Roman Catholic","Dancer","College","Filipino","none","active");
INSERT INTO resident_table VALUES("10","10","Charles Wilcent","Ilustre","Urbano","","male","Manila","Single","2000-12-02","3","4598","purok 2","sitio 3","TELECOM","sevilla street","09264561231","wilson.urbano@gmail.con","Roman Catholic","Axie player","College","Filipino","none","active");
INSERT INTO resident_table VALUES("11","11","Jehan","","Hadji Said","","male","Manila","Single","2001-06-12","","12312","purok 2","sitio 2","kalyepogi","parking","09108418705","jehan.said@gmail.com","Islam","Web developer","College","Filipino","none","active");
INSERT INTO resident_table VALUES("12","13","Michael","","Jordan","","male","Manila","Married","1963-02-17","","2345","purok 2","sitio 1","LRC","parking","09781234567","michaejordan@gmail.com","Roman Catholic","none","College","American","none","active");
INSERT INTO resident_table VALUES("13","14","Kobe","","Bryant","","male","Manila","Married","1978-08-23","","2408","Purok 3","sitio 3","grove","sevilla street","09244567897","kobe.bryant@gmail.com","Roman Catholic","none","Less Than Highschool","American","none","active");
INSERT INTO resident_table VALUES("14","15","Lebron","","James","","male","Manila","Single","1984-12-30","","2306","purok 2","sitio 2","TELECOM","parking","09623456781","lebronjames@gmail.com","Roman Catholic","none","Less Than Highschool","American","none","active");
INSERT INTO resident_table VALUES("17","18","John","","Wall","","male","Manila","Single","1990-09-06","3","202","purok 1","sitio 1","Oroqueta","tinagan","09020146545","john.wall@gmail.com","Roman Catholic","none","College","American","none","active");
INSERT INTO resident_table VALUES("29","30","John Daniel","San Juan","Policarpio","","male","mindoro","Single","2002-09-20","3","1004","1","sitio 1","1","1","09123123123","juan.delecaruz123","Jehovah\'s Witnesses","programmer","Bachelor\'s Degree","Filipino","pogi","active");
INSERT INTO resident_table VALUES("32","33","Denver ","Kabiling","Mazo","","male","Pampanga","Single","1999-01-12","","1759","purok 1","sitio 1","KalyePogi","Magnolia Estate","09475044087","denver.mazo@gmail.com","Roman Catholic","Cook","College","Filipino","None","active");
INSERT INTO resident_table VALUES("34","42","Bernandito","Malacas","Mazo","","male","Mindoro","Married","2003-09-07","7","1759","","","","","09283523144","bernandito.mazo@gmail.com","Roman Catholic","Machine Operator","College","Filipino","none","active");
INSERT INTO resident_table VALUES("38","39","Bernard","Kabilin","Mazo","","female","Manila","Married","2002-10-13","3","1759","","","","","0961606448","nard_maz@gmail.com","Roman Catholic","none","Highschool","Filipino","none","active");
INSERT INTO resident_table VALUES("39","43","Bernardo","Kabiling","Mazo","","male","Manila","Single","2002-10-12","","1759","purok 1","sitio 1","Grove","Magnolia Estate","096160644831","chrensan@gmail.com","Roman Catholic","none","Less Than Highschool","Filipino","none","active");



DROP TABLE suggestion_table;

CREATE TABLE `suggestion_table` (
  `suggestion_ID` int(11) NOT NULL AUTO_INCREMENT,
  `official_ID` int(11) DEFAULT NULL,
  `sender_ID` int(11) NOT NULL,
  `suggestion_nature` varchar(50) NOT NULL,
  `suggestion_desc` varchar(100) NOT NULL,
  `suggestion_date` date NOT NULL,
  `suggestion_feedback` varchar(100) NOT NULL,
  `suggestion_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`suggestion_ID`),
  KEY `OFFICIAL` (`official_ID`),
  KEY `RESIDENT` (`sender_ID`),
  CONSTRAINT `OFFICIAL` FOREIGN KEY (`official_ID`) REFERENCES `tblofficial` (`official_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `RESIDENT` FOREIGN KEY (`sender_ID`) REFERENCES `resident_table` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO suggestion_table VALUES("1","5","9","Education","school supplies","2022-09-28","ok","noticed");
INSERT INTO suggestion_table VALUES("2","5","9","Barangay Improvement","","2022-09-28","sge","noticed");
INSERT INTO suggestion_table VALUES("3","","9","Barangay Improvement","asda","2022-09-28","","pending");
INSERT INTO suggestion_table VALUES("4","","9","Sports","please organize a basketball league","2022-09-28","","pending");
INSERT INTO suggestion_table VALUES("5","6","9","Sports","please organize a basketball league","2022-09-28","Sige sabi mo eh","noticed");
INSERT INTO suggestion_table VALUES("6","","9","Health","Conduct operation tuli","2022-09-28","","pending");
INSERT INTO suggestion_table VALUES("7","","9","Barangay Improvement","your hall looks dirty, do some operation cleaning!!","2022-09-28","","pending");
INSERT INTO suggestion_table VALUES("8","","9","Sports","please conduct a summer league","2022-09-28","","pending");
INSERT INTO suggestion_table VALUES("9","6","9","Barangay Improvement","clean the purok 1","2022-09-28","salamat thanks","noticed");
INSERT INTO suggestion_table VALUES("10","4","9","Other","asndlnalsd","2022-09-28","ah gegege","noticed");
INSERT INTO suggestion_table VALUES("11","3","9","Education","aasdasdsad","2022-10-10","noted","noticed");
INSERT INTO suggestion_table VALUES("12","5","9","Other","sadasd","2022-10-10","opo","noticed");
INSERT INTO suggestion_table VALUES("13","5","9","Other","sadasd","2022-10-10","sge po","noticed");



DROP TABLE tblhousehold;

CREATE TABLE `tblhousehold` (
  `household_id` int(11) NOT NULL AUTO_INCREMENT,
  `household_member` int(10) DEFAULT NULL,
  `household_head_ID` int(11) DEFAULT NULL,
  `household_name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`household_id`),
  KEY `HEAD` (`household_head_ID`),
  CONSTRAINT `HEAD` FOREIGN KEY (`household_head_ID`) REFERENCES `resident_table` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblhousehold VALUES("1","","34","Mazo","inactive");
INSERT INTO tblhousehold VALUES("2","","10","Urbano","inactive");
INSERT INTO tblhousehold VALUES("3","5","9","Orsolino","active");
INSERT INTO tblhousehold VALUES("4","2","11","Hadji Said","inactive");
INSERT INTO tblhousehold VALUES("7","","34","Mazo","active");



DROP TABLE tblofficial;

CREATE TABLE `tblofficial` (
  `official_id` int(11) NOT NULL AUTO_INCREMENT,
  `resident_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(30) NOT NULL,
  `term_start` date NOT NULL,
  `term_end` date NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`official_id`),
  KEY `residency` (`resident_id`),
  KEY `ACCOUNT` (`user_id`),
  CONSTRAINT `ACCOUNT` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `residency` FOREIGN KEY (`resident_id`) REFERENCES `resident_table` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblofficial VALUES("1","12","13","Michael Jordan","Chairman","2016-12-01","2023-06-01","active");
INSERT INTO tblofficial VALUES("2","13","14","Kobe Bryant","Kagawad","2016-12-01","2023-06-01","active");
INSERT INTO tblofficial VALUES("3","14","15","Lebron James","Kagawad","2016-12-01","2023-06-01","active");
INSERT INTO tblofficial VALUES("4","17","18","John Wall","Kagawad","2016-12-01","2023-06-01","active");
INSERT INTO tblofficial VALUES("5","8","8","Bernard Kabiling Mazo","Exo","2022-09-22","2022-09-19","active");
INSERT INTO tblofficial VALUES("6","7","7","Lenz Janielle Lim Gerongco","Secretary","2022-08-02","2023-12-28","active");
INSERT INTO tblofficial VALUES("8","9","9","Christian Philip Diff Orsolino","Kagawad","2022-09-14","2022-09-28","active");



DROP TABLE tblresident;

CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(10) NOT NULL,
  `household_ID` int(11) DEFAULT NULL,
  `unitnumber` int(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `sitio` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `subdivision` varchar(50) NOT NULL,
  `contactnumber` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `disability` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tblresident VALUES("0","0","First Name","Middle Name","Last Name","Suffix","Gender","Birthplace","Civil Status","0000-00-00","0","0","0","Purok","Sitio","Street","Subdivision","Contact No.","E-mail","Religion","Occupation","Educational Attainment","Nationality","Disability","Status");
INSERT INTO tblresident VALUES("7","7","Lenz Janielle","Lim","Gerongco","","female","Laguna","Single","2022-09-15","20","0","1004","Purok 3","sitio 2","TELECOM","tinagan","09123456789","lenzgerongco@yahoo.com","Roman Catholic","Flight attendant","College","Filipino","none","active");
INSERT INTO tblresident VALUES("8","8","Bernard","Kabiling","Mazo","","male","Manila","Single","2001-03-27","21","0","1759","purok 1","sitio 1","TELECOM","tinagan","09616064483","nard_mazo@gmail.com","Roman Catholic","Programmer","College","Filipino","none","active");
INSERT INTO tblresident VALUES("9","9","Christian Philip","Diff","Orsolino","","male","Manila","Single","2000-12-11","21","3","1000","purok 1","sitio 2","TELECOM","tinagan","09283523142","chris.orsolino@gmail.com","Roman Catholic","Dancer","College","Filipino","none","active");
INSERT INTO tblresident VALUES("10","10","Charles Wilcent","Ilustre","Urbano","","male","Manila","Single","2000-12-02","22","3","4598","purok 2","sitio 3","TELECOM","sevilla street","09264561231","wilson.urbano@gmail.con","Roman Catholic","Axie player","College","Filipino","none","active");
INSERT INTO tblresident VALUES("11","11","Jehan","","Hadji Said","","male","Manila","Single","2012-06-12","10","0","12312","purok 2","sitio 2","kalyepogi","parking","09108418705","jehan.said@gmail.com","Islam","Web developer","College","Filipino","none","active");
INSERT INTO tblresident VALUES("12","13","Michael","","Jordan","","male","Manila","Married","1963-02-17","58","0","2345","purok 2","sitio 1","LRC","parking","09781234567","michaejordan@gmail.com","Roman Catholic","none","College","American","none","active");
INSERT INTO tblresident VALUES("13","14","Kobe","","Bryant","","male","Manila","Married","1978-08-23","44","0","2408","Purok 3","sitio 3","grove","sevilla street","09244567897","kobe.bryant@gmail.com","Roman Catholic","none","Less Than Highschool","American","none","active");
INSERT INTO tblresident VALUES("14","15","Lebron","","James","","male","Manila","Single","1984-12-30","37","0","2306","purok 2","sitio 2","TELECOM","parking","09623456781","lebronjames@gmail.com","Roman Catholic","none","Less Than Highschool","American","none","active");
INSERT INTO tblresident VALUES("17","18","John","","Wall","","male","Manila","Single","1990-09-06","0","3","202","purok 1","sitio 1","Oroqueta","tinagan","09020146545","john.wall@gmail.com","Roman Catholic","none","College","American","none","active");
INSERT INTO tblresident VALUES("29","30","John Daniel","San Juan","Policarpio","","male","mindoro","Single","2022-09-20","123","3","1004","1","sitio 1","1","1","09123123123","juan.delecaruz123","Jehovah\'s Witnesses","programmer","Bachelor\'s Degree","Filipino","pogi","active");
INSERT INTO tblresident VALUES("32","33","Denver ","Kabiling","Mazo","","male","Pampanga","Single","1999-01-12","23","0","1759","purok 1","sitio 1","KalyePogi","Magnolia Estate","09475044087","denver.mazo@gmail.com","Roman Catholic","Cook","College","Filipino","None","active");
INSERT INTO tblresident VALUES("34","42","Bernandito","Malacas","Mazo","","male","Mindoro","Married","2022-09-07","26","7","1759","","","","","09283523144","bernandito.mazo@gmail.com","Roman Catholic","Machine Operator","College","Filipino","none","active");
INSERT INTO tblresident VALUES("38","39","Bernard","Kabilin","Mazo","","female","Manila","Married","2022-10-13","21","3","1759","","","","","0961606448","nard_maz@gmail.com","Roman Catholic","none","Highschool","Filipino","none","active");



DROP TABLE tbluser;

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `profile` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbluser VALUES("7","lenzay","456","admin","default.jpg");
INSERT INTO tbluser VALUES("8","Odrannn","123","admin0","USER8-634839116729b9.72061641.jpg");
INSERT INTO tbluser VALUES("9","09283523142","12345678","user","USER9-63483de9ae6059.84184043.jpg");
INSERT INTO tbluser VALUES("10","wil","wil","user","default.jpg");
INSERT INTO tbluser VALUES("11","jehan","456","user","default.jpg");
INSERT INTO tbluser VALUES("13","09781234567","12345678","admin0","default.jpg");
INSERT INTO tbluser VALUES("14","09244567897","12345678","admin","default.jpg");
INSERT INTO tbluser VALUES("15","09623456781","12345678","admin","default.jpg");
INSERT INTO tbluser VALUES("18","09020146545","12345678","admin","default.jpg");
INSERT INTO tbluser VALUES("30","poli","pol","user","default.jpg");
INSERT INTO tbluser VALUES("33","09475044087","12345678","user","default.jpg");
INSERT INTO tbluser VALUES("39","0961606448","12345678","user","default.jpg");
INSERT INTO tbluser VALUES("41","HCAdmin","hcadmin","hadmin","default.jpg");
INSERT INTO tbluser VALUES("42","09283523144","12345678","user","default.jpg");
INSERT INTO tbluser VALUES("43","096160644831","12345678","user","default.jpg");



DROP TABLE user_notification;

CREATE TABLE `user_notification` (
  `notification_ID` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(50) NOT NULL,
  `message` varchar(300) NOT NULL,
  `source_ID` int(11) NOT NULL,
  `resident_ID` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `status` smallint(2) NOT NULL,
  PRIMARY KEY (`notification_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

INSERT INTO user_notification VALUES("7","Requested Document on process","Your document request is on process.","5","11","2022-10-11 00:00:00","1");
INSERT INTO user_notification VALUES("8","Requested Document on process","Your document request is on process.","5","11","2022-10-11 00:00:00","1");
INSERT INTO user_notification VALUES("9","Requested Document on process","Your document request is on process.","5","11","2022-10-11 00:00:00","1");
INSERT INTO user_notification VALUES("10","Requested Document on process","Your Certificate of Indigency request is on proces","5","11","2022-10-11 00:00:00","1");
INSERT INTO user_notification VALUES("11","Requested Document on process","Your Barangay Clearance request is on process.","5","11","2022-10-11 00:00:00","1");
INSERT INTO user_notification VALUES("12","Filed Complaint","Your complain has been marked solved.","0","0","2022-10-11 00:00:00","0");
INSERT INTO user_notification VALUES("13","Filed Complaint","Your complain has been marked solved.","5","0","2022-10-11 00:00:00","0");
INSERT INTO user_notification VALUES("14","Filed Complaint","Your complain has been marked solved.","5","9","2022-10-11 00:00:00","1");
INSERT INTO user_notification VALUES("15","Filed Complaint","Your complain has been marked solved.","5","9","2022-10-11 06:13:37","1");
INSERT INTO user_notification VALUES("20","Sent Suggestion","Exo. Bernard Kabiling Mazo <br>sent a feedback to ","5","9","2022-10-11 06:30:14","1");
INSERT INTO user_notification VALUES("21","Sent Suggestion","Exo. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.","5","9","2022-10-11 06:32:01","1");
INSERT INTO user_notification VALUES("22","Filed Blotter","You are invited to the barangay hall <br> to settle the blotter that you are involved.","5","11","2022-10-11 06:48:48","1");
INSERT INTO user_notification VALUES("23","Filed Blotter","You are invited to the barangay hall <br> to settle the blotter that you are involved.","5","10","2022-10-11 06:48:48","1");
INSERT INTO user_notification VALUES("33","Requested Document on process","Your Barangay Clearance request is ready.<br>
    You can now download the soft copy from view<br>
    requests tab or claim it in the Barangay Hall.","5","11","2022-10-12 04:11:14","1");
INSERT INTO user_notification VALUES("34","Requested Document on process","Your Barangay Clearance request is ready.<br>
    You can now download the soft copy from view<br>
    requests tab or claim it in the Barangay Hall.","5","11","2022-10-12 04:11:29","1");
INSERT INTO user_notification VALUES("35","Requested Document on process","Your Barangay Clearance request is ready.<br>
    You can now download the soft copy from view<br>
    requests tab or claim it in the Barangay Hall.","5","11","2022-10-12 04:12:04","1");
INSERT INTO user_notification VALUES("36","Requested Document on process","Your Barangay Clearance request is ready.<br>
    You can now download the soft copy from view<br>
    requests tab or claim it in the Barangay Hall.","5","11","2022-10-12 04:12:09","1");
INSERT INTO user_notification VALUES("37","Requested Document on process","Your Barangay Clearance request is ready.<br>
        You can now download the soft copy from view<br>
        requests tab or claim it in the Barangay Hall.","5","11","2022-10-12 04:35:18","0");



