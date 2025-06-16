<!DOCTYPE html>
<html lang="en" style="margin:0; padding:0;">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Instructor Approval</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
        }

        h1 {
            color: #333333;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            color: #999999;
            font-size: 12px;
            margin-top: 20px;
        }

        @media only screen and (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div style="padding: 20px;">
        <div class="container">
            <h1>New Contact Message Received</h1>
            <p>You have received a new message via the contact form on <strong>EduCore</strong>.</p>

            <ul>
                <li><strong>Name:</strong> {{ $name }}</li>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Subject:</strong> {{ $subjectContact }}</li>
            </ul>

            <p><strong>Message:</strong></p>
            <p>{{ $messageContact }}</p>

            <div class="footer">
                &copy; {{ date('Y') }} EduCore. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>
