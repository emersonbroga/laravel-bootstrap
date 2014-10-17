<?php
class AdminUsersController extends \AdminBaseController
{   
    protected $model;
    protected $passwordReminder;

    public function __construct(User $model, PasswordReminder $passwordReminder)
    {   
        parent::__construct();
        $this->model = $model;
        $this->passwordReminder = $passwordReminder;
    }
    /** 
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {  
        $perPage = $this->model->getPerPage();
        if( $this->user->isRoot() ){
            $data = $this->model;
        }else{
            $data = $this->model->where('id', '=', $this->user->id);
        }
        $data = $data->paginate( $perPage );

        $data_links = $data->appends(Input::except('page'))->links();

        return View::make('admin.users.index', compact('data', 'data_links'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roleOptions = $this->model->getRoleOptions();

        return View::make('admin.users.create', compact('roleOptions'));
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
        
        $record = $this->model->firstOrNew(array('email' => Input::get('email')));
        if(!$record->id){
            $record->role = Input::get('role');
            $record->save();

            // // save token
            // $pr = new $this->passwordReminder;
            // $pr->email = $record->email;
            // $pr->token = md5(uniqid(strrev($pr->email)));
            // $pr->created_at = new \DateTime();
            // $pr->save();

            // // send email
            // Mail::send('emails.admin.user.create',['token'=> $pr->token], function($message) use($record)
            // {
            //     $message->to($record->email, $record->email)->subject(trans('project.admin.new-account'));
            // });

            return Redirect::route('admin.users.index')->with('success', trans('project.admin.success-save'));
        }

        return Redirect::route('admin.users.create')->withInput()->with('error', trans('project.admin.already-exists'));

    }

    /**
     * Display the specified resource.
     * @author Emerson Carvalho <emerson.broga@gmail.com>
     * @return Response
     */
    public function show($id)
    {
        $model = $this->model->find($id);

        if(!$model) App::abort(404, trans('project.admin.not-found'));

        $roleOptions = $model->getRoleOptions();

        $model->role = $roleOptions[$model->role];

        return View::make('admin.users.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int      $id
     * @return Response
     */
    public function edit($id)
    {
        if( $this->user->isRoot() ){
            $record = $this->model->find($id);
        }elseif($id == $this->user->id ){
            $record = $this->model->find($id);
        }else{
            return Redirect::route('admin.users.index')->with('error', 'Not allowed');
        }

        $roleOptions = $this->model->getRoleOptions();

        return View::make('admin.users.edit', compact('record', 'roleOptions'));
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
        

        if(!$this->user->isRoot() && $id !== $this->user->id){
            return Redirect::route('admin.users.update', [$id])->withInput()->with('error', trans('project.admin.not-allowed'));
        }

        $input = Input::only('email','password', 'role');
        
        if(empty($input['password'])){
            unset($input['password']);
        }else{
             $input['password'] = \Hash::make($input['password']);
        }

        $result = $this->model->where('id', '=', $id)->update($input);
        if($result >= 0){
            return Redirect::route('admin.users.index')->with('success', trans('project.admin.success-update'));
        }else{
            return Redirect::route('admin.users.update', [$id])->withInput()->with('error', trans('project.admin.error-update'));
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
        if( $id == $this->user->id || !$this->user->isRoot()){
           return Redirect::route('admin.users.index')->with('error', trans('project.admin.not-allowed'));
        }
        
        $result = $this->model->destroy($id);
        if($result){
            return Redirect::route('admin.users.index')->with('success', trans('project.admin.success-delete'));
        }else{
            return Redirect::route('admin.users.update', [$id])->withInput()->with('error', trans('project.admin.error-delete'));
        }
    }

}
