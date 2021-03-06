<?php
/**
 * Chess roles
 * User: Alf Magne Kalleland
 * Date: 05.02.13
 */
class ChessRoles implements LudoDBService
{
    const LOGIN = 1;
    const EDIT_GAMES = 2;
    const IMPORT_GAMES = 4;
    const EDIT_USERS = 8;

    private $roles = array(
        'LOGIN' => array('code' => 1, 'label' => 'Login'),
        'EDIT_GAMES' => array('code' => 2,'label' => 'Edit and save games'),
        'IMPORT_GAMES' => array('code' => 4, 'label' =>'Import games from pgn files')
    );

    public function read(){
        return $this->roles;
    }

    public function hasAccessTo(Player $user, $role){
        return $user->getUserAccess() & $role;
    }

    public function getValidServices(){
        return array('read');
    }

    public function getOnSuccessMessageFor($service){
        return "";
    }

    public function validateArguments($service, $arguments){
        return count($arguments) === 0;
    }

    public function validateServiceData($service, $arguments){
        return true;
    }

    public function shouldCache($service){
        return false;
    }
}
