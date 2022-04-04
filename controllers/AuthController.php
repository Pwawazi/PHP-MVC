<?php

namespace app\controllers;
require __DIR__.'/../base/Database.php';


use app\models\Role;
use app\models\User;
use app\base\Request;
use app\base\Response;
use app\models\County;
use app\base\Controller;
use app\base\Application;



class AuthController extends Controller
{
    #Function to register a user
    public function register(Request $request)
    {
        // $user = User::find($_SESSION['user']);
        // if($user)
        // {
        //     return Application::$app->response->redirect('/'); 
        // }
        $roles_available = Role::where('role' ,'!=', 'admin')->get();
        $counties = County::all();
        $errors = array();
        $input = [];

        if($request->isPost())
        {   
            
            Application::$app->request->getBody();
            // echo('<pre>');
            // var_dump($request->getBody());
            // echo('</pre>');
            // exit;
            $firstname = $request->getBody()['firstname'];
            $lastname = $request->getBody()['lastname'];
            $email = $request->getBody()['email'];
            $phone_number = $request->getBody()['phone_number'];
            $county = number_format($request->getBody()['county']);
            $role = number_format($request->getBody()['role']);
            $password = $request->getBody()['password'];
            $confirmPassword = $request->getBody()['confirmPassword']; 

            if(!$firstname)
            {
                $errors['firstname'] = 'This field is required!';
                $input['lastname'] = $request->getBody()['lastname'] ?? '';
                $input['email'] = $request->getBody()['email'] ?? '';
                $input['phone_number'] = $request->getBody()['phone_number'] ?? '';
            }

            if(!$lastname)
            {
                $errors['lastname'] = 'This field is required!';
                $input['firstname'] = $request->getBody()['firstname'] ?? '';
                $input['email'] = $request->getBody()['email'] ?? '';
                $input['phone_number'] = $request->getBody()['phone_number'] ?? '';
            }

            if(!$email)
            {
                $errors['email'] = 'This field is required';
                $input['firstname'] = $request->getBody()['firstname'] ?? '';
                $input['lastname'] = $request->getBody()['lastname'] ?? '';
                $input['phone_number'] = $request->getBody()['phone_number'] ?? '';
            }


            if(!$phone_number)
            {
                $errors['phone_number'] = 'This field is required';
                $input['firstname'] = $request->getBody()['firstname'] ?? '';
                $input['lastname'] = $request->getBody()['lastname'] ?? '';
                $input['email'] = $request->getBody()['email'] ?? '';
            }


            if(User::where('email', '=', $email)->exists())
            {
                $errors['email'] = 'Email already taken';
                $input['firstname'] = $request->getBody()['firstname'] ?? '';
                $input['lastname'] = $request->getBody()['lastname'] ?? '';
                $input['phone_number'] = $request->getBody()['phone_number'] ?? '';
            }

            if(User::where('phone_number', '=', $phone_number)->exists())
            {
                $errors['phone_number'] = 'Phone Number already in use';
                $input['firstname'] = $request->getBody()['firstname'] ?? '';
                $input['lastname'] = $request->getBody()['lastname'] ?? '';
                $input['email'] = $request->getBody()['email'] ?? '';

            }

            if(!$password || $password !== $confirmPassword || $password ==' ')
            {
                $errors['password'] = 'Passwords do not match';
                $input['firstname'] = $request->getBody()['firstname'] ?? '';
                $input['lastname'] = $request->getBody()['lastname'] ?? '';
                $input['email'] = $request->getBody()['email'] ?? '';
                $input['phone_number'] = $request->getBody()['phone_number'] ?? '';
            }

            if(strlen($request->getBody()['password']) < 6)
            {
                $errors['password'] = 'Passwords must be a minimum of 6 characters';
                $input['firstname'] = $request->getBody()['firstname'] ?? '';
                $input['lastname'] = $request->getBody()['lastname'] ?? '';
                $input['email'] = $request->getBody()['email'] ?? '';
                $input['phone_number'] = $request->getBody()['phone_number'] ?? '';
            }    

            if(sizeof($errors) == 0)
            {
                $user_role = Role::find($role);
                $user = User::create([
                                    'firstname' => $firstname,
                                    'lastname' => $lastname, 
                                    'email' => $email,
                                    'phone_number' => $phone_number,
                                    'role_id' => $role,
                                    'county_id' => $county,
                                    'password' => password_hash($password,PASSWORD_BCRYPT), 
                                ]);
                
                echo('<pre>');
                // var_dump($user->role()->get());
                echo('</pre>');
                exit;
                Application::$app->session->setFlash('success', 'Thanks for registering');
                return Application::$app->response->redirect('/login');         
            }
        }

        $this->setLayout('auth');
        return $this->render('register', [
            'roles_available' => $roles_available,
            'counties'=> $counties,
            'errors' => $errors,
            'input' => $input
        ]);
    }


    #Function to implement login    
    public function login(Request $request)
    {
        $user = User::find($_SESSION['user']);
        if($user)
        {
            return Application::$app->response->redirect('/'); 
        }

        $errors = array();
        $input = [];

        if($request->isPost())
        {   
            
            Application::$app->request->getBody();
        
            $email = $request->getBody()['email'];
            $password = $request->getBody()['password'];

            if(!$email)
            {
                $errors['email'] = 'This field is required';
            }
            
            $user = User::where('email', '=', $email)->first();

            if(empty($user))
            {
                $errors['email'] = 'Invalid Credentials';
            }

            // echo '<pre>';
            // var_dump(password_verify($password, $user->password));
            // echo '</pre>';
            // exit;

            if(password_verify($password, $user->password) === false)
            {
                $errors['password'] = 'Invalid Credentials';
            }


            if(sizeof($errors) == 0)
            {
                Application::$app->session->setFlash('success', 'Login successful');
                Application::$app->login($user);
                return Application::$app->response->redirect('/');         
            }
        }

        $this->setLayout('auth');
        return $this->render('login', [
            'errors' => $errors,
            'input' => $input
        ]);
    }

    public function logout(Request $request)
    {

        // echo '<pre>';
        // var_dump(User::find($_SESSION['user']));
        // echo '</pre>';
        // exit;
        $user = User::find($_SESSION['user']);
        Application::$app->session->setFlash('success', 'Logout successful');
        Application::$app->logout($user);
        return Application::$app->response->redirect('/'); 
    }

    public function profile()
    {
        $user = User::find($_SESSION['user']);
        return $this->render('profile', ['user' => $user]);
    }

}