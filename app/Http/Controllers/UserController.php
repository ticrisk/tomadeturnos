<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RegistroRequest;
use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.
//use Illuminate\Validation\Validator;
use validator;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Region;
use App\Comuna;
use App\Universidad;
use App\Carrera;

class UserController extends Controller
{

    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth', ['except'=>['getRegistro', 'postRegistro', 'getRut']]);

        //$this->middleware('guest', ['except' => 'getLogout']);
    }    


    public function getRegistro()
    {
        if(Auth::check()){
            return redirect('/');
        }
        return view('user.registro');
    }


    public function postRegistro(RegistroRequest $request)
    {
        $user = new User($request->all());

        //VALIDAR RUT
            $rut = $request->rut;
            $rut = $this->getRut($rut);

            //si es 0 = rut inconrrecto, si devuelve el rut está correcto.
            /**/
            if($rut == 0)
            {
                session()->flash('danger', 'Rut Incorrecto.');
                return back()->withInput();
            }
        //*******     FIN VALIDACIÓN DEL RUT    *******


        //Compruebo si el rut ya esta registrado.
        $val_rut = User::where('rut', $rut)->count();
        if($val_rut > 0)
        {
            session()->flash('danger', 'El rut ya está registrado.');
            return back()->withInput();
        }

        $user->rut = $rut;
        $user->rol = 'Usuario';
        $user->estado = 'Confirmado';
        $user->avatar = 'avatar.jpg';
        $user->ultimaConexion = date("Y-m-d H:i:s");
        $user->password = bcrypt($user->password);
        $user->nombre = ucwords(strtolower($user->nombre));
        $user->apellido = ucwords(strtolower($user->apellido));
        $user->email = strtolower($user->email);
        $user->save();


        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            // Login automático
            return redirect()->intended('/');
        }else{
            session()->flash('danger', 'Ha ocurrido un error inesperado, Inicie sesión');
            return back()->withInput();
        }

    }

    public function getRut($rut) 
    {

    //**********        Validar RUT            ****************

    $fil2   = strip_tags($rut);//Retira las etiquetas HTML y PHP de un string
    $result = preg_replace('([^A-Za-z0-9])', '', $fil2); //solo permite letras y numeros, elimina el resto
    $lon = strlen($result);//obtiene la longitud de la cadena

    $resultFinal=0;

        if ($lon == 9) {
            # code...
            //echo "El rut tiene 9 digitos";
            
                $dv  = substr($result, -1);
                $run = substr($result, 0, 8); // 146839010 comienza de la posicion cero a la posicion 8 

                $pos2  = substr($result, 7,1)*2;
                $pos3  = substr($result, 6,1)*3;
                $pos4  = substr($result, 5,1)*4;
                $pos5  = substr($result, 4,1)*5;
                $pos6  = substr($result, 3,1)*6;
                $pos7  = substr($result, 2,1)*7;
                $pos8  = substr($result, 1,1)*2;
                $pos9  = substr($result, 0,1)*3;
                
                $sumaTotal= $pos2 + $pos3 + $pos4 + $pos5  + $pos6 + $pos7 + $pos8 + $pos9;
                //$res  =   number_format(($sumaTotal / 11), 0);//saco los decimales, el 0 indica que no quiero ningún decimal
                $res = (intval($sumaTotal / 11));
                $res2   =   $sumaTotal - 11 * $res;
                $res3   =   11 - $res2;
                
                if($res3 == 11) 
                {
                    $dv2 = 0;
                    //echo "dv es 0";
                }elseif ($res3 == 10) {
                    $dv2 = 'k';
                    //echo "dv es k";
                }else{
                    $dv2 = $res3;
                    //echo "Cualquier numero";
                }

                /**/
                if ($dv == $dv2) {
                    //echo "Rut Correcto!";
                    $resultFinal=$result;
                }else{
                    //echo "Rut Incorrecto!!";
                    $resultFinal=0;
                }

        }elseif ($lon == 8) {
            # code...
            //echo "El rut tiene 8 digitos";
                $dv  = substr($result, -1);
                $run = substr($result, 0, 7); // 9.669.738 comienza de la posicion cero a la posicion 7 
                $pos2  = substr($result, 6,1)*2; //16
                $pos3  = substr($result, 5,1)*3; //9
                $pos4  = substr($result, 4,1)*4; //28
                $pos5  = substr($result, 3,1)*5; //45
                $pos6  = substr($result, 2,1)*6; //36
                $pos7  = substr($result, 1,1)*7; //42
                $pos8  = substr($result, 0,1)*2; //18
                            
                $sumaTotal= $pos2 + $pos3 + $pos4 + $pos5  + $pos6 + $pos7 + $pos8 ;
                $res = (intval($sumaTotal / 11));
                

                $res2   =   $sumaTotal - 11 * $res;
                $res3   =   11 - $res2;
                
                if ($res3 == 11) {
                    $dv2 = 0;
                    //echo "dv es 0";
                }elseif ($res3 == 10) {
                    $dv2 = 'k';
                    //echo "dv es k";
                }else{
                    $dv2 = $res3;
                    //echo "Cualquier numero";
                }

                /**/
                if ($dv == $dv2) {
                    //echo "Rut Correcto!";
                    $resultFinal=$result;
                }else{
                    //echo "Rut Incorrecto!!";
                    $resultFinal=0;
                }
        }else{
            $resultFinal=0;
        }



        if($resultFinal != 0)
        {
            //quitar caracteres al rut y agregar un guión antes del digito verificador
            $fil2   = strip_tags($rut);//Retira las etiquetas HTML y PHP de un string
            $result = preg_replace('([^A-Za-z0-9])', '', $fil2); //solo permite letras y numeros, elimina el resto
            //agrego el guion al rut
            $resultFinal = substr($result, 0, $lon-1)."-".substr($result, $lon-1 ,$lon);            
        }


        $rut = $resultFinal;

        return $rut;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Muestra Información de un usuario
    public function show($id)
    {
        $usuario = User::find($id);

        if($usuario->comuna_id != null){
            $usuario->comuna_id = $usuario->comuna->nombre;
            //paso la variable region con el valor=nombreRegion xq no esta en el modelo 
            $region = $usuario->comuna->region->nombre;
        }else{
            $region = '';
        }

        if($usuario->carrera_id != null){
            $usuario->carrera_id = $usuario->carrera->nombre;
        }

        if($usuario->universidad_id != null){
            $usuario->universidad_id = $usuario->universidad->nombre;
        }    

        if($usuario->avatar==null){
            $usuario->avatar = "avatar.jpg";
        }


        return view('user.show',compact('region'))
            ->with('usuario', $usuario);
            //->with('region', $region);
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*Falta un campo descripcion!*/
        $usuario = User::find($id);

        if($usuario == '' || $usuario->id != Auth::user()->id)
        {
            //return redirect()->action('HomeController@index');
            return view('errors.userNotFound');
        }
 

        if($usuario->genero == '')
        {
            $usuario->genero='Sin Registro';
        }

        if($usuario->hijos == '')
        {
            $usuario->hijos='Sin Registro';
        }     

           

        $regiones = Region::orderby('nombre','ASC')->pluck('nombre','id');
        $comunas  = Comuna::where('id',$usuario->comuna_id)->pluck('nombre','id');
        $universidades = Universidad::orderby('nombre','ASC')->pluck('nombre','id');
        $carreras = Carrera::orderby('nombre','ASC')->pluck('nombre','id');
       
        //dd($regiones);
       
        return view('user.edit')
            ->with('regiones', $regiones)
            ->with('comunas', $comunas)
            ->with('universidades', $universidades)
            ->with('carreras', $carreras)            
            ->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $usuario = User::find($id);

        $regiones = Region::orderby('nombre','ASC')->pluck('nombre','id');
        $comunas  = Comuna::where('id',$usuario->comuna_id)->pluck('nombre','id');
        $universidades = Universidad::orderby('nombre','ASC')->pluck('nombre','id');
        $carreras = Carrera::orderby('nombre','ASC')->pluck('nombre','id');
        
        //Obtengo los datos anteriormente guardados y los abergo en las variables "ex"
        $exEmail  = $usuario->email;
        $exAvatar = $usuario->avatar;
        $exPassword  = $usuario->password;        

        //$usuario->comuna_id = null;
        $usuario->fill($request->all());

        /* Validar si existe otro usuario con el mismo email */
        if($usuario->email != $exEmail)
        {
            $valEmail = User::where('email',$usuario->email)->first();
            if($valEmail != ''){
                session()->flash('danger', 'El email ya esta registrado');
                //Redirecciono de vuelta con los valores de los input ingresados
                return redirect()->back()->withInput();
                /*
                return redirect()->action('UserController@edit', ['id' => $id])
                    ->with('paises', $paises)
                    ->with('comunas', $comunas)
                    ->with('usuario', $usuario);
                */
            }
        }
        

        if($usuario->avatar != $exAvatar)
        {
            //Eliminno la antigua foto y guardo la nueva imagen 
            if($exAvatar != 'avatar.jpg')
            {
                \File::delete(public_path().'/img/user/'.$exAvatar);//elimino foto guardada anteriormente
            }
            //Guardo la foto subida al hacer el update
            $fileAvatar = $request->file('avatar');
            $rename_fileAvatar = $usuario->id . '.' . $fileAvatar->getClientOriginalExtension();
            $path = public_path() . '/img/user/';
            $fileAvatar->move($path, $rename_fileAvatar);
            $img = \Image::make($path.$rename_fileAvatar)->resize(100, 100);//Tamaño 120 de la imagen para que se vea bien en el articulo
            $img->save($path .$rename_fileAvatar);
            $usuario->avatar = $rename_fileAvatar;
        }        
        //dejar nulo los otros campos que se encuentren vacios
        if($usuario->direccion == ''){ $usuario->direccion = null; } 
        if($usuario->celular == ''){ $usuario->celular = null; } 
        if($usuario->genero == 'Sin Registro'){ $usuario->genero = null; } 
        if($usuario->hijos == 'Sin Registro'){ $usuario->hijos = null; }
        if($usuario->redSocial == ''){ $usuario->redSocial = null; }  

        //Code para que no exista problema al guardar porque recibo datos vacios y para guardarlos en la FK debe ser nulos
        if($usuario->comuna_id == ''){
            $usuario->comuna_id = null;
        }

        if($usuario->carrera_id == ''){
            $usuario->carrera_id = null;
        }  

        if($usuario->universidad_id == ''){
            $usuario->universidad_id = null;
        }                
        //Fin del Code nulos



        /* Validar password */
        if($usuario->password=='')
        {
            $usuario->password = $exPassword;
        }else{
            //el nuevo pass lo encrypto
            $usuario->password = bcrypt($usuario->password);
        }            
        
        $usuario->nombre = ucwords(strtolower($usuario->nombre));
        $usuario->apellido = ucwords(strtolower($usuario->apellido));
        $usuario->email = strtolower($usuario->email);
        $usuario->redSocial = strtolower($usuario->redSocial);
        $usuario->direccion = ucwords(strtolower($usuario->direccion));
        $usuario->update();

        session()->flash('success', 'Modificado exitosamente');
      
        return redirect()->action('UserController@edit', ['id' => $id])
            ->with('regiones', $regiones)
            ->with('comunas', $comunas)
            ->with('universidades', $universidades)
            ->with('carreras', $carreras)            
            ->with('usuario', $usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /* Editar Usuario DropDownList*/
    public function getRegiones(Request $request, $user, $id){
        if($request->ajax()){
            $towns = Region::buscarRegiones($id);
            return response()->json($towns);
        }
    }

        public function getComunas(Request $request, $user, $id){
        if($request->ajax()){
            $towns = Comuna::buscarComunas($id);
            return response()->json($towns);
        }
    }    




}
