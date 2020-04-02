<?php

namespace ITSO\Admin;

class UsersController extends \Epic\BaseController {

	public function createAction() {
        return view('users/create');
	}
	public function addAction() {

        $name = $_REQUEST['formContactLastName'];
        $firstname = $_REQUEST['formContactFirstName'];
        $date_of_birth = $_REQUEST['formContactDateOfBirth'];
        $email = $_REQUEST['formContactEmail'];
        $password = $_REQUEST['formContactPassword'];
        $gender = $_REQUEST['gender'];
        $gender = 1;
        $language = $_REQUEST['formContactLanguage'];
        $nationality = $_REQUEST['formContactNationality'];
        $state = $_REQUEST['formContactStatus'];

        $stmt = $this->pdo->prepare("INSERT INTO `users`(`name`, `firstname`, `date_of_birth`, `email`, `password`, `gender`, `language`, `nationality`, `state`) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $firstname);
        $stmt->bindParam(3, $date_of_birth);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $password);
        $stmt->bindParam(6, $gender);
        $stmt->bindParam(7, $language);
        $stmt->bindParam(8, $nationality);
        $stmt->bindParam(9, $state);
        $stmt->execute();

        return view('users/create');
	}

    public function listAction() {
        $q = $this->pdo->query("SELECT * FROM users");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = $datas;
        }
        return view('users/list',compact('users'));
    }

}
