<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user {id?} 
    {--A|all : Get All Users}
    {--O|option=get : GET, CREATE, UPDATE and DELETE}
    {--S|search= : Search User} 
    {--L|limit=10 : Limit Records}
    {--F|fields= : Value must follow a format:yourname,email:youremail@domain.com,password:yourpassword} 
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Management';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->argument('id');
        $all = $this->option('all');
        $option = $this->option('option');
        $search = $this->option('search') ? trim($this->option('search'), '\'"') : $this->option('search');
        $limit = $this->option('limit');
        $fields = trim($this->option('fields'), '\'"');
//        dd($this->options());
        if($id == null && $all == false && $option == 'get' && $search == null){
            $this->info('Welcome to User Management');
            $this->comment('You can intput "--help" to show all commands');
            exit();
        }

//        dd($this->options());
        if(is_numeric($id) && strtolower($option) == "get"){
            $this->getUser($id);
        }elseif ($id == null && strtolower($option) == 'create' && $fields != null){
//            dd(1231);
            $this->createUser($fields);
        }elseif (is_numeric($id) && strtolower($option) == 'update' && $fields != null){
            $this->updateUser($id, $fields);
        }elseif (is_numeric($id) && strtolower($option) == 'delete'){
            $this->deleteUser($id);
        }

        if($all == true && $search == null){
            $this->getUsers($limit);
        }elseif($search != null){
            $this->searchUsers($search, $limit);
        }

        $this->info('Welcome to User Management');
        $this->comment('You can intput "--help" to show all commands');
        exit();
    }

    public function getUsers($limit){
        if($limit > 0){
            $users = User::limit($limit)->get();
        }else{
            $users = User::all();
        }

        if(count($users) > 0){
            foreach ($users as $key => $user){
//                dd($user->id);
                $this->info(str_repeat('-', 15)." INDEX: ".($key + 1)." " . str_repeat('-', 15));
                $this->comment("ID: ". $user->id);
                $this->comment("Name: ". $user->name);
                $this->comment("Email: ". $user->email);
            }
        }else{
            $this->error('No thing data');
        }
        exit();
    }

    public function searchUsers($search, $limit){
        if($limit > 0){
            $users = User::where('name', 'like', "%$search%")->limit($limit)->get();
        }else{
            $users = User::where('name', 'like', "%$search%")->get();
        }

        if(count($users) > 0){
            foreach ($users as $key => $user){
//                dd($user->id);
                $this->info(str_repeat('-', 15)." INDEX: ".($key + 1)." " . str_repeat('-', 15));
                $this->comment("ID: ". $user->id);
                $this->comment("Name: ". $user->name);
                $this->comment("Email: ". $user->email);
            }
        }else{
            $this->error('No thing data');
        }
        exit();
    }

    public function getUser($id){
        $this->info(str_repeat('-', 15)." Find User ID: $id " . str_repeat('-', 15));
        $user = User::find($id);
        if($user !== null){
            $this->comment("ID: ". $user->id);
            $this->comment("Name: ". $user->name);
            $this->comment("Email: ". $user->email);
        }else{
            $this->error('User is not exists');
        }
        exit();
    }

    public function deleteUser($id){
        $this->info(str_repeat('-', 15)." Delete User ID: $id " . str_repeat('-', 15));
        $user = User::find($id);
        if($user !== null){
            $user->delete();
        }else{
            $this->error('User is not exists');
        }
        exit();
    }

    public function createUser($fields){
        $fields = explode(',', $fields);
        $data = [];
        foreach ($fields as $field){
            $field = explode(":", $field);
            $key = trim($field[0]);
            $value = trim($field[1]);
            if($key == 'password'){
                $data[$key] = bcrypt($value);
            }else{
                $data[$key] = $value;
            }
        }
        $user = User::create($data);
        if($user != null){
            $this->comment("User $user->name is created");
        }
        exit();
    }

    public function updateUser($id, $fields){
        $user = User::find($id);
        if($user !== null){
            $fields = explode(',', $fields);
            foreach ($fields as $field){
                $field = explode(":", $field);
                $key = trim($field[0]);
                $value = trim($field[1]);
                if($key == 'password'){
                    $user->$key = bcrypt($value);
                }else{
                    $user->$key = $value;
                }
            }
            try{
                $user->save();
            } catch (\Exception $ex){
                $this->error('Some thing went wrong');
            }
            $this->comment("User $user->name is updated");
        }else{
            $this->error('User is not exists');
        }
        exit();
    }
}
