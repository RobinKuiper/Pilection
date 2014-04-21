<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Welcome to Pilection</title>
</head>
<body>
<center>
    <table width="600" background="#FFFFFF" style="text-align:left;" cellpadding="0" cellspacing="0">
        <tr>
            <td height="18" width="31" style="border-bottom:1px solid #e4e4e4;">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
            <td height="18" width="131">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
            <td height="18" width="466" style="border-bottom:1px solid #e4e4e4;">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
        </tr>
        <tr>
            <td height="2" width="31" style="border-bottom:1px solid #e4e4e4;">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
            <td height="2" width="131">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
            <td height="2" width="466" style="border-bottom:1px solid #e4e4e4;">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
        </tr>
        <!--GREEN STRIPE-->
        <tr>
            <td background="images/greenback.gif" width="31" bgcolor="#45a853" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;" height="113">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>

            <!--WHITE TEXT AREA-->
            <td width="131" bgcolor="#FFFFFF" style="border-top:1px solid #FFF; text-align:center;" height="113" valign="middle">
                <span style="font-size:25px; font-family:Trebuchet MS, Verdana, Arial; color:#2e8a3b;">Welcome!</span>
            </td>

            <!--GREEN TEXT AREA-->
            <td background="images/greenback.gif" bgcolor="#45a853" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF; padding-left:15px;" height="113">
                <span style="color:#FFFFFF; font-size:18px; font-family:Trebuchet MS, Verdana, Arial;">Thank you for registering to our website.</span>
            </td>
        </tr>

        <!--DOUBLE BORDERS BOTTOM-->
        <tr>
            <td height="3" width="31" style="border-top:1px solid #e4e4e4; border-bottom:1px solid #e4e4e4;">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
            <td height="3" width="131">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
            <td height="3" style="border-top:1px solid #e4e4e4; border-bottom:1px solid #e4e4e4;">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <!--CONTENT STARTS HERE-->
                <br />
                <br />
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="15"><div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
                        </td>
                        <td width="325" style="padding-right:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" valign="top">
                            <span style="font-family:Trebuchet MS, Verdana, Arial; font-size:17px; font-weight:bold;">Welcome!</span>
                            <br />
                            <p>You have succesfully signed up for Pilection, only thing to do is confirm your email address, by clicking on the following link:

                            <p>{{ link_to('validation/'.$id.'/'.$token, 'Confirm your email!') }}</p>

                            Best Regards,<br/>
                            Robin Kuiper<p/>

                            Pilection<br/>
                            <br/>

                            This welcome email was sent because you recently signed up for <a href="http://pilection.eu" title="Pilection.eu">Pilection.eu</a>.

                        </td>
                        <td style="border-left:1px solid #e4e4e4; padding-left:15px;" valign="top">

                            <!--RIGHT COLUMN SECOND BOX-->
                            <br />
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #e4e4e4; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">
                                <tr>
                                    <td>
                                        <div style="font-family:Trebuchet MS, Verdana, Arial; font-size:17px; font-weight:bold; padding-bottom:10px;">Have Any Questions?</div>
                                        <p>Don't hesitate to hit the reply button to any of the messages you receive.</p>
                                        <br />
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br />
    <table cellpadding="0" style="border-top:1px solid #e4e4e4; text-align:center; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" cellspacing="0" width="600">
        <tr>
            <td height="2" style="border-bottom:1px solid #e4e4e4;">
                <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
            </td>
        </tr>
        <td style="font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">
            <br />
            info@pilection.eu<br />
        </td>
        </tr>
    </table>
</center>
</body>
</html>