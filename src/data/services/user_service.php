<?php

namespace VacationPortal\Data\Services;


use VacationPortal\Helpers\Validator;
use VacationPortal\Data\Model\Security\User;
use VacationPortal\Data\Model\Basic\Address;
use VacationPortal\Data\Model\Basic\Contact;
use VacationPortal\Data\Model\Dto\LoginDto;
use VacationPortal\Data\Model\Dto\UserDto;
use VacationPortal\Data\Model\Responses\ResponseObject;
use VacationPortal\Helpers\LoginDtoValidator;
use VacationPortal\Helpers\UserDtoValidator;

class UserService
{

    public function registerUser(UserDto $userDto): ResponseObject{
        global $userRepository;

        $validator = new UserDtoValidator();

        if (!$validator->validate($userDto))
            return new ResponseObject(1, $validator->validation_error);


        $user = new User();
        $user->address = new Address();
        $user->contact = new Contact();

        $user->username = $userDto->username;
        $user->password = hashPassword($userDto->password);
        $user->first_name = $userDto->first_name;
        $user->last_name = $userDto->last_name;
        $user->date_of_birth = $userDto->date_of_birth;
        $user->role_id = $userDto->role_id;

        $user->address = new Address();
        $user->address->street = $userDto->street;
        $user->address->area = $userDto->area;
        $user->address->city = $userDto->city;
        $user->address->postal_code = $userDto->postal_code;
        $user->address->state = $userDto->state;
        $user->address->country = $userDto->country;

        $user->contact = new Contact();
        $user->contact->phone_one = $userDto->phone_one;
        $user->contact->phone_two = $userDto->phone_two;
        $user->contact->phone_three = $userDto->phone_three;
        $user->contact->phone_four = $userDto->phone_four;
        $user->contact->mobile = $userDto->mobile;
        $user->contact->email = $userDto->email;

        if (!$userRepository->add($user)) {
            return new ResponseObject(1, "error");
        }

        return new ResponseObject(0, "User Register Success");
    }

    public function login(LoginDto $loginDto) : ResponseObject {
        global $userRepository;

        $validator = new LoginDtoValidator();

        if (!$validator->validate($loginDto))
            return new ResponseObject(1, $validator->validation_error);

        $user = $userRepository->fetchWithEMail($loginDto->email);

        if(!isset($user) || $user == NULL){
            return new ResponseObject(1, "User does not exist.");
        }

        if(!comparePasswords($loginDto->password, $user->password)){
            return new ResponseObject(1, "You typed wrong password.");
        }

        if($loginDto->isRememberMe){
            setcookie("LoginCredentials", $loginDto, time() +2592000, "/");
        }
        
        $user->password = "";
        $_SESSION['user'] = serialize($user);

        
        return new ResponseObject(0, "Successfull Login.");
    }

    public function getUser(int $id): ResponseObject
    {
        global $userRepository;
        return new ResponseObject(0, "", $userRepository->fetch($id));
    }

    public function getAllUsers() : ResponseObject
    {
        global $userRepository;

        return new ResponseObject(0, "", $userRepository->fetchAll());
    }

    public function updateUser(User $user) : ResponseObject{
        global $userRepository;

        if(!$userRepository->update($user)){
            return new ResponseObject(1, "Something goes wrong and cannot update user.");
        }

        return new ResponseObject(0, "User Updated");
    }
}
