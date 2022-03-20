<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>お問い合わせありがとうございます。</title>
	</head>
	<body>
		<div>
			<table style="width:100%; border-spacing:0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
					<th>
						<td>
                                                        <div style="width:100%">
<?php echo $data['contact_name']; ?> 様<br />
お問い合わせありがとうございます。<br />
以下内容にて承りました。<br /><br />
----------------------------------<br />
お名前 : <?php echo $data['contact_name'] ; ?><br /><br />
メールアドレス : <?php echo $data['contact_email'] ; ?><br />
お問い合わせ内容<br />                                                           
<?php echo $data['contact_naiyou'] ; ?><br />

----------------------------------<br />


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
