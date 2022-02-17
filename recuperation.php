<?php
session_start();
// ini_set("SMTP", "ssl://smtp.gmail.com");
// ini_set("smtp_port", 25);
require_once('connexion.php');
require_once('recuperation.vue.php');

if(isset($_GET['section'])){
    $section=htmlspecialchars($_GET['section']);
}else{
    $section="";
}

if(isset($_POST['recup_submit'],$_POST['recup_mail'])){
    if(!empty($_POST['recup_mail'])){
        $recup_mail= htmlspecialchars($_POST['recup_mail']);
        if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)){
            $mailexixt = $con->prepare('SELECT id,nom FROM `users` WHERE mail= ?');
            $mailexixt->execute(array($recup_mail));
            $mailexixt_count = $mailexixt->rowCount();
            if($mailexixt_count == 1){
                $nom = $mailexixt->fetch();
                $nom = $nom['nom'];
                var_dump($nom);
                $_SESSION['recup_mail'] = $recup_mail;
                $recup_code="";
                for ($i=0; $i < 8 ; $i++) { 
                    $recup_code .= mt_rand(0,9);
                }
                // $_SESSION['recup_code'] = $recup_code;
                $mail_recup_exist = $con->prepare('SELECT id FROM recuperation WHERE mail = ?');
                $mail_recup_exist->execute(array($recup_mail));
                $mail_recup_exist = $mail_recup_exist->rowCount();
                if($mail_recup_exist == 1){
                $recup_insert = $con->prepare('UPDATE `recuperation` SET `code`=? WHERE `mail = ?');
                $recup_insert->execute(array($recup_code,$recup_mail));
                }else{
                $recup_insert = $con->prepare('INSERT INTO `recuperation`(`mail`, `code`) VALUES (?,?)');
                $recup_insert->execute(array($recup_mail,$recup_code));
                }

                $header="MIME-Version :1.0\r\n";
                $header.= 'From:"*site non hebergé*"<*mail*@gmail.com>'."\n" ;
                $header.= 'Content-Type:text/html; charset="utf-8"'."\n";
                $header.= 'Content-Transfert-Encoding: 8bit';

                $message ='
                <head>        
                    <title>Recuperation de mot de pass - PrimFX.com</title>
                    <meta charset="utf-8" />
                </head>
                <body>
                <font color="#303030";>
                    <div align:center>
                    <table width="600px">
                        <tr>
                            <td background="http://www.primfx.com/mailing/bannier.png" height="100px"></td>
                        </tr>
                        <tr>
                            <td>
                                <br />
                <div align:center>Bonjour <br>'.$nom.'</br>,</div> <br />
                Voici votre code de verification :<b>'.$recup_code.'<br /><br /><br />
                
                            A bientot sur <a href="http://www.primfx.com">PrimFx.com</a>! <br />
                            <br /> <br /> <br />
                        </td>
                    </tr>
                    <tr>
                    <td background="http://www.primfx.com/mailing/separation.png" height="5px"></td>
                    </tr>
                    <tr>
                        <td align="center">
                            <font size="2">
                                ceci est un mail automatique merci de n est pas y repondre.
                            </font>
                        </td>
                    </tr>

                </table>
                </div>
                </font>           
                </body>
                </html>
                
                ';
                mail($recup_mail,"Recuperation de mot de pass - PrimFX.com",$message,$header);
                header('location:http://127.0.0.1/gestion_vente_unites/recuperation.php?section=code');
            }else{
                echo "adresse mail n'est pas enregistree";
            }
        }else{
            Echo "adresse mail invalide";
        }
    }else{
        echo "veillez entrer votre adresse mail";
    }
}

if(isset($_POST['verif_code'],$_POST['verif_submit'])){
    if(!empty($_POST['verif_code'])){
        $verif_code = htmlspecialchars($_POST['verif_code']);
        $verif_req =$con->prepare('SELECT id FROM recuperation WHERE mail= ? AND code= ?');
        $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
        $verif_req=$verif_req->rowCount();
        if($verif_req==1){
            $del_rec=$con->prepare('DELETE FROM recuperation WHERE mail= ?');
            $del_rec->execute(array($_SESSION['recup_mail']));
            header('location:http://127.0.0.1/gestion_vente_unites/recuperation.php?section=changemdp');
        }else{
            echo"code invalide";
        }
    }else{
        echo"veillez entrer votre code de confirmation";
    }
}


?>