<?php
require_once 'system/PHPMailer/src/Exception.php';
require_once 'system/PHPMailer/src/PHPMailer.php';
require_once 'system/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
function sendEmail($data,$admin,$sender){
    try{
       
        //$admin = $db->connection("SELECT email FROM admin WHERE id = 1")->fetchColumn();
        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = 0;                     
        $mail->isSMTP();                                            
        $mail->Host       = $sender['host'];                    
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = $sender['user'];                 
        $mail->Password   = $sender['pass'];                               
        $mail->SMTPSecure = 'ssl';         
        $mail->Port       = 465;                                    

        //Recipients
        $mail->setFrom($sender['from']);
        $mail->addAddress("$admin[deskripsi]");     

$pesan ='

<!doctype html>
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
      <head>
        <title>
          
        </title>
        <!--[if !mso]><!-- -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
          #outlook a { padding:0; }
          body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
          table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
          img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
          p { display:block;margin:13px 0; }
        </style>
        <!--[if mso]>
        <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        <!--[if lte mso 11]>
        <style type="text/css">
          .outlook-group-fix { width:100% !important; }
        </style>
        <![endif]-->
        
      <!--[if !mso]><!-->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">
        <style type="text/css">
          @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);
@import url(https://fonts.googleapis.com/css?family=Cabin:400,700);
        </style>
      <!--<![endif]-->

    
        
    <style type="text/css">
      @media only screen and (max-width:480px) {
        .mj-column-per-100 { width:100% !important; max-width: 100%; }
      }
    </style>
    
  
        <style type="text/css">
        
        
        </style>
        <style type="text/css">.hide_on_mobile { display: none !important;} 
        @media only screen and (min-width: 480px) { .hide_on_mobile { display: block !important;} }
        .hide_section_on_mobile { display: none !important;} 
        @media only screen and (min-width: 480px) { 
            .hide_section_on_mobile { 
                display: table !important;
            } 

            div.hide_section_on_mobile { 
                display: block !important;
            }
        }
        .hide_on_desktop { display: block !important;} 
        @media only screen and (min-width: 480px) { .hide_on_desktop { display: none !important;} }
        .hide_section_on_desktop { 
            display: table !important;
            width: 100%;
        } 
        @media only screen and (min-width: 480px) { .hide_section_on_desktop { display: none !important;} }
        
          p, h1, h2, h3 {
              margin: 0px;
          }

          ul, li, ol {
            font-size: 11px;
            font-family: Ubuntu, Helvetica, Arial;
          }

          a {
              text-decoration: none;
              color: inherit;
          }

          @media only screen and (max-width:480px) {

            .mj-column-per-100 { width:100%!important; max-width:100%!important; }
            .mj-column-per-100 > .mj-column-per-75 { width:75%!important; max-width:75%!important; }
            .mj-column-per-100 > .mj-column-per-60 { width:60%!important; max-width:60%!important; }
            .mj-column-per-100 > .mj-column-per-50 { width:50%!important; max-width:50%!important; }
            .mj-column-per-100 > .mj-column-per-40 { width:40%!important; max-width:40%!important; }
            .mj-column-per-100 > .mj-column-per-33 { width:33.333333%!important; max-width:33.333333%!important; }
            .mj-column-per-100 > .mj-column-per-25 { width:25%!important; max-width:25%!important; }

            .mj-column-per-100 { width:100%!important; max-width:100%!important; }
            .mj-column-per-75 { width:100%!important; max-width:100%!important; }
            .mj-column-per-60 { width:100%!important; max-width:100%!important; }
            .mj-column-per-50 { width:100%!important; max-width:100%!important; }
            .mj-column-per-40 { width:100%!important; max-width:100%!important; }
            .mj-column-per-33 { width:100%!important; max-width:100%!important; }
            .mj-column-per-25 { width:100%!important; max-width:100%!important; }
        }</style>
        
      </head>
      <body style="background-color:#FFFFFF;">
        
        
      <div style="background-color:#FFFFFF;">
        
      
      <!--[if mso | IE]>
      <table
         align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
      >
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    
      
      <div style="margin:0px auto;max-width:600px;">
        
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
          <tbody>
            <tr>
              <td style="direction:ltr;font-size:0px;padding:9px 0px 9px 0px;text-align:center;">
                <!--[if mso | IE]>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                
        <tr>
      
            <td
               class="" style="vertical-align:top;width:600px;"
            >
          <![endif]-->
            
      <div class="mj-column-per-100 outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
        
      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
        
            <tr>
              <td align="left" style="font-size:0px;padding:15px 15px 15px 15px;word-break:break-word;">
                
      <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;"><h1 style="font-family: "Cabin", sans-serif; font-size: 22px; text-align: center;">PENDAFTARAN ONLINE PELATIHAN</h1></div>
    
              </td>
            </tr>
          
            <tr>
              <td style="font-size:0px;padding:10px 10px;padding-top:10px;padding-right:10px;word-break:break-word;">
                
      <p style="font-family: Ubuntu, Helvetica, Arial; border-top: solid 1px #BEBEBE; font-size: 1; margin: 0px auto; width: 100%;">
      </p>
      
      <!--[if mso | IE]>
        <table
           align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #BEBEBE;font-size:1;margin:0px auto;width:580px;" role="presentation" width="580px"
        >
          <tr>
            <td style="height:0;line-height:0;">
              &nbsp;
            </td>
          </tr>
        </table>
      <![endif]-->
    
    
              </td>
            </tr>
          
            <tr>
              <td align="left" style="font-size:0px;padding:15px 15px 15px 15px;word-break:break-word;">
                
      <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;"><p style="font-size: 11px; font-family: Ubuntu, Helvetica, Arial; text-align: center;"><strong style="text-transform: uppercase">NAMA PELATIHAN : '.$data['nama_pelatihan'].'</strong></p></div>
    
              </td>
            </tr>
          
            <tr>
              <td align="left" style="font-size:0px;padding:15px 15px 15px 15px;word-break:break-word;">
                
      <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1.5;text-align:left;color:#000000;"><table style="border-collapse: collapse; width: 100%; height: 165px; border-width: 0px;" border="1"><colgroup><col style="width: 50%;"><col style="width: 50%;"></colgroup>
        <tbody>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>NAMA LENGKAP</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['nama_lengkap'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>NOMOR INDUK KEPENDUDUKAN </strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['nik'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>TEMPAT & TANGGAL LAHIR</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['ttl'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>JENIS KELAMIN</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['jenis_kelamin'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>PENDIDIKAN TERAKHIR</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['pendidikan'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>ALAMAT EMAIL</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['email'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>TELEPON / WHATSAPP</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['telepon'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>ALAMAT LENGKAP</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['alamat'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>ASAL PERUSAHAAN</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['perusahaan'].'</td>
        </tr>
        <tr style="height: 16.5px;">
        <td style="height: 16.5px; border-width: 0px;"><strong>ALAMAT PENGIRIMAN SERTIFIKAT</strong></td>
        <td style="height: 16.5px; border-width: 0px;">: '.$data['sertifikat'].'</td>
        </tr>
        </tbody>
        </table></div>
    
              </td>
            </tr>
          
            <tr>
              <td style="font-size:0px;padding:10px 10px;padding-top:10px;padding-right:10px;word-break:break-word;">
                
      <p style="font-family: Ubuntu, Helvetica, Arial; border-top: solid 1px #D3D3D3; font-size: 1; margin: 0px auto; width: 100%;">
      </p>
      
      <!--[if mso | IE]>
        <table
           align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #D3D3D3;font-size:1;margin:0px auto;width:580px;" role="presentation" width="580px"
        >
          <tr>
            <td style="height:0;line-height:0;">
              &nbsp;
            </td>
          </tr>
        </table>
      <![endif]-->
    
    
              </td>
            </tr>
          
            <tr>
              <td align="center" style="font-size:0px;padding:10px 10px 10px 10px;word-break:break-word;">
                
      
     <!--[if mso | IE]>
      <table
         align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
      >
        <tr>
      
              <td>
            <![endif]-->
              <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                
      <tr>
        <td style="padding:4px;">
          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:transparent;border-radius:3px;width:35px;">
            <tr>
              <td style="font-size:0;height:35px;vertical-align:middle;width:35px;">
                <a href="https://www.facebook.com/PROFILE" target="_blank" style="color: #0000EE;">
                    <img alt="Facebook" height="35" src="https://s3-eu-west-1.amazonaws.com/ecomail-assets/editor/social-icos/rounded/facebook.png" style="border-radius:3px;display:block;" width="35">
                  </a>
                </td>
              </tr>
          </table>
        </td>
        
      </tr>
    
              </table>
            <!--[if mso | IE]>
              </td>
            
              <td>
            <![endif]-->
              <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                
      <tr>
        <td style="padding:4px;">
          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:transparent;border-radius:3px;width:35px;">
            <tr>
              <td style="font-size:0;height:35px;vertical-align:middle;width:35px;">
                <a href="https://www.twitter.com/PROFILE" target="_blank" style="color: #0000EE;">
                    <img alt="Twitter" height="35" src="https://s3-eu-west-1.amazonaws.com/ecomail-assets/editor/social-icos/rounded/twitter.png" style="border-radius:3px;display:block;" width="35">
                  </a>
                </td>
              </tr>
          </table>
        </td>
        
      </tr>
    
              </table>
            <!--[if mso | IE]>
              </td>
            
              <td>
            <![endif]-->
              <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                
      <tr>
        <td style="padding:4px;">
          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:transparent;border-radius:3px;width:35px;">
            <tr>
              <td style="font-size:0;height:35px;vertical-align:middle;width:35px;">
                <a href="https://www.linkedin.com/PROFILE" target="_blank" style="color: #0000EE;">
                    <img alt="LinkedIn" height="35" src="https://s3-eu-west-1.amazonaws.com/ecomail-assets/editor/social-icos/rounded/linkedin.png" style="border-radius:3px;display:block;" width="35">
                  </a>
                </td>
              </tr>
          </table>
        </td>
        
      </tr>
    
              </table>
            <!--[if mso | IE]>
              </td>
            
              <td>
            <![endif]-->
              <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                
      <tr>
        <td style="padding:4px;">
          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:transparent;border-radius:3px;width:35px;">
            <tr>
              <td style="font-size:0;height:35px;vertical-align:middle;width:35px;">
                <a href="https://www.instagram.com/PROFILE" target="_blank" style="color: #0000EE;">
                    <img alt="Instagram" height="35" src="https://s3-eu-west-1.amazonaws.com/ecomail-assets/editor/social-icos/rounded/instagram.png" style="border-radius:3px;display:block;" width="35">
                  </a>
                </td>
              </tr>
          </table>
        </td>
        
      </tr>
    
              </table>
            <!--[if mso | IE]>
              </td>
            
          </tr>
        </table>
      <![endif]-->
    
    
              </td>
            </tr>
          
      </table>
    
      </div>
    
          <!--[if mso | IE]>
            </td>
          
        </tr>
      
                  </table>
                <![endif]-->
              </td>
            </tr>
          </tbody>
        </table>
        
      </div>
    
      
      <!--[if mso | IE]>
          </td>
        </tr>
      </table>
      <![endif]-->
    
    
      </div>
    
      </body>
    </html> 

';

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $sender['subject'].' - '.$data['name'];
        $mail->Body    = $pesan;

        $mail->send();
    
        return true;
       
        
    }catch(PDOException $e){
        return false;
    }

}
?>