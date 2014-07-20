<?php
class AdminUsersController extends \BaseController
{   
    protected $user;
    protected $passwordReminder;

    public function __construct(User $user, PasswordReminder $passwordReminder)
    {   
        parent::__construct();
        $this->user = $user;
        $this->passwordReminder = $passwordReminder;
    }
    /** 
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {  
        $perPage = $this->user->getPerPage();
        if( $this->isRoot ){
            $users = $this->user;
        }else{
            $users = $this->user->where('id', '=', Auth::user()->id);
        }
        $users = $users->paginate( $perPage );

        return View::make('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return View::make('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store()
    {   

        $rules = array('email' => 'required|email|unique:users,email');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()){
           return Redirect::route('admin.users.create')->withInput()->withErrors($validator);
        }
        
        $user = new $this->user;
        $user = $this->user->firstOrNew(array('email' => Input::get('email')));
        if(!$user->id){
            $user->is_admin = Input::get('is_admin', 0);
            $user->save();

            // save token
            $pr = new $this->passwordReminder;
            $pr->email = $user->email;
            $pr->token = md5(uniqid(strrev($pr->email)));
            $pr->created_at = new \DateTime();
            $pr->save();

            // send email
            Mail::send('emails.admin.user.create',['token'=> $pr->token], function($message) use($user)
            {
                $message->to($user->email, $user->email)->subject('New admin Account');
            });
            return Redirect::route('admin.users.index')->with('success', 'User created');
        }

        return Redirect::route('admin.users.create')->withInput()->with('error', 'User already exists');

    }

    /**
     * Display the specified resource.
     * @author Emerson Carvalho <emerson.broga@gmail.com>
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        return View::make('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int      $id
     * @return Response
     */
    public function edit($id)
    {
        if( $this->isRoot ){
            $user = $this->user->find($id);
        }elseif($id == Auth::user()->id ){
            $user = $this->user->find($id);
        }else{
            return Redirect::route('admin.users.index')->with('error', 'Not allowed');
        }

        return View::make('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param  int      $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array('email' => 'email|unique:users,email,'.$id, 'password' => 'confirmed');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()){
           return Redirect::route('admin.users.edit', [$id])->withInput()->withErrors($validator);
        }

        if( !$this->isRoot && $id != Auth::user()->id){
           return Redirect::route('admin.users.index')->with('error', 'Not allowed');
        }

        $input = Input::only('email','password', 'is_admin');
        
        if(empty($input['password'])){
            unset($input['password']);
        }else{
             $input['password'] = \Hash::make($input['password']);
        }

        $result = $this->user->where('id', '=', $id)->update($input);

        if($result >= 0)
            return Redirect::route('admin.users.index')->with('success', 'Data updated successfully');
        else
            return Redirect::route('admin.users.update', [$id])->withInput()->with('error', 'Error on update');

    }

    /**
     * Remove the specified resource from storage.
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
        if( $id == Auth::user()->id || !$this->isRoot){
           return Redirect::route('admin.users.index')->with('error', 'Not allowed');
        }
        
        $result = $this->user->destroy($id);
        if($result)
            return Redirect::route('admin.users.index')->with('success', 'Data deleted successfully');
        else
            return Redirect::route('admin.users.update', [$id])->withInput()->with('error', 'Error on update');


    }

}
