<?php
class BaseModel
{
    protected $connection = null;

    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function __destruct() {
        $this->connection->close();
    }

    public function query($query, $paramTypes="", ...$params)
    {        
        try {
            $stmt = $this->connection->prepare($query);
            if ($stmt === false) {
                throw new Exception("Unable to prepare statement: " . $query);
            }
            if ($params) {                
                $stmt->bind_param($paramTypes, ...$params);
            }
            $stmt->execute();

            $result = $stmt->get_result();
            if ($result instanceof mysqli_result) {
                $result = $result->fetch_all(MYSQLI_ASSOC);
            }
            /********
             * https://www.php.net/manual/en/mysqli-stmt.get-result.php
                dsaf
             * `get_result` returns `false` on failure OR successful `INSERT` stmt
            */
            else {
                if ($stmt->errno === 0) $result = true;
            }
            
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
