



<?php
$html='<table cellspacing="0" cellpadding="0" style="padding:30px 10px;background-color:rgb(238,238,238);width:100%;font-family:arial;background-repeat:initial initial">
<tbody>
<tr>
	<td>
		<table align="center" cellspacing="0" style="max-width:650px;min-width:320px">
			<tbody>
				<tr>
					<td align="center" style="background:#fff;border:1px solid #e4e4e4;padding:50px 30px">
						<table align="center">
							<tbody>
								<tr>
									<td style="border-bottom:1px solid #dfdfd0;color:#666;text-align:center">
										<table align="left" width="100%" style="margin:auto">
										<tbody>
											<tr>
											<td style="text-align:left;padding-bottom:14px">
    <img align="left" alt="SHIFT" src="'.SITE_URL.'/uploads/logo/'.$setting['logo'].'" width="150px" height="150px"></td>
											</tr>

										</table>
										<table align="left" style="margin:auto">
										<tbody>
											<tr>
												<td style="color:rgb(102,102,102);font-size:16px;padding-bottom:30px;text-align:left;font-family:arial">
    You have requested for a password reset. Please click on the link or copy and paste the link in browser to proceed.<br><br>

											Password Reset Link : '. SITE_URL . '/index.php?user=forgot_password&random=durgesh<br>

											<br /><br><br>Regards<br><br>
											'. $setting[name] .'<br>
											</td>				</tr>
										</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>';

$filename = SERVER_ROOT . '/uploads/pdf/'.durgesh. "_payslip.html";
file_put_contents ( $filename, $html );
?>

 <a  href="<?php echo $link->link("pdfgenerate",user,'&id='.durgesh.'_payslip');?>"
					style="text-decoration: none; font-family: sans-serif;cursor: pointer;"
					class="pdf btn btn-primary pull-right"><i class="fa fa-file">&nbsp;PDF Generate</i></a>