<?php

namespace Core\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Core\AdminBundle\Entity\Users;
use Core\AdminBundle\Entity\radcheck;
use Core\AdminBundle\Entity\ssidmacauth;

class LoginController extends Controller
{
########## LOGIN ##########
    public function loginAction(Request $request)
    {

        if( $url = $request->query->all()){
            $this->get('cache')->save('url', serialize($url));
        }else{
            $url = $this->get('cache')->fetch('url');
            $url = unserialize($url);
        }

        //var_dump( urldecode( $url['ssid'] ) );

        $params = '?';
        foreach ($url as $key => $value) {
            $params .= $key.'='.$value.'&';
        }

        $request = Request::createFromGlobals();
        $user = $request->request->get('username',NULL);
        $pass = $request->request->get('password',NULL);
        $chk_rec = $request->request->get('chk_rec',NULL);
        $chk = '';
        $msg = '';

        $response = new Response();

        if ($user != NULL && $pass != NULL) {

            if ($chk_rec == "chk_rec"){
                $user = htmlspecialchars(trim($user));
                $pass = trim($pass);

                $cookieU = new Cookie('usu', $user, time()+60*60*24*30);
                $cookieP = new Cookie('pass', $pass, time()+60*60*24*30);

                $response->headers->setCookie($cookieU);
                $response->headers->setCookie($cookieP);

                $response->send();


            }else{
                $response->headers->clearCookie('usu');
                $response->headers->clearCookie('pass');
                $response->send();
            }

            $em = $this->getDoctrine()->getManager();

            /***** VERIFICA USUARIO *****/
            $raduser1 = $em->getRepository('CoreAdminBundle:radcheck')->findOneBy(
                array(
                    'username'  => $user,
                    'value'  => $pass
                )
            );

            if (count($raduser1) < 1) {
                $msg = 'Usuario y/o contraseña inválidos';
                return $this->render('CoreAdminBundle:login:plantilla.html.twig', array( 'user' => $user, 'pass' => $pass, 'chk' => $chk, 'msg' => $msg ));
            }

            /***** VERIFICA SSID *****/
            $raduser2 = $em->getRepository('CoreAdminBundle:Users')->findOneBy(
                array(
                    'username'  => $user,
                    'ssid'  => urldecode( $url['ssid'] )
                )
            );

            if (count($raduser2) < 1) {
                $user_data = $em->getRepository('CoreAdminBundle:Users')->findOneBy(
                    array(
                        'username'  => $user
                    )
                );
                //$ssid = str_replace('TOL ', '', $user_data->getSsid());
                $msg = 'A este usuario le corresponde la red "'.$user_data->getSsid().'( '.urldecode( $url['ssid'] ).' )". Por favor cambie de red WiFi e intente de nuevo.';
                return $this->render('CoreAdminBundle:login:plantilla.html.twig', array( 'user' => $user, 'pass' => $pass, 'chk' => $chk, 'msg' => $msg ));
            }

            /***** VERIFICA MACADDRESS *****/
            $raduser3 = $em->getRepository('CoreAdminBundle:ssidmacauth')->findOneBy(
                array(
                    'macaddress'  => $this->formatMac( $url['client_mac'] )
                )
            );

            $exist_mac = 0;

            if (count($raduser3)) {
                if ($raduser3->getUsername() == $user ) {
                    $exist_mac = 1;
                }else{
                    $exist_mac = 2;
                    $msg = 'Ese dispositivo ya está registrado en otra cuenta. No puede registrarse el mismo dispositivo en cuentas diferentes. Favor de utilizar las credenciales de la primer cuenta con la que se conectó el dispositivo.';
                }
            }else{
                $user_mac = $em->getRepository('CoreAdminBundle:ssidmacauth')->findBy(
                    array(
                        'username'  => $user,
                    )
                );
                if (count($user_mac) > 1) {
                    $exist_mac = 3;
                    $msg = 'Ya existen dos dispositivos registrados con esta cuenta, lo cual es el máximo permitido. Por favor espera a mañana para poder registrar este dispositivo';
                }
            }
            if ($exist_mac == 0 || $exist_mac == 1) {
                $url = "http://".$url['sip'].":9997/login";
                return $this->render('CoreAdminBundle:login:layout_zd.html.twig', array( 'user' => $user, 'pass' => $pass, 'url' => $url ));
            }

            return $this->render('CoreAdminBundle:login:plantilla.html.twig', array( 'user' => $user, 'pass' => $pass, 'chk' => $chk, 'msg' => $msg ));

        }

        $user = '';
        $pass = '';

        $request = $this->get('request');
        if($request->cookies->has('usu') && $request->cookies->has('pass') ){
            $user = $request->cookies->get('usu');
            $pass = $request->cookies->get('pass');
            $chk = "checked";
        }

        return $this->render('CoreAdminBundle:login:plantilla.html.twig', array( 'user' => $user, 'pass' => $pass, 'chk' => $chk, 'msg' => $msg ));
    }
    /***************************************************************************/
    public function welcomeAction()
    {
        return $this->render('CoreAdminBundle:login:bienvenida.html.twig', array());
    }
    /***************************************************************************/
    public function registerAction(Request $request)
    {
        if ($url = $this->get('cache')->fetch('url')) {
            $url = unserialize($url);
        }

        $usuario = new Users();
        $form = $this->createFormBuilder($usuario);
        $msg = '';

        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('CoreAdminBundle:Users')->findOneBy(
                array(
                    'username'  => $data['form']['username']
                )
            );
            if ($data['form']['newpass'] != $data['form']['newpasssecond']) {
                $usuario->setFecha( new \DateTime('today') );
                $form = $this->createFormBuilder($usuario)
                    ->setAction($this->generateUrl('portal_register'))
                    //->add('firstname', 'text', array('label' => 'Nombre','attr' => array('placeholder' => 'Nombre')))
                    //->add('secondname', 'text', array('label' => 'Apellidos (paterno y materno separados por un espacio)','attr' => array('placeholder' => 'Apellidos')))
                    ->add('matricula', 'text', array('label' => 'Matrícula','attr' => array('placeholder' => 'Matrícula')))
                    ->add('email', 'email', array('label' => 'E-mail','attr' => array('placeholder' => 'correo electronico')))
                    ->add('username', 'text', array('label' => 'Usuario (elije un nombre de usuario de por lo menos 5 caracteres)','attr' => array('placeholder' => 'Mínimo de 5 caracteres.', 'pattern' => '.{5,}')))
                    ->add('newpass', 'password', array('label' => 'Password (mínimo 6 caracteres, no se diferencian mayúsculas de minúsculas y utiliza solo caracteres alfanuméricos.)','attr' => array('placeholder' => 'Mínimo de 6 caracteres.', 'pattern' => '.{6,}')))
                    ->add('newpasssecond', 'password', array('label' => 'Ingresa de nuevo el password','attr' => array('placeholder' => 'Reingresa el password', 'pattern' => '.{6,}')))
                    ->add('enviar', 'submit')
                ->getForm();
                $msg = "Los campos de contraseña no coinciden - Verifica que ambas sean iguales e intenta de nuevo.";
                return $this->render('CoreAdminBundle:login:register.html.twig', array( 'form' => $form->createView(), 'msg' => $msg, 'errors' => '' ));
            }
            if (!$user) {
                $user = $em->getRepository('CoreAdminBundle:Users')->findOneBy(
                    array(
                        //'firstname'  => $data['form']['firstname'],
                        //'secondname'  => $data['form']['secondname'],
                        'matricula' => $data['form']['matricula'],
                        'newpass' => '0'
                    )
                );
                if ($user) {
                    $user->setNewpass($data['form']['newpass']);
                    $user->setUsername($data['form']['username']);
                    $user->setEmail($data['form']['email']);

                    $errores = $this->get('validator')->validate($user);

                    if(count($errores) > 0)
                    {
                        var_dump(count($errores));
                        $usuario->setFecha( new \DateTime('today') );
                        $form = $this->createFormBuilder($usuario)
                            ->setAction($this->generateUrl('portal_register'))
                                //->add('firstname', 'text', array('label' => 'Nombre','attr' => array('placeholder' => 'Nombre')))
                                //->add('secondname', 'text', array('label' => 'Apellidos (paterno y materno separados por un espacio)','attr' => array('placeholder' => 'Apellidos')))
                                ->add('matricula', 'text', array('label' => 'Matrícula','attr' => array('placeholder' => 'Matrícula')))
                                ->add('email', 'email', array('label' => 'E-mail','attr' => array('placeholder' => 'correo electronico')))
                                ->add('username', 'text', array('label' => 'Usuario (elije un nombre de usuario de por lo menos 5 caracteres)','attr' => array('placeholder' => 'Mínimo de 5 caracteres.')))
                                ->add('newpass', 'password', array('label' => 'Password (mínimo 6 caracteres, no se diferencian mayúsculas de minúsculas y utiliza solo caracteres alfanuméricos.)','attr' => array('placeholder' => 'Mínimo de 6 caracteres.', 'pattern' => '.{6,}')))
                                ->add('newpasssecond', 'password', array('label' => 'Ingresa de nuevo el password','attr' => array('placeholder' => 'Reingresa el password', 'pattern' => '.{6,}')))
                                ->add('enviar', 'submit')
                        ->getForm();
                        return $this->render('CoreAdminBundle:login:register.html.twig', array( 'form' => $form->createView(), 'msg' => '', 'errors' => $errores ));
                    }

                    $em->persist($user);
                    $em->flush();

                    $raduser = new Radcheck();
                    $raduser->setUsername($data['form']['username']);
                    $raduser->setAttribute('MD5-Password');
                    $raduser->setOp(':=');
                    $raduser->setValue($data['form']['newpass']);
                    $em->persist($raduser);
                    $em->flush();

                    $msg = "Tu registro se ha completado con éxito, ya puedes ingresar.";

                    $message = \Swift_Message::newInstance()
                        ->setSubject('Portal UVM :: Registro exitoso !')
                        ->setFrom(array('soporte@uvm.com' => 'Soporte'))
                        ->setTo($data['form']['email'])
                        ->setBody(
                            $this->renderView(
                                'CoreAdminBundle:login:mailTamplateReg.html.twig',
                                array('user' => $user->getUsername(),'pass' => $data['form']['newpass'] )
                            ), 'text/html'
                        )
                    ;
                    $this->get('mailer')->send($message);

                    return $this->render('CoreAdminBundle:login:plantilla.html.twig', array( 'user' => '', 'pass' => '', 'chk' => '', 'msg' => $msg ));
                }else{
                    $usuario->setFecha( new \DateTime('today') );
                    $form = $this->createFormBuilder($usuario)
                        ->setAction($this->generateUrl('portal_register'))
                        //->add('firstname', 'text', array('label' => 'Nombre','attr' => array('placeholder' => 'Nombre')))
                        //->add('secondname', 'text', array('label' => 'Apellidos (paterno y materno separados por un espacio)','attr' => array('placeholder' => 'Apellidos')))
                        ->add('matricula', 'text', array('label' => 'Matrícula','attr' => array('placeholder' => 'Matrícula')))
                        ->add('email', 'email', array('label' => 'E-mail','attr' => array('placeholder' => 'correo electronico')))
                        ->add('username', 'text', array('label' => 'Usuario (elije un nombre de usuario de por lo menos 5 caracteres)','attr' => array('placeholder' => 'Mínimo de 5 caracteres.', 'pattern' => '.{5,}')))
                        ->add('newpass', 'password', array('label' => 'Password (mínimo 6 caracteres, no se diferencian mayúsculas de minúsculas y utiliza solo caracteres alfanuméricos.)','attr' => array('placeholder' => 'Mínimo de 6 caracteres.', 'pattern' => '.{6,}')))
                        ->add('newpasssecond', 'password', array('label' => 'Ingresa de nuevo el password','attr' => array('placeholder' => 'Reingresa el password', 'pattern' => '.{6,}')))
                        ->add('enviar', 'submit')
                    ->getForm();
                    $msg = "Datos Inválidos - Valida que tu número de matrícula sea correcta. Si el problema persiste, contacta al Centro de Cómputo de tu plantel.";
                    return $this->render('CoreAdminBundle:login:register.html.twig', array( 'form' => $form->createView(), 'msg' => $msg, 'errors' => '' ));
                }
            }else{
                $usuario->setFecha( new \DateTime('today') );
                $form = $this->createFormBuilder($usuario)
                    ->setAction($this->generateUrl('portal_register'))
                    //->add('firstname', 'text', array('label' => 'Nombre','attr' => array('placeholder' => 'Nombre')))
                    //->add('secondname', 'text', array('label' => 'Apellidos (paterno y materno separados por un espacio)','attr' => array('placeholder' => 'Apellidos')))
                    ->add('matricula', 'text', array('label' => 'Matrícula','attr' => array('placeholder' => 'Matrícula')))
                    ->add('email', 'email', array('label' => 'E-mail','attr' => array('placeholder' => 'correo electronico')))
                    ->add('username', 'text', array('label' => 'Usuario (elije un nombre de usuario de por lo menos 5 caracteres)','attr' => array('placeholder' => 'Mínimo de 5 caracteres.', 'pattern' => '.{5,}')))
                    ->add('newpass', 'password', array('label' => 'Password (mínimo 6 caracteres, no se diferencian mayúsculas de minúsculas y utiliza solo caracteres alfanuméricos.)','attr' => array('placeholder' => 'Mínimo de 6 caracteres.', 'pattern' => '.{6,}')))
                    ->add('newpasssecond', 'password', array('label' => 'Ingresa de nuevo el password','attr' => array('placeholder' => 'Reingresa el password', 'pattern' => '.{6,}')))
                    ->add('enviar', 'submit')
                ->getForm();
                $msg = "Tu usuario ya había sido registrado con anterioridad, por favor emplea tu user y contraseña para ingresar. Si tienes alguna duda por favor acude al Centro de Cómputo de tu campus.";
                return $this->render('CoreAdminBundle:login:register.html.twig', array( 'form' => $form->createView(), 'msg' => $msg, 'errors' => '' ));
            }
        }else{
            $usuario->setFecha( new \DateTime('today') );
            $form = $this->createFormBuilder($usuario)
                ->setAction($this->generateUrl('portal_register'))
                    //->add('firstname', 'text', array('label' => 'Nombre','attr' => array('placeholder' => 'Nombre')))
                    //->add('secondname', 'text', array('label' => 'Apellidos (paterno y materno separados por un espacio)','attr' => array('placeholder' => 'Apellidos')))
                    ->add('matricula', 'text', array('label' => 'Matrícula','attr' => array('placeholder' => 'Matrícula')))
                    ->add('email', 'email', array('label' => 'E-mail','attr' => array('placeholder' => 'correo electronico')))
                    ->add('username', 'text', array('label' => 'Usuario (elije un nombre de usuario de por lo menos 5 caracteres)','attr' => array('placeholder' => 'Mínimo de 5 caracteres.')))
                    ->add('newpass', 'password', array('label' => 'Password (mínimo 6 caracteres, no se diferencian mayúsculas de minúsculas y utiliza solo caracteres alfanuméricos.)','attr' => array('placeholder' => 'Mínimo de 6 caracteres.', 'pattern' => '.{6,}')))
                    ->add('newpasssecond', 'password', array('label' => 'Ingresa de nuevo el password','attr' => array('placeholder' => 'Reingresa el password', 'pattern' => '.{6,}')))
                    ->add('enviar', 'submit')
            ->getForm();
            return $this->render('CoreAdminBundle:login:register.html.twig', array( 'form' => $form->createView(), 'msg' => $msg, 'errors' => '' ));
        }
    }
    /***************************************************************************/
    public function changeAction(Request $request)
    {
        $usuario = new Users();
        $form = $this->createFormBuilder($usuario);
        $msg = '';

        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $em = $this->getDoctrine()->getManager();

            if( $data['form']['newpass'] === $data['form']['newpasssecond'] ){
                $user = $em->getRepository('CoreAdminBundle:Users')->findOneBy(
                    array(
                        'username'  => $data['form']['username'],
                        'matricula' => $data['form']['matricula'],
                        'genpass' => $data['form']['genpass'],
                        'newpass' => '0'
                    )
                );
                if ($user) {
                    $user->setGenpass('0');
                    $user->setNewpass($data['form']['newpass']);
                    $em->persist($user);
                    $em->flush();

                    $raduser = $em->getRepository('CoreAdminBundle:radcheck')->findOneBy(
                        array(
                            'username'  => $data['form']['username']
                        )
                    );

                    if ($raduser) {
                        $raduser->setValue($data['form']['newpass']);
                        $em->persist($raduser);
                        $em->flush();
                    }

                    $msg = "Tu contraseña se ha cambiado con éxito, ya puedes ingresar.";
                    return $this->render('CoreAdminBundle:login:plantilla.html.twig', array( 'user' => '', 'pass' => '', 'chk' => '', 'msg' => $msg ));
                }else{
                    $form = $this->createFormBuilder($usuario)
                        ->setAction($this->generateUrl('portal_change_pass'))
                        ->add('username', 'text', array('label' => 'Usuario','attr' => array('placeholder' => 'Usuario', 'pattern' => '.{5,}')))
                        ->add('matricula', 'text', array('label' => 'Matrícula','attr' => array('placeholder' => 'Matrícula')))
                        ->add('genpass', 'text', array('label' => 'Ingresa el password que te enviamos por mail','attr' => array('placeholder' => '8 caracteres.', 'pattern' => '.{6,}')))
                        ->add('newpass', 'password', array('label' => 'Nuevo password','attr' => array('placeholder' => 'Mínimo de 6 caracteres.', 'pattern' => '.{6,}')))
                        ->add('newpasssecond', 'password', array('label' => 'Ingresa de nuevo el password','attr' => array('placeholder' => 'Reingresa el password', 'pattern' => '.{6,}')))
                        ->add('enviar', 'submit')
                    ->getForm();
                    $msg = "Datos Inválidos - Valida que tus datos sean correctos. Si el problema persiste, contacta al Centro de Cómputo de tu plantel.";
                    return $this->render('CoreAdminBundle:login:change.html.twig', array( 'form' => $form->createView(), 'msg' => $msg ));
                }
            }else{
                $form = $this->createFormBuilder($usuario)
                    ->setAction($this->generateUrl('portal_change_pass'))
                    ->add('username', 'text', array('label' => 'Usuario','attr' => array('placeholder' => 'Usuario', 'pattern' => '.{5,}')))
                    ->add('matricula', 'text', array('label' => 'Matrícula','attr' => array('placeholder' => 'Matrícula')))
                    ->add('genpass', 'text', array('label' => 'Ingresa el password que te enviamos por mail','attr' => array('placeholder' => '8 caracteres.', 'pattern' => '.{6,}')))
                    ->add('newpass', 'password', array('label' => 'Nuevo password','attr' => array('placeholder' => 'Mínimo de 6 caracteres.', 'pattern' => '.{6,}')))
                    ->add('newpasssecond', 'password', array('label' => 'Ingresa de nuevo el password','attr' => array('placeholder' => 'Reingresa el password', 'pattern' => '.{6,}')))
                    ->add('enviar', 'submit')
                ->getForm();
                $msg = "Los campos de contraseña no coinciden, verifica e intenta de nuevo.";
                return $this->render('CoreAdminBundle:login:change.html.twig', array( 'form' => $form->createView(), 'msg' => $msg ));
            }
        }else{
            $form = $this->createFormBuilder($usuario)
                ->setAction($this->generateUrl('portal_change_pass'))
                ->add('username', 'text', array('label' => 'Usuario','attr' => array('placeholder' => 'Usuario', 'pattern' => '.{5,}')))
                ->add('matricula', 'text', array('label' => 'Matrícula','attr' => array('placeholder' => 'Matrícula')))
                ->add('genpass', 'text', array('label' => 'Ingresa el password que te enviamos por mail','attr' => array('placeholder' => '8 caracteres.', 'pattern' => '.{6,}')))
                ->add('newpass', 'password', array('label' => 'Nuevo password','attr' => array('placeholder' => 'Mínimo de 6 caracteres.', 'pattern' => '.{6,}')))
                ->add('newpasssecond', 'password', array('label' => 'Ingresa de nuevo el password','attr' => array('placeholder' => 'Reingresa el password', 'pattern' => '.{6,}')))
                ->add('enviar', 'submit')
            ->getForm();
            return $this->render('CoreAdminBundle:login:change.html.twig', array( 'form' => $form->createView(), 'msg' => $msg ));
        }
    }
    /***************************************************************************/
    public function resetAction(Request $request)
    {
        $form = $this->createFormBuilder();
        $msg = '';
        if ($request->isMethod('POST')) {
            $data = $request->request->all();

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('CoreAdminBundle:Users')->findOneBy(
                array(
                    'username' => $data['form']['username'],
                    'email' => $data['form']['email']
                )
            );
            if ($user) {
                $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                $longitudCadena=strlen($cadena);
                $newpass = "";
                $longitudPass=8;
                for($i=1 ; $i<=$longitudPass ; $i++){
                    $pos=rand(0,$longitudCadena-1);
                    $newpass .= substr($cadena,$pos,1);
                }

                $user->setGenpass($newpass);
                $user->setNewpass('0');
                $em->persist($user);
                $em->flush();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Portal UVM :: Reseteo de contraseña')
                    ->setFrom(array('soporte@uvm.com' => 'Soporte'))
                    ->setTo($data['form']['email'])
                    ->setBody(
                        $this->renderView(
                            'CoreAdminBundle:login:mailTamplate.html.twig',
                            array('user' => $user->getUsername(),'pass' => $newpass, 'hostname' => $_SERVER['HTTP_HOST'] )
                        ), 'text/html'
                    )
                ;
                $this->get('mailer')->send($message);

                $msg = 'Se ha enviado exitosamente un correo a su cuenta registrada. Favor de esperar 3 minutos para recibirlo y buscar en la carpeta de Correos NO Deseados (SPAM) en caso de no verlo en su carpeta de entrada (INBOX)';
                return $this->render('CoreAdminBundle:login:plantilla.html.twig', array( 'user' => '', 'pass' => '', 'chk' => '', 'msg' => $msg ));
            }else{
                $msg = 'La cuenta de correo y/o el usuario no se encuentran registrados en nuestro sistema';
                $defaultData = array('message' => '');
                $form = $this->createFormBuilder($defaultData)
                    ->setAction($this->generateUrl('portal_reset_pass'))
                    ->add('username', 'text', array('label' => 'Verifica tu nombre de usuario','attr' => array('placeholder' => 'username')))
                    ->add('email', 'email', array('label' => 'Ingresa la dirección de correo con la cual te registraste para poder recibir tu nueva contraseña.','attr' => array('placeholder' => 'correo electronico')))
                    ->add('enviar', 'submit')
                ->getForm();
                return $this->render('CoreAdminBundle:login:reset.html.twig', array( 'form' => $form->createView(), 'msg' => $msg ));
            }
        }else{
            $defaultData = array('message' => 'Type your message here');
            $form = $this->createFormBuilder($defaultData)
                ->setAction($this->generateUrl('portal_reset_pass'))
                ->add('username', 'text', array('label' => 'Verifica tu nombre de usuario','attr' => array('placeholder' => 'username')))
                ->add('email', 'email', array('label' => 'Ingresa la dirección de correo con la cual te registraste para poder recibir tu nueva contraseña.','attr' => array('placeholder' => 'correo electronico')))
                ->add('enviar', 'submit')
            ->getForm();
            return $this->render('CoreAdminBundle:login:reset.html.twig', array( 'form' => $form->createView(), 'msg' => $msg ));
        }
    }
    /***************************************************************************/
    public function formatMac($mac)
    {
        $longitud = strlen($mac);
            $macaddress = '';
            for($i = 0; $i < $longitud; ++$i)
                if($i%2==0)
                    if($i == 0)
                        $macaddress .= $mac[$i].$mac[$i+1];
                    else
                        $macaddress .= '-'.$mac[$i].$mac[$i+1];
        return $macaddress;
    }
##########  ##########
}
