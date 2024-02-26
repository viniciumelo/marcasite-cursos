<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'tipo_usuario_id' => 'required|exists:tipo_usuario,id',
        ]);

        // Iniciando uma transação para garantir a integridade dos dados
        DB::beginTransaction();

        try {
            // Criar um novo usuário
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // Associar o tipo de usuário ao novo usuário
            $tipoUsuario = TipoUsuario::findOrFail($request->tipo_usuario_id);
            $user->tipoUsuario()->associate($tipoUsuario);
            $user->save();

            // Commit da transação se tudo estiver OK
            DB::commit();

            // Redirecionar com mensagem de sucesso
            return redirect()->route('/')->with('success', 'User registered successfully!');
        } catch (\Exception $e) {
            // Desfazer a transação em caso de erro
            DB::rollback();

            // Redirecionar com mensagem de erro
            return redirect()->back()->with('error', 'Failed to register user. Please try again.');
        }
    }
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // Obtém todos os usuários
        $users = User::all();

        // Retorna a view com os usuários
        return view('users.index', compact('users'));
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',
            'tipo_usuario_id' => 'required|exists:tipo_usuario,id',
        ]);

        // Encontra o usuário a ser atualizado
        $user = User::findOrFail($id);

        // Atualiza os dados do usuário
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->tipo_usuario_id = $request->tipo_usuario_id;
        $user->save();

        // Redireciona com mensagem de sucesso
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function destroy($id)
    {
        // Encontra o usuário a ser deletado
        $user = User::findOrFail($id);

        // Deleta o usuário
        $user->delete();

        // Redireciona com mensagem de sucesso
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.register');
    }
}
