<? 

class UserController extends Controller{
    //Needs validation
	function create($f3, $params){
        header('Content-type:application/json');

        try{
            $user = new User($this->db);          
            $data = json_decode($f3->get('BODY'), true);
            
            $check = $user->checkUserExists($data['username']);
            if(empty($check)){
                $user->create($data);
                echo json_encode(array(
                    'success' => true,
                    'message' => 'User created'
                ));
            }
            else{
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Username taken'
                ));
            }  
           
        }catch(Exception $e){
            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));
        }

    }

    function readByUsername($f3, $params){
        header('Content-type:application/json');

        try{
            $userName = $params['userName'];

                if(empty($userName)){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Search requires username'
                ));

                return;
                }
        
        $user = new User($this->db);

        $result = $user->readByUsername($userName);

        echo json_encode(array(
            'success' => true,
            'count' => count($result),
            'results' => $result
        ));
}catch(Exception $e) {
    echo json_encode(array(
        'success' => false,
        'message' => $e->getMessage()
));
}
    }

   function deactivateUser($f3, $params){
    header('Content-type:application/json');

    try{
        $user = new User($this->db);          
        $data = json_decode($f3->get('BODY'), true);
        
        $result = $user->deactivateUser($data['username'],$data['password']);
        if(empty($result)){
            echo json_encode(array(
                'success' => false,
                'message' => 'Password is incorrect'
            ));
        }else{
            echo json_encode(array(
                'success' => true,
                'message' => 'User deactivated'
            )); 
        }
    }catch(Exception $e){
        echo json_encode(array(
            'success' => false,
            'message' => $e->getMessage()
        ));
    }
   } 

}
?>