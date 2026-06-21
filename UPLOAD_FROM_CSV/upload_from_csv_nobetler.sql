SET @db='uyumaha_muscleman';
USE @db;
SET @tbl='tvpano_nobetler_upload_test';
SET @q := CONCAT('select * from ',@db,'.',@tbl);
PREPARE stmt FROM @q;
EXECUTE stmt;

TRUNCATE TABLE uyumaha_muscleman.tvpano_nobetler_upload_test;
LOAD DATA LOCAL INFILE 'd:/servers/public_html/panotv_mkal/UPLOAD_FROM_CSV/tvpano_nobetler_upload_test.csv' 
REPLACE INTO
	TABLE uyumaha_muscleman.tvpano_nobetler_upload_test FIELDS TERMINATED BY ';' ENCLOSED BY '"' LINES TERMINATED BY '\n' 
	IGNORE 1 LINES
	(id,
	nobetyeri,
	nobetci,
	nobetgunu);
	
SELECT * FROM uyumaha_muscleman.tvpano_nobetler_upload_test;
