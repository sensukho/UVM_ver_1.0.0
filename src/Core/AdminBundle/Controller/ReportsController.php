<?php

namespace Core\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Core\AdminBundle\Entity\radcheck;
use Core\AdminBundle\Entity\Users;

class ReportsController extends Controller
{
########## REPORTS ##########
	public function activeAction($session)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            "SELECT r.username,r.id,r.framedipaddress,r.calledstationid,SUM(r.acctinputoctets),SUM(r.acctoutputoctets),SUM(r.acctsessiontime)
            FROM CoreAdminBundle:radacct r
            WHERE r.acctstoptime = '0000-00-00 00:00:00'
            GROUP BY r.username
            ORDER BY r.username ASC"
        );

        //var_dump($query);

        $usuarios = $query->getResult();

        $i=0;
        foreach ($usuarios as $usuario) {
        	$ssid =  explode(':',$usuario['calledstationid']);
        	$usuarios[$i]['calledstationid'] = $ssid['1'];
            $usuarios[$i]['acctsessiontime'] = $this->parseTime($usuario['3']);
            $usuarios[$i]['acctinputoctets'] = round($usuario['1'] * 0.000000953674316,1);
            $usuarios[$i]['acctoutputoctets'] = round($usuario['2'] * 0.000000953674316,1);
            $i++;
        }

        return $this->render('CoreAdminBundle:reports:active.html.twig', array( 'session' => $session, 'session_id' => $session, 'usuarios' => $usuarios ));
    }
    /***************************************************************************/
    public function historyAction($session)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT r.username,r.id,r.framedipaddress,r.calledstationid,SUM(r.acctinputoctets),SUM(r.acctoutputoctets),SUM(r.acctsessiontime)
            FROM CoreAdminBundle:radacct r
            GROUP BY r.username
            ORDER BY r.username ASC'
        );

        $usuarios = $query->getResult();

        $i=0;
        foreach ($usuarios as $usuario) {
        	$ssid =  explode(':',$usuario['calledstationid']);
        	$usuarios[$i]['calledstationid'] = $ssid['1'];
            $usuarios[$i]['acctsessiontime'] = $this->parseTime($usuario['3']);
            $usuarios[$i]['acctinputoctets'] = round($usuario['1'] * 0.000000953674316,1);
            $usuarios[$i]['acctoutputoctets'] = round($usuario['2'] * 0.000000953674316,1);
            $i++;
        }

        return $this->render('CoreAdminBundle:reports:history.html.twig', array( 'session' => $session, 'session_id' => $session, 'usuarios' => $usuarios ));
    }
########## COMODIN FUNCTIONS  ##########
    /***************************************************************************/
    public function parseTime($segundos)
    {
        $minutos = $segundos/60;
        $horas = floor($minutos/60);
        $minutos2 = $minutos%60;
        $segundos_2 = $segundos%60%60%60;
        if($minutos2 < 10) $minutos2 = '0'.$minutos2;
        if($segundos_2 < 10) $segundos_2 = '0'.$segundos_2;
        if($segundos < 60){
            $resultado = round($segundos).' seg.';
        }elseif($segundos > 60 && $segundos < 3600){
            $resultado= $minutos2.':'.$segundos_2.' min.';
        }else{
            $resultado= $horas.':'.$minutos2.':'.$segundos_2.' hrs.';
        }
        return $resultado;
    }
##########  ##########
}
