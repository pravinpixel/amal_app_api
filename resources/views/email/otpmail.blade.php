<html>

<body style="background: #f5f8fa; margin-top: 50px;">
    <table border="0" cellpadding="0" cellspacing="0" align="center"
        style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white; font-size: 16px;line-height: 26px;width:600px;">
        <tr>
            <td
                style="border-collapse: collapse;border: 1px solid #CCC;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                <table
                    style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif; width:100%;"
                    border="0">
                    <tr>
                        <td valign="center" align="center"
                            style="border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #FFFF;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color:#1e329d; text-align: center;">
                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                <tr>
                                    <td style="display: flex !important;justify-content:flex-start !important;"><img
                                            style="padding-top: 14px;" src="{{ asset('images/Frame 7.png') }}"
                                            width="162" height="71" /></td>
                                    <td style="text-align: right;"><img src="{{ asset('images/Group.png') }}"
                                            width="100" height="100" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align="center"
                            style="border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #222;font-family: Arial, sans-serif;font-size: 15px;line-height: 26px;background-color:#FFF; text-align: left;">
                            Dear <strong>{{ucfirst($email)}},</strong><br /><br />
                            <strong>{{$mailData}}</strong> is the OTP (One-Time Password) to register in the
                            <strong>Amalorpavam Alumini App</strong>. Please do not share this OTP with anyone. It will
                            be valid for only 5 minutes. Kindly re-generate it after expiry, if required.<br /><br />
                            <strong>Yours Sincerely,<br />Amalorpavam Alumini Team</strong>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align="center"
                            style="border-collapse: collapse;border: 0; border-top: 1px solid #CCC; margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #222;font-family: Arial, sans-serif;font-size: 13px;line-height: 20px;background-color:#f0f0f0; text-align: left;">
                            <strong>Note:</strong> This is an automated email, please do not reply directly to this
                            message.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
