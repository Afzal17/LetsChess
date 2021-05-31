<?php

	// This is the database class for functionality throughout
	// the application, connection & functionality
	class database {

		// properties
		// think about a username or a email (something that can contain functionalities)

		// classes
		// think about adding a new friend or updating your status (functionalities)

		// | The Database Connection | //
		// Here we are making properties for our database connection (private properties), we don't want these properties to be modified outside this class for security reasons

		// What variables are needed for a php connection

		private $host; // MySQL
		private $user; // yourself as a user
		private $password; // user password phpmyadmin
		private $db; //
		private $charset; //
		private $connection; // database connection

		function __construct() {
			$this->host = 'localhost'; // is our host
			$this->user = 'root'; // root is our username
			$this->password = ''; // empty password string
			$this->db = 'schaak_applicatie'; // This is our database name
			$this->charset = 'utf8mb4';

			$options = [
				PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES => false
			];

			try {
				// DSN = Data Source Name, eerste argument van de PDO Class instance
				$dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

				// Here we are making a database connection
				$this->connection = new PDO($dsn, $this->user, $this->password, $options);

			} catch (\PDOException $e) {
				throw new \PDOException("Error message is: ". $e->getMessage());
			}


		} // End of the construct function

		public function insert($statement, $placeholder, $location){

			try {

				$this->connection->beginTransaction(); // Start transaction
				$stmt = $this->connection->prepare($statement); // Prepare the sql statement
				$stmt->execute($placeholder); // Execute the sql statement with a placeholder
				$this->connection->commit(); // Commit the sql statement data into the database

				header("location: $location"); // If everything went correct then redirect to assigned webpage

			}catch(\Exception $e){
				$this->connection->rollback();
				echo "Error message is: ". $e->getMessage();
			}

		} // End of the insert function


		public function select($statement, $placeholder){ // used for selecting data the read function

			$stmt = $this->connection->prepare($statement); //preparing our sql prepared statement

			$stmt->execute($placeholder); //executing our prepared statement

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // putting the prepared statement in a result variable

			return $result; // returning the result of the $result variable

		} // End of the select function


		// Public function edit_or_delete this function is dynamic
		public function edit_or_delete($statement, $named_placeholder, $location) {
			// var_dump($named_placeholder);
			$stmt = $this->connection->prepare($statement);
			$stmt->execute($named_placeholder);
			header("location: $location");
			exit();
		} // End of the edit_or_delete function





	}// End of the database class

?>