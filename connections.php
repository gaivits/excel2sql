<?php
class connections
{
    public function oracleMyConn() {		
		$username = 'tsttest';
		$password = 'tsttest';
		$dsn = 'oci:dbname=//203.154.74.90:1521/mmdb';

		try {
    		$pdo = new PDO($dsn, $username, $password);
    		// Set the PDO error mode to exception
    		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		//echo 'Connected to the database';
			
			return $pdo;
		} 
		catch (PDOException $e) {
    		echo 'Connection failed: ' . $e->getMessage();
			return ;	
		}
	}
    
}
