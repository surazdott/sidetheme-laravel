<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $data['subject'] }}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <table style="background:#f3f3f3; width:100%;height: 100%;" cellpadding="0" cellspacing="0" border="0">
        <tbody>
            <tr>
                <td style="padding: 50px;">
                    <table style="width: 550px;height: 100%;margin: 0 auto" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            <tr style="border-bottom:1px dashed #ddd">
                                <td style="width: 175px;height: 20px;font-family: Roboto;font-size: 18px;font-weight: 600;font-style: normal;font-stretch: normal;line-height: 1.11;letter-spacing: normal;text-align: center;color: #001737;padding-bottom: 15px"> {{ $data['subject'] }}</td>
                            </tr>
                            <tr>
                                <td style="padding-top: 20px;">
                                    <img style="float:left;" src="{{ asset('assets/img/logo-dark.png') }}" alt="{{ config('app.name') }}" height="28" width="135"> 
                                    <p style="font-family: Roboto;font-size: 13px;font-weight: 500;font-style:
                                  normal;font-stretch: normal;line-height: normal;letter-spacing: normal;color:
                                  #bbb;float:right;margin-top: 10px;">{{ __('Free Download Templates and Themes') }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-radius: 10px;background: #fff;padding: 30px 60px 20px 60px;margin-top: 10px;display: block;">
                                    <p style="font-family: Roboto;font-size: 14px;font-weight: 500;font-style:
                                  normal;font-stretch: normal;line-height: 1.71;letter-spacing: normal;color: #001737;margin-bottom: 10px;"> Hi {{ $data['name'] }},</p>
                                    <p style="font-family: Roboto;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.71;letter-spacing: normal;color: #001737;"> {{ $data['message'] }}</p>
                                     <p style="font-family: Roboto;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: 1.71;letter-spacing: normal;color: #001737;">To download free themes and templates, please click the link below : <a target="new" href="{{ config('app.url') }}/login">{{ config('app.url') }}/login</a> or <a target="new" href="{{ config('app.url') }}/login">click here.</a></p>
                                     <p style="font-family: Roboto;font-size: 14px;font-weight: normal;font-style:normal;font-stretch: normal;line-height: 1.71;letter-spacing: normal;color: #001737;margin-bottom: 0px;"> Sincerly,</p>
                                    <p style="font-family: Roboto;font-size: 14px;font-weight: bold;font-style: normal;font-stretch: normal;line-height: 0.5;letter-spacing: normal;color: #001737;margin-bottom: 0px;"> {{ config('app.name') }}.com
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:235px;height: 100%;margin: 20px auto 0 auto;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="float:left;margin-right:15px;" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="background: #e6e6e6;color:#2b80ff;border-radius: 100%;height: 35px;width: 35px; margin-right:20px;">
                                                    <img style="display: block;margin: auto;max-width: 16px;" src="{{ asset('assets/img/icons/facebook.png') }}" alt="facebook">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="float:left;margin-right:15px;" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="background: #e6e6e6;color:#2b80ff;border-radius: 100%;height: 35px;width: 35px; margin-right:20px;">
                                                    <img style="display: block;margin: auto;max-width: 16px;" src="{{ asset('assets/img/icons/twitter.png') }}" alt="twitter">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="float:left;margin-right:15px;" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="background: #e6e6e6;color:#2b80ff;border-radius: 100%;height: 35px;width: 35px; margin-right:20px;">
                                                    <img style="display: block;margin: auto;max-width: 16px;" src="{{ asset('assets/img/icons/youtube.png') }}" alt="youtube">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="float:left;margin-right:15px;" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="background: #e6e6e6;color:#2b80ff;border-radius: 100%;height: 35px;width: 35px; margin-right:20px;">
                                                    <img style="display: block;margin: auto;max-width: 16px;" src="{{ asset('assets/img/icons/instagram.png') }}" alt="facebook">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="float:left;" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="background: #e6e6e6;color:#2b80ff;border-radius: 100%;height: 35px;width: 35px; margin-right:20px;">
                                                    <img style="display: block;margin: auto;max-width: 16px;" src="{{ asset('assets/img/icons/github.png') }}" alt="facebook">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="margin: 20px auto 10px auto;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            <tr>
                                <td style="font-family: Roboto;font-size: 14px;font-weight: normal;font-style: normal;font-stretch: normal;line-height: normal;letter-spacing: normal;color: #001737;"> Copyright © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</td>
                            </tr>
                            <tr>
                                <td style="font-family: Roboto;font-size: 14px;font-weight: normal;font-style:
                                  normal;font-stretch: normal;line-height: normal;letter-spacing: normal;color:
                                  #bbb;text-align: center; padding-top: 15px;"> Don't like these emails? <a style="color:inherit;" href="#">Unsubscribe</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>