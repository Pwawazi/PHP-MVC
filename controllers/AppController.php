<?php

namespace app\controllers;
require __DIR__.'/../base/Database.php';


use app\base\Application;
use app\base\Controller;
use app\base\Request;
use app\models\County;
use app\models\User;
use app\models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class AppController extends Controller
{
    /**
     * 
     *Return the 'home page' Function
     * 
     */
    public function home(Request $request)
    {   
        $user = User::find($_SESSION['user']);
        $params = [
            'user' => $user
        ];

        return $this->render('home', $params);
    }

    /**
     * 
     * Return the contact page function
     * 
     */
    public function contact()
    {   
        $user = Application::$app->user();

        if (Application::$app->isGuest())
        {
            return $this->render('home');
        }
        return $this->render('contact', ['user' => $user]);
    }


    public function handleContact(Request $request)
    {
        Application::$app->request->getBody();
        return 'Handling submitted Data';
    }


    /**
     * 
     * Return the shop page
     * 
     */
    public function shop(Request $request)
    {
        $user = Application::$app->user();
        $params = $request->getRouteParams();
        $products = Product::all();

        if (Application::$app->isGuest())
        {
            return $this->render('home');
        }

        if($params)
        {
            //Initially tried passing form data
            // $data = Application::$app->request->getBody();
            // $product = Product::findOrFail(intval($data['product_id']));

            $some_products = Product::latest()->take(2)->get();

            try 
            {
                $product = Product::findOrFail(intval($params['id']));
            } 
            catch (ModelNotFoundException $ex) 
            {
                Application::$app->session->setFlash('danger', 'No such product!');
                return $this->render('shop', [
                    'user' => $user,
                    'products' => $products
                ]);
            }

            return $this->render('single-product', [
                'user' => $user,
                'product' => $product,
                'some_products' => $some_products
            ]);
        }

        return $this->render('shop', [
            'user' => $user,
            'products' => $products
        ]);
    }

    /** 
     * Return the users list page
     * 
     */
    public function users(Request $request)
    {
        // $user = Application::$app->user();
        $users = User::all();

        if (Application::$app->isGuest())
        {
            return $this->render('home');
        }

        $product = Product::all();
        return $this->render('users_list', [
            'users' => $users,
            'product' => $product
        ]);
    }

    /** 
     * Return the users in json format
     * 
     */
    public function usersJson(Request $request)
    {
        // $user = Application::$app->user();
        $users = User::all()->toJson();
        return $users;
    }


    /** 
     * Return the users list page
     * 
     */
    public function products_list(Request $request)
    {
        // $user = Application::$app->user();
        $products = Product::all();

        if (Application::$app->isGuest())
        {
            return $this->render('home');
        }

        return $this->render('products_list', [
            'products' => $products
        ]);
    }


    /**
     * 
     * Add a product function
     * 
     */
    public function addProduct(Request $request)
    {
        $user = Application::$app->user();
        $errors = array();
        $input = [];

        if (Application::$app->isGuest())
        {
            return $this->render('home');
        }
        
        if($user->role_id != 2)
            {
                return Application::$app->response->redirect('/'); 
            }

        if($request->isPost())
        {
            Application::$app->request->getBody();

            $product_name =  $request->getBody()['product'];
            $user_id =  number_format($request->getBody()['user']);
            $price =  $request->getBody()['price'];
            $stock =  $request->getBody()['stock'];
            $description = $request->getBody()['description'];
            $product_image = $_FILES['product_image']['name'];
            $image_width = (@getimagesize($_FILES['product_image']['tmp_name']))[0];
            $image_height = (@getimagesize($_FILES['product_image']['tmp_name']))[1];

            if(!$product_name)
            {
                $errors['product_name'] = 'This field is required!';
                $input['user_id'] = $user_id;
                $input['price'] = $price ?? '';
                $input['stock'] = $stock ?? '';
                $input['description'] = $description ?? '';
            }

            if(!$user_id)
            {
                return Application::$app->response->redirect('/logout');
            }

            if(!$price)
            {
                $errors['price'] = 'This field is required!';
                $input['user_id'] = $user_id;
                $input['product_name'] = $product_name ?? '';
                $input['stock'] = $stock ?? '';
                $input['description'] = $description ?? '';
            }

            if(!$stock)
            {
                $errors['stock'] = 'This field is required!';
                $input['user_id'] = $user_id;
                $input['price'] = $price ?? '';
                $input['product_name'] = $product_name ?? '';
                $input['description'] = $description ?? '';
            }

            if(!$product_image)
            {
                $errors['product_image'] = 'This field is required!';
                $input['user_id'] = $user_id;
                $input['price'] = $price ?? '';
                $input['stock'] = $stock ?? '';
                $input['product_name'] = $product_name ?? '';
                $input['description'] = $description ?? '';
            }

            if($image_width > "900" || $image_height > "800")
            {
                $errors['product_image'] = 'Image dimensions should be within 800X800';
                $input['user_id'] = $user_id;
                $input['price'] = $price ?? '';
                $input['stock'] = $stock ?? '';
                $input['product_name'] = $product_name ?? '';
                $input['description'] = $description ?? '';
            }

            if(sizeof($errors) == 0)
            {
                $image_name = $_FILES['product_image']['name'];
                $tmp_name = $_FILES['product_image']['tmp_name'];
                $path = pathinfo($image_name);
                $filename = $path['filename'];
                $folder = Application::$ROOT_DIR."/public/product_images/";
                $ext = $path['extension'];
                date_default_timezone_set('Africa/Nairobi');
                $date = date('Y-m-d H:i:s');
                $path_filename_ext = $folder.$date.'.'.$filename.'.'.$ext;
                $folder = Application::$ROOT_DIR."/public/product_images/";
                move_uploaded_file($tmp_name, $path_filename_ext);


                $product = Product::create([
                    'product_name' => $product_name,
                    'user_id' => $user_id, 
                    'price' => $price,
                    'product_image_name' => $date.'.'.$filename.'.'.$ext,
                    'description' => $description,
                    'stock' => $stock,
                ]);
                Application::$app->session->setFlash('success', 'Product saved successfully!');
                return Application::$app->response->redirect('/add-product');   
            }
        }

        return $this->render('product_create', [
            'user' => $user,
            'errors' => $errors,
            'input' => $input
        ]);
    }


    /**
     * 
     * Add a product function
     * 
     */
    public function editProduct(Request $request)
    {
        $user = Application::$app->user();
        $params = $request->getRouteParams();
        $products = Product::all();
        $errors = array();
        $input = [];
        

        if (Application::$app->isGuest())
        {
            return $this->render('home');
        }

        try 
        {
            $product = Product::findOrFail(intval($params['id']));
        } 
        catch (ModelNotFoundException $ex) 
        {
            Application::$app->session->setFlash('danger', 'No such product!');
            return $this->render('shop', [
                'user' => $user,
                'products' => $products
            ]);
        }

        if($user != $product->user)
            {
                return Application::$app->response->redirect('/'); 
            }

        if($request->isPost())
        {
            Application::$app->request->getBody();

            $product_name =  $request->getBody()['product'];
            $user_id =  number_format($request->getBody()['user']);
            $price =  $request->getBody()['price'];
            $stock =  $request->getBody()['stock'];
            $description = $request->getBody()['description'];
            $product_image = $_FILES['product_image']['name'];
            $image_width = (@getimagesize($_FILES['product_image']['tmp_name']))[0];
            $image_height = (@getimagesize($_FILES['product_image']['tmp_name']))[1];

            if(!$product_name)
            {
                $errors['product_name'] = 'This field is required!';
                $input['user_id'] = $user_id;
                $input['price'] = $price ?? '';
                $input['stock'] = $stock ?? '';
                $input['description'] = $description ?? '';
            }

            if(!$user_id)
            {
                return Application::$app->response->redirect('/logout');
            }

            if(!$price)
            {
                $errors['price'] = 'This field is required!';
                $input['user_id'] = $user_id;
                $input['product_name'] = $product_name ?? '';
                $input['stock'] = $stock ?? '';
                $input['description'] = $description ?? '';
            }

            if(!$stock)
            {
                $errors['stock'] = 'This field is required!';
                $input['user_id'] = $user_id;
                $input['price'] = $price ?? '';
                $input['product_name'] = $product_name ?? '';
                $input['description'] = $description ?? '';
            }

            if(!$product_image)
            {
                $errors['product_image'] = 'This field is required!';
                $input['user_id'] = $user_id;
                $input['price'] = $price ?? '';
                $input['stock'] = $stock ?? '';
                $input['product_name'] = $product_name ?? '';
                $input['description'] = $description ?? '';
            }

            if($image_width > "900" || $image_height > "800")
            {
                $errors['product_image'] = 'Image dimensions should be within 800X800';
                $input['user_id'] = $user_id;
                $input['price'] = $price ?? '';
                $input['stock'] = $stock ?? '';
                $input['product_name'] = $product_name ?? '';
                $input['description'] = $description ?? '';
            }

            if(sizeof($errors) == 0)
            {
                $image_name = $_FILES['product_image']['name'];
                $tmp_name = $_FILES['product_image']['tmp_name'];
                $path = pathinfo($image_name);
                $filename = $path['filename'];
                $folder = Application::$ROOT_DIR."/public/product_images/";
                $ext = $path['extension'];
                date_default_timezone_set('Africa/Nairobi');
                $date = date('Y-m-d H:i:s');
                $path_filename_ext = $folder.$date.'.'.$filename.'.'.$ext;
                $folder = Application::$ROOT_DIR."/public/product_images/";
                move_uploaded_file($tmp_name, $path_filename_ext);


                $product->product_name = $product_name;
                $product->price = $price;
                $product->product_image_name = $date.'.'.$filename.'.'.$ext;
                $product->description = $description;
                $product->stock = $stock;
                $product->save();

                Application::$app->session->setFlash('success', 'Product edited successfully!');
                return Application::$app->response->redirect('/');   
            }
        }

        // echo('<pre>');
        // echo(var_dump($product->product_name));
        // echo('</pre>');
        // exit();
        return $this->render('product_edit', [
            'user' => $user,
            'errors' => $errors,
            'input' => $input,
            'product' => $product
        ]);
    }

    /**
     * 
     * Return the cart page
     * 
     */
    public function cart(Request $request)
    {
        $user = Application::$app->user();
        $products = Product::all();
        return $this->render('cart', [
            'user' => $user,
            'products' => $products
        ]);
    }

    /**
     * 
     * Contact form for the vendor of specific product
     */
    public function contactVendor(Request $request)
    {
        $user = Application::$app->user();
        $products = Product::all();
        $params = $request->getRouteParams();

        if($params)
        {
            $some_products = Product::latest()->take(2)->get();

            try 
            {
                $product = Product::findOrFail(intval($params['id']));
            } 
            catch (ModelNotFoundException $ex) 
            {
                Application::$app->session->setFlash('danger', 'No such product!');
                return $this->render('shop', [
                    'user' => $user,
                    'vendor' => $product->user->firstname,
                    'products' => $products
                ]);
            }

            // echo '<pre>';
            // var_dump($product->user->firstname);
            // echo '</pre>';
            // exit;
            $vendor = $product->user;
            return $this->render('profile', [
                'user' => $user,
                'product' => $product,
                'vendor' => $vendor,
                'some_products' => $some_products
            ]);
        }
        
    }

    /**
     * 
     * Send email to notify the vendor
     * 
     */
    public function emailVendor(Request $request)
    {
        if($request->isPost())
        {
            Application::$app->request->getBody();
            $name = $request->getBody()['name'];
            $from = $request->getBody()['from_email'];
            $to = $request->getBody()['to_email'];
            $phone = $request->getBody()['phone'];
            $subject = $request->getBody()['subject'];
            $message = $request->getBody()['message'];
            // echo '<pre>';
            // var_dump(Application::$app->request->getBody());
            // echo '</pre>';
            // exit;
            $vendor = User::where('email', '=', $to)->first();
            $user = Application::$app->user();
            $text = <<< Body
                Hello $vendor->firstname,

                $user->firstname says:

                $message

                You can reach them at $phone or $from.

                Thank you for using our services.
            Body;
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = $_ENV['MAILTRAPUSERNAME'];
            $phpmailer->Password = $_ENV['MAILTRAPPASSWORD'];  
            $phpmailer->setFrom('support@mahindionline.com', 'Mahindi Online');           
            $phpmailer->addAddress($to, $vendor->firstname);
            $phpmailer->isHTML(true);                                  
            $phpmailer->Subject = $subject;
            $phpmailer->Body    = $text;
            $phpmailer->AltBody = $text;
            $phpmailer->send();

            $products = Product::all();
            return $this->render('shop', [
                'user' => $user,
                'products' => $products
            ]);
        }
    }

}