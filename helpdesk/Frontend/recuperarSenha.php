<?php

    include '../Backend/conexao.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['email'])) {

        $query = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->execute(array($_POST['email']));

        $resultado = $query->fetch(PDO::FETCH_ASSOC); 

        if($resultado) {
            $matricula = $resultado['matricula'];
            $key = password_hash($resultado['senha'] . date("Y-m-d h:i:sa"), PASSWORD_DEFAULT);

            $query = $conn->prepare("UPDATE usuarios SET chave = :c WHERE matricula = :m");
            $query->bindValue(":c",$key);
            $query->bindValue(":m",$matricula);
            $query->execute();

            require('../Backend/PHPMailer/PHPMailer.php');
            require('../Backend/PHPMailer/SMTP.php');
            require('../Backend/PHPMailer/Exception.php');

            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'phptestemail22@gmail.com';
                $mail->Password = 'teste2223';
                $mail->Port = 587;

                $mail->setFrom('php80helpdesk@gmail.com');
                $mail->addAddress('fellippe.nascimento@gmail.com');
                $mail->addAddress('luiz.nascimento@telemacoborba.pr.gov.br');

                $mail->isHTML(true);
                $mail->Subject = 'Recuperação de senha Help Desk';
                $mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:lato, "helvetica neue", helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
                 <head> 
                  <meta charset="UTF-8"> 
                  <meta content="width=device-width, initial-scale=1" name="viewport"> 
                  <meta name="x-apple-disable-message-reformatting"> 
                  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
                  <meta content="telephone=no" name="format-detection"> 
                  <title>Novo modelo de e-mail 2022-01-27</title> 
                  <!--[if (mso 16)]>
                    <style type="text/css">
                    a {text-decoration: none;}
                    </style>
                    <![endif]--> 
                  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
                  <!--[if gte mso 9]>
                <xml>
                    <o:OfficeDocumentSettings>
                    <o:AllowPNG></o:AllowPNG>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                </xml>
                <![endif]--> 
                  <style type="text/css">
                #outlook a {
                    padding:0;
                }
                .ExternalClass {
                    width:100%;
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                    line-height:100%;
                }
                .es-button {
                    mso-style-priority:100!important;
                    text-decoration:none!important;
                }
                a[x-apple-data-detectors] {
                    color:inherit!important;
                    text-decoration:none!important;
                    font-size:inherit!important;
                    font-family:inherit!important;
                    font-weight:inherit!important;
                    line-height:inherit!important;
                }
                .es-desk-hidden {
                    display:none;
                    float:left;
                    overflow:hidden;
                    width:0;
                    max-height:0;
                    line-height:0;
                    mso-hide:all;
                }
                [data-ogsb] .es-button {
                    border-width:0!important;
                    padding:15px 25px 15px 25px!important;
                }
                @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120%!important } h1 { font-size:30px!important; text-align:center } h2 { font-size:26px!important; text-align:center } h3 { font-size:20px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:30px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button, button.es-button { font-size:20px!important; display:block!important; border-width:15px 25px 15px 25px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
                </style> 
                 </head> 
                 <body style="width:100%;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"> 
                  <div class="es-wrapper-color" style="background-color:#F4F4F4"> 
                   <!--[if gte mso 9]>
                            <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                                <v:fill type="tile" color="#f4f4f4"></v:fill>
                            </v:background>
                        <![endif]--> 
                   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top"> 
                     <tr class="gmail-fix" height="0" style="border-collapse:collapse"> 
                      <td style="padding:0;Margin:0"> 
                       <table cellspacing="0" cellpadding="0" border="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:600px"> 
                         <tr style="border-collapse:collapse"> 
                          <td cellpadding="0" cellspacing="0" border="0" style="padding:0;Margin:0;line-height:1px;min-width:600px" height="0"><img src="images/41521605538834349.png" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;max-height:0px;min-height:0px;min-width:600px;width:600px" alt width="600" height="1"></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td valign="top" style="padding:0;Margin:0"> 
                       <table class="es-header" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#7C72DC;background-repeat:repeat;background-position:center top"> 
                         <tr style="border-collapse:collapse"> 
                          <td style="padding:0;Margin:0;background-color:#7c72dc" bgcolor="#7c72dc" align="center"> 
                           <table class="es-header-body" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#7C72DC;width:600px"> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="Margin:0;padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:580px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:25px;padding-bottom:25px;font-size:0"><img src="images/7331519201751184.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="40"></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                           </table></td> 
                         </tr> 
                       </table> 
                       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
                         <tr style="border-collapse:collapse"> 
                          <td style="padding:0;Margin:0;background-color:#7c72dc" bgcolor="#7c72dc" align="center"> 
                           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" align="center"> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="padding:0;Margin:0"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:600px"> 
                                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#ffffff;border-radius:4px" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="center" style="Margin:0;padding-bottom:5px;padding-left:30px;padding-right:30px;padding-top:35px"><h1 style="Margin:0;line-height:58px;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;font-size:48px;font-style:normal;font-weight:normal;color:#111111">Esqueceu sua senha?</h1></td> 
                                     </tr> 
                                     <tr style="border-collapse:collapse"> 
                                      <td bgcolor="#ffffff" align="center" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;font-size:0"> 
                                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                         <tr style="border-collapse:collapse"> 
                                          <td style="padding:0;Margin:0;border-bottom:1px solid #ffffff;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px"></td> 
                                         </tr> 
                                       </table></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                           </table></td> 
                         </tr> 
                       </table> 
                       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="padding:0;Margin:0"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:600px"> 
                                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td class="es-m-txt-l" bgcolor="#ffffff" align="left" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:30px;padding-right:30px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato, "helvetica neue", helvetica, arial, sans-serif;line-height:27px;color:#666666;font-size:18px">clique no botão abaixo para recuperar</p></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="padding:0;Margin:0;padding-bottom:20px;padding-left:30px;padding-right:30px"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:540px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:40px;padding-bottom:40px"><span class="es-button-border" style="border-style:solid;border-color:#7C72DC;background:#7C72DC;border-width:1px;display:inline-block;border-radius:2px;width:auto"><a href="https://viewstripo.email/" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;border-style:solid;border-color:#7C72DC;border-width:15px 25px 15px 25px;display:inline-block;background:#7C72DC;border-radius:2px;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center">Reset Password</a></span></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                           </table></td> 
                         </tr> 
                       </table> 
                       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" align="center"> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="padding:0;Margin:0"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:600px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="center" style="Margin:0;padding-top:10px;padding-bottom:20px;padding-left:20px;padding-right:20px;font-size:0"> 
                                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                         <tr style="border-collapse:collapse"> 
                                          <td style="padding:0;Margin:0;border-bottom:1px solid #f4f4f4;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px"></td> 
                                         </tr> 
                                       </table></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                           </table></td> 
                         </tr> 
                       </table> 
                       <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                           <table class="es-footer-body" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="Margin:0;padding-top:30px;padding-bottom:30px;padding-left:30px;padding-right:30px"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:540px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="left" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#666666;font-size:14px"><b>TI - HelpDesk</b></p></td> 
                                     </tr> 
                                     <tr style="border-collapse:collapse"> 
                                      <td align="left" style="padding:0;Margin:0;padding-top:25px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#666666;font-size:14px">Prefeitura Municipal de Telêmaco Borba</p></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                           </table></td> 
                         </tr> 
                       </table> 
                       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
                         <tr style="border-collapse:collapse"> 
                          <td align="center" style="padding:0;Margin:0"> 
                           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" align="center"> 
                             <tr style="border-collapse:collapse"> 
                              <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px"> 
                               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                 <tr style="border-collapse:collapse"> 
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px"> 
                                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                                     <tr style="border-collapse:collapse"> 
                                      <td class="es-infoblock made_with" align="center" style="padding:0;Margin:0;line-height:120%;font-size:0;color:#CCCCCC"><a target="_blank" href="https://viewstripo.email/?utm_source=templates&utm_medium=email&utm_campaign=software2&utm_content=trigger_newsletter5" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px"><img src="images/64951510234941531.png" alt width="125" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td> 
                                     </tr> 
                                   </table></td> 
                                 </tr> 
                               </table></td> 
                             </tr> 
                           </table></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                   </table> 
                  </div>  
                 </body>
                </html>';
                
                
                
                
                
                
                //'Link para redefinir sua senha: <strong><a href=http://localhost/HelpDesk/helpdesk/Frontend/enviarNovaSenha.php?key='.$key.'>Clique aqui para redefinir a senha</a></strong>';
                $mail->AltBody = '<a href=http://localhost/HelpDesk/helpdesk/Frontend/enviarNovaSenha.php?key='.$key.'>Clique aqui para redefinir a senha</a>';

                if($mail->send()) {
                    echo 'Email enviado com sucesso';
                } else {
                    echo 'Email nao enviado';
                }
            } catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>window.alert('Endereço de e-mail não encontrado! Por favor realize o cadastro no sistema!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Esqueceu Sua Senha??</h1>
                                        <p class="mb-4"></p>
                                    </div>
                                    <form action="recuperarSenha.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="Email" name="email" aria-describedby="emailHelp"
                                                placeholder="Seu endereço de e-mail">
                                        </div>
                                        <input type="submit" value="Recuperar Senha" class="btn btn-primary btn-user btn-block" id="enviarChave">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="cadastro.php">Cadastra-se!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="../index.php">Já possúi uma conta? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>