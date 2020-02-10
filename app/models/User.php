<?

class User extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db)
    {
        parent::__construct($db, 'users');
    }

    public function create($data){
        try{
            $this->copyFrom($data);
            $user = new User($this->db);
            $user -> checkUserExists($data['username']);

            $username = $data['username'];
            $sha1 =  sha1($data['password']);
            $blowfish = crypt(md5($sha1), '$2a$07$ThisSaltIsUnecessarilyLong$');
            $sha512 = hash('sha512',$blowfish);
            $password=$sha512;
            $role = 'user';
            $active = 'Y';

            $query = "INSERT INTO users (username, password, role, active) 
  			      VALUES('$username', '$password', '$role', '$active')";
             $result = $this->db->exec($query);
             return $result;
        }catch(Exception $e){
            throw new Exception($e);
        }
    }

    public function checkUserExists($userName){
            $query = "  SELECT username
                        FROM users
                        WHERE username='$userName'
            ";
            $result = $this->db->exec($query);
            if(!empty($result)){   
                return $result;
            }
    }

    public function readByUsername($userName){
        try {
            $query = "  SELECT id,username,role,active 
                        FROM users
                        WHERE username='$userName'
                        AND active='Y'
            ";
            $result = $this->db->exec($query);
            return $result;
        }catch(Exception $e){
            throw new Exception($e);
        }
    }

    public function deactivateUser($userName, $password){
        try{
            $sha1 =  sha1($password);
            $blowfish = crypt(md5($sha1), '$2a$07$ThisSaltIsUnecessarilyLong$');
            $sha512 = hash('sha512',$blowfish);
            $password=$sha512;
            $query = "  SELECT username, password
                        FROM users
                        WHERE username = '$userName'
                        AND password= '$password'
            ";
            $result = $this->db->exec($query);
            if(!empty($result)){
                $query = "  UPDATE users 
                            SET active='N' 
                            WHERE username='$userName'";
                $result = $this->db->exec($query);
            }
            
            return $result;
            $this->save();

        }catch(Exception $e){
            throw new Exception($e);
        }
    }

}