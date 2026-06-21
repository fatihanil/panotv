<?php
class mayeSQL{	
	public $db;
	function __construct(){
		try{
			$this->db=new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DATABASE,MYSQL_USER,MYSQL_PASS);
		}catch(PDOException $e){
			echo "MYSQL VERİTABANI SUNUCU bağlantısı yapılamadı: ".$e->getMessage();
		}
		return $this->db;	
	}
	function sentQuery($sql){
		if(stripos($sql,"select")==0){
			if($veritabaninin_cevabi=$this->db->query($sql)){			
				$i=0;
				while($veritabaninin_cevabinin_bir_satiri=$veritabaninin_cevabi->fetch(PDO::FETCH_ASSOC)){
					$sorgu_sonucu[$i]=$veritabaninin_cevabinin_bir_satiri;
					$i++;
				}
				if(isset($sorgu_sonucu)){
					return $sorgu_sonucu;
				}else{
					return $sorgu_tamam=true;
				}			
		}else{
			echo "Sorgu cümlesinde bir hata veya eksik var...";
			$ilgili_hata=$this->db->errorInfo();
			echo "Hata mesajı: ".$ilgili_hata[2];
		}		
		}else{
			if($this->db->exec($sql)){
				return $sorgu_tamam=true;
			}else{
				echo "Sorgu cümlesinde bir hata veya eksik var...";
				$ilgili_hata=$this->db->errorInfo();
				echo "Hata mesajı: ".$ilgili_hata[2];
			}			
		}		
	}
	function __destruct(){		
		$this->db=null;
	}
}