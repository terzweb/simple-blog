<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $detail["magazine_title"]; ?></title>
	</head>
	<body>
		<div>
			<table style="width:100%; border-spacing:0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
					<th>
						<td>
                                                        <div style="width:100%">
********************<br />
<?php echo $data["message"]; ?><br />
********************<br />
<br />

<br />

<?php echo $data["message"]; ?>を致します。<br />

下記ボタンをクリックして、パスワードリセット処理へお進みください。
<div><!--[if mso]>
  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="<?php echo $data['reset_link']; ?>" style="height:40px;v-text-anchor:middle;width:200px;" arcsize="10%" strokecolor="#1e3650" fillcolor="#556270">
    <w:anchorlock/>
    <center style="color:#ffffff;font-family:sans-serif;font-size:13px;font-weight:bold;">パスワードリセットへ進む</center>
  </v:roundrect>
<![endif]--><a href="<?php echo $data['reset_link']; ?>"
style="background-color:#556270;border:1px solid #1e3650;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">パスワードリセットへ進む</a></div>


<br />
<br />
<?php
    echo $this->config->item('mailfooter'); 
?>
                                                                
                                                        </div>
                                                </td>
					</th>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
