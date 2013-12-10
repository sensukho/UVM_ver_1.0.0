<?php

namespace Core\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;

class AdminController extends Controller
{
########## ADMINISTRATOR ##########
    public function adminAction()
    {
        return $this->render('CoreAdminBundle:admin:index.html.twig', array( 'msg' => '' ));
    }
    /***************************************************************************/
    public function loginAction()
    {
        $request = Request::createFromGlobals();
        $user = $request->request->get('user',NULL);
        $pass = $request->request->get('pass',NULL);
        if( $user == 'admin' ){
            if( $pass == '12345' ){
                $session = base64_encode( md5( $user.$pass.date('Y-n-d') ) );
                    $this->get('cache')->save('session_admin', serialize('all'));
                return $this->redirect( $this->generateUrl('admin_home', array( 'session' => $session )) );
            }else{ return $this->render('CoreAdminBundle:admin:index.html.twig', array( 'msg' => 'Usuario y/o contraseña iválidos.' )); }
        }elseif( $user == 'uvmtoluca' ){
            if( $pass == 't01uc4' ){
                $session = base64_encode( md5( $user.$pass.date('Y-n-d') ) );
                    $this->get('cache')->save('session_admin', serialize('TOL'));
                return $this->redirect( $this->generateUrl('admin_home', array( 'session' => $session )) );
            }else{ return $this->render('CoreAdminBundle:admin:index.html.twig', array( 'msg' => 'Usuario y/o contraseña iválidos.' )); }
        }else{ return $this->render('CoreAdminBundle:admin:index.html.twig', array( 'msg' => 'Usuario y/o contraseña iválidos.' )); }
    }
    /***************************************************************************/
    public function homeAction($session)
    {
        $s1 = base64_encode( md5('admin'.'12345'.date('Y-n-d') ) );
        $s2 = base64_encode( md5('uvmtoluca'.'t01uc4'.date('Y-n-d') ) );
        if ($s1 === $session ) {
            return $this->render('CoreAdminBundle:admin:lpg.html.twig', array( 'session' => $session, 'session_id' => $s1 ));
        }elseif ($s2 === $session ) {
            return $this->render('CoreAdminBundle:admin:lpg.html.twig', array( 'session' => $session, 'session_id' => $s2 ));
        }else{
            return $this->render('CoreAdminBundle:admin:index.html.twig', array( 'msg' => 'Su sesión ha caducado, ingrese de nuevo por favor.' ));
        }
    }
########## WEBSPOTS ##########
}
