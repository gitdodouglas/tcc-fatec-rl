<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperaController extends Controller
{
    /**
     * Função que redireciona para a url correta.
     * Utilizada quando a rota é acessada por um método GET.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('/#!esqueci');
    }

    /**
     * Função que realiza a recuperação da senha de usuário.
     *
     * @param Request $request
     * @return array
     */
    public function reset(Request $request)
    {
        try {
            /* Verifica a entrada de dados */
            if ($request->json('email') == "") {
                throw new \Exception('Campo de preenchimento obrigatório.');
            }

            /* Instancia o controller de usuário */
            $userController = new UserController;

            /* Verifica se o e-mail informado está cadastrado */
            if ($user = $userController->query('email', $request->json('email'))) {

                /* Gera a senha inicial randomicamente */
                $pass = substr(bcrypt(microtime()), 40, 10);

                /* Atualiza a senha do usuário */
                $user->password = bcrypt($pass);
                $user->save();

                /* Restaura a data de atualização */
                $user->updated_at = $user->created_at;
                $user->save();

                /* Envia o e-mail */
                //$this->sendEmail($user->email, $pass);

                return [
                    'codigo' => 'success',
                    'objeto' => null,
                    'mensagem' => 'Enviamos um e-mail com instruções para a criação de uma nova senha.',
                ];
            } else {
                throw new \Exception('Cadastro não encontrado.');
            }
        } catch (\Exception $exception) {
            return [
                'codigo' => 'error',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Função responsável pelo envio do e-mail de recuperação de senha.
     *
     * @param $email
     * @param $pass
     */
    private function sendEmail($email, $pass)
    {
        $url = url('/#!login');
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $message = "<table align='center' bgcolor='#FFFFFF' border='0' cellpadding='0' cellspacing='0' style='background:#ffffff;' width='100%'><tbody><tr><td><table align='center' border='0' cellpadding='0' cellspacing='0' class='full' style='padding:0 5px;' width='570'><tbody><tr><td align='center' style='padding:0px 20px 30px 20px;text-align:center;font-size:14px;color:#676a6c;line-height:24px;' valign='middle' width='100%'></td></tr><tr><td height='30' width='100%'>&nbsp;</td></tr><tr><td align='left' style='padding:0 20px;text-align:center;font-size:14px;color:#676a6c;line-height:24px;' valign='middle' width='100%'>Você solicitou a recuperação de senha.<br>Seguem os seus dados para efetivar a alteração:<br><br><span style='line-height:16px;'>E-MAIL<br>$email</span><br><br><span style='line-height:16px;'>SENHA<br>$pass</span></td></tr><tr><td height='30' width='100%'>&nbsp;</td></tr><tr><td align='center' style='padding:0 20px;text-align:center;' valign='middle' width='100%'><table align='center' border='0' cellpadding='0' cellspacing='0' class='fullcenter'><tbody><tr style='padding:0 20px;'><td align='center' bgcolor='#4CA4E0' height='45' style='background:#4ca4e0;padding:0 30px;font-weight:600;color:#ffffff;text-transform:uppercase;'><a href='$url' style='color:#ffffff;font-size:14px;text-decoration:none;line-height:24px;width:100%;' target='_blank'>Recuperar minha senha</a></td></tr><tr><td align='center' style='padding:20px 20px;text-align:center;font-size:14px;color:#676a6c;line-height:24px;' valign='middle' width='100%'></td></tr></tbody></table><tr><td align='left' style='padding:0 20px 80px 20px;text-align:center;font-size:14px;color:#676a6c;line-height:24px;' valign='middle' width='100%'>Caso não tenha solicitado, desconsidere essa mensagem.</td></tr>";

        mail($email, 'Recuperação de Senha', $message, $headers);
    }
}
